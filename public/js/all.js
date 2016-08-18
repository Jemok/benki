//Handel the process of submitting the account deposits using ajax

$(function () {

    // Display new updated amount data in the user interface
    function displayUpdatedAccountAmount( updated_amount_data ) {

        $('.displayAccountBalance').detach();

        $('.displayAccountBalanceDiv').append('<span class="col-md-offset-2 displayAccountBalance">' +
            ''+"Account Balance: "+ updated_amount_data.amount + "</span>")


    }

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
                var updated_amount_data = data.updated_account_amount;

                displayUpdatedAccountAmount(updated_amount_data)
            }
        });
    });
});
