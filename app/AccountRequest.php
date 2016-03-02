<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRequest extends Model
{
    /**
     * The table that is linked to this model
     * @var string
     */

    protected $table = 'account_requests';


    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'account_id',
        'user_id',
        'confirmation_status'

    ];

    /**
     * Account Account Request relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(){

        return $this->belongsTo(Account::class);
    }

    /**
     * Check if a user has a request in a particular account
     * @param $user_id
     */
    public function checkUserRequest($user_id, $account_id){

        if($this->where('user_id', '=', $user_id)->where('account_id', '=', $account_id)->first() != null){

            $query = $this->where('user_id', '=', $user_id)->where('account_id', '=', $account_id)->first();

            $confirmation = $query->confirmation_status;

            if($confirmation == 0){

                return 0;
            }elseif($confirmation == 1){

                return 1;
            }

        }else{

            return 2;
        }

    }


}
