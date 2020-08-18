<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(isset($_POST['formRole']) ){
        $varRole = $_POST['formRole'];
        echo $varRole;
        if ($varRole == "Admin"){
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT adm_id, Email, pass FROM Admin WHERE Email = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = $username;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);
                        
                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){                    
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                            if(mysqli_stmt_fetch($stmt)){
                                #echo $stmt;
                                echo $password;
                                if($password == $hashed_password){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;                            
                                    $_SESSION["role"]= $varRole;
                                    // Redirect user to welcome page
                                    header("location: requests.php");
                                } else{
                                    // Display an error message if password is not valid
                                    $password_err = "The password you entered was not valid.";
                                }
                            }
                        } else{
                            // Display an error message if username doesn't exist
                            $username_err = "No account found with that username.";
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        elseif ($varRole == "Client"){
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT cli_id, Email, pass FROM Client WHERE Email = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = $username;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);
                        
                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){                    
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                            if(mysqli_stmt_fetch($stmt)){
                                #echo $stmt;
                                echo $password;
                                if($password == $hashed_password){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;                            
                                    $_SESSION["role"]= $varRole;
                                    // Redirect user to welcome page
                                    header("location: welcome.php");
                                } else{
                                    // Display an error message if password is not valid
                                    $password_err = "The password you entered was not valid.";
                                }
                            }
                        } else{
                            // Display an error message if username doesn't exist
                            $username_err = "No account found with that username.";
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        elseif ($varRole == "Babysitter"){
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT bbs_id, Email, pass FROM Babysitter WHERE Email = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = $username;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);
                        
                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){                    
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                            if(mysqli_stmt_fetch($stmt)){
                                #echo $stmt;
                                echo $password;
                                if($password == $hashed_password){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;                            
                                    $_SESSION["role"]= $varRole;
                                    // Redirect user to welcome page
                                    header("location: jobs.php");
                                } else{
                                    // Display an error message if password is not valid
                                    $password_err = "The password you entered was not valid.";
                                }
                            }
                        } else{
                            // Display an error message if username doesn't exist
                            $username_err = "No account found with that username.";
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
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

<body style="background-image: url(&quot;assets/img/4k-babysitter-little-girl-reading-together-at-home_evde-c8rg__F0000.png&quot;);background-size: cover;">
    <div class="login-clean" style="background-color: rgba(241,247,252,0);padding: 131px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="background-color: rgba(0,0,0,0.47);height: 500px;padding: 27px;">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon-home"></i></div>
            <p class="text-center" style="color: rgb(255,255,255);">
            Login As
                <select name="formRole">
                <option value="">Select...</option>
                <option value="Client">Client</option>
                <option value="Babysitter">Babysitter</option>
                <option value="Admin">Admin</option>
                </select>
            </p>
            <div class="form-group" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input class="border rounded form-control form-control-lg" type="email" name="email" placeholder="Email" inputmode="email" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input class="border rounded form-control form-control-lg" type="password" name="password" placeholder="Password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
            <p class="text-center" style="color: rgb(255,255,255);">Not a member? &nbsp;<a href="SignUp.php" style="color: rgb(244,71,107);">Sign Up&nbsp;</a></p>
        </form>
    </div>
    <nav class="navbar navbar-light navbar-expand-md navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="index.php">BABYCO</a><button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation" value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto"></ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/grayscale.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>