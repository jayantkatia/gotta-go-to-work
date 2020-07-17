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
    <!-- Font Awesome -->
    <link href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style-citizen-dashboard.css">
    <title>WP | Dashboard</title>
    <link rel="stylesheet" href="../css/citizen-tables.css">
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
                // console.log("hello");
                function ok(response) {
                    // console.log(response.data);
                    $scope.requirements = response.data;
                }

            }
            $scope.doDelete = function (rid) {
                // alert(rid);
                url = "../process/citizen-requirementsDelete.php?rid=" + rid;
                $http.get(url).then(ok, notok);
                function ok(response) {
                    // console.log(response.data);
                    // alert(response.data);
                }

                $scope.doFetchRequirements();
            }
            $scope.fetchRatings = function (username) {
                // console.log("sadasd ");
                $http.get("../process/citizen-fetchRatings.php?username=" + username).then(ok, notok);
                function ok(response) {
                    $scope.ratingsInfo = response.data;
                    // console.log($scope.ratingsInfo);
                }
            }
            $scope.updateRatings = function (rid, workerUsername, index) {
                // console.log(rid);

                var ele = document.getElementsByName(rid);
                for (i = 0; i < ele.length; i++) {
                    if (ele[i].checked) {
                        $scope.ratingsValue = ele[i].value;
                        $http.get("../process/citizen-updateRatings.php?username=" + workerUsername + "&rating=" + $scope.ratingsValue + "&rid=" + rid).then(ok, notok);
                        function ok(response) {
                            if (response.data == "ok") {
                                $scope.ratingsInfo.splice(index, 1);
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
    <input type="text" id="citizenUsername" class="hidden" ng-model="userId" readonly />

    <div id="card-deck">
        <div class="card" id="userProfileCard">
            <img src="../res/images/user.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">My Profile</h5>
                <p class="card-text">Update your profile to get better services around you.</p>
                <a href="#" class="btn btn-primary">Navigate to Profile</a>
            </div>
        </div>

        <div class="card" id="postRequirementsCard" data-toggle="modal" data-target="#postRequirementsModal">
            <img src="../res/images/add.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Add Work</h5>
                <p class="card-text">Post your work requirements to let service providers know</p>
                <button class="btn btn-primary">Post Work</button>
            </div>
        </div>

        <div class="card" id="rateCard" data-toggle="modal" data-target="#rateModal" ng-click="fetchRatings(userId);">
            <img src="../res/images/004-stars.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Rate Services</h5>
                <p class="card-text">Let the service provider know how much you loved it!!</p>
                <a href="#" class="btn btn-primary">Give Ratings</a>
            </div>
        </div>


        <div class="card" data-toggle="modal" data-target="#requirementManagerModal"
            ng-click="doFetchRequirements(userId);">
            <img src="../res/images/005-plan.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Requirement Manager</h5>
                <p class="card-text">Keep track of all the services you need</p>
                <a href="#" class="btn btn-primary">Open Manager</a>
            </div>
        </div>

        <div class="card" onclick="window.location.href='citizen-search.php';">
            <img src="../res/images/007-search.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Search Services</h5>
                <p class="card-text">Get going by searching service providers around you</p>
                <a href="#" class="btn btn-primary">Start Searching</a>
            </div>
        </div>

    </div>



    <div class="modal" tabindex="-1" id="requirementManagerModal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Requirements Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <div>
                        <input type="text" ng-model="userId" readonly>
                        <button type="submit" ng-click="doFetchRequirements();">
                            Fetch Requirements
                        </button>
                    </div> -->

                    <div ng-switch="requirements.length">
                        <div ng-switch-when="0" ng- class="emptyModal">
                            
                            <img src="../res/images/002-box.png" alt="">
                            <h3>Empty !!</h3>
                            <p>Post Work Requirements and manage them here...</p>
                        </div>
                        <div ng-switch-default>
                            <table>
                                <thead>
                                <tr>
                                    <th>Date Registered</th>
                                    <th>Category</th>
                                    <th>Problem</th>
                                    <th>Location</th>
                                    <th>City</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                                <tr ng-repeat="requirement in requirements">
                                    <td>{{requirement.dop}}</td>
                                    <td>{{requirement.category}}</td>
                                    <td>{{requirement.problem}}</td>
                                    <td>{{requirement.location}}</td>
                                    <td>{{requirement.city}}</td>
                                    <td><button class="btn btn-danger font-weight-bold" ng-click="doDelete(requirement.rid)">Delete</button></td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
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
                            <!-- <div class="form-group col-md-6">
                                <label for="usernamePostRequirements">Username</label>
                                <input type="text" class="form-control" ng-model="userId" readonly
                                    id="usernamePostRequirements" required name="username">
                            </div> -->
                            <div class="form-group col-md-6">
                                <label for="categoryPostRequirements">Category</label>
                                <input list="categoryPostRequirements" id="categoryPostRequirement" class="form-control" required name="category">

                                <datalist id="categoryPostRequirements">
                                    <!-- <option value="">Select Category..</option> -->
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cityPostRequirements">City</label>
                                <input type="text" class="form-control" id="cityPostRequirements" required name="city">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="problemPostRequirements">Problem</label>
                                <input type="text" class="form-control" id="problemPostRequirements" required
                                    name="problem">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="locationPostRequirements">Location</label>
                                <input type="text" class="form-control" id="locationPostRequirements" required
                                    name="location">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
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
                    <div ng-switch="ratingsInfo.length">
                        <div ng-switch-when="0" class="emptyModal">
                            <img src="../res/images/002-box.png" alt="">
                            <h3>All Done !!</h3>
                            <p>Ask service provider to update request ratings...</p>
                        </div>
                        <div ng-switch-default>
                            <table>
                                <thead>
                                <tr>
                                    <th>RID</th>
                                    <th>Worker Name</th>
                                    <th>Ratings</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tr ng-repeat="obj in ratingsInfo">
                                    <td>{{obj.rid}}</td>
                                    <td>{{obj.workerUsername}}</td>
                                    <td class="noWrap">
                                        <form>
                                            <div class="rating">
                                                <input type="radio" name={{obj.rid}} class="hide" id="star5-{{obj.rid}}"
                                                    value="5"><label for="star5-{{obj.rid}}">&#9734;</label>
                                                <input type="radio" name={{obj.rid}} class="hide" id="star4-{{obj.rid}}"
                                                    value="4"><label for="star4-{{obj.rid}}">&#9734;</label>
                                                <input type="radio" name={{obj.rid}} class="hide" id="star3-{{obj.rid}}"
                                                    value="3"><label for="star3-{{obj.rid}}">&#9734;</label>
                                                <input type="radio" name={{obj.rid}} class="hide" id="star2-{{obj.rid}}"
                                                    value="2"><label for="star2-{{obj.rid}}">&#9734;</label>
                                                <input type="radio" name={{obj.rid}} class="hide" id="star1-{{obj.rid}}"
                                                    value="1"><label for="star1-{{obj.rid}}">&#9734;</label>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning text-white font-weight-bold"
                                            ng-click="updateRatings(obj.rid,obj.workerUsername,$index);">Update</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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