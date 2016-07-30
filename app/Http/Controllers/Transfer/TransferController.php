<?php

namespace App\Http\Controllers\Transfer;

use App\Repos\TransferRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\TransferUsersRepo;
use App\Http\Requests\TransferUserRequest;
use Illuminate\Support\Facades\Session;

class TransferController extends Controller
{
    public function store(TransferUsersRepo $transferUsersRepo, TransferUserRequest $transferUserRequest ){
        $transferUsersRepo->store($transferUserRequest->transfer_amount, $transferUserRequest->transfer_to, \Auth::user()->id);
        Session::flash('flash_message', 'The transfer was successful');
        return redirect()->back();
    }

    public function getReceived($user_id, TransferRepo $transferRepo){

       $received = $transferRepo->getReceived($user_id);

       if($received == null){

           $received_count = 0;

       }else{

           $received_count = 1;
       }

       return view('user.received', compact('received', 'received_count'));

    }

    public function getSent($user_id, TransferRepo $transferRepo){

        $sent = $transferRepo->getSent($user_id);

        if($sent == null){

            $sent_count = 0;

        }else{

            $sent_count = 1;
        }

        return view('user.sent', compact('sent', 'sent_count'));
    }

    public function getWithdrawals($user_id, TransferRepo $transferRepo){

        $withdrawals = $transferRepo->getWithdrawals($user_id);

        if($withdrawals == null){

            $withdrawals_count = 0;
        }else{

            $withdrawals_count = 1;
        }

        return view('user.withdrawals', compact('withdrawals', 'withdrawals_count'));

    }

    public function getDeposits($user_id, TransferRepo $transferRepo){

        $deposits = $transferRepo->getDeposits($user_id);

        if($deposits == null){

            $deposits_count = 0;
        }else{

            $deposits_count = 1;
        }

        return view('user.chama_deposits', compact('deposits', 'deposits_count'));
    }

    public function getCurrents($user_id, TransferRepo $transferRepo){

        $current_amount = $transferRepo->getCurrentAmount($user_id);

        $currents = $transferRepo->getCurrents($user_id);

        if($currents == null){

            $currents_count = 0;
        }else{

            $currents_count = 1;
        }

        return view('user.current_account', compact('currents', 'current_amount' ,'currents_count'));
    }

}
