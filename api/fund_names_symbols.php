<?php

include 'include.php';

$query = "SELECT symbol, name FROM fund ORDER BY fid ASC";

$funds = array();

if ($result = mysqli_query($conn, $query)) {
  while ($row = mysqli_fetch_row($result)) {
    $data = array(
      "fundName" => $row[1],
      "fundSymbol" => $row[0],
		  );
    array_push($funds, $data);
  }
}

echo json_encode($funds);

?>
