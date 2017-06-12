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
use App\Transaction;
use App\Transaction_records;
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

    public function getAccounts($user_id){

        if(Account_user::where('user_id', $user_id)->exists()){

            return Account_user::where('user_id', $user_id)->paginate(10);

        }else{

            return null;
        }
    }

    public function getUserSavings($user_id){

        $user = User::findOrFail($user_id);

        if($user->current_account()->exists()) {
            $account_id = $user->current_account()->first()->id;
        }else{
            $account_id = 0;
        }
        if(Transaction::where('account_id', $account_id)->exists()){
            return Transaction::where('account_id', $account_id)->where('transaction_type', 2)->paginate(10);
        }else{
            return null;
        }
    }

    public function getUserFixedAmountSavings($user_id){

        $user = User::findOrFail($user_id);

        if($user->current_account()->exists()) {
            $account_id = $user->current_account()->first()->id;
        }else{
            $account_id = 0;
        }
        if(Transaction::where('account_id', $account_id)->exists()){
            return Transaction::where('account_id', $account_id)->where('transaction_type', 3)->paginate(10);
        }else{
            return null;
        }
    }

    public function getSavingsRecords($savings_id){

        if(Transaction_records::where('account_transaction_id', '=', $savings_id)->exists()){

            return Transaction_records::where('account_transaction_id', '=', $savings_id)->paginate(10);

        }else{
            return null;
        }
    }

    public function getFixedRecords($user_id){

        $user = User::findOrFail($user_id);

        if($user->current_account()->exists()) {
            $account_id = $user->current_account()->first()->id;
        }else{
            $account_id = 0;
        }
        if(Transaction::where('account_id', $account_id)->exists()){
            return Transaction::where('account_id', $account_id)->where('transaction_type', 1)->paginate(10);
        }else{
            return null;
        }
    }
}