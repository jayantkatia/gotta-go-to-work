<?php
    include_once("connection.php");

    $query="select DISTINCT city from requirements";
    $queryResult=mysqli_query($dbConnection,$query);
    
    $arry=array();
    while($row=mysqli_fetch_array($queryResult)){
        $arry[]=$row;
    }
    echo json_encode($arry);
?>