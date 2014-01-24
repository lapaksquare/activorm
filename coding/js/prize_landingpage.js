$('#prize_drop').bind('change', function(){
	var el = $(this);
	var v = el.val();
	window.location = base_url + 'prize?pl=' + v;
});
