<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/11/16
 * Time: 3:22 PM
 */

namespace App\Services;
use App\Account_user;


class Validate {

    /**
     * @var \App\User
     */
    private $account_user;

    /**
     * @param Account_user $account_user
     */
    public function __construct(Account_user $account_user){

        $this->account_user = $account_user;
    }

    /**
     * @param $user
     * @param $account_id
     * @return bool
     */
    public function validateUser($user, $account_id){

        if($this->account_user->where('user_id', $user->id)
            ->where('account_id', $account_id)
            ->first() != null
        ){

            return true;

        }else{

            return false;
        }

    }

} 