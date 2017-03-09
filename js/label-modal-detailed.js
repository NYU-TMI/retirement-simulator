var labelApp = {};
var name = "";
var timeframePlaceholder;
var timeframe;
var amountPlaceholder = 10000;
var amount = amountPlaceholder;
var maxTimeframe = 35;

var histpct = -1;
var volatilitypct = -1;
var feepct = -1;
var recommendFlag = "";

var openTime;
var closeTime;

var timeframeChange = 0;
var amountChange = 0;
var historicalChange = 0;
var volatilityChange = 0;
var feeChange = 0;

var experimentFlag = 0;
var experimentClick = 0;

var tipHover = {};

var initTimeframe;
var initAmount = amountPlaceholder;
var initGrowth;
var initVolatility;
var initFee;

function numberWithCommas(x) {
  x = x.toString();
  var pattern = /(-?\d+)(\d{3})/;
  while (pattern.test(x))
    x = x.replace(pattern, "$1,$2");
  return x;
}

labelApp.setCondition = function() {
  $.get("api/get_groupid.php", function(groupid) {
    if (groupid == 3) {
      $('.label-experiment').hide();
      $('.label-experiment-desc').hide();
      $('#label-timeframe').val($('#label-timeframe').attr('placeholder'));
      $('#label-timeframe').attr('readonly', true);
    } else if (groupid == 4) {
      $('#hist-label tr:not(:first-child, :nth-child(2))').hide();
      $('#estimates-label tr:not(:first-child, :nth-child(3))').hide();
      $('#fees-label tr:not(:first-child, :nth-child(2))').hide();
      $('#label-bottom').hide();
      $('.small-top-pad').hide();
    } else if (groupid == 5) {
      $('.recommendation-label').hide();
    } else if (groupid == 7) {
      $('#label-timeframe').val(initTimeframe);
      $('#label-invest').val(initAmount);
      $('#label-growth-pct').val(initGrowth);
      $('#label-volatility-pct').val(initVolatility);
      $('#label-fee-pct').val(initFee);
    } else if (groupid == 12) {
      $('.recommendation-label').hide();
    }
  });
}

labelApp.init = function() {
  histpct = -1;
  volatilitypct = -1;
  feepct = -1;
  initTimeframe = $('#label-timeframe').attr('placeholder');

  labelApp.getValues().success(function(data) {
    //console.log(data);
    initGrowth = (data[3][3]*100).toFixed(1);
    initVolatility = (data[6][3]*100).toFixed(1);
    initFee = (data[2]*100).toFixed(2);
    $('#label-growth-pct').attr('placeholder', (data[3][3]*100).toFixed(1));
    $('#label-volatility-pct').attr('placeholder', (data[6][3]*100).toFixed(1));
    $('#label-fee-pct').attr('placeholder', (data[2]*100).toFixed(2));
  });

  labelApp.getPrices().success(function(data) {
    //console.log(data);
    var price = (data[0] * 1).toFixed(2);
    //$('.prices-year').text('2001');
    $('.prices-price').text('$' + price);
  });

  labelApp.getYear().success(function(data) {
    year = (data * 1) + 34;
    $('.prices-year').text('Share price for ' + year);
  });
}


labelApp.fillTabs = function() {
  $.ajax({
    url: "api/fund_names.php",
    dataType: "json",
    success: function(data) {
      for (var i = 0; i < data.length; i++) {
        $('#firstTabs').append("<li class='modal-tabs' style='display:none;'><a href='#label'>" + data[i] + "</a></li>");
      }
      $('.modal-tabs').bind("click", function() {
        name = $(this).text();

        $('.modal-tabs').removeClass('active');
        $(this).addClass('active');

        $('.pct-display').val("");

        labelApp.setDesc();
        labelApp.init();
        labelApp.setAll();
 
      });
    }
  });
}

labelApp.getValues = function() {
  return $.ajax({
    url: "api/label.php",
    dataType: "json",
    data: {fund: name,
           lastYear: timeframe,
           invest: amount,
           histpct: histpct,
           volatilitypct: volatilitypct,
           feepct: feepct}
  });
}

