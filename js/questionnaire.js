var App = {};

App.submitAnswers = function(questionNumbers, answers) {
  $.ajax({
    method: "POST",
    url: "api/answer_questionnaire.php",
    data: {questionNumbers: questionNumbers,
           answers: answers,
           comment: $('textarea').val()},
    success: function() {
      window.location.replace("completed.php");
    }
  });
}

App.setCondition = function() {
  $.get("api/get_groupid.php", function(data) {
    if (data == 14) {
      $('.comment-cond').removeClass('hide');
      $('.open-ended').text('8');
    }
  });
}

$(function() {
  var totalQuestions = 0;

  App.setCondition();

  $('form').submit(function(e) {
    e.preventDefault();

    $.get("api/get_groupid.php", function(data) {
      if (data == 14) {
        totalQuestions = 7;
      } else {
        totalQuestions = 3;
      }

      if ($('input:checked').length == totalQuestions) {
        var form = $(this);
  
        var answers = new Array();
        var questionNumbers = new Array();
  
        for (var i = 0; i < totalQuestions; i++) {
          answers.push(parseInt($('input:checked')[i].value));
          questionNumbers.push(parseInt($('input:checked')[i].name.replace('q','')));
        }
   
        App.submitAnswers(questionNumbers, answers);
  
      } else {
        alert("Please answer every question.");
      }
    });
  });
});
