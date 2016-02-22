<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_transactions extends Model
{
    /**
     * The table that works with this model
     * @var string
     */
    protected $table = 'account_transactions';

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'transaction_type',
        'account_id'
    ];


    /**
     * Current account transaction and current account relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function current_account(){

        return $this->belongsTo(Current_account::class);
    }
}
