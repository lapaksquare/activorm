$(function(){
	
	$('#table').delegate('#parent_interests', 'change', function(){
		var el = $(this);
		if (el.data('working')) return false;
		el.data('working', true);
		
		var interest_id = el.attr('data-interest_id');
		var name = el.attr('data-name');
		var v = el.val();
		
		$.post('/admin/ajax/registerInterestsRel', {
			interest_id : interest_id,
			name : name,
			mip_id : v
		}, function(data){
			if (data.msg == 0){
				el.next().addClass('glyphicon-remove');
			}else{
				el.next().addClass('glyphicon-ok');
			}
			el.data('working', false);
		}, 'json');
		
 		return false;
	});
	
});