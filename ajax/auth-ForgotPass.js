$(document).ready(function () {
   $('#forgotPasswordModal').on('shown.bs.modal', function () {
        $('#usernameForgotPassword').trigger('focus');
    });
    //gets password
    $('#forgotPasswordSubmit').click(function () {
        let username = $('#usernameForgotPassword').val();
        let url = "../process/auth-ForgotPass.php?username=" + username;
        $.get(url, function (response) {
            // $('#forgotPasswordHidden').show();
            // $('#passwordForgotPassword').val(response);
            $("#forgotPasswordModal").modal('hide');
            $('#successfulModalForgot').modal('show');
            // $('#forgotContact').html(response);
            setTimeout(function(){$('#successfulModalForgot').modal('hide');},4000);
        });
    });
    $('#forgotPasswordModal').on('hidden.bs.modal', function () {
        clearEverythingForgotPassword();
    });
    function clearEverythingForgotPassword() {
        $('#forgotPasswordForm').trigger('reset');
        // $('#forgotPasswordHidden').hide();
        // $('#passwordForgotPassword').val('');
    }
});