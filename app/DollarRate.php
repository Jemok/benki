<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DollarRate extends Model
{
    /**
     *The table used by this model
     * @var string
     */
    protected $table = 'dollar_rates';

    /**
     * @var array
     */
    protected $fillable = [

        'rate'

    ];

    /**
     * DollarRate User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->belongsTo(User::class);
    }
}
