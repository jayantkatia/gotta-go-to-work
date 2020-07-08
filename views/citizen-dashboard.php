<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style-citizen-dashboard.css">
    <title>Dashborad | MPS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>
    <script>
        var myModule = angular.module("myModule", []);
        myModule.controller("myController", function ($scope, $http) {
            $scope.userIdModal;
            $scope.doFetchRequirements=function(){
                url="../process/citizen-requirements.php?username="+$scope.userIdModal;
                $http.get(url).then(ok,notok);
                function ok(response){
                    console.log(response.data);
                    $scope.requirements=response.data;
                }
                function notok(error){
                    console.log(error);
                }
            }
            $scope.doDelete=function(rid){
                alert(rid);
                url="../process/citizen-requirementsDelete.php?rid="+rid;
                $http.get(url).then(ok,notok);
                function ok(response){
                    console.log(response.data);
                }
                function notok(error){
                    console.log(error);
                }
                $scope.doFetchRequirements();
            }

        });
    </script>
</head>

<body ng-app="myModule" ng-controller="myController">

    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="#">ManPowerServices</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>



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
                <a href="#" data-toggle="modal" data-target="#postRequirementsModal" class="btn btn-primary">Go
                    somewhere</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;" id="rateCard">
            <img src="../res/images/002-gundam.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Rate Worker</h5>
                <p class="card-text">Rate the services you received.</p>
                <a href="#" data-toggle="modal" data-target="#rateModal" class="btn btn-primary">Go somewhere</a>
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
                        <input type="text" ng-model="userIdModal">
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
                                <input type="text" class="form-control" id="usernamePostRequirements" required
                                    name="username">
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
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--  -->







    <!--  -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/citizen-dashboard.js"></script>
    <script src="../ajax/citizen-dashboard.js"></script>




</body>

</html>