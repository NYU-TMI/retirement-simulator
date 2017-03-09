<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

include 'funds.php';

//$amount = $_GET["amount"];
//$percent = array();
/*
for ($i = 0; $i < $current_total; $i++) {
  $fundName = "fund" . ($i + 1) . "-percent";
  $percent[] = floatval($_GET[$fundName]) / 100;
}
*/
$month = $_SESSION["month"];
$year = $_SESSION["year"];
$fundname = $_GET["fund"];

//echo $month . "-" . $year;

//$usercode = $_SESSION["usercode"];

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
    //$bought[] = $amount * $percent[$i];
  } else {
    $hash = readCSV('../data/' . $data_file[$i]);
    $pos = price_pos($hash);
    $price[] = $hash[$date_str][$pos];
    //$bought[] = $amount * $percent[$i] / $price[$i];
  }
}

$p = array();
for ($i = 0; $i < count($name); $i++) {
  if ($name[$i] == $fundname) {
    $p[] = $price[$i];
  }
}
echo json_encode($p);

?>
