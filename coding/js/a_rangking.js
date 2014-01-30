$('#prize_drop').bind('change', function(){
	var el = $(this);
	var v = el.val();
	window.location = base_url + 'admin/rangking?project_live=' + v;
});