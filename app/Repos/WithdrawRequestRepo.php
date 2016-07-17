<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/12/16
 * Time: 4:04 PM
 */

namespace App\Repos;
use App\Withdrawal_request;


class WithdrawRequestRepo {

    /**
     * @var \App\Withdrawal_request
     */
    private $model;

    /**
     * Initialize an instance of this rep
     * @param Withdrawal_request $withdrawal_request
     */
    public function __construct(Withdrawal_request $withdrawal_request){

        $this->model =$withdrawal_request;
    }


    /**
     * Add a new withdrawal request to the database
     * @param $account_id
     * @param $user_id
     * @param $request_amount
     */
    public function store($account_id, $user_id, $request_amount){

        if(Withdrawal_request::where('account_id', $account_id)->where('user_id', $user_id)->where('withdraw_status', 0)->exists()){

            Withdrawal_request::where('account_id', $account_id)->where('user_id', $user_id)->where('withdraw_status', 0)
                                ->update([

                                    'withdraw_status' => 2

                                ]);
        }

        $request = $this->model->create([
            'account_id' =>  $account_id,
            'user_id'    => $user_id,
            'request_amount' => $request_amount
        ]);

        $request->answer()->create([

            'user_id' => $user_id,
            'account_id' => $account_id,
            'status' => 1

        ]);
    }

    /**
     * Get all withdrawal requests for an account
     * @param $account_id
     */
    public function getRequests($account_id){

        return $this->model
             ->where('account_id', '=', $account_id)
             ->where('withdraw_status', '=', 0)
             ->get();
    }

    public function getLatestForUser($account_id){

        if($this->model->where('account_id', $account_id)
                           ->where('user_id', \Auth::user()->id)->exists()){

            if($this->model->where('account_id', $account_id)
                ->where('user_id', \Auth::user()->id)
                ->where('withdraw_status', '=', 0)->exists()) {
                return $this->model->where('account_id', $account_id)
                    ->where('user_id', \Auth::user()->id)
                    ->where('withdraw_status', '=', 0)
                    ->orderBy('created_at', 'desc')->first()->id;
            }

            return null;
        }

        return null;

    }
    
    public function getStatus($request_id){

        if($this->model->where('id', $request_id)->exists()) {
            return $this->model->where('id', $request_id)->first()->withdraw_status;
        }

        return null;
    }

} 