labelApp.getYear = function() {
  return $.ajax({
    url: "api/get_year.php",
    dataType: "json"
  });
}

labelApp.getPrices = function() {
  return $.ajax({
    url: "api/get_price.php",
    dataType: "json",
    data: {fund: name,
          lastYear: timeframe,
    }
  });
}

labelApp.updateStats = function(time) {
  var tipString = JSON.stringify(tipHover);
  //console.log("time: ", time);
  var postData = {view: time, 
           timeframe: timeframeChange,
           amount: amountChange,
           historical: historicalChange,
           volatility: volatilityChange,
           fee: feeChange,
           tipArray: tipString,
           experimentClick: experimentClick};
  //console.log("postData: ", tipString);
  $.ajax({
    url: "api/update_label.php",
    type: "POST",
    data: postData
  });
}

labelApp.compareStats = function(isButton, fundArray) {
  var fundString = JSON.stringify(fundArray);
  $.ajax({
    url: "api/update_compare.php",
    type: "POST",
    data: {isButton: isButton,
           fundArray: fundString}
  });
}

labelApp.getBenchmark = function() {
  return $.ajax({
    url: "api/label_benchmark.php",
    dataType: "json",
    data: {lastYear: timeframe,
           invest: amount}
  });
}

labelApp.setRecommendation = function() {
  var timeframeFac = timeframe;
  var histFac;
  var volFac;
  var feeFac;

  var histTemp = parseFloat($('#label-growth-pct').attr('placeholder'));
  var volTemp = parseFloat($('#label-volatility-pct').attr('placeholder'));
  var feeTemp = parseFloat($('#label-fee-pct').attr('placeholder'));

  if (!experimentFlag) {
    histFac = histTemp;
    volFac = volTemp;
    feeFac = feeTemp;
  }
  else {
    if (histpct == -1) {
      histFac = histTemp;
    } else {
      histFac = histpct;
    }
    if (volatilitypct == -1) {
      volFac = volTemp;
    } else {
      volFac = volatilitypct;
    }
    if (feepct == -1) {
      feeFac = feeTemp;
    } else {
      feeFac = feepct;
    }
  }

  var timeRec = timeframeFac >= 5;
  var growthRec = histFac >= 8;
  var volRec = volFac <= 8;
  var feeRec = feeFac <= 1;

  var overallRec = (growthRec & volRec & feeRec) | (growthRec & timeRec & feeRec) | (!timeRec & volRec & feeRec);

  if (overallRec) {
    $('.recommend-icon').show();
    $('.reject-icon').hide();
    $('#label-recommend-head').text('Recommended to you for');
    $('#label-recommend').show();
  } else {
    $('.recommend-icon').hide();
    $('.reject-icon').show();
    $('#label-recommend-head').text('Not recommended');
    $('#label-recommend').hide();
  }

  /*
  if (recommendFlag.substring(0,1) == '>') {
    if (timeframe > parseInt(recommendFlag.substring(1))) {
      $('.recommend-icon').show();
      $('.reject-icon').hide();
      $('#label-recommend-head').text('Recommended to you for');
      $('#label-recommend').show();

    } else {
      $('.recommend-icon').hide();
      $('.reject-icon').show();
      $('#label-recommend-head').text('Not recommended');
      $('#label-recommend').hide();

    }
  } else if (recommendFlag.substring(0,1) == '<') {
    if (timeframe < parseInt(recommendFlag.substring(1))) {
      $('.recommend-icon').show();
      $('.reject-icon').hide();
      $('#label-recommend-head').text('Recommended to you for');
      $('#label-recommend').show();

    } else {
      $('.recommend-icon').hide();
      $('.reject-icon').show();
      $('#label-recommend-head').text('Not recommended');
      $('#label-recommend').hide();


    }
  }
  */
}

