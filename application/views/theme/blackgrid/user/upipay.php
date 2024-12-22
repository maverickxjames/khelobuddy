<?php

$vpa = $this->db->where('id',3)->get('apis')->row()->apikey;
$txnid=$user->id.time();
$note=$user->mobile_no;
$amount=$_SESSION['addamount'];

// $url="upi://pay?pa=$vpa&am=$amount&mam=1&cu=INR&tr=$txnid&tn=$note";
$url="upi://pay?pa=$vpa&pn=&am=$amount&tn=$note&tr=$txnid";
$url2=$url;
$url=urlencode($url);

$_SESSION['payment_txnid']=$txnid;
$_SESSION['pay_userid']=$user->id;

$qrurl="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=$url&choe=UTF-8&chld";

// $qrcode = imagecreatefrompng(file_get_contents($qrurl));
// print_r($qrcode);
$image=file_get_contents($qrurl);
$qrname=rand(11111111,999999999).'_'.str_shuffle('abcdefghizxczx').'_'.time();
file_put_contents('./assets/images/qrcodes/'.$qrname.'.png', $image);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPI Payment</title>
      <link rel="icon" href="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
body{
   background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
}
.container{
    width:100%;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}
</style>
</head>
  <body>
   <div class="container">
   <div class="p-3 rounded shadow bg-white">
    <div class="d-flex gap-2 align-items-center justify-content-center">
<img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" height="70px" />
<div class="border-start border-dark border-2 px-2">
<h5><?=$this->db->get('system')->row()->brand_name?></h2>
<h5 class="fw-bold">UPI PAYMENT</h2>

</div>
</div>


<img src="<?=base_url('assets/images/qrcodes/'.$qrname.'.png')?>" width="300px" height="300px" />
	   <div class="text-center small">Please Scan The QR Code Using Any UPI<br> App & Add ₹ <?=$_SESSION['addamount']?> In Your Wallet Instantly</div>
      <div class="text-center mt-1"> <a href="<?=base_url('user/verifypayment')?>" class="btn btn-danger btn-sm w-75 mx-auto">Cancel Payment</a> </div>

<div class="d-flex justify-content-evenly">
<a href="upi://pay?pa=7838403916@paytm&am=10&mam=1&cu=INR&tr=989565897889&tn=thisistest"><img src="<?=base_url('assets/images/upi.png?')?>" height="40px" /></a>
<a href="<?=str_replace('upi://','paytmmp://',$url2)?>"><img src="<?=base_url('assets/images/paytm.png?')?>" height="40px" /></a>
<a href="<?=str_replace('upi://','phonepe://',$url2)?>"><img src="<?=base_url('assets/images/phonepe.png?')?>" height="40px" /></a>
<a href="<?=str_replace('upi://','tez://upi',$url2)?>"><img src="<?=base_url('assets/images/gpay.png?')?>" height="40px" /></a>

</div>

<hr>
<div id="paymentpendingmsg">
<div class="text-center fs-5 d-flex align-items-center justify-content-center gap-2 fw-bold text-secondary">
<img src="<?=base_url('assets/images/loading.gif')?>" height="30px"/> Waiting for Payment
</div>
</div>
<div id="paymentsuccessmsg" style="display:none">
<div class="text-center fs-5 d-flex align-items-center justify-content-center gap-2 fw-bold text-secondary">
<i class="bi bi-patch-check-fill text-success"></i> Payment Successfull
</div>
</div>
   </div>
   </div>

   <div id="loading" style="display:none;top:0;bottom:0;z-index:+99999999999999999999;position:fixed">
<div style="color:white;display:flex;flex-direction:column;justify-content:center;align-items:center;height:100vh;width:100vw;background-color:rgba(0,0,0,0.8)">
<img src="<?=base_url('assets/images/loading.gif')?>" width="50"/>
<h5>please do not refresh or close this window</h5>
</div>
</div>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script>

    var done=false;
$(function () {

    function verifypayment(){
        if(done) return;
$.ajax({
    method:'post',
    url:'<?=base_url('user/verifyupipayment')?>',
    dataType:'json',
    success:function(res){
if(res.status=='success'){
done=true;
    $("#paymentpendingmsg").hide();
    $("#paymentsuccessmsg").show();

   window.location.href='<?=base_url('user/wallet')?>';
   $("#loading").show();
}
setTimeout(() => {
    verifypayment();
}, 1000);

    },
    error:function(res){
        console.log(res);
        alert('something went wrong, please contact administrator')
    }
})
    }

verifypayment();
});

    </script>
  </body>
</html>