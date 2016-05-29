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
});

Route::group(['middleware' => 'web', 'prefix' => 'accounts', 'before' => 'csrf'], function() {

    Route::group(['middleware' => 'auth'], function(){
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

       Route::get('/savings/account', ['as' => 'getSavingsAccount', 'uses' => 'Account\AccountController@getSavings']);
       Route::get('/fixed/account', ['as' => 'getFixedAccount', 'uses' => 'Account\AccountController@getFixed']);
       Route::post('/fixed/save', ['as' => 'depositFixed', 'uses' => 'Account\AccountController@depositFixed']);
       Route::post('/savings/save', ['as' => 'saveSavings', 'uses' => 'Account\AccountController@depositSavings']);
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


    });

});
