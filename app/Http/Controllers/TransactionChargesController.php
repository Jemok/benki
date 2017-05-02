<?php

namespace App\Http\Controllers;

use App\Repos\TransactionChargeRepository;
use App\TransactionCharge;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddTransactionChargeRequest;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Get the view for displaying the app charges by admin3
     * @param TransactionChargeRepository $transactionChargeRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAppCharges(TransactionChargeRepository $transactionChargeRepository){

        if(Auth::user()->isAdminThree()){

            $charges = $transactionChargeRepository->all();

            return view('charges.app', compact('charges'));
        }

        return view('errors.404');
    }

    public function editCharge($charge_id){

        $transaction_charge = TransactionCharge::findOrFail($charge_id);


        return view('charges.update', compact('charge_id', 'transaction_charge'));

    }

    public function updateCharge(AddTransactionChargeRequest $addTransactionChargeRequest, $charge_id){

        $transaction_charge = TransactionCharge::findOrFail($charge_id);

        $transaction_charge->transaction_type       = $addTransactionChargeRequest->transaction_type;
        $transaction_charge->transaction_category   = $addTransactionChargeRequest->transaction_category;
        $transaction_charge->transaction_name       = $addTransactionChargeRequest->transaction_name;
        $transaction_charge->charge                 = $addTransactionChargeRequest->charge;

        $transaction_charge->save();


        Session::flash('flash_message', 'Charge was updated successfully');

        return redirect()->back();
    }
}
