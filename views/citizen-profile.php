<!DOCTYPE html>
<html lang="en">
<?php session_start();
    if(!isset($_SESSION["activeUser"]))
        header("location:index.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="../css/styles-citizen-profile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <title>MPS | Profile</title>
    <script>
        var myModule=angular.module("myModule",[]);
        myModule.controller("myController",function($scope,$http){

            $scope.userId;
            $scope.userPageInfo;
            $scope.url;
            $scope.start=function(){
                $scope.userId='<?php echo $_SESSION["activeUser"];?>';
                $scope.userPageInfo=" "+$scope.userId+"\'s  Profile";
                $scope.url=`../process/citizen-profile-submit.php?username=${$scope.userId}`;
                print_state("citizenState");
                $scope.profileFetch();
            }
            $scope.profileFetch=function(){
                // let username=$('#citizenUsername').val();
                let url="../process/citizen-profile.php?username="+$scope.userId;
                $.getJSON(url,function(response){
                    if(response.length==0)
                    return;
                    $('#citizenContact').val(response["contact"]);
                    $('#citizenName').val(response["name"]);

                    $('#citizenState').val(response["state"]);
                    var pos=state_arr.indexOf(response["state"]);
                    print_city("citizenCity",pos+1);
                    $('#citizenCity').val(response["city"]);

                    
                    if(response["address"])
                        $('#citizenAddress').val(response["address"]);

                    if(response["email"])
                        $('#citizenEmail').val(response["email"]);

                    if(response["pic"])
                         $(`#prev`).css('background-image', "url('../uploads/citizens/" + response["pic"]+"')");
                        //  console.log("url('../uploads/citizens/" + response["pic"]+"')");

                    // $('#prev').attr("src","../uploads/citizens/"+response["pic"]);
                });
            };

            
        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="start();">
<?php include_once("models-navbar.php");?>
    <form id="citizenForm" action={{url}} method="POST" enctype="multipart/form-data">
        <fieldset class="container-fluid">  
            <legend><div id="prev"></div>
                <div class="flexible">
                    <input type="file" name="pic" class="inputFile" onchange="showpreview(this,'prev');" id="citizenFile" >
                    <label for="citizenFile" class="btn btn-primary border-white"><i class="fa fa-camera"></i></label>
                </div>
            </legend>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="citizenName">Citizen Name <span class="red">*</span></label>
                    <input type="text" class="form-control" id="citizenName"required name="name">
                </div>
                <div class="form-group col-md-4">
                    <label for="citizenContact">Contact Number<span class="red">*</span></label>
                    <input type="text" class="form-control"  pattern="[6-9]{1}[0-9]{9}" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Check your 10 digit number')" id="citizenContact" required name="contact">
                </div>
                <div class="form-group col-md-4">
                    <label for="citizenEmail">Email</label>
                    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Check your Email with @, .xx')" class="form-control" id="citizenEmail"  name="email">
                </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-12">
                    <label for="citizenAddress">Address</label>
                    <input type="text" class="form-control" id="citizenAddress"  name="address">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="citizenState">State<span class="red">*</span></label>
                    <select id="citizenState" onchange="print_city('citizenCity', this.selectedIndex);" class="form-control" required name="state">
                        <option value="">Please Select one..</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="citizenCity">City<span class="red">*</span></label>
                    <select class="form-control" name="city" id="citizenCity" required>
                        <option value="">Please Select State first..</option>
                    </select>
                </div>
                <div class="form-group col-md-3 flex baseline-end">
                    <label for="">Update Profile</label>
                     <input type="submit" class="btn gold" name="update/save" value="update/save">
                </div>
            </div>

        </fieldset>
        

        
        
       
        
       
            <!-- <div class="offset-1 col-1">
                <input type="file" name="pic" onchange="showpreview(this,'prev');"  id="citizenFile">
            </div>
            <div class="offset-1 col-3">
                <img src="" id="prev" alt="" style="width:200px;height:200px ;">
            </div> -->
       
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/states-cities.js"></script>
    <!-- <script src="../ajax/citizen-profile.js"></script> -->
    <script src="../js/previewPic.js"></script>
</body>

</html>