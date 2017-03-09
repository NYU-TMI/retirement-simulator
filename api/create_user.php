<?php

include 'include.php';
include 'ip.inc';
//include 'groupid.php';

$mtwid = $_GET["mtwid"];
$goal = $_GET["goal"];

$locStr = implode(", ", getClientLocByIP());

function get_client_ip() {
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
  $ipaddress = getenv('HTTP_CLIENT_IP');
  else if(getenv('HTTP_X_FORWARDED_FOR'))
  $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if(getenv('HTTP_X_FORWARDED'))
  $ipaddress = getenv('HTTP_X_FORWARDED');
  else if(getenv('HTTP_FORWARDED_FOR'))
  $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if(getenv('HTTP_FORWARDED'))
     $ipaddress = getenv('HTTP_FORWARDED');
  else if(getenv('REMOTE_ADDR'))
  $ipaddress = getenv('REMOTE_ADDR');
  else
      $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

//$groupid = 1;
$usercode = uniqid(true);
$ip = get_client_ip();
$year = 1980;
$reward = null;
$totalvalue = 0;
$comments = '';
$location = $locStr;

$age = isset($_GET["age"]) ?  intval($_GET["age"]) : 0;
$gender = isset($_GET["gender"]) ?  $_GET["gender"] : "Unknown";
$experience =  isset($_GET["experience"]) ?  intval($_GET["experience"]) : 0;
$hasretire =  isset($_GET["hasretire"]) ?  intval($_GET["hasretire"]) : 0;
$retirementamount = 0;

if ($mtwid == null) {
	$mtwid = "NONE";
}

//$groupid = $weighted_groupid;
//$_SESSION["groupid"] = $groupid;

$groupid = isset($_SESSION["groupid"]) ? $_SESSION["groupid"] : 1;
$_SESSION["groupid"] = isset($_SESSION["groupid"]) ? $_SESSION["groupid"] : 1;


$stmt = mysqli_prepare($conn, "INSERT INTO user VALUES (?, ?, ?, ?, null, ?, ?, now(), null, ?, ?, ?, ?, ?, ?, ?, ?, 0);");
mysqli_stmt_bind_param($stmt, "sissiidiiisdss", $mtwid, $groupid, $usercode, $ip, $goal, $year, $totalvalue, $age, $experience, $hasretire, $gender, $retirementamount, $comments, $location);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "INSERT INTO label (usercode) VALUES (?)");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$_SESSION["usercode"] = $usercode;
$_SESSION["year"] = 1981;
$_SESSION["month"] = "01";

?>
