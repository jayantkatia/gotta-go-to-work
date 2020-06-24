<?php
    include_once("connection.php");
    $username=$_GET['username'];
    $queryUsername="select * from workers where username='$username'";
    $queryUsernameResult=mysqli_query($dbConnection,$queryUsername);
    if(!mysqli_error($dbConnection)){
        $count=mysqli_num_rows($queryUsernameResult);
    }
    if($count){
        $row=mysqli_fetch_array($queryUsernameResult);
        echo json_encode($row);
    }
?>