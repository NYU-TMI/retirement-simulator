var prospectApp = {};
prospectApp.fundsNameSymbol = [];
prospectApp.getFundSymbols = function() {
  $.ajax({
    url: "api/fund_names_symbols.php",
    dataType: "json",
    success: function(data) {
      for (var i = 0; i < data.length; i++) {
      	var fund = data[i];
      	var fundName = fund.fundName + "";
      	prospectApp.fundsNameSymbol[fundName] = fund.fundSymbol;
      }
    }
  });
}

$('.fake-link').click(function() {
  var fundName = $(this).text() + "";
  fundName = fundName.trim();
  var prospectFrame = $('iframe.prospectus')[0];
  var url = '../prospectus/';
  if (fundName.indexOf("Stock") != -1) {
  	url += 'comments_prospectus.php';
  } else if (fundName.indexOf("Bond") != -1) {
  	url += 'comments_prospectus_bond.php';
  } else if (fundName.indexOf("Lifecycle") != -1) {
  	url += 'comments_prospectus_lifecycle.php';
  } else if (fundName.indexOf("Cash") != -1) {
  	url += 'prospectus_cash.php';
  }
  var symbol = prospectApp.fundsNameSymbol[fundName];
  url += "?symbol=" + symbol;
  if (groupid == 14) {
    url += "&comment=1";
  }
  prospectFrame.src = url;
});

prospectApp.getFundSymbols();
