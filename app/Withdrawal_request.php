<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal_request extends Model
{
    /**
     * @var string
     */
    protected $table = 'withdraw_requests';

    /**
     * Fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'request_amount',
        'user_id',
        'account_id'

    ];
}
