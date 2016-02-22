<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_amount extends Model
{
    protected $table = 'account_amounts';

    protected $fillable = [

        'account_id',
        'amount'
    ];

    /**
     * Account Account Amounts relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(){

        return $this->belongsTo(Account::class);

    }
}
