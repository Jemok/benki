<?php

namespace App\Http\Controllers\Account;

use App\Account_amount;
use App\Current_account;
use App\Repos\AccountAmountRepo;
use App\Repos\AccountTypeRepo;
use App\Repos\CurrentAccountRepo;
use App\Repos\TransferRepo;
use App\Repos\UserRepo;
use App\Repos\WithdrawRequestRepo;
use App\User;
use Faker\Provider\zh_TW\DateTime;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\TransferCurrentToFixedRequest;
use App\Http\Requests\TransferCurrentToSavingsRequest;

use App\Repos\AccountRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repos\AccountUserRepo;
use App\Http\Requests\AccountValidateUserRequest;
use App\Services\Validate;
use App\Http\Requests\AddMemberRequest;
use App\Http\Requests\DepositAmountRequest;

class AccountController extends Controller
{
    /**
     * @param AccountRepo $accountRepo
     * @param AccountAmountRepo $accountAmountRepo
     * @param AccountTypeRepo $accountTypeRepo
     * @param AccountUserRepo $accountUserRepo
     * @param CreateAccountRequest $accountRequest
     * @param CurrentAccountRepo $currentAccountRepo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountRepo $accountRepo, AccountAmountRepo $accountAmountRepo, AccountTypeRepo $accountTypeRepo, AccountUserRepo $accountUserRepo, CreateAccountRequest $accountRequest){

        $account = $accountRepo->store($accountRequest, $accountTypeRepo->getAccountType(1));

        $accountUserRepo->store($account, Auth::user());

        $accountAmountRepo->store($account);

        Session::flash('flash_message', 'Your Account: <b> '.$account->account_name.' </b> was created successfully!');
        return back();
    }

    /**
     * @param AccountUserRepo $accountUserRepo
     * @param AccountRepo $accountRepo
     * @param $account_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(AccountUserRepo $accountUserRepo, AccountRepo $accountRepo, $account_id){


        $account = $accountRepo->show($account_id);

        $users_in= $accountUserRepo->getMembersInAccount($account_id);

        $users = $accountUserRepo->getMembersNotInAccount($account_id);

        return view('account.show', compact('account', 'users', 'users_in', 'account_id'));

    }

    public function validateUser(AccountValidateUserRequest $accountValidateUserRequest, Validate $validate, AccountUserRepo $accountUserRepo, AccountRepo $accountRepo, $account_id, UserRepo $userRepo){

            $account = $accountRepo->show($account_id);

            $users_in= $accountUserRepo->getMembersInAccount($account_id);

            $users = $accountUserRepo->getMembersNotInAccount($account_id);

            return view('account.show', compact('account', 'users', 'users_in', 'account_id'));
    }

    public function addMember(AddMemberRequest $addMemberRequest, AccountRepo $accountRepo, AccountUserRepo $accountUserRepo, $account_id, UserRepo $userRepo){

        $account = $accountRepo->show($account_id);

        $user = $userRepo->findUserByEmail($addMemberRequest->email);

        $accountUserRepo->store($account, $user);

        Session::flash('flash_message', 'The user' .$user->name.'was added to the account successfully');

        return redirect('accounts/'.$account_id.'/users');
    }

    public function notFound($account_id){

        return redirect('accounts/'.$account_id);

    }

    public function getUsers(AccountUserRepo $accountUserRepo, $account_id){

        $users= $accountUserRepo->getMembersInAccount($account_id);


        return view('account.users',  compact('users'));
    }

    public function destroy(AccountUserRepo $accountUserRepo, $account_id, $user_id){

        $accountUserRepo->destroy($account_id, $user_id);

        Session::flash('flash_message', 'The user was removed from the account successfully');

        return redirect('accounts/'.$account_id.'/users');
    }

    public function deposit(AccountRepo $accountRepo, Request $request, AccountAmountRepo $accountAmountRepo, $account_id){


        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('accounts/'.$account_id.'/amount')
                ->withErrors($validator)
                ->withInput();
        }



        $account = $accountRepo->show($account_id);

        $accountAmountRepo->deposit($account, $request->amount);

        Session::flash('flash_message', 'Your deposit was successful');

        return redirect('accounts/'.$account_id.'/amount');
    }

    public function depositCurrent(AccountAmountRepo $accountAmountRepo, DepositAmountRequest $depositAmountRequest){

        $accountAmountRepo->depositCurrent(Auth::user(), $depositAmountRequest);

        Session::flash('flash_message', 'Your deposit was successful');


        return redirect()->back();
    }

    public function getAmount(AccountAmountRepo $accountAmountRepo, $account_id){

        $account_amount = $accountAmountRepo->getAmount($account_id);

        return view('account.amount', compact('account_amount'));

    }

    /**
     * @param Request $request
     * @param $account_id
     * @param WithdrawRequestRepo $withdrawRequestRepo
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function withdrawRequest(Request $request, $account_id, WithdrawRequestRepo $withdrawRequestRepo){

        $validator = Validator::make($request->all(), [
            'request_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('accounts/'.$account_id.'/amount')
                ->withErrors($validator)
                ->withInput();
        }

        $withdrawRequestRepo->store($account_id, \Auth::user()->id, $request->request_amount);

        Session::flash('flash_message', 'Your request was sent successfully, withdrawal will occur automatically if approved by all members ');

        return redirect('accounts/'.$account_id.'/amount');
    }

    /**
     * @param TransferRepo $transferRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSavings(TransferRepo $transferRepo){

        $saving = $transferRepo->getSaving();

        if($saving == false){

            $saving = null;
        }

        return view('account.show_savings', compact('saving'));
    }


    /**
     * @param TransferRepo $transferRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFixed(TransferRepo $transferRepo){

        $fixed = $transferRepo->getFixed();

        $today = (new \Carbon\Carbon())->addHours(3);

        return view('account.show_fixed', compact('fixed', 'today'));
    }

    /**
     * @param TransferRepo $transferRepo
     * @param TransferCurrentToFixedRequest $toFixedRequest
     * @param CurrentAccountRepo $currentAccountRepo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function depositFixed(TransferRepo $transferRepo, TransferCurrentToFixedRequest $toFixedRequest, CurrentAccountRepo $currentAccountRepo){

        $transferRepo->transact($toFixedRequest, Auth::user()->current_account()->first()->id);

        $currentAccountRepo->deductForFixed($toFixedRequest);

        Session::flash('flash_message', 'The transfer was successful');

        return redirect()->back();
    }

    /**
     * Handles the flow of creating a savings account
     * @param TransferRepo $transferRepo
     * @param TransferCurrentToSavingsRequest $toSavingsRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function depositSavings(TransferRepo $transferRepo, TransferCurrentToSavingsRequest $toSavingsRequest){

        $transferRepo->transactToSavings($toSavingsRequest, Auth::user()->current_account()->first()->id);

        Session::flash('flash_message', 'The transfer was successful');

        return redirect()->back();
    }

    /**
     * @param TransferCurrentToSavingsRequest $toSavingsRequest
     * @param $transaction_id
     * @param TransferRepo $transferRepo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSaving(TransferCurrentToSavingsRequest $toSavingsRequest, $transaction_id, TransferRepo $transferRepo){

        $transferRepo->updateSaving($toSavingsRequest, $transaction_id);

        Session::flash('flash_message', 'Your Savings Account was updated Successfully');

        return redirect()->back();
    }
}
