jQuery(document).ready(function($){
	action_select.init();
	checkupgrade.init();
});

function defined(type, count){
	//* Define Label & Icon for Update Step
	var label = [],
		icon = [],
		coookie_checked = cookieChecked();
	
	$.each(coookie_checked, function(i,v){
		label.push($(".custom-checkstep").eq(v).attr("data-label"));
		icon.push($(".custom-checkstep").eq(v).attr("data-icon"));
	});	
	
	if(count > 3) {
		var err_label = [],
			err_icon = [];
		$(".prettycheckbox.error").each(function(index){
			err_label.push($(this).find("label").html());
			err_icon.push($(this).find("input").attr("data-icon"));
		});
		
		label = $.grep( label, function( n, i ) {
			return $.inArray(n, err_label) ==-1;
		});
		
		icon = $.grep( icon, function( n, i ) {
			return $.inArray(n, err_icon) ==-1;
		});
	}	
	
	$(".prettycheckbox").each(function(){
		if(count == 4){
			if(!$(this).hasClass("active") && !$(this).hasClass("error") && !$(this).find(".mask").is("div"))
			$(this).append('<div class="mask"></div>');
		}
		else{
			if(!$(this).hasClass("active") && !$(this).hasClass("error"))
			$(this).find(".mask").remove();
		}
	});
	
	switch(type)
	{
		case 'label':
			return label;
		break;
		
		case 'icon':
			return icon;
		break;
	}
}

function update_step(length, count){
				
	//* Clear All Class Icon
	var data_icon= "";
	$(".prettycheckbox").each(function(){
		ico = $(this).find("input").attr("data-icon");
		
		if(ico != undefined)
		data_icon += ico+" ";
	});
	$(".action-steps").find("li").removeClass(data_icon);
	
	//* Update Step
	$(".action-steps").find("li").each(function(index){
		$(this).find(".step-desc").html("Unknown");
				
		$(this).addClass(icon[index]);
		$(this).find(".step-desc").html(label[index]);
		
		if($(this).hasClass(icon[index])){
			$(this).removeClass("action-ready").addClass("action-okay");	
			$(this).find(".step-ico").append('<a href="#" class="close" aria-hidden="true">&times;</a>');
		}
		
		if($(this).find(".step-desc").html() == "Unknown"){
			$(".action-steps li").eq(length).removeClass("action-okay").find(".step-ico a").remove();
			
			$(".action-steps li").eq((length)+1).removeClass("action-ready");
		}
	});
	
	$(".action-steps li").eq(count).addClass("action-ready");
	
	$(".action-steps > ul").removeClass("pick-0 pick-1 pick-2");
	if(count < 3){
		$(".action-steps > ul").addClass("pick-"+count);
	}
	else{
		$(".action-steps > ul").addClass("pick-2");	
	}
}

