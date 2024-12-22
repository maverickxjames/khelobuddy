
<div class="mt-3 py-2">


	

<div class="card my-3" id="">
  <div class="card-header text-center">
   Withdraw Money
  </div>
  <div class="card-body">
  <div class="d-flex justify-content-between align-items-center mb-3">
  <button class="btn btn-success btn-sm">Balance : <b>₹ <?=number_format(@$pbalance)?></b></button>
  <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#transfer"><i class="bi bi-wallet2"></i> Transfer To Wallet</a>

  <div class="modal fade" id="transfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Transfer Rewards To Wallet</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method='post' class="showloadingform" action="<?=base_url('user/transfertowallet')?>">
           <div class="mb-1">Enter Amount</div>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-currency-rupee"></i></span>
  <input type="number" class="form-control" placeholder=""  name="amount" aria-label="" aria-describedby="basic-addon1" required>
</div>

          <div class="text-end">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-sm">Transfer Reward</button>
</form>
      </div>
      </div>
    
    </div>

    
  </div>
</div>
</div>

<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-tablet"></i></span>
  <select class="form-select" id="upiapp">
<option>Paytm</option>
<option>Google Pay</option>
<option>PhonePe</option>
<option>Bank</option>
  </select>

</div>

    <div class="input-group mb-3 nonbank">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-bank"></i></span>
  <input type="text" class="form-control" placeholder="UPI ID / Mobile Number" id="upi" aria-label="" aria-describedby="basic-addon1">
</div>

  <div class="input-group mb-3 bank" style="display:none">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
  <input type="text" class="form-control" placeholder="Full Name In Bank" id="name_in_bank" aria-label="" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3 bank" style="display:none">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-bank"></i></span>
  <input type="text" class="form-control" placeholder="Bank IFSC Code" id="bank_ifsc_code" aria-label="" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3 bank" style="display:none">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-safe2"></i></span>
  <input type="number" class="form-control" placeholder="Bank Account Number" id="bank_ac_no" aria-label="" aria-describedby="basic-addon1">
</div>



    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="bi bi-currency-rupee"></i></span>
  <input type="number" class="form-control" placeholder="Amount" id="wamount" aria-label="" aria-describedby="basic-addon1">
</div>
<div class="small text-success">Minimum Withdraw : ₹ <?=$this->db->get('system')->row()->minimum_withdraw?></div>
    <button href="#" class="btn w-100 btn-warning my-2" id="wmoney_btn" >WITHDRAW MONEY</button>
<div class="text-dark mt-1 small"><b>Note:</b> <?=$this->db->get('messages')->row()->on_withdraw_money?></div>
  </div>
</div>


</div>


<div class="card" id="">
  <div class="card-header text-center">
   Withdraws History
  </div>
  
  <div class="card-body">

<?php
if(!$txns){
?>
<p class="text-center small text-secondary mt-3">No Withdraws Available</p>
<?php
}
foreach($txns as $txn){
    ?>
<div class="py-2 border-bottom d-flex justify-content-between">
<div> 
  <?php
if($txn->upi_app=='Bank'){
?>
<p class="m-0 small fw-bold">BANK : <?=$txn->bank_ac_no?></p>
<p class="m-0" style="font-size:11px"><?=$txn->name?> | <?=$txn->bank_ifsc_code?></p>
<?php
}else{
?>
<p class="m-0 small fw-bold"><?=strtoupper($txn->upi_app)?> : <?=$txn->upi_mobile?></p>
<?php
}
  ?>

<p class="m-0 small">Req Id : <?=$txn->req_id?></p>
<p class="m-0" style="font-size:11px"><?=date('d M Y, h:i a',$txn->created_at)?></p>
</div>
<div class="mx-1">

</div>
<div class="d-flex justify-content-start gap-2 flex-column align-items-end">

<p class="text-success fw-bold m-0 text-nowrap">₹ <?=number_format($txn->amount)?></p>
  

<?php
if($txn->status==0){
?>
<span class="badge bg-danger p-1" style="font-size:10px"><i class="bi bi-emoji-frown"></i> Rejected</span>
<?php
}elseif($txn->status==1){
?>
<span class="badge bg-success p-1" style="font-size:10px"><i class="bi bi-check2"></i> Completed</span>
<?php
}else{
?>
<span class="badge bg-warning p-1 text-dark" style="font-size:10px"><i class="bi bi-clock-history"></i> In Process</span>
<?php
}
?>

</div>
</div>

    <?php
}
?>   


<!-- </div>
    <button href="#" class="btn w-100 btn-primary my-2" id="loadmore-btn" >SHOW MORE</button>

  </div> -->
</div>

</div>
