
<div class="mx-2 mt-1 p-2">


	


<div class="card" >
  <div class="card-header text-center">
   Match Details
  </div>
  <div class="card-body">

  <?php
if($this->db->get('messages')->row()->on_match_screen_top){
  ?>
<div class="alert alert-danger my-2" style="font-size:13.5px" role="alert">
<?=$this->db->get('messages')->row()->on_match_screen_top?>
</div>
  <?php
}
  ?>
 <?php 
if(!$match->room_code){
  ?>
<div id="timer" class="badge bg-danger fs-2"></div><br>
<small class="text-danger">note: if no room code entered before the timer ends, game will cancel automatically</small>
  <?php
}
 ?>
   <div class="fs-4 fw-bold"><?=$game->game_name?></div>
   <div class="fs-6 my-1"><i class="bi bi-cash-coin"></i> Playing Amount : ₹ <?=$match->amount?></div>
   <div class="fs-6 my-1"><i class="bi bi-trophy"></i> Winning Amount : ₹ <?=$reward?></div>
   <div class="fs-6 my-1">Match Id : <b>#MID<?=$match->id+1427?></b></div>

 
  <?php
if($this->db->get('messages')->row()->on_match_screen_middle){
  ?>
<div class="alert alert-dark my-2" style="font-size:13.5px" role="alert">
<?=$this->db->get('messages')->row()->on_match_screen_middle?>
</div>
  <?php
}
  ?>

<?php
if($game->instructions!=''){
    ?>
<div class="alert alert-warning my-2" style="font-size:13.5px" role="alert">
<?=$game->instructions?>
</div>
    <?php
}
?>


<div class="card">
 <div class="card-body">
    <div class="d-flex justify-content-between">
         <div class="text-center">
<img src="<?=base_url('assets/images/avatars/'.$host->avatar)?>" width="40px" height="40px" style="" class="rounded-circle border border-primary border-2 shadow"/>
<div class="fw-bold" style="font-size:12px">
<?php
if($user->username==$host->username){
    echo "You";
}else{
    echo '@'.$host->username;
}
?>
</div>

<div>
<?php
if($match->winner==$host->id){
    ?>
<span class="badge small bg-secondary small"> Result Submitted</span>
    <?php
}
?>
</div>
<div>
<?php
if($match->looser==$host->id){
    ?>
<span class="badge small bg-secondary small"> Result Submitted</span>
    <?php
}
?>
</div>


</div>

<div class="d-flex align-items-center">
<img src="<?=base_url('assets/images/vs.png')?>" height="30px" />
</div>
        <div class="text-center">
            <?php
if($match->joiner_id){
    $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();
?>
<img src="<?=base_url('assets/images/avatars/'.$joiner->avatar)?>" width="40px" height="40px" class="rounded-circle border border-danger border-2 shadow"/>
<div class="fw-bold" style="font-size:12px"><?php
if($user->username==$joiner->username){
    echo "You";
}else{
    echo '@'.$joiner->username;
}
?></div>

<div>
<?php
if($match->winner==$joiner->id){
    ?>
<span class="badge small bg-secondary small"> Result Submitted</span>
    <?php
}
?>
</div>
<div>
<?php
if($match->looser==$joiner->id){
    ?>
<span class="badge small bg-secondary small"> Result Submitted</span>
    <?php
}
?>
</div>

<?php
}else{
    ?>
 <img src="<?=base_url('assets/images/loading.gif')?>" width="40px" height="40px" class=""/>
 <div class="fw-bold" style="font-size:12px">waiting..</div>
    <?php
}
            ?>


</div>


    </div>
   
 
</div>
</div>


<?php
if($match->room_code==0 && $host->id==$user->id){
?>
<div class="input-group my-3">
  <input type="number" class="form-control form-control-sm" placeholder="room code" id="roomcode" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <button class="btn btn-sm btn-primary" id="updateroomcode-btn">Update</button>
</div>
<?php
}else{
    ?>
<div class="alert alert-success my-2" role="alert">
 <span class="fw-bold">Room Code : </span><span id="roomcodeid"><?=$match->room_code?$match->room_code:'waiting for update...'?></span> 
</div>

    <?php
}
?>

