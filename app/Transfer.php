<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    /**
     * The table used by this model
     * @var string
     *
     */
    protected $table = 'transfers';

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'user_id',
        'receiver_id',
        'transfer_amount'
    ];

    /**
     * Transfer User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
