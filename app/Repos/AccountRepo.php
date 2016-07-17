<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/10/16
 * Time: 8:31 PM
 */

namespace App\Repos;
use App\Account;
use App\Account_user;
use App\AccountContribution;
use App\AccountType;
use App\Current_account;
use App\User;
use App\AccountRate;
use App\WithdrawRequestAnswer;


class AccountRepo {

    /**
     * Account model
     * @var
     */
    private $model;

    /**
     * Initialize an instance of this repo
     * @param Account $account
     */
    public function __construct(Account $account){

        $this->model = $account;
    }


    /**
     * Get all accounts in the database
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(){

        return $this->model->where('account_status', '=', 1)->get();
    }

    /**
     * Save a new account to the database
     * @param $request
     * @param AccountType $accountType
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store($request, AccountType $accountType){

        return $accountType->account()->create([
            'account_name'        => $request->account_name,
            //'account_description' => $request->account_description,
            'user_id'             => \Auth::user()->id,
            'account_status'      => 1
        ]);
    }

    /**
     * Retrieve a single account from the database
     * @param $account_id
     * @return mixed
     */
    public function show($account_id){

        return $this->model->where('id', $account_id)
                    ->with('amount')->first();
    }

    public function updateRates($request){

      $rate =  AccountRate::where('id', '=', 1)->first();

      $rate->update([

          'category_one' =>  $request->category_one,
          'category_two' =>  $request->category_two,
          'category_three' =>  $request->category_three,
          'category_four'  =>  $request->category_four

      ]);

    }

    public function getConfirmation($request_id){

        $confirmed = WithdrawRequestAnswer::where('withdraw_request_id', '=', $request_id)->get();

        return $confirmed;
    }


    public function deleteAccount($account_id){

        $account = $this->model->where('id', $account_id)->first();

        $contributions = AccountContribution::where('account_id', $account_id)->get();

        foreach($contributions as $contribution){

            $current_account = Current_account::where('user_id', '=', $contribution->user_id)->first();

            $account_amount = $current_account->account_amount;


            $current_account->update([

                'account_amount' => $account_amount + $contribution->amount

            ]);

        }


        $account->update([

            'account_status' => 2

        ]);

        Account_user::where('account_id', '=', $account_id)->update([

            'status' =>  2

        ]);




    }
}