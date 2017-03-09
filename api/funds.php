<?php

include 'include.php';

$year = $_SESSION["year"];
$month = intval($_SESSION["month"]);

$current_date = $year . "-" . $month . "-1";
$last_date = ($year - 1) . "-" . $month . "-1";

$query = "SELECT symbol, name, abbreviation, data_file, start_date, end_date FROM fund ORDER BY fid ASC";

$symbol = array();
$name = array();
$abbreviation = array();
$data_file = array();
$accept = array();
$accept2 = array();

$current_total = 0;
$total = 0;;
if ($result = mysqli_query($conn, $query)) {
  while ($row = mysqli_fetch_row($result)) {
    $total++;
    array_push($symbol, $row[0]);
    array_push($name, $row[1]);
    array_push($abbreviation, $row[2]);
    array_push($data_file, $row[3]);
    if ($current_date >= $row[4]) {
      array_push($accept, 1);
      $current_total++;
    } else {
      array_push($accept, 0);
    }
    if ($last_date >= $row[4]) {
      array_push($accept2, 1);
    } else {
      array_push($accept2, 0);
    }


  }
}

?>
