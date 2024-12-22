
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<div class="d-flex justify-content-between">
<h5>Match Details | #MID<?=$match->id+1427?></h5>
<button onclick="history.back()" class="btn btn-sm btn-outline-primary showloading">Go Back</button>
</div>

<hr>
<a href="<?=base_url('admin/gmatch/'.$match->id)?>" class="btn text-white btn-danger btn-sm showloading">show details</a>
<?php
if($match->status==1 && !$requests2){
  ?>
<a href="<?=base_url('admin/canmatch/'.$match->id)?>" class="btn text-white btn-danger btn-sm showloading">Cancel Match & Refund Money</a>
<!--<a href="<?=base_url('admin/updatematch/'.$match->id)?>" class="btn text-white btn-danger btn-sm showloading">update</a>-->
  <?php
}
?>
<div class="table-responsive">
<table class="table">
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Match Id</td><td>:</td><td class="text-nowrap">#MID<?=$match->id+1427?></td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Game</td><td>:</td><td class="text-nowrap"><?=$game->game_name?></td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Date & Time</td><td>:</td><td class="text-nowrap"><?=date('d M Y, h:i A',$match->created_at)?></td>
</tr>

<tr>
<td class="text-nowrap fw-bold" style="width:0%">Playing Amount</td><td>:</td><td class="text-nowrap"><?=number_format($match->amount)?> Rs</td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Prize Amount</td><td>:</td><td class="text-nowrap"><?=number_format($reward)?> Rs</td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Hosted By</td><td>:</td><td class="text-nowrap"><a href="<?=base_url('admin/user/'.$host->id)?>" class="showloading text-decoration-none">@<?=$host->username?> | <?=$host->mobile_no?></a>

<?php
// if($match->looser==0 && $match->winner!=0 && $match->winner!=$host->id){
// if($match->looser==0 or $match->winner==0){
if($match->status!=0){
  ?>
<a href="<?=base_url('admin/submitlooser/'.$match->id.'/'.$host->id)?>" class="showloading btn btn-danger btn-sm mx-2 text-white">Submit @<?=$host->username?> as looser</a>
<!--<a href="<?=base_url('admin/submitlooser/'.$match->id.'/'.$host->id)?>" class="showloading btn btn-danger btn-sm mx-2 text-white">update match</a>-->
<!--<a href="<?=base_url('admin/submitlooser/'.$match->id.'/'.$host->id)?>" class="showloading btn btn-danger btn-sm mx-2 text-white">show detail</a>-->
  <?php
}
?>
</td>
</tr>

<tr>
<td class="text-nowrap fw-bold" style="width:0%">Joined By</td><td>:</td><td class="text-nowrap">
    <?php
if($joiner){
    ?>
<a href="<?=base_url('admin/user/'.$joiner->id)?>" class="showloading text-decoration-none">@<?=$joiner->username?> | <?=$joiner->mobile_no?></a>

<?php
// if($match->looser==0 && $match->winner!=0 && $match->winner!=$joiner->id){
// if($match->looser==0 or $match->winner==0){
if($match->status!=0){
  ?>
<a href="<?=base_url('admin/submitlooser/'.$match->id.'/'.$joiner->id)?>" class="showloading btn btn-danger btn-sm mx-2 text-white">Submit @<?=$joiner->username?> as looser</a>
  <?php
}
?>
    <?php
}else{
    echo "none";
}
    ?>
    
</td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Room Code</td><td>:</td><td class="text-nowrap"><?=$match->room_code==0?'not entered':$match->room_code?></td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Winner</td><td>:</td><td class="text-nowrap">
<?php
if($winner){
    ?>
<a href="<?=base_url('admin/user/'.$winner->id)?>" class="showloading text-decoration-none showloading">@<?=$winner->username?></a> | 
<button class="btn btn-sm btn-primary" data-coreui-toggle="modal" data-coreui-target="#screenshot"><i class="bi bi-phone"></i> Screenshot</button>
<!-- Modal -->
<div class="modal fade" id="screenshot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Winner Screenshot</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <img src="<?=base_url('assets/images/screenshots/'.$match->winner_screenshot)?>" width="250px"/>
      </div>
    </div>
  </div>
</div>
    <?php
}else{
    ?>
none
    <?php
}
?>
</td>
</tr>
<tr>
<td class="text-nowrap fw-bold" style="width:0%">Looser</td><td>:</td><td class="text-nowrap">
    <?php