labelApp.setDesc = function() {
  $.ajax({
    url: "api/label_desc.php",
    dataType: "json",
    data: {fund: name},
    success: function(data) {
      $('#label-fund-name').text(data[0] + " (" + data[1] + ")");
      $('#label-desc').text(data[6]);
      $('#label-desc2').text(data[6]);
      
      var fundNumber = data[0].substring(0,1) + data[6].length * 10 + data[0].substring(data[0].length-1,data[0].length);
      $('#fundNumber').text(fundNumber);

      var fundTypeStr = data[0].replace("Investment Grade",'').replace('Index','');
      fundTypeStr = fundTypeStr.substring(0,fundTypeStr.length - 2).replace('Cash Fu','');
      $('#fundType').text(fundTypeStr);

      $('#label-3rating').empty();
      $('#label-5rating').empty();
      $('#label-10rating').empty();
 
      for (var i = 0; i < 5; i++) {
        if (i < data[4][0]) {
          $('#label-3rating').append("<i class='fa fa-star black'></i>")
        } else {
          $('#label-3rating').append("<i class='fa fa-star-o black'></i>")
        }
      }
      for (var i = 0; i < 5; i++) {
        if (i < data[4][1]) {
          $('#label-5rating').append("<i class='fa fa-star black'></i>")
        } else {
          $('#label-5rating').append("<i class='fa fa-star-o black'></i>")
        }
      }
      for (var i = 0; i < 5; i++) {
        if (i < data[4][2]) {
          $('#label-10rating').append("<i class='fa fa-star black'></i>")
        } else {
          $('#label-10rating').append("<i class='fa fa-star-o black'></i>")
        }
      }

      $('#label-3return').text(data[2][0]); 
      $('#label-5return').text(data[2][1]); 
      $('#label-10return').text(data[2][2]); 

      $('#label-3risk').text(data[3][0]); 
      $('#label-5risk').text(data[3][1]); 
      $('#label-10risk').text(data[3][2]); 

      $('#label-recommend').text(data[5]);

      recommendFlag = data[7];
    }
  });
}

labelApp.setHistorical = function(data) {
  if (timeframe >= 20) {
    $('#label-hist1').text('$' + numberWithCommas(parseInt(data[4][0])));
    $('#label-hist2').text('$' + numberWithCommas(parseInt(data[4][1])));
    $('#label-hist3').text('$' + numberWithCommas(parseInt(data[4][2])));
 
  } else if (timeframe > 1) {
    $('#label-hist1').text('$' + numberWithCommas(parseInt(data[4][0])));
    $('#label-hist2').text('$' + numberWithCommas(parseInt(data[4][2])));
    $('#label-hist3').text('$' + numberWithCommas(parseInt(data[4][5])));

  } else {
    $('#label-hist1').text('$' + numberWithCommas(parseInt(data[4][0])));
    $('#label-hist2').text('$' + numberWithCommas(parseInt(data[4][1])));
    $('#label-hist3').text('$' + numberWithCommas(parseInt(data[4][5])));

  }  

var notional = 10000;
if (timeframe >= 20) {
$('#label-hist1b').text((data[4][0]/notional).toFixed(2) + '%');
    $('#label-hist2b').text((data[4][1]/notional).toFixed(2) + '%');
    $('#label-hist3b').text((data[4][2]/notional).toFixed(2) + '%');
  } else if (timeframe > 1) {
$('#label-hist1b').text((data[4][0]/notional).toFixed(2) + '%');
    $('#label-hist2b').text((data[4][2]/notional).toFixed(2) + '%');
    $('#label-hist3b').text((data[4][5]/notional).toFixed(2) + '%');
  } else {
    $('#label-hist1b').text((data[4][0]/notional).toFixed(2) + '%');
    $('#label-hist2b').text((data[4][1]/notional).toFixed(2) + '%');
    $('#label-hist3b').text((data[4][5]/notional).toFixed(2) + '%');

  }


}

