<?php

include 'include.php';

$query = "SELECT name FROM fund ORDER BY fid ASC";

$name = array();

if ($result = mysqli_query($conn, $query)) {
  while ($row = mysqli_fetch_row($result)) {
    array_push($name, $row[0]);
  }
}

echo json_encode($name);

?>
