<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRate extends Model
{

    protected $table = 'account_rates';

    protected $fillable = [

        'category_one',
        'category_two',
        'category_three',
        'category_four'
    ];
}
