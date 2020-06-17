<?php
    include_once('queryEmail.php');
    $cmpPass=$_POST['password'];
    $row=mysqli_fetch_array($queryResult);
    if($cmpPass===$row['password']){
        echo 'Successful Login,'.$row['category'];  //added
  
    }else{
        echo "not successful";
     
    }
    
?>