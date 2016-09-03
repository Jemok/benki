<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/3/16
 * Time: 10:50 AM
 */

namespace App\Repos;

use App\TransactionCharge;
use App\TransactionPayment;


class TransactionPaymentRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * TransactionPaymentRepository constructor.
     * @param TransactionPayment $transactionPayment
     */
    public function __construct(TransactionPayment $transactionPayment)
    {
        $this->model = $transactionPayment;
    }

    /**
     * @param $transaction_charge_id
     * @param $owner_id
     * @param $transaction_id
     * @param $payment
     */
    public function store($transaction_charge_id, $owner_id, $transaction_id, $payment){
        $this->model->create([
            'transaction_charge_id' => $transaction_charge_id,
            'owner_id'              => $owner_id,
            'transaction_id'        => $transaction_id,
            'payment'               => $payment
        ]);
    }
}