<?php 
foreach($comments as $k=>$v){
	
	$comment = $v['comment'];
	
	$photo = (empty($comment->account_primary_photo)) ? 'img/user-default.gif' : $comment->account_primary_photo;
	$photo = $this->mediamanager->getPhotoUrl($photo, "100x100");
	
?>	

<li class="clearfix comment" id="comment" data-cid="<?php echo $comment->comment_id; ?>">
	<div class="comment-avatar">
		<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $comment->account_name; ?>" />
	</div>

	<div class="comment-body" id="comment-body">
		<div class="comment-meta">
			<strong class="comment-author"><?php echo $comment->account_name; ?></strong>
			<span class="comment-date"><?php echo date('d M Y H:i', strtotime($comment->postdate)); ?></span>
		</div>

		<div class="comment-content">
			<p><?php echo $comment->comment_text; ?></p>
		</div>

		<div class="comment-reply">
			<a href="#" id="btn-reply"><i class="icon-reply"></i> Reply Comment</a>
			<form class="form-activorm form-comment" action="#" method="post" id="reply_form" 
			data-pid="<?php echo $project_id; ?>" 
			data-pidhash="<?php echo sha1($project_id . SALT); ?>" 
			data-cid="<?php echo $comment->comment_id; ?>"
			data-cidhash="<?php echo sha1($comment->comment_id . SALT); ?>"
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
	
	<ul class="children" id="reply_child">
		
		<?php 
		if (!empty($v['reply'])){
				
			$replys = $v['reply'];	
			
			ksort($replys);
			
			foreach($replys as $a=>$b){
				
				$photo = (empty($comment->account_primary_photo)) ? 'img/user-default.gif' : $b->account_primary_photo;
				$photo = $this->mediamanager->getPhotoUrl($photo, "100x100");
				
		?>
		
		<li class="clearfix comment">
			<div class="comment-avatar">
				<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $b->account_name; ?>" />
			</div>

			<div class="comment-body">
				<div class="comment-meta">
					<strong class="comment-author"><?php echo $b->account_name; ?></strong>
					<span class="comment-date"><?php echo date('d M Y H:i', strtotime($b->postdate)); ?></span>
				</div>

				<div class="comment-content">
					<p><?php echo $b->comment_text; ?></p>
				</div>
			</div>
		<!-- .comment --></li>
		
		<?php		
				
			}
			
		?>
		
		<?php
			
		}
		?>
		
	</ul>	
		
</li>

<?php	
}
?>