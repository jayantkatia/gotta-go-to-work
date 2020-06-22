<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManPowerServices | Start</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles-auth.css">
    <script src="../js/nonNumerics.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <a class="navbar-brand" href="#">ManPowerServices</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="ml-5 text-white " data-toggle="modal" data-target="#signUpModal">
                        Sign Up
                    </a>
                </li>
                <li class="nav-item">
                    <a class="ml-5 text-white" data-toggle="modal" data-target="#logInModal">
                        Log In
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="modal" tabindex="-1" role="dialog" id="signUpModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Sign Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="signUpForm">    
                        <div class="form-group">
                            <label for="usernameSignUp">Username</label>
                            <input type="text" class="form-control" id="usernameSignUp" name="username">
                            <span id="usernameSignUpHelp" class="form-text invisible">Username</span>
                        </div>
                        <div class="form-group">
                            <label for="passwordSignUp">Password</label>
                            <input  type="password" class="form-control" name="password" id="passwordSignUp">
                            <span id="passwordSignUpHelp" class="form-text invisible">Password</span>
                        </div>
                        <div class="form-group">
                            <label for="mobileSignUp">Mobile Number</label>
                            <input  type="text" onkeypress="return getNonNumerics();"  class="form-control" id="mobileSignUp" name="mobile">
                            <span id="mobileSignUpHelp" class="form-text invisible">Mobile</span>
                        </div>
                        <div class="form-group">
                            <label for="categorySignUp">Category</label>
                            
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="categorySignUp">
                                <label class="btn btn-outline-primary ">
                                  <input type="radio" name="category" value="citizen" id="categorySignUpCitizen"> Citizen
                                </label>
                                <label class="btn btn-outline-primary">
                                  <input type="radio" name="category" value="worker" id="categorySignUpWorker"> Worker
                             <span id="categorySignUpHelp" class="form-text invisible">Category</span>
                        </div>
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="signUpSubmit" class="btn btn-primary">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal" tabindex="-1" role="dialog" id="logInModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="prev"></div>
                    <form id="logInForm">
                        <div class="form-group">
                            <label for="usernameLogIn">Username</label><i class="ml-3 fa " id="tick"></i>
                            <input type="text" class="form-control" id="usernameLogIn" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordLogIn">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordLogIn" required>
                            <a href="#" data-toggle="modal" data-dismiss="modal" class="float-right" data-target="#forgotPasswordModal">Forgot Password?</a>
                        </div>
                        <span id="logInHelp" class="form-text invisible">Any problem, contact developer</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="logInSubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="forgotPasswordModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="form-group">
                            <label for="usernameForgotPassword">Username</label>
                            <input type="text" class="form-control" id="usernameForgotPassword" name="username">
                        </div>
                        <div class="form-group" id="forgotPasswordHidden">
                            <label for="passwordForgotPassword">Password</label>
                            <input type="text" readonly class="form-control" name="password" id="passwordForgotPassword">
                        </div>
                       <button type="button" class="btn btn-primary float-right" id="forgotPasswordSubmit" >Get Password</button>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

        <?php 
            if(!empty($_GET['msg'])){
            echo $_GET['msg'] ; }   
        ?>
    
    <h3 class="text-success font-weight-bold" id="msg"></h3>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../ajax/auth-SignUp.js"></script>
    <script src="../ajax/auth-LogIn.js"></script>
    <script src="../ajax/auth-ForgotPass.js"></script>
</body>

</html>