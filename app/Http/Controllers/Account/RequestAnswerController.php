<?php

namespace App\Http\Controllers\Account;

use App\Account_user;
use App\Repos\AccountUserRepo;
use App\Repos\WithdrawRequestRepo;
use App\User;
use App\Withdrawal_request;
use App\WithdrawRequestAnswer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\RequestAnswerRepo;
use Illuminate\Support\Facades\Session;
use App\Services\PusherWrapper as Pusher;

class RequestAnswerController extends Controller
{
    /**
     * The puhser class
     * @var
     */
    protected $pusher;

    public function __construct(Pusher $pusherWrapper)
    {
        $this->pusher = $pusherWrapper;

    }

    public function store($account_id, $withdraw_request_id, RequestAnswerRepo $requestAnswerRepo){

        $confirmation = $requestAnswerRepo->store($account_id, $withdraw_request_id, \Auth::user()->id);

        $this->oooPushIt($confirmation);

//        Session::flash('flash_message', 'You confirmed the request');
//
//        return redirect()->back();
    }

    public function storeAjax($account_id, $withdraw_request_id, RequestAnswerRepo $requestAnswerRepo){

        $confirmation = $requestAnswerRepo->store($account_id, $withdraw_request_id, \Auth::user()->id);

        $this->oooPushIt($confirmation);

        Session::flash('flash_message', 'You confirmed the request');

        return redirect()->back();
    }

    protected function oooPushIt($confirmation)
    {
        $user_name = User::where('id', $confirmation->user_id)->first()->name;

        $account_id = $confirmation->account_id;

        $withdraw_request = Withdrawal_request::where('id', $confirmation->withdraw_request_id)->with('user')->first();

        $withdraw_user = $withdraw_request->user;

        $csrf_value = csrf_token();

        $message = "You can now withdraw";


        if($this->checkStatus(new AccountUserRepo(new Account_user()), $account_id, $withdraw_user->id, new WithdrawRequestRepo(new Withdrawal_request()), new RequestAnswerRepo(new WithdrawRequestAnswer()))){
            $data = [
                'html' => view('account.partials.confirmation_notification', compact('user_name', 'message'))->render(),
                'html2' => view('account.partials.withdraw_view', compact('account_id', 'csrf_value'))->render()
            ];

        }else
        {
            $data = [
                'html' => view('account.partials.confirmation_notification', compact('user_name'))->render(),
            ];
        }




        $this->pusher->trigger('for_user_' . $withdraw_user->id, 'request_confirmation', $data);

    }

    public function checkStatus(AccountUserRepo $accountUserRepo, $account_id, $user, WithdrawRequestRepo $withdrawRequestRepo, RequestAnswerRepo $requestAnswerRepo){

        $users_in_account_count = $accountUserRepo->getMembersInAccount($account_id)->count();

        $id = $withdrawRequestRepo->getLatestForOtherUser($account_id, $user);

        $withdraw_status = $withdrawRequestRepo->getStatus($id);

        $request_answers_count = $requestAnswerRepo->countAnswers($id);

        if($users_in_account_count == $request_answers_count && $withdraw_status == 0){

            return true;
        }

        return false;
    }

}
