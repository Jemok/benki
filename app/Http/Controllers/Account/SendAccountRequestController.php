<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Repos\AccountRequestRepo;

class SendAccountRequestController extends Controller
{
   public function sendRequest($account_id, AccountRequestRepo $accountRequestRepo){

       $accountRequestRepo->sendRequest($account_id, \Auth::user()->id);

       Session::flash('flash_message', 'Your request was sent successfully, wait for its confirmation now');

       return redirect()->back();

   }
}