if($looser){
    ?>
<a href="<?=base_url('admin/user/'.$looser->id)?>" class="showloading text-decoration-none">@<?=$looser->username?></a>
    <?php
}else{
    ?>
none
    <?php
}
?>
</td>

</tr>

<tr>
<td class="text-nowrap fw-bold" style="width:0%">Match Status</td><td>:</td><td class="text-nowrap">
    <?php
if($match->status==0){
    ?>
Closed
    <?php
}elseif($match->winner!=0 && $match->looser!=0){
    echo "Result Submitted";
}else{
    ?>
Active
    <?php
}
?>
</td>

</tr>
</table>
</div>


<h5>Transections Related To This Match</h5>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">User</th>
<th class="text-nowrap fw-bold">Remarks</th>
<th class="text-nowrap fw-bold">Date & Time</th>
<th class="text-nowrap fw-bold">Amount</th>
</tr>
</thead>
<tbody>
<?php
if(!$txns){
  ?>
  <tr><td colspan="5">
<p class="text-center">No Transection Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($txns as $txn){
         $u=$this->db->where('id',$txn->user_id)->get('users')->row();
    ?>
<tr>
    <td><?=$count?></td>

    

  <td class="text-nowrap">
    <p class="m-0">@<?=$u->username?> | <?=$u->mobile_no?></p>
  </td>

  <td>
<p class="m-0"><?=$txn->reason?></p>
</td>

    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$txn->created_at)?>
    </td>
    <td class="text-wrap">
  <?php
if($txn->type=='DEBIT'){
    echo "<span class='text-danger'>- $txn->amount </span>";
}else{
    echo "<span class='text-success'>+ $txn->amount </span>";

}
  ?>
    </td>
  
  

</tr>
    <?php
    $count++;
}
?>
</tbody>
</table>
</div>


<h5>Conflict Reports On This Match</h5>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Created By</th>
<th class="text-nowrap fw-bold">Date & Time</th>
<th class="text-nowrap fw-bold">Status</th>
</tr>
</thead>
<tbody>
<?php
if(!$conflicts){
  ?>
  <tr><td colspan="5">
<p class="text-center">No Conflicts Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($conflicts as $txn){
         $u=$this->db->where('id',$txn->user_id)->get('users')->row();
    ?>
<tr>
    <td><?=$count?></td>

    

  <td class="text-nowrap">
    <p class="m-0">@<?=$u->username?> | <?=$u->mobile_no?></p>
  </td>

 

    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$txn->created_at)?>
    </td>
    <td class="text-wrap">
  <?php
if($txn->status==1){
    echo "<span class='text-warning'><i class='bi bi-exclamation-diamond'></i> Pending</span>";
}else{
    echo "<span class='text-success'><i class='bi bi-check2-all'></i> Resolved</span>";

}
  ?>
    </td>
  
  

</tr>
    <?php
    $count++;
}
?>
</tbody>
</table>
</div>

<h5>Cancellation Requests On This Match</h5>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Requested By</th>
<th class="text-nowrap fw-bold">Reason</th>
<th class="text-nowrap fw-bold">Request On</th>
<th class="text-nowrap fw-bold">Status</th>

</tr>
</thead>
<tbody>
<?php
if(!$requests){
  ?>
  <tr><td colspan="5">
<p class="text-center">No Requests Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($requests as $req){
         $by=$this->db->where('id',$req->req_by)->get('users')->row();
    ?>
<tr>
    <td><?=$count?></td>

    

  <td class="text-nowrap">
    <p class="m-0">@<?=$by->username?> | <?=$by->mobile_no?></p>
  </td>

  <td>
<p class="m-0"><?=$req->reason?></p>
</td>

    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$req->created_at)?>
    </td>
    <td class="text-wrap">
  <?php
if($req->status==1){
    echo "<span class='text-warning'><i class='bi bi-exclamation-diamond'></i> Pending</span>";
}elseif($req->status==2){
    echo "<span class='text-success'><i class='bi bi-check2-all'></i> Approved</span>";
}elseif($req->status==3){
    echo "<span class='text-primary'><i class='bi bi-check2-all'></i> Match Closed</span>";

}else{
    echo "<span class='text-danger'><i class='bi bi-x-octagon'></i> Rejected</span>";

}
  ?>
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