labelApp.setEstimates = function(data) {
  if (timeframe >= 20) {
    $('#label-best1').text('$' + numberWithCommas(parseInt(data[8][0])));
    $('#label-best2').text('$' + numberWithCommas(parseInt(data[8][1])));
    $('#label-best3').text('$' + numberWithCommas(parseInt(data[8][2])));
    $('#label-likely1').text('$' + numberWithCommas(parseInt(data[7][0])));
    $('#label-likely2').text('$' + numberWithCommas(parseInt(data[7][1])));
    $('#label-likely3').text('$' + numberWithCommas(parseInt(data[7][2])));
    $('#label-worst1').text('$' + numberWithCommas(parseInt(data[9][0])));
    $('#label-worst2').text('$' + numberWithCommas(parseInt(data[9][1])));
    $('#label-worst3').text('$' + numberWithCommas(parseInt(data[9][2])));

  } else if (timeframe > 1) {
    $('#label-best1').text('$' + numberWithCommas(parseInt(data[8][0])));
    $('#label-best2').text('$' + numberWithCommas(parseInt(data[8][2])));
    $('#label-best3').text('$' + numberWithCommas(parseInt(data[8][5])));
    $('#label-likely1').text('$' + numberWithCommas(parseInt(data[7][0])));
    $('#label-likely2').text('$' + numberWithCommas(parseInt(data[7][2])));
    $('#label-likely3').text('$' + numberWithCommas(parseInt(data[7][5])));
    $('#label-worst1').text('$' + numberWithCommas(parseInt(data[9][0])));
    $('#label-worst2').text('$' + numberWithCommas(parseInt(data[9][2])));
    $('#label-worst3').text('$' + numberWithCommas(parseInt(data[9][5])));

  } else {
    $('#label-best1').text('$' + numberWithCommas(parseInt(data[8][0])));
    $('#label-best2').text('$' + numberWithCommas(parseInt(data[8][1])));
    $('#label-best3').text('$' + numberWithCommas(parseInt(data[8][5])));
    $('#label-likely1').text('$' + numberWithCommas(parseInt(data[7][0])));
    $('#label-likely2').text('$' + numberWithCommas(parseInt(data[7][1])));
    $('#label-likely3').text('$' + numberWithCommas(parseInt(data[7][5])));
    $('#label-worst1').text('$' + numberWithCommas(parseInt(data[9][0])));
    $('#label-worst2').text('$' + numberWithCommas(parseInt(data[9][1])));
    $('#label-worst3').text('$' + numberWithCommas(parseInt(data[9][5])));

  }

$('#label-likely1b').text('$' + numberWithCommas(parseInt(data[7][0])));
    $('#label-likely2b').text('$' + numberWithCommas(parseInt(data[7][1])));
    $('#label-likely3b').text('$' + numberWithCommas(parseInt(data[7][2])));

}

labelApp.setFees = function(data) {
  if (timeframe >= 20) {
    $('#label-fee1').text('$' + numberWithCommas(parseInt(data[5][0])));
    $('#label-fee2').text('$' + numberWithCommas(parseInt(data[5][1])));
    $('#label-fee3').text('$' + numberWithCommas(parseInt(data[5][2])));

  } else if (timeframe > 1) {
    $('#label-fee1').text('$' + numberWithCommas(parseInt(data[5][0])));
    $('#label-fee2').text('$' + numberWithCommas(parseInt(data[5][2])));
    $('#label-fee3').text('$' + numberWithCommas(parseInt(data[5][5])));

  } else {
    $('#label-fee1').text('$' + numberWithCommas(parseInt(data[5][0])));
    $('#label-fee2').text('$' + numberWithCommas(parseInt(data[5][1])));
    $('#label-fee3').text('$' + numberWithCommas(parseInt(data[5][5])));

  }

  $('#expense-ratio').text((data[2]*100).toFixed(2));

}

