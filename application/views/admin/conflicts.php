
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Match Conflicts</h5>


<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Created By</th>
<th class="text-nowrap fw-bold">Opponent</th>
<th class="text-nowrap fw-bold">Match Id</th>
<th class="text-nowrap fw-bold">cancel</th>
<th class="text-nowrap fw-bold">Room Code</th>
<th class="text-nowrap fw-bold">Date & Time</th>
<th class="text-nowrap fw-bold">Actions</th>
</tr>
</thead>
<tbody>
<?php
if(!$conflicts){
  ?>
  <tr><td colspan="8">
<p class="text-center">No Conflicts Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($conflicts as $req){
         $by=$this->db->where('id',$req->user_id)->get('users')->row();
         $match=$this->db->where('id',$req->match_id)->get('matches')->row();
         if($match->host_id==$by->id){
            $op=$this->db->where('id',$match->joiner_id)->get('users')->row();
         }else{
            $op=$this->db->where('id',$match->host_id)->get('users')->row();

         }
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <a href="<?=base_url('admin/user/'.$by->id)?>" class="showloading text-decoration-none showloading">@<?=$by->username?></a> |
    <?php
    if($req->screenshot){
    ?>
<button class="btn btn-sm btn-primary" data-coreui-toggle="modal" data-coreui-target="#screenshotby"><i class="bi bi-phone"></i> Screenshot</button>
<div class="modal fade" id="screenshotby" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@<?=$by->username?> Submitted Screenshot</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <img src="<?=base_url('assets/images/screenshots/'.$req->screenshot)?>" width="250px"/>
      </div>
    </div>
  </div>
</div>
<?php
    }
    ?>
  </td>

  <td class="text-nowrap">
        <a href="<?=base_url('admin/user/'.$op->id)?>" class="showloading text-decoration-none showloading">@<?=$op->username?></a> | 
        <?php
    if($req->looser_screenshot){
    ?>
<button class="btn btn-sm btn-primary" data-coreui-toggle="modal" data-coreui-target="#screenshotop"><i class="bi bi-phone"></i> Screenshot</button>
<div class="modal fade" id="screenshotop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@<?=$op->username?> Submitted Screenshot</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <!--<img src="<?=base_url('assets/images/screenshots/'.$match->winner_screenshot)?>" width="250px"/>-->
       <img src="<?=base_url('assets/images/screenshots/'.$req->looser_screenshot)?>" width="250px"/>
      </div>
    </div>
  </div>
</div>
<?php
    }
    ?>
  </td>
  <td class="text-nowrap">
    <p class="m-0"><a href="<?=base_url('admin/match/'.$match->id)?>" class="text-decoration-none showloading">#MID<?=$req->match_id+1427?></a></p>
  </td>
  
  <td>
      <a href="<?=base_url('admin/canmatch/'.$match->id)?>" class="btn text-white btn-danger btn-sm showloading">Cancel Match</a>
  </td>

  <td class="text-nowrap">
    <p class="m-0"><?=$match->room_code?></p>
  </td>

  
    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$req->created_at)?>
    </td>
    <td class="text-nowrap">
         <form method="post" action="<?=base_url('admin/resolve/'.$req->id)?>">
    <div class="d-flex gap-1">
       
<select class="form-select form-select-sm" name="task">
<option value="1">@<?=$by->username?> as winner </option>
<option value="2">@<?=$op->username?> as winner </option>
<option value="3">@<?=$by->username?> as winner (50%) </option>
<option value="4">@<?=$op->username?> as winner (50%) </option>
<option value="5">@<?=$by->username?> as winner (30%) </option>
<option value="6">@<?=$op->username?> as winner (30%) </option>
</select>
<button class="btn btn-primary btn-sm showloading">Resolve</button>
<!-- <a href="<?=base_url('admin/removeconflict/'.$req->id)?>" class="btn btn-danger btn-sm showloading">Remove</a> -->
       
        </div>
         </form>
    </td>
  
  

</tr>
    <?php
    $count++;
}
?>
</tbody>
</table>
</div>


</div>
</div>