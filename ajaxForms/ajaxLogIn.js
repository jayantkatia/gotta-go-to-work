$(document).ready(function(){
    $('#logIn').on('shown.bs.modal', function () {
        $('#usernameLogIn').trigger('focus');
      })

////////////////////////////////////////////////////
    $('#logInSubmit').click(function(){
              event.preventDefault();
            let username=$('#usernameLogIn').val();
            let password=$('#passwordLogIn').val();
            if(username=="" || password==""){
                return;
            }

            let url="process/logInAjaxBtn.php";
            $.post(url,{password,username},function(data,status){
                let dataPiece=data.split(',');//added
                if(dataPiece[0]=="Successful Login"){
                   // alert("success");
                    $('#logIn').modal('hide');
                    $('#msg').html(dataPiece[0]+" and category is "+dataPiece[1]);
                
                }else{
                $('#logInHelp').removeClass('invisible').html(dataPiece[0]).css('color','red');
                }
            });
        
    });

    function clearEverythingLogin(){
        $('#logInForm').trigger('reset');
        $('#logInHelp').addClass('invisible').html('dummy');
    }

  $('#logIn').on('hide.bs.modal', function () {
    clearEverythingLogin();
  });
  
})
