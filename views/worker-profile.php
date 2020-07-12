<!DOCTYPE html>
<html lang="en">
<?php session_start();
if(!isset($_SESSION["activeUser"])){
    header("location:index.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles-worker-profile.css">
    <script src="../js/previewPic.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <script>
        var myModule=angular.module("myModule",[]);
        myModule.controller("myController",function($scope,$http){

            $scope.userId;
            $scope.userPageInfo;
            $scope.url;
            $scope.start=function(){
                $scope.userId='<?php echo $_SESSION["activeUser"];?>';
                $scope.userPageInfo=" "+$scope.userId+"\'s  Profile";
                $scope.url=`../process/worker-profile-submit.php?username=${$scope.userId}`;
                print_state("workerState");
                $scope.profileFetch();
            }
            $scope.profileFetch=function () {
                let url = "../process/worker-profile-username.php?username=" + $scope.userId;
                 console.log(url);
                $http.get( "../process/worker-profile-username.php?username=" + $scope.userId).then(ok,notok);
                function ok (response) {
                    console.log(response);
                    if (response.data.length != 0) {
                        let ref = ["workerContact", "workerName", "workerCity", "workerState", "workerAddress", "workerEmail", "workerFirm", "workerExp", "workerSpec", "workerExpText", "workerCategory"];
                        let val = ["contact", "name",  "city","state", "address", "email", "firm", "exp", "spec", "exptext", "category"];
                        if(response.data["state"]){
                                    var pos=state_arr.indexOf(response.data["state"]);
                                    print_city("workerCity",pos+1);
                        }
                        for (let i = 0; i < ref.length; i++) {
                            if (response.data[val[i]])
                                $(`#${ref[i]}`).val(response.data[`${val[i]}`]);
                                // console.log(response.data[val[i]])
                        }
                        
                        if (response.data["ppic"]) {
                            $(`#prev`).css('background-image', "url('../uploads/workers/" + response.data["ppic"]+"')");
                            // alert("url(../uploads/workers/" + response.data["ppic"]+")");

                            // $("#prev").attr("src", "../uploads/workers/" + response["ppic"]);
                        }
                        if (response.data["apic"]) {
                            $("#prevAadhar").css('background-image', "url('../uploads/workers/" + response.data["apic"]+"')");
                        }
                    }
                };
                function notok(error){
                    console.log(error);
                }
            };
          
            

        });
    </script>
    <title>Profile</title>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="start();">
<?php include_once("models-navbar.php");?>
<div class="red float-right font-weight-bold">*fields are mandatory</div>
    <form id="workerForm" action={{url}} method="POST" enctype="multipart/form-data">
    <fieldset class="container-fluid">
        <legend><div id="prev"></div>
            <div class="flexible">
                <input type="file" name="ppic" class="inputFile" onchange="showpreview(this,'prev');" id="workerFile" >
                <label for="workerFile" class="btn btn-primary border-white"><i class="fa fa-camera"></i></label>
            </div>
        </legend>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="workerName">Worker Name<span class="red">*</span></label>
                <input type="text" class="form-control" id="workerName" required name="name">
            </div>
            <div class="form-group col-md-4">
                <label for="workerContact">Contact Number<span class="red">*</span></label>
                <input type="text" class="form-control" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Check your 10 digit number')" pattern="[6-9]{1}[0-9]{9}" id="workerContact" required name="contact">
            </div>
            <div class="form-group col-md-4">
                <label for="workerEmail">Email</label>
                <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Check your Email with @, .xx')" class="form-control" id="workerEmail" name="email">
            </div>
        </div>
        <div class="form-group">
            <label for="workerAddress">Address</label>
            <input type="text" class="form-control" id="workerAddress" name="address">
        </div>
        <div class="form-row"> 
            <div class="form-group col-md-4">
                <label for="workerState">State<span class="red">*</span></label>
                <select id="workerState" REQUIRED onchange="print_city('workerCity', this.selectedIndex);" class="form-control" name="state">
                    <option value="">Please Select one..</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="workerCity">City<span class="red">*</span></label>
                <!-- <input type="text" REQUIRED class="form-control" id="workerCity" name="city"> -->
                <select class="form-control" name="city" id="workerCity" required>
                   <option value="">Please Select State first..</option>
                </select>
            </div>


            <!-- 
<div class="form-group col-md-4">
                <label for="citizenState">State</label>
                <select id="citizenState" onchange="print_city('citizenCity', this.selectedIndex);" class="form-control" required name="state">
                    <option value="">Please Select one..</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="citizenCity">City</label>
                <select class="form-control" name="city" id="citizenCity" required>
                   <option value="">Please Select State first..</option>
                </select>
            </div>



             -->
        </div>
        </fieldset>
        <fieldset class="container-fluid">
       
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerCategory">Category<span class="red">*</span></label>
                <select id="workerCategory" REQUIRED class="form-control" name="category">
                        <option value="">Please select your work field</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="workerSpec">Specialistaion</label>
                <input type="text" class="form-control" id="workerSpec" name="spec">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerExp">Worker Experience</label>
                <select id="workerExp" class="form-control" name="exp">
                    <option value="">Please select number of years</option>

                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="workerFirm">Firm</label>
                <input type="text" class="form-control" id="workerFirm" name="firm">
            </div>
        </div>
        <div class="form-row">
            <label for="workerExpText">Previous Experience</label>
            <textarea class="m-2" name="exptext" id="workerExpText" cols="200" rows="2"></textarea>
        </div>
        </fieldset>
        <fieldset class="container-fluid">
        <label for="">Upload Aadhar Picture</label>
        <div class="form-row">
            <div class="col-md-6 border-right flex baseline">
                <div id="prevAadhar"></div>
                <div class="flexible">
                    <input type="file" name="apic" class="inputFile" onchange="showpreview(this,'prevAadhar');" id="workerFileAadhar">
                    <label for="workerFileAadhar" class="btn btn-primary border-white"><i class="fa fa-camera"></i></label>
                </div>
            </div>
            <div class="col-md-6 flex vertical-horizontal-center flex-column">
                <label for="">Update Profile </label>
                <input type="submit" class="btn gold" name="update/save" value="update/save">
                <!-- <p>Congratualations !! On boosting your journey to get work by providing us Information which we will use to provide you a better opportunities</p> -->
            </div>
         </div>
        </fieldset>
        <!-- <div class="form-row">
            <div class="offset-1 col-1">
                Aadhar:
                <input type="file" name="apic" onchange="showpreview(this,'prevAadhar');" id="workerFileAadhar">
            </div>
            <div class="offset-2 col-2">
                <img src="" id="prevAadhar" alt="" style="width:200px;height:200px ;">
            </div>
            <div class="offset-1 col-1">
                ProfilePic:
                <input type="file" name="ppic" onchange="showpreview(this,'prev');" id="workerFile">
            </div>
            <div class="offset-2 col-2">
               <img src="" id="prev" alt="" style="width:200px;height:200px ;"> 
            </div>
        </div> -->
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/worker-profile-main.js"></script>
    <!-- <script src="../ajax/worker-profile.js"></script> -->
    <script src="../js/states-cities.js"></script>

</body>

</html>
