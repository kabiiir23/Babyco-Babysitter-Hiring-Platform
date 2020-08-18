<?php

require_once "config.php";

$email = $_GET['email'];

$sql1="DELETE FROM `Babysitter` WHERE `Email` = '{$email}'";
if($stmt1 = mysqli_prepare($link, $sql1)){
    mysqli_stmt_execute($stmt1);
    header("location: babysitters.php");
}   
mysqli_stmt_close($stmt1);
mysqli_close($link);
?>