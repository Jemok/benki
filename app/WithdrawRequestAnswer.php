<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequestAnswer extends Model
{

    protected $table = 'withdraw_answers';
    /**
     * @var array
     */
    protected $fillable = [

        'user_id',
        'withdraw_request_id',
        'account_id'
    ];


    public function check($account_id, $user_id){

        if($this->where('account_id', '=', $account_id)->where('user_id', '=', $user_id)->first() != null){

            return $this->where('account_id', '=', $account_id)->where('user_id', '=', $user_id)->first();

        }else{

            return null;
        }

    }

    /**
     * Withdraw request request answer relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request(){

        return $this->belongsTo(Withdrawal_request::class);
    }



}
