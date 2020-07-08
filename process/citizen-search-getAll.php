<?php
include_once( 'connection.php' );

$category = $_GET['category'];
$city = $_GET['city'];
$query = "select location,problem,username,dop from requirements where city='$city' and category='$category'";
$queryResult = mysqli_query( $dbConnection, $query );

$arry = array();
while( $row = mysqli_fetch_array( $queryResult ) ) {
    $date = $row['dop'];
   //     $rows->daysTill = date_add($row["dop"],date_interval_create_from_date_string("10 days"));

   $row['daysTill'] =date('Y-m-d', strtotime($date. ' + 10 days'));
   
      //$row['daysTill'] = date( 'd', strtotime( $date ) )+30;
    $arry[] = $row;
}
echo json_encode( $arry );
?>