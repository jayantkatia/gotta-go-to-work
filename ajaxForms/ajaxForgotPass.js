/////////////////////////////////////////////////
    $('#forgotPasswordSubmit').click(function(){
        let username = $('#usernameForgotPassword').val();
        let url = "process/forgotPassAjax.php?username=" + username;
        $.get(url, function (response) {
            //if(response!="No such username")
            // alert("changes");
            $('#forgotPasswordHidden').show();
            $('#passwordForgotPassword').val(response);
        });
    });
 //////////////////////////////////////////  
 function clearEverythingForgotPassword(){
    $('#forgotPasswordForm').trigger('reset');
    $('#forgotPasswordHidden').hide();
    $('#passwordForgotPassword').val('');
}

$('#forgotPassword').on('hide.bs.modal', function () {
    clearEverythingForgotPassword();
});