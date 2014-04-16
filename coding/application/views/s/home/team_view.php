<div class="container-fluid team">
   <div class="row">
      <h3>Team</h3>
   </div>
   <div id="team" class="row team-box">
      <div class="col-sm-12">
<?php foreach($this->data['teams'] as $team) { ?>
         <div id="team-<?php echo $team->team_id; ?>" class="teams row">
<?php    foreach($team->members as $member){
            $photo = $this->mediamanager->getPhotoUrl((empty($member->account_primary_photo)) ? 'img/user-default.gif' : $member->account_primary_photo, "80x80", 1);
?>
            <div class="col-sm-3">
               <div class="row"> 
                  <div class="team-member-box <?php echo $member->team_role; ?> clearfix">
                     <div class="member-avatar">
                        <img class="img-circle" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $member->account_name; ?>" />
                     </div>
                     <div class="member-info">
                        <span><?php echo $member->account_name; ?></span>
                     </div>
                     
                     <?php //print_r($member); ?>
                  </div>
               </div>
            </div>
<?php    } ?>
         </div>
<?php } ?>
      </div>
   </div>
</div>