<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/2/16
 * Time: 11:45 AM
 */

namespace App\Repos;
use App\Current_account;
use App\Transfer;


class TransferUsersRepo {

    /**
     * The model used by this repo
     * @var
     */
    private $model;

    /**
     * This class constructor initializer
     * TransferUsersRepo constructor.
     * @param Transfer $transfer
     */
    public function __construct(Transfer $transfer){

        $this->model = $transfer;

    }

    /**
     * Create a new transfer instance
     * @param $transfer_amount
     * @param $receiver_id
     * @param $user_id
     */
    public function store($transfer_amount, $receiver_id ,$user_id){

        foreach ($receiver_id as $receiver) {

            $this->model->create([

                'transfer_amount' => $transfer_amount,
                'receiver_id' => $receiver,
                'user_id' => $user_id
            ]);


            $current_account_user = Current_account::where('user_id', '=', $user_id)->first();

            $account_amount_user = $current_account_user->account_amount;

            $current_account_receiver = Current_account::where('user_id', '=', $receiver)->first();

            $account_amount_receiver = $current_account_receiver->account_amount;

            $current_account_user->update([

                'account_amount' => $account_amount_user - $transfer_amount

            ]);

            $current_account_receiver->update([

                'account_amount' => $account_amount_receiver + $transfer_amount
            ]);
        }

    }
} 