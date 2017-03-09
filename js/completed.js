function numberWithCommas(x) {
  x = x.toString();
  var pattern = /(-?\d+)(\d{3})/;
  while (pattern.test(x))
    x = x.replace(pattern, "$1,$2");
  return x;
}

var App = {};
/*
App.getTotal = function() {
  $.get("api/get_total.php", function(data) {
    var balance = 0;
    var goal = 1500000;
    if (parseInt(data) != 0) {
      balance = data;
    }
    $('#finalAmount').text(numberWithCommas(balance));

    $('#goalAmount').text(numberWithCommas(goal));
  });
}*/

App.completed = function() {
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "api/completed.php",
    success: function(data) {
      $('#finalAmount').text(numberWithCommas(data[2]));

      $('#goalAmount').text(numberWithCommas(data[1]));

      $('#reward').text(data[0].toFixed(2));
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
  App.completed();

  App.setCondition();

  $('#commentsForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
      type: "GET",
      url: "api/comments.php",
      data: {
        comments: $('#commentsTextArea').val().replace(/'/g,'').replace(/"/g,'')
      },
      success: function(data) {
        $('#commentsArea').html('<p>Thank you for your comments.</p>');
      }
    });
  });
});
