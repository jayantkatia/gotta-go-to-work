<?php
include_once("connection.php");
$rid=$_GET['rid'];
$queryRid="delete from requirements where rid='$rid'";
$queryRidResult=mysqli_query($dbConnection,$queryRid);
    if(!mysqli_error($dbConnection)){
        $count=mysqli_affected_rows($dbConnection);
    }
    if($count){
        echo "Delete Successful";
    }
?>