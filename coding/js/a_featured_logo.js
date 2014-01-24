$('#logo_container').delegate('#business_select', 'change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var c = el.closest('td');
	var business_id = el.val();
	$.post('/admin/ajax/getFeaturedBusinessSelected', {
		business_id : business_id
	}, function(data){
		c.next().html(data);
		el.data('working', false);
	}, 'html');
	return false;
});
