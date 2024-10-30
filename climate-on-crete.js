// JavaScript Document
;jQuery.noConflict();
jQuery(document).ready(function($) {
	var maxt;
	var mint;
	var wtp;
	var spt;
	var rpm;
	
	if($('#climate').length > 0 ) {
		change_climate('widget');
	} 
	if($('#climate_short').length > 0 ) {
		change_climate('short');
	} 
	
	
	$('.month').change(function() {
		change_climate('widget');
	});
	
	$('.city').change(function() {
		change_climate('widget');
	});
	
	$('.month_short').change(function() {
		change_climate('short');
	});
	
	$('.city_short').change(function() {
		change_climate('short');
	});
	
	function change_climate(trigger) {
		if(trigger == 'short') {
			if($('#climate').length > 0 ) {
				month = $('.month_short').val();
				city  = $('.city_short').val();
				$('.month').val(month);
				$('.city').val(city);
			} else {
				month = $('.month_short').val();
				city  = $('.city_short').val();
			}
		} 
		else if(trigger == 'widget'){
			if($('#climate_short').length > 0 ) {
				month = $('.month').val();
				city  = $('.city').val();
				$('.month_short').val(month);
				$('.city_short').val(city);
			} else {
				month = $('.month').val();
				city  = $('.city').val();
			}
		}
		
		
		
		if(city == 'rethymnon') {
			maxt = rethymnon['max'][month-1];
			mint = rethymnon['min'][month-1];
			wtp  = rethymnon['wtp'][month-1];
			spt  = rethymnon['spt'][month-1];
			rpm  = rethymnon['rpm'][month-1];
		}
		
		if(city == 'chania') {
			maxt = chania['max'][month-1];
			mint = chania['min'][month-1];
			wtp  = chania['wtp'][month-1];
			spt  = chania['spt'][month-1];
			rpm  = chania['rpm'][month-1];
		}
		
		if(city == 'agiagalini') {
			maxt = agiagalini['max'][month-1];
			mint = agiagalini['min'][month-1];
			wtp  = agiagalini['wtp'][month-1];
			spt  = agiagalini['spt'][month-1];
			rpm  = agiagalini['rpm'][month-1];
		}
		
		if(city == 'plakias') {
			maxt = plakias['max'][month-1];
			mint = plakias['min'][month-1];
			wtp  = plakias['wtp'][month-1];
			spt  = plakias['spt'][month-1];
			rpm  = plakias['rpm'][month-1];
		}
		
		if(city == 'matala') {
			maxt = matala['max'][month-1];
			mint = matala['min'][month-1];
			wtp  = matala['wtp'][month-1];
			spt  = matala['spt'][month-1];
			rpm  = matala['rpm'][month-1];
		}
		
		if(city == 'heraklion') {
			maxt = heraklion['max'][month-1];
			mint = heraklion['min'][month-1];
			wtp  = heraklion['wtp'][month-1];
			spt  = heraklion['spt'][month-1];
			rpm  = heraklion['rpm'][month-1];
		}
		
		if(city == 'agiosnikolaos') {
			maxt = agiosnikolaos['max'][month-1];
			mint = agiosnikolaos['min'][month-1];
			wtp  = agiosnikolaos['wtp'][month-1];
			spt  = agiosnikolaos['spt'][month-1];
			rpm  = agiosnikolaos['rpm'][month-1];
		}
		
		if(city == 'malia') {
			maxt = malia['max'][month-1];
			mint = malia['min'][month-1];
			wtp  = malia['wtp'][month-1];
			spt  = malia['spt'][month-1];
			rpm  = malia['rpm'][month-1];
		}
		
		if(city == 'chorasfakion') {
			maxt = chorasfakion['max'][month-1];
			mint = chorasfakion['min'][month-1];
			wtp  = chorasfakion['wtp'][month-1];
			spt  = chorasfakion['spt'][month-1];
			rpm  = chorasfakion['rpm'][month-1];
		}
		
		if(city == 'sitia') {
			maxt = sitia['max'][month-1];
			mint = sitia['min'][month-1];
			wtp  = sitia['wtp'][month-1];
			spt  = sitia['spt'][month-1];
			rpm  = sitia['rpm'][month-1];
		}
		
		if(city == 'chersonissos') {
			maxt = chersonissos['max'][month-1];
			mint = chersonissos['min'][month-1];
			wtp  = chersonissos['wtp'][month-1];
			spt  = chersonissos['spt'][month-1];
			rpm  = chersonissos['rpm'][month-1];
		}
		
		if(city == 'agiapelagia') {
			maxt = agiapelagia['max'][month-1];
			mint = agiapelagia['min'][month-1];
			wtp  = agiapelagia['wtp'][month-1];
			spt  = agiapelagia['spt'][month-1];
			rpm  = agiapelagia['rpm'][month-1];
		}
		
		if(city == 'agiapaleochora') {
			maxt = agiapaleochora['max'][month-1];
			mint = agiapaleochora['min'][month-1];
			wtp  = agiapaleochora['wtp'][month-1];
			spt  = agiapaleochora['spt'][month-1];
			rpm  = agiapaleochora['rpm'][month-1];
		}
		
		if(city == 'ierapetra') {
			maxt = ierapetra['max'][month-1];
			mint = ierapetra['min'][month-1];
			wtp  = ierapetra['wtp'][month-1];
			spt  = ierapetra['spt'][month-1];
			rpm  = ierapetra['rpm'][month-1];
		}
		
		if(city == 'georgioupolis') {
			maxt = georgioupolis['max'][month-1];
			mint = georgioupolis['min'][month-1];
			wtp  = georgioupolis['wtp'][month-1];
			spt  = georgioupolis['spt'][month-1];
			rpm  = georgioupolis['rpm'][month-1];
		}
		
		if(city == 'mires') {
			maxt = mires['max'][month-1];
			mint = mires['min'][month-1];
			wtp  = mires['wtp'][month-1];
			spt  = mires['spt'][month-1];
			rpm  = mires['rpm'][month-1];
		}
		
		if(city == 'episkopi') {
			maxt = episkopi['max'][month-1];
			mint = episkopi['min'][month-1];
			wtp  = episkopi['wtp'][month-1];
			spt  = episkopi['spt'][month-1];
			rpm  = episkopi['rpm'][month-1];
		}
		
		if(fahrenheit == true) {
			maxtf = ((maxt*9)/5)+32;
			mintf = ((mint*9)/5)+32;
			wtpf  = ((wtp*9)/5)+32;
			$('.max_value').html(Math.round(maxtf));
			$('.min_value').html(Math.round(mintf));
			$('.wtp_value').html(Math.round(wtpf));
			$('.spt_value').html(spt);
			$('.rpm_value').html(rpm);
		} else {
			$('.max_value').html(maxt);
			$('.min_value').html(mint);
			$('.wtp_value').html(wtp);
			$('.spt_value').html(spt);
			$('.rpm_value').html(rpm);
		}
		
	}
	
	
	
	
	
});