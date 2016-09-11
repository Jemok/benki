<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/11/16
 * Time: 5:33 AM
 */

namespace App\Repos;

use App\DollarRate;
use Illuminate\Support\Facades\Auth;


class DollarRateRepository
{
    /***
     * The Model for this repository
     * @var
     */
    protected $model;

    /**
     * DollarRateRepository constructor.
     * @param DollarRate $dollarRate
     */
    public function __construct(DollarRate $dollarRate)
    {
        $this->model = $dollarRate;
    }

    /**
     * Persist a dollar rate to the database
     * @param $request
     */
    public function store($request){

        Auth::user()->dollar()->create([

            'rate' => $request->dollar_rate
        ]);
    }

    public function getPrevious(){

        return $this->model->paginate(10);

    }
}