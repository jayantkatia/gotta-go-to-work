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
    <!-- Font Awesome -->
    <link href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style-citizen-dashboard.css">
    <title>Dashborad | MPS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <link rel="stylesheet" href="../css/citizen-rateStars.css">
    <script>
        var myModule = angular.module("myModule", []);
        myModule.controller("myController", function ($scope, $http) {
            $scope.userId;
            $scope.userPageInfo;
            $scope.ratingsInfo;
            $scope.start = function () {
                // "userId='<?php echo $_SESSION["activeUser"];?>',userPageInfo='\'s Dashboard'"
                $scope.userId = '<?php echo $_SESSION["activeUser"];?>';
                $scope.userPageInfo = " " + $scope.userId + "\'s  Dashboard";
            }
            function notok(error) {
                console.log(error);
            }
            $scope.doFetchRequirements = function () {
                url = "../process/citizen-requirements.php?username=" + $scope.userId;
                $http.get(url).then(ok, notok);
                function ok(response) {
                    console.log(response.data);
                    $scope.requirements = response.data;
                }

            }
            $scope.doDelete = function (rid) {
                alert(rid);
                url = "../process/citizen-requirementsDelete.php?rid=" + rid;
                $http.get(url).then(ok, notok);
                function ok(response) {
                    console.log(response.data);
                }

                $scope.doFetchRequirements();
            }
            $scope.fetchRatings = function (username) {
                console.log("sadasd ");
                $http.get("../process/citizen-fetchRatings.php?username=" + username).then(ok, notok);
                function ok(response){
            $scope.ratingsInfo = response.data;
            console.log($scope.ratingsInfo);
                }
            }
            $scope.updateRatings=function(rid,workerUsername,index){
                console.log(rid);

                var ele = document.getElementsByName(rid); 
                for(i = 0; i < ele.length; i++) { 
                    if(ele[i].checked) {
                        $scope.ratingsValue=ele[i].value; 
                        $http.get("../process/citizen-updateRatings.php?username="+workerUsername+"&rating="+$scope.ratingsValue+"&rid="+rid).then(ok,notok);
                        function ok(response){
                            if(response.data=="ok"){
                                $scope.ratingsInfo.splice(index,1);
                            }
                        }
                    }
                }

            }

        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController" ng-init="start();">
    <?php include_once("models-successfulModal.php");?>
    <?php include_once("models-navbar.php");?>

    <div id="cards-container">
        <div class="card" style="width: 18rem;" id="userProfileCard">
            <img src="../res/images/user.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">User Profile</h5>
                <p class="card-text">Change User profile </p>
                <a href="citizen-profile.php" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;" id="postRequirementsCard">
            <img src="../res/images/001-leonardo.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Add work</h5>
                <p class="card-text">Post your work requirements.</p>
                <a href="#" data-toggle="modal" data-target="#postRequirementsModal" 
                    class="btn btn-primary">Go
                    somewhere</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;" id="rateCard">
            <img src="../res/images/002-gundam.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Rate Worker</h5>
                <p class="card-text">Rate the services you received.</p>
                <a href="#" data-toggle="modal" data-target="#rateModal" ng-click="fetchRatings(userId);"class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="../res/images/001-leonardo.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Requirement Manager</h5>
                <p class="card-text">Post your work requirements.</p>
                <a href="#" data-toggle="modal" data-target="#requirementManagerModal" class="btn btn-primary">Go
                    somewhere</a>
            </div>
        </div>
    </div>



    <div class="modal" tabindex="-1" id="requirementManagerModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Requirements Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="text" ng-model="userId" readonly>
                        <button type="submit" ng-click="doFetchRequirements();">
                            Fetch Requirements
                        </button>
                    </div>
                    <table>
                        <tr>
                            <th>Date Registered</th>
                            <th>Category</th>
                            <th>Problem</th>
                            <th>Location</th>
                            <th>City</th>
                        </tr>
                        <tr ng-repeat="requirement in requirements">
                            <td>{{requirement.dop}}</td>
                            <td>{{requirement.category}}</td>
                            <td>{{requirement.problem}}</td>
                            <td>{{requirement.location}}</td>
                            <td>{{requirement.city}}</td>
                            <td><button ng-click="doDelete(requirement.rid)">Delete</button></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- !button of modal does not opens modals -->

    <div class="modal" tabindex="-1" role="dialog" id="postRequirementsModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post Work Requirements</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="postRequirementsForm">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="usernamePostRequirements">Username</label>
                                <input type="text" class="form-control" ng-model="userId" readonly
                                    id="usernamePostRequirements" required name="username">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="categoryPostRequirements">Category</label>
                                <select id="categoryPostRequirements" class="form-control" required name="category">
                                    <option value="">Select Category..</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="problemPostRequirements">Problem</label>
                                <input type="text" class="form-control" id="problemPostRequirements" required
                                    name="problem">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="locationPostRequirements">Location</label>
                                <input type="text" class="form-control" id="locationPostRequirements" required
                                    name="location">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cityPostRequirements">City</label>
                                <input type="text" class="form-control" id="cityPostRequirements" required name="city">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" id="postRequirementsSubmit" class="btn btn-primary"
                            value="Post Requirements" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 
     -->

    <div class="modal" tabindex="-1" id="rateModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rate Worker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <th>RID</th>
                            <th>Worker Name</th>
                            <th>Ratings</th>
                            <th>Actions</th>
                        </tr>
                        <tr ng-repeat="obj in ratingsInfo">
                            <td>{{obj.rid}}</td>
                            <td>{{obj.workerUsername}}</td>
                            <td>
                                <form>
                            <div class="rating">
                                <input type="radio" name={{obj.rid}} class="hide" id="star5-{{obj.rid}}" value="5"><label for="star5-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star4-{{obj.rid}}" value="4"><label for="star4-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star3-{{obj.rid}}" value="3"><label for="star3-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star2-{{obj.rid}}" value="2"><label for="star2-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star1-{{obj.rid}}" value="1"><label for="star1-{{obj.rid}}">&#9734;</label>
                            </div>
                            </form>
                            </td>
                            <td>
                                <button ng-click="updateRatings(obj.rid,obj.workerUsername,$index);">Update</button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--  -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/citizen-dashboard.js"></script>
    <script src="../ajax/citizen-dashboard.js"></script>




</body>

</html>