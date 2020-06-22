<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles-citizen-profile.css">
    <title>Profile</title>
</head>

<body>
    <form id="citizenForm" action="../process/citizen-profile-submit.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="citizenUsername">Username</label>
                <input type="text" class="form-control" id="citizenUsername" required name="username">
            </div>
            <div class="offset-1 col-1">
                <button type="button" class="btn-primary" id="citizenFetch">Fetch Profile</button>
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="citizenName">Citizen Name</label>
                <input type="text" class="form-control" id="citizenName"required name="name">
            </div>
            <div class="form-group col-md-6">
                <label for="citizenContact">Contact Number</label>
                <input type="text" class="form-control" id="citizenContact" required name="contact">
            </div>
        </div>
        <div class="form-group">
            <label for="citizenAddress">Address</label>
            <input type="text" class="form-control" id="citizenAddress" required name="address">
        </div>
        
        <div class="form-row">
            
            <div class="form-group col-md-4">
                <label for="citizenState">State</label>
                <select id="citizenState" onchange="print_city('citizenCity', this.selectedIndex);" class="form-control" required name="state">
                    <option value="">Please Select one..</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="citizenCity">City</label>
                <select class="form-control" name="city" id="citizenCity" required>
                   <option value="">Please Select State first..</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="citizenEmail">Email</label>
                <input type="text" class="form-control" id="citizenEmail" required name="email">
            </div>
            <div class="offset-1 col-1">
                <input type="file" name="pic" onchange="showpreview(this,'prev');"  id="citizenFile">
            </div>
            <div class="offset-1 col-3">
                <img src="" id="prev" alt="" style="width:200px;height:200px ;">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="update/save" value="update/save">
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/citizen-profile-main.js"></script>
    <script src="../ajax/citizen-profile.js"></script>
    <script src="../js/previewPic.js"></script>
</body>

</html>