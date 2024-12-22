<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<div class="d-flex justify-content-between align-items-center">
<h5>User Details</h5>
<button onclick="history.back()" class="btn btn-sm btn-outline-primary showloading">Go Back</button>
</div>
<hr>
    <div class="d-flex justify-content-between col-12 border-bottom pb-2">
<div class="d-flex">
    <img src="<?=base_url('assets/images/avatars/'.$player->avatar)?>" id="directorprofile" class="shadow-sm rounded-circle" width="90px" height="90px"/><br>
   <div class="mx-2">
   <p class="fw-bold m-0"><?=$player->full_name?></p>
    <p class="m-0 small"><b>Username :</b> @<?=$player->username?></p>

     <p class="m-0 small"><b>Mobile No :</b> <?=$player->mobile_no?></p>
     <p class="m-0 small"><b>KYC :</b> <?php
     
     if($kyc){
      $info = json_decode($kyc->kycdata);
?>
<a href="" class="text-decoration-none" data-coreui-toggle="modal" data-coreui-target="#kyc<?=$player->id?>">View KYC Details<a/>
<!-- delete center mdoal start -->

<div class="modal fade" id="kyc<?=$player->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">KYC Details</h5>
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
<div class="fs-5 fw-bold"><i class="bi bi-fingerprint"></i> <?=$kyc->aadhar_no?></div>
  <div class="fs-6 mt-2 d-flex gap-3 flex-wrap"> <img src="<?=base_url('assets/images/kyc/'.$kyc->aadhar_front)?>" style="height:150px"/> <img src="<?=base_url('assets/images/kyc/'.$kyc->aadhar_back)?>" style="height:150px"/></div>


  <?php
}
?>
     
</div>
    
    </div>
  </div>
</div>

<!-- delete center modal ends  -->
<?php
     }else{
      echo "Pending";
     }
     ?></p>

</div>
  </div>  

 
 

</div>
<div class="d-flex justify-content-end gap-2 my-2">
  <a href="<?=base_url('user/loginasuser/'.$player->id)?>" target="_blank" class="btn btn-sm btn-success text-white text-nowrap"><i class="bi bi-box-arrow-in-right"></i> Login</a>
<button class="btn btn-sm btn-success text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#deletecenter<?=$player->id?>"><i class="bi bi-currency-rupee"></i> Add Funds</button>
<button class="btn btn-sm btn-success text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#treward<?=$player->id?>"><i class="bi bi-currency-rupee"></i> Add to reward</button>
<button class="btn btn-sm btn-danger text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addp<?=$player->id?>"><i class="bi bi-currency-rupee"></i> Add Panalty</button>
<button class="btn btn-sm btn-danger text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#dmoney<?=$player->id?>"><i class="bi bi-currency-rupee"></i> Debit Money</button>
<?php
if($player->status==3){
?>
<a href="<?=base_url('admin/unbanuser/'.$player->id)?>" class="btn btn-sm btn-dark text-white showloading"><i class="bi bi-person-check-fill"></i> Unban User</a>
<?php
}else{
  ?>
<a href="<?=base_url('admin/banuser/'.$player->id)?>" class="btn btn-sm btn-danger text-white showloading"><i class="bi bi-person-fill-slash"></i> Ban User</a>
  <?php
}
?>


</div>
<!-- delete center mdoal start -->

<div class="modal fade" id="deletecenter<?=$player->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Funds</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/addfunds/'.$player->id)?>
      <div class="modal-body">

      <div class=" my-1">
    <label for="" class="form-label">Amount<sup class="text-danger">*</sup></label>
    <input type="number" class="form-control" id="" name="amount" placeholder='enter the amount here..' required>
  </div>
    
