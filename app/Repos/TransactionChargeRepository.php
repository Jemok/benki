<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/3/16
 * Time: 9:59 AM
 */

namespace App\Repos;
use App\TransactionCharge;
use Illuminate\Support\Facades\Auth;


class TransactionChargeRepository
{
    /**
     * The model for this repository
     * @var
     */
    protected $model;

    /**
     * TransactionChargeRepository constructor.
     * @param TransactionCharge $transactionCharge
     */
    public function __construct(TransactionCharge $transactionCharge)
    {
        $this->model = $transactionCharge;
    }

    /**
     * Persist a transaction charge to the database
     * @param $request
     */
    public function store($request){
        Auth::user()->transaction_charges()->create([
            'transaction_type' => $request->transaction_type,
            'transaction_name' => $request->transaction_name,
            'transaction_category' => $request->transaction_category,
            'charge'           => $request->charge
        ]);
    }
}