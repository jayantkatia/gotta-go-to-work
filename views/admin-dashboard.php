<?php session_start();
if(!isset($_SESSION["activeUser"])){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="../css/style-admin.css">
    <!-- Bs CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Angular -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <!-- Bs Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bs Js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        var myModule = angular.module("myModule", []);
        myModule.controller("myController", function ($scope, $http) {
            $scope.userId;
            $scope.userPageInfo;
            $scope.start=function(){
                $scope.userId='<?php echo $_SESSION["activeUser"];?>';
                $scope.userPageInfo=" "+$scope.userId+"\'s  Dashboard";
            }

            function notok(error){
                console.log(error);
            }
            $scope.fetchUsers = function () {
                $http.get("../process/admin-fetchAllUsers.php?category="+$scope.category).then(ok,notok);
                function ok(response){
                    $scope.usersData=response.data;
                }
            }
            $scope.deleteUser=function(username,index){
                $http.get("../process/admin-delete.php?username="+username).then(ok,notok);
                function ok(response){
                    // $scope.usersData=response.data;
                    $scope.usersData.splice(index,1);
                }
            }
            $scope.blockSwitch=function(username,status,index){
                $http.get("../process/admin-statusChange.php?username="+username+"&status="+status).then(ok,notok);
                function ok(response){
                    $scope.usersData[index].status=status;
                    console.log($scope.usersData[index].status);
                }
            }
          

        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="start();">
    <?php include_once("models-navbar.php");?>


    <div id="cards-container">
        <div class="card">
            <img src="../res/images/user.png" style="max-width:9rem;" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">User Manager</h5>
                <p class="card-text">Handle user access </p>
                <a data-toggle="modal" data-target="#usersModal" class="btn btn-primary text-white">Manage</a>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="usersModal" role="dialog">
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Manage Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary ">
                            <input type="radio" name="category" ng-model="category" ng-change="fetchUsers();"
                                value="citizen">
                            Citizen
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="category" ng-model="category" ng-change="fetchUsers();"
                                value="worker">
                            Worker
                        </label>
                    </div>
                    <hr>
                    <table>
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Mobile Number</th>
                            <th>Date of SignUp</th>
                            <th>Status</th>
                            <th>Block</th>
                            <th>Unblock</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tr ng-repeat="obj in usersData">
                            <td>{{obj.username}}</td>
                            <td>{{obj.password}}</td>
                            <td>{{obj.mobile}}</td>
                            <td>{{obj.dos}}</td>
                            <td>{{obj.status}}</td>
                            <td>
                                <button class=" btn btn-secondary" ng-click="blockSwitch(obj.username,0,$index);">Block</button>
                            </td>
                            <td>
                                <button class="btn btn-primary" ng-click="blockSwitch(obj.username,1,$index);">Unblock</button>
                            </td>
                            <td>
                                <button class="btn btn-danger" ng-click="deleteUser(obj.username,$index)">Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/admin-main.js"></script>
</body>

</html>