<div class=" my-1">
    <label for="" class="form-label">Reason<sup class="text-danger">*</sup></label>
    <select name="reason" class="form-select">
      <option>Added Money</option>
      <option>Referral Bonus</option>
      <option>Bonus</option>
      <option>Added by Admin</option>
    </select>
  </div>

  

      </div>
      <div class="modal-footer">
     
        <input type="hidden" name="student_id" value="<?=$player->id?>" />
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success text-white">Add Transaction</button>


      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="treward<?=$player->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">transfer to reward</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/tranferfunds/'.$player->id)?>
      <div class="modal-body">

      <div class=" my-1">
    <label for="" class="form-label">Amount<sup class="text-danger">*</sup></label>
    <input type="number" class="form-control" id="" name="amount" placeholder='enter the amount here..' required>
  </div>
    
<div class=" my-1">
    <label for="" class="form-label">Reason<sup class="text-danger">*</sup></label>
    <select name="reason" class="form-select">
      <option>game cancel</option>
      <option>Referral Bonus</option>
      <option>Bonus</option>
      <option>Added by Admin</option>
    </select>
  </div>

  

      </div>
      <div class="modal-footer">
     
        <input type="hidden" name="student_id" value="<?=$player->id?>" />
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success text-white">Add Transaction</button>


      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addp<?=$player->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Penalty</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/addpenalty/'.$player->id)?>
      <div class="modal-body">

      <div class=" my-1">
    <label for="" class="form-label">Amount<sup class="text-danger">*</sup></label>
    <input type="number" class="form-control" id="" name="amount" placeholder='enter the amount here..' required>
  </div>

<div class=" my-1">
    <label for="" class="form-label">Reason<sup class="text-danger">*</sup></label>
    <select name="reason" class="form-select">
      <option>Wrong update (Penalty)</option>
      <option>Running game cancel (Penalty)</option>
      <option>Fraud (Penalty)</option>
      <option>penalty by Admin (Penalty)</option>
    </select>
  </div>

      </div>
      <div class="modal-footer">
     
        <input type="hidden" name="student_id" value="<?=$player->id?>" />
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success text-white">Add Transaction</button>


      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="dmoney<?=$player->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Debit Money</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/minusfunds/'.$player->id)?>
      <div class="modal-body">

      <div class=" my-1">
    <label for="" class="form-label">Amount<sup class="text-danger">*</sup></label>
    <input type="number" class="form-control" id="" name="amount" placeholder='enter the amount here..' required>
  </div>
    


  

      </div>
      <div class="modal-footer">
     
        <input type="hidden" name="student_id" value="<?=$player->id?>" />
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success text-white">Add Transaction</button>


      </div>
      </form>
    </div>
  </div>
</div>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-coreui-toggle="tab" data-coreui-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Transactions</button>
    
    <button class="nav-link" id="nav-profile-tab" data-coreui-toggle="tab" data-coreui-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Matches</button>
    <button class="nav-link" id="nav-contact-tab" data-coreui-toggle="tab" data-coreui-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Account</button>
  



  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <div class=" mt-3">
<table class="table datatable1 dt-responsive">
<thead class="">
    <tr>
<th class="text-nowrap">Txn. Id</th>
<th class="text-nowrap">Amount</th>
<th class="text-nowrap">Remarks</th>
<th class="text-nowrap">Date & Time</th>
<th class="text-nowrap">Related Match</th>
<th class="text-nowrap">TAG</th>

</tr>
</thead>
<tbody>
<?php
if($txns){
    foreach($txns as $txn){
?>
<tr <?php
if($txn->type=='DEBIT'){
  ?>
style="background-color:rgba(256,0,0,0.05)"
  <?php
}else{ ?>
  style="background-color:rgba(0,256,0,0.05)"
<?php }
?>
>
<td  class="text-nowrap"><?=$txn->order_id?></td>
<td  class="text-nowrap"><?=($txn->type=='DEBIT'?'-':'+')?> ₹ <?=number_format($txn->amount)?></td>

<td  class="text-nowrap"><?=$txn->reason?>

<?php
if($txn->utr=='Admin'){
  ?>
(By Admin)
  <?php
}
?>
</td>
<td  class="text-nowrap"><?=date("d M Y, h:i A",$txn->created_at)?></td>
<td  class="text-nowrap"><?php
if($txn->match_id){
?>
<a href="<?=base_url('admin/match/'.$txn->match_id)?>" class="text-decoration-none showloading">Match Id : #MID<?=$txn->match_id+1427?></a>
<?php
}
?></td>
<td  class="text-nowrap"><?=$txn->ctg?></td>

    </tr>



<?php
    }

}else{
    ?>
<td colspan="6" class="text-center">No Transactions !</td>
    <?php
}
?>
</tbody>
</table>
</div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
     <div class="table-responsive mt-3">
