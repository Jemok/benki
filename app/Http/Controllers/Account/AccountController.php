<?php

namespace App\Http\Controllers\Account;

use App\Account;
use App\Account_amount;
use App\Account_user;
use App\AccountRequest;
use App\Current_account;
use App\Repos\AccountAmountRepo;
use App\Repos\AccountRequestRepo;
use App\Repos\AccountTypeRepo;
use App\Repos\CurrentAccountRepo;
use App\Repos\RequestAnswerRepo;
use App\Repos\TransferRepo;
use App\Repos\UserRepo;
use App\Repos\WithdrawRequestRepo;
use App\User;
use App\WithdrawRequestAnswer;
use Faker\Provider\zh_TW\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\RatesRequest;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\TransferCurrentToFixedRequest;
use App\Http\Requests\TransferCurrentToSavingsRequest;
use App\Http\Requests\DepositAccountRequest;
use App\Http\Requests\WithdrawAccountRequest;
use App\Http\Requests\SearchAccountRequest;

use App\Repos\AccountRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repos\AccountUserRepo;
use App\Http\Requests\AccountValidateUserRequest;
use App\Services\Validate;
use App\Http\Requests\AddMemberRequest;
use App\Http\Requests\DepositAmountRequest;
use App\Services\PusherWrapper as Pusher;

class AccountController extends Controller
{

    protected $pusher;

    public function __construct(Pusher $pusherWrapper)
    {
        $this->pusher = $pusherWrapper;
    }

    public function getAll(){

        $query = "";

        //$accounts = Account::paginate(10);

        return view('account.all', compact('accounts', 'query'));
    }


    public function search(Request $request){

        $query = $request->get('q');

        if($query){

            $accounts = Account::where('account_name', 'LIKE', "%$query%")->paginate(10);
        }else{

            $accounts = Account::paginate(10);
        }

        return view('account.all', compact('accounts', 'query'));
    }

    public function searchUsers(Request $request){
        $query = $request->get('q');

        if($query){

            $users = User::where('name', 'LIKE', "%$query%")
                                ->where('userCategory', 0)
                                 ->orWhere('email', 'LIKE', "%$query%")
                                 ->orWhere('phone_number', 'LIKE', "%$query%")
                                ->paginate(10);
        }else{

            $users = User::where('userCategory', 0)->paginate(10);
        }

        return view('user.admin_two', compact('users', 'query'));
    }

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
    public function show(AccountUserRepo $accountUserRepo, AccountRepo $accountRepo, $account_id, AccountRequestRepo $accountRequestRepo, WithdrawRequestRepo $withdrawRequestRepo, RequestAnswerRepo $requestAnswerRepo){

        if(Account_user::where('account_id', $account_id)->where('user_id', \Auth::user()->id)->exists()){

        $account = $accountRepo->show($account_id);

        $users_in= $accountUserRepo->getMembersInAccount($account_id);

        $users = $accountRequestRepo->getRequestsForAccount($account_id);

        $confirmation_status = $accountRequestRepo->getConfirmationStatus(Auth::user()->id, $account_id);

        $withdraw_requests = $withdrawRequestRepo->getRequests($account_id);

        $class_model = new Account_user();

        $answer_class = new WithdrawRequestAnswer();

        $users_in_account_count = $accountUserRepo->getMembersInAccount($account_id)->count();

        $id = $withdrawRequestRepo->getLatestForUser($account_id);
            
            $withdraw_status = $withdrawRequestRepo->getStatus($id);
            
            $request_answers_count = $requestAnswerRepo->countAnswers($id);

        if($users_in_account_count == $request_answers_count && $withdraw_status == 0){

            $info = "Approved";

        }elseif($users_in_account_count > $request_answers_count && $withdraw_status == 1){
            $info = "";
        }else{
            $info = "";
        }

        return view('account.show', compact('users_in_account_count','request_answers_count','answer_class','account', 'users', 'users_in', 'account_id', 'class_model', 'confirmation_status', 'withdraw_requests', 'info'));

        }else{

            if(AccountRequest::where('account_id', $account_id)->where('user_id', Auth::user()->id)->exists()){

                $confirmation_status = AccountRequest::where('account_id', $account_id)->where('user_id', Auth::user()->id)->first()->confirmation_status;

                if($confirmation_status == 1){

                    $account = $accountRepo->show($account_id);

                    $users_in= $accountUserRepo->getMembersInAccount($account_id);

                    $users = $accountRequestRepo->getRequestsForAccount($account_id);

                    $confirmation_status = $accountRequestRepo->getConfirmationStatus(Auth::user()->id, $account_id);

                    $withdraw_requests = $withdrawRequestRepo->getRequests($account_id);

                    $class_model = new Account_user();

                    $answer_class = new WithdrawRequestAnswer();

                    $users_in_account_count = $accountUserRepo->getMembersInAccount($account_id)->count();

                    $id = $withdrawRequestRepo->getLatestForUser($account_id);

                    $withdraw_status = $withdrawRequestRepo->getStatus($id);

                    $request_answers_count = $requestAnswerRepo->countAnswers($id);

                    if($users_in_account_count == $request_answers_count && $withdraw_status == 0){

                        $info = "-- ---- --- --Your Withdrawal was approved, you can withdraw-- ---- -- --";

                    }elseif($users_in_account_count < $request_answers_count && $withdraw_status == 0){

                        $info = "";
                    }else{

                        $info = "";

                    }

                    return view('account.show', compact('users_in_account_count','request_answers_count','answer_class','account', 'users', 'users_in', 'account_id', 'class_model', 'confirmation_status', 'withdraw_requests', 'info'));

                }elseif($confirmation_status == 0){

                    $request = 1;
                }

            }elseif(!AccountRequest::where('account_id', $account_id)->where('user_id', Auth::user()->id)->exists())
            {
                $request = "";

            }


            return view('account.send_request', compact('account_id', 'request'));
        }

    }


