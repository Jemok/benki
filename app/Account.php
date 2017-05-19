<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The mass assigned fields
     * @var array
     */
    protected $fillable = [
        'account_name',
        'account_description',
        'user_id',
        'account_status'
    ];

    /**
     * Return an account's name
     * @param Account_user $account_user
     * @return mixed
     */
    public function accountName(Account_user $account_user){

        return $this
            ->where('id', $account_user->account_id)
            ->first()
            ->account_name;
    }

    /**
     * Return an account's name from an account_id
     * @param $account_id
     * @return mixed
     */
    public function accountNameFromId($account_id){
        return $this
            ->where('id', $account_id)
            ->first()
            ->account_name;
    }

    /**
     * Account Account_Amount relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function amount(){

        return $this->hasOne(Account_amount::class);

    }

    /**
     * Account Account_request relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function request(){

        return $this->hasMany(AccountRequest::class);
    }

    /**
     * Account AccountRequest relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account_requests(){
        return $this->hasMany(AccountRequest::class);
    }


}
