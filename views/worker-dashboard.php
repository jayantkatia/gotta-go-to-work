<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style-citizen-dashboard.css">
    <title>Dashborad | MPS</title>
</head>

<body>

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


    Welcome <?php session_start();echo $_SESSION["activeUser"] ?>!!
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