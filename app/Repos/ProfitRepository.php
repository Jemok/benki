<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/11/16
 * Time: 7:15 AM
 */

namespace App\Repos;
use App\TransactionPayment;


class ProfitRepository
{

    /**
     * @var
     */
    protected $payments_model;

    public function __construct(TransactionPayment $transactionPayment)
    {
        $this->payments_model = $transactionPayment;
    }

    public function getProfitForDay($request){


        return $this->payments_model->whereRaw('date(created_at) = ?', [$request->profit_date])->get();


    }

}