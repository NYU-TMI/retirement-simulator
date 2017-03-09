<?php

include 'include.php';

$usercode = $_SESSION["usercode"];

$questionNumbers = $_POST["questionNumbers"];
$answers = $_POST["answers"];

$query = "INSERT INTO answer VALUES ";
for ($i = 0; $i < count($answers); $i++) {
  $query .= "('$usercode', $questionNumbers[$i], $answers[$i]), ";
}
$query = substr($query, 0, -2);

mysqli_query($conn, $query);
mysqli_execute($conn);

?>
