<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$fundname = $_GET["fund"];

$lastYear = $_GET["lastYear"];
$years = array(1,5,$lastYear,35,10,20,30);

$invest = $_GET["invest"];

//$newpct = $_GET["pct"]/100;

$histpct = $_GET["histpct"];
$volatilitypct = $_GET["volatilitypct"];
$feepct = $_GET["feepct"];

$fundtype = 0;
if (strpos($fundname, 'Lifecycle') !== false) {
  $fundtype = 1;
} else if (strpos($fundname, 'Stock') !== false) {
  $fundtype = 2;
} else if (strpos($fundname, 'Bond') !== false) {
  $fundtype = 3;
}


function sd_square($x, $mean) { return pow($x - $mean,2); }

// Function to calculate standard deviation (uses sd_square)    
function sd($array) {
    
// square root of sum of squares devided by N-1
return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
}


function readCSV($csvFile){
	$line_hash = array();
	$file_handle = fopen($csvFile, 'r');
    $i = 0;
	while (!feof($file_handle) ) {
		$line_array = fgetcsv($file_handle, 1024);
        $i++;
		$line_key = $i;
		$line_hash[$line_key] = $line_array;
	}
	fclose($file_handle);
	return $line_hash;
}

$hash = readCSV('../data/label.csv');

$stmt = mysqli_prepare($conn, "SELECT abbreviation, fees FROM fund WHERE name = ?");
mysqli_stmt_bind_param($stmt, "s", $fundname);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $abbreviation, $fees);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($feepct != -1) {
  $fees = $feepct/100; 
} else if ($abbreviation == "Cash") {
  $fees = 0;
}

$monthly_fees = array(0,0);
$cumulative_fees = array(0,0);
$final_price = array(0,1);
$change = array(0,0);

if ($histpct != -1) {
  $monthly_rate = pow(1 + $histpct / 100, 1 / 12);
  $new_fees = array(0, 100 / $monthly_rate);
} else if ($abbreviation == "Cash") {
  $monthly_rate = 1;
  $new_fees = array(0, 100 / $monthly_rate);
}

for ($i = 2; $i < count($hash); $i++) {
  if ($histpct != -1 || $abbreviation == "Cash") {
    $new_fees[] = $new_fees[$i-1] * $monthly_rate;
    $monthly_fees[] = $fees / 12 * $new_fees[$i];
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i];
    $final_price[] = $new_fees[$i] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;
  } else if ($fundtype == 1) {
    $monthly_fees[] = $fees / 12 * $hash[$i][7]; 
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i]; 
    $final_price[] = $hash[$i][7] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;    
  } else if ($fundtype == 2) {
    $monthly_fees[] = $fees / 12 * $hash[$i][3]; 
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i]; 
    $final_price[] = $hash[$i][3] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;    
  } else if ($fundtype == 3) {
    $monthly_fees[] = $fees / 12 * $hash[$i][4]; 
    $cumulative_fees[] = $cumulative_fees[$i-1] + $monthly_fees[$i]; 
    $final_price[] = $hash[$i][4] - $cumulative_fees[$i];
    $change[] = $final_price[$i] / $final_price[$i-1] - 1;    
  }
} 

$return = array();
$historical = array();
$final_fees = array();
$volatility = array();
$likely = array();
$best = array();
$worst = array();

for ($i = 0; $i < count($years); $i++) {
  $init = 2;
  $row = $years[$i] * 12 + $init;
  /*
  if ($histpct != -1) {
    $return[] = $histpct/100;
  } else {
    $return[] = pow($final_price[$row] / $final_price[$init], 1 / $years[$i]) - 1;
}
  */

  $return[] = pow($final_price[$row] / $final_price[$init], 1 / $years[$i]) - 1;

  //$historical[] = ($invest / 100) * $final_price[$row];  
  $historical[] = $invest * pow($return[$i] + 1, $years[$i]);

  $final_fees[] = ($invest / 100) * $cumulative_fees[$row];

  $init2 = 3;
  $row2 = $years[$i] * 12;
  if ($volatilitypct != -1) {
    $volatility[] = $volatilitypct/100;
  } else if ($abbreviation == "Cash") {
    $volatility[] = 0;
  } else {
    $volatility[] = sd(array_slice($change, $init2, $row2)) * sqrt(12);
  }
  $likely[] = $invest * pow(1 + $return[$i], $years[$i]);
  $best[] = $invest * pow(1 + $return[$i], $years[$i]) * (1 + $volatility[$i]);
  $worst[] = $invest * pow(1 + $return[$i], $years[$i]) * (1 - $volatility[$i]);

}

echo json_encode(array($fundname, $abbreviation, $fees, $return, $historical, $final_fees, $volatility, $likely, $best, $worst));

?>
