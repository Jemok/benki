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
        'account_id',
        'status'
    ];


    public function check($account_id, $user_id){

        if($this->where('account_id', '=', $account_id)->where('user_id', '=', $user_id)->where('status', 0)->first() != null){

            return $this->where('account_id', '=', $account_id)->where('user_id', '=', $user_id)->orderBy('created_at','desc')->first();

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
