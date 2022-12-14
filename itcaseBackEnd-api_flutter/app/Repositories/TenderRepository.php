<?php


namespace App\Repositories;

use App\Models\Tender;
use App\Models\TenderRequest;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use App\Notifications\TenderContractorFinished;
use App\Notifications\TenderCustomerFinished;
use Illuminate\Support\Facades\Notification;

class TenderRepository implements TenderRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function all()
    {
        return Tender::all();
    }

    /**
     * @inheritDoc
     */
    public function allOrderedByCreatedAt($withoutContractors = false, $map = false)
    {
        $query = Tender::whereNotNull('owner_id')->where('published', true)->whereNull('delete_reason');
        if ($withoutContractors) {
            $query = $query->whereNull('contractor_id');
        }
        if ($map) {
            $query = $query->whereNotNull('geo_location');
        }

        return $query->whereNotNull('owner_id')->orderBy('opened', 'desc')->orderBy('created_at', 'desc')->get();
    }

    public function onlyOpened()
    {
        return Tender::whereNotNull('owner_id')->where('opened', 1)->where('published', true)->whereDate('deadline', '>=', Carbon::now())->whereNull('delete_reason')->orderBy('id', 'desc')->paginate(5);
    }

    public function checkPermission($owner_id, $user_id)
    {

        return Tender::orWhere(
                function ($query) use ($owner_id, $user_id) {
                    $query->where('contractor_id', '=', $user_id)->where('owner_id', '=', $owner_id);
                }
            )->orWhere(
                function ($query) use ($owner_id, $user_id) {
                    $query->where('contractor_id', '=', $owner_id)->where('owner_id', '=', $user_id);
                }
            )->first() != null;
    }

    public function TenderSearch($search)
    {
        $query = Tender::whereNotNull('owner_id')->where('published', true)->whereNull('delete_reason');
        return $query->where('title', 'like', '%' . $search->search . '%')->orderBy('opened', 'desc')->orderBy('created_at', 'desc')->get();
    }

    public function tenderText($terms, $categories, $minPrice = null, $remote = null, $currency = null)
    {
        $result = Tender::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('tender_category.category_id',
                function ($builder) use ($categories) {
                    return $builder->from("handbook_categories")
                        ->whereIn('handbook_categories.parent_id', $categories)
                        ->orWhereIn("handbook_categories.id", $categories)
                        ->select("handbook_categories.id");
                });
        })->whereNotNull('owner_id')
            ->where('published', true)->whereNull('delete_reason')
            ->when($terms, function ($query, $terms) {
                return $query->where('title', 'like', '%' . $terms . '%');
            })->when($minPrice, function ($query, $minPrice) {
                return $query->where('budget', '>=', $minPrice);
            })->when($remote, function ($query, $remote) {
                return $query->where('type', '=', 'remote');
            })->when($currency, function ($query, $currency) {
                return $query->where('currency', '=', $currency);
            }
            )
            ->orderBy('created_at', 'desc')->paginate();
        return $result;
    }

    public function searchTenderByTitle(string $title)
    {
        return Tender::where('title', 'like', '%' . $title . '%')->get();
    }
