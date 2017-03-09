var invest = 0;
var maxInvest = 10000;
var formFlag = false;
var totalInput = 0;

var groupid;
var year;
var firstYear = 1981;

var cond6Flag1 = 1;
var cond6Flag2 = 0;

var cond7Flag1 = 1;
var cond7Flag2 = 0;

var errorFlag = 0; /*
                    * 1 = Percentages don't add up to 100
                    * 2 = Amount is less than 0 or greater than the max
                    * 3 = Empty fields
                    */

var clickFundFlag = 0;

var App = {};

App.setCondition = function() {
  $.get("api/get_groupid.php", function(data) {
    groupid = data;
    if (groupid == 1) {
      $('#btn-compare').hide();
    }

    $.get("api/get_year.php", function(data) {
      year = data;
  
      if ((year == firstYear) && ((groupid == 6) || (groupid == 7) || (groupid == 12))) {
        cond6Flag1 = 0;
        if (groupid == 7) {
          cond7Flag1 = 0;
        }
      } 
    });


  });
}

App.getTotal = function() {
  $.get("api/get_total.php", function(data) {
    var balance = "0.00";
    if (parseInt(data) != 0) {
      balance = data;
    } 
  
    $('.invest').text('$'+numberWithCommas(balance));
  });
}

App.getPercent = function() {
  $.ajax({
    url: "api/get_percentages.php",
    dataType: "json",
    success: function(data) {
      if (data[4]) {
        for (var i = 0; i < totalInput; i++) {
          var tempClass = '.fund' + (i + 1) + '-pct';
          $(tempClass).text((data[2][i]*100).toFixed(1)+'%');
        }
      }
    }
  });
}

function numberWithCommas(x) {
  x = x.toString();
  var pattern = /(-?\d+)(\d{3})/;
  while (pattern.test(x))
    x = x.replace(pattern, "$1,$2");
  return x;
}

function isEmpty(field) {
  if (field == '' || field == null) {
    return true;
  }
  return false;
}

function fixValues() {
  for (var i = 0; i < totalInput; i++) {
    var tempClass = '#fund' + (i + 1) + '-input';
    $(tempClass).val($(tempClass).val().replace(/[^0-9\.]+/g,''));  

  }

  $('#total-input').val($('#total-input').val().replace(/[^0-9]+/g,''));
};

function checkValues() {
  fixValues();

  formFlag = false;

  invest = parseInt($('#total-input').val()) || 999999;
  if (invest > maxInvest) {
    errorFlag = 2;
    $('.error, .error2').show();
    $('.error1, .error3').hide();
  } else {
    $('.error2, .error3').hide();

    var sum = 0;

    for (var i = 0; i < totalInput; i++) {
      var tempClass = '#fund' + (i + 1) + '-input';
      var temp = parseFloat($(tempClass).val()) || 0;
      sum += temp;
    }

    sum = sum.toFixed(2);
    if (sum != 100) {
      errorFlag = 1;
      $('.error, .error1').show();
    } else {
      $('.error, .error1').hide();
      formFlag = true;
    }
  }
}

function confirmValues() {
  fixValues();

  if (errorFlag == 2) {
    invest = parseInt($('#total-input').val()) || 999999;
 
    if (invest <= maxInvest) {
      errorFlag = 0;
      $('.error, .error2').hide()
    }
  }

  var sum = 0;

  for (var i = 0; i < totalInput; i++) {
    var tempClass = '#fund' + (i + 1) + '-input';
    var temp = parseFloat($(tempClass).val()) || 0;
    sum += temp;
  }

  sum = sum.toFixed(2);
  $('.total_percentage').text(sum + '%');

  if (errorFlag == 1) {
    if (sum == 100) {
      errorFlag = 0;
      $('.error, .error1').hide();
    }
  }
}



$(function() {
  totalInput = $('.contribution-input').length - 1;

  App.setCondition();

  App.getTotal();

  App.getPercent();

  $('.error, .error1, .error2').hide();

  $('.contribution-input').change(confirmValues);
  $('#form').submit(function(e) {
    e.preventDefault();    

    if (((groupid == 6) || (groupid == 7) || (groupid == 12)) && (year == firstYear) && !cond6Flag1) {
      $('#cond6AlertModal').modal('toggle');
    } else if (((groupid == 14) || (groupid == 15)) && !clickFundFlag) {
      $('#alertModal').modal('toggle');
    } else {
      checkValues();
      if (formFlag) {
        var serialized = $('#form').serialize();      
  
        var form = $(this);
        $.get('api/add_activity.php?' + serialized, function(){
          form.unbind('submit').submit();
        });
  
      } else {
        errorFlag = 1;
        $('.error').show();
    }
    }
  });

  $('#label-modal').on('hidden.bs.modal', function(e) {
    $('body').removeClass('open-modal');
    if (!clickFundFlag) {
      clickFundFlag = 1;
    }

    if (!cond6Flag1) {
      cond6Flag2 = 1;
      $('#cond6AlertModal p').text('Please use the "See how changes affect fund performance" button to continue.');
      $('#cond6AlertModal').modal('toggle');
      $('body').addClass('open-modal');
    } else if (!cond7Flag1) {
      cond7Flag2 = 1;
      $('#cond6AlertModal p').text('You must change any of the fields and press the "Apply changes" button to continue.');
      $('#cond6AlertModal').modal('toggle');
      $('body').addClass('open-modal');
    }
  });

  $('#cond6AlertModal').on('hidden.bs.modal', function(e) {
    $('body').removeClass('open-modal');
    if (cond6Flag2) {
      $('#label-modal').modal('toggle');
      $('body').addClass('open-modal');
    } else if (cond7Flag2) {
      $('#label-modal').modal('toggle');
      $('body').addClass('open-modal');
    }
  });

  $('#tip-experiment').click(function() {
    cond6Flag1 = 1;
  });

  $('#apply-btn').click(function() {
    timeframe = parseInt($('#label-timeframe').val());
    amount = parseInt($('#label-invest').val());
    histpct = parseFloat($('#label-growth-pct').val());
    volatilitypct = parseFloat($('#label-volatility-pct').val());
    feepct = parseFloat($('#label-fee-pct').val());

    //These variables are referencing those in label-modal.js
    if (timeframe && amount && histpct && volatilitypct && feepct) {
      if (timeframeChange || amountChange || historicalChange || volatilityChange || feeChange) {
        cond7Flag1 = 1;
      }
    } 
  });


});





/*
$(document).ready(function() {
  $("input").change(function checkSum() {
    var bond = parseInt(document.getElementById("bond-input").value) || 0;
    var money = parseInt(document.getElementById("money-input").value) || 0;
    var inter = parseInt(document.getElementById("inter-input").value) || 0;
    var sum = bond + money + inter;
    if (sum != 100) {
      $('.error2').show();
    } else {
      $('.error2').hide();
    }
  });



});
*/

