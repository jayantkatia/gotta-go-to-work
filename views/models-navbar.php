<style>
 
 /* Navbar Bootstrap Customisation */
 body{
    background-color: #EBEBEB;
}
nav{
    background-color:#fff;
}
#brand-name{
    color:#DE8A02;
    font-size: x-large;
    font-weight: bolder;
    margin:0 1.5rem;
    cursor: default;
}
#brand-name>span{
    color:black;
}
#brand-name .blue{
    color:#375BA9;
    white-space:pre;
}
.navbar{
    padding:0 1rem;
}
.nav-item{
    color:#375BA9;
    font-weight: bolder;
    font-size: larger;
    cursor:pointer;
    margin:0 3rem;
}
.nav-item a{
    text-decoration:none;
    color:#375BA9;
}



/* 3c64b9 */
@media (max-width: 767px) {
    .navbar{
        justify-content:start;
    }
    .nav-item{
        margin-top: 10px;
        border-bottom: 1px solid #EBEBEB;
        width:fit-content;
    }
}
/* for iphone se */
@media (max-width:360px){
    #brand-name{
     font-size:default;
        margin:0 ;
    }
}
@media (max-width:1050px){
    #brand-name{
        font-size:large;
    }
}
@media (max-width:450px){
    #brand-name span{
        display:none
    }
}



/* Modals Bootstrap Customisation */

.modal-title{
    color:#375BA9;
    font-weight: bolder;
    font-size: x-large;
}
.form-control:focus{
    border-color: #375BA9;
}

.btn-outline-primary:not(:disabled):not(.disabled).active, .btn-outline-primary:not(:disabled):not(.disabled):active, .show>.btn-outline-primary.dropdown-toggle {
    color: #fff;
    background-color:#375BA9;
    border-color: #375BA9;
}
.btn-outline-primary{
    color:#375BA9;
}
.btn-outline-primary:hover{
    background-color: #375BA9;
    border-color: #375BA9;
}
.btn-primary{
    background-color: #375BA9;
    font-weight: bolder;
}
.btn-secondary{
    font-weight: bolder;
}
.custom-toggler .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(222, 138, 2)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
}
.custom-toggler.navbar-toggler {
    border-color: #fff ;
} 
</style>

<div class="sticky-top">
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarToggler">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a id="brand-name" href="#" class="navbar-brand">ManPowerServices <span>&nbsp;|</span> <span class="blue">{{userPageInfo}}</span></a>

                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav ml-auto mr-5">
                        <li class="nav-item">
                            <a href="../process/logout.php">
                                <i class="fa fa-sign-out"></i>Log Out 
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
        </div>


