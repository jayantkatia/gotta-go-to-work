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
    <link href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style-citizen-dashboard.css">
    <title>MPS | Dashboard</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <script>
        var myModule = angular.module("myModule", []);
        myModule.controller("myController", function ($scope, $http) {
            $scope.userId;
            $scope.userPageInfo;
            $scope.start=function(){
                $scope.userId='<?php echo $_SESSION["activeUser"];?>';
                $scope.userPageInfo=" "+$scope.userId+"\'s  Dashboard";
            }
            // =($scope.userId+"'s Dashboard");
        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="start();">
<?php include_once("models-navbar.php");?>

    <div id="card-deck">
        <div class="card"  id="workerProfileCard">
            <img src="../res/images/user.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">My Profile</h5>
                <p class="card-text">Update your profile and help us provide you better opportunities</p>
                <a href="#" class="btn btn-primary">Navigate to Profile</a>
            </div>
        </div>

        <div class="card"  id="rateCard" data-toggle="modal" data-target="#rateModal">
            <img src="../res/images/002-verify.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Request Ratings</h5>
                <p class="card-text">Good ratings are always helpful, so why not get it? </p>
                <a href="#"  class="btn btn-primary">Ask for Ratings</a>
            </div>
        </div>

        <div class="card"   onclick="window.location.href='worker-search.php';">
            <img src="../res/images/007-search.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Search Work Available</h5>
                <p class="card-text">Get going by searching work around you</p>
                <a href="#" class="btn btn-primary">Start Searching</a>
            </div>
        </div>
    </div>



    <!-- !button of modal does not opens modals -->


    <!-- 
     -->

    <div class="modal" tabindex="-1" id="rateModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Ratings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rateForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="citizenUsername">Citizen Username</label>
                            <input type="text" class="form-control" required id="citizenUsername" name="citizenUsername">
                        </div>
                        <input type="text" class="hidden" id="workerUsername" value={{userId}}>
                        <!-- <div class="form-group">
                            <label for="workerUsername">Worker Username</label>
                            <input type="text" class="form-control" id="workerUsername" name="workerUsername">
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="rateSubmit" class="btn btn-primary" value="Get ratings">
                    </div>
                </form>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="../js/worker-dashboard.js"></script>
        <script src="../ajax/worker-dashboard.js"></script>

</body>

</html>