<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$password = $email = $address = $phone = $education = $documents = "";
$email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){    
        $email_err = "Please enter an email.";
    } 
    else{
        $sql1 = "SELECT bbs_id FROM Babysitter WHERE Email = ?";
        
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
    
        

    //$email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);
    $name = trim($_POST["name"]);
    $education = trim($_POST["education"]);
    
    $documents = addslashes(file_get_contents($_FILES['doc']['tmp_name']));
    
    $sql = "INSERT INTO `Requests`(`Name`, `Email`, `Address`, `Phone`, `pass`, `Education`, `Documents`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if(empty($email_err)){
        if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssb", $param_name, $param_email, $param_address, $param_phone, $param_password, $param_education, $param_documents);
            // Set parameters
            $param_name = $name;
            $param_password = $password; // Creates a password hash
            $param_email = $email;
            $param_address = $address;
            $param_phone = $phone;
            $param_education = $education;
            $param_documents = $documents;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: wait.php");
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
                <div class="row text-center d-block flex-grow-1" style="opacity: 0.82;font-size: 46px;filter: blur(0px);margin: 0px 180px;background-color: rgba(0,0,0,0.66);height: 800px;">
                    <div class="col-lg-8 m-auto" style="background-color: rgba(0,0,0,0);height: 601px;padding: 15px 15px;">
                        <form method="post"><label class="text-uppercase" style="font-size: 29px;font-family: Cabin, sans-serif;font-weight: bold;font-style: normal;color: rgb(81,201,155);">Signup as Babysitter&nbsp;</label><i class="typcn typcn-social-instagram-circular"
                                style="color: rgb(82,204,158);"></i>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="name" required="" placeholder="Name"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="email" name ="email" required="" placeholder="Email"><span class="help-block" style="font-size: 18px;"><?php echo $email_err; ?></span></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="password" name ="password" required="" placeholder="Password" minlength="6"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="phone" required="" placeholder="Phone"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="address" required="" placeholder="Address"></div>
                            <div class="form-group"><input class="bg-light form-control form-control-lg" type="text" name="education" required="" placeholder="Education"></div>
                            <div class="form-group bg-light border rounded"><small class="form-text text-center" style="font-size: 21px;background-color: rgba(169,150,93,0);color: rgb(104,106,111);">Upload Recommendation Letter</small><input name="doc" type="file" style="font-size: 24px;color: rgb(101,104,109);"></div>
                            <div class="btn-group btn-group-lg" role="group"><button class="btn btn-primary border rounded shadow" type="submit" style="width: 196px;height: 63px;">SIGNUP</button></div>
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