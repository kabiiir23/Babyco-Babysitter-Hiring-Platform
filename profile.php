<?php
// Initialize the session
require_once "config.php";
session_start();

//echo $_SESSION["role"]; 
if($_SESSION["role"]=="Admin"){
    $result = $link->query(
        "SELECT * FROM Admin WHERE `Email` = '{$_SESSION["username"]}'"
    );
} elseif($_SESSION["role"]=="Client"){
    $result = $link->query(
        "SELECT * FROM Client WHERE `Email` = '{$_SESSION["username"]}'" 
    );   
} elseif($_SESSION["role"]=="Babysitter"){
    $result = $link->query(
        "SELECT * FROM Babysitter WHERE `Email` = '{$_SESSION["username"]}'" 
    );   
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Babyco - Profile</title>
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
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="welcome.php">BABYCO</a>
            <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="profile.php" class="nav-link js-scroll-trigger"><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="logout.php" class="nav-link active js-scroll-trigger">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image: url(&quot;assets/img/4k-babysitter-little-girl-reading-together-at-home_evde-c8rg__F0000.png&quot;);">
    <div class="intro-body">
        <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()): ?> 
          
            <div class="row">
                <div class="col-xl-2 offset-xl-5"><img src="assets/img/21-219524_rosalie-ndionne-woman-icon-vector-png.png" class="rounded-circle img-fluid border shadow" />
                    <h1 style="font-size: 23px;padding: 10px;"><?php echo $row['Name']?></h1><button class="btn btn-primary" type="button" style="padding: 11px;height: 45px;width: 157px;">Edit</button></div>
            </div>
            <div class="row" style="margin: 9px;">
                <div class="col-xl-6 offset-xl-3" style="padding: 0px 0px;background-color: rgba(0,0,0,0.45);color: rgb(255,255,255);font-family: Cabin, sans-serif;">
                    <p style="height: 0px;font-size: 23px;">Address: <?php echo $row['Address']?> </p>
                    <p style="height: 0px;font-size: 23px;">Phone: <?php echo $row['Phone']?></p>
                    <p style="height: 0px;font-size: 23px;">Email: <?php echo $row['Email']?></p>
                    <p style="height: 0px;font-size: 23px;">Education: <?php echo $row['Education']?></p>
                </div>
            </div>
        <?php endwhile; ?>
        <?php 
        }
        else{
        ?>
        <div class="row">
            <div class="col-lg-8 col-xl-9 offset-xl-0 mx-auto">
                <h1 class="brand-heading" style="margin: 25px 0px;font-size: 45px;">SORRY</h1>
            </div>
        </div>
        <?php
        }
        mysqli_free_result($result);
        mysqli_close($link);
        ?>   
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