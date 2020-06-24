<?php
include_once("connection.php");
$citizenUsername=$_POST["citizenUsername"];
$workerUsername=$_POST["workerUsername"];


$query="insert into ratings(citizenUsername,workerUsername) values('$citizenUsername','$workerUsername');";
$queryResult=mysqli_query($dbConnection,$query);
if(mysqli_error($dbConnection)!=""){
    echo mysqli_error($dbConnection);
    return;
}
$count=mysqli_affected_rows($dbConnection);

if($count){
    echo "Successfully Posted...";
}else{
    echo "Unsuccessful try again...";
}
?>