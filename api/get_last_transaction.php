<?php

include 'include.php';

$usercode = $_SESSION["usercode"];
$stmt = mysqli_prepare($conn, "SELECT month, year, fund1, fund2, fund3, fund4, fund5, fund6, fund7, fund8, fund9, fund10, fund1price, fund2price, fund3price, fund4price, fund5price, fund6price, fund7price, fund8price, fund9price, fund10price, fund1pct, fund2pct, fund3pct, fund4pct, fund5pct, fund6pct, fund7pct, fund8pct, fund9pct, fund10pct, invest, changemix, totalvalue FROM activity WHERE usercode = ? ORDER BY modified DESC");
mysqli_stmt_bind_param($stmt, "s", $usercode);
mysqli_stmt_execute($stmt);

$month = array();
$year = array();
$fund1 = array();
$fund2 = array();
$fund3 = array();
$fund4 = array();
$fund5 = array();
$fund6 = array();
$fund7 = array();
$fund8 = array();
$fund9 = array();
$fund10 = array();
$fund1price = array();
$fund2price = array();
$fund3price = array();
$fund4price = array();
$fund5price = array();
$fund6price = array();
$fund7price = array();
$fund8price = array();
$fund9price = array();
$fund10price = array();
$fund1pct = array();
$fund2pct = array();
$fund3pct = array();
$fund4pct = array();
$fund5pct = array();
$fund6pct = array();
$fund7pct = array();
$fund8pct = array();
$fund9pct = array();
$fund10pct = array();
$invest = array();
$changemix = array();
$totalvalue = array();

$newfundpct = array();

$j = 0; // Newer value
$k = 1; // Older value
mysqli_stmt_bind_result($stmt, $month[$j], $year[$j], $fund1[$j], $fund2[$j], $fund3[$j], $fund4[$j], $fund5[$j], $fund6[$j], $fund7[$j], $fund8[$j], $fund9[$j], $fund10[$j], $fund1price[$j], $fund2price[$j], $fund3price[$j], $fund4price[$j], $fund5price[$j], $fund6price[$j], $fund7price[$j], $fund8price[$j], $fund9price[$j], $fund10price[$j], $fund1pct[$j], $fund2pct[$j], $fund3pct[$j], $fund4pct[$j], $fund5pct[$j], $fund6pct[$j], $fund7pct[$j], $fund8pct[$j], $fund9pct[$j], $fund10pct[$j], $invest[$j], $changemix[$j], $totalvalue[$j]);
mysqli_stmt_fetch($stmt);

$temp = $j;
$j = $k;
$k = $temp;

mysqli_stmt_bind_result($stmt, $month[$j], $year[$j], $fund1[$j], $fund2[$j], $fund3[$j], $fund4[$j], $fund5[$j], $fund6[$j], $fund7[$j], $fund8[$j], $fund9[$j], $fund10[$j], $fund1price[$j], $fund2price[$j], $fund3price[$j], $fund4price[$j], $fund5price[$j], $fund6price[$j], $fund7price[$j], $fund8price[$j], $fund9price[$j], $fund10price[$j], $fund1pct[$j], $fund2pct[$j], $fund3pct[$j], $fund4pct[$j], $fund5pct[$j], $fund6pct[$j], $fund7pct[$j], $fund8pct[$j], $fund9pct[$j], $fund10pct[$j], $invest[$j], $changemix[$j], $totalvalue[$j]);

$transaction = array();