action_select = {
	init: function(){
		
		var cookie_checked = $.cookie('cookie_checked');
		
		if(cookie_checked){
			$.each(cookieChecked(), function(i,v){
				$(".custom-checkstep").eq(v).prop('checked', true);
				$(".custom-checkstep").eq(v).parents(".prettycheckbox").addClass("active").find("a").addClass("checked");
			});
		}
		
		var count = $(".custom-checkstep:checked").length;
		
		if(count == 0){
			removeAllCookie();	
		}
		
		$(".action-select").find("li .custom-checkstep").each( function(index){
			var name = $(this).attr("name");
				
			// Optional
			// Change input name to name="input_name[]"
			$(this).attr("name", name+"[]");
		});
		
		if(count > 0){
			label 	= defined('label', count);
			icon 	= defined('icon', count);
			
			update_step(label.length, count);
		}
		
		$("body").delegate("a.close", "click", function(e){
			e.preventDefault();
			
			var step_desc = $(this).parents(".action-okay").find(".step-desc").html();
			
			$(".action-select").find("li .custom-checkstep").each( function(){
				if(step_desc == $(this).attr("data-label")){
					$(this).click();
					$(this).parents(".prettycheckbox").find("a").removeClass("checked");
				}
			});
		});
		
		$("body").delegate(".prettycheckbox.error", "click", function(e){
			if(!$(this).hasClass("state")){
				$(this).addClass("state");
			}
			else{
				$(this).removeClass('error disabled state');
				$(this).find(".custom-checkstep:checked").prop('disabled', false);
				$(this).find(".custom-checkstep:checked").prop('checked', false);
				$(this).find(".exclamation").remove();
				$(this).parent().find(".action-error").remove();
				$(this).find("a").removeClass("checked");
				
				$(".prettycheckbox").find(".mask").remove();
			}
		});
		
		$("body").delegate(".custom-checkstep", "change", function(e){
			var count = $(".custom-checkstep:checked").length,
				label_check = $(this).attr("data-label"),
				i_click = $(".custom-checkstep").index(this),
				checked = $(this).is(":checked"),
				cookie_checked = [];
			
			if($.cookie('cookie_checked')){
				cookie_checked = cookieChecked();	
			}
			
			if(checked)
			{				
				$(this).parent().removeClass("active error").addClass("active");
				
				if($.isArray(cookie_checked) && count <= 3){
					cookie_checked.push(i_click);
				}
				
				if(count > 3){
					
					$(this).parent().addClass('disabled');
      				$(this).prop('disabled', true);
					
					if(!$(this).parents(".form-group").find(".action-error").is("span")){
						$(this).parents(".form-group").append('<span class="action-error">You may only select 3 actions</span>');
					}
					
					$(this).parent().removeClass("active error").addClass("error");
			
					if(!$(this).parent().find(".exclamation").is("i"))
					$(this).parent().append('<i class="exclamation icon-attention"></i>');
				}

			}
			else
			{
				$(this).parents(".form-group").find("span.action-error").remove();
				$(this).parent().removeClass("active error");
				
				if(!$(this).parent().hasClass("error")){
					$(".custom-checkstep:checked").parent().find(".exclamation").remove();
				}
				
				// Remove Cookie index
				var cookie_index = $.inArray(i_click, cookie_checked);
				cookie_checked.splice(cookie_index, 1);
				
				var err = $(".prettycheckbox.error").find(".custom-checkstep:checked"),
					err_index = $(".custom-checkstep").index(err);
					
				if(err_index > 0){
					cookie_checked.push(err_index);	
				}
				
				if(count <= 3){
					
					$(".custom-checkstep:checked").parents(".form-group").find("span.action-error").remove();
					$(".custom-checkstep:checked").parent().removeClass("error disabled").addClass("active");
					
					$(".custom-checkstep:checked").prop('disabled', false);
				}
			}
			
			setCookie('cookie_checked', cookie_checked);
			
			// Update Step
			label 	= defined('label', count);
			icon 	= defined('icon', count);
			
			update_step(label.length, count);
				
			if(count == 0){
				removeAllCookie();
			}
		});
	}
}

checkupgrade = {
	init: function(){
		$(".custom-checkupgrade").on("change", function(){
			if($(this).is(":checked")){
				$(".upgrade-options").slideDown();	
			}
			else
			{
				$(".upgrade-options").slideUp();
				$(".upgrade-options").find("li .custom-checkwhite").removeAttr("checked");
				$(".upgrade-options").find("li a").removeClass("checked");
				$(".upgrade-options").find("li .sub-options").hide();
			}
		});
		
		$(".custom-checkupgrade").ready(function(){
			if($(".custom-checkupgrade").is(":checked")){
				$(".upgrade-options").slideDown();	
			}
			else
			{
				$(".upgrade-options").slideUp();
			}
		});
		
		$(".upgrade-options").find("li .custom-checkwhite").each(function(){
			if($(this).is(":checked")){
				$(this).parents("li").find(".sub-options").slideDown();	
			}
			else
			{
				$(this).parents("li").find(".sub-options").slideUp();
			}
		});
		
		$(".custom-checkwhite").on("change", function(){
			if($(this).is(":checked")){
				$(this).parents("li").find(".sub-options").slideDown();	
			}
			else
			{
				$(this).parents("li").find(".sub-options").slideUp();
			}
		});
	}
}