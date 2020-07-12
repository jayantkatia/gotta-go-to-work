<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        var myModule = angular.module("myModule", []);
        myModule.controller("myController", function ($scope, $http) {

            $scope.data;
            $scope.cities;
            $scope.citySelected;
            $scope.categories;
            $scope.categorySelected;

            $scope.fetchAll = function () {
                $http.get("../process/worker-search-getAll.php").then(ok, notok);
                function ok(response) {
                    $scope.data = response.data;
                    
                    $scope.dummy = [];
                    $scope.cities = $scope.data.filter(obj => {
                        if (!$scope.dummy.includes(obj.city)) {
                            $scope.dummy.push(obj.city);
                            return true;
                        }
                    });
                    $scope.cities=$scope.cities.map(obj=>{
                        return  {
                            city: obj.city
                        };
                    });
                    $scope.citySelected = $scope.cities[0];
                    
                    $scope.dummy = [];
                    $scope.categories = $scope.data.filter(obj => {
                        if (!$scope.dummy.includes(obj.category)) {
                            $scope.dummy.push(obj.category);
                            return true;
                        }
                    });
                    $scope.categories=$scope.categories.map(obj=>{
                        return{category:obj.category}
                    });
                    $scope.categorySelected=$scope.categories[0];
                    
                }
                function notok(error) {
                    console.log(error);
                }
            }
            ////////
            
            $scope.cards;
            $scope.doDisplay=function(){
                $scope.cards=$scope.data.filter(obj=>{
                    if(obj.city==$scope.citySelected.city && obj.category==$scope.categorySelected.category){
                        return true;
                    }
                });
                // console.log($scope.cards);console.log($scope.citySelected.city);
            }
            $scope.doTransfer=function(card){
                $scope.modalInfo=card;
            }

        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="fetchAll();">
    <select ng-options="obj.category for obj in categories" ng-model="categorySelected">
    </select>
    <select ng-options="obj.city for obj in cities" ng-model="citySelected" >
    </select>
    <input type="button" value="Search" ng-click="doDisplay();">


    <hr><hr>
    <div class="row">
        <div class="col-md-3" ng-repeat="card in cards">
            <div class="card" style="height:200px;">
                <img ng-src="../uploads/workers/{{card.ppic}}" style="height:100px;" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">
                        {{card.name}}
                    </p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal" ng-click="doTransfer(card);">See More Details</a>
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
                <p>{{modalInfo.contact}}</p>
                <p>{{modalInfo.firm}}</p>
                <p></p>
            </div>
        </div>
    </div>
    

</body>

</html>