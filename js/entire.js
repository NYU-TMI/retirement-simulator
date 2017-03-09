var allNewPct = new Array();
var fundNames = new Array();

var totalInput = 0;
var totalBalance = 0;

var sum = 0;

var currentChart;
var suggestedChart;
var newChart;

var App = {};

App.fixValues = function() {
  for (var i = 0; i < totalInput; i++) {
    var tempClass = '#fund' + (i + 1) + '-input';
    $(tempClass).val($(tempClass).val().replace(/[^0-9\.]+/g,''));
  }
}

function numberWithCommas(x) {
  x = x.toString();
  var pattern = /(-?\d+)(\d{3})/;
  while (pattern.test(x))
    x = x.replace(pattern, "$1,$2");
  return x;
}

App.getFundNames = function(callback) {
  $.ajax({
    url: "api/fund_names.php",
    dataType: "json",
    success: function(data) {
      fundNames = data;
      callback(fundNames);
    }
  });
}

App.getCurrentPercent = function() {
  var currentPct = new Array();
  App.getFundNames(function(fundNames) {
    $.ajax({
      url: "api/get_percentages.php",
      dataType: "json",
      success: function(data) {
        for (var i = 0; i < data[2].length; i++) {
          if (data[2][i]) {
            currentPct.push([fundNames[i], data[2][i]]);
          }
        }

        var height = currentPct.length - 3;
        if (height < 0) {
          height = 0;
        }
        height = height/5 * 400 + (1-height/5) * 250;

        currentChart = c3.generate({
          bindto: '#current-mix',
          size: {
            width: 250,
            height: height
          },
          color: {
            pattern: ['#0C4F91', '#890C27', '#497519', '#FAA43A', '#4D4D4D', '#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#F15854']
          },
          data: {
            // iris data from R
            columns: currentPct, 
            type: 'pie',
            onclick: function(d, i) {
              console.log("onclick", d, i);
            },
            onmouseover: function(d, i) {
              console.log("onmouseover", d, i);
            },
            onmouseout: function(d, i) {
              console.log("onmouseout", d, i);
            }
          }
        });
    
        totalBalance = data[4].toFixed(2);
    
        for (var i = 0; i < data[3].length; i++) {
          var tempClass = 'fund' + (i + 1);
          var tempBalance = data[3][i].toFixed(2);
          $('#' + tempClass + '-balance').text('$'+numberWithCommas(tempBalance));
          $('#new-' + tempClass).text('$'+numberWithCommas(tempBalance));
    
          $('#' + tempClass + '-pct').text((data[2][i] * 100).toFixed(1) + '%');
        }
    
        $('#total').text('$'+numberWithCommas(totalBalance));
    
        //App.makeNewChart(currentPct);
      }
    });
  });
}

App.makeNewChart = function(array) {
  $('#new-mix-section').fadeIn(1000);

  var height = array.length - 3;
  if (height < 0) {
    height = 0;
  }
  height = height/5 * 400 + (1-height/5) * 250;

  newChart = c3.generate({
    bindto: '#new-mix',
    size: {
      width: 250,
      height: height
    },
    color: {
      pattern: ['#0C4F91', '#890C27', '#497519', '#FAA43A', '#4D4D4D', '#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#F15854']
    },
    data: {
      // iris data from R
      columns: array,
      type: 'pie',
      onclick: function(d, i) {
        console.log("onclick", d, i);
      },
      onmouseover: function(d, i) {
        console.log("onmouseover", d, i);
      },
      onmouseout: function(d, i) {
        console.log("onmouseout", d, i);
      }
    }
  });
}

App.makeSuggestedChart = function() {
  $.get("api/get_year.php", function(data) {
    var yearDiff = 2015 - data;
    var stockpct = 90 * yearDiff / 33 + 40 * (33 - yearDiff) / 33;
    var bondpct = 100 - stockpct;
    var chart2 = c3.generate({
      bindto: '#suggested-mix',
      size: {
        width: 250,
        height: 250
      },
      color: {
        pattern: ['#0C4F91', '#890C27', '#497519', '#FAA43A', '#4D4D4D', '#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#F15854']
      },
      data: {
        // iris data from R
        columns: [
          ['Stock', stockpct],
          ['Bond', bondpct],
        ],
        type: 'pie',
        onclick: function(d, i) {
          console.log("onclick", d, i);
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      }
    });
  });
}

$(document).ready(function() {
  totalInput = $('.entire-input').length;

  App.getCurrentPercent();

  App.makeSuggestedChart();

  $('.entire-input').change(function() {

    App.fixValues();

    sum = 0;
    var newPct = new Array();
    allNewPct = new Array();

    for (var i = 0; i < totalInput; i++) {
      var tempClass = '#fund' + (i + 1) + '-input';
      var temp = parseFloat($(tempClass).val()) || 0;
      allNewPct.push(temp);
      if (temp) {
        newPct.push([fundNames[i], temp]);
      }
      sum += temp;
    }    

    sum = sum.toFixed(2);
    $('#total-percent').text(sum + '%');
    if (sum != 100) {
      //$('.error').show();

    } else {
      $('.error').hide();

      App.makeNewChart(newPct);

      for (var i = 0; i < totalInput; i++) {
        var tempBalance = allNewPct[i] * totalBalance / 100;
        var tempClass = '#new-fund' + (i + 1);
        $(tempClass).text('$' + numberWithCommas(tempBalance.toFixed(2)));
      }
    }
  });

  $('#asset-form').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    if (sum == 100){

      $.ajax({
        method: "POST",
        url: "api/update_activity.php",
        data: {newPct: allNewPct},
        success: function(data) {
          form.unbind('submit').submit();
        }
      });

    } else {
      $('.error').show();
    }
  });
});
