<div class="card mx-2 my-3" id="loginotp" style="display:none">
  <div class="card-header text-center">
  Verify Phone Number
  </div>
  <div class="card-body">
<button class="btn btn-outline-dark btn-sm" id="login-changenumber-btn"><i class="bi bi-arrow-left-circle"></i> Change Number</button>
    
<div class="d-flex gap-2 my-3">
<input type="number" class="form-control form-control-sm otp text-center fs-3" id="otp" placeholder="######"/>
</div>

<div class="text-end mb-2 d-flex justify-content-between align-items-center">
    <span class="small" id="resendotp-msg"></span>
<button class="btn btn-outline-primary btn-sm" id="login-resendotp-btn" disabled='true'><i class="bi bi-arrow-clockwise"></i> Resend OTP</button>
</div>
<div class="small">
By Continuing, you agree to our <a href="<?=base_url('user/page/terms')?>" class="text-decoration-none showloading">Legal Terms</a> and you are 18 years or older.
</div>
    <button class="btn w-100 btn-primary my-2" id="login-verifyotp-btn">VERIFY</button>
    
  </div>
</div>

<div class="card mx-2 my-3" id="login">
  <div class="card-header text-center">
   Login
  </div>
  <div class="card-body">
    <div class="mb-1">Mobile Number</div>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
  <input type="number" class="form-control" placeholder="" id="mobileno" aria-label="" aria-describedby="basic-addon1">
</div>
<div class="small">
By Continuing, you agree to our <a href="<?=base_url('user/page/terms')?>" class="text-decoration-none showloading">Legal Terms</a> and you are 18 years or older.
</div>
    <button href="#" class="btn w-100 btn-primary my-2" id="getotp_btn" >GET OTP</button>
    <div class="fs-6 text-center">
Don't have an account?  <a href="<?=base_url('signup')?>" class="text-decoration-none showloading">Sign Up</a> 
</div>
  </div>
</div>

