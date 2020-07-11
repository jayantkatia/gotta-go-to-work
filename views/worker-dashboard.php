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
    <title>Dashborad | MPS</title>

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

    <div id="cards-container">
        <div class="card" style="width: 18rem;" id="workerProfileCard">
            <img src="../res/images/user.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Worker Profile</h5>
                <p class="card-text">Change Worker profile </p>
                <a href="worker-profile.php" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

        <div class="card" style="width: 18rem;" id="rateCard">
            <img src="../res/images/002-gundam.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Get Ratings</h5>
                <p class="card-text">Get ratings for service you did.</p>
                <a href="#" data-toggle="modal" data-target="#rateModal" class="btn btn-primary">Go somewhere</a>
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
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rateForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="citizenUsername">Citizen Username</label>
                            <input type="text" class="form-control" id="citizenUsername" name="citizenUsername">
                        </div>
                        <div class="form-group">
                            <label for="workerUsername">Worker Username</label>
                            <input type="text" class="form-control" id="workerUsername" name="workerUsername">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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