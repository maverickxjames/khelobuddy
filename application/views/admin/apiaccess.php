
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/fast2sms.png')?>" height="40px" class="m-2" />

<form class="mx-2" method="post" action="<?=base_url('admin/updateotpapi')?>">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">API Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$otp_api->apikey?>" required>
  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$otp_api->updated_at)?>
</div>
<button class="btn btn-primary">Update OTP Api Credentials</button>
</div>
</div>
</form>




</div>
</div>


<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/sanbox.png')?>" height="30px" class="m-2" />

<form class="mx-2"  method="post" action="<?=base_url('admin/updateaadharapi')?>">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">API Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$aadhar_api->apikey?>" required>
  <br>
   <label for="exampleFormControlInput1" class="form-label">Secret Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="secretkey" placeholder="enter secret key" value="<?=$aadhar_api->secretkey?>" required>
 <br>
   <label for="exampleFormControlInput1" class="form-label">Auth Token (It Generates Automatically)</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="no auth token generated" value="<?=$aadhar_api->authtoken?>" disabled>
  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$aadhar_api->updated_at)?>
</div>
<button class="btn btn-primary">Update Aadhar Api Credentials</button>
</div>
</div>
</form>




</div>
</div>

<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/brand-sm.svg')?>" height="30px" class="m-2" /><img src="<?=base_url('assets/images/upigate.svg')?>" height="30px" class="m-2" />

<form class="mx-2"  method="post" action="<?=base_url('admin/updatepayment2api')?>">
<div class="mb-3">

<br>
  <label for="exampleFormControlInput1" class="form-label">UPI Gateway Api Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$payment2_api->apikey?>" required>

  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$payment2_api->updated_at)?>
</div>
<button class="btn btn-primary">Update Payment Api Credentials</button>
</div>
</div>
</form>




</div>
</div>

<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/shopking.png')?>" height="30px" class="m-2" />

<form class="mx-2"  method="post" action="<?=base_url('admin/updatepayment3api')?>">
<div class="mb-3">

<br>
  <label for="exampleFormControlInput1" class="form-label">SHOPKING Gateway Api Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$payment3_api->apikey?>" required>

  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$payment3_api->updated_at)?>
</div>
<button class="btn btn-primary">Update Payment Api Credentials</button>
</div>
</div>
</form>




</div>
</div>


<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/paytm.svg')?>" height="50px" class="m-2" />

<form class="mx-2"  method="post" action="<?=base_url('admin/updatepaymentapi')?>">
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">Paytm Business Merchant ID</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="secretkey" placeholder="enter registered mobile no" value="<?=$payment_api->secretkey?>" required>
    
<br>
  <label for="exampleFormControlInput1" class="form-label">Paytm Business VPA</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$payment_api->apikey?>" required>

  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$payment_api->updated_at)?>
</div>
<button class="btn btn-primary">Update Payment Api Credentials</button>
</div>
</div>
</form>




</div>
</div>


<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/phonepe.png')?>" height="50px" class="m-2" />

<form class="mx-2"  method="post" action="<?=base_url('admin/updatephonepeapi')?>">
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">PhonePe PG Merchant ID</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="secretkey" placeholder="enter registered mobile no" value="<?=$phonepe->secretkey?>" required>
    
<br>
  <label for="exampleFormControlInput1" class="form-label">PhonePe PG Api Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$phonepe->apikey?>" required>

  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$phonepe->updated_at)?>
</div>
<button class="btn btn-primary">Update Payment Api Credentials</button>
</div>
</div>
</form>




</div>
</div>


<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<img src="<?=base_url('assets/images/cashfree.png')?>" height="50px" class="m-2" />

<form class="mx-2"  method="post" action="<?=base_url('admin/updatecashfreeapi')?>">
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">Cashfree Secret Key</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="secretkey" placeholder="enter registered mobile no" value="<?=$cashfree->secretkey?>" required>
    
<br>
  <label for="exampleFormControlInput1" class="form-label">Cashfree App ID</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="apikey" placeholder="enter api key" value="<?=$cashfree->apikey?>" required>

  <div class="d-flex justify-content-between mt-3">
  <div id="passwordHelpBlock" class="form-text">
  Last Updated on <?=date('d M Y, h:i A',$cashfree->updated_at)?>
</div>
<button class="btn btn-primary">Update Payment Api Credentials</button>
</div>
</div>
</form>




</div>
</div>