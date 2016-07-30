<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentRecord extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'current_records';

    /**
     * Fields that might be mass assigned
     * @var array
     */
    protected $fillable = [

        'amount'

    ];

    /**
     * CurrentRecord Current_Account relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function current(){

        return $this->belongsTo(Current_account::class);

    }
}
