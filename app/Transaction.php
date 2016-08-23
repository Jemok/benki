<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The transaction table
     * @var string
     */
    protected $table = 'account_transactions';

    /**
     * Mass assignable fields
     * @var array
     */
    protected $fillable = [
        'transaction_type',
        'transaction_amount',
        'account_id',
        'withdraw_date',
        'deduct_amount',
        'percentage',
        'transaction_status',
        'rate_pay_count',
        'duration'
    ];

    /**
     * Current_Account Transaction relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function current_account(){

        return $this->belongsTo(Current_account::class, 'account_id');

    }

    /**
     * Transaction Transaction_records relationships
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records(){
        return $this->hasMany(Transaction_records::class, 'account_transaction_id');
    }
}
