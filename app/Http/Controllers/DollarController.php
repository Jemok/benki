<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use App\Http\Requests\SetDollarRate;
use App\Repos\DollarRateRepository;

class DollarController extends Controller
{
    public function setDollar(SetDollarRate $setDollarRate, DollarRateRepository $dollarRateRepository){

        $dollarRateRepository->store($setDollarRate);

        Session::flash('flash_message', 'New Dollar Rate was set successfully');

        return redirect()->back();

    }
}
