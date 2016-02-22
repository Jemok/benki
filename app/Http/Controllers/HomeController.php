<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repos\AccountRepo;
use App\Repos\AccountUserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repos\AccountTypeRepo;
use App\Account;

class HomeController extends Controller
{
    /**
     * @param AccountTypeRepo $accountTypeRepo
     * @param AccountUserRepo $accountUserRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(AccountTypeRepo $accountTypeRepo, AccountUserRepo $accountUserRepo)
    {
        if(Auth::check()){
            $accounts_type = $accountTypeRepo->all();

            $user_accounts = $accountUserRepo->showForUser(Auth::user());

            $account_class = new Account();

            return view('dashboard.index', compact('accounts_type', 'user_accounts', 'account_class'));
        }
        return view('auth.login');
    }
}
