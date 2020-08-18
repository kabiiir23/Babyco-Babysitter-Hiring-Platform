<?php
require_once "config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email_err = $email = "";
    if(empty(trim($_POST["email"]))){    
        $email_err = "Please enter an email.";
    } 
    else{
        $sql1 = "SELECT cli_id FROM Client WHERE Email = ?";
        
        if($stmt1 = mysqli_prepare($link, $sql1)){
            mysqli_stmt_bind_param($stmt1, "s", $param_email);
            $param_email = trim($_POST["email"]);
            if(mysqli_stmt_execute($stmt1)){
                mysqli_stmt_store_result($stmt1);
                if(mysqli_stmt_num_rows($stmt1) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt1);
    }
    
    $name = trim($_POST["name"]);
    //$email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);

    if(empty($email_err)){
        $sql = "INSERT INTO `Client`(`Name`, `Email`, `Address`, `Phone`, `pass`) VALUES (?, ?, ?, ?, ?)";     
        if($stmt = mysqli_prepare($link, $sql)){
 
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_address, $param_phone, $param_password);

            $param_name = $name;
            $param_email = $email;
            $param_password = $password; 
            $param_address = $address;
            $param_phone = $phone;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Babyco - Sign Up</title>
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

<body style="background-image: url(&quot;assets/img/4k-babysitter-little-girl-relaxing-at-home-doing-paper-crafts_ventwqlal__F0000.png&quot;);background-size: cover;">
    <nav class="navbar navbar-light navbar-expand navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="index.php">BABYCO</a><button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation" value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto"></ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image: url(&quot;assets/img/4k-babysitter-little-girl-reading-together-at-home_evde-c8rg__F0000.png&quot;);">
        <div class="intro-body">
            <div class="container">
                <div class="row text-center" style="opacity: 0.82;font-size: 46px;filter: blur(0px);background-color: rgba(0,0,0,0.5);margin: 180px;">
                    <div class="col-lg-8 mx-auto" style="background-color: rgba(0,0,0,0);">
                        <form method="post"><label class="text-uppercase" style="font-size: 29px;font-family: Cabin, sans-serif;font-weight: bold;font-style: normal;color: rgb(244,71,107);">Signup as a Guardian&nbsp;</label><i class="typcn typcn-user" style="color: rgb(244,71,107);"></i>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="name" required="" placeholder="Name"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="email" name="email" required="" placeholder="Email"><span class="help-block" style="font-size: 18px;"><?php echo $email_err; ?></span></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="password" name="password" required="" placeholder="Password" minlength="6"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="phone" required="" placeholder="Phone"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="address" required="" placeholder="Address"></div>
                            <div class="btn-group btn-group-lg" role="group"><button class="btn btn-primary border rounded shadow" type="submit" style="width: 198px;background-color: rgb(244,71,107);margin: 15px;height: 62px;">SIGNUP</button></div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </header>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/grayscale.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>