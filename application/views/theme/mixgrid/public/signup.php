<div class="card mx-2 my-3" id="signupotp" style="display:none">
  <div class="card-header text-center">
  Verify Phone Number
  </div>
  <div class="card-body">
<button class="btn btn-outline-primary btn-sm" id="changenumber-btn"><i class="bi bi-arrow-left-circle"></i> Change Number</button>
    
<div class="d-flex gap-2 my-3">
<input type="number" class="form-control form-control-sm otp text-center fs-3" id="otp" placeholder="######"/>
</div>

<div class="text-end mb-2 d-flex justify-content-between align-items-center">
    <span class="small" id="resendotp-msg"></span>
<button class="btn btn-outline-dark btn-sm" id="resendotp-btn" disabled='true'><i class="bi bi-arrow-clockwise"></i> Resend OTP</button>
</div>
<div class="small">
By Continuing, you agree to our <a href="<?=base_url('user/page/terms')?>" class="text-decoration-none showloading">Legal Terms</a> and you are 18 years or older.
</div>
    <button class="btn w-100 btn-primary my-2" id="verifyotp-btn">VERIFY</button>
    
  </div>
</div>


<div class="card mx-2 my-3" id="signup">
  <div class="card-header text-center">
   Sign Up
  </div>
  <div class="card-body">

    <div class="mb-1">Full Name</div>
    <div class=" mb-3">
  <input type="text" class="form-control form-control-sm" id="fullname" placeholder="" aria-label="" aria-describedby="basic-addon1">
</div>


<div class="mb-1">Phone Number</div>
    <div class=" mb-3">
  <input type="number" class="form-control form-control-sm" placeholder="" id="mobileno" aria-label="" aria-describedby="basic-addon1">
</div>

<div class="mb-1">Refer Code (Optional)</div>
    <div class=" mb-3">
  <input type="text" class="form-control form-control-sm" placeholder="" id="refercode" value="<?=@$_GET['refer']?>" =aria-label="" aria-describedby="basic-addon1">
</div>

<div class="small">
By Continuing, you agree to our <a href="<?=base_url('user/page/terms')?>" class="text-decoration-none showloading">Legal Terms</a> and you are 18 years or older.
</div>
<?php
if($this->db->get('system')->row()->signup_allowed){
  ?>
<a href="#" class="btn w-100 btn-primary my-2" id="signup_btn">Submit</a>
  <?php
}else{
  ?>
<button type="button" class="btn w-100 btn-primary my-2" disabled>Currently Not Taking New Users</button>
  <?php
}
?>
    
    <div class="fs-6 text-center">
Already have an account?  <a href="<?=base_url('login')?>" class="text-decoration-none showloading">Login</a> 
</div>
  </div>
</div>