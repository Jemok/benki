
<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'HomeController@index');

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::post('/dollar/rates/set', ['as' => 'setDollarRate', 'uses' => 'DollarController@setDollar']);



});

Route::group(['middleware' => 'web', 'prefix' => 'accounts', 'before' => 'csrf'], function() {

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', ['as' => 'getAccountPage', 'uses' => 'Account\AccountController@getAccountPage']);
        Route::get('/account/withdraw', ['as' => 'getWithdrawPage', 'uses' => 'Account\AccountController@getWithdrawPage']);

        Route::post('/store', ['as' => 'createAccount', 'uses' => 'Account\AccountController@store']);
        Route::get('/{id}', ['as' => 'getAccount', 'uses' => 'Account\AccountController@show']);
        Route::post('/{account_id}/validate', ['as' => 'validateForAccount', 'uses' => 'Account\AccountController@validateUser']);
        Route::get('/{account_id}/validate', ['as' => 'validateForAccount', 'uses' => 'Account\AccountController@notFound']);
        Route::get('/{account_id}/users', ['as' => 'accountUsers', 'uses' => 'Account\AccountController@getUsers']);
        Route::post('/{account_id}/withdraw-request', ['as' => 'withdrawRequest', 'uses' => 'Account\AccountController@withdrawRequest']);
        Route::get('/{account_id}/amount', ['as' => 'accountAmount', 'uses' => 'Account\AccountController@getAmount']);
        Route::post('/{account_id}/{user_id}/delete', ['as' => 'deleteUser', 'uses' => 'Account\AccountController@destroy']);
        Route::post('/{account_id}/deposit', ['as' => 'depositAmount', 'uses' => 'Account\AccountController@deposit']);

        Route::post('/{account_id}/add-member', ['as' => 'addMember', 'uses' => 'Account\AccountController@addMember']);
        Route::post('/deposit-current', ['as' => 'depositCurrent', 'uses' => 'Account\AccountController@depositCurrent']);
        Route::post('/deposit/user/{user_id}', ['as' => 'depositForUser', 'uses' => 'Account\AccountController@depositCurrentForUser']);
        Route::get('/deposit/user/{user_id}', ['as' => 'getDepositForUser', 'uses' => 'Account\AccountController@getDepositForUser']);


        Route::post('/account/freezed/{freezed_id}', ['as' => 'approveFreezed', 'uses' => 'Account\AccountController@approveFreezed']);
        Route::get('/savings/account', ['as' => 'getSavingsAccount', 'uses' => 'Account\AccountController@getSavings']);
        Route::get('/fixed-amount-savings/account', ['as' => 'getFixedAmountSavingsAccount', 'uses' => 'Account\AccountController@getFixedAmountSavings']);
        Route::get('/fixed/account', ['as' => 'getFixedAccount', 'uses' => 'Account\AccountController@getFixed']);
        Route::post('/fixed/save', ['as' => 'depositFixed', 'uses' => 'Account\AccountController@depositFixed']);
        Route::post('/savings/save', ['as' => 'saveSavings', 'uses' => 'Account\AccountController@depositSavings']);
        Route::post('/fixed-amount-savings/save', ['as' => 'saveFixedAmountSavings', 'uses' => 'Account\AccountController@depositFixedAmountSavings']);
        Route::get('/get/all', ['as' => 'allAccounts', 'uses' => 'Account\AccountController@getAll']);
        Route::get('/allAccounts/get', ['as' => 'searchAccounts', 'uses' => 'Account\AccountController@search']);
        Route::get('/request/send/{account_id}', ['as' => 'showSendRequest', 'uses' => 'Account\AccountController@showSendRequest']);


        Route::post('/{transaction_id}/savings/update', ['as' => 'updateSavings', 'uses' => 'Account\AccountController@updateSaving']);

        Route::post('{account_id}/send/request', ['as' => 'sendRequest', 'uses' => 'Account\SendAccountRequestController@sendRequest']);

        Route::post('{account_id}/{withdraw_request_id}/set', ['as' => 'setConfirm', 'uses' => 'Account\RequestAnswerController@store']);

        Route::post('rates', ['as' => 'updateRates', 'uses' => 'Account\AccountController@updateRates']);

        Route::get('/{request_id}/confirm', ['as' => 'getConfirmation', 'uses' => 'Account\AccountController@getConfirmation']);

        Route::get('/{account_id}/delete', ['as' => 'deleteAccount', 'uses' => 'Account\AccountController@deleteAccount']);

        Route::post('/search/account', ['as' => 'searchAccount', 'uses' => 'Account\AccountController@searchAccount']);

        Route::post('/search/request', ['as' => 'searchRequest', 'uses' => 'Account\SendAccountRequestController@searchAccount']);

        Route::post('{account_id}/account/withdraw', ['as' => 'withdrawFromAccount', 'uses' => 'Account\SendAccountRequestController@withdraw']);


        Route::post('/transfer/user', ['as' => 'transferToUser', 'uses' => 'Transfer\TransferController@store']);

        Route::get('/users/{user_id}',  ['as' => 'userAccounts', 'uses' => 'Account\AccountController@getAccounts']);

        Route::get('/users/savings/{user_id}', ['as' => 'userSavings', 'uses' => 'Account\AccountController@getUserSavings']);

        Route::get('/savings/records/{saving_id}', ['as' => 'savingRecords', 'uses' => 'Account\AccountController@savingRecords']);

        Route::get('/fixed/records/{user_id}', ['as' => 'fixedRecords', 'uses' => 'Account\AccountController@fixedRecords']);

        Route::get('/received/transfers/{user_id}', ['as' => 'receivedTransfers', 'uses' => 'Transfer\TransferController@getReceived']);

        Route::get('/sent/transfers/{user_id}', ['as' => 'sentTransfers', 'uses' => 'Transfer\TransferController@getSent']);

        Route::get('/chama/withdrawals/{user_id}', ['as' => 'chamaWithdrawals', 'uses' => 'Transfer\TransferController@getWithdrawals']);

        Route::get('/chama/deposits/{user_id}', ['as' => 'chamaDeposits', 'uses' => 'Transfer\TransferController@getDeposits']);

        Route::get('/chama/deposits/{user_id}', ['as' => 'chamaDeposits', 'uses' => 'Transfer\TransferController@getDeposits']);

        Route::get('/current/accounts/{user_id}', ['as' => 'currentDeposits', 'uses' => 'Transfer\TransferController@getCurrents']);

        Route::get('/allUsers/get', ['as' => 'searchUsers', 'uses' => 'Account\AccountController@searchUsers']);

    });

    Route::post('/set/{account_id}/account/withdraw', ['as' => 'withdrawFromAccountAjax', 'uses' => 'Account\SendAccountRequestController@withdrawAjax']);

    Route::post('/confirm/{account_id}/{withdraw_request_id}/set', ['as' => 'setConfirmAjax', 'uses' => 'Account\RequestAnswerController@storeAjax']);

    Route::post('/charges/add', ['as' => 'addCharge', 'uses' => 'TransactionChargesController@store']);

    Route::get('/charges/get', ['as' => 'getCharges', 'uses' => 'TransactionChargesController@getAppCharges']);

    Route::get('/charges/{charge_id}/update', ['as' => 'editTransactionCharge', 'uses' => 'TransactionChargesController@editCharge']);

    Route::post('/charges/{charge_id}/update', ['as' => 'updateTransactionCharge', 'uses' => 'TransactionChargesController@updateCharge']);

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/deposit/transfer', ['as' => 'depositAndTransfer', 'uses' => 'HomeController@getDepositAndTransfers']);

    });

    Route::post('payment', array(
        'as' => 'payment',
        'uses' => 'PayPalController@postPayment',
    ));

// this is after make the payment, PayPal redirect back to your site
    Route::get('payment/status', array(
        'as' => 'payment.status',
        'uses' => 'PayPalController@getPaymentStatus',
    ));

    Route::get('/paypal/pay', ['as' => 'payWithPayPal', 'uses' => 'PayPalController@getPaymentPage']);

    Route::get('/dollar/rates/view', ['as' => 'viewDollarRates', 'uses' => 'PayPalController@viewDollarRates']);

    Route::post('/profit/date', ['as' => 'getProfitDate', 'uses' => 'ProfitController@getProfitDate']);


});


