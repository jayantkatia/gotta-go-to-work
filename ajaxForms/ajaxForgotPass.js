/////////////////////////////////////////////////
    $('#usernameForgotPassword').change(function(){
        let username = $('#usernameForgotPassword').val();
        let url = "process/forgotPassAjax.php?username=" + username;
        $.get(url, function (response) {
            $('#passwordForgotPassword').val(response);
        });
    });
 //////////////////////////////////////////  