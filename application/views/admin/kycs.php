
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>KYC Requests</h5>
<!-- <form>
<div class="input-group mb-3">
  <input type="number" class="form-control" name="search" value="<?=@$_GET['search']?>" placeholder="enter mobile no"  aria-describedby="button-addon2">
  <button type="submit" class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i> Search</button>
</div>
</form>
<hr> -->
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>

<th class="text-nowrap fw-bold">Username</th>
<th class="text-nowrap fw-bold">Aadhar No</th>
<th class="text-nowrap fw-bold">Requested On</th>
<th class="text-nowrap fw-bold">Actions</th>

</tr>
</thead>
<tbody>
<?php
if(!$kycs){
  ?>
  <tr><td colspan="8">
<p class="text-center">No KYC Request Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($kycs as $kyc){
         $user=$this->db->where('id',$kyc->user_id)->get('users')->row();
    ?>
<tr>
    <td><?=$count?></td>

  

  <td class="text-nowrap">
    <p class="m-0"><a href="<?=base_url('admin/user/'.$user->id)?>" class="text-decoration-none">@<?=$user->username?> (<?=$user->mobile_no?>)</a></p>
  </td>

  <td>
<?=$kyc->aadhar_no?>
</td>
  
    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$kyc->created_at)?>
    </td>
    <td class="text-wrap">
       <button class="btn btn-sm btn-primary text-white text-nowrap" data-coreui-toggle="modal" data-coreui-target="#kyc<?=$kyc->id?>"><i class="bi bi-file-earmark-medical"></i> View</button>
      <a href="<?=base_url('admin/approvekyc/'.$kyc->id)?>" class="btn btn-sm btn-success text-white showloading text-nowrap"><i class="bi bi-check2"></i> Approve</a>
      <a href="<?=base_url('admin/rejectkyc/'.$kyc->id)?>" class="btn btn-sm btn-danger text-white text-nowrap"><i class="bi bi-x-lg"></i> Reject</a>

    

<div class="modal fade" id="kyc<?=$kyc->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">KYC Documents Submitted</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
    
      <div class="modal-body">
<?php
if($kyc->kycdata){
  ?>
<div class="d-flex gap-3 border rounded p-2">
<img src="data:image/jpeg;base64,<?=$info->photo_link?>" width="85px" class="rounded"/>
<div>
  <div class="fs-5 fw-bold"><i class="bi bi-fingerprint"></i> <?=$kyc->aadhar_no?></div>
  <div class="fs-6"><b>Name :</b> <?=$info->name?></div>
  <div class="fs-6"><b>Gender :</b> <?=$info->gender?></div>
  <div class="fs-6"><b>DOB :</b> <?=$info->dob?></div>
  


</div>
</div>

<div class=" border rounded p-2 mt-2">
<div class="fw-bold fs-5">Address</div>
<div>
  <?=@$info->care_of.', '.@$info->split_address->house.', '.@$info->split_address->street.' '.@$info->split_address->landmark.', '.@$info->split_address->vtc.', '.@$info->split_address->state.' '.@$info->split_address->dist.' '.@$info->split_address->pincode?>
</div>
</div>
  <?php
}else{
  ?>
<div class="fs-5 fw-bold">Aadhar No :  <?=$kyc->aadhar_no?></div>
  <div class="fs-6 mt-2 d-flex gap-3 flex-wrap"> <img src="<?=base_url('assets/images/kyc/'.$kyc->aadhar_front)?>" style="width:100%"/> <br><img src="<?=base_url('assets/images/kyc/'.$kyc->aadhar_back)?>" style="width:100%"/></div>


  <?php
}
?>
     
</div>
    
    </div>
  </div>
</div>

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