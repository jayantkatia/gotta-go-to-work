<?php
include_once("connection.php");
$username=$_GET["username"];
$status=$_GET["status"];
$query = "update users set status='$status' where username='$username'";
$queryResult = mysqli_query( $dbConnection, $query );
if(!mysqli_error($dbConnection)){
    $count=mysqli_affected_rows($dbConnection);
}
if($count){
    echo "Updated Successful";
}


?>