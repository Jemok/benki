<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/25/16
 * Time: 10:29 AM
 */

namespace App\Repos;
use App\AccountRequest;
use App\User;




class AccountRequestRepo {

    /**
     * @var \App\AccountRequest
     */
    private $model;

    /**
     * @param AccountRequest $accountRequest
     */
    public function __construct(AccountRequest $accountRequest){

        $this->model = $accountRequest;
    }

    /**
     * @param $account_id
     * @param $user_id
     * @return static
     */
    public function sendRequest($account_id, $user_id){

       return $this->model->create([
            'account_id' =>  $account_id,
            'user_id'    => $user_id,
            'confirmation_status' => 0
        ]);
    }

    /**
     * @param $user_id
     * @param $account_id
     */
    public function getConfirmationStatus($user_id, $account_id){

        if($this->model
                    ->where('account_id', '=', $account_id)
                    ->where('user_id', '=', $user_id)
                    ->first() != null){

            return $this->model
                ->where('account_id', '=', $account_id)
                ->where('user_id', '=', $user_id)
                ->first()
                ->confirmation_status;

        }else{

            return 2;
        }
    }

    /**
     * Get all the requests that have been sent to an account
     */
    public function getRequestsForAccount($account_id){

        if($this->model
                ->where('account_id', '=', $account_id)
                ->where('confirmation_status', '=', 0)
                ->first() != null){

            $requests_id =$this->model
                ->where('account_id', '=', $account_id)
                ->where('confirmation_status', '=', 0)
                ->lists('user_id');

            return User::whereIn('id', $requests_id)->latest()->get();

        }else{
            return null;
        }
    }
}
