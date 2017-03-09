var App = {};

App.submitAnswers = function(questionNumbers, answers, form) {
  $.ajax({
    method: "POST",
    url: "api/answer.php",
    data: {questionNumbers: questionNumbers,
           answers: answers},
    success: function() {
      window.location.replace("completed.php");
    }
  });
}

App.setCondition = function() {
  $.get("api/get_groupid.php", function(data) {
    if (data != 8) {
      $('.cond8-hide').show();
    }
  });
}

$(function() {
  var totalQuestions = $('.question-section').length;

  App.setCondition();

  $('form').submit(function(e) {
    e.preventDefault();

    if ($('input:checked').length == totalQuestions) {
      var form = $(this);

      var answers = new Array();
      var questionNumbers = new Array();

      for (var i = 0; i < totalQuestions; i++) {
        answers.push(parseInt($('input:checked')[i].value));
        questionNumbers.push(parseInt($('input:checked')[i].name.replace('q','')));
      }
 
      App.submitAnswers(questionNumbers, answers, form);

    } else {
      alert("Please answer every question.");
    }
  });
});
