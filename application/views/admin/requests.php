
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Cancellation Requests</h5>


<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Name</th>
<th class="text-nowrap fw-bold">Username</th>
<th class="text-nowrap fw-bold">Mobile No</th>
<th class="text-nowrap fw-bold">Reason</th>
<th class="text-nowrap fw-bold">Match Id</th>
<th class="text-nowrap fw-bold">Joining time</th>
<th class="text-nowrap fw-bold">Request On</th>
<th class="text-nowrap fw-bold">Actions</th>

</tr>
</thead>
<tbody>
<?php
if(!$requests){
  ?>
  <tr><td colspan="8">
<p class="text-center">No Requests Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($requests as $req){
  $coft=$this->db->where('match_id',$req->match_id)->where('status',1)->get('conflicts')->result();
  if($coft){
    continue;
  }
        $m=$this->db->where('id',$req->match_id)->get('matches')->row();
        $by=$this->db->where('id',$req->req_by)->get('users')->row();
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <p class=" m-0"><?=$by->full_name?></p>
  </td>

  <td class="text-nowrap">
    <p class="m-0">@<?=$by->username?></p>
  </td>
  <td class="text-nowrap">
    <p class="m-0"><?=$by->mobile_no?></p>
  </td>
  <td>
<p class="m-0"><?=$req->reason?></p>
</td>
   <td class="text-nowrap">
    <p class="m-0">#MID<?=$req->match_id+1427?></p>
  </td>
  </td>
   <td class="text-nowrap">
        <?=date('d M Y, h:i A',$m->joiner_time)?>
  </td>
    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$req->created_at)?>
    </td>
    <td class="text-wrap">
      <a href="<?=base_url('admin/acceptcan/'.$req->id)?>" class="btn btn-sm btn-success text-white showloading text-nowrap"><i class="bi bi-check2"></i> Accept</a>
      <a href="<?=base_url('admin/rejectcan/'.$req->id)?>" class="btn btn-sm btn-danger text-white showloading text-nowrap"><i class="bi bi-x-lg"></i> Reject</a>
      <a href="<?=base_url('admin/match/'.$req->match_id)?>" class="btn btn-sm btn-primary text-white showloading text-nowrap"><i class="bi bi-info-circle"></i> Match Info</a>

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