labelApp.setAll = function() {
  labelApp.getBenchmark().success(function(data) {
    if (timeframe >= 20) {
      $('#label-hbench1').text(numberWithCommas('$'+parseInt(data[0][0])));
      $('#label-hbench2').text(numberWithCommas('$'+parseInt(data[0][1])));
      $('#label-hbench3').text(numberWithCommas('$'+parseInt(data[0][2])));
      $('#label-lbench1').text(numberWithCommas('$'+parseInt(data[1][0])));
      $('#label-lbench2').text(numberWithCommas('$'+parseInt(data[1][1])));
      $('#label-lbench3').text(numberWithCommas('$'+parseInt(data[1][2])));
  
    } else if (timeframe > 1) {
      $('#label-hbench1').text(numberWithCommas('$'+parseInt(data[0][0])));
      $('#label-hbench2').text(numberWithCommas('$'+parseInt(data[0][2])));
      $('#label-hbench3').text(numberWithCommas('$'+parseInt(data[0][5])));
      $('#label-lbench1').text(numberWithCommas('$'+parseInt(data[1][0])));
      $('#label-lbench2').text(numberWithCommas('$'+parseInt(data[1][2])));
      $('#label-lbench3').text(numberWithCommas('$'+parseInt(data[1][5])));
  
    } else {
      $('#label-hbench1').text(numberWithCommas('$'+parseInt(data[0][0])));
      $('#label-hbench2').text(numberWithCommas('$'+parseInt(data[0][1])));
      $('#label-hbench3').text(numberWithCommas('$'+parseInt(data[0][5])));
      $('#label-lbench1').text(numberWithCommas('$'+parseInt(data[1][0])));
      $('#label-lbench2').text(numberWithCommas('$'+parseInt(data[1][1])));
      $('#label-lbench3').text(numberWithCommas('$'+parseInt(data[1][5])));
  
    }

  });

  labelApp.getValues().success(function(data) {
    if (!experimentFlag) {
      $('#label-growth-pct').val($('#label-growth-pct').attr('placeholder'));
      $('#label-volatility-pct').val($('#label-volatility-pct').attr('placeholder'));
      $('#label-fee-pct').val($('#label-fee-pct').attr('placeholder'));
      //$('#label-invest').val($('#label-invest').attr('placeholder'));
      $('#label-invest').val("$10,000");
    }

    $('#historical-growth-amount').text(numberWithCommas('$'+parseInt(amount)));;

    labelApp.setHistorical(data);
    labelApp.setEstimates(data);
    labelApp.setFees(data);

    labelApp.setRecommendation();

    /*
    if (experimentFlag) {
      if ($('#label-growth-pct').val() == "") {
        labelApp.setHistorical(data);
      } else {
        histpct = parseFloat($('#label-growth-pct').val());
        labelApp.getValues().success(function(data2) {
          labelApp.setHistorical(data2);
        });
      }
  
      if ($('#label-volatility-pct').val() == "") {
        labelApp.setEstimates(data);
      } else {
        volatilitypct = parseFloat($('#label-volatility-pct').val());
        labelApp.getValues().success(function(data2) {
          labelApp.setEstimates(data2);
        });
      }
  
      if ($('#label-fee-pct').val() == "") { 
        labelApp.setFees(data);
      } else {
        feepct = parseFloat($('#label-fee-pct').val());
        labelApp.getValues().success(function(data2) {
          labelApp.setFees(data2);
        });
      }
    } else {
      labelApp.setHistorical(data);
      labelApp.setEstimates(data);
      labelApp.setFees(data);
    }
    */

  });
}

labelApp.highlight = function() {
  $('.label-table td').removeClass('bg-lightblue');
  if (timeframe >= 20) {
    $('.label-table td:nth-child(5)').addClass('bg-lightblue');
  } else if (timeframe > 1) {
    $('.label-table td:nth-child(4)').addClass('bg-lightblue');
  } else {
    $('.label-table td:nth-child(3)').addClass('bg-lightblue');
  }
}

labelApp.tableHeaders = function() {
  if (timeframe >= 20) {
    $('.label-year1head').text(1);
    $('.label-year2head').text(5);
    $('.label-year3head').text(timeframe);
  } else if (timeframe > 1) {
    $('.label-year1head').text(1);
    $('.label-year2head').text(timeframe);
    $('.label-year3head').text(20);
  } else {
    $('.label-year1head').text(1);
    $('.label-year2head').text(5);
    $('.label-year3head').text(20);
  }

}

