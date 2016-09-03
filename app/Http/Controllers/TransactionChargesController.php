<?php

namespace App\Http\Controllers;

use App\Repos\TransactionChargeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddTransactionChargeRequest;
use Illuminate\Support\Facades\Session;

class TransactionChargesController extends Controller
{
    /**
     * Persist a new transaction charge to the database
     * @param AddTransactionChargeRequest $addTransactionChargeRequest
     * @param TransactionChargeRepository $transactionChargeRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddTransactionChargeRequest $addTransactionChargeRequest, TransactionChargeRepository $transactionChargeRepository){

        $transactionChargeRepository->store($addTransactionChargeRequest);

        Session::flash('flash_message', 'The Transaction Charge was added successfully');

        return redirect()->back();
    }
}
