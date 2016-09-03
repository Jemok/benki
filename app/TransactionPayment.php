<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    /**
     * The table used by this model
     * @var string
     */
    protected $table = 'transaction_payments';

    /**
     *  All the fields that can be mass assigned
     * @var array
     */
    protected $fillable = [
        'transaction_charge_id',
        'owner_id',
        'transaction_id',
        'payment'
    ];

    /**
     * TransactionPayment TransactionChargeRepository
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction_charge(){

        return $this->belongsTo(TransactionCharge::class);
    }
}
