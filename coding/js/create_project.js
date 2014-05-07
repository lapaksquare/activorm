function json_decode(str_json) {
  //       discuss at: http://phpjs.org/functions/json_decode/
  //      original by: Public Domain (http://www.json.org/json2.js)
  // reimplemented by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: T.J. Leahy
  //      improved by: Michael White
  //        example 1: json_decode('[ 1 ]');
  //        returns 1: [1]

  /*
    http://www.JSON.org/json2.js
    2008-11-19
    Public Domain.
    NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.
    See http://www.JSON.org/js.html
  */

  var json = this.window.JSON;
  if (typeof json === 'object' && typeof json.parse === 'function') {
    try {
      return json.parse(str_json);
    } catch (err) {
      if (!(err instanceof SyntaxError)) {
        throw new Error('Unexpected error type in json_decode()');
      }
      this.php_js = this.php_js || {};
      this.php_js.last_error_json = 4; // usable by json_last_error()
      return null;
    }
  }

  var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
  var j;
  var text = str_json;

  // Parsing happens in four stages. In the first stage, we replace certain
  // Unicode characters with escape sequences. JavaScript handles many characters
  // incorrectly, either silently deleting them, or treating them as line endings.
  cx.lastIndex = 0;
  if (cx.test(text)) {
    text = text.replace(cx, function(a) {
      return '\\u' + ('0000' + a.charCodeAt(0)
        .toString(16))
        .slice(-4);
    });
  }

  // In the second stage, we run the text against regular expressions that look
  // for non-JSON patterns. We are especially concerned with '()' and 'new'
  // because they can cause invocation, and '=' because it can cause mutation.
  // But just to be safe, we want to reject all unexpected forms.
  // We split the second stage into 4 regexp operations in order to work around
  // crippling inefficiencies in IE's and Safari's regexp engines. First we
  // replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
  // replace all simple value tokens with ']' characters. Third, we delete all
  // open brackets that follow a colon or comma or that begin the text. Finally,
  // we look to see that the remaining characters are only whitespace or ']' or
  // ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.
  if ((/^[\],:{}\s]*$/)
    .test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
      .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
      .replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

    // In the third stage we use the eval function to compile the text into a
    // JavaScript structure. The '{' operator is subject to a syntactic ambiguity
    // in JavaScript: it can begin a block or an object literal. We wrap the text
    // in parens to eliminate the ambiguity.
    j = eval('(' + text + ')');

    return j;
  }

  this.php_js = this.php_js || {};
  this.php_js.last_error_json = 4; // usable by json_last_error()
  return null;
}

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
		

		
		$('#project_photo').bind('change', function(){
			var timestamp = $('#ts').val();
			var token = $('#t').val();
			
			var A = $("#imageloadstatus");
			var B = $("#imageloadbutton");
			
			$("#createprojectform").ajaxForm({
				target: '#queue',
				url: '/ajax/upload_ajax_image?timestamp=' + timestamp + '&token=' + token,
				type: 'post',
				
				beforeSubmit:function(){
					A.show();
					B.hide();
				}, 
				success:function(){
					A.hide();
					B.show();
				}, 
				error:function(){
					A.hide();
					B.show();
				}
				
			}).submit();
		});
		
		$('.project_photo-queue').delegate('a#delete_photo', 'click', function(){
			var el = $(this);
			var pid = el.attr('data-pid');
			var pidh = el.attr('data-h');
			var c = el.closest('.project-thumbnail');
			
			var confirm_alert = confirm("Are you sure to delete this photo?");
			
			if (confirm_alert == true){
			
				$.post('/ajax/delete_ajax_image', {
					pid : pid,
					pidh : pidh
				}, function(data){
					if (data.response == 1){
						c.fadeOut(function(){
							$(this).remove();
						});
					}else{
						alert('Something error while delete photo.');
					}
				}, 'json');
			
			}
			
			//alert(id);
			return false;
		});
		
	});
});