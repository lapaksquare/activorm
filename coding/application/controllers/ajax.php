<?php 

class Ajax extends MY_Controller {
	
	function getKabupatenByProvinceId(){
		$province_id = $this->input->get_post('province_id');
		$noparent = $this->input->get_post('noparent');
		$this->load->model('address_model');
		$kabupaten = $this->address_model->getKabupatenByProvinceId($province_id);
		$kabupaten_html = "";
		if (empty($noparent)){
			$kabupaten_html .= '<select name="account_kabupaten" id="account_kabupaten" class="custom-select light-select select-city">';
		}
		$kabupaten_html .= '<option value="0">Select Kabupaten</option>';
		foreach($kabupaten as $k=>$v){
			$kabupaten_html .= '<option value="'.$v->city_id.'">'.$v->city_name.'</option>';
		}
		if (empty($noparent)){
			$kabupaten_html .= '</select>';
		}
		echo $kabupaten_html;
	}
	
	function getKecamatanByKabupatenId(){
		$kabupaten_id = $this->input->get_post('kabupaten_id');
		$noparent = $this->input->get_post('noparent');
		$this->load->model('address_model');
		$kecamatan = $this->address_model->getKecamatanByKabupatenId($kabupaten_id);
		$kecamatan_html = "";
		if (empty($noparent)){
			$kecamatan_html .= '<select name="account_kecamatan" id="account_kecamatan" class="custom-select light-select select-city">';
		}
		$kecamatan_html .= '<option value="0">Select Kecamatan</option>';
		foreach($kecamatan as $k=>$v){
			$kecamatan_html .= '<option value="'.$v->kecamatan_id.'">'.$v->kecamatan_name.'</option>';
		}
		if (empty($noparent)){
			$kecamatan_html .= '</select>';
		}
		echo $kecamatan_html;
	}
	
	function getKelurahanByKecamatanId(){
		$kecamatan_id = $this->input->get_post('kecamatan_id');
		$noparent = $this->input->get_post('noparent');
		$this->load->model('address_model');
		$kelurahan = $this->address_model->getKelurahanByKecamatanId($kecamatan_id);
		$kelurahan_html = "";
		if (empty($noparent)){
			$kelurahan_html .= '<select name="account_kelurahan" id="account_kelurahan" class="custom-select light-select select-city">';
		}
		$kelurahan_html .= '<option value="0">Select Kelurahan</option>';
		foreach($kelurahan as $k=>$v){
			$kelurahan_html .= '<option value="'.$v->kelurahan_id.'">'.$v->kelurahan_name.'</option>';
		}
		if (empty($noparent)){
			$kelurahan_html .= '</select>';
		}
		echo $kelurahan_html;
	}
	
	function checkPointTopUp(){
		$this->load->model('point_model');
		$pid = $this->input->get_post('pid');
		$pid_hash = $this->input->get_post('pid_hash');
		$pid_hash_ori = sha1($pid . SALT);
		$qty = $this->input->get_post('qty');
		$total_amount = 0;
		$data = array();
		if ($pid_hash != $pid_hash_ori){
			$data = array(
				'isok' => 0,
				'price' => 0,
				'total_amount' => $total_amount,
				'total_amount_string' => 'IDR ' . number_format($total_amount, 2, ",", ".")
			);
		}else{
			$point = $this->point_model->getPointByPointId($pid);
			$price = $qty * $point->point_price;
			$total_amount = $price;
			$data = array(
				'isok' => 1,
				'price' => $price,
				'total_amount' => $total_amount,
				'total_amount_string' => 'IDR ' . number_format($total_amount, 2, ",", ".")
			);
		}
		
		$service_charge = 5/100 * $total_amount;
		$gov_charge = 10/100 * $total_amount;
		$total_payment = $total_amount + $service_charge + $gov_charge;
		
		$data['service_charge'] = $service_charge;
		$data['service_charge_string'] = 'IDR ' . number_format($service_charge, 2, ",", ".");
		$data['gov_charge'] = $gov_charge;
		$data['gov_charge_string'] = 'IDR ' . number_format($gov_charge, 2, ",", ".");
		$data['total_payment'] = $total_payment;
		$data['total_payment_string'] = 'IDR ' . number_format($total_payment, 2, ",", ".");
		
		echo json_encode($data);
	}

