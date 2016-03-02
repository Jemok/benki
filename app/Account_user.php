<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_user extends Model
{
    /**
     * This model table
     * @var string
     */
    protected $table = 'account_users';

    /**
     * Fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'user_id',
        'account_id',
        'status'

    ];

    /**
     * Users Account Users relationship
     */
    public function user(){

        $this->belongsTo(User::class, 'user_id');

    }

    /**
     * Account user Account relationship
     */
    public function account(){

        $this->belongsTo(Account::class, 'account_id');

    }

    public function checkIfMember($user_id){

        if($this->where('user_id', $user_id)->first() == null){

            return false;
        }

        return true;
    }

}
