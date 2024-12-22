
<div class="card mx-2 my-3" id="login">
  <div class="card-header text-center">
   Profile
  </div>
  <div class="card-body">

  <div class="d-flex justify-content-center">
    <div class="position-relative" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#avatars">
<img src="<?=base_url('assets/images/avatars/'.$user->avatar)?>" id="profile" class="rounded-circle" width="65px" height="65px" />
 <span class="position-absolute bottom-0 start-50 translate-bottom bg-light rounded-circle p-1 border d-flex justify-content-center align-items-center" style="width:22px;height:22px;font-size:13px;margin-left:10px;margin-bottom:-1px">
<i class="bi bi-pencil-square"></i>
  </span>
</div>
</div>

   <div class="mb-1">Username</div>
    <div class="input-group mb-3">
  <input type="text" class="form-control"  value="<?=@$user->username?>" id="username" aria-label="" aria-describedby="basic-addon1">
  <span class="input-group-text btn-primary" id="update-username">Update</span>
</div>

    <div class="mb-1">Mobile Number</div>
    <div class="mb-3">
  <input type="number" class="form-control" placeholder="" value="<?=@$user->mobile_no?>" aria-label="" aria-describedby="basic-addon1" disabled>
</div>

<?php
if($this->db->get('system')->row()->kyc_type!=2){
?>
<div class="d-flex align-items-center p-3 rounded border border-primary justify-content-between">
<div>


<?php

if($kyc){
  $info = json_decode($kyc->kycdata);

?>
<div class="small">KYC Status</div>
<?php
if($kyc->status==1){
  ?>
<div class="fw-bold">Verified <span class="text-success"><i class="bi bi-patch-check-fill"></i></span></div>
</div>
<button class="btn btn-sm btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#kyc">KYC Details</button>
  <?php
}else{
  ?>
<div class="fw-bold">Waiting for Approval <span class="text-warning"><i class="bi bi-exclamation-circle"></i></span></div>
</div>
  <?php
}
?>




<div class="offcanvas offcanvas-bottom" style="height:60vh" tabindex="-1" id="kyc" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">KYC Information</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
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
<div class="fs-5 fw-bold"><i class="bi bi-fingerprint"></i> <?=$kyc->aadhar_no?></div>
  <div class="fs-6 mt-2 d-flex gap-3 flex-wrap"> <img src="<?=base_url('assets/images/kyc/'.$kyc->aadhar_front)?>" style="height:150px"/> <img src="<?=base_url('assets/images/kyc/'.$kyc->aadhar_back)?>" style="height:150px"/></div>


  <?php
}
?>
  


  </div>
</div>
<?php
}else{
  ?>
<div class="small">KYC Status</div>
<div class="fw-bold">Not Verified <span class="text-danger"><i class="bi bi-x-circle-fill"></i></span></div>
</div>
<button class="btn btn-sm btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#kyc">Verify KYC</button>

<div class="offcanvas offcanvas-bottom" style="height:60vh" tabindex="-1" id="kyc" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">KYC Verification</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
<?php
if($this->db->get('system')->row()->kyc_type==0){
  ?>
<form method="post" action="<?=base_url('user/submitkyc')?>" enctype="multipart/form-data">
<div id="enteraadhar">
   <div class="mb-3 border p-2 rounded">
  <label for="basic-url" class="form-label">Enter Aadhar No</label>
  <div class="input-group">
  
    <input type="number" min="111111111111" max="999999999999" class="form-control form-control-sm" placeholder="enter your aadhar no" name="aadhar_no" aria-describedby="basic-addon3 basic-addon4" required>
  </div>

   <label for="basic-url" class="form-label mt-3">Aadhar Card Front</label>
  <div class="input-group">

    <input type="file" class="form-control form-control-sm" name="aadhar_front" accept="image/*" aria-describedby="basic-addon3 basic-addon4" required>
  </div>

   <label for="basic-url" class="form-label mt-3">Aadhar Card Back</label>
  <div class="input-group">

    <input type="file" class="form-control form-control-sm" name="aadhar_back" accept="image/*" aria-describedby="basic-addon3 basic-addon4" required>
  </div>

</div>
<div class="text-center">
<button class="btn btn-primary w-100"><i class="bi bi-fingerprint"></i> Submit KYC For Approval</button>
</div>
</div>
</form>
  <?php
}else{
  ?>
<div id="enteraadhar">
   <div class="mb-3 border p-2 rounded">
  <label for="basic-url" class="form-label">Enter Aadhar No</label>
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3"><i class="bi bi-fingerprint"></i></span>
    <input type="number" class="form-control" id="aadharno" aria-describedby="basic-addon3 basic-addon4">
  </div>
  <div class="form-text" id="basic-addon4">otp will send to the registered mobile no of aadhar card</div>
</div>
<div class="text-center">
<button class="btn btn-primary w-100" id="verify-kyc"><i class="bi bi-send"></i> Send OTP</button>
</div>
</div>
  <?php
}
?>

  


 <div id="verifyaotp" style="display:
 none">
   <div class="mb-3 border p-2 rounded">
  <label for="basic-url" class="form-label">Enter 6 Digit OTP</label>
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3"><i class="bi bi-fingerprint"></i></span>
    <input type="number" class="form-control" placeholder="######" id="aadharotp" aria-describedby="basic-addon3 basic-addon4">
  </div>
  <div class="form-text" id="basic-addon4">if you didn't recieved any otp in next 5 minutes, please try again after some time</div>
</div>
<div class="text-center">
<button class="btn btn-primary w-100" id="verify-kyc-otp"><i class="bi bi-send"></i> Verify OTP</button>
</div>
</div>


  </div>
</div>
  <?php
}

