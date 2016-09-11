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

        return $this->payments_model->whereRaw('date(created_at) = ?', [$request->profit_date])
                                    ->get();
    }

    public function getProfitForDayTransfers($request){

        return $this->payments_model->where('transaction_type', '=', 1)->whereRaw('date(created_at) = ?', [$request->profit_date])
            ->get();
    }

    public function getProfitForDayWithdrawals($request){

        return $this->payments_model->where('transaction_type', '=', 2)->whereRaw('date(created_at) = ?', [$request->profit_date])
                ->get();
    }


}