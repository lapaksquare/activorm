if ($script_timer == 1){
var server_end = $server_end * 1000;
var server_start = $server_start * 1000;
var client = new Date().getTime();
var end = server_end - server_start + client;
var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;
var timer;
function showCountdown(){
	var now = new Date();
	var distance = end - now;
	if (distance < 0){
		clearInterval(showCountdown);
		window.location = window.location;
		//document.getElementById('countdown_container').style.display = "none";
	}
	var days = Math.floor(distance / _day);
	var hours = Math.floor( (distance % _day) / _hour );
	var total_hours = (days * 24) + hours;
	var minutes = Math.floor( (distance % _hour) / _minute );
	var seconds = Math.floor( (distance % _minute) / _second );
	
	var days_html = document.getElementById('hari');
	var hours_html = document.getElementById('jam');
	var menit_html = document.getElementById('menit');
	var detik_html = document.getElementById('detik');
	
	days_html.innerHTML = days;
	hours_html.innerHTML = hours;
	menit_html.innerHTML = minutes;
	//detik_html.innerHTML = seconds;
}
timer = setInterval(showCountdown, 10);
}