    public function showSendRequest(){

        return view('account.send_request');
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

    public function deposit(AccountRepo $accountRepo, DepositAccountRequest $depositAccountRequest , AccountAmountRepo $accountAmountRepo, $account_id){


        $validator = Validator::make($depositAccountRequest->all(), [
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('accounts/'.$account_id.'/amount')
                ->withErrors($validator)
                ->withInput();
        }


        $account = $accountRepo->show($account_id);

        $updated_account_amount = $accountAmountRepo->deposit($account, $depositAccountRequest->amount);

        $this->oooPushIt($updated_account_amount);

        return response()->json(['updated_account_amount' => $updated_account_amount, 'current_account_amount' => Auth::user()->current_account()->first()->account_amount]);


//        Session::flash('flash_message', 'Your deposit was successful');
//
//        return redirect('accounts/'.$account_id.'/amount');
    }


    protected function oooPushIt($updated_account_amount)
    {
        $amount = $updated_account_amount->amount;

        $data = [
            'account_id' => $updated_account_amount->account_id,
            'amount' => $updated_account_amount->amount,
            'html' => view('account.partials.account_deposit', compact('amount'))->render(),
        ];

        $recipients = Account_user::where('account_id', $updated_account_amount->account_id)->get();
        if ($recipients->count()) {
            foreach ($recipients as $recipient) {

                $this->pusher->trigger('for_user_' . $recipient->user_id, 'new_deposit', $data);
            }
        }
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
     * @param WithdrawAccountRequest $withdrawAccountRequest
     * @param $account_id
     * @param WithdrawRequestRepo $withdrawRequestRepo
     * @param AccountAmountRepo $accountAmountRepo
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function withdrawRequest(WithdrawAccountRequest $withdrawAccountRequest, $account_id, WithdrawRequestRepo $withdrawRequestRepo, AccountAmountRepo $accountAmountRepo){


        $account_amount = $accountAmountRepo->getAmount($account_id);

        $validator = Validator::make($withdrawAccountRequest->all(), [
            'request_amount' => 'required|numeric|max:'.$account_amount,
        ]);

        if ($validator->fails()) {
            return redirect('accounts/'.$account_id.'/amount')
                ->withErrors($validator)
                ->withInput();
        }

        $request = $withdrawRequestRepo->store($account_id, \Auth::user()->id, $withdrawAccountRequest->request_amount);

        $this->oooPushItRequest($account_id, $withdrawAccountRequest->request_amount, $request);


        Session::flash('flash_message', 'Your request was sent successfully, you will be notified when all chama members approve it');

        return redirect()->back();

        //return redirect('accounts/'.$account_id.'/amount');
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

        $today = (new \Carbon\Carbon())->addHours(24);

        $today = $today->toDateString();

        return view('account.show_savings', compact('saving', 'today'));
    }


    /**
     * @param TransferRepo $transferRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFixed(TransferRepo $transferRepo){


        $fixed = $transferRepo->getFixed();

        $today = (new \Carbon\Carbon())->addHours(24);

        $today = $today->toDateString();


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

    public function updateRates(AccountRepo $accountRepo, RatesRequest $ratesRequest){

        $accountRepo->updateRates($ratesRequest);

        Session::flash('flash_message', 'Rates were updated successfully');

        return redirect()->back();

    }

    public function getConfirmation(AccountRepo $accountRepo, $request_id){

        $confirmations = $accountRepo->getConfirmation($request_id);

        $userClass = new User();

        return view('account.confirm', compact('confirmations', 'userClass'));
    }

    public function deleteAccount($account_id, AccountRepo $accountRepo){


        $accountRepo->deleteAccount($account_id);

        Session::flash('flash_message', 'The account was deleted successfully and every one refunded');

        return redirect('/home');
    }

    public function searchAccount(SearchAccountRequest $searchAccountRequest, AccountUserRepo $accountUserRepo, AccountRepo $accountRepo, AccountRequestRepo $accountRequestRepo, WithdrawRequestRepo $withdrawRequestRepo, RequestAnswerRepo $requestAnswerRepo){

        $account_id = $searchAccountRequest->search_account;

        $account = $accountRepo->show($account_id);

        $users_in= $accountUserRepo->getMembersInAccount($account_id);

        $users = $accountRequestRepo->getRequestsForAccount($account_id);

        $confirmation_status = $accountRequestRepo->getConfirmationStatus(Auth::user()->id, $account_id);

        $withdraw_requests = $withdrawRequestRepo->getRequests($account_id);

        $class_model = new Account_user();

        $answer_class = new WithdrawRequestAnswer();

        $users_in_account_count = $accountUserRepo->getMembersInAccount($account_id)->count();

        $id = $withdrawRequestRepo->getLatestForUser($account_id);
        
        $withdraw_status = $withdrawRequestRepo->getStatus($id);

        $request_answers_count = $requestAnswerRepo->countAnswers($id);

        if($users_in_account_count < $request_answers_count && $withdraw_status == 0){

            $info = "Some users have not yet confirmed your request";

        }elseif($users_in_account_count >= $request_answers_count && $withdraw_status == 1){

            $info = "";
        }else{

            $info = "";
        }

        return view('account.show', compact('answer_class','account', 'users', 'users_in', 'account_id', 'class_model', 'confirmation_status', 'withdraw_requests', 'info'));
    }

    public function getAccounts($user_id, AccountRepo $accountRepo){

        $accounts = $accountRepo->getAccounts($user_id);

        if($accounts == null){

            $count = 0;
        }else{
            $count = 1;
        }

        return view('account.user_accounts', compact('accounts', 'count'));
    }

    public function getUserSavings($user_id, AccountRepo $accountRepo){

        $user_savings = $accountRepo->getUserSavings($user_id);

        if($user_savings == null){

            $savings_count = 0;
        }else{
            $savings_count = 1;
        }

        return view('savings.user_savings', compact('user_savings', 'savings_count'));
    }

    public function savingRecords($saving_id, AccountRepo $accountRepo){

        $saving_records = $accountRepo->getSavingsRecords($saving_id);

        if($saving_records == null){

            $records_count = 0;
        }else{

            $records_count = 1;
        }

        return view('savings.records', compact('savings_records', 'records_count'));
    }

    public function fixedRecords($user_id, AccountRepo $accountRepo){

        $user_fixed = $accountRepo->getFixedRecords($user_id);

        if($user_fixed == null){

            $records_count = 0;

        }else{
            $records_count = 1;
        }

        return view('fixed.user_fixed', compact('user_fixed', 'records_count'));
    }

    public function getDepositForUser($user_id){


        return view('user.add_money', compact('user_id'));
    }

    public function depositCurrentForUser(AccountAmountRepo $accountAmountRepo, DepositAmountRequest $depositAmountRequest, $user_id){

        $user = User::findOrFail($user_id);

        $accountAmountRepo->depositCurrent($user, $depositAmountRequest);

        Session::flash('flash_message', 'Your deposit was successful');


        return redirect()->back();
    }

    protected function oooPushItRequest($request_account_id, $amount, $request)
    {
        $request_amount = $amount;
        $requester_name = $request->user()->first()->name;
        $request_id =  $request->id;
        $account_id = $request_account_id;

        $data = [

            'html' => view('account.partials.withdraw_request', compact('request_amount', 'requester_name', 'request_id', 'account_id'))->render(),
        ];

        $recipients = Account_user::where('account_id', $account_id)->where('user_id', '!=', Auth::user()->id)->get();
        if ($recipients->count()) {
            foreach ($recipients as $recipient) {

                $this->pusher->trigger('for_user_' . $recipient->user_id, 'new_request', $data);
            }
        }
    }
}
