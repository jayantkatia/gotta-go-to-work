<?php
include_once('connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username=$_POST['username'];
}else{
    $username=$_GET['username'];    
}
$query="select * from users where username='$username'";
$queryResult=mysqli_query($dbConnection,$query);
$msg=mysqli_error($dbConnection);
if($msg != ""){
    echo "Some error occured while fetching data pls try again....";
    return;
}
$count=mysqli_num_rows($queryResult);
?>