	function checkPointTopUpManual(){
		$this->load->model('point_model');
		$pid = $this->input->get_post('pid');
		$qty = $this->input->get_post('qty');
		$total_amount = 0;
		$data = array();

		$point = $this->point_model->getPointByPointId($pid);
		$price = $qty * $point->point_price;
		$total_amount = $price;
		$data = array(
			'isok' => 1,
			'price' => $price,
			'total_amount' => $total_amount,
			'total_amount_string' => 'IDR ' . number_format($total_amount, 2, ",", ".")
		);
		
		$service_charge = 5/100 * $total_amount;
		$gov_charge = 10/100 * $total_amount;
		$total_payment = $total_amount + $service_charge + $gov_charge;
		
		$data['service_charge'] = $service_charge;
		$data['service_charge_string'] = 'IDR ' . number_format($service_charge, 2, ",", ".");
		$data['gov_charge'] = $gov_charge;
		$data['gov_charge_string'] = 'IDR ' . number_format($gov_charge, 2, ",", ".");
		$data['total_payment'] = $total_payment;
		$data['total_payment_string'] = 'IDR ' . number_format($total_payment, 2, ",", ".");
		
		echo json_encode($data);
	}



	// invitation_submit only
	function invitation_submit(){
		$email_address = $this->input->get_post('email_address');
		$confirm = $this->input->get_post('confirm');
		if (!empty($confirm)){
			$this->load->model('invitation_model');
			$this->load->model('account_model');
			$invitation = $this->invitation_model->getInvitation($email_address);
			$members = $this->account_model->getAccount('ma.account_email', $email_address, 0);
			if (!empty($invitation) || !empty($members)){
				$this->session->set_userdata('invitation_only', 1);
			}else{
				$this->session->set_userdata('message_invitation_error', 1);
			}
		}
		redirect(base_url());
	}

	function invitation(){
		$email_address = $this->input->get_post('ei');
		$email_address_hash = $this->input->get_post('ei_hash');
		$email_address_hash_ori = sha1(SALT . $email_address);
		if ($email_address_hash_ori == $email_address_hash){
			$this->load->model('invitation_model');
			$invitation = $this->invitation_model->getInvitation($email_address);
			if (!empty($invitation) && !empty($invitation->account_email)){
				$this->session->set_userdata('invitation_only', 1);
			}else{
				$this->session->set_userdata('message_invitation_error', 1);
			}
		}
		redirect(base_url());
	}

	function captcha(){
		$ranStr = md5(microtime());
		$ranStr = substr($ranStr, 0, 6);
		$this->session->set_userdata('c_cap_code', $ranStr);
		$newImage = imagecreatefromjpeg(cdn_url() . "img/cap_bg.jpg");
		$txtColor = imagecolorallocate($newImage, 0, 0, 0);
		imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
		header("Content-type: image/jpeg");
		imagejpeg($newImage);
	}
	
	function prize_layout(){
		$l = $this->input->get_post('l');
		$lh = $this->input->get_post('lh');
		$lh_ori = sha1($l . SALT);
		if ($lh == $lh_ori){
			$this->session->set_userdata('view_type_session', $l);
		}
		$ref = $_SERVER['HTTP_REFERER'];
		redirect($ref);
	}
	
	function signup_invitation(){
		$email = $this->input->get_post('email');
		$email_hash = $this->input->get_post('hash');
		$email_hash_ori = sha1(SALT . $email);
		$hj = $this->input->get_post('hj');
		if ($email_hash == $email_hash_ori || !empty($hj)){
			$this->session->set_userdata('invitation_only', 1);
			$this->session->set_userdata('hack_register_show', 1);
		}
		redirect(base_url());
	}
	
