$(function(){
	$(window).load(function(){
		
		$('#action-steps').delegate('#facebook-like-btn', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
						
			var data_id = el.attr('data-id');
			$('#overlay-wizard').attr('data-idt', data_id);
			$('#overlay-wizard').fadeIn(function(){
				
				$('#overlay-box').fadeIn();
				$('#' + data_id).fadeIn();	
				
			});
			
			el.data('working', false);
			return false;
		});
		
		$('#action-steps').delegate('#facebook-like-widget-btn', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
						
			var data_id = el.attr('data-id');
			$('#' + data_id).fadeIn();	
			
			el.data('working', false);
			return false;
		});
		
		$('#overlay-wizard').delegate('#overlay-btn-close', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			
			var data_idt = $('#overlay-wizard').attr('data-idt');
			$('#overlay-wizard').fadeOut();
			$('#overlay-box').fadeOut();
			$('#' + data_idt).fadeOut();
			
			el.data('working', false);
			return false;
		});
		
		$('#project-body').delegate('#btn-start-action', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			
			var closest = el.closest('.wizard-project');
			closest.next().slideDown();
			closest.slideUp();
			
			el.data('working', false);
			return false;
		});
		
		$('#project-body').delegate('#btn-action-close', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			
			var closest = el.closest('.wizard-project');
			closest.prev().slideDown();
			closest.slideUp();
			
			el.data('working', false);
			return false;
		});
		
	});
});
