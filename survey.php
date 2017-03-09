<?php

include 'api/include.php';

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/survey.css">
  <title>Retirement Survey</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="beginning-section center">
        <h1 class="title">Financial understanding survey</h1>
        <p class="desc"><span class="cond8-hide" style="display: none">The final portion of this study consists of a survey to assess your understanding of some financial concepts. </span>Please complete the survey below and answer questions to the best of your ability. <span class="cond8-hide" style="display: none">After completing the survey you will be awarded a bonus based on your performance in the retirement simulation.</span></p>
      </div>
      <form>
        <div class="form">

          <div class="main">

<?php

$query = "SELECT qid, question, answer1, answer2, answer3, answer4, answer5 FROM question ORDER BY qid ASC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {

  echo "
            <p id='question$row[0]' class='question-section'>
              <span class='question'>
                $row[0]) $row[1]
              </span>
              <br><input type='radio' name='q$row[0]' value='1'>$row[2]
              <br><input type='radio' name='q$row[0]' value='2'>$row[3]
       ";

  if ($row[4]) {
    echo "
              <br><input type='radio' name='q$row[0]' value='3'>$row[4]
         ";
    if ($row[5]) {
      echo "
              <br><input type='radio' name='q$row[0]' value='4'>$row[5]
           ";
      if ($row[6]) {
        echo "
              <br><input type='radio' name='q$row[0]' value='5'>$row[6]
             ";
      }
    }
  }

  echo "
            </p>
       ";

}
?>
          
<!--
            <p id="question1" class="question-section">
              <span class="question">
                1) What is your favorite color?
              </span>
              <br><input type="radio" name="q1" value="1">Red
              <br><input type="radio" name="q1" value="2">Blue
              <br><input type="radio" name="q1" value="3">Green
              <br><input type="radio" name="q1" value="4">Yellow
            </p>
          
            <p id="question2" class="question-section">
              <span class="question">
                2) Was that really your favorite color?
              </span>
              <br><input type="radio" name="q2" value="1">Yes
              <br><input type="radio" name="q2" value="2">No
            </p>
          
            <p id="question3" class="question-section">
              <span class="question">
                3) Describe your favorite color.
              </span>
              <br><TEXTAREA name="q3" cols=60 rows=6></TEXTAREA>
            </p>
-->
          
          </div>
          
          <div class="submit-section">
            <button type="submit" class="btn btn-default">Submit Survey</button>
          </div>

        </div>
      </form>
    </div>
  </div>  
  <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/survey.js"></script>
</body>
</html>
