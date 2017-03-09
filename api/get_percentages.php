<?php

include 'include.php';

$usercode = $_SESSION["usercode"];
$year = $_SESSION["year"];
$month = $_SESSION["month"];

$fund = array();
$fundprice = array();
$fundpct = array();
$stmt = mysqli_prepare($conn, "SELECT fund1, fund2, fund3, fund4, fund5, fund6, fund7, fund8, fund9, fund10, fund1price, fund2price, fund3price, fund4price, fund5price, fund6price, fund7price, fund8price, fund9price, fund10price, fund1pct, fund2pct, fund3pct, fund4pct, fund5pct, fund6pct, fund7pct, fund8pct, fund9pct, fund10pct, totalvalue FROM activity WHERE usercode = ? ORDER BY modified DESC LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $fund[0], $fund[1], $fund[2], $fund[3], $fund[4], $fund[5], $fund[6], $fund[7], $fund[8], $fund[9], $fundprice[0], $fundprice[1], $fundprice[2], $fundprice[3], $fundprice[4], $fundprice[5], $fundprice[6], $fundprice[7], $fundprice[8], $fundprice[9], $fundpct[0], $fundpct[1], $fundpct[2], $fundpct[3], $fundpct[4], $fundpct[5], $fundpct[6], $fundpct[7], $fundpct[8], $fundpct[9], $totalvalue);
mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);

$value = array();
foreach ($fundprice as $key=>$price) {
  $value[] = $price * $fund[$key];
}

//$pct = array($year, $month, $stockpct, $bondpct, $trustpct, 1 - $stockpct - $bondpct - $trustpct, $stock * $stockprice, $bond * $bondprice, $trust * $trustprice, $cash, round($totalvalue,2));
$pct = array($year, $month, $fundpct, $value, round($totalvalue,2));

//echo $stockpct, $bondpct, $cashpct;
echo json_encode($pct);

?>
