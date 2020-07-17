<?php
    include_once("SMS_OK.php"); 
        $msg=$_GET["message"];
        $mobile=$_GET['mobile'];
        $messageSent=SendSMS($mobile,$msg);
        echo "ok";        
?>