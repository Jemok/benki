//Handel the process of submitting the account deposits using ajax

$(function () {


    //The account deposit form
    var accountDepositForm = $(this).find('.accountDepositForm');

    //The id of the account being deposit
    var account_id = accountDepositForm.attr('id');

    //Submit the accountDepositForm
    accountDepositForm.on('submit', function(e)
    {
        e.preventDefault();

        $.ajax( account_id + '/deposit', {
            data: accountDepositForm.serialize(),
            method: 'POST',
            success: function(data) {
                //displayUpdatedAccountAmount(data)
                hideOldCurrentAccountValue(data)

            }
        });
    });
});

// Handle the process of withdrawing money from a chama account to your current account

$(function () {

    //The account withdrawal form

    var withdrawForm = $(this).find('.withdrawForm');

    //The id of the account being withdrawn from

    var withdraw_account_id = withdrawForm.attr('id');

    /// Submit the withdrawal form
    withdrawForm.on('submit',  function (e) {

        e.preventDefault();

        $.ajax(withdraw_account_id + '/account/withdraw', {

            data: withdrawForm.serialize(),
            method: 'POST',
            success: function (data) {

                //displayUpdatedAccountAmount(data);

                switchWithdrawAlertDivs();

            }

        });


    });


});

function submitWithdrawForm() {

    document.getElementById('withdrawFormAjax').submit();
}

function submitConfirmationForm(request_id) {

    document.getElementById('submitConfirmationAjax_'+request_id)

}



// Display new updated amount data in the user interface
function displayUpdatedAccountAmount( data ) {

    var updated_amount_data = data.updated_account_amount;


    $('.displayAccountBalance').detach();



    $('.displayAccountBalanceDiv').append('<span class="col-md-offset-2 displayAccountBalance" style="background-color:yellow;">' +
        ''+"Account Balance: "+ updated_amount_data.amount + "</span>")

    hideOldCurrentAccountValue(data)
}

// Replaces the old current account value with the new one
function hideOldCurrentAccountValue(data) {

    $('.nav-amount').detach();

    $('.holdsCurrentAccount').append('<span class="navbar-text nav-amount" style="background-color:yellow;">'+ 'Current Balance Kshs:'+ data.current_account_amount +'</span>');

}

//Handle the switching request withdrawals div info
function switchWithdrawAlertDivs() {

    $('.withdraw_requests_table').detach();

    $('.withdraw_requests_tab').append('<div style="margin-top: 5%;" class="alert alert-info">'+
        'No withdraw requests here'+
    '</div>');

    $('.info_badge').detach();

}

//Switch confirmed messages
function switchConfirmedMessages(withdraw_request_id) {

    // $('#button_'+withdraw_request_id).removeClass('btn-info').addClass('btn-success').addClass('disabled').text('Confirmed');

    $('#button_'+withdraw_request_id).detach();

    $('#'+withdraw_request_id).append('<p>'+'Confirmed'+'</p>');


}

//Submit request confirmations using ajax
$(function () {

    //Get all the forms with the class confirm form
    var confirm_form = $(this).find('.confirm_form')

    confirm_form.click(function () {

        //Get the id of clicked form
      var clicked_form_id = $(this).attr('id');

      var clicked_form_data_id = $(this).attr('data-id');

      var withdraw_request_id = clicked_form_id;

      var account_to_confirm_from_id = clicked_form_data_id;

      $(this).on('submit', function (e) {

          e.preventDefault();

          $.ajax(account_to_confirm_from_id +'/'+withdraw_request_id+'/set', {

              data: $(this).serialize(),
              method: 'POST',
              success: function (data) {

                  switchConfirmedMessages(withdraw_request_id)

              }


          });

      })


    });

});


//'{account_id}/{withdraw_request_id}/set'
// //Handle the process of submitting a withdrawal request using ajax
//
// $(function () {
//
//     //Remove active from current tab and add it to the request tab
//     function setRequestTabActive() {
//
//     }
//
//     //The account request form
//     var withdrawRequestForm = $(this).find('.withdrawRequestForm');
//
//     //The id of the account being withdrawn from
//
//     var withdraw_account_id = withdrawRequestForm.attr('id');
//
//     withdrawRequestForm.on('submit', function (e) {
//
//         e.preventDefault();
//
//         $.ajax( withdraw_account_id + '/withdraw-request', {
//
//             data: withdrawRequestForm.serialize(),
//             method: 'POST',
//             success: function (data) {
//
//                 //Handle the setting of the request tab active'
//
//                 setRequestTabActive()
//
//             }
//         });
//     });
// });

