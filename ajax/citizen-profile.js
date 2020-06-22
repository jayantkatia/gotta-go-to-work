$(document).ready(function(){
    $("#citizenFetch").click(function(){
        let username=$('#citizenUsername').val();
        let url="../process/citizen-profile.php?username="+username;
        $.getJSON(url,function(response){
            // console.log(response); 
            $('#citizenContact').val(response["contact"]);
            $('#citizenName').val(response["name"]);
            $('#citizenAddress').val(response["address"]);
            
            $('#citizenState').val(response["state"]);

            var pos=state_arr.indexOf(response["state"]);
            print_city("citizenCity",pos+1);
            
            
            $('#citizenCity').val(response["city"]);
            $('#citizenEmail').val(response["email"]);
            if(response["pic"])
            $('#prev').attr("src","../uploads/citizens/"+response["pic"]);
            else
            $('#prev').attr("src","");
        });
    });
});