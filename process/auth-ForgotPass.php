<?php
    include_once("SMS_OK.php"); 
    include_once('usersTable-query.php');
    if($count){
        $row=mysqli_fetch_array($queryResult);

        $msg="ManPower Services"."\r\n"."Your Password is ".$row['password']."\r\n"."Good Day!!";
        $mobile=$row['mobile'];

        $messageSent=SendSMS($mobile,$msg);
        echo $messageSent;
        // echo $row['password'];
        
    }else{
        echo "No such username";
    }
?>