
<div class="mt-3 mx-2 p-2">




<div class="card my-3" id="login">
  <div class="card-header text-center">
   My Referral Earnings
  </div>
  <div class="card-body">
  <div class="d-flex flex-wrap">


<!-- //box start -->
<div class="card col-6 rounded-0">
  <div class="card-header small text-center">
   Referred Players
  </div>
  <div class="card-body fs-3 fw-bold p-2 text-center">
<?=@$totalreferrals?>

  </div>
</div>
<!-- box ends -->
<!-- //box start -->
<div class="card col-6 rounded-0">
  <div class="card-header small text-center">
   Referral Earnings
  </div>
  <div class="card-body fs-3 fw-bold p-2 text-center">
₹ <?=number_format(@$totalreferralearnings)?>

  </div>
</div>
<!-- box ends -->

</div>
</div>
</div>

<div class="card my-3" id="login">
  <div class="card-header text-center">
   Referral Code
  </div>
  <div class="card-body">
  
 <div class="alert alert-primary text-center fs-3" id="refcodec" role="alert">

 <?=$user->code?>

</div>
<!-- <div class="alert alert-success text-center fs-6" id="reflink" role="alert">
 <?=base_url('signup?refer='.strtolower($user->code))?>
</div> -->
<div class="d-flex justify-content-between gap-3">
    <!-- <button class="w-100 btn btn-primary btn-sm" onClick="copyreflink('reflink');"><i class="bi bi-files"></i> Copy Link</button> -->
    <button class="w-100 btn btn-dark btn-sm" onClick="copyreflink('refcodec');"><i class="bi bi-files"></i> Copy Referral Code</button>
</div>
<div class="d-flex justify-content-between gap-2 my-3">
    <a href="whatsapp://send?text=Play ludo and earn money. Register Now, My refer code is <?=$user->code?>.%0A👇👇%0A<?=base_url('signup?refer='.strtolower($user->code))?>" class="w-100 btn btn-sm text-white" style="background-color:#1EBEA5"><i class="bi bi-whatsapp"></i> Share On Whatsapp</a>
</div>

</div>



</div>


</div>