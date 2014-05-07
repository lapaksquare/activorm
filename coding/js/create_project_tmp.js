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
			'swf'      : base_url + 'js/uploadify/uploadify.swf',
			'uploader' : '/ajax/uploadify',
			/*'onQueueComplete' : function(queueData) {
				console.log(queueData);
            	alert('files were successfully uploaded.');
      		}*/
      		
      		'onUploadSuccess' : function(file, data, response) {
      			
      			if (response == true || response == "true"){
      				
      				//alert(data);
      				//console.log(data);
      				$('#' + file.id).attr('data-j', data);
      				var obj = JSON.parse(data);
      				//var obj = $.parseJSON(JSON.stringify(data)); //JSON.parse(data);
      				//console.log(data);
      				//var obj = json_decode(data);
      				//console.log(obj);
      				
      				$('#' + file.id).find('img').attr('src', base_url + obj.photo_resize);
      				
      			}
      			
      			//console.log(file);
      			//console.log(data);
      			//console.log(response);
      		},
      		
      		/*
      		'onCancel' : function(event,ID,fileObj,data) {
		    	console.log(event); // get the event
		    	console.log(ID); // // I dont get the ID
		        console.log (fileObj.name); // // I dont get the filename
		    },*/
      		
		});
		
		$('#project_photo-queue').delegate('.cancel a', 'click', function(){
			var el = $(this);
			var c = el.closest('.uploadify-queue-item');
			var id = c.attr('id');
			var d = c.attr('data-j');
			
			$.post('/ajax/uploadify_delete', {
				d : d
			}, function(data){
				if (data.response == 1){
					c.fadeOut(function(){
						$(this).remove();
					});
				}else{
					alert('Something error while delete photo.');
				}
			}, 'json');
			
			//alert(id);
			return false;
		});