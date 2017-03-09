<?php

include 'include.php';

$usercode = $_SESSION["usercode"];
$stmt = mysqli_prepare($conn, "SELECT totalvalue FROM activity WHERE usercode = ? ORDER BY modified DESC LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $totalvalue);
mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);

echo round($totalvalue, 2);
?>
