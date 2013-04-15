/* 
 * Project: Offerwall
 * Purpose: This jquery handle the transactions and the validations for the login section.
 * Create Date: 29th Dec, 2011
 * Author: Saurabh Sinha

 */
function initApp() {
    $('#errorUsername').hide();
    $('#errorPassword').hide();
    $('#errorLogin').hide();
}

function validateUsername() {
    var usernameValue = $('#txtUsername').val();
    $('#errorUsername').hide();
    $usernameStatus = true;
    if (usernameValue == '') {
        $('#errorUsername').fadeIn('slow');
        $('#errorUsername').html('Pleaes Enter your Username');
        $usernameStatus = false;
    }
    return $usernameStatus;
}

function validatePassword() {
    var passwordValue = $('#txtPassword').val();
    $('#errorPassword').hide();
    $passwordStatus = true;
    if (passwordValue == '') {
        $('#errorPassword').fadeIn('slow');
        $('#errorPassword').html('Please enter your password');
        $passwordStatus = false;
    }
    return $passwordStatus;

}

$(document).ready(function () {
    initApp();
    $('#btnSubmit').click(function () {
        var usernameStatus = validateUsername();
        var passwordStatus = validatePassword();
        if (usernameStatus == true && passwordStatus == true) {
            $('#formLogin').submit();
        }
    });

    $('#txtUsername').keypress(function () {
        validateUsername();
    });

    $('#txtPassword').keypress(function () {
        validatePassword();
    });

});
