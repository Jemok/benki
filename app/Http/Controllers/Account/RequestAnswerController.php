<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\RequestAnswerRepo;
use Illuminate\Support\Facades\Session;

class RequestAnswerController extends Controller
{
    public function store($account_id, $withdraw_request_id, RequestAnswerRepo $requestAnswerRepo){

        $requestAnswerRepo->store($account_id, $withdraw_request_id, \Auth::user()->id);

        Session::flash('flash_message', 'You confirmed the request');

        return redirect()->back();
    }

}
