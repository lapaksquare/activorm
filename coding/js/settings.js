jQuery(document).ready(function($){
	$('.real-file').change(function(){
		$('.fake-file').val($(this).val());
	});

	$('.dark-select').dropkick({
		theme : 'dark'
	});
	$('.light-select').dropkick({
		theme : 'light'
	});

	$('.custom-checkgrey').prettyCheckable({
		color: 'atv-grey'
	});
	$('.custom-checkwhite').prettyCheckable({
		color: 'atv-white'
	});
	$('.custom-checksmall').prettyCheckable({
		color: 'atv-small'
	});
	$('.custom-checkupgrade').prettyCheckable({
		color: 'atv-upgrade'
	});
	$('.custom-checkstep').prettyCheckable({
		labelPosition: 'left',
		color: 'atv-select'
	});
});

function cookieChecked(){
	var cookie_checked = $.cookie('cookie_checked'),
		checked = [];
		
	if(!$.isArray(cookie_checked)){
		var arr = cookie_checked.split(',');
		$.each(arr, function(i,v){
			checked.push(v.replace(/[^\d\+]/g, ''));
		});
		
		return checked;
	}
	else{
		return cookie_checked;
	}
}

function setCookie(name, value){
	$.cookie.raw = true;
	$.cookie.json = true;
	return $.cookie(name, value, { expires: 7, path: '/' });	
}

function removeCookie(name){
	return $.removeCookie(name, { path: '/' });
}

function removeAllCookie(){
	var cookie = $.cookie();
	
	$.each(cookie, function(i,v){
		removeCookie(i);
	});
}

function log(string){
	return console.log(string);	
}