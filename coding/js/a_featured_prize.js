$('#featured_prize').delegate('#business_select', 'change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var bid = el.val();
	$.post('/admin/ajax/getFeaturedProjectAll', {
		business_id : bid
	}, function(data){
		el.closest('td').next().find('select').html(data);
		el.data('working', false);
	}, 'html');	
	return false;
});

$('#featured_prize').find('.business_select').each(function(){
	var el = $(this);
	var bid = el.attr('data-bid');
	var pid = el.attr('data-pid');
	if (bid > 0 && pid > 0){
		$.post('/admin/ajax/getFeaturedProjectAll', {
			business_id : bid,
			project_id : pid
		}, function(data){
			el.closest('td').next().find('select').html(data);
		}, 'html');	
	}
});


$('#model_group').delegate('#model', 'change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var bid = el.val();
	
	$('.model-group').hide();
	$('#selected_' + bid).show();
	
	el.data('working', false);
	
	return false;
});
