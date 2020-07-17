<?php 
    session_start();
    if(!isset($_SESSION["activeUser"]))
        header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WP | Search</title>
    <link href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style-citizen-search.css">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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

            $scope.cities;
            $scope.citySelected;
            $scope.categories;
            $scope.categorySelected;
            $scope.cards;
            $scope.modalInfo;

            function notok(error) {
                console.log(error);
            }
            $scope.fetchLists = function () {
                $http.get("../process/citizen-search-categories.php").then(okCategories, notok);
                function okCategories(response) {
                    $scope.categories = response.data;
                    $scope.categorySelected = $scope.categories[0];
                }
                $http.get("../process/citizen-search-cities.php").then(okCities, notok);
                function okCities(response) {
                    $scope.cities = response.data;
                    $scope.citySelected = $scope.cities[0];
                }
            }
            $scope.fetchAll = function () {
                $http.get("../process/citizen-search-getAll.php?category=" + $scope.categorySelected.category + "&city=" + $scope.citySelected.city).then(ok, notok);
                function ok(response) {
                    $scope.cards = response.data;
                }
            }
            $scope.doModal=function(card){
                $http.get("../process/citizen-search-modalInfo.php?username="+card.username).then(okModal, notok);
                function okModal(response) {
                    $scope.modalInfo = response.data;
                    console.log($scope.modalInfo);
                    $scope.modalInfo=$scope.modalInfo[0];
                }
                $scope.problemInfo=card;
            }

            $scope.sendMessage=function(contact,userId){
                // console.log("Here");
                if($scope.message!=""){
                    let message=$scope.message;
                    $http.get("../process/sendMessage.php?mobile="+contact+"&message="+message).then(ok,notok);
                    function ok(response){
                        if(response.data=="ok")
                            alert("Message Send Successfully...");
                            // console.log(response.data);
                    }

                    function notok(error) {
                        console.log(error);
                    }
                }else{
                    alert("Please fill on your message...");
                }
            }

        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="fetchLists();start();">
    <?php include_once("models-navbar.php");?>
    <div class="center-SearchFields">
    <select ng-options="obj.category for obj in categories" ng-model="categorySelected">
    </select>
    <select ng-options="obj.city for obj in cities" ng-model="citySelected">
    </select>
    <button class="btn btn-primary m-3" ng-click="fetchAll();">  <i class="fa fa-search"></i>
    </button>
    </div>

   <div id="card-deck">
            <div class="card" ng-repeat="card in cards">
            <div class="card-body">
                    <p class="card-text">
                        Name: <span class="font-weight-bold">{{card.username}}</span>
                    </p>
                    <p class="card-text">
                        Location: <span class="font-weight-bold">{{card.location}}</span>
                    </p>
                    <p class="card-text">
                        Problem: <span class="font-weight-bold">{{card.problem}}</span>
                    </p>
                    <p class="card-text">
                        Valid Till: <span class="font-weight-bold"> {{card.daysTill}}</span>
                    </p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal"
                        ng-click="doModal(card);">See More Details</a>
                </div>
            </div>
    </div> 


    

    <div class="modal" tabindex="-1" id="modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{modalInfo.name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <p>Name : <span class="font-weight-bold"> {{modalInfo.name}} </span> </p>
                      <p>Contact : <span class="font-weight-bold"> {{modalInfo.contact}} </span> </p>
                      <p>Problem : <span class="font-weight-bold"> {{problemInfo.problem}} </span> </p>
                      <p>Location : <span class="font-weight-bold"> {{problemInfo.location}} </span> </p>
                      <p>Valid Till : <span class="font-weight-bold"> {{problemInfo.daysTill}} </span> </p>
                      
                      <!-- <div>Ratings</div> -->
                      <form>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message, if you are interested to have your work done:</label>
                            <textarea class="form-control border border-dark" ng-model="message" rows="2"></textarea>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                     <input type="button" ng-click="sendMessage(modalInfo.contact,userId);" class="btn btn-primary" value="Message">
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="../ajax/sendMessage.js"></script> -->

</body>

</html>