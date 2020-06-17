<?php
include_once('connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username=$_POST['username'];
    //echo "post";
}else{
    $username=$_GET['username'];    
   // echo "get";
}
$query="select * from users where username='$username'";
$queryResult=mysqli_query($dbConnection,$query);
$msg=mysqli_error($dbConnection);
if($msg != ""){
    echo $msg;
    return;
}
$count=mysqli_num_rows($queryResult);
//echo $count;
?>