<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_records extends Model
{
    /**
     * The model used by this table
     * @var string
     */
    protected $table = 'transaction_records';

    /**
     * The fields that might may be mass assigned
     * @var array
     */
    protected $fillable = [
        'amount'
    ];

    /**
     * Transaction_records Transaction relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactions(){
        return $this->belongsTo(Transaction::class);
    }
}
