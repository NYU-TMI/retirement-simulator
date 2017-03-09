<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'funds.php';

$amount = $_GET["amount"];
$percent = array();

for ($i = 0; $i < $current_total; $i++) {
  $fundName = "fund" . ($i + 1) . "-percent";
  $percent[] = floatval($_GET[$fundName]) / 100;
}

$month = $_SESSION["month"];

$year = $_SESSION["year"];


$usercode = $_SESSION["usercode"];
/*
$month = $_GET["month"];
$year = $_GET["year"];
$amount = $_GET["amount"];
$pbond = $_GET["pbond"]/100;
$pstock = $_GET["pstock"]/100;
$pcash = $_GET["pcash"]/100;
$goal = $_GET["goal"];
$usercode = $_GET["usercode"];
*/

function readCSV($csvFile){
	$line_hash = array();
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_array = fgetcsv($file_handle, 1024);
		$line_key = substr($line_array[0],0,-3);
		//if ($type == 'stock') {
			// Add more volatility to stock performance
		//	$line_array[4] = $line_array[4] * (1 + (rand(-10,10)/100));
		//}
		$line_hash[$line_key] = $line_array;
	}
	fclose($file_handle);
//        print_r ($line_hash);
	return $line_hash;
}


function price_pos($hash) {
  $arr = reset($hash);
  foreach ($arr as $index => $string) {
    if (stripos($string, "adj close") !== FALSE) {
       
       return $index;
    }
  }
  foreach ($arr as $index => $string) {
    if (stripos($string, "close") !== FALSE) {
        
        return $index;

    }
  }
  return -1;
}

$date_str = "$year-$month";
$price = array();
$bought = array();


for ($i = 0; $i < $current_total; $i++) {
  if (!$data_file[$i]) {
    $price[] = 1;
    $bought[] = $amount * $percent[$i];
  } else {
    $hash = readCSV('../data/' . $data_file[$i]);
    $pos = price_pos($hash);
    $price[] = $hash[$date_str][$pos];
    $bought[] = $amount * $percent[$i] / $price[$i];
  }
}

$totalvalue = $amount;
$query_sum = "SELECT fund1, fund2, fund3, fund4, fund5, fund6, fund7, fund8, fund9, fund10 FROM activity WHERE usercode = '$usercode' ORDER BY modified DESC limit 0,1;";
$result_sum = mysqli_query($conn, $query_sum) or die('Query failed: ' . mysqli_error($conn));

$fundSum = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

while($row_sum = mysqli_fetch_array($result_sum)) {
  $fundSum[0] = $row_sum[0];
  $fundSum[1] = $row_sum[1];
  $fundSum[2] = $row_sum[2];
  $fundSum[3] = $row_sum[3];
  $fundSum[4] = $row_sum[4];
  $fundSum[5] = $row_sum[5];
  $fundSum[6] = $row_sum[6];
  $fundSum[7] = $row_sum[7];
  $fundSum[8] = $row_sum[8];
  $fundSum[9] = $row_sum[9];
}

$fundVal = array();
$total_sum = 0;
for ($i = 0; $i < $current_total; $i++) {
  $fundVal[] = $fundSum[$i] * $price[$i];
  $total_sum += $fundVal[$i];
}

$totalvalue = $totalvalue + $total_sum;

$newPct = array();
$queryString1 = "";
$queryString2 = "";
for ($i =0; $i < $current_total; $i++) {
  $newPct[] = ($amount * $percent[$i] + $fundVal[$i]) / $totalvalue;
  $bought[$i] += $fundSum[$i];

  $temp = "fund" . ($i + 1);
  $queryString1 .= ", " . $temp . ", " . $temp . "price, " . $temp . "pct";
  $queryString2 .= ", " . $bought[$i] . ", " . $price[$i] . ", " . $newPct[$i];
}

$query = "INSERT INTO activity (month, year, invest, totalvalue, modified, usercode, changemix" . $queryString1 . ") VALUES ($month, $year, $amount, $totalvalue, now(), '$usercode', 'n'" . $queryString2 . ")";

$result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));


$query2 = "UPDATE user SET year = $year, totalvalue = $totalvalue WHERE usercode = '$usercode';";
$result2 = mysqli_query($conn, $query2) or die('Query failed: ' . mysqli_error($conn));

$year++;
$_SESSION["year"] = $year;

?>
