<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/12/16
 * Time: 2:51 PM
 */

namespace App\Repos;
use App\Account;
use App\Account_amount;
use App\User;


class AccountAmountRepo {

    /**
     * The Account_amount model
     * @var \App\Account_amount
     */
    protected $model;

    public function __construct(Account_amount $account_amount){

        $this->model = $account_amount;

    }

    /**
     * @param Account $account
     * @return static
     */
    public function store(Account $account){

        return $this->model->create([

            'account_id' => $account->id,

        ]);
    }

    /**
     * @param Account $account
     * @param $amount
     * @return bool|int
     */
    public function deposit(Account $account, $amount){

        $account_amount = $this->model->where('account_id', $account->id)->first();

        $account_amount->update([

            'amount' => ($account_amount->amount) + $amount

        ]);
    }

    /**
     * @param User $user
     * @param $request
     */
    public function depositCurrent(User $user, $request){

        $user->current_account()->update([

            'account_amount' =>  ($user->current_account()->first()->account_amount)+$request->amount

        ]);

    }

    /**
     * @param $account_id
     * @return mixed
     */
    public function getAmount($account_id){

        return $this->model->where('account_id', $account_id)
                    ->first()->amount;
    }

} 