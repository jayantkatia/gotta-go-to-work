$(document).ready(function () {
  //to focus on username when modal is shown
  $('#loglnModal').on('shown.bs.modal', function () {
    $('#usernameLogIn').trigger('focus');
  })

  //check whether username and password are correct and logs in
  $('#logInSubmit').click(function () {
    event.preventDefault();
    let username = $('#usernameLogIn').val();
    let password = $('#passwordLogIn').val();
    if (username == "" || password == "") {
      return;
    }

    let url = "../process/auth-LogIn.php";
    $.post(url, { password, username }, function (data, status) {
      let dataPiece = data.split(',');//added
      if (dataPiece[0] == "Successful Login") {
        $('#logInModal').modal('hide');
        if(dataPiece[1]=="worker"){
          location.href="citizen-dashboard.php";
        }else{
          location.href="worker-dashboard.php";
        }
        // $('#msg').html(dataPiece[0] + " and category is " + dataPiece[1]);
      } else {
        $('#logInHelp').removeClass('invisible').html(dataPiece[0]).css('color', 'red');
      }
    });

  });

  //it clears fields and helps
  function clearEverythingLogin() {
    $('#logInForm').trigger('reset');
    $('#logInHelp').addClass('invisible').html('dummy');
  }

  // when hide modal it calls clear
  $('#logInModal').on('hide.bs.modal', function () {
    clearEverythingLogin();
  });

  $("#forgotPasswordFormLink").click(function(){
    $('#logInModal').modal('hide');
    $('#forgotPasswordModal').on('shown.bs.modal', function () {
      $('#usernameForgotPassword').trigger('focus');
    }).modal('show');
  });


  $('#forgotPasswordModal').on('hidden.bs.modal', function () {
    clearEverythingForgotPassword();
});

function clearEverythingForgotPassword() {
    $('#forgotPasswordForm').trigger('reset');
    $('#forgotPasswordHidden').hide();
    $('#passwordForgotPassword').val('');
}

});
