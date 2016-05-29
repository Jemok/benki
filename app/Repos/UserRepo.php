<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/11/16
 * Time: 3:16 PM
 */

namespace App\Repos;
use App\User;

class UserRepo{

    /**
     * The User Model
     * @var \App\User
     */

    private $model;

    /**
     * Initialize an instance of this model
     * @param User $user
     */
    public function __construct(User $user){

        $this->model = $user;

    }

    /**
     * Get a user from the user model using their email
     */
    public function findUserByEmail($email){

       if($this->model->where('email', '=', $email)->first() == null){

           return false;

       }else{

           return $this->model->where('email', $email)->first();
       }

    }

    public function allExceptAdmin(){

        return $this->model->where('userCategory', '=', 0)->where('id', '!=', \Auth::user()->id)->get();

    }
} 