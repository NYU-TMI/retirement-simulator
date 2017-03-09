<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$isButton = $_POST["isButton"] ? 'y' : 'n';

$fundArray = json_decode($_POST["fundArray"], true);

$usercode = $_SESSION["usercode"];

$query = "SELECT fid FROM fund WHERE name in (";
foreach ($fundArray as $fund) {
  $query .= "'$fund',";
}

$query = rtrim($query, ',');
$query .= ")";

$fid = array_fill(0, 10, null);
$result = mysqli_query($conn, $query);
$i = 0;
while ($row = mysqli_fetch_row($result)) {
  $fid[$i] = $row[0];
  $i++;
}


$query = "INSERT INTO compare (usercode, button, fund1, fund2, fund3, fund4, fund5, fund6, fund7, fund8, fund9, fund10, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
  
$stmt = mysqli_prepare($conn, $query);
  
mysqli_stmt_bind_param($stmt, "ssiiiiiiiiii" ,$usercode, $isButton, $fid[0], $fid[1], $fid[2], $fid[3], $fid[4], $fid[5], $fid[6], $fid[7], $fid[8], $fid[9]);
  
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>
