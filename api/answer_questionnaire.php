<?php

include 'include.php';

$usercode = $_SESSION["usercode"];

$questionNumbers = $_POST["questionNumbers"];
$answers = $_POST["answers"];
$comment = $_POST["comment"];

if (count($answers) == 3) {
  $query = "INSERT INTO questionnaire (usercode, answer1, answer2, answer3, answer8) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "siiis", $usercode, $answers[0], $answers[1], $answers[2], $comment);
  mysqli_execute($stmt);
  mysqli_stmt_close($stmt);

} else if (count($answers) == 7) {
  $query = "INSERT INTO questionnaire (usercode, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "siiiiiiis", $usercode, $answers[0], $answers[1], $answers[2], $answers[3], $answers[4], $answers[5], $answers[6], $comment);
  mysqli_execute($stmt);
  mysqli_stmt_close($stmt);
}
?>
