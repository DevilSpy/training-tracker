$(document).ready(function() {
	// show particular user's dates
	$('[id^=dates]').toggle(); // id^ means that id starts with
	$('[id^=userDates]').click(function() {
		var num = this.id.slice(9);
		var elem = 'dates'+num; 
		$('#dates'+num).toggle();
	});
	
	// show every users' dates
	$('#allUserDates').click(function() {
		$('[id^=dates]').toggle();
		$('.user').show();
	});
	
	// hide user rows
	$('.user').toggle();
	$('#addusersclick').click(function(){
		$('.user').toggle();
		$('[id^=dates]').hide();
	});
	
	// hide participants
	$('[id^=participants]').toggle();
	$('[id^=exercisedate]').click(function() {
		var date = this.id.slice(12);
		var elem = 'participants'+date;
		$('#participants'+date).toggle();  	
	});
});