<?php
session_start();
include_once('connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username=$_POST['username'];
}


$query="select * from users where username='$username' and status='1'";
$queryResult=mysqli_query($dbConnection,$query);
$msg=mysqli_error($dbConnection);
if($msg != ""){
    echo "Some error occured while fetching from database..pls try again...";
    return;
}
$count=mysqli_num_rows($queryResult);


if($count){
    $cmpPass=$_POST['password'];
    $row=mysqli_fetch_array($queryResult);
    if($cmpPass===$row['password']){
        // echo 'Successful Login,'.$row['category'];  //added
        
        $_SESSION["activeUser"]=$username;
        
        if($username=="admin"){
            echo "Successful Login,"."admin";
            return;
        }

        $tableName= $row['category'].'s';
        $queryExist="select * from $tableName where username='$username'";
        $queryExistResult=mysqli_query($dbConnection,$queryExist);
        // $rowExists=mysqli_fetch_array($queryExistResult);
        // $countExists=0;
        // if($rowExists["num_rows"]>0){
        //     $countExists=1;
        // }
        $countExists=mysqli_num_rows($queryExistResult);
        echo 'Successful Login,'.$row['category'].','.$countExists;

    }else{
        echo "Wrong Password";
    }
    
}else{
        echo "No such username exists";
}
    
?>