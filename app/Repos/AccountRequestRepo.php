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
use App\Account_amount;
use App\Withdrawal_request;
use App\WithdrawRequestAnswer;




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

    public function getForUser($user_id){

        return $this->model
                    ->where('user_id', $user_id)
                    ->where('confirmation_status', 0)
                    ->get();
    }

    public function withdraw($account_id, $user_id){

        $account = Account_amount::where('id', $account_id)->first();

        $account_request = Withdrawal_request::where('account_id', $account_id)
                                               ->where('user_id', $user_id)
                                               ->orderBy('created_at','desc')->first();

//        $request_answer = WithdrawRequestAnswer::where('user_id', $user_id)
//                                                 ->where('account_id', $account_id)
//                                                 ->orderBy('created_at','desc')->first();


        $account_amount = $account->amount;


//        WithdrawRequestAnswer::where('account_id', $account_id)
//                               ->update([
//
//                'status' => 1
//
//            ]);



        $request_amount = $account_request->request_amount;

//        $request_answer->create([
//
//            'user_id' => \Auth::user()->id,
//            'account_id' => 3,
//            'withdraw_request_id' => 1
//
//        ]);

        $account->update([

            'amount' =>  ($account_amount - $request_amount)

        ]);

        Withdrawal_request::where('account_id', $account_id)
                            ->where('user_id', '=', \Auth::user()->id)
                            ->where('withdraw_status', '=', 0)
                            ->orderBy('created_at','desc')
                            ->update([

                                'withdraw_status' => 1

                            ]);

        $current_amount = \Auth::user()->current_account()->first()->account_amount;

        \Auth::user()->current_account()->update([


            'account_amount' => $current_amount + $request_amount

        ]);

    }
}
