<?php 
$like_ig = 0;
$like_ig_cache = $this->scache->read('like_ig_cache#' . $media_id);
if (empty($like_ig_cache)){
	$result = $this->instagram_library->instagram->getMedia($media_id);
	//echo '<pre>';print_r($result);echo '</pre>';
	if (!empty($result) && $result->meta->code == 200){
		$like_ig = $result->data->likes->count;
	}
	$this->scache->write('like_ig_cache#' . $media_id, $like_ig, 60 * 60); // 1 jam
}else{
	$like_ig = $like_ig_cache;
}
?>

<div id="modal-instagram-photo" class="modal modal-activorm fade">
	<div class="modal-dialog" style="width: 520px;padding-top: 80px;">
		<div class="modal-content" style="padding-bottom:0px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>

			<div class="modal-body">
				
				<img src="<?php echo $photo; ?>" width="450" />
					
			</div>
			
			<div class="modal-footer">
				<div class="instagram-act-container">
					<div class="ig-count-like"><?php echo $like_ig; ?></div>
					<div class="ig-btn-like"><a href="<?php echo $link_act; ?>" class="btn btn-green"><i></i>Like This Photo</a></div>
				</div>
			</div>	
		</div>
	</div>
<!-- .modal --></div>