$(function() {
  $('#apply-btn').hide();

  timeframePlaceholder = $('#label-timeframe').attr('placeholder');
  timeframe = timeframePlaceholder;

  labelApp.fillTabs();

  labelApp.setCondition();

  $('[data-toggle="tooltip"]').tooltip();

  
  $('#label-timeframe').change(function() {
    timeframeChange++;
  
    $('#label-timeframe').val($('#label-timeframe').val().replace(/[^0-9]+/g,''));

    initTimeframe = parseInt($('#label-timeframe').val()) || timeframePlaceholder;
  
    if (!experimentFlag) {

      if (parseInt($('#label-timeframe').val()) == 0) {
        $('#label-timeframe').val("");
      }
  
      timeframe = parseInt($('#label-timeframe').val()) || timeframePlaceholder;
  
      if (timeframe > maxTimeframe) {
        timeframe = maxTimeframe;
      }
  
      labelApp.tableHeaders();
      labelApp.highlight();
  
      labelApp.setAll();

    }
  });

  $('#apply-btn').click(function() {
    timeframe = parseInt($('#label-timeframe').val());
    amount = parseInt($('#label-invest').val());
    histpct = parseFloat($('#label-growth-pct').val()); 
    volatilitypct = parseFloat($('#label-volatility-pct').val());
    feepct = parseFloat($('#label-fee-pct').val());
   
    if (!timeframe || !amount || !histpct || !volatilitypct || !feepct) {
      $('.error-label').show();
    } else {
      $('.error-label').hide();

      labelApp.tableHeaders();
      labelApp.highlight();
      labelApp.setAll();
    }
  });
  

  
  $('#label-invest').change(function() {
    amountChange++;

    $('#label-invest').val($('#label-invest').val().replace(/[^0-9]+/g,''));
    /*
    amount = parseInt($('#label-invest').val()) || 0;

    labelApp.setAll();
    */
  });
  

  $('.fake-link').click(function() {
    $('.error-label').hide();

    $('#label-timeframe').attr('placeholder', timeframePlaceholder);

    experimentFlag = 0;

    name = $(this).text();
    name = name.replace('Learn more about this fund', '');
    name = name.trim();

    var fundArray = [name];
    labelApp.compareStats(0, fundArray);

    $('.pct-display').val("").attr('readonly', true);

    $('#label-invest').attr('readonly', true);

    timeframe = timeframePlaceholder;
    amount = amountPlaceholder;
    histpct = -1;
    volatilitypct = -1;
    feepct = -1;

    $('.label-floor-year').text(timeframe);

    labelApp.tableHeaders();
    labelApp.highlight();

    labelApp.setDesc();

    $('.modal-tabs').hide();
    $('.modal-tabs:contains("' + name + '")').show().addClass('active');
 
    labelApp.init();
    labelApp.setAll();
  });

  $('#btn-compare').click(function() {
    var checkedFunds = new Array();
    var checked = $('input[type="checkbox"]:checked');
    if (checked.length >= 1) {
      for (var i = 0; i < checked.length; i++) {
        checkedFunds.push(checked[i].name);
      }

      experimentFlag = 0;

      labelApp.compareStats(1, checkedFunds);

      $('.error-label').hide();

      $('#label-timeframe').attr('placeholder', timeframePlaceholder);
  
      $('.modal-tabs').hide();
      for (var i = 0; i < checkedFunds.length; i++) {
        $('.modal-tabs:contains("' + checkedFunds[i] + '")').show().removeClass('active');
      }

      name = checkedFunds[0];
  
      $('.modal-tabs:contains("' + name + '")').addClass('active');
  
      $('#label-modal').modal('toggle');

      $('.pct-display').val("").attr('readonly', true);

      $('#label-invest').attr('readonly', true);

      timeframe = timeframePlaceholder;
      amount = amountPlaceholder;
      histpct = -1;
      volatilitypct = -1;
      feepct = -1;
  
      $('.label-floor-year').text(timeframe);

      labelApp.tableHeaders();
      labelApp.highlight();
      labelApp.setDesc();
  
      labelApp.init();
      labelApp.setAll();
    } else {
      //alert("Please select funds in the list above to compare.");
      $('#alertModal').modal('toggle');
    }
  });

  $('#label-modal').on('shown.bs.modal', function() {
    openTime = new Date();

    timeframeChange = 0;
    amountChange = 0;
    historicalChange = 0;
    volatilityChange = 0;
    feeChange = 0;

    experimentClick = 0;

    tipHover = {};

    for (var i = 0; i < $('[data-toggle="tooltip"]').length; i++) {
      tipHover[$('[data-toggle="tooltip"]')[i].id] = 0;
    }
  });

  $('#label-modal').on('hide.bs.modal', function() {
    closeTime = new Date();
    var difference = (closeTime - openTime) / 1000 / 60;

    labelApp.updateStats(difference);
    //experimentFlag = 0;
    experimentClick = 0;
  });

  
  $('#label-growth-pct').change(function() {
    historicalChange++;

    $('#label-growth-pct').val($('#label-growth-pct').val().replace(/[^0-9\.]+/g,''));

    /*
    if ($('#label-growth-pct').val() == "") {
      histpct = 0;
    } else {
      histpct = parseFloat($('#label-growth-pct').val());
    }

    labelApp.getValues().success(function(data) {
      labelApp.setHistorical(data);
      labelApp.setEstimates(data);
      labelApp.setFees(data);

      labelApp.setRecommendation();
    });
    */
  });
  

  
  $('#label-volatility-pct').change(function() {
    volatilityChange++;

    $('#label-volatility-pct').val($('#label-volatility-pct').val().replace(/[^0-9\.]+/g,''));

    /*
    if ($('#label-volatility-pct').val() == "") {
      volatilitypct = 0;
    } else {
      volatilitypct = parseFloat($('#label-volatility-pct').val());
    } 
    labelApp.getValues().success(function(data) {
      labelApp.setEstimates(data);

      labelApp.setRecommendation();
    });
    */
  });
  

  
  $('#label-fee-pct').change(function() {
    feeChange++;

    $('#label-fee-pct').val($('#label-fee-pct').val().replace(/[^0-9\.]+/g,''));

    /*
    if ($('#label-fee-pct').val() == "") { 
      feepct = 0;
    } else {
      feepct = parseFloat($('#label-fee-pct').val());
    }

    labelApp.getValues().success(function(data) {
      labelApp.setHistorical(data);
      labelApp.setEstimates(data);
      labelApp.setFees(data);

      labelApp.setRecommendation();
    });
    */
  });
  

  $('.label-experiment').click(function() {
    experimentClick++;
    if (!experimentFlag) {
      labelApp.setCondition();

      $('#apply-btn').show();

      $('.pct-display').attr('readonly', false);
      $('#label-invest').attr('readonly', false);
  
      $('.pct-display').val('');
      $('.label-input').val('');
      $('.pct-display').attr('placeholder', '');
      $('.label-input').attr('placeholder', '');

      experimentFlag = 1;
    } else {
      $('.error-label').hide();

      $('#apply-btn').hide();

      $('.pct-display').val("").attr('readonly', true);
  
      $('#label-invest').attr('readonly', true);
  
      $('#label-timeframe').attr('placeholder', timeframePlaceholder);
      $('#label-timeframe').val('');

      timeframe = timeframePlaceholder;
      amount = amountPlaceholder;
      histpct = -1;
      volatilitypct = -1;
      feepct = -1;
  
      $('.label-floor-year').text(timeframe);
  
      labelApp.init();
      labelApp.setAll();

      experimentFlag = 0;
    }
  });

  $('[data-toggle="tooltip"]').on('shown.bs.tooltip',function() {
    tipHover[$(this)[0].id]++;
  });

});
