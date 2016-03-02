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

        $request = $this->model->create([
            'account_id' =>  $account_id,
            'user_id'    => $user_id,
            'request_amount' => $request_amount
        ]);

        $request->answer()->create([

            'user_id' => $user_id,
            'account_id' => $account_id

        ]);
    }

    /**
     * Get all withdrawal requests for an account
     * @param $account_id
     */
    public function getRequests($account_id){

        return $this->model
             ->where('account_id', '=', $account_id)
             ->get();
    }

    public function getLatestForUser($account_id){

        if($this->model->where('account_id', $account_id)
                           ->where('user_id', \Auth::user()->id)->first()
                            != null){

           return $this->model->where('account_id', $account_id)
                ->where('user_id', \Auth::user()->id)
                ->orderBy('created_at','desc')->first()->id;
        }

    }

} 