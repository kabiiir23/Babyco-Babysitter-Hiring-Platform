<?php

require_once "config.php";

$bbs_id = $_GET['bbs_id'];
$cli_id = $_GET['cli_id'];

$sql = "INSERT INTO `Jobs`(`bbs_id`, `cli_id`) VALUES (?, ?)";
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "ii", $param_bbs, $param_cli);

    $param_bbs = $bbs_id;
    $param_cli = $cli_id; 

    if(mysqli_stmt_execute($stmt)){
            header("location: hired.php");
        }
        
    } else{
        echo "Something went wrong. Please try again later.";
    }
mysqli_stmt_close($stmt);
mysqli_close($link);
?>