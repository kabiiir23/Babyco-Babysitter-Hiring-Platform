<?php
// Initialize the session
require_once "config.php";
session_start();

    //$key = $link->escape_string($_GET["key"]);
    $result = $link->query(
        "SELECT * FROM `Requests`"
    );

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
    <nav class="navbar navbar-light navbar-expand-md navbar navbar-expand-xl fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="requests.php">BABYCO</a>
            <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="profile.php" class="nav-link js-scroll-trigger"><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="profile.php" class="nav-link js-scroll-trigger">Profile</a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="babysitters.php" class="nav-link js-scroll-trigger">Babysitters</a></li>
                    <li role="presentation" class="nav-item nav-link js-scroll-trigger"><a href="logout.php" class="nav-link active js-scroll-trigger">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image: url(&quot;assets/img/4k-babysitter-little-girl-reading-together-at-home_evde-c8rg__F0000.png&quot;);">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 offset-xl-0">
                        <div class="row">
                            <div class="col-lg-8 col-xl-9 offset-xl-0 mx-auto">
                                <h1 class="brand-heading" style="margin: 25px 0px;font-size: 35px;">New Requests</h1>
                            </div>
                        </div>
                    <?php
                    if ($result->num_rows > 0) {
                    ?>   
                        <div class="table-responsive border rounded" style="margin: 25px 0px;background-color: #f1f7fc;color: rgb(0,0,0);">
                            <table class="table">
                            
                                <thead>
                                    <tr>
                                        <th class="table-dark" style="background-color: rgba(0,0,0,0);color: #1e2833;">Name</th>
                                        <th>Email</th>
                                        <th>bbs_id</th>
                                        <th>Address</th>
                                        <th>Education</th>
                                        <th>Phone</th>
                                        <th>Documents</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?> 
                                    <tr class="table-active">
                                        <td><?php echo $row['Name']; ?></td> 
                                        <td><?php echo $row['Email']; ?></td>
                                        <td><?php echo $row['bbs_id']; ?></td>
                                        <td><?php echo $row['Address']; ?></td>
                                        <td><?php echo $row['Education']; ?></td>
                                        <td><?php echo $row['Phone']; ?></td>
                                        <td><a href="download.php?id=<?php echo $row['bbs_id']; ?>"  title="DOWNLOAD">DOWNLOAD</a></td>
                                        <td class="text-center d-xl-flex justify-content-xl-center" style="height:81px">
                                        <a class="btn btn-primary btn-block border rounded" role="button" style="margin: 4px 5px;" href="add.php?email=<?php echo $row['Email']; ?>">Add</a>
                                        <a class="btn btn-primary btn-block border rounded" role="button" style="margin: 4px 5px;background-color: rgb(220,75,66);" href="reject.php?email=<?php echo $row['Email']; ?>" >Reject</a>
                                        </td>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        }
                        else{
                        ?>
                        <div class="row">
                            <div class="col-lg-8 col-xl-9 offset-xl-0 mx-auto">
                                <h1 class="brand-heading" style="margin: 25px 0px;font-size: 45px;">There are no new requests</h1>
                            </div>
                        </div>
                        <?php
                        }
                        mysqli_free_result($result);
                        mysqli_close($link);
                        ?>    
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