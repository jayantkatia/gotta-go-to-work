<?php
    include_once("connection.php");
    $username=$_GET["username"];
    $rating=$_GET["rating"];
    $rid=$_GET["rid"];

    $query="update workers set review=review+'$rating',total=(total+1) where username='$username'";
    $queryResult=mysqli_query($dbConnection,$query);
    if(mysqli_error($dbConnection)){
        return;
    }
    $queryDelete="delete from ratings where rid='$rid'";
    $queryDeleteResult=mysqli_query($dbConnection,$queryDelete);
    echo "ok";
?>