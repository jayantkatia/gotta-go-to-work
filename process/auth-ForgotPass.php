<?php
    include_once('usersTable-query.php');
    if($count){
    $row=mysqli_fetch_array($queryResult);
    echo $row['password'];
    }else{
        echo "No such username";
    }
?>