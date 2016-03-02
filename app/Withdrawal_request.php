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

    /**
     * User withdraw request relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->belongsTo(User::class);

    }

    /**
     * Withdraw request answer withdraw request relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answer(){

        return $this->hasMany(WithdrawRequestAnswer::class, 'withdraw_request_id');

    }


}