<table class="table datatable2 dt-responsive">
<thead class="">
    <tr>
<th class="text-nowrap">Match Id</th>
<th class="text-nowrap">Host</th>
<th class="text-nowrap">Joiner</th>
<th class="text-nowrap">Room Code</th>
<th class="text-nowrap">Winner</th>
<th class="text-nowrap">Amount</th>
<th class="text-nowrap">Date & Time</th>
<th class="text-nowrap">Status</th>

</tr>
</thead>
<tbody>
<?php
if($matches){
    foreach($matches as $match){
        $host = $this->db->where('id',$match->host_id)->get('users')->row();
              $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();
              $winner= $this->db->where('id',$match->winner)->get('users')->row();

?>
<tr>
<td  class="text-nowrap">#MID<?=$match->id+1427?></td>
<td  class="text-nowrap"><?=$host->username?> <small>(<?=($host->id==$player->id)?'this user':$host->mobile_no?>)</small></td>

<td  class="text-nowrap"><?=$joiner->username??'none'?> <?php
if($joiner){
  ?>
<small>(<?=($joiner->id==$player->id)?'this user':$joiner->mobile_no?>)</small>

  <?php
}

?>
</td>
<td  class="text-nowrap"><?=$match->room_code==0?'none':$match->room_code?></td>
<td  class="text-nowrap"> <?=$winner?$winner->username:'none'?></td>

<td  class="text-nowrap">₹ <?=number_format($match->amount)?></td>


<td  class="text-nowrap"><?=date("d M Y, h:i A",$match->created_at)?></td>
<td  class="text-nowrap"><?php
if($match->status==1){
?>
<a href="<?=base_url('admin/match/'.$match->id)?>" class="text-decoration-none showloading text-success">Open (View Info)</a>
<?php
}else{
  ?>
<a href="<?=base_url('admin/match/'.$match->id)?>" class="text-decoration-none showloading text-danger">Closed (View Info)</a>
  <?php
}
?></td>


    </tr>



<?php
    }

}else{
    ?>
<td colspan="8" class="text-center">No Matches !</td>
    <?php
}
?>
</tbody>
</table>
</div>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
    <table class="table table-striped">
<tr>
<td class="text-nowrap w-0" style="width:0px">Refferal Code</td><td style="width:0px">:</td><td><?=$player->code?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Reffered By</td><td style="width:0px">:</td><td><?=$ref?$ref->username.'('.$ref->code.')':'none'?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Wallet Balance</td><td>:</td><td>₹ <?=number_format($balance)?></td>
</tr>
<tr>
<td class="text-nowrap w-0">Reward Balance</td><td>:</td><td>₹ <?=number_format($pbalance)?></td>
</tr>
<tr>
<td class="text-nowrap w-0">Games Played</td><td>:</td><td><?=$totalgamesplayed?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Winning Earnings</td><td>:</td><td>₹ <?=number_format($totalwinnings)?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Referral Earnings</td><td>:</td><td>₹ <?=number_format($totalreferralearnings)?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Penalty</td><td>:</td><td>₹ <?=number_format($penalty)?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Total Deposits</td><td>:</td><td>₹ <?=number_format($deposits)?></td>
</tr>

<tr>
<td class="text-nowrap w-0">Total Withdraws</td><td>:</td><td>₹ <?=number_format($withdraws)?></td>
</tr>
    </table>
  </div>
</div>
<!-- delete center modal ends  -->



</div>