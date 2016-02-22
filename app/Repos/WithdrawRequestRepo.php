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

        $this->model->create([
            'account_id' =>  $account_id,
            'user_id'    => $user_id,
            'request_amount' => $request_amount
        ]);
    }

} 