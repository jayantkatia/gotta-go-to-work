$(document).ready(function () {

  /////////////////////////////////////////////////
  $('#signUp').on('shown.bs.modal', function () {
    $('#usernameSignUp').trigger('focus');
  })
  $("#usernameSignUp").blur(usernameCheck);
  function usernameCheck() {
    let $username = $("#usernameSignUp");
    let $help = $("#usernameSignUpHelp");

    if ($username.val() === "") {
      validityStyles($username, $help, "Please enter a  username", 0, "username");
      return;
    }

    let url = "process/signUpAjaxUsername.php?username=" + $username.val();
    $.get(url, function (response) {
      if (response == "Looks Good") {
        validityStyles($username, $help, response, 1, "username");
        return;
      }
      validityStyles($username, $help, response, 0, "username");
    });

  }
  ////////////////////////////////////////////////////////////

  $("#passwordSignUp").keyup(passwordCheck);
  function passwordCheck() {
    let $password = $("#passwordSignUp");
    let $help = $("#passwordSignUpHelp");
    if ($password.val().length < 5) {
      validityStyles($password, $help, "Weak Password", 0, "password");
    } else {
      validityStyles($password, $help, "Strong Password", 1, "password");
    }

  }

  /////////////////////////////////////////////////////////////

  $('#mobileSignUp').blur(mobileCheck);
  function mobileCheck() {
    let $mobile = $("#mobileSignUp");
    let $help = $("#mobileSignUpHelp");
    let r = /^[6-9]{1}[0-9]{9}$/;
    if (r.test($mobile.val())) {
      validityStyles($mobile, $help, "Valid Mobile number", 1, "mobile");
    } else {
      validityStyles($mobile, $help, "Invalid Mobile number", 0, "mobile");
    }

  }

  function getNonNumerics() {
    var kc = event.keyCode;//gives ASCII value
    //Only Numerics are allowed
    if (!(kc >= 48 && kc <= 57))
      return false;
  }
  /////////////////////////////////////////////////////////////
  $("#categorySignUpWorker,#categorySignUpCitizen").change(function(){
    categoryCheck();
  });


  function categoryCheck() {
    if ($("#categorySignUpWorker").prop('checked') || $('#categorySignUpCitizen').prop('checked')) {
      flagUserName.category = 1;
      $('#categorySignUpHelp').addClass('invisible').html('options');
    } else {
      $('#categorySignUpHelp').removeClass('invisible').html("Please check one of the options").css('color', 'red');
    }
  }

  /////////////////////////////////////////////////////////////
  function checkEverything(){
    usernameCheck();
    passwordCheck();
    mobileCheck();
    categoryCheck();
  }
  function clearEverything(){
    $('#signUpForm').trigger('reset');
    // alert("Hello  kms");
    $("#passwordSignUp,#usernameSignUp,#mobileSignUp").removeClass(['is-valid','is-invalid']);
    $("#passwordSignUpHelp,#usernameSignUpHelp,#mobileSignUpHelp,#categorySignUpHelp").addClass('invisible').html('dummy');
  }

  $("#signUpSubmit").click(function () {
    checkEverything();
    event.preventDefault();
    if (!checkValidForm()) {
      return;
    }
    let url="process/signUpAjax.php";
    let data={};
    $("#signUpForm").serializeArray().map(obj=>{
      data[obj.name]=obj.value;
    });
    $.post(url,data,function(data,status){
      
      if(data=="ok"){
        $('#signUp').modal('hide');
        alert("Signed Up Successfully");
      }
      else{
        alert("Sign Up not successful");
      } 
    });
  });

  $('#signUp').on('hidden.bs.modal', function () {
    clearEverything();
  });

});



let flagUserName = {};
/////////////////////////////////////////////////////////////

function validityStyles($field, $help, response, value, flagName) {
  $help.removeClass("invisible");

  if (value) {
    $field.addClass("is-valid").removeClass("is-invalid");
    $help.html(response).css("color", "green");
    flagUserName[flagName] = 1;
  } else {
    $field.addClass("is-invalid").removeClass("is-valid");
    $help.html(response).css("color", "red");
    flagUserName[flagName] = 0;
  }

}
/////////////////////////////////////////////////////////////

function checkValidForm() {
  if (Object.keys(flagUserName).length != 4) {
    return false;
  }else{
    return Object.keys(flagUserName).every(key => flagUserName[key] == 1);
  }
}