$('#shareme').sharrre({
  share: {
    googlePlus: true,
    facebook: true,
    twitter: true
  },
  buttons: {
    googlePlus: {size: 'tall', annotation:'bubble'},
    facebook: {layout: 'box_count'},
    twitter: {count: 'vertical', via: 'Activorm'}
  },
  enableHover: false,
  enableCounter: false,
  enableTracking: true
});

$('#submit_project').bind('click', function(){
	$('#modal-project').modal('show');
	return false;
});

$('.comment_limiter').simplyCountable({
	counter: '.counter span',
	maxCount: 300,
	strictMax: true
});

$('.reply_comment_limiter').simplyCountable({
	counter: '.reply_counter span',
	maxCount: 300,
	strictMax: true
});

$('#entry-comments').delegate('#post-comment', 'click', function(){
	var el = $(this);
	var form = el.closest('form');
	var textarea = form.find('textarea').val();
	var pid = form.attr('data-pid');
	var pidhash = form.attr('data-pidhash');
	if (el.data('working')) return false;
	el.data('working', true);
	if (textarea.length <= 0 || textarea.length > 300){
		el.data('working', false);
		form.find("#comment-danger").fadeIn();
		setTimeout(function(){
			form.find("#comment-danger").fadeOut();
		}, 5000);
	}else{
		$.post('/ajax/post_comment', {
			comment : textarea,
			pid : pid,
			pidhash : pidhash
		}, function(data){
			el.data('working', false);
			if (data.status == 0){
				form.find("#comment-danger").fadeIn();
			}else{
				//form.find("#comment-success").fadeIn();
				$('#list-comments').prepend(data.html);
				form.find('textarea').val('');
			}
				/*
				setTimeout(function(){
					form.find(".alert").fadeOut();
				}, 1000);*/
		}, 'json');
	}
	el.data('working', false);
	return false;
});

$('#entry-comments').delegate('#post-reply-comment', 'click', function(){
	var el = $(this);
	var form = el.closest('form');
	var textarea = form.find('textarea').val();
	var pid = form.attr('data-pid');
	var pidhash = form.attr('data-pidhash');
	var cid = form.attr('data-cid');
	var cidhash = form.attr('data-cidhash');
	if (el.data('working')) return false;
	el.data('working', true);
	if (textarea.length <= 0 || textarea.length > 300){
		el.data('working', false);
		form.find("#comment-danger").fadeIn();
		setTimeout(function(){
			form.find("#comment-danger").fadeOut();
		}, 5000);
	}else{
		$.post('/ajax/post_reply_comment', {
			comment : textarea,
			pid : pid,
			pidhash : pidhash,
			cid : cid,
			cidhash : cidhash
		}, function(data){
			el.data('working', false);
			if (data.status == 0){
				form.find("#comment-danger").fadeIn();
			}else{
				//form.find("#comment-success").fadeIn();
				//$('#list-comments').prepend(data.html);
				
				var li = el.closest('li');
				li.find('#reply_child').append(data.html);
				
				form.find('textarea').val('');
			}
				/*
				setTimeout(function(){
					form.find(".alert").fadeOut();
				}, 1000);*/
		}, 'json');
	}
	el.data('working', false);
	return false;
});

$('#entry-comments').delegate('#btn-reply', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	el.next().slideDown();
	
	el.data('working', false);
	return false;
});

$('#entry-comments').delegate('#close-reply-btn', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	var form = el.closest('form');
	form.slideUp();
	
	el.data('working', false);
	return false;
});

$('#ttx-widget').focus();
$('#project_tab a').click(function (e) {
  $('#ttx-widget').focus();
  e.preventDefault();
  $(this).tab('show');  
});

$('#slider').nivoSlider();


if (freeplan <= 0){
$('#modal-project-topup-confirmation').modal('show');
}

$('#redeem_prize_btn').click(function (e) {
  $('#modal-project-redeem-confirmation').modal('show');
  return false;
});

$('#modal-project-redeem-confirmation').delegate('#cancel-btn', 'click', function(){
	$('#modal-project-redeem-confirmation').modal('hide');
	return false;
});

$('#load-more').delegate('a', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	el.text('Loading...');
	
	var tc = el.attr('data-tc');
	var cid = $('#list-comments').find('li#comment').last().attr('data-cid');
	var pid = el.attr('data-pid');
	$.post('/ajax/getProjectComment', {
		cid : cid,
		pid : pid
	}, function(data){
		
		$('#list-comments').append(data);
		
		el.data('working', false);		
		var curr_len = $('#list-comments').find('li#comment').length;
		if (tc == curr_len){
			el.remove();
		}
		
		el.text('Load More');
		
	}, 'html');

	return false;
});


$('#btn-view-photo-instagram').click(function(){
	var el = $(this);
	$('#modal-instagram-photo').modal('show');
	return false;
});
