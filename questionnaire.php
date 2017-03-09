<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="css/fonts.css">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/survey.css">
  <title>End of Study Questionnaire</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="beginning-section center">
        <h2 class="title">End of Study Questionnaire</h2>
      </div>

      <form>
        <div class="form">

          <div class="main">

            <div id="question1" class="question-section">
              <p class="question">
                1. I made informed decisions when selecting funds for my retirement portfolio.
              </p>
              <input type="radio" name="q1" value="1">Strongly Agree
              <br><input type="radio" name="q1" value="2">Agree
              <br><input type="radio" name="q1" value="3">Neutral
              <br><input type="radio" name="q1" value="4">Disagree
              <br><input type="radio" name="q1" value="5">Strongly Disagree
            </div>

            <div id="question2" class="question-section">
              <p class="question">
                2. I made the right decision for me.
              </p>
              <input type="radio" name="q2" value="1">Strongly Agree
              <br><input type="radio" name="q2" value="2">Agree
              <br><input type="radio" name="q2" value="3">Neutral
              <br><input type="radio" name="q2" value="4">Disagree
              <br><input type="radio" name="q2" value="5">Strongly Disagree
            </div>

            <div id="question3" class="question-section">
              <p class="question">
                3. I understood the material presented and have no additional questions.
              </p>
              <input type="radio" name="q3" value="1">Strongly Agree
              <br><input type="radio" name="q3" value="2">Agree
              <br><input type="radio" name="q3" value="3">Neutral
              <br><input type="radio" name="q3" value="4">Disagree
              <br><input type="radio" name="q3" value="5">Strongly Disagree
            </div>

            <div id="question4" class="question-section comment-cond hide">
              <p class="question">
                4. I read most of the other users' comments.
              </p>
              <input type="radio" name="q4" value="1">Strongly Agree
              <br><input type="radio" name="q4" value="2">Agree
              <br><input type="radio" name="q4" value="3">Neutral
              <br><input type="radio" name="q4" value="4">Disagree
              <br><input type="radio" name="q4" value="5">Strongly Disagree
            </div>

            <div id="question5" class="question-section comment-cond hide">
              <p class="question">
                5. Other users' comments influenced my decisions.
              </p>
              <input type="radio" name="q5" value="1">Strongly Agree
              <br><input type="radio" name="q5" value="2">Agree
              <br><input type="radio" name="q5" value="3">Neutral
              <br><input type="radio" name="q5" value="4">Disagree
              <br><input type="radio" name="q5" value="5">Strongly Disagree
            </div>

            <div id="question6" class="question-section comment-cond hide">
              <p class="question">
                6. Other users' comments helped me make my decision.
              </p>
              <input type="radio" name="q6" value="1">Strongly Agree
              <br><input type="radio" name="q6" value="2">Agree
              <br><input type="radio" name="q6" value="3">Neutral
              <br><input type="radio" name="q6" value="4">Disagree
              <br><input type="radio" name="q6" value="5">Strongly Disagree
            </div>

            <div id="question7" class="question-section comment-cond hide">
              <p class="question">
                7. Other users' comments helped me understand the material in the fund prospectus.
              </p>
              <input type="radio" name="q7" value="1">Strongly Agree
              <br><input type="radio" name="q7" value="2">Agree
              <br><input type="radio" name="q7" value="3">Neutral
              <br><input type="radio" name="q7" value="4">Disagree
              <br><input type="radio" name="q7" value="5">Strongly Disagree
            </div>

            <div id="question8" class="question-section">
              <p class="question">
                <span class="open-ended">4</span>. Are there any additional thoughts you would like to share with us about the process of making decisions for selecting funds?
              </p>
              <textarea cols="70" rows="5"></textarea>
            </div>

          </div>
          
          <div class="submit-section">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>

        </div>
      </form>
    </div>
  </div>  
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="js/questionnaire.js"></script>
</body>
</html>
