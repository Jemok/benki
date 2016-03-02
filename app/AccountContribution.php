<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountContribution extends Model
{

    /**
     * Account contributions table
     * @var string
     */
    protected $table = 'account_contributions';

    /**
     * The fields that ca
     * @var array
     */
    protected $fillable = [

        'account_id',
        'user_id',
        'amount'
    ];
}
