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
        'name', 'email', 'password',
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
     * User and Current_account relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function current_account(){

        return $this->hasOne(Current_account::class);

    }
}