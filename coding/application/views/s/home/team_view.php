<div class="container-fluid team">
   <div class="row">
      <h3>Team</h3>
   </div>
   <div id="team" class="row team-box">
<?php
      $photo = (empty($this->account_sales->account_primary_photo)) ? 'img/user-default.gif' : $this->account_sales->account_primary_photo;
      $photo = $this->mediamanager->getPhotoUrl($photo, "100x100", 1);
?>
      <div class="col-sm-3">
         <div class="team-self-box text-center">
            <img class="img-responsive img-circle" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->account_sales->account_name; ?>" />
            <span><?php echo $this->account_sales->account_name; ?></span>
      <?php if(empty($this->data['teams'])){ ?>
      <?php } else { ?>
            <div class="team-select-box">
               <select id="teamSelect">
      <?php    foreach($this->data['teams'] as $t) { ?>
                  <option value="<?php echo $t->team_id ?>"><?php echo $t->team_name ?></option>
      <?php    } ?>
               </select>
            </div>
      <?php } ?>
         </div>
      </div>
      <div class="col-sm-9">
<?php foreach($this->data['teams'] as $team) { ?>
         <div id="team-<?php echo $team->team_id; ?>" class="teams row">
<?php    foreach($team->members as $member){
            $photo = (empty($member->account_primary_photo)) ? 'img/user-default.gif' : $member->account_primary_photo;
            $photo = $this->mediamanager->getPhotoUrl($photo, "80x80", 1);
?>
            <div class="col-sm-4">
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