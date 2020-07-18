<?php
    include_once("connection.php");
    $username=$_GET['username'];
    $queryUsername="select * from citizens where username='$username'";
    $queryUsernameResult=mysqli_query($dbConnection,$queryUsername);
    if(!mysqli_error($dbConnection)){
        $count=mysqli_num_rows($queryUsernameResult);
        if($count){
            $action="update";
        }else{
            $action="save";
        }
    }
    // echo $action;



        //getting values of fields
        $contact=$_POST['contact'];
        $name=$_POST['name'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        

        if($action=="save"){
            $querySaveUpdate="insert into citizens(username,name,contact,city,state,";
            // values('$username','$name','$contact','$address','$city','$state','$email')";
        }else{
            $querySaveUpdate="update citizens set name='$name',contact='$contact',city='$city',state='$state',";
            // email='$email' where username='$username'";
        }

     $arryFields=array("email","address");
     $fieldConfirmed=array();
     $fieldConfirmedValues=array();
     
     for($i=0; $i<count($arryFields);$i++){
         if( $_POST[ $arryFields[$i] ] ){
            $fieldConfirmedValues[]=$_POST[ $arryFields[$i]];
            $fieldConfirmed[]=$arryFields[$i];
         }
     }

     if($action=="save"){
        for($i=0;$i<count($fieldConfirmed);$i++){
            $querySaveUpdate=$querySaveUpdate.$fieldConfirmed[$i].',';
        }
        $querySaveUpdate=rtrim($querySaveUpdate,',');
        $querySaveUpdate=$querySaveUpdate.") values('$username','$name','$contact','$city','$state',";
        for($i=0;$i<count($fieldConfirmed);$i++){
            $querySaveUpdate=$querySaveUpdate."'".$fieldConfirmedValues[$i]."',";
        }
        $querySaveUpdate=rtrim($querySaveUpdate,',');
        $querySaveUpdate=$querySaveUpdate.");";

     }else{
        for($i=0;$i<count($fieldConfirmed);$i++){
            $querySaveUpdate=$querySaveUpdate.$fieldConfirmed[$i]."='".$fieldConfirmedValues[$i]."',";
        }
        $querySaveUpdate=rtrim($querySaveUpdate,',');
        $querySaveUpdate=$querySaveUpdate." where username='$username';";
     }
    //    echo $querySaveUpdate;





        //setting query
        // if($action=="save"){
        //     $querySaveUpdate="insert into citizens(username,name,contact,address,city,state,email) values('$username','$name','$contact','$address','$city','$state','$email')";
        // }else{
        //     $querySaveUpdate="update citizens set name='$name',contact='$contact',address='$address',city='$city',state='$state',email='$email' where username='$username'";
        // }
        $querySaveUpdateResult=mysqli_query($dbConnection,$querySaveUpdate);
        if(mysqli_error($dbConnection)){
            $countSaveUpdate=mysqli_affected_rows($dbConnection);
            if($count){
                // echo "Info Saved/Updated...";
            }
        }

        //----------------------------------------------------------------pic logic
        $orgName=$_FILES['pic']['name'];
        //check if picture is uploaded
        if($orgName==''){
            
        }else{
            //check if there was a picture and delete it
            $row=mysqli_fetch_array($queryUsernameResult);
            if(isset($row['pic'])){
                $oldFile=$row['pic'];
                unlink("../uploads/citizens/$oldFile");
            }
            

            $tmpName=$_FILES['pic']['tmp_name'];
            $pic="$username-$orgName";
            
            //uplodaing it to uplads/citizens folder
            $destination="../uploads/citizens/$pic";
            move_uploaded_file($tmpName,$destination);
            // echo $pic;

            //updating it in database
            $querySaveUpdatePic="update citizens set pic='$pic' where username='$username'";
            $querySaveUpdatePicResult=mysqli_query($dbConnection,$querySaveUpdatePic);
           
            $countSaveUpdatePic=mysqli_affected_rows($dbConnection);
            if($countSaveUpdatePic){
                // echo "New Pic Saved/Updated";
            }


        }
        //-------------------------------------------------
        header("location: ../views/citizen-dashboard.php?flag=1");

?>