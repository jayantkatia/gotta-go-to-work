<?php
    include_once("connection.php");
    
    $query="select * from workers;";
    $queryResult=mysqli_query($dbConnection,$query);

    $arry=array();
    while($row=mysqli_fetch_array($queryResult)){
        $arry[]=$row;
    }
    echo json_encode($arry);
?>