while (mysqli_stmt_fetch($stmt)) {
  $temp = $j;
  $j = $k;
  $k = $temp;

  if ($changemix[$j] == 'y') {
    $newfundpct = array($fund1pct[$j] * 100, $fund2pct[$j] * 100, $fund3pct[$j] * 100, $fund4pct[$j] * 100, $fund5pct[$j] * 100, $fund6pct[$j] * 100, $fund7pct[$j] * 100, $fund8pct[$j] * 100, $fund9pct[$j] * 100, $fund10pct[$j] * 100);

    array_push($transaction, array($month[$j] . "/1/" . ($year[$j] + 35), $newfundpct, $totalvalue[$j], $changemix[$j]));
  } else {
    $fund1_dif = $fund1[$j] - $fund1[$k];
    $fund2_dif = $fund2[$j] - $fund2[$k];
    $fund3_dif = $fund3[$j] - $fund3[$k];
    $fund4_dif = $fund4[$j] - $fund4[$k];
    $fund5_dif = $fund5[$j] - $fund5[$k];
    $fund6_dif = $fund6[$j] - $fund6[$k];
    $fund7_dif = $fund7[$j] - $fund7[$k];
    $fund8_dif = $fund8[$j] - $fund8[$k];
    $fund9_dif = $fund9[$j] - $fund9[$k];
    $fund10_dif = $fund10[$j] - $fund10[$k];

    $fund1_total = $fund1_dif * $fund1price[$j];
    $fund2_total = $fund2_dif * $fund2price[$j];
    $fund3_total = $fund3_dif * $fund3price[$j];
    $fund4_total = $fund4_dif * $fund4price[$j];
    $fund5_total = $fund5_dif * $fund5price[$j];
    $fund6_total = $fund6_dif * $fund6price[$j];
    $fund7_total = $fund7_dif * $fund7price[$j];
    $fund8_total = $fund8_dif * $fund8price[$j];
    $fund9_total = $fund9_dif * $fund9price[$j];
    $fund10_total = $fund10_dif * $fund10price[$j];
     
    $total = $fund1_total + $fund2_total + $fund3_total + $fund4_total + $fund5_total + $fund6_total + $fund7_total + $fund8_total + $fund9_total + $fund10_total;

    $newfund1pct = $fund1_total / $total;
    $newfund2pct = $fund2_total / $total;
    $newfund3pct = $fund3_total / $total;
    $newfund4pct = $fund4_total / $total;
    $newfund5pct = $fund5_total / $total;
    $newfund6pct = $fund6_total / $total;
    $newfund7pct = $fund7_total / $total;
    $newfund8pct = $fund8_total / $total;
    $newfund9pct = $fund9_total / $total;
    $newfund10pct = $fund10_total / $total;

    $newfundpct = array($newfund1pct * 100, $newfund2pct * 100, $newfund3pct * 100, $newfund4pct * 100, $newfund5pct * 100, $newfund6pct * 100, $newfund7pct * 100, $newfund8pct * 100, $newfund9pct * 100, $newfund10pct * 100);

    array_push($transaction, array($month[$j] . "/1/" . ($year[$j] + 35), $newfundpct, $invest[$j], $changemix[$j]));
  }

  mysqli_stmt_bind_result($stmt, $month[$j], $year[$j], $fund1[$j], $fund2[$j], $fund3[$j], $fund4[$j], $fund5[$j], $fund6[$j], $fund7[$j], $fund8[$j], $fund9[$j], $fund10[$j], $fund1price[$j], $fund2price[$j], $fund3price[$j], $fund4price[$j], $fund5price[$j], $fund6price[$j], $fund7price[$j], $fund8price[$j], $fund9price[$j], $fund10price[$j], $fund1pct[$j], $fund2pct[$j], $fund3pct[$j], $fund4pct[$j], $fund5pct[$j], $fund6pct[$j], $fund7pct[$j], $fund8pct[$j], $fund9pct[$j], $fund10pct[$j], $invest[$j], $changemix[$j], $totalvalue[$j]);
}

$newfundpct = array($fund1pct[$k] * 100, $fund2pct[$k] * 100, $fund3pct[$k] * 100, $fund4pct[$k] * 100, $fund5pct[$k] * 100, $fund6pct[$k] * 100, $fund7pct[$k] * 100, $fund8pct[$k] * 100, $fund9pct[$k] * 100, $fund10pct[$k] * 100);

array_push($transaction, array($month[$k] . "/1/" . ($year[$k] + 35), $newfundpct, $totalvalue[$k], $changemix[$k]));

echo json_encode($transaction);

?>
