<?php
include_once('connection.php');

$username=$_POST['username'];
$password=$_POST['password'];
$mobile=$_POST['mobile'];
$category=$_POST['category'];
$status=1;

// echo $category;
 $query="insert into users(username,password,mobile,category,dos,status) values('$username','$password','$mobile','$category',curdate(),'$status');";



$queryResult=mysqli_query($dbConnection,$query);
$count=mysqli_affected_rows($dbConnection);
if($count==1){
    echo "ok";
    exit;
}
else
 echo mysqli_error($dbConnection);
?>  