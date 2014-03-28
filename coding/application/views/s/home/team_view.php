<div class="container-fluid team">
   <h3>Team</h3>
<?php    $teams = $this->data['teams']; ?>
<?php    foreach($teams as $team) { ?>
   <div id="team-<?php echo $team->team_id; ?>" class="team_box">
<?php    
            $members = $team->members;
            $is_self_leader = $team->leader->account_id == $this->account_sales->account_id;
            //if leader is not self, then we should add it to the members
            if(!$is_self_leader) array_unshift($members, $team->leader);
            //get how much member there are
            $count = count($members);
            //calculate row and col
            $self_row_max        = 2;
            $self_row_item_max   = 3;
            $self_row_item_count = $count < $self_row_max * $self_row_item_max ? $count : $self_row_max * $self_row_item_max;
            $self_row_count      = ceil($self_row_item_count / $self_row_item_max);
?>
      <div class="row">
         <div class="col-sm-3">
            <div class="team_self_box <?php echo $is_self_leader ? 'leader' : ''; ?>">a
            </div>
         </div>
         <div class="col-sm-9">
<?php
            for($row = 0; $row < $self_row_count; $row++){
               $item_count = 0;
?>
            <div class="row">
<?php 
               $row_max_item_max  = ($row + 1) * $self_row_item_max;
               $row_max_item_real = $row_max_item_max < $self_row_item_count ? $self_row_item_max : $self_row_item_count - $row * $self_row_item_max;
               for($col = 0; $col < $row_max_item_real; $col++){
                  $member = $members[$row * $self_row_item_max + $col];
                  
                  $photo = (empty($member->account_primary_photo)) ? 'img/user-default.gif' : $member->account_primary_photo;
                  $photo = $this->mediamanager->getPhotoUrl($photo, "34x34", 1);
?>
               <div class="col-sm-<?php echo 12 / $self_row_item_max; ?>">
                  <div class="team_member_box <?php echo $member->team_role; ?>">
                     <img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $member->account_name; ?>" />
                     <?php //print_r($member); ?>
                  </div>
               </div>
<?php 
               }
?>
            </div>
<?php 
            } 
?>
         </div>
      </div>
   </div>
<?php    } ?>

</div>