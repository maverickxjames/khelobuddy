
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Withdraws Requests</h5>
<form>
<div class="input-group mb-3">
  <input type="number" class="form-control" name="search" value="<?=@$_GET['search']?>" placeholder="enter user mobile no"  aria-describedby="button-addon2">
  <button type="submit" class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i> Search</button>
</div>
</form>
<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">User</th>
<th class="text-nowrap fw-bold">Req Id</th>
<th class="text-nowrap fw-bold">Method</th>
<th class="text-nowrap fw-bold">UPI Id/Ac No</th>
<th class="text-nowrap fw-bold">Amount</th>
<th class="text-nowrap fw-bold">Requested On</th>
<th class="text-nowrap fw-bold">Status</th>

</tr>
</thead>
<tbody>
<?php
if(!$withdraws){
  ?>
  <tr><td colspan="8">
<p class="text-center">No Withdraws Found</p>
</td></tr>
  <?php
}
$count=1;

foreach($withdraws as $user){
         $kyc=$this->db->where('user_id',$user->id)->get('kycs')->row();
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <p class=" m-0"><a href="<?=base_url('admin/user/'.$user->uid)?>" class="text-decoration-none showloading"><?=$user->username?> <small>(<?=$user->mobile_no?>)</small></a></p>
      <!--<?=$user->bank_ifsc_code?>-->
    <small>Reward Wallet Balance : ₹ <?=number_format($fn->getRewardBalance($user->uid))?></small>
  </td>

  <td class="text-nowrap">
    <p class="m-0"><?=$user->req_id?></p>
    <?php
    if($user->txn_id){
    ?>
    <p style="color: red" class="m-0"><b>SUBMITTED</b></p>
    <?php
    }
    ?>
  </td>
  <td class="text-nowrap">
    <p class="m-0"><?=$user->upi_app?></p>
  </td>
  <td>
    <?php
if($user->upi_app=='Bank'){
  ?>
<p class="m-0 small ">Ac No : <?=$user->bank_ac_no?></p>
<p class="m-0" style="font-size:13px"><?=$user->name?> | <?=$user->bank_ifsc_code?></p>

<?php

}else{
  echo $user->upi_mobile;
}
    ?>

</td>
   <td class="text-nowrap">
    <p class="m-0"><?=number_format($user->amount)?> Rs</p>
  </td>
    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$user->created_at)?>
    </td>
    <td class="text-wrap">
        <?php
if($user->status==2){
    ?>
<button class="btn btn-sm btn-success text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addnewgame<?=$user->id?>"><i class="bi bi-check2"></i> Mark As Completed</button>
 
<div class="modal fade" id="addnewgame<?=$user->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Mark Withdraw Request as Done</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/markasdonef/'.$user->id)?>
      <div class="modal-body">
<table class="table">
    <tr>
        <td>Method</td><td>:</td><td><?=$user->upi_app?></td>
    </tr>
    <?php
if($user->upi_app=='Bank'){
  ?>
 <tr>
        <td>Name</td><td>:</td><td><?=$user->name?></td>
    </tr>
     <tr>
        <td>IFSC Code</td><td>:</td><td><?=$user->bank_ifsc_code?></td>
    </tr>
    <tr>
        <td>Account No</td><td>:</td><td><?=$user->bank_ac_no?></td>
    </tr>
  <?php
}else{
  ?>
 <tr>
        <td>UPI Id/Mobile</td><td>:</td><td><?=$user->upi_mobile?></td>
    </tr>
  <?php
}
    ?>
    
     <tr>
        <td>Amount</td><td>:</td><td><?=$user->amount?> Rs</td>
    </tr>
</table>
     

    <div class="my-3">
    <label for="" class="form-label">Transection Details</label>
    <textarea type="text" class="form-control" id="" name="reason" placeholder='for example txnid or utr' required></textarea>
  </div>

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-white">Mark As Completed</button>


      </div>
      </form>
    </div>
  </div>
</div>


<a href="<?=base_url('admin/automarkasdone/'.$user->id)?>" class="showloading btn btn-danger btn-sm text-white"><i class="bi bi-check2"></i>  PROCESS</a>
<a href="<?=base_url('admin/pstatus/'.$user->id)?>" class="showloading btn btn-danger btn-sm text-white"><i class="bi bi-trash3"></i> status</a>


<button class="btn btn-sm btn-danger text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addnewgamer<?=$user->id?>"><i class="bi bi-x-lg"></i> Reject</button>


<div class="modal fade" id="addnewgamer<?=$user->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Reject Withdraw Request</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/rejectwf/'.$user->id)?>
      <div class="modal-body">
<table class="table">
    <tr>
        <td>Method</td><td>:</td><td><?=$user->upi_app?></td>
    </tr>
     <?php
if($user->upi_app=='Bank'){
  ?>
 <tr>
        <td>Name</td><td>:</td><td><?=$user->name?></td>
    </tr>
     <tr>
        <td>IFSC Code</td><td>:</td><td><?=$user->bank_ifsc_code?></td>
    </tr>
    <tr>
        <td>Account No</td><td>:</td><td><?=$user->bank_ac_no?></td>
    </tr>
  <?php
}else{
  ?>
 <tr>
        <td>UPI Id/Mobile</td><td>:</td><td><?=$user->upi_mobile?></td>
    </tr>
  <?php
}
    ?>
     <tr>
        <td>Amount</td><td>:</td><td><?=$user->amount?> Rs</td>
    </tr>
</table>
     

    <div class="my-3">
    <label for="" class="form-label">Reason</label>
    <textarea type="text" class="form-control" id="" name="reason" placeholder='enter reason for rejection' required></textarea>
  </div>

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger text-white">Reject Withdrawal Request</button>


      </div>
      </form>
    </div>
  </div>
</div>
    <?php
}elseif($user->status==0){
    ?>
<button class="btn btn-sm text-danger m-0 p-0" title="<?=$user->reason?>"><i class="bi bi-exclamation-circle"></i> Request Rejected</button>
    <?php
}else{
    ?>
<button class="btn btn-sm text-success m-0 p-0" title="<?=$user->reason?>"><i class="bi bi-check2-all"></i> Money Transfered</button>
    <?php
}
        ?>
   <div style="font-size:15px;text-align:center" class="text-muted">
<small><?=$user->reason?></small>
</div>
    
    </td>
  
  

</tr>
    <?php
    $count++;
}
?>
</tbody>
</table>
</div>


</div>
</div>