	function post_comment(){
		$comment = $this->input->get_post('comment');
		$pid = $this->input->get_post('pid');
		$pidhash = $this->input->get_post('pidhash');
		$ori_pidhash = sha1($pid . SALT);
		$account_id = $this->access->member_account->account_id; //$this->session->userdata('account_id');
		$data = array();
		if (strlen($comment) <= 0 || strlen($comment) > 300 || ($pidhash != $ori_pidhash)){
			$data = array(
				'status' => 0
			);
		}else{
			$this->load->model('comment_model');
			$dataComment = array(
				'project_id' => $pid,
				'account_id' => $account_id,
				'comment_text' => $comment,
				'postdate' => date('Y-m-d H:i:s')
			);
			$cid = $this->comment_model->addComment($dataComment);
			
			$this->load->model('account_model');
			$user = $this->account_model->getAccount("ma.account_id", $account_id);
			
			$photo = (empty($user->account_primary_photo)) ? 'img/user-default.gif' : $user->account_primary_photo;
			$photo = $this->mediamanager->getPhotoUrl($photo, "100x100");
			
			$data = array(
				'status' => 1,
				'html' => '<li class="clearfix comment">
								<div class="comment-avatar">
									<img class="img-responsive" src="'.cdn_url().$photo.'" alt="'.$user->account_name.'" />
								</div>

								<div class="comment-body">
									<div class="comment-meta">
										<strong class="comment-author">'.$user->account_name.'</strong>
										<span class="comment-date">'.date('d M Y H:i').'</span>
									</div>

									<div class="comment-content">
										<p>'.$comment.'</p>
									</div>

									<div class="comment-reply">
										<a href="#" id="btn-reply"><i class="icon-reply"></i> Reply Comment</a>
										
										<form class="form-activorm form-comment" action="#" method="post" id="reply_form" 
											data-pid="'.$pid.'" 
											data-pidhash="'.sha1($pid . SALT).'" 
											data-cid="'.$cid.'"
											data-cidhash="'.sha1($cid . SALT).'"
											style="margin-top:8px;display:none;">
								
												<div class="alert alert-success" id="comment-success" style="display:none;">
													<p>Reply Comment berhasil diposting</p>
												</div>	
												
												<div class="alert alert-danger" id="comment-danger" style="display:none;">
													<p>Reply Comment gagal diposting</p>
												</div>	
												
												<div class="form-group">
													<textarea name="comment" id="comment" class="form-control form-light reply_comment_limiter" placeholder="Write your reply here.." rows="4"></textarea>
												</div>
												<div class="clearfix form-submit">
													<button type="button" id="post-reply-comment" class="pull-right btn btn-green">Reply Comment</button>
													<p class="pull-right help-block reply_counter"><span>300</span> characters . <a href="#" id="close-reply-btn">Close</a></p>
												</div>
										</form>
										
									</div>
									
									
									
								</div>
								
								
								<ul class="children" id="reply_child"></ul>
							<!-- .comment --></li>'			
			);
			
		}
		echo json_encode($data);
	}

