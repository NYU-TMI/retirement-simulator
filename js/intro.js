var stockRet = .078;
var bondRet = .065;
var cashRet = 0;

var stockVol = 0.15;
var bondVol = 0.04;
var cashVol = 0;

var portRet = 0;
var portVol = 0;

var groupid = 1;

var App = function() {

};

App.prototype.calcFV = function(save, percentRet, years) {
	var val = save;
	for (var i = 0; i < years; i++) {
		val += val * percentRet;
	}
	return Math.round(val);
};

App.prototype.calcReturns = function(yearlySavings, percentRet, years) {
	var val = 0;
	for (var i = 0; i < years; i++) {
		val += yearlySavings;
		val = val * (1 + percentRet);
	}
	return Math.round(val);
};

App.prototype.numberWithCommas = function(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
};

App.prototype.calcEstOutcome = function() {
	var t = this;

	var pstock = $('#inputPStock').val()/100;
	var pbond = $('#inputPBond').val()/100;
	var pcash = $('#inputPCash').val()/100;
	var amount = $('#inputAmount').val()*1;

	var remainingYears = $('#inputYears').val()*1;;
	var actualEst = estimate;
	var totalPercent =  pstock + pbond + pcash;
	totalPercent = Math.round(totalPercent*100)/100;
	portRet = stockRet*pstock + bondRet*pbond + cashRet*pcash;
	portVol = (stockVol*pstock + bondVol*pbond + cashVol*pcash);
	portVol = portVol/(1/portVol);

	if (totalPercent != 1) {
		$('#calcMsg').show();
		$('#estimate, #estimateLow, #estimateHigh').text('');
	} else {
		$('#calcMsg').hide();
		

		var estLow = Math.round(t.calcReturns(amount,portRet-portRet/Math.sqrt(remainingYears), remainingYears));
		var estLikely = t.calcReturns(amount,portRet,remainingYears);
		var estHigh = Math.round(t.calcReturns(amount,portRet+portRet/Math.sqrt(remainingYears), remainingYears));

		$('#estimateLow').text('$'+t.numberWithCommas(estLow));
		$('#estimate').text('$'+t.numberWithCommas(estLikely));
		$('#estimateHigh').text('$'+t.numberWithCommas(estHigh));

		//$('#inputGoal').val(estLikely);
	}

	
};

App.prototype.addEvents = function() {
	var t = this;
	$('.asset').change(function() {
		t.calcEstOutcome();
	});

	$('#inputAge').change(function() {
		var val = $(this).val() ;
		if (isNaN(+val)) {
			alert('Please enter a number for your age.');
			$(this).val('');
		}

	});

	$('#calcBtn').click(function(e) {
		t.calcEstOutcome();
		e.preventDefault();
		return false;
	});

	$('#inputGoal').blur(function() {
		var nval = $('#inputGoal').val().replace(/\D/g,'');
		$('#inputGoal').val(nval);
	});

	$('#continueBtn').click(function(e) {

		if ($('#inputAge').val() == '' || 
			$('form')[0].gender.value == '' ||
			$('form')[0].experience.value == '' ||
			$('form')[0].hasretire.value == '') {
			$('#questionMsg').show();
			window.scrollTo(0, 0);
		} else {
			var age = $('#inputAge').val().replace(/\D/g,'');
			$('#inputAge').val(age);
			t.createUser();
		}
		return false;
	});

	$('.info').tooltip();

};

App.prototype.calcTurkReward  = function() {

};

App.prototype.createUser = function() {
	$('#continueBtn').attr('disabled', 'disabled');
	$.ajax({
		type: "GET",
		url: "api/create_user.php",
		data: { 
			mtwid: $('#mtwid').val(),
			goal: $('#inputGoal').val(),
			age: $('#inputAge').val(),
			gender: document.querySelector('input[name="gender"]:checked').value,
			experience: document.querySelector('input[name="experience"]:checked').value,
			hasretire: document.querySelector('input[name="hasretire"]:checked').value,
		},
		success: function(data) {
          if (groupid == 8) {
            document.location = 'survey.php';
          } else {
			document.location = 'home.php';
          }
		}
	});
};

App.prototype.genBonus = function(end) {
	var goal = $('#inputGoal').val();
	var bonus = (Math.round((1 - Math.abs((end - goal)/goal) * 9) * 400) / 100);
	if (bonus < 0){
		bonus = 0;
	}
	return bonus.toFixed(2);
};

App.prototype.savingsAndBonus = function() {
	var t = this;
	//var end1 = 1250000;
	var end2 = 1350000;
	var end3 = 1450000;
	var end4 = 1500000;
	var end5 = 1550000;
	var end6 = 1650000;
	//var end7 = 1750000;
	var goal = $('#inputGoal').val();

	//$('#end1').text('$'+t.numberWithCommas(end1));
	$('#end2').text('$'+t.numberWithCommas(end2));
	$('#end3').text('$'+t.numberWithCommas(end3));
	$('#end4').text('$'+t.numberWithCommas(end4));
	$('#end5').text('$'+t.numberWithCommas(end5));
	$('#end6').text('$'+t.numberWithCommas(end6));
	//$('#end7').text('$'+t.numberWithCommas(end7));

	//$('#bonus1').text('$'+t.genBonus(end1));
	$('#bonus2').text('$'+t.genBonus(end2));
	$('#bonus3').text('$'+t.genBonus(end3));
	$('#bonus4').text('$'+t.genBonus(end4));
	$('#bonus5').text('$'+t.genBonus(end5));
	$('#bonus6').text('$'+t.genBonus(end6));
	//$('#bonus7').text('$'+t.genBonus(end7));

	$('.final-goal').text('$'+t.numberWithCommas(goal));
};

App.prototype.setCondition = function () {
  $.get("api/get_groupid.php", function(data) {
    groupid = data;
    if (groupid == 8) {
      $('.cond8-show').removeClass('cond8-show');
    } else {
      $('.cond8-hide').removeClass('cond8-hide');
    }
  });
}

App.prototype.init = function() {
	var t = this;
	t.addEvents();
	t.calcEstOutcome();
	$('#questionMsg').hide();

	t.savingsAndBonus();
    t.setCondition();
};

$(function() {
  var app = new App();
  app.init();
});
