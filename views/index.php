<!DOCTYPE html>
<html lang="en">
<?php 
 session_start();
 session_destroy();
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WP | Start</title>
    <!-- Font Awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Bs CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="../css/styles-auth.css" />
    <!-- Provides numeric auth -->
    <script src="../js/numericsOnly.js"></script>
</head>

<body>





    <!-- Modals -->
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
                            <input type="text" class="form-control" id="usernameSignUp" name="username" />
                            <span id="usernameSignUpHelp" class="form-text invisible">Username</span>
                        </div>
                        <div class="form-group">
                            <label for="passwordSignUp">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordSignUp" />
                            <span id="passwordSignUpHelp" class="form-text invisible">Password</span>
                        </div>
                        <div class="form-group">
                            <label for="mobileSignUp">Mobile Number</label>
                            <input type="text" onkeypress="return getOnlyNumerics();" class="form-control"
                                id="mobileSignUp" name="mobile" />
                            <span id="mobileSignUpHelp" class="form-text invisible">Mobile</span>
                        </div>
                        <div class="form-group">
                            <label for="categorySignUp">Category</label>

                            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="categorySignUp">
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="category" value="citizen" id="categorySignUpCitizen" />
                                    Citizen
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="category" value="worker" id="categorySignUpWorker" />
                                    Worker
                                </label>
                            </div>
                            <span id="categorySignUpHelp" class="form-text invisible">Category</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="signUpSubmit" class="btn btn-primary">
                        Sign Up
                    </button>
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
                    <!-- <div id="prev"></div> -->
                    <form id="logInForm">
                        <div class="form-group">
                            <label for="usernameLogIn">Username</label><i class="ml-3 fa" id="tick"></i>
                            <input type="text" class="form-control" id="usernameLogIn" name="username" required />
                        </div>
                        <div class="form-group">
                            <label for="passwordLogIn">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordLogIn" required />
                            <a href="#" id="forgotPasswordFormLink" data-toggle="modal"
                                data-target="#forgotPasswordModal" class="float-right">Forgot Password?</a>
                        </div>
                        <span id="logInHelp" class="form-text invisible">Any problem, contact developer</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="logInSubmit" class="btn btn-primary">
                        Submit
                    </button>
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
                            <input type="text" class="form-control"  id="usernameForgotPassword" name="username" />
                        </div>
                        <button type="button" class="btn btn-primary float-right" id="forgotPasswordSubmit">
                            Get Password
                        </button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="successfulModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content round-4">
                <div class="modal-body">
                    <p>Signed Up Succesfully</p>
                    <img src="../res/images/giphy.gif" alt="">
                    <small>Congratulations on starting your experience to an exciting way to
                        find and deliver services...</small>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="successfulModalForgot">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content round-4">
                <div class="modal-body">
                    <p>Password Sent Successfully</p>
                    <img src="../res/images/giphy.gif" alt="">
                    <small>Check your registered contant number</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Body -->
    <div id="main-body">
        <div class="sticky-top">
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarToggler">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a id="brand-name" href="#" class="navbar-brand">WorkPanel</a>

                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav ml-auto mr-5">
                        <li class="nav-item">
                            <a data-toggle="modal" data-target="#signUpModal">
                                <i class="fa fa-user-plus"></i> Sign Up
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="modal" data-target="#logInModal">
                                <i class="fa fa-sign-in"></i> Log In
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- <div class="alert alert-success hidden" role="alert">
                <strong>Signed Up Succesfully!</strong><br />
                <small>
                    Congratulations on starting your experience to an exciting way to
                    find and deliver services...
                </small>
            </div> -->
        </div>

        <div id="contentBody">
            <!-- <button data-toggle="modal" data-target="#successfulModalForgot">Successful Modal</button> -->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- <div class="carousel-item active">
                        <img src="../res/images/cc-1.jpeg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                        <h2>Hire</h2> <p>Get hired or hire for services.</p></div></div> -->
                    <div class="carousel-item active">
                        <img src="../res/images/car1.jpeg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block left-black">
                            <h3>Search</h3>
                            <p>find work around you</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <h3 class="myHeader">
                Our Services
            </h3>
            <div id="card-deck">
                <div class="card">
                    <img src="../res/images/010-search-1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Search</h5>
                        <p class="card-text">Look for services around you and get it done with ease</p>
                    </div>
                </div>
                <div class="card">
                    <img src="../res/images/005-technical-support-1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Get Work</h5>
                        <p class="card-text">Helps you to find work suitable to your occupation</p>
                    </div>
                </div>
                <div class="card" >
                    <img src="../res/images/003-favorite.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rate Services</h5>
                        <p class="card-text">Let the service provider know how much you loved it</p>
                    </div>
                </div>
                <div class="card">
                    <img src="../res/images/002-testing.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Post Work</h5>
                        <p class="card-text">Post your work requirements to let service providers know</p>
                    </div>
                </div>
            </div>
            <h3 class="myHeader">
                Meet the Developers
            </h3>
            

            <div class="row flex evenly wrap">
                <div class="col-md-5 developer flex">
                    <div><img src="../res/developer/me.jpeg" alt=""></div>
                    <div class="flex-center flex">
                        <h4>Jayant Katia</h4>    
                        <p>Life long student who has a knack for new technology and its applicaton. Enthusiastic team player who has interest in sports.</p>
                    </div>
                </div>
                <div class="col-md-5 developer flex">
                    <div><img src="../res/developer/sir.jpg" alt=""></div>
                    <div class="flex-center flex">
                        <h4>Rajesh Bansal</h4>    
                        <p>20+ Years experience in Training & Development. Loves coding in Java, C++, Python, Android. Founder - <a href="www.realjavaonline.com">realjavaonline.com</a></p>
                    </div>
                </div>
            </div>
            
            <h3 class="myHeader">
                Reach Us
            </h3>


            <div class="reachus">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.880733791601!2d74.95013941558398!3d30.21195128182168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a4f07278a9%3A0x4a0d6293513f98ce!2sBanglore%20Computer%20Education%20(C%20C%2B%2B%20Android%20J2EE%20PHP%20Python%20AngularJs%20Spring%20Java%20Training%20Institute)!5e0!3m2!1sen!2sin!4v1594722447373!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fjavascript&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>            </div>

                </div>
           
            <!-- <div class="flex wrap reachus evenly">
                <div>
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.880733791601!2d74.95013941558398!3d30.21195128182168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a4f07278a9%3A0x4a0d6293513f98ce!2sBanglore%20Computer%20Education%20(C%20C%2B%2B%20Android%20J2EE%20PHP%20Python%20AngularJs%20Spring%20Java%20Training%20Institute)!5e0!3m2!1sen!2sin!4v1594722447373!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fjavascript&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>            </div>
        </div> -->
    </div>
    <footer> JayantKatia-BCE&copy2020
    </footer>
    <!--BS JS and jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!-- js and Ajax Files  -->
    <script src="../ajax/auth-SignUp.js"></script>
    <script src="../ajax/auth-LogIn.js"></script>
    <script src="../ajax/auth-ForgotPass.js"></script>
</body>

</html>