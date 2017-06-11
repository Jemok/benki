<?php

namespace App\Http\Controllers\Transfer;

use App\Repos\TransferRepo;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\TransferUsersRepo;
use App\Http\Requests\TransferUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TransferController extends Controller
{
    public function store(TransferUsersRepo $transferUsersRepo, TransferUserRequest $transferUserRequest ){

        $user = User::find(Auth::user()->id);


        if(!(Hash::check($transferUserRequest->password, $user->password))){

            Session::flash('flash_message_error', 'Wrong Password, Try again');


            return redirect()->back();
        }

        if($transferUserRequest->transfer_amount > \Auth::user()->current_account()->first()->account_amount){

            Session::flash('flash_message_error', 'You do no have enough cash in your current account to complete the transfer');

            return redirect()->back();

        }


        $errors = $transferUsersRepo->store($transferUserRequest->transfer_amount, $transferUserRequest->transfer_to, \Auth::user()->id);

        if(!empty($errors)){

            $errors = implode(',', $errors);

            Session::flash('flash_message_error', 'A transfer error occurred for user ' . $errors . ' Try again later');

            return redirect()->back();

        }

        Session::flash('flash_message', 'The transfer was successful');
        return redirect()->back();
    }

    public function storeMany(TransferUsersRepo $transferUsersRepo, Request $transferUserRequest ){

        $user = User::find(Auth::user()->id);


        if(!(Hash::check($transferUserRequest->password, $user->password))){

            Session::flash('flash_message_error', 'Wrong Password, Try again');


            return redirect()->back();
        }


        $amounts = explode(',', $transferUserRequest->transfer_amount);

        $transfers = explode(',', $transferUserRequest->transfer_to);



        foreach ($amounts as $transfer_amount){
            if($transfer_amount > \Auth::user()->current_account()->first()->account_amount){

                Session::flash('flash_message_error', 'You do no have enough cash in your current account to complete the transfer');

                return redirect()->back();

            }
            foreach ($transfers as $transfer_to){
                $errors = $transferUsersRepo->storeMany($transfer_amount, $transfer_to, \Auth::user()->id);
            }
        }


        if(!empty($errors)){

            $errors = implode(',', $errors);

            Session::flash('flash_message_error', 'A transfer error occurred for user ' . $errors . ' Try again later');

            return redirect()->back();

        }

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
