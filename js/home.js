var dateInit = ['x'];
var dateVal = new Array();
var balanceInit = ['Balance ($)'];
var balanceVal = new Array();

var balanceChart;
var balanceChartFlag = 0;
var transactionFlag = 0;

var App = {};

function numberWithCommas(x) {
  x = x.toString();
  var pattern = /(-?\d+)(\d{3})/;
  while (pattern.test(x))
    x = x.replace(pattern, "$1,$2");
  return x;
}

function lastArrayElements(arr, x) {
  return arr.slice(Math.max(arr.length - x, 0)); 
}

App.getFundNames = function(callback) {
  var fundNames = new Array();
  $.ajax({
    url: "api/fund_names.php", 
    dataType: "json",
    success: function(data) {
      fundNames = data;
      callback(fundNames);
    }
  });
}

App.getInvestment = function(callback) {
  var purchase = "0.00";
  $.get("api/get_investment.php", function(data) {
    if (data) {
      purchase = data;
      $('#purchase').text('$'+numberWithCommas(purchase));
    } else {
      $('#purchase-up').hide();
    }
  });
  callback(purchase);
}
  
App.getPercentage = function() {
  $('#return-up, #return-down').hide();
  App.getInvestment(function(purchase) {
    App.getFundNames(function(fundNames) {
    $.ajax({
      url: "api/get_percentages.php",
      dataType: "json",
      success: function(data) {
        var year = data[0];
        var month = data[1];
        if (data[4] > 0) {
          currentPct = new Array();
    
          var total = data[4];
          $('.total-balance').text('$'+numberWithCommas(total));
    
          var invReturn = (total - purchase).toFixed(2);
          $('#return').text('$'+numberWithCommas(invReturn));
    
          if (invReturn > 0) {
            $('#return-up').show();
            $('#return').text('$' + numberWithCommas(invReturn));
          } 
    
          if (invReturn < 0) {
            $('#return-down').show();
            $('#return').text('-$' + numberWithCommas(Math.abs(invReturn)));
          }
    
          for (var i = 0; i < data[2].length; i++) {
            if (data[2][i]) {
              currentPct.push([fundNames[i], data[2][i]]);
            }
          }

          var currentMixChart = c3.generate({
            bindto: '#currentChart',
            color: {
              pattern: ['#0C4F91', '#890C27', '#497519', '#FAA43A', '#4D4D4D', '#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#F15854']
            },
            data: {
              columns: currentPct,
              type: 'pie'
            }
          });
        }
      }
      });
    });
  });
}
  
App.getBalanceHistory = function() {
  $.ajax({
    url: "api/get_balance_history.php",
    dataType: "json",
    success: function(data) {
      if (data.length != 0) {
        balanceChartFlag = 1;
        for (var i = 0; i<data.length; i++) {
          dateVal.push(data[i][0]);
          balanceVal.push(data[i][1].toFixed(2));
        }
        balanceChart = c3.generate({
          padding: {
            top: 25,
            right: 25 
          },
          bindto: '#balanceChart',
          color: {
            pattern: ['#01DFD7']
          },
          data: {
            x: 'x',
            xFormat: '%Y-%m',
            columns: [
              dateInit.concat(lastArrayElements(dateVal, 99)),
              balanceInit.concat(lastArrayElements(balanceVal, 99))
            ],
            types: {
              'Balance ($)': 'area'
            }
          },
          axis: {
            x: {
              type: 'timeseries',
              tick: {
                //format: '%Y-%m-%d'
                  format: '%Y'
              }
            }
          }
        });
        
      }
    }
  });
}

App.getRecentTransaction = function(){
  App.getFundNames(function(fundNames) {
  $.ajax({
    url: "api/get_last_transaction.php",
    dataType: "json",
    success: function(data) {
      if (data.length > 5) {
        $('.all-transactions').show();
      }
      var limit = Math.min(data.length, 5);
      var table = $('#transaction-table')[0];
      for (var i = 0; i < limit; i++) {
        if (data[i][2] == 0) {
          break;
        }

        var row = table.insertRow(i+1);

        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);

        cell1.innerText = data[i][0];
        cell3.innerText = '$'+numberWithCommas(data[i][2].toFixed(2));

        var linebreak;
        var textNode;
        if (data[i][3] == "y") {
          textNode = document.createTextNode("Changed Entire Investment Mix:");
          cell2.appendChild(textNode);
          linebreak = document.createElement("br");
          cell2.appendChild(linebreak);
        } 

        for (var j = 0; j < data[i][1].length; j++) {
          if (data[i][1][j].toFixed(1) > 0) {
            textNode = document.createTextNode(fundNames[j] + " " + data[i][1][j].toFixed(1) + "%");
            cell2.appendChild(textNode);
            linebreak = document.createElement("br");
            cell2.appendChild(linebreak);
          }
        }
      }
  
    }
    });
  });
}

