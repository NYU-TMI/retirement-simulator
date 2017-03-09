<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$lastYear = $_GET["lastYear"];
$years = array(1,5,$lastYear,35,10,20,30);

$invest = $_GET["invest"];

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

$hash = readCSV('../data/label_benchmark.csv');

$change = array(0,0);
for ($i = 2; $i < count($hash); $i++) {
  $change[] = $hash[$i][5];
}

$return = array();
$historical = array();
$final_fees = array();

for ($i = 0; $i < count($years); $i++) {
  $init = 2;
  $row = $years[$i] * 12 + $init;
  $return[] = pow($hash[$row][4] / $hash[$init][4], 1 / $years[$i]) - 1;

  //$historical[] = ($invest / 100) * $final_price[$row];  
  $historical[] = $invest * pow($return[$i] + 1, $years[$i]);

  $final_fees[] = ($invest / 100) * $hash[$row][3];
}

echo json_encode(array($historical, $final_fees));

?>
