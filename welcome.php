<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Babyco</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fanwood+Text">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
</head>

<body id="page-top">
    <nav class="navbar navbar-light navbar-expand-md navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="#">BABYCO</a>
            <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="#contact" class="nav-link js-scroll-trigger"><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="profile.php" class="nav-link js-scroll-trigger">Profile</a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="babysitters copy.php" class="nav-link js-scroll-trigger">Babysitters</a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="logout.php" class="nav-link active js-scroll-trigger">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image: url(&quot;assets/img/4k-babysitter-little-girl-reading-together-at-home_evde-c8rg__F0000.png&quot;);">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 offset-xl-2">
                        <form action="search.php" method="get" class="form-inline">
                            <div class="form-group d-inline-flex">
                                <input type="search" name="key" placeholder="Search with your area" class="border rounded shadow form-control form-control-lg" style="width: 578px;height: 58px;" />
                                <button class="btn btn-primary btn-lg border rounded shadow-lg flex-shrink-1"
                                        type="submit" style="background-color: #ffffff;margin: 0px 10px;width: 139px;color: #414141;padding: 0px;height: 58px;">SEARCH</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-xl-9 offset-xl-0 mx-auto">
                        <h1 class="brand-heading" style="filter: blur(0px);font-size: 73px;">FIND A BABYSITTER IN YOUR AREA</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="map-clean"></div>
    <footer>
        <div class="container text-center">
            <p>BABYCO 2019</p>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/grayscale.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>