	function post_reply_comment(){
		$comment = $this->input->get_post('comment');
		
		$pid = $this->input->get_post('pid');
		$pidhash = $this->input->get_post('pidhash');
		$ori_pidhash = sha1($pid . SALT);
		
		$cid = $this->input->get_post('cid');
		$cidhash = $this->input->get_post('cidhash');
		$ori_cidhash = sha1($cid . SALT);
		
		$account_id = $this->access->member_account->account_id; //$this->session->userdata('account_id');
		$data = array();
		if (strlen($comment) <= 0 || strlen($comment) > 300 
		|| ($pidhash != $ori_pidhash) || ($cidhash != $ori_cidhash)
		){
			$data = array(
				'status' => 0
			);
		}else{
			$this->load->model('comment_model');
			$dataComment = array(
				'project_id' => $pid,
				'account_id' => $account_id,
				'parent_comment' => $cid,
				'comment_text' => $comment,
				'postdate' => date('Y-m-d H:i:s')
			);
			$this->comment_model->addComment($dataComment);
			
			$this->load->model('account_model');
			$user = $this->account_model->getAccount("ma.account_id", $account_id);
			
			$photo = (empty($user->account_primary_photo)) ? 'img/user-default.gif' : $user->account_primary_photo;
			$photo = $this->mediamanager->getPhotoUrl($photo, "100x100");
			
			$data = array(
				'status' => 1,
				'html' => '<li class="clearfix comment">
								<div class="comment-avatar">
									<img class="img-responsive" src="'.cdn_url().$photo.'" alt="'.$user->account_name.'" />
								</div>
	
								<div class="comment-body">
									<div class="comment-meta">
										<strong class="comment-author">'.$user->account_name.'</strong>
										<span class="comment-date">'.date('d M Y H:i').'</span>
									</div>
	
									<div class="comment-content">
										<p>'.$comment.'</p>
									</div>
								</div>
							<!-- .comment --></li>'			
			);
			
		}
		echo json_encode($data);
	}
	
