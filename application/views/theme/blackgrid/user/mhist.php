
<div class="mt-3 mx-2 p-2">



<div class="card" id="">
  <div class="card-header text-center">
   Match History
  </div>
  <div class="card-body">

<?php
if(!$txns){
?>
<p class="text-center small text-secondary mt-3">No Matches played</p>
<?php
}
foreach($txns as $txn){
    ?>
<div class="py-2 border-bottom d-flex justify-content-between">
<div>
<p class="m-0 small fw-bold">MID# <?=$txn->id+1427?></p>
<?php
if($txn->room_code){
?>
<p class="m-0 small">Roomcode : <?=$txn->room_code?></p>
<?php
}
    ?>
<p class="m-0" style="font-size:11px"><?=date('d M Y, h:i a',$txn->created_at)?></p>
</div>
<div class="mx-1">

</div>
<div class="d-flex justify-content-start gap-2 flex-column align-items-end">
<?php
if($txn->winner==$user->id){
    ?>
<p class="text-success fw-bold m-0 text-nowrap">+ ₹ <?=($txn->amount)?></p>
    <?php
}else if($txn->looser==$user->id){
    ?>
<p class="text-danger fw-bold m-0 text-nowrap">- ₹ <?=($txn->amount)?></p>
    <?php
}
else{
?>
<p class="fw-bold m-0 text-nowrap">Canceled</p>
    <?php
}
?>
<!-- <?php
if($txn->status==0){
?>
<span class="badge bg-warning text-dark p-1" style="font-size:10px"><i class="bi bi-clock"></i> Pending</span>
<?php
}elseif($txn->status==1){
?>
<span class="badge bg-success p-1" style="font-size:10px"><i class="bi bi-check2"></i> Done</span>
<?php
}else{
?>
<span class="badge bg-warning p-1" style="font-size:10px"><i class="bi bi-shield-exclamation"></i> In Review</span>
<?php
}
?> -->

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
