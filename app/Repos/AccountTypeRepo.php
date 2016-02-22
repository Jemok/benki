<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/10/16
 * Time: 5:08 PM
 */

namespace App\Repos;
use App\AccountType;


class AccountTypeRepo {

    /**
     * Holds AccountType model Instance
     * @var \App\AccountType
     */
    private $model;

    /**
     * Initializes this repo instance
     * @param AccountType $accountType
     */
    public function __construct(AccountType $accountType){

        $this->model = $accountType;
    }

    /**
     * Retrieves all the account types from model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(){

        return $this->model->all();
    }

    /**
     * Return a collection of an AccountType
     * @param $account_type_id
     * @return mixed
     */
    public function getAccountType($account_type_id){

        return $this->model->findOrFail($account_type_id);
    }

} 