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
            'user_id'    => $user->id
        ]);

    }

    /**
     * Return all accounts that belong to a user
     * @param User $user
     * @return mixed
     */
    public function showForUser(User $user){

        return $user_accounts =$this->model
               ->where('user_id', $user->id)
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