<?php

require_once "config.php";

$id = $_GET['id'];

$sql = "SELECT * FROM Requests WHERE bbs_id = '{$id}'";
$result = $link->query($sql);
while ($row = $result->fetch_assoc()){
    $file = $row['Documents'];   
}
header("Content-type: ".pdf);
header('Content-Disposition: attachment; filename="recommendation-letter"');
header("Content-Transfer-Encoding: binary"); 
header('Expires: 0');
header('Pragma: no-cache');
echo $file;

?> 
