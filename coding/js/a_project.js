$("#period_slider").slider({
    orientation: "horizontal",
    range: "min",
    min: 7,
    value: $("#period_hidden").val(),
    max: 30,
    slide: function (event, ui) {
        $("#period").val(ui.value);
         $("#period_hidden").val(ui.value);
    }
});
$("#period").val($("#period_slider").slider("value"));
$("#period_hidden").val($("#period_slider").slider("value"));

$('#photo_container').delegate('#delete_photo', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var c = confirm("Are you sure to delete this photo?");
	if (c == true){
		var pid = el.attr('data-pid');
		var h = el.attr('data-h');
		$.post('/admin/ajax/delete_photo_project', {
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

$('#actions_container').delegate('#btn-action-edit-tw', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	var div = el.closest('div');
	
	var project_id = div.find('#project_id').val();
	var type = div.find('#type').val();
	var tw_tweet = div.find('#tw-tweet').val();
	
	$.post('/admin/ajax/save_actions_tweet', {
		project_id : project_id,
		type : type,
		tw_tweet : tw_tweet
	}, function(data){
		if (data.msg == 0){
			alert('Something Error!');
		}else{
			alert('Success Save');
		}
		el.data('working', false);
	}, 'json');
	
	return false;
});

$('#actions_container').delegate('#btn-action-edit-fb', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	var div = el.closest('div');
	
	var project_id = div.find('#project_id').val();
	var type = div.find('#type').val();
	var fb_link_name = div.find('#fb-link-name').val();
	var fb_link_linka = div.find('#fb-link-linka').val();
	var fb_link_description = div.find('#fb-link-description').val();
	
	$.post('/admin/ajax/save_actions_fb', {
		project_id : project_id,
		type : type,
		fb_link_name : fb_link_name,
		fb_link_linka : fb_link_linka,
		fb_link_description : fb_link_description
	}, function(data){
		if (data.msg == 0){
			alert('Something Error!');
		}else{
			alert('Success Save');
		}
		el.data('working', false);
	}, 'json');
	
	return false;
});

$('#premium_plan').bind('click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	if (el.is(':checked')){
		$('#premium_plan_container').show();
	}else{
		$('#premium_plan_container').hide();
	}
	
	el.data('working', false);
});