<?php
if($match->room_code){
    ?>
<button class="btn btn-primary btn-sm w-100 fw-bold my-1" onClick="copyreflink('roomcodeid');"><i class="bi bi-files"></i> Copy Room Code</button>
<div class="d-flex">
<?php
if($match->winner!=$user->id && $match->looser!=$user->id){
    ?>
<a href="" class="btn btn-success btn-sm  rounded-0 w-100 fw-bold my-1"  data-bs-toggle="offcanvas" data-bs-target="#winscreenshot"><i class="bi bi-hand-thumbs-up"></i> I Won The Match</a>

   <div class="offcanvas offcanvas-bottom" style="height:50vh" tabindex="-1" id="winscreenshot" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Upload Screenshot</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <form method="post" enctype="multipart/form-data" action="<?=base_url('user/iwon/'.$match->id)?>" class="showloadingform">
<div class="mb-3">
  <label for="formFileSm" class="form-label">Game Result Screenshot</label>
  <input class="form-control form-control-sm" id="formFileSm" name="screenshot" type="file" required>
</div>
<p class="text-danger small"><b>Note:</b> <?=$this->db->get('messages')->row()->on_win_pop_up?></p>
<button type="submit" class="btn btn-sm btn-success w-100">Submit Result As Winner</button>
</form>
  </div>
</div>
   
   <?php
}
?>
<?php
if($match->winner!=$user->id && $match->looser!=$user->id){
    ?>
<a href="" class="btn btn-danger btn-sm  rounded-0 w-100 fw-bold my-1"  data-bs-toggle="offcanvas" data-bs-target="#losescreenshot"><i class="bi bi-hand-thumbs-down"></i> I Lost The Match</a>

   <div class="offcanvas offcanvas-bottom" style="height:50vh" tabindex="-1" id="losescreenshot" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Submit Result</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <form method="post" enctype="multipart/form-data" action="<?=base_url('user/ilost/'.$match->id)?>" class="showloadingform">

<p class="text-danger small"><b>Note:</b> <?=$this->db->get('messages')->row()->on_lose_pop_up?></p>
<button type="submit" class="btn btn-sm btn-danger w-100">Submit Result As Looser</button>
</form>
  </div>
</div>
    <?php
}
?>

</div>

    <?php
}
?>

<a href="" class="btn btn-warning btn-sm  w-100 fw-bold my-1"  data-bs-toggle="offcanvas" data-bs-target="#cancel"><i class="bi bi-x-circle"></i> Request Cancellation</a>

<!-- <a href="" class="btn btn-warning btn-sm  w-100 fw-bold my-1"  data-bs-toggle="offcanvas" data-bs-target="#c"> Opponent Submitted Wrong Result</a> -->

   <div class="offcanvas offcanvas-bottom" style="height:50vh" tabindex="-1" id="c" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Report Wrong Result Update</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <form method="post" enctype="multipart/form-data" action="<?=base_url('user/cc/'.$match->id)?>" class="showloadingform">
<div class="mb-3">
  <label for="formFileSm" class="form-label">Your Result Screenshot</label>
  <input class="form-control form-control-sm" id="formFileSm" name="screenshot" type="file" required>
</div>
<p class="text-danger small"><b>Note:</b> <?=$this->db->get('messages')->row()->on_conflict_pop_up?></p>
<button type="submit" class="btn btn-sm btn-primary w-100">Submit Conflict Request</button>
</form>
  </div>
</div>
   



   <div class="offcanvas offcanvas-bottom" style="height:50vh" tabindex="-1" id="cancel" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Request Cancellation</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
 
  <p>Please select the reason for cancellation</p>
  <div class="d-flex flex-wrap gap-2 justify-content-center">
  <button class="btn btn-primary btn-sm creason px-3" style="border-radius:15px">No Room Code</button>
  <button type="button" class="btn btn-outline-primary btn-sm creason px-3" style="border-radius:15px">Other Player Not Joined</button>
  <button type="button" class="btn btn-outline-primary btn-sm creason px-3" style="border-radius:15px">Other Player Not Playing</button>
  <button type="button" class="btn btn-outline-primary btn-sm creason px-3" style="border-radius:15px">I Don't want to Play</button>
  <button type="button" class="btn btn-outline-primary btn-sm creason px-3" style="border-radius:15px">Opponent Abusing</button>
  <button type="button" class="btn btn-outline-primary btn-sm creason px-3" style="border-radius:15px">Room Code Not Working</button>
</div>


 <form method="post" enctype="multipart/form-data" action="<?=base_url('user/reqcancel/'.$match->id)?>" class="showloadingform">

<input type="hidden" id="creason" class="form-select my-3" name="reason" value="No Room Code">


<button type="submit" class="btn btn-sm btn-danger w-100 mt-3">Submit Cancellation Request</button>
</form>
  </div>
</div>

  <?php
if($this->db->get('messages')->row()->on_match_screen_bottom){
  ?>
<div class="alert alert-warning my-2" style="font-size:13.5px" role="alert">
<?=$this->db->get('messages')->row()->on_match_screen_bottom?>
</div>
  <?php
}
  ?>
  </div>

</div>

</div>
