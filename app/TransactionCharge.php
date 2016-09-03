<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionCharge extends Model
{
    /**
     * The table used by this model
     * @var string
     */
    protected $table = 'transaction_charges';

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [
        'transaction_type',
        'transaction_name',
        'transaction_category',
        'charge'
    ];

    /**
     * The TransactionCharge User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
