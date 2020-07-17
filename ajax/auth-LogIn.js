$(document).ready(function () {
  //to focus on username when modal is shown

  $('#logInModal').on('shown.bs.modal', function () {
    $('#usernameLogIn').trigger('focus');
  });

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
        console.log(dataPiece);
        if (dataPiece[1] == "worker") {
          if (dataPiece[2] == 1) {
             location.href = "worker-dashboard.php";
          } else {
            location.href = "worker-profile.php";
          }
        } else if(dataPiece[1] == "citizen") {
          if (dataPiece[2] == 1) {
            location.href = "citizen-dashboard.php";
          } else {
            location.href = "citizen-profile.php";
          }
          }else{
          location.href = "admin-dashboard.php";
         }
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
  $('#logInModal').on('hidden.bs.modal', function () {
    clearEverythingLogin();
  });

  $("#forgotPasswordFormLink").click(function () {
    $('#logInModal').modal('hide');
  });
});
