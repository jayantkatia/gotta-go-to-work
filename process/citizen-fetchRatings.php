<?php
    include_once("connection.php");
    $username=$_GET["username"];

    $query="select * from ratings where citizenUsername='$username'";
    $queryResult=mysqli_query($dbConnection,$query);

    
        $arry=array();
        while($row=mysqli_fetch_array($queryResult)){
            $arry[]=$row;
        }
        echo  json_encode($arry);
    



?>