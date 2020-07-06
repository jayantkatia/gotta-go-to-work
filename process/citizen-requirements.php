<?php
include_once("connection.php");
$username=$_GET['username'];
$queryUsername="select * from requirements where username='$username'";
$queryUsernameResult=mysqli_query($dbConnection,$queryUsername);
    if(!mysqli_error($dbConnection)){
        $count=mysqli_num_rows($queryUsernameResult);
    }
    if($count){
        $arry=array();
        while($row=mysqli_fetch_array($queryUsernameResult)){
            $arry[]=$row;
        };
        echo json_encode($arry);
    }
?>