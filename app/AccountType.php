<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    /**
     * AccountType Account relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account(){

        return $this->hasMany(Account::class);

    }


}
