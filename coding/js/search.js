$(function(){
	$('#btn-suggest-submit').bind('click', function(){
		var el = $(this);
		if (el.data('working')) return false;
		el.data('working', true);
		$('#loading-bar-top').slideDown();
		var v = el.attr('data-sq');
		$.post('/ajax/submit_search_suggest', {
			'suggest_name' : v
		}, function(data){
			el.data('working', false);
			if (data.error == 0){
				el.parent().html(data.message);
			}else{
				alert('Something Error!');
			}
			$('#loading-bar-top').slideUp();
		}, 'json');
		return false;
	});
});
