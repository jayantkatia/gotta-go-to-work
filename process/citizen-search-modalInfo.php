<?php
include_once( 'connection.php' );

$username = $_GET['username'];

$query = "select * from citizens where username='$username'";
$queryResult = mysqli_query( $dbConnection, $query );

$arry = array();
while( $row = mysqli_fetch_array( $queryResult ) ) {
    // $date = $row['dop'];
    // $rows['daysTill'] = date( 'd', strtotime( $date ) )+30;
    $arry[] = $row;
}
echo json_encode( $arry );
?>