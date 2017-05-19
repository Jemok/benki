<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Repos\AccountRequestRepo;
use App\Http\Requests\SearchRequestRequest;
use App\Repos\AccountUserRepo;
use App\Repos\AccountRepo;
use App\Repos\WithdrawRequestRepo;
use App\Repos\RequestAnswerRepo;
use App\Account_user;
use App\WithdrawRequestAnswer;
use App\Services\PusherWrapper as Pusher;

class SendAccountRequestController extends Controller
{

    protected $pusher;

    public function __construct(Pusher $pusherWrapper)
    {
        $this->pusher = $pusherWrapper;
    }

    public function sendRequest($account_id, AccountRequestRepo $accountRequestRepo){

       $accountRequestRepo->sendRequest($account_id, \Auth::user()->id);


       Session::flash('flash_message', 'Your request was sent successfully, wait for its confirmation now');

       return redirect('/home');
   }

    public function searchAccount(SearchRequestRequest $searchRequestRequest, AccountUserRepo $accountUserRepo, AccountRepo $accountRepo, AccountRequestRepo $accountRequestRepo, WithdrawRequestRepo $withdrawRequestRepo, RequestAnswerRepo $requestAnswerRepo){

        $account_id = $searchRequestRequest->search_request;

        $account = $accountRepo->show($account_id);

        $users_in= $accountUserRepo->getMembersInAccount($account_id);

        $users = $accountRequestRepo->getRequestsForAccount($account_id);

        $confirmation_status = $accountRequestRepo->getConfirmationStatus(\Auth::user()->id, $account_id);

        $withdraw_requests = $withdrawRequestRepo->getRequests($account_id);

        $class_model = new Account_user();

        $answer_class = new WithdrawRequestAnswer();

        $users_in_account_count = $accountUserRepo->getMembersInAccount($account_id)->count();

        $id = $withdrawRequestRepo->getLatestForUser($account);

        $withdraw_status = $withdrawRequestRepo->getStatus($id);

        $request_answers_count = $requestAnswerRepo->countAnswers($id);

        if($users_in_account_count < $request_answers_count && $withdraw_status == 0){

            $info = "Some users have not yet confirmed your request";

        }elseif($users_in_account_count > $request_answers_count && $withdraw_status == 0){

            $info = "";
        }else{

            $info = "";
        }

        return view('account.show', compact('answer_class','account', 'users', 'users_in', 'account_id', 'class_model', 'confirmation_status', 'withdraw_requests', 'info'));
    }

    /**
     * @param AccountRequestRepo $accountRequestRepo
     * @param $account_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function withdraw(AccountRequestRepo $accountRequestRepo, $account_id){

            $updated_account_amount = $accountRequestRepo->withdraw($account_id, \Auth::user()->id);

            Session::flash('flash_message', 'You transaction was successfull');

                $this->oooPushIt($updated_account_amount);
//
            return redirect()->back();

//            return response()->json(['updated_account_amount' => $updated_account_amount, 'current_account_amount' => Auth::user()->current_account()->first()->account_amount]);
    }

    /**
     * @param AccountRequestRepo $accountRequestRepo
     * @param $account_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function withdrawAjax(AccountRequestRepo $accountRequestRepo, $account_id){

        $updated_account_amount = $accountRequestRepo->withdraw($account_id, \Auth::user()->id);


        $this->oooPushIt($updated_account_amount);

        Session::flash('flash_message', 'You transaction was successfull');

        return redirect()->back();
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


}
