<?php
include_once("connection.php");
$username=$_GET["username"];
$query = "delete from users where username='$username'";
$queryResult = mysqli_query( $dbConnection, $query );
if(!mysqli_error($dbConnection)){
    $count=mysqli_affected_rows($dbConnection);
}
if($count){
    echo "Delete Successful";
}


?>