$(document).ready(function () {
    //gets password
    $('#forgotPasswordSubmit').click(function () {
        let username = $('#usernameForgotPassword').val();
        let url = "../process/auth-ForgotPass.php?username=" + username;
        $.get(url, function (response) {
            $('#forgotPasswordHidden').show();
            $('#passwordForgotPassword').val(response);
        });
    });
    //clears fields 
    function clearEverythingForgotPassword() {
        $('#forgotPasswordForm').trigger('reset');
        $('#forgotPasswordHidden').hide();
        $('#passwordForgotPassword').val('');
    }
    //on hide calls clear
    $('#forgotPassword').on('hide.bs.modal', function () {
        clearEverythingForgotPassword();
    });

});