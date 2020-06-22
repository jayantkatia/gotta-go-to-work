<?php

include_once('connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username=$_POST['username'];
}else{
    $username=$_GET['username'];    
}

$query="select * from users where username='$username' and status='1'";
$queryResult=mysqli_query($dbConnection,$query);
$msg=mysqli_error($dbConnection);
if($msg != ""){
    echo "Some error occured while fetching from database..pls try again...";
    return;
}
$count=mysqli_num_rows($queryResult);


if($count){
    $cmpPass=$_POST['password'];
    $row=mysqli_fetch_array($queryResult);
    if($cmpPass===$row['password']){
        echo 'Successful Login,'.$row['category'];  //added
    }else{
        echo "Wrong Password";
    }
    
}else{
        echo "No such username exists";
}
    
?>