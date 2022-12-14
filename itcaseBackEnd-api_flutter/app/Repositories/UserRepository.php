<?php


namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Models\FormMultipleUpload;
use App\Models\Comment;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

use App\Notifications\RequestAction;
use App\Notifications\InviteRequest;
use App\Notifications\NewRequest;
use App\Notifications\TenderContractorFinished;
use App\Notifications\TenderCreated;
use App\Notifications\TenderPublished;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Get all users
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    public function createTransaction(int $user_id, int $transaction_id)
    {
        return Transaction::create(
            [
                'user_id' => $user_id,
                'transaction_id' => $transaction_id,
            ]
        );
    }

    public function createUniqueTransaction(int $user_id)
    {
        $trans = Transaction::where('user_id', '=', $user_id)->first();
        if ($trans) {
            return $trans->transaction_id;
        } else {
            $transaction_id = mt_rand(1, 2147483647);
            while (Transaction::where('transaction_id', '=', $transaction_id)->exists()) {
                $transaction_id = mt_rand(1, 2147483647);
            }
            $this->createTransaction($user_id, $transaction_id);
            return $transaction_id;
        }
    }

    public function findTransaction($transaction_id): Transaction
    {
        $transaction = Transaction::where('transaction_id', '=', $transaction_id)->first();
        if ($transaction) {
            return $transaction;
        }
        throw new \Exception();
    }

    public function categoriesContractors($request)
    {
        $categories = $request->categories ?? [];
        $result = User::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('user_category.category_id', $categories)->orWhereIn('handbook_categories.parent_id', $categories);
        })->paginate();
        return $result;
    }

    public function searchContractors($search)
    {

        $users = User::whereRaw('CONCAT(first_name, " ", last_name) like ?', ['%' . $search->contractorSearch . '%'])->get();
        return $users->filter(function ($user) {
            return $user->hasRole('contractor');
        });
    }

    public function searchContractorsByName($search)
    {

        $users = User::whereRaw('CONCAT(first_name, " ", last_name) like ?', ['%' . $search . '%'])->get();
        return $users->filter(function ($user) {
            return $user->hasRole('contractor');
        });
    }
    //$allUsers = User::all();
    // return $allUsers->filter(function ($user) { return $user->hasRole('contractor'); });

    /**
     * Get user by it's id
     *
     * @param int $userId
     * @return User
     */
    public function get($userId)
    {
        return User::findOrFail($userId);
    }

    /**
     * Create an User
     *
     * @param \Illuminate\Http\Request $userData
     * @param int $userRoleId
     * @return void
     */
    public function create($userData, $userRoleId)
    {
        $role = Role::findOrFail($userRoleId);
        $data = [
            'first_name' => $userData->get('name'),
            'email' => $userData->get('email'),
            'password' => Hash::make($userData->get('password'))
        ];
        $user = User::create($data);
        $user->roles()->attach($role);
        $user->save();
        $user->generateSlug();
        $user->uploadImage($userData->file('image'));
    }

    /**
     * Update an user
     *
     * @param int $userId
     * @param \Illuminate\Http\Request $userData
     * @return void
     */
    public function update($userId, $userData)
    {
        $user = $this->get($userId);
        $data = $userData->all();
        if (isset($data['birthday_date'])) {
            $data['birthday_date'] = Carbon::createFromFormat('d.m.Y', $data['birthday_date'])->format('Y-m-d');
        }
        if ($data['phone_number'] != $user->phone_number) {
            $user->phone_confirmed_at = null;
        }
        $user->update($data);
        $user-> sendPhoneVerificationMessage();
        $user->generateSlug();
        $user->uploadImage($userData->file('image'));
        $user->uploadResume($userData->file('resume'));
        $user->save();
    }

    /**
     * Delete user
     *
     * @param int $userId
     * @return void
     */
    public function delete($userId)
    {
        User::destroy($userId);
    }

    /**
     * Get all users with role 'admin'
     *
     * @return mixed
     */
    public function getAdmins()
    {
        $role = Role::where('name', 'admin')->first();
        return $role->users;
    }

    /**
     * Get all users with role 'customer'
     *
     * @return mixed
     */
    public function getCustomers()
    {
        $role = Role::where('name', 'customer')->first();
        return $role->users;
    }

    /**
     * Get all roles
     *
     * @return array
     */
    public function allRoles()
    {
        return Role::all();
    }

    /**
     * @inheritDoc
     */
    public function getContractors()
    {
        $allUsers = User::all();
        return $allUsers->filter(function ($user) {
            return $user->hasRole('contractor');
        });
    }


    /**
     * @inheritDoc
     */
    public function getContractorBySlug(string $slug)
    {
        return $this->getContractors()->first(function ($user) use ($slug) {
            return $user->slug === $slug;
        });
    }


    public function getPortfolio(string $slug)
    {
        $allPortfolio = FormMultipleUpload::where('slug', $slug)->get();
        return $allPortfolio;
    }

    public function getPortfolioBySlug(string $slug)
    {
        return $this->getPortfolio($slug)->all(function ($user) use ($slug) {
            return $user->slug === $slug;
        });
    }

    public function getComments(int $user_id)
    {
        $allComments = Comment::where('for_set', $user_id)->whereNotNull('comment')->get();
        return $allComments;
    }

    /**
     * @inheritDoc
     */
    public function createAccount($data)
    {
        $user = auth()->user();
        $userRole = $data->get('user_role');
        $role = Role::where('name', $userRole)->first();
        $user->roles()->attach($role->id);
        $dataToSet = [];
        $dataToSet['first_name'] = $user->first_name ?? $data->get($userRole . '_first_name');
        $dataToSet['last_name'] = $user->last_name ?? $data->get($userRole . '_last_name');
        $dataToSet['phone_number'] = $data->get($userRole . '_phone_number');
        $dataToSet[$userRole . '_type'] = $data->get($userRole . '_type');
        $dataToSet['email'] = $data->get($userRole . '_email');
        $dataToSet['company_name'] = $data->get($userRole . '_company_name');
        $dataToSet['about_myself'] = $data->get($userRole . '_about_myself');
        $dataToSet['city'] = $data->get($userRole . '_city');
        if (($data->has('gender') && $data->has($userRole . '_birthday_date'))
            || ($userRole == 'contractor' && $data->get($userRole . '_type') == 'individual')) {
            $dataToSet['birthday_date'] = Carbon::createFromFormat('d.m.Y', $data->get($userRole . '_birthday_date'))->format('Y-m-d');
            $dataToSet['gender'] = $data->get('gender');
        }
        $user->update($dataToSet);
        $user->completed = true;
        $user->phone_confirmed_at = null;
        $user->save();
        $user->generateSlug();
        $user->uploadImage($data->file('image'));
        $user->sendPhoneVerificationMessage();
    }

    /**
     * @inheritDoc
     */
    public function createUserViaTelegram($data)
    {
        $telegramId = $data->get('id');
        $username = $data->get('username');
        $user = User::create([
            'first_name' => $data->get('first_name'),
            'last_name' => $data->get('last_name'),
            'telegram_id' => $telegramId,
            'telegram_username' => $username,
            'email' => '',
            'password' => ''
        ]);
        $user->generateSlug();
        return $user;
    }

    public function getType($type)
    {
        if ($type == InviteRequest::class) {
            return 0;
        } else if ($type == NewRequest::class) {
            return 1;
        } else if ($type == RequestAction::class) {
            return 2;
        } else if ($type == TenderContractorFinished::class) {
            return 3;
        } else if ($type == TenderCreated::class) {
            return 4;
        } else if ($type == TenderPublished::class) {
            return 5;
        }
    }

    /**
     * @inheritDoc
     */
    public function getUserByTelegramId(int $telegramId)
    {
        return User::where('telegram_id', $telegramId)->first();
    }
}
