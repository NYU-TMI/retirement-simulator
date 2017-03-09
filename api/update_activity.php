<?php

include 'include.php';

$usercode = $_SESSION["usercode"];

$newPct = $_POST["newPct"];

$fundprice = array();
$stmt = mysqli_prepare($conn, "SELECT year, month, totalvalue, fund1price, fund2price, fund3price, fund4price, fund5price, fund6price, fund7price, fund8price, fund9price, fund10price FROM activity WHERE usercode = ? ORDER BY modified DESC LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $year, $month, $totalvalue, $fundprice[0], $fundprice[1], $fundprice[2], $fundprice[3], $fundprice[4], $fundprice[5], $fundprice[6], $fundprice[7], $fundprice[8], $fundprice[9]);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$fund = array();
$queryString1 = "";
$queryString2 = "";
for ($i = 0; $i < count($newPct); $i++) {
  $newPct[$i] = $newPct[$i] / 100;
  $fund[] = $newPct[$i] * $totalvalue / $fundprice[$i];

  $temp = "fund" . ($i + 1);
  $queryString1 .= ", " . $temp . ", " . $temp . "price, " . $temp . "pct";
  $queryString2 .= ", " . $fund[$i] . ", " . $fundprice[$i] . ", " . $newPct[$i];
}
/*
$stock = $stockpct * $totalvalue / $stockprice;
$bond = $bondpct * $totalvalue / $bondprice;
$trust = $trustpct * $totalvalue / $trustprice;
$cash = $cashpct * $totalvalue;
*/

$query = "INSERT INTO activity (month, year, invest, totalvalue, modified, usercode, changemix" . $queryString1 . ") VALUES ($month, $year, 0, $totalvalue, now(), '$usercode', 'y'" . $queryString2 . ")";

//echo $query;
$result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));

?>
