$(document).ready(function(){

    $("#citizenFetch").click(function(){
        let username=$('#citizenUsername').val();

        let url="profile-citizen-ajaxfetch.php?username="+username;
    
        $.getJSON(url,function(response){
            // console.log(response); 
            $('#citizenContact').val(response["contact"]);
            $('#citizenName').val(response["name"]);
            $('#citizenAddress').val(response["address"]);
            $('#citizenCity').val(response["city"]);
            $('#citizenState').val(response["state"]);
            $('#citizenEmail').val(response["email"]);
            if(response["pic"])
            $('#prev').attr("src","uploads/"+response["pic"]);
            else
            $('#prev').attr("src","");

        });

    });




});