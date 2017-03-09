<?php

include 'include.php';

$usercode = $_SESSION["usercode"];
$changemix = 'n';

$stmt = mysqli_prepare($conn, "SELECT month, year, totalvalue FROM activity WHERE usercode = ? AND changemix = ? ORDER BY modified ASC");
mysqli_stmt_bind_param($stmt, "ss", $usercode, $changemix);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $month, $year, $totalvalue);

$balance = array();
while (mysqli_stmt_fetch($stmt)) {
  array_push($balance, array(($year + 35) . "-" . $month, $totalvalue));
}

mysqli_stmt_close($stmt);

echo json_encode($balance);
?>
