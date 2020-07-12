<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        var myModule = angular.module("myModule", []);
        myModule.controller("myController", function ($scope, $http) {

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
            $scope.doModal=function(username){
                $http.get("../process/citizen-search-modalInfo.php?username="+username).then(okModal, notok);
                function okModal(response) {
                    $scope.modalInfo = response.data;
                    console.log($scope.modalInfo);
                    $scope.modalInfo=$scope.modalInfo[0];
                }
            }

        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="fetchLists();">
    <select ng-options="obj.category for obj in categories" ng-model="categorySelected">
    </select>
    <select ng-options="obj.city for obj in cities" ng-model="citySelected">
    </select>
    <input type="button" value="Search" ng-click="fetchAll();">


    <hr>
    <hr>
    <div class="row">
        <div class="col-md-3" ng-repeat="card in cards">
            <div class="card" style="height:200px;">
                <div class="card-body">
                    <p class="card-text">
                        {{card.location}}
                    </p>
                    <p class="card-text">
                        {{card.problem}}
                    </p>
                    <p class="card-text">
                        Valid Till: {{card.daysTill}}
                    </p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal"
                        ng-click="doModal(card.username);">See More Details</a>
                </div>
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
                <p>{{modalInfo.username}}</p>
                <p>{{modalInfo.a}}</p>
                <p></p>
            </div>
        </div>


</body>

</html>