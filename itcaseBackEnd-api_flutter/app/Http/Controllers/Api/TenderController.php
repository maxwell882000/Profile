<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Helpers\PaginateCollection;
use App\Models\TenderRequest;
use App\Notifications\InviteRequest;
use App\Notifications\NewRequest;
use App\Notifications\RequestAction;
use App\Notifications\TenderCreated;
use App\Repositories\HandbookCategoryRepositoryInterface;
use App\Repositories\MenuRepositoryInterface;
use App\Repositories\NeedTypeRepositoryInterface;
use App\Repositories\TenderRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class TenderController extends Controller
{

    /**
     * @var NeedTypeRepositoryInterface
     */
    private $needRepository;

    /**
     * @var TenderRepositoryInterface
     */
    private $tenderRepository;

    /**
     * @var HandbookCategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var MenuRepositoryInterface
     */
    private $menuItemsRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * TenderController constructor.
     * @param NeedTypeRepositoryInterface $needRepository
     * @param TenderRepositoryInterface $tenderRepository
     * @param HandbookCategoryRepositoryInterface $categoryRepository
     * @param MenuRepositoryInterface $menuItemsRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        NeedTypeRepositoryInterface         $needRepository,
        TenderRepositoryInterface           $tenderRepository,
        HandbookCategoryRepositoryInterface $categoryRepository,
        MenuRepositoryInterface             $menuItemsRepository,
        UserRepositoryInterface             $userRepository
    )
    {
        $this->needRepository = $needRepository;
        $this->tenderRepository = $tenderRepository;
        $this->categoryRepository = $categoryRepository;
        $this->menuItemsRepository = $menuItemsRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $tenders = $this->tenderRepository->allOrderedByCreatedAt();
        $currentCategory = null;
        $tendersCount = $tenders->count();
        $tenders = PaginateCollection::paginateCollection($tenders, 5);
        return response()->json([
            'tenders' => $tenders,
            'currentCategory' => $currentCategory,
            'tendersCount' => $tendersCount
        ]);
    }

    public function openedTenders()
    {
        $tenders = $this->tenderRepository->onlyOpened();
        $currentCategory = null;
        $tendersCount = $tenders->count();
        return response()->json([
            'tenders' => $tenders,
            'currentCategory' => $currentCategory,
            'tendersCount' => $tendersCount
        ]);
    }

    public function searchTender(Request $request)
    {
        $tenders = $this->tenderRepository->TenderSearch($request);
        $currentCategory = null;
        $tendersCount = $tenders->count();
        $tenders = PaginateCollection::paginateCollection($tenders, 5);
        return response()->json([
            'tenders' => $tenders,
            'currentCategory' => $currentCategory,
            'tendersCount' => $tendersCount
        ]);
    }

    public function categoryCreateTender(Request $request)
    {
        if ($request->has('language')) {
            $language = $request->language;  // 1 is uzbek , 2 is russian , 3 is english, 0 is default language which is russian
        } else {
            $language = 0;
        }
        $categoryAll = $this->categoryRepository->categoryForTender(2);
        $data = [];
        foreach ($categoryAll->all() as $category) {
            $subCtgr = [];
            foreach ($this->categoryRepository->subCategoryForTender(2, $category->id)->all() as $sub) {
                array_push($subCtgr, array($sub->lang, $sub->id));
            }
            array_push($data, [
                array($category->lang, $category->id),
                $subCtgr
            ]);
        }
        return response()->json(['category' => $data], 200);
    }

    public function textFilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|array'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $result = $this->tenderRepository->tenderText($request->terms, $request->categories, $request->minPrice, $request->remote);
        return response()->json(['tenders' => $result]);
    }

    public function mapsFilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_lat' => 'required',
            'center_lng' => 'required',
            'radius' => 'required',
            'categories' => 'required|array'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $result = $this->tenderRepository->tenderMap([$request->center_lat, $request->center_lng], $request->radius, $request->categories, $request->minPrice, $request->remote);
        return response()->json($result);
    }

    public function category($category_id)
    {
        $currentCategory = $this->categoryRepository->get($category_id);
        if ($currentCategory) {
            $tenders = $currentCategory->tenders()->whereNotNull('owner_id')->where('published', true)->orderBy('opened', 'desc')->orderBy('created_at', 'desc')->get();
            $tendersCount = $tenders->count();
            $tenders = PaginateCollection::paginateCollection($tenders, 5);
            return response()->json([
                'tenders' => $tenders,
                'currentCategory' => $currentCategory,
                'tendersCount' => $tendersCount
            ]);
        } else {
            return response()->json([
                'message' => '???????????? ???? ????????????'
            ], 404);
        }
    }

    public function tender($id)
    {
        $tender = $this->tenderRepository->get($id)->load('categories');
        if ($tender) {
            return response()->json($tender);
        } else {
            return response()->json([
                'message' => '???????????? ???? ????????????',
            ], 404);
        }
    }

    public function showOffered(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tender_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $tenderRequested = TenderRequest::where('tender_id', $request->tender_id)->get()->map(function (TenderRequest $tenderRequest) {
            $tenderRequest->user_info = [
                'first_name' => $tenderRequest->user->first_name,
                'last_name' => $tenderRequest->user->last_name,
                'last_online_at' => $tenderRequest->user->last_online_at,
                'image' => $tenderRequest->user->image,

            ];
            unset($tenderRequest->user);
            return $tenderRequest;
        });

        return response()->json([
            'requested' => $tenderRequested,
        ], 200);
    }

    public function showRequested(Request $request)
    {
        return response()->json([auth()->user()->requests], 200);
    }

    public function store(Request $request)
    {
//        if (auth()->user()) {
//            auth()->user()->authorizeRole('customer');
//        }
        $validator = Validator::make($request->all(), [
            'categories' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'files' => 'nullable',
            'budget' => 'required',
            'deadline' => 'required|date'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $tender = $this->tenderRepository->create($request);
        try {
            Notification::send($this->userRepository->getAdmins(), new TenderCreated($tender));
        } catch (\Exception $e) {

        } finally {
            return response()->json([
                'success' => "???????????? $tender->title ???????????? ?? ?????????????????? ???? ??????????????????!"
            ], 200);
        }


    }

    public function makeRequest(Request $request)
    {
        $request->validate([
            'budget_from' => 'required|max:255',
            'budget_to' => 'required|max:255',
            'period_to' => 'required|max:255',
            'period_from' => 'required|max:255',
            'comment' => 'nullable|string|max:255',
            'tender_id' => 'required',
        ]);
        $tenderRequest = $this->tenderRepository->createRequest($request);

        if ($tenderRequest != null) {
            $tenderTitle = $tenderRequest->tender->title;
            try {
                $tenderRequest->tender->owner->notify(new NewRequest($tenderRequest));
            } catch (\Exception $e) {
            } finally {
                return response()->json([
                    'success' => "???? ???????????? ???????????? ???? ?????????????? ?? ?????????????? \"$tenderTitle\""
                ], 200);
            }

        }
        return response()->json([
            'errors' => "???? ?????? ???????????? ???????????? ???? ?????????????? ?? ?????????????? "
        ], 404);
    }

    public function cancelRequest(Request $request)
    {
        $requestId = $request->get('requestId');
        $rejected = $request->get('rejected') === 'true' ? true : false;
        $tenderRequest = $this->tenderRepository->cancelRequest($requestId);
        $tender = $this->tenderRepository->get($tenderRequest->tender_id);
        if ($rejected) {
            try {
                $tenderRequest->user->notify(new RequestAction('rejected', $tenderRequest, $tender));
            } catch (\Exception $e) {
            }
            foreach (auth()->user()->chats as $chat) {
                if ($chat->getAnotherUser()->id === $tenderRequest->user_id) {
                    $chat->delete();
                    break;
                }
            }
        } else {
            foreach (auth()->user()->chats as $chat) {
                if ($chat->getAnotherUser()->id === $tender->owner_id) {
                    $chat->delete();
                    break;
                }
            }
        }
        if ($request->has('redirect_to')) {
            return response()->json([
                'success' => '???????????? ??????????????????.'
            ]);
        }
        return response()->json([
            'success' => '???????? ???????????? ????????????????'
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validationMessages = [
            'required' => '?????? ???????? ?????????????????????? ?? ????????????????????',
            'max' => '???????????????????? ???????????????? ???????????? ???????? ???? ???????????? :max',
            'integer' => '?????????????? ?????????????????????????? ????????????????',
            'date' => '???????????????? ???????????? ????????',
            'string' => '?????????????? ???????????????????? ????????????????',
            'email' => '???????????????? ???????????? ?????????????????????? ??????????'
        ];
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'files' => 'nullable',
            'deadline' => 'required|date'
        ], $validationMessages)->validate();
        $this->tenderRepository->update($id, $request);
        return response()->json([
            'success' => '?????????????? ??????????????????????????????!'
        ]);
    }

    public function delete(Request $request, int $id)
    {
        $tender = $this->tenderRepository->get($id);
        $tender->delete_reason = $request->delete_reason;
        $tender->opened = 0;
        $tender->save();
        Log::info($request->delete_reason);
        Log::info($request->isMethod('put'));
        return response()->json([
            'success' => '?????????????? ????????????'
        ], 200);
    }

    public function acceptTenderRequest(Request $request, int $tenderId, int $requestId)
    {

        if ($request = $this->tenderRepository->acceptRequest($tenderId, $requestId)) {
            try {
                $request->user->notify(new RequestAction('accepted', $request));
            } catch (\Swift_TransportException $e) {

            }
            $requests = $request->tender->requests;
            try {
                foreach ($requests as $otherRequest) {
                    if ($otherRequest->user_id == $request->user_id) {
                        continue;
                    }
                    try {
                        $otherRequest->user->notify(new RequestAction('rejected', $otherRequest, $otherRequest->tender));
                    } catch (\Swift_TransportException $e) {

                    }
                }
                $adminUsers = $this->userRepository->getAdmins();

                Notification::send($adminUsers, new RequestAction('accepted', $request));
            } catch (\Swift_TransportException $e) {

            }
            return response()->json([
                'success' => '?????????????????????? ???? ???????? ?????????????? ????????????????! ?????????????????????????? ?????????? ?? ???????? ???????????????? ?? ???? ???????????????? ????????????????????, ?????????????????????? ?????? ????????, ?????????? ?????????????????????? ?????????????????? ?? ????????????.'
            ], 200);
        } else {
            return response()->json([
                'success' => '???????????????????? ?????????????????? ?????????????????????? ???? ???????? ??????????????'
            ], 401);
        }
    }
}
