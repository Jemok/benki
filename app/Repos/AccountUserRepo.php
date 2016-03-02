<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/11/16
 * Time: 10:38 AM
 */

namespace App\Repos;
use App\Account;
use App\Account_user;
use Illuminate\Foundation\Auth\User;
use App\AccountRequest;


class AccountUserRepo {

    /**
     * Accout_user Model
     * @var
     */
    private $model;

    /**
     * Initialize an instance of this repo
     */
    public function __construct(Account_user $account_user){

        $this->model = $account_user;
    }

    /**
     * Find an account from its id
     * @param $account_id
     */
    public function findAccount($account_id){

       return $this->model->findOrFail($account_id);
    }

    /**
     * @param Account $account
     * @param User $user
     */
    public function store(Account $account, User $user){

        $this->model->create([
            'account_id' => $account->id,
            'user_id'    => $user->id,
            'status'     => 1
        ]);



       $this->updateRequest($account, $user);
    }

    /**
     * Set a request as having been confirmed
     * @param $account
     * @param $user
     */
    public function updateRequest($account, $user){

       if(AccountRequest::where('account_id', '=', $account->id)
                                  ->where('user_id', '=', $user->id)
                                  ->first() != null){

          $request = AccountRequest::where('account_id', '=', $account->id)
               ->where('user_id', '=', $user->id)
               ->first();

           $request->update([

               'confirmation_status' => 1

           ]);

       }


    }

    /**
     * Return all accounts that belong to a user
     * @param User $user
     * @return mixed
     */
    public function showForUser(User $user){

        return $user_accounts =$this->model
               ->where('user_id', $user->id)
               ->where('status', '=', 1)
               ->get();
    }


    /**
     * Gets all the users who do not belong to an account
     * @param $account_id
     * @return mixed
     */

    public function getMembersNotInAccount($account_id){

        $members_in = $this->model->where('account_id', $account_id)->lists('user_id');

        return $members_not = User::whereNotIn('id', $members_in)->get();
    }

    /**
     * Return all users who belong to an account
     * @param $account_id
     * @return mixed
     */
    public function getMembersInAccount($account_id){

        $members_id = $this->model->where('account_id', $account_id)->lists('user_id');

        return User::whereIn('id', $members_id)->latest()->get();

    }

    /**
     * Remove a user from an account
     * @param $account_id
     * @param $user_id
     * @return mixed
     */
    public function destroy($account_id, $user_id){

        return $this->model->where('account_id', $account_id)
                           ->where('user_id', $user_id)->delete();

    }

} 