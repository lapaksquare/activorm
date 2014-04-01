$(function(){
	$(window).load(function(){
		$('#project-period').slider({
			formater: function(value) {
				return value + ' d';
			}
		});

		$('.limiter').simplyCountable({
			counter: '.counter span',
			maxCount: 60,
			strictMax: true
		});
		
		$('#description_limiter').simplyCountable({
			counter: '#counter_description span',
			maxCount: 500,
			strictMax: true
		});
		
		$("#tags, #hashtags").find("input[type=text]").tagBox({separatorAction:false});
		
		$(".custom-checkupgrade").on("change", function(){
			if($(this).is(":checked")){
				$(".upgrade-options").slideDown();	
				$('#submit-btn-create-f').show();
				$('#submit-btn-create-s').hide();
				$('#premium-submit-draft').show();
			}
			else
			{
				$(".upgrade-options").slideUp();
				$(".upgrade-options").find("li .custom-checkwhite").removeAttr("checked");
				$(".upgrade-options").find("li a").removeClass("checked");
				$(".upgrade-options").find("li .sub-options").hide();
				
				$('#submit-btn-create-s').show();
				$('#submit-btn-create-f').hide();
				$('#premium-submit-draft').hide();
			}
		});
		
		/*
		$(".custom-checkupgrade").ready(function(){
			if($(".custom-checkupgrade").is(":checked")){
				$(".upgrade-options").slideDown();	
				$('#submit-btn-create-f').show();
				$('#submit-btn-create-s').hide();
				$('#premium-submit-draft').show();
			}
			else
			{
				$(".upgrade-options").slideUp();
				$('#submit-btn-create-s').show();
				$('#submit-btn-create-f').hide();
				$('#premium-submit-draft').hide();
			}
		});
		*/
		
		$(".upgrade-options").find("li .opt_premium").each(function(){
			if($(this).is(":checked")){
				$(this).parents("li").find(".sub-options").slideDown();	
				
			}
			else
			{
				$(this).parents("li").find(".sub-options").slideUp();
				
			}
		});
		
		$(".custom-checkwhite, .opt_premium").on("change", function(){
			if($(this).is(":checked")){
				$(this).parents("li").find(".sub-options").slideDown();	
			}
			else
			{
				$(this).parents("li").find(".sub-options").slideUp();
			}
		});
	
		var actions = 0;
		$('#actions-click').find('li .prettycheckbox').each(function(){
			var el = $(this);
			var input = el.find('input');
			var checked = input.attr('checked');
			var v = input.val();
			var data_icon = input.attr('data-icon');
			var data_label = input.attr('data-label');
						
			var step = '';
			for(var $i=1; $i<=3; $i++){
				if (!$('#step' + $i).hasClass('step-ready')){
					step = '#step' + $i;
					break;
				}
			}
			
			//var checked = el.find('a').attr('class');
			var data_step_el = el.attr('data-step');
			if (checked == "checked"){
				actions++;
				
				$(step).addClass('step-ready');
				$(step).find('.step-ico span').addClass(data_icon);
				$(step).find('.step-desc').text(data_label);
				el.find('a').addClass('checked');
				el.find('input').attr('checked', 'checked');
				
				el.attr('data-step', step);
				
			}
			
			if (actions > 3){
				el.find("a").removeClass("checked");
				actions = 3;
			}
										
		});
		
		$('#actions-click').delegate('.prettycheckbox', 'click', function(){
			var el = $(this);
			
			if (el.data('working')) return false;
			el.data('working', true);
						
			// input
			var input = el.find('input');
			var v = input.val();
			var data_icon = input.attr('data-icon');
			var data_label = input.attr('data-label');
			
			var step = '';
			for(var $i=1; $i<=3; $i++){
				if (!$('#step' + $i).hasClass('step-ready')){
					step = '#step' + $i;
					break;
				}
			}
			
			var checked = el.find('a').attr('class');
			var data_step_el = el.attr('data-step');
			if (!data_step_el){
				actions++;
				
				$(step).addClass('step-ready');
				$(step).find('.step-ico span').addClass(data_icon);
				$(step).find('.step-desc').text(data_label);
				el.find('a').addClass('checked');
				el.find('input').attr('checked', 'checked');
				
				el.attr('data-step', step);
				
			}else{
				actions--;
			
				el.attr('data-step', '');
				
				$(data_step_el).removeClass('step-ready');
				$(data_step_el).find('.step-ico span').removeClass(data_icon);
				$(data_step_el).find('.step-desc').text('Unknown');
				el.find('a').removeClass('checked');
				el.find('input').removeAttr('checked');
				
			}
			
			if (actions > 3){
				el.find("a").removeClass("checked");
				el.data('working', false);
				actions = 3;
				return false;
			}
			
			el.data('working', false);
			
			return false;
		});
		
		/*
		$("body").delegate(".custom-checkstep", "change", function(e){
			var el = $(this);
			var v = el.val();
			var data_icon = el.attr('data-icon');
						
			if (el.data('working')) return false;
			el.data('working', true);
			
			alert('a');
			
			if (actions > 3){
				el.parent().find("a").removeClass("checked");
				el.data('working', false);
				return false;
			}
			
			var checked = el.parent().find('a').attr('class');
			if (!checked){
				actions++;
			}else{
				actions--;
			}
			
			// check step
			var step = '';
			for(var $i=1; $i<=3; $i++){
				if (!$('#step' + $i).hasClass('step-ready')){
					step = '#step' + $i;
					break;
				}
			}
			
			$(step).addClass('step-ready');
			
			alert(step);
			
			el.data('working', false);
			
			return false;
		});
		*/
		
		$('#form-submit').delegate('#submit-btn-create-s', 'click', function(){
			//$('#modal-project').modal('show');
			//return false;
		});
		
		if (project_contact_info == 1){
			$('#modal-project').modal('show');
		}
		
		$('#photo_container').delegate('#delete_photo', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			var c = confirm("Are you sure to delete this photo?");
			if (c == true){
				var pid = el.attr('data-pid');
				var h = el.attr('data-h');
				$.post('/ajax/delete_photo_project', {
					pid : pid,
					h : h
				}, function(data){
					if (data.msg == 0){
						alert('Something error to delete photo');
					}else{
						el.closest('.project-thumbnail').fadeOut(function(){
							$(this).remove();
						});
					}
					el.data('working', false);
				}, 'json');
			}
			return false;
		});
		
		$('#project-plan-type').delegate('input', 'change', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			var v = el.attr('data-value');
			if (v == "PREMIUM"){
				$('.premium-plan-container').slideDown();
			}else{
				$('.premium-plan-container').slideUp();
			}
			el.data('working', false);
			return false;
		});
		
		$('#project_photo').uploadify({
			'queueSizeLimit' : 3,
			'formData'     : {
				'timestamp' : $ts,
				'token'     : $t
			},
			'fileTypeDesc' : 'Image Files',
        	'fileTypeExts' : '*.jpg; *.png',
		    'removeCompleted' : false,
			'height' : 30,
			'swf'      : base_url + '/js/uploadify/uploadify.swf',
			'uploader' : '/ajax/uploadify',
			/*'onQueueComplete' : function(queueData) {
				console.log(queueData);
            	alert('files were successfully uploaded.');
      		}*/
		});
		
	});
});