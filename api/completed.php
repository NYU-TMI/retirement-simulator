<?php

include 'include.php';

$usercode = $_SESSION["usercode"];

$stmt = mysqli_prepare($conn, "UPDATE user SET completed = now() WHERE usercode = ?");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "SELECT goal, totalvalue FROM user WHERE usercode = ?");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $goal, $totalvalue);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$bonus_multiplier = 9;

$goal = round(sprintf('%f', $goal));
$totalvalue = round(sprintf('%f', $totalvalue));
$diff = abs($goal - $totalvalue);
$percent = 1 - abs(($totalvalue-$goal)/$goal)*$bonus_multiplier;
$reward = round($percent * 400) / 100;
if ($reward < 0) {
  $reward = 0;
}

$stmt = mysqli_prepare($conn, "UPDATE user SET reward = ? WHERE usercode = ?");
mysqli_stmt_bind_param($stmt, "ds", $reward, $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo json_encode(array($reward, $goal, $totalvalue));
?>
