<style>
.bgy{
  background-color: #FBAB7E;
background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);

}
  </style>
<div class="mt-3 mx-2 p-2">

<div class="card bgy text-dark p-3">
	<div class="d-flex align-items-center justify-content-between gap-3">
<div class="" style="font-size:60px">
<img src="<?=base_url('assets/images/wallet.png')?>" width="80"/>
</div>
<div class="text-end">	
<h1 class="m-0" style="font-size:35px">₹ <?=number_format(@$balance)?></h1>
<span style="font-size:15px">Available Balance</span>
</div>

</div>

</div>
	


<div class="card my-3" id="">
  <div class="card-header text-center">
   Deposit Money
  </div>
  <div class="card-body">
    <div class="mb-1">Amount</div>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-currency-rupee"></i></span>
  <input type="number" class="form-control" placeholder="" id="damount" aria-label="" aria-describedby="basic-addon1">
</div>
<div class="d-flex gap-2 justify-content-between mb-2">
<button class="btn btn-sm btn-warning money text-nowrap">₹ 50</button>
<button class="btn btn-sm btn-warning money text-nowrap">₹ 100</button>
<button class="btn btn-sm btn-warning money text-nowrap">₹ 200</button>
<button class="btn btn-sm btn-warning money text-nowrap">₹ 500</button>
<button class="btn btn-sm btn-warning money text-nowrap">₹ 1000</button>




</div>
    <button href="#" class="btn w-100 btn-dark my-2" id="addmoney_btn" >ADD MONEY</button>


<div class="text-center">
<div class="text-danger mt-1 small"><b>Note:</b> <?=$this->db->get('messages')->row()->on_add_money?></div>
<!--<a href="https://api.whatsapp.com/send?phone=<?=$this->db->get('system')->row()->whatsapp?>" class="btn text-white mb-3 mt-2 btn-sm mx-auto" target="_blank" style="background-color:#1EBEA5">-->
<!--<span><i class="bi bi-whatsapp"></i> <?=$this->db->get('system')->row()->whatsapp?></span>-->
<!--</a>-->
<!--<a href="http://t.me/TERA_LUDO" class="btn text-white mb-3 mt-2 btn-sm mx-auto" target="_blank" style="background-color:#24A1DE">-->
<!--<span><i class="bi bi-telegram"></i> telegram</span>-->
<!--</a>-->
<!--<a href="tel: +918062181394" class="btn text-white mb-3 mt-2 btn-sm mx-auto" target="_blank" style="background-color:#1EBEA5">-->
<!--<span><i class="bi bi-phone"></i> 8062181394</span>-->
<!--</a>-->
<a href="<?=$this->db->get('system')->row()->instagram?>" class="btn text-white instagram text-start justify-content-between" target="_blank">
    
  <span> <i class="bi bi-instagram"></i> Instagram</span>
  </a>
</div>
  </div>
  <div class="text-center">
      <!--<a href="upi://pay?pa=sonu464@paytm" class="btn text-white mb-3 mt-2 btn-sm mx-auto" style="background-color:#1EBEA5"><span>2000 se bada deposit yha hoga</span></a>-->
      <!--<img src="<?=base_url('assets/QR.jpeg')?>" width="300">-->
      <p> Address No.-1 House no 287 Pratap Nagar Sanganer Thana Jaipur </p>
       <p>Pincode: 302029</p>
      
      
      <!--<p>auto deposit ke liye payment successfull hone ke baad ok pe click kre(niche di gyi video puri dekhe)</p>-->
<!--    <video width="320" height="240" controls>-->
  <!--<source src="<?=base_url('assets/deposit.mp4')?>" type="video/mp4">-->
<!--</video>-->
</div>
</div>


