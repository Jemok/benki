<?php

namespace App\Http\Controllers;

use App\AccountRequest;
use App\Current_account;
use App\Http\Requests;
use App\Repos\AccountRepo;
use App\Repos\AccountRequestRepo;
use App\Repos\AccountUserRepo;
use App\Repos\UserRepo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repos\AccountTypeRepo;
use App\Account;
use App\AccountRate;

class HomeController extends Controller
{
    /**
     * @param AccountTypeRepo $accountTypeRepo
     * @param AccountUserRepo $accountUserRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(AccountTypeRepo $accountTypeRepo, AccountUserRepo $accountUserRepo, AccountRepo $accountRepo, UserRepo $userRepo, AccountRequestRepo $accountRequestRepo)
    {
        if(Auth::check()){


            if(Auth::user()->isAdmin()){

                $rates = AccountRate::where('id', '=', 1)->first();

                return view('user.admin', compact('rates'));

            }elseif(Auth::user()->isAdminTwo()){

                $users_freezed = Current_account::where('account_amount', '>=', 5000000)
                                                  ->where('approval', 1)
                                                  ->with('user')
                                                  ->get();

                $users = User::where('userCategory', 0)->latest()->paginate(10);

                return view('user.admin_two', compact('users', 'users_freezed'));
            }elseif(Auth::user()->isAdminThree()){

                return view('user.admin_three');
            }
            else{

                $accounts_type = $accountTypeRepo->all();

                $user_accounts = $accountUserRepo->showForUser(Auth::user());

                $account_requests = $accountRequestRepo->getForUser(\Auth::user()->id);

                $all_accounts = $accountRepo->all();

                $account_class = new Account();

                $request_class = new AccountRequest();

                $users = $userRepo->allExceptAdmin();
                
                $query = "";

                return view('dashboard.index', compact('account_requests','users','accounts_type', 'user_accounts', 'account_class','all_accounts', 'request_class', 'query'));

            }


        }
        return view('welcome');
    }

    public function getDepositAndTransfers(){
        return view('deposit-transfers');
    }
}
