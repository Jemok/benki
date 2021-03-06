<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'password', 'userCategory',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User Account_user relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts(){

        return $this->hasMany(Account_user::class);
    }

    /**
     * User Transfer relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfers(){
        return $this->hasMany(Transfer::class);
    }

    /**
     * User and Current_account relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function current_account(){

        return $this->hasOne(Current_account::class);

    }

    /**
     * Check if a user is an admin
     * @return bool
     */
    public function isAdmin(){
        if($this->userCategory == 1){
            return true;
        }
    }

    /**
     * Check if a user is an admin 2
     * @return bool
     */
    public function isAdminTwo(){

        if($this->userCategory == 2){
            return true;
        }
    }
    /**
     * Check if a user is an admin 3
     * @return bool
     */
    public function isAdminThree(){

        if($this->userCategory == 3){
            return true;
        }
    }

    /**
     * Return $this name from an id
     * @param $user_id
     * @return mixed
     */
    public function userName($user_id)
    {
        return $this->where('id', '=', $user_id)->first()->name;
    }

    /**
     * User TransactionCharge relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction_charges(){
        return $this->hasMany(TransactionCharge::class);
    }

    /**
     * User DollarRate relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dollar(){

        return $this->hasMany(DollarRate::class);
    }

    public function contributions(){

        return $this->hasMany(AccountContribution::class);
    }
}
