<?php
include_once("queryEmail.php");

if($count){
    echo "true";
    $row=mysqli_fetch_array($queryResult);
    $fileName=$row['fileName'];
    echo ",$fileName";
}else{
    echo "false";
}
?>