	function getDashboardProjectData(){
		$account_id = $this->session->userdata('account_id');
		$business_id = $this->session->userdata('business_id');
		$project_id = $this->input->get_post('pid');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id.SALT);
		if ($hash != $hash_ori) echo '';
		else{
			$this->load->model('dashboard_model');
			$this->result = $this->dashboard_model->getBusinessProjectByProjectId($project_id);
			
			$this->load->model('google_analytic_model');
			$this->project_analytic = $this->google_analytic_model->getAnalticsPageProject($project_id);
						
			$this->load->view('a/dashboard/ajax_dashboard_allproject_modal_view');
		}
	}

	function unsetPopupLogin(){
		$this->session->set_userdata('nopopuplogin', 1);
	}
	
	function submit_search_suggest(){
		$suggest_name = $this->input->get_post('suggest_name');
		$this->load->model('search_model');
		$this->search_model->registerSuggest(trim($suggest_name));
		echo json_encode(array(
			'error' => 0,
			'message' => 'Thanks for the submit! <a class="btn btn-green" href="'.base_url().'">Back to Homepage</a>'
		));
	}
	
	function delete_photo_project(){
		$pid = $this->input->get_post('pid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($pid . SALT);
		$msg = 0;
		if ($h == $h_ori){
			$this->load->model('project_model');
			$this->project_model->deletePhotoProjectByPhotoId($pid);
			$msg = 1;
		}
		echo json_encode(array(
			'msg' => $msg
		));
	}
	
	
	function getProjectComment(){
		$comment_id = $this->input->get_post('cid');
		$project_id = $this->input->get_post('pid');
		$this->load->model('comment_model');
		$this->data['project_id'] = $project_id;
		$this->data['comments'] = $this->comment_model->getComment($project_id, $comment_id);
		$this->load->view('a/project/ajax_comment_view', $this->data);
	}
	
	function uploadify(){
		$targetFolderTemp = 'images/project/'; // Relative to the root
		$targetFolder = '/images/project'; // Relative to the root
		$timestamp = $this->input->get_post('timestamp');
		$token = $this->input->get_post('token');
		$verifyToken = sha1($timestamp . SALT);
		$business_id = $this->session->userdata('business_id');
		
		if (!empty($_FILES) && $token == $verifyToken && !empty($business_id)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$imgName =  sha1($_FILES['Filedata']['name'] . SALT) . '.jpg';
			$targetFile = rtrim($targetPath,'/') . '/' . $imgName;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png', 'JPG', 'PNG', 'GIF', 'JPEG'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array(strtolower( $fileParts['extension'] ),$fileTypes)) {
				
				$photo = $targetFolderTemp . $imgName;
				$this->load->model('photo_model');
				$data = array(
					'business_id' => $business_id,
					'token' => $verifyToken,
					'photo' => $photo
				);
				$photo_id = $this->photo_model->addPhotoTemp($data);
				
				move_uploaded_file($tempFile,$targetFile);
				
				$photo_resize = $this->mediamanager->getPhotoUrl($photo, "200x200");
				$data['photo_id'] = $photo_id;
				$data['photo_resize'] = $photo_resize;
				echo json_encode($data);
				
				//echo "{'business_id':'$business_id','token':'$verifyToken','photo':'$photo','photo_id':'$photo_id'}";
				
				//echo '1';
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	function uploadify_delete(){
		$response = 0;
		$d = $this->input->get_post('d');
		if (!empty($d)){
			$this->load->model('photo_model');
			$d = json_decode($d);
			if (property_exists($d, "photo_id") || property_exists($d, "business_id") || property_exists($d, "token")){
				$p = $this->photo_model->getPhotoTempByPhotoId($d->photo_id, $d->business_id, $d->token);	
				$response = 1;
			}
		}
		echo json_encode(array(
			'response' => $response
		));
	}
	
	function delete_ajax_image(){
		$this->load->model('photo_model');
		$photo_id = $this->input->get_post('pid');
		$photo_id_hash = $this->input->get_post('pidh');
		$photo_id_hash_ori = sha1($photo_id . SALT);
		if ($photo_id_hash != $photo_id_hash_ori){
			echo json_encode(array(
				'response' => 0
			));
		}else{
			
			$this->photo_model->deleteAjaxPhotoByPhotoId($photo_id);
			
			echo json_encode(array(
				'response' => 1
			));
			
		}
	}
	
	function getExtension($str){
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	function upload_ajax_image(){
		$timestamp = $this->input->get_post('timestamp');
		$token = $this->input->get_post('token');
		$verifyToken = sha1($timestamp . SALT);
		$business_id = $this->session->userdata('business_id');
		$uploaddir = 'images/project/';
		$valid_formats = array("jpg", "png", "jpeg");
		
		$this->load->model('photo_model');
		$cek_jml_image = $this->photo_model->getCountPhotoByToken($verifyToken);
		if ($cek_jml_image >= 3 || count($_FILES['project_photo']['name']) > 3){
			
			echo '<div class="alert alert-danger">Upload Project Image (Max. 3 Images)</div>';
			
		}else{
		
			foreach ($_FILES['project_photo']['name'] as $name => $value){
				$filename = stripslashes($_FILES['project_photo']['name'][$name]);
				$size = filesize($_FILES['project_photo']['tmp_name'][$name]);
				$ext = $this->getExtension($filename);
				$ext = strtolower($ext);
				if(in_array($ext,$valid_formats)){
					if ($size < (2000*1024)){ //max 2mb
						$image_name = time() . $filename; 
						$newname = $uploaddir.$image_name; 
						
						if (move_uploaded_file($_FILES['project_photo']['tmp_name'][$name], $newname)) { 
							
							$data = array(
								'business_id' => $business_id,
								'token' => $verifyToken,
								'photo' => $newname
							);
							$photo_id = $this->photo_model->addPhotoTemp($data);
							
							$photo_resize = $this->mediamanager->getPhotoUrl($newname, "200x200");
							/*$data['photo_id'] = $photo_id;
							$data['photo_resize'] = $photo_resize;
							echo json_encode($data);*/
							
							echo '<div class="project-thumbnail">';
							echo "<img src='".cdn_url().$photo_resize."' class='img-thumbnail'>"; 
							echo '<a href="#" id="delete_photo" data-pid="'.$photo_id.'" data-h="'.sha1($photo_id . SALT).'"><span class="glyphicon glyphicon-remove"></span></a>';
							echo '</div>';
							
						}else{ 
							echo '<div class="alert alert-danger">You have exceeded the size limit! so moving unsuccessful! </div>'; 
						} 
					}else{ 
						echo '<div class="alert alert-danger">Max Size 2MB</div>'; 
					} 	
						
				}else{ 
					echo '<div class="alert alert-danger">Unknown extension!</div>'; 
				} 
			}

		}

	}
	
}

?>