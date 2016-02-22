<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Current_account extends Model
{
    /**
     * The current account table
     * @var string
     */
    protected $table = 'current_accounts';


    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'account_amount',
        'user_id'
    ];


    /**
     * Current_account and current_account_transactions relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(){

        return $this->hasMany(Account_transactions::class);

    }

    /**
     * Cureent_account and user relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->belongsTo(User::class);
    }
}
