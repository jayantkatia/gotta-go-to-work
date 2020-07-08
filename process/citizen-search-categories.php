<?php
    include_once("connection.php");
    
    $queryDelete="delete from requirements where dop<DATE_ADD(CURDATE(),INTERVAL -10 DAY);";
    $queryDeleteResult=mysqli_query($dbConnection,$queryDelete);

    
    $query="select DISTINCT category from requirements";
    $queryResult=mysqli_query($dbConnection,$query);

    $arry=array();
    while($row=mysqli_fetch_array($queryResult)){
        $arry[]=$row;
    }
    echo json_encode($arry);
?>