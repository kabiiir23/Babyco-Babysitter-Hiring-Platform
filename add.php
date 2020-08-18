<?php

require_once "config.php";

$email = $_GET['email'];
$sql = "SELECT * FROM Requests WHERE Email = '{$email}'";
$result = $link->query($sql);
while ($row = $result->fetch_assoc()){
    $name = $row['Name'];
    $email = $row['Email'];
    $password = $row['pass'];
    $phone = $row['Phone'];
    $address = $row['Address'];
    $education = $row['Education'];
    $documents = $row['Documents'];  
}
$sql = "INSERT INTO `Babysitter`(`Name`, `Email`, `Address`, `Phone`, `pass`, `Education`, `Documents`) VALUES (?, ?, ?, ?, ?, ?, ?)";
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "ssssssb", $param_name, $param_email, $param_address, $param_phone, $param_password, $param_education, $param_documents);

    $param_name = $name;
    $param_password = $password; 
    $param_email = $email;
    $param_address = $address;
    $param_phone = $phone;
    $param_education = $education;
    $param_documents = $documents;

    if(mysqli_stmt_execute($stmt)){
        $sql1="DELETE FROM `Requests` WHERE `Email` = '{$email}'";
        if($stmt1 = mysqli_prepare($link, $sql1)){
            mysqli_stmt_execute($stmt1);
            header("location: requests.php");
        }
        
    } else{
        echo "Something went wrong. Please try again later.";
    }
}      
mysqli_stmt_close($stmt);
mysqli_close($link);
?>