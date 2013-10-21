jQuery(document).ready(function($){
	live_edit.init();
});

live_edit = {
	init: function(){
		$("body").delegate(".icon-pencil", "click", function(e){
			e.preventDefault();
			var data_edit = $(this).attr("data-edit"),
				parent = $(this).parents(".account-"+data_edit),
				master = parent.html();
			
			if(!parent.find(".edit-area").is("span")){
				parent.append('<span class="edit-area" data-edit="'+data_edit+'"><input type="text" value="'+parent.find('span').text()+'" class="form-control form-light" name="'+data_edit+'" id="input-'+data_edit+'" placeholder="Input your '+data_edit+'"><button class="btn-save-live">save</button><a href="#" class="close" aria-hidden="true">&times;</a></span>');
				
				$(this).parent().find(".edit_area input[type=text]").focus();
			}
		});
		
		$("body").delegate(".btn-save-live", "click", function(e){
			e.preventDefault();
			
			var code = e.which,
				parent = $(this).parent(),
				data_edit = parent.attr("data-edit"),
				post = parent.find("input[type=text]").val();
			
			if(!post)
			return false;
			
			/*
			 * If you want to save to Database, uncomment this script ajax
			 * Description :
			 * `id` is variable id user in database, you can get this id from session after login
			 */
			
			/*
			$.post("connection.php", 
			{
				is_ajax:true,
				post:post,
				data_edit:data_edit,
				id:id_user
			},
			function(){
				parent.remove();
				
				$(".account-"+data_edit).find("span").html(post);
			});
			*/
			
			/*
			 * Remove this if you will be using ajax post
			 */
			parent.remove();
			$(".account-"+data_edit).find("span").html(post);
			$(".navbar-user a span").html(post);
				
		});
		
		$("body").delegate(".edit-area .close", "click", function(){
			$(this).parent().remove();
		});
	}
}