?>


<!-- ############################################### -->

</div>

  </div>
  <?php
}
  ?>
</div>


<!-- Modal -->
<div class="modal fade" id="avatars" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6 text-center w-100" id="exampleModalLabel">Avatars</h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex gap-3 flex-wrap justify-content-center">
       <img src="<?=base_url('assets/images/avatars/avatar1.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar2.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar3.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar4.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar5.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar6.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar7.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar8.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar9.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar10.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
            <img src="<?=base_url('assets/images/avatars/avatar11.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar12.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar13.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar14.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar15.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar16.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar17.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar18.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar19.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
       <img src="<?=base_url('assets/images/avatars/avatar20.png')?>" width="50px" height="50px" class="border avatar rounded-circle"/>
</div>

      </div>
      
    </div>
  </div>
</div>



<div class="card mx-2 my-3" >
  <div class="card-header text-center">
   Statistics
  </div>
  <div class="card-body">

<div class="d-flex flex-wrap">


<!-- //box start -->
<div class="card col-6 rounded-0">
  <div class="card-header small">
   <i class="bi bi-controller"></i> Games Played
  </div>
  <div class="card-body fs-3 fw-bold p-2">
<?=$totalgamesplayed?>

  </div>
</div>
<!-- box ends -->
<!-- //box start -->
<div class="card col-6 rounded-0">
  <div class="card-header small">
   <i class="bi bi-cash-coin"></i> Earnings
  </div>
  <div class="card-body fs-3 fw-bold p-2">
₹ <?=number_format($totalwinnings)?>

  </div>
</div>
<!-- box ends -->
<!-- //box start -->
<div class="card col-6 rounded-0">
  <div class="card-header small">
   <i class="bi bi-share"></i> Referral Earning
  </div>
  <div class="card-body fs-3 fw-bold p-2">
₹ <?=number_format($totalreferralearnings)?>

  </div>
</div>
<!-- box ends -->
<!-- //box start -->
<div class="card col-6 rounded-0">
  <div class="card-header small">
   <i class="bi bi-hand-thumbs-down"></i> Penalty
  </div>
  <div class="card-body fs-3 fw-bold p-2">
₹ <?=number_format($penalty)?>

  </div>
</div>
<!-- box ends -->
</div>

  </div>
</div>




<div class="mx-2 my-3">
 <a href="<?=base_url('user/logout')?>" class=" w-100 btn btn-sm btn-danger showloading"><i class="bi bi-box-arrow-left"></i> Logout</a>
</div>