
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Site Settings</h5>

<hr>
<form class="mx-2" method="post" action="<?=base_url('admin/updatesystem')?>" enctype="multipart/form-data">

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Site Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="brand_name" value="<?=$system->brand_name?>" required>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Site Logo</label>
    <div class="col-sm-10">
        <img src="<?=base_url('assets/images/'.$system->brand_logo)?>" height="60px" />
      <input type="file" class="form-control mt-2" accept=".jpeg,.jpg,.png" name="logo">
    </div>
  </div>
<hr>
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Meta Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="meta_title" value="<?=$system->meta_title?>" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Meta Desc</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="meta_desc" value="<?=$system->meta_desc?>" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Meta Keywords</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="meta_keywords" value="<?=$system->meta_keywords?>" required>
    </div>
  </div>
<hr>

<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Payment Gateway</label>
    <div class="col-sm-10">
    <select name="payment_gateway" class="form-control">
      <option value="SK" <?=$system->payment_gateway=='SK'?'selected':''?>>SHOPKING Gateway</option>
      <option value="UG" <?=$system->payment_gateway=='UG'?'selected':''?>>UPI Gateway</option>
      <option value="PG" <?=$system->payment_gateway=='PG'?'selected':''?>>Paytm Business</option>
      <option value="P" <?=$system->payment_gateway=='P'?'selected':''?>>PhonePe PG</option>
      <option value="CP" <?=$system->payment_gateway=='CP'?'selected':''?>>Cashfree Payments</option>
      <option value="D" <?=$system->payment_gateway=='D'?'selected':''?>>Disable Deposit</option>
    </select>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Withdraw Limit</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="minimum_withdraw" value="<?=$system->minimum_withdraw?>" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">KYC Mode</label>
    <div class="col-sm-10">
    <select name="kyc_type" class="form-control">
      <option value="2" <?=$system->kyc_type==2?'selected':''?>>Not Required (Disable)</option>
      <option value="1" <?=$system->kyc_type==1?'selected':''?>>Automatic / Using API</option>
      <option value="0" <?=$system->kyc_type==0?'selected':''?>>Manual / Approval Required</option>
    </select>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Game Amount</label>
    <div class="col-sm-10">
    <select name="game_amount" class="form-control">
     <?php
     for($i=1;$i<101;$i++){
      ?>
<option value="<?=5*$i?>" <?=$system->game_amount==(5*$i)?'selected':''?>>Multiple of <?=5*$i?></option>
      <?php
     }
     ?>
    </select>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Site Mode</label>
    <div class="col-sm-10">
    <select name="site_mode" class="form-control">
      <option value="1" <?=$system->site_mode==1?'selected':''?>>Active</option>
      <option value="0" <?=$system->site_mode==0?'selected':''?>>Under Maintenance</option>

    </select>
    </div>
  </div> 
  
    <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">show balance</label>
    <div class="col-sm-10">
    <select name="showb" class="form-control">
      <option value="1" <?=$system->showb==1?'selected':''?>>Yes</option>
      <option value="0" <?=$system->showb==0?'selected':''?>>NO</option>

    </select>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">withdrawal</label>
    <div class="col-sm-10">
    <select name="withdrawallow" class="form-control">
      <option value="1" <?=$system->withdrawallow==1?'selected':''?>>Allowed</option>
      <option value="0" <?=$system->withdrawallow==0?'selected':''?>>Not Allowed</option>
    </select>
    </div>
  </div>
  
    <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">withdrawal time limit</label>
    <div class="col-sm-10">
    <select name="witht" class="form-control">
      <option value="2" <?=$system->witht==2?'selected':''?>>2 hr</option>
      <option value="1" <?=$system->witht==1?'selected':''?>>1 hr</option>
      <option value="0" <?=$system->witht==0?'selected':''?>>No limit</option>
    </select>
    </div>
  </div>
  
  <hr>
    <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">screenshot for all game</label>
    <div class="col-sm-10">
    <select name="ssallgame" class="form-control">
      <option value="1" <?=$system->ssallgame==1?'selected':''?>>yes</option>
      <option value="0" <?=$system->ssallgame==0?'selected':''?>>No</option>
    </select>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">auto update rooomcode</label>
    <div class="col-sm-10">
    <select name="aup" class="form-control">
      <option value="1" <?=$system->aup==1?'selected':''?>>yes</option>
      <option value="0" <?=$system->aup==0?'selected':''?>>No</option>
    </select>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">live chat</label>
    <div class="col-sm-10">
    <select name="livcht" class="form-control">
      <option value="1" <?=$system->livcht==1?'selected':''?>>yes</option>
      <option value="0" <?=$system->livcht==0?'selected':''?>>No</option>
    </select>
    </div>
  </div>
  
<hr>
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Instagram</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="instagram" value="<?=$system->instagram?>">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Whatsapp</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="whatsapp" value="<?=$system->whatsapp?>">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" value="<?=$system->email?>">
    </div>
  </div>

  <hr>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Admin Name</label>
    <div class="col-sm-10">
      <input type="name" class="form-control" name="admin_name" value="<?=$user->full_name?>" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Admin Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="admin_email" value="<?=$user->email?>" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Admin Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="admin_password" placeholder="enter new password for change">
    </div>
  </div>
  <hr>

 <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Homepage Banner</label>
    <div class="col-sm-10">
        <img src="<?=base_url('assets/images/'.$system->homepage_banner)?>" height="200px" width="200px" />
      <input type="file" class="form-control mt-2" accept=".jpeg,.jpg,.png" name="banner">
    </div>
  </div>

   

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Youtube Embed Link For Instructions</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="instruction" value="<?=$system->instruction?>" placeholder="enter youtube video link for training">
    </div>
  </div>
  <hr>
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">App Download Image</label>
    <div class="col-sm-10">
        <img src="<?=base_url('assets/images/'.$system->app_download_image)?>" height="60px"  />
      <input type="file" class="form-control mt-2" accept=".jpeg,.jpg,.png,.gif" name="app_download_image">
    </div>
  </div>

   

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">App Download Button</label>
    <div class="col-sm-10">
     
      <select class="form-control" name="app_download_link">
<option value="">Hide Download Button</option>
<option value="#" <?=($system->app_download_link=='#')?'selected':''?>>Show Download Button</option>
    </select>
    </div>
  </div>

<div class="text-end">
  <button class="btn btn-primary">Update Site Settings</button>
</div>
</form>
</div>
</div>