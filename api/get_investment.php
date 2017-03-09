<?php

include 'include.php';

$usercode = $_SESSION["usercode"];
$stmt = mysqli_prepare($conn, "SELECT sum(invest) FROM activity WHERE usercode = ?");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $invest);
mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);

echo $invest;
?>
