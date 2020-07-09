<?php
include_once("connection.php");
$category=$_GET["category"];
$query = "select * from users where category='$category'";
$queryResult = mysqli_query( $dbConnection, $query );

$arry = array();
while( $row = mysqli_fetch_array( $queryResult ) ) {
    $arry[] = $row;
}
echo json_encode( $arry );
?>