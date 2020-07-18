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
                        if(obj.ppic==null)
                        {
                            obj.ppic="../res/images/001-man.png";
                            
                        }    
                        else{
                                obj.ppic="../uploads/workers/"+obj.ppic;
                         }
                            // console.log(obj.ppic);
                        if(obj.total==0){
                            obj.total=1;
                        }
                        return true;
                    }
                });
                // console.log($scope.cards);
                // console.log($scope.cards);console.log($scope.citySelected.city);
            }
            $scope.doTransfer=function(card){
                $scope.modalInfo=card;
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

<body ng-app="myModule" ng-controller="myController" ng-init="fetchAll();start();">
    <?php include_once("models-navbar.php")?>
    <div class="center-SearchFields">
    <select ng-options="obj.category for obj in categories" ng-model="categorySelected">
    </select>
    <select ng-options="obj.city for obj in cities" ng-model="citySelected" >
    </select>
    <button class="btn btn-primary m-3" ng-click="doDisplay();">
        <i class="fa fa-search"></i>
    </button>
    </div>

    <div id="card-deck">
            <div class="card" ng-repeat="card in cards">
                <img ng-src={{card.ppic}}  class="card-img-top" alt="...">
                <div class="card-body ">
                    <p class="card-text mb-0 font-weight-bold">
                        {{card.name}}
                    </p>
                    <p class="card-text mb-0">
                        {{card.contact}}
                    </p>
               
                    
                     <!-- <div class="stars-ratings" style="width:{{1.0*card.review / card.total *25}}px"> 
                        <img src="../res/images/004-star-2.png" alt="">
                        <img src="../res/images/004-star-2.png" alt="">
                        <img src="../res/images/004-star-2.png" alt="">
                        <img src="../res/images/004-star-2.png" alt="">
                        <img src="../res/images/004-star-2.png" alt="">
                    </div> -->
                    <div class="ratings" >
                        <div class="empty-stars"></div>
                        <div class="full-stars" style="width:{{1.0*card.review / card.total *20}}%"></div>
                    </div>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal" ng-click="doTransfer(card);">See More Details</a>
                </div>
            </div>
    </div>



    <div class="modal" tabindex="-1" id="modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{modalInfo.name}}'s Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <p>Name : <span class="font-weight-bold"> {{modalInfo.name}} </span> </p>
                      <p>Contact : <span class="font-weight-bold"> {{modalInfo.contact}} </span> </p>
                      <p>Profession : <span class="font-weight-bold"> {{modalInfo.category}} </span> </p>
                      <p>Specialisation : <span class="font-weight-bold"> {{modalInfo.spec}} </span> </p>
                      <p>Experience(in yrs) : <span class="font-weight-bold"> {{modalInfo.exp}} </span> </p>
                      <p>Firm : <span class="font-weight-bold"> {{modalInfo.firm}} </span> </p>
                      <!-- <div>Ratings</div> -->
                      <form>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message, if you are interested to have your work done:</label>
                            <textarea class="form-control border border-dark" ng-model="message" rows="2"></textarea>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                     <input type="submit" ng-click="sendMessage(modalInfo.contact,userId);" class="btn btn-primary" value="Message">
                </div>
               
            </div>
        </div>
    </div>
    
</body>

</html>