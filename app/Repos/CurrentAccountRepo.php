<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/22/16
 * Time: 9:39 AM
 */

namespace App\Repos;
use App\Current_account;

class CurrentAccountRepo {

    /**
     * @var \App\Current_account
     */
    private $model;

    /**
     * @param Current_account $current_account
     */
    public function __construct(Current_account $current_account){

        $this->model = $current_account;

    }

    /**
     * @param $request
     */
    public function deductForFixed($request){

        $current_account = $this->model->where('user_id', '=', \Auth::user()->id)->first();

        $current_account->update([

            'account_amount' =>  ($current_account->account_amount - $request->amount)
        ]);
    }

} 