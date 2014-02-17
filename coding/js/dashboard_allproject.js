$(function(){
	
	$('#dashboard_allproject').delegate('#project_modal', 'click', function(){
		var el = $(this);
		if (el.data('working')) return false;
		el.data('working', true);
		var pid = el.attr('data-pid');
		var h = el.attr('data-h');
		$.post('/ajax/getDashboardProjectData', {
			h : h,
			pid : pid
		}, function(data){
			
			if (data == ""){
				alert('Something Error');
			}else{
			
				$('#modal-overview').find('#modal-body').html(data);
				$('#modal-overview').css({
					opacity:1
				});
				$('#modal-overview').fadeIn();
				
			}
			
			el.data('working', false);
			
		}, 'html');
		return false;	
	});
	
	$('#modal-overview').delegate('#btn-close', 'click', function(){
		$('#modal-overview').hide();
		return false;
	});
	
	$('#projects_selected').bind('change', function(){
		var el = $(this);
		var v = el.val();
		window.location = base_url + 'dashboard/project/' + v;
	});
	
});
