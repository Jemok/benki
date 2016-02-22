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
use App\AccountType;
use App\User;


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
     * Save a new account to the database
     * @param $request
     * @param AccountType $accountType
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store($request, AccountType $accountType){

        return $accountType->account()->create([
            'account_name'        => $request->account_name,
            //'account_description' => $request->account_description,
            'user_id'             => \Auth::user()->id
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
}