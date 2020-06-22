<?php
    include_once("connection.php");
    $username=$_POST['username'];
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
    echo $action;

        //getting values of fields
        $contact=$_POST['contact'];
        $name=$_POST['name'];
        $city=$_POST['city'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $state=$_POST['state'];
        

        //setting query
        if($action=="save"){
            $querySaveUpdate="insert into citizens(username,name,contact,address,city,state,email) values('$username','$name','$contact','$address','$city','$state','$email')";
        }else{
            $querySaveUpdate="update citizens set name='$name',contact='$contact',address='$address',city='$city',state='$state',email='$email' where username='$username'";
        }
        $querySaveUpdateResult=mysqli_query($dbConnection,$querySaveUpdate);
        if(mysqli_error($dbConnection)){
            $countSaveUpdate=mysqli_num_rows($querySaveUpdateResult);
            if($count){
                echo "Info Saved/Updated...";
            }
        }

        //pic logic
        $orgName=$_FILES['pic']['name'];
        if($orgName==''){
            return;
        }else{
            $row=mysqli_fetch_array($queryUsernameResult);
            if(isset($row['pic'])){
                $oldFile=$row['pic'];
                unlink("../uploads/citizens/$oldFile");
            }
            

            $tmpName=$_FILES['pic']['tmp_name'];
            $pic="$username-$orgName";
            $destination="../uploads/citizens/$pic";
            move_uploaded_file($tmpName,$destination);
            echo $pic;
            $querySaveUpdatePic="update citizens set pic='$pic' where username='$username'";
            $querySaveUpdatePicResult=mysqli_query($dbConnection,$querySaveUpdatePic);
           
            $countSaveUpdatePic=mysqli_affected_rows($dbConnection);

            if($countSaveUpdatePic){
                echo "New Pic Saved/Updated";
            }


        }

?>