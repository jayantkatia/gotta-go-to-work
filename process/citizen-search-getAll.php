<?php
    include_once("connection.php");
    
    $queryDelete="delete from requirements where dop<DATE(DATE_ADD(CURDATE(),INTERVAL -10 DAY));";
    $queryDeleteResult=mysqli_query($dbConnection,$queryDelete);


    $query="select * from requirements";
    $queryResult=mysqli_query($dbConnection,$query);

    $arry=array();
    while($row=mysqli_fetch_array($queryResult)){
          //    $date = $row['dop'];
      // $rows["daysTill"]=date('d', strtotime($date))+30;
        // $row.daysTill=$row.dop
        $arry[]=$row;
    }
    echo json_encode($arry);
?>