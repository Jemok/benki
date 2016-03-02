<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRate extends Model
{

    protected $table = 'account_rates';

    protected $fillable = [

        'fixed',
        'savings'
    ];
}
