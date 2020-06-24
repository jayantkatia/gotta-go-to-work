<?php
include_once("connection.php");
//querying if entry exists
$username=$_POST['username'];
$queryUsername="select * from workers where username='$username'";
$queryUsernameResult=mysqli_query($dbConnection,$queryUsername);
if(!mysqli_error($dbConnection)){
    $count=mysqli_num_rows($queryUsernameResult);
    if($count){
        $action="update";
        $querySaveUpdate="update workers set ";
    }else{
        $action="save";
        $querySaveUpdate="insert into workers(username, ";
    }
}
echo $action;

$arryfields=["name","contact","address","city","state","exp","category","spec","email","exptext","firm"];
$fieldsConfirmed=array();
$fieldsConfirmedVal=array();

for(  $i=0 ; $i < count($arryfields); $i++ ){

    if($_POST[ $arryfields[$i] ]){
        $fieldsConfirmed[]=$arryfields[$i];
        $fieldsConfirmedVal[]=$_POST[$arryfields[$i]];
    }
}


if($action=="update"){
    for($i=0;$i<count($fieldsConfirmed);$i++){
        $querySaveUpdate=$querySaveUpdate.$fieldsConfirmed[$i]."='".$fieldsConfirmedVal[$i]."',";
    }
    $querySaveUpdate=rtrim($querySaveUpdate,",");
    $querySaveUpdate=$querySaveUpdate." where username="."'".$username."';";
}
else{
    for($i=0;$i<count($fieldsConfirmed);$i++){
        $querySaveUpdate=$querySaveUpdate.$fieldsConfirmed[$i].",";
    }
    $querySaveUpdate=rtrim($querySaveUpdate,",");
    $querySaveUpdate=$querySaveUpdate.") values('$username',";
    for($i=0;$i<count($fieldsConfirmedVal);$i++){
        $querySaveUpdate=$querySaveUpdate."'".$fieldsConfirmedVal[$i]."',";
    }
    $querySaveUpdate=rtrim($querySaveUpdate,",");
    $querySaveUpdate=$querySaveUpdate.");";
}
 
echo "<br>";
$querySaveUpdateResult=mysqli_query($dbConnection,$querySaveUpdate);


// pic logic
$orgName=$_FILES['ppic']['name'];
if($orgName==''){
        
}
else{
    $row=mysqli_fetch_array($queryUsernameResult);
    if(isset($row['ppic'])){
    $oldFile=$row['ppic'];
    unlink("../uploads/workers/$oldFile");
    }

    $tmpName=$_FILES['ppic']['tmp_name'];
    $ppic="$username-$orgName";
    $destination="../uploads/workers/$ppic";
    move_uploaded_file($tmpName,$destination);

    $querySaveUpdatePic="update workers set ppic='$ppic' where username='$username'";
    $querySaveUpdatePicResult=mysqli_query($dbConnection,$querySaveUpdatePic);
    
    $countSaveUpdatePic=mysqli_affected_rows($dbConnection);
    
    if($countSaveUpdatePic){
        echo "New Pic Saved/Updated";
    }

}
    
//apic logic
$orgName=$_FILES['apic']['name'];
if($orgName==''){
        return;
}else{

            $row=mysqli_fetch_array($queryUsernameResult);
        if(isset($row['apic'])){
             $oldFile=$row['apic'];
              unlink("uploads/$oldFile");
            }   
        

        $tmpName=$_FILES['apic']['tmp_name'];
        $apic="$username-aadhar-$orgName";
        $destination="../uploads/workers/$apic";
        move_uploaded_file($tmpName,$destination);

        $querySaveUpdatePic="update workers set apic='$apic' where username='$username'";
        $querySaveUpdatePicResult=mysqli_query($dbConnection,$querySaveUpdatePic);
       
        $countSaveUpdatePic=mysqli_affected_rows($dbConnection);

        if($countSaveUpdatePic){
            echo "New Pic Saved/Updated";
        }


    }



?>