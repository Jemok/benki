<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/25/16
 * Time: 3:43 PM
 */

namespace App\Repos;
use App\WithdrawRequestAnswer;


class RequestAnswerRepo {


    private $model;


    public function __construct(WithdrawRequestAnswer $withdrawRequestAnswer){

        $this->model = $withdrawRequestAnswer;

    }


    public function store($account_id, $withdraw_request_id, $user_id){

        $confirmation = $this->model->create([

            'account_id' =>  $account_id,
            'withdraw_request_id' => $withdraw_request_id,
            'user_id' =>  $user_id,
            'status' => 1

        ]);

        return $confirmation;
    }

    public function countAnswers($request_id){

        return $this->model->where('withdraw_request_id', $request_id)
                            ->count();

    }

} 