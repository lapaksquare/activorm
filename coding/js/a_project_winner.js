$('#prize_drop').bind('change', function(){
	var el = $(this);
	var v = el.val();
	window.location = base_url + 'admin/project_winner?project_live=' + v;
});