<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles-worker-profile.css">
    <title>Profile</title>
</head>

<body>
    <form id="workerForm" action="../process/worker-profile-submit.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerUsername">Username*</label>
                <input type="text" class="form-control" id="workerUsername" readonly value="<?php session_start();echo $_SESSION["activeUser"] ?>" name="username">
            </div>
            <div class="offset-1 col-1">
                <button type="button" class="btn-primary" id="workerFetch">Fetch Profile</button>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerName">Worker Name*</label>
                <input type="text" class="form-control" id="workerName" required name="name">
            </div>
            <div class="form-group col-md-6">
                <label for="workerContact">Contact Number*</label>
                <input type="text" class="form-control" id="workerContact" required name="contact">
            </div>
        </div>
        <div class="form-group">
            <label for="workerAddress">Address</label>
            <input type="text" class="form-control" id="workerAddress" name="address">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="workerCity">City</label>
                <input type="text" class="form-control" id="workerCity" name="city">
            </div>
            <div class="form-group col-md-4">
                <label for="workerState">State</label>
                <select id="workerState" class="form-control" name="state">
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerEmail">Email</label>
                <input type="text" class="form-control" id="workerEmail" name="email">
            </div>
            <div class="form-group col-md-4">
                <label for="workerFirm">Firm</label>
                <input type="text" class="form-control" id="workerFirm" name="firm">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerCategory">Category</label>
                <select id="workerCategory" class="form-control" name="category">
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="workerSpec">Specialistaion</label>
                <input type="text" class="form-control" id="workerSpec" name="spec">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="workerExp">Worker Experience</label>
                <select id="workerExp" class="form-control" name="exp">
                </select>
            </div>
        </div>
        <div class="form-row">
            <label for="workerExpText">Previous Experience</label>
            <textarea class="m-2" name="exptext" id="workerExpText" cols="200" rows="2"></textarea>
        </div>
        <div class="form-row">
            <div class="offset-1 col-1">
                Aadhar:
                <input type="file" name="apic" onchange="showpreview(this,'prevAadhar');" id="workerFileAadhar">
            </div>
            <div class="offset-2 col-2">
                <img src="" id="prevAadhar" alt="" style="width:200px;height:200px ;">
            </div>
            <div class="offset-1 col-1">
                ProfilePic:
                <input type="file" name="ppic" onchange="showpreview(this,'prev');" id="workerFile">
            </div>
            <div class="offset-2 col-2">
                <img src="" id="prev" alt="" style="width:200px;height:200px ;">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="update/save" value="update/save">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/worker-profile-main.js"></script>
    <script src="../js/previewPic.js"></script>
    <script src="../ajax/worker-profile.js"></script>
</body>

</html>
