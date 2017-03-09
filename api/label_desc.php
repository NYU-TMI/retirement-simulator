<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$fundname = $_GET["fund"];

$stmt = mysqli_prepare($conn, "SELECT abbreviation, returngrade, riskgrade, rating, recommendation, description FROM fund WHERE name = ?");
mysqli_stmt_bind_param($stmt, "s", $fundname);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $abbreviation, $returngrade, $riskgrade, $rating, $recommendation, $description);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$returngrade = explode(",", $returngrade);
$riskgrade = explode(",", $riskgrade);
$rating = explode(",", $rating);

echo json_encode(array($fundname, $abbreviation, $returngrade, $riskgrade, $rating, $recommendation, $description));

?>
