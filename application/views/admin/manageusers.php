
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Users</h5>
<form>
<div class="input-group mb-3">
  <input type="number" class="form-control" name="search" value="<?=@$_GET['search']?>" placeholder="enter mobile no"  aria-describedby="button-addon2">
  <button type="submit" class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i> Search</button>
</div>
</form>
<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Name</th>
<th class="text-nowrap fw-bold">Username</th>
  <?php
  if($this->db->get('system')->row()->showb){
  ?>
<th class="text-nowrap fw-bold">Wallet</th>
  <?php
  }
  ?>
<th class="text-nowrap fw-bold">Mobile No</th>
<th class="text-nowrap fw-bold">KYC</th>
<th class="text-nowrap fw-bold">Refferal Code</th>
<th class="text-nowrap fw-bold">Registered On</th>
<th class="text-nowrap fw-bold">Actions</th>

</tr>
</thead>
<tbody>
<?php
if(!$users){
  ?>
  <tr><td colspan="9">
<p class="text-center">No Users Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($users as $user){
         $kyc=$this->db->where('user_id',$user->id)->where('status',1)->get('kycs')->row();
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <p class=" m-0"><?=$user->full_name?> <?=$user->status==3?'<span class="small text-danger">( banned )</span>':''?></p>
  </td>

  <td class="text-nowrap">
    <p class="m-0">@<?=$user->username?></p>
  </td>
  
  <?php
  if($this->db->get('system')->row()->showb){
  ?>
   <td class="text-nowrap">
    <p class="m-0"><i class="bi bi-wallet2"></i> : ₹<?=number_format($fn->getAvailableBalance($user->id))?> | <i class="bi bi-trophy"></i> : ₹<?=number_format($fn->getRewardBalance($user->id))?></p>
  </td>
  <?php
  }
  ?>
  <td class="text-nowrap">
    <p class="m-0"><?=$user->mobile_no?></p>
  </td>
  <td>
<?=$kyc?'Completed':'Pending'?>
</td>
   <td class="text-nowrap">
    <p class="m-0"><?=$user->code?></p>
  </td>
    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$user->created_at)?>
    </td>
    <td class="text-wrap">
      <a href="<?=base_url('admin/user/'.$user->id)?>" class="btn btn-sm btn-primary text-white showloading text-nowrap"><i class="bi bi-person"></i> Open</a>
      <a href="<?=base_url('user/loginasuser/'.$user->id)?>" target="_blank" class="btn btn-sm btn-success text-white text-nowrap"><i class="bi bi-box-arrow-in-right"></i> Login</a>

    
    </td>
  
  

</tr>
    <?php
    $count++;
    // if($count>=50) break;
}
?>
</tbody>
</table>
</div>


</div>
</div>