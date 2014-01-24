$('#featured_prize').delegate('select#business_id', 'change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var bid = el.val();
	$.post('/admin/ajax/getFeaturedProjectAll', {
		business_id : bid
	}, function(data){
		el.closest('#featured_prize').next().find('select#project_id').html(data);
		el.data('working', false);
	}, 'html');	
	return false;
});

$('#featured_prize').find('select#business_id').each(function(){
	var el = $(this);
	var bid = el.attr('data-bid');
	var pid = el.attr('data-pid');
	if (bid > 0 && pid > 0){
		$.post('/admin/ajax/getFeaturedProjectAll', {
			business_id : bid,
			project_id : pid
		}, function(data){
			el.closest('#featured_prize').next().find('select#project_id').html(data);
		}, 'html');	
	}
});

$('#delete_prize').bind('click', function(){
	var el = $(this);
	var r = confirm("Are you sure to delete this prize ?");
	if (r == false) return false;
});
