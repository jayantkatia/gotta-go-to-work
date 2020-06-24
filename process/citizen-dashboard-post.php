<?php
    include_once("connection.php");
    $username=$_POST["username"];
    $category=$_POST["category"];
    $problem=$_POST["problem"];
    $location=$_POST["location"];
    $city=$_POST["city"];

    $query="insert into requirements(rid,username,category,problem,location,city,dop) values(default,'$username','$category','$problem','$location','$city',curdate());";
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