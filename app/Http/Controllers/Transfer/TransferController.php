<?php

namespace App\Http\Controllers\Transfer;

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

        Session::flash('flash_message', 'The transfer was successfull');

        return redirect()->back();

    }

}