App.getAllTransaction = function(){
  App.getFundNames(function(fundNames) {
  $.ajax({
    url: "api/get_last_transaction.php",
    dataType: "json",
    success: function(data) {
      var table = $('#transaction-table2')[0];

      for (var i = 0; i < data.length; i++) {
        if (data[i][2] == 0) {
          break;
        }
  
        var row = table.insertRow(i+1);
  
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
  
        cell1.innerText = data[i][0];
        cell3.innerText = '$'+numberWithCommas(data[i][2].toFixed(2));
  
        var linebreak;
        var textNode;
        if (data[i][3] == "y") {
          textNode = document.createTextNode("Changed Entire Investment Mix:");
          cell2.appendChild(textNode);
          linebreak = document.createElement("br");
          cell2.appendChild(linebreak);
        } 
  
        for (var j = 0; j < data[i][1].length; j++) {
          if (data[i][1][j].toFixed(1) > 0) {
            textNode = document.createTextNode(fundNames[j] + " " + data[i][1][j].toFixed(1) + "%");
            cell2.appendChild(textNode);
            linebreak = document.createElement("br");
            cell2.appendChild(linebreak);
          }
        }
      }
    }
    });
  });
}

/*
var targetChart = c3.generate({
  bindto: '#targetChart',
  color: {
    pattern: ['#0C4F91', '#890C27']
  },
  data: {
    columns: [
      ['data1', 50],
      ['data2', 50],
    ],
    type: 'pie',
  }
});*/
/*
var personalChart = c3.generate({
  bindto: '#personalChart',
  data: {
    x: 'x',
    columns: [
      ['x', '2010-01-01', '2010-07-01',
        '2011-01-01', '2011-07-01',
        '2012-01-01', '2012-07-01',
        '2013-01-01', '2013-07-01',
        '2014-01-01', '2014-07-01'
      ],
      ['data', 30, 50, -20, 70, 60, 40, 80, 90, 120, 110]
    ],
    types: {
      data: 'area'
    },
    colors: {
      data: '#00ff00'
    },
    color: function(color, d) {
      if (d.value < 0) {
        return '#ff0000';
      } else {
        return '#00ff00';
      }
    }
  },
  axis: {
    x: {
      type: 'timeseries',
      tick: {
        values: ['2010-01-01', '2011-01-01', '2012-01-01',
          '2013-01-01', '2014-01-01'
        ]
      }
    }
  }
});
*/
/*
var balanceChart = c3.generate({
  bindto: '#balanceChart',
  color: {
    pattern: ['#01DFD7']
  },
  data: {
    x: 'x',
    columns: [
      ['x', '2009-01-01', '2009-07-01',
        '2010-01-01', '2010-07-01',
        '2011-01-01', '2011-07-01',
        '2012-01-01', '2012-07-01',
        '2013-01-01', '2013-07-01',
        '2014-01-01', '2014-07-01'
      ],
      ['data', 15, 20, 30, 50, 40, 70, 100, 110, 90, 150, 90, 110]
    ],
    types: {
      data: 'area'
    }
  },
  axis: {
    x: {
      type: 'timeseries',
      tick: {
        values: ['2009-01-01', '2010-01-01',
          '2011-01-01', '2012-01-01',
          '2013-01-01', '2014-01-01'
        ]
      }
    }
  }
});
*/

$(function() {
  App.getPercentage();

  App.getBalanceHistory();

  App.getRecentTransaction();

  $('.all-transactions').click(function(){
    if (!transactionFlag) {
      transactionFlag = 1;
      App.getAllTransaction();
    }
  });

  $('.balance-btn').click(function(){
    $('.balance-btn.btn-active').addClass('btn-default');
    $('.balance-btn.btn-active').removeClass('btn-active');
    $(this).addClass('btn-active');
    $(this).removeClass('btn-default');

    if (balanceChartFlag) {
      balanceChart.load({
        unload: dateInit.concat(balanceInit),
        columns: [
          dateInit.concat(lastArrayElements(dateVal, $(this).val())),
          balanceInit.concat(lastArrayElements(balanceVal, $(this).val()))
        ]
      });
    }
  });
});
