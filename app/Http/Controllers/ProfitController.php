<?php

namespace App\Http\Controllers;

use App\Repos\ProfitRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetProfitRequest;

class ProfitController extends Controller
{
    public function getProfitDate(GetProfitRequest $getProfitRequest, ProfitRepository $profitRepository){

        $date = $getProfitRequest->profit_date;

       $profits_transfers = $profitRepository->getProfitForDayTransfers($getProfitRequest);

       $profits_chama_withdrawals = $profitRepository->getProfitForDayWithdrawals($getProfitRequest);

       $profits = $profitRepository->getProfitForDay($getProfitRequest);


       return view('profit.show', compact('profits_transfers', 'profits_chama_withdrawals', 'profits', 'date'));
    }
}