//    public function tenderTextWithoutTerms(array $categories)
//    {
//        $result = Tender::whereHas('categories', function ($query) use ($categories) {
//            $query->whereIn('handbook_categories.parent_id', $categories);
//        })->whereNotNull('owner_id')->where('published', true)->whereNull('delete_reason')
//            ->orderBy('opened', 'desc')->orderBy('created_at', 'desc')->paginate();
//        return $result;
//    }

    public function tenderMap($center, $radius, $categories, $minPrice = null, $remote = null)
    {
        // 6371 - radius of earth in km
        // tenders.geo_location [lat, lng]
        $result = Tender::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('tender_category.category_id', $categories)->orWhereIn('handbook_categories.parent_id', $categories);
        })->selectRaw('tenders.*')
            ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(TRIM(SUBSTRING_INDEX(tenders.geo_location, \',\', 1)))) '
                . '* cos(radians(TRIM(SUBSTRING_INDEX(tenders.geo_location, \',\', -1))) - radians(?)) + sin(radians(?)) '
                . '* sin(radians(TRIM(SUBSTRING_INDEX(tenders.geo_location, \',\', 1)))))) AS distance',
                [$center[0], $center[1], $center[0]])
            ->havingRaw('distance < ?', [$radius])
            ->whereNotNull('owner_id')->whereNull('contractor_id')->where('published', true)->whereNull('delete_reason')
            ->when($minPrice, function ($query, $minPrice) {
                return $query->where('budget', '>=', $minPrice);
            })->when($remote, function ($query, $remote) {
                return $query->where('type', '=', 'remote');
            })->orderBy('created_at', 'desc')->get()
            ->map(function (Tender $tender) {
                $tender->icon = $tender->categoryIcon();
                return $tender;
            });
        return $result;
    }

    public function allOrderedByCreatedAtAdmin($withoutContractors = false)
    {
        $query = Tender::whereNotNull('owner_id')->whereNull('delete_reason');
        if ($withoutContractors) {
            $query = $query->whereNull('contractor_id');
        }
        return $query->whereNotNull('owner_id')->orderBy('created_at', 'desc')->get();
    }

    /**
     * @inheritDoc
     */

    public function getUser($tenderData)
    {
        return auth()->user();
    }

    private function insertDate(&$tenderData, $data)
    {
        $tenderData['deadline'] = Carbon::createFromFormat('d.m.Y', $data->get('deadline'))->setHour(23)->setMinutes(59)->setSecond(59)->format('Y-m-d H:i:s');
        $tenderData['work_start_at'] = Carbon::createFromFormat($this->dateFormat(), $data->get('work_start_at'));
        $tenderData['work_end_at'] = Carbon::createFromFormat($this->dateFormat(), $data->get('work_end_at'));
    }

    protected function dateFormat()
    {
        return 'd.m.Y H:i';
    }

    public function create($data)
    {
        $tenderData = $data->all();
//        dd($tenderData);
        $user = $this->getUser($tenderData);
        $tenderData['client_name'] = $user->first_name . " " . $user->last_name;
        $tenderData['client_email'] = $user->email;
        $tenderData['client_phone_number'] = $tenderData['client_phone_number'] ?? $user->phone_number || '';
        $tenderData['client_type'] = 'customer';
        $tenderData['owner_id'] = $user->id;
        if (Arr::get($tenderData, 'remote') == 'on') {
            $tenderData['type'] = 'remote';
        }
        $this->insertDate($tenderData, $data);
        $tender = Tender::create($tenderData);
        if (isset($data['google_file'])) {
            $tender->saveFileGoogle($data['google_file']);
        }
        if (isset($data['files']))
            $tender->saveFiles($data->file('files'));
        if (gettype($data->get('categories')) != 'array') {
            $category = explode(' ', $data->get('categories'));

        } else {
            $category = $data->get('categories');
        }
        $tender->categories()->attach($category);
        return $tender;
    }

    /**
     * @inheritDoc
     */
    public function update($id, $data)
    {
        $tender = $this->get($id);
        $tenderData = $data->all();
        $tenderData['deadline'] = Carbon::createFromFormat('d.m.Y', $data->get('deadline'))->setHour(23)->setMinutes(59)->setSecond(59)->format('Y-m-d H:i:s');
        if (Arr::get($tenderData, 'remote') == 'on') {
            $tenderData['type'] = 'remote';
        }
        $tender->update($tenderData);
        $tender->saveFiles($data->file('files'));
        if (array_key_exists('categories', $tenderData)) {
            $tender->categories()->detach();
            foreach ($data->get('categories') as $categoryId) {
                $tender->categories()->attach($categoryId);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($id, $reason = '')
    {
        $tender = Tender::find($id);
        $tender->forceFill([
            'opened' => 0,
            'delete_reason' => $reason
        ])->save();
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        return Tender::findOrFail($id);
    }

    /**
     * @inheritDoc
     */

    public function getBySlug(string $slug)
    {
        return Tender::where('slug', $slug)->first();
    }

    /**
     * @inheritDoc
     */

    public function createRequest($data)
    {
        if (Tender::find($data['tender_id'])->checkDeadline() && TenderRequest::where('tender_id', $data->tender_id)->where('user_id', $data->user_id)->get()->first() == null) {
            return TenderRequest::create($data->all());
        } else {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function cancelRequest($requestId)
    {
        $request = TenderRequest::findOrFail($requestId);
        $request->delete();
        return $request;
    }

    /**
     * @inheritDoc
     */
    public function acceptRequest($tenderId, $requestId)
    {
        $tender = $this->get($tenderId);
        $request = TenderRequest::findOrFail($requestId);
        if ($tender->contractor) {
            return false;
        }
        abort_if($tender->owner->id !== auth()->user()->id, 401);
        $tender->contractor_id = $request->user_id;
        $tender->opened = false;
        $tender->save();
        $request->user->victories_count += 1;
        $request->user->save();
        return $request;
    }

    /**
     * @inheritDoc
     */
    public function setOwnerToTender($tenderId, $userId)
    {
        $tender = $this->get($tenderId);
        $tender->owner_id = $userId;
        $tender->save();
    }

    /**
     * @inheritDoc
     */
    public function addContractor($tenderId, $contractorId)
    {
        return TenderRequest::create([
            'user_id' => $contractorId,
            'tender_id' => $tenderId,
            'invited' => true
        ]);
    }

    /**
     * @inheritDoc
     */
    public function publishTender($tenderId)
    {
        $tender = $this->get($tenderId);
        $tender->published = true;
        $tender->published_at = now();
        $tender->save();
        return $tender;
    }

    public function contractorComplete($tenderId)
    {
        $tender = $this->get($tenderId);
        $tender->status = 'check';
        $tender->save();
        Notification::send($tender->owner, new TenderContractorFinished($tender));
    }

    public function customerCompleted($tenderId)
    {
        $tender = $this->get($tenderId);
        $tender->status = 'finished';
        $tender->opened = false;
        $tender->save();
        Notification::send($tender->contractor, new TenderCustomerFinished($tender));
    }
}
