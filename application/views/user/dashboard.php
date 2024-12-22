

 <?php
if($this->db->get('messages')->row()->on_dashboard_top_marque){
  ?>
<marquee class="alert-primary fw-bold  py-2">
 <i class="bi bi-megaphone"></i> <?=$this->db->get('messages')->row()->on_dashboard_top_marque?>
</marquee>
  <?php
}
?>
<div class="py-3 px-3 bg-white">
    <?php
if($this->db->get('messages')->row()->on_dashboard_top){
  ?>
<div class="alert alert-danger small fw-bold">
 <?=$this->db->get('messages')->row()->on_dashboard_top?>
</div>
  <?php
}
?>
<div class="d-flex justify-content-between">
<span class="fw-bold fs-4">Games</span>
<div>
<div>
   <a class="btn btn-sm btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#rules" aria-controls="rules">
     <i class="bi bi-info-circle"></i> Rules
    </a>
 <a class="btn btn-sm btn-outline-danger" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
     <i class="bi bi-info-circle"></i> Instructions
    </a>
</div>
</div>
</div>
<div class="text-center p-2 mt-3 card">
<h5>Create Match</h5>
<div class="d-flex gap-2">
<div class="input-group mb-3" style="width:40%">

  <input type="number" class="form-control form-control-sm fw-bold" placeholder="0" value="" id="match-amount" aria-label="Username" aria-describedby="basic-addon1" >

</div>
<div class="w-100">
<select class="form-select form-select-sm order-1" id="match" aria-label="Default select example">
 <?php
foreach($games as $game){
  if($game->status!=1) continue;
    ?>
<option value="<?=$game->id?>"><?=$game->game_name?></option>
    <?php
}
 ?>
</select>
</div>
<div>
<button class="btn btn-primary btn-sm text-nowrap" id="creategame-btn"><i class="bi bi-dice-6"></i> Create</button>
</div>
</div>

</div>


<div id="mymatches">

</div>

<div id="openmatches">

</div>


<!-- ----activenatches -->


<div id="winnings">
<?php
if($matches){
    ?>
<div class="p-2 mt-3 card">
<h5 class="mb-3"><i class="bi bi-trophy"></i> Running Matches</h5>

<?php
  foreach($matches as $match){

           $reward=($match->amount*2)-(($match->amount)/100*(100-$fn->get_reward_percentage($match->amount)));
           $reward=floor($reward);

            $game = $this->db->where('id',$match->game)->get('games')->row();
            $host = $this->db->where('id',$match->host_id)->get('users')->row();
            $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();

            ?>



<div class="card my-2">
    <div class="card-header d-flex justify-content-between fw-bold" style="font-size:12px;padding:5px">

   <span> Bet : ₹ <?=number_format($match->amount)?></span>
   <span> Prize : ₹ <?=$reward?></span>


  </div>
 <div class="card-body px-4 py-2">
   
 
 <div class="d-flex justify-content-between">
         <div class="text-start col-4">
<img src="<?=base_url('assets/images/avatars/'.$host->avatar)?>" width="40px" height="40px" style="" class="rounded-circle border border-primary border-2 shadow"/>
<div class="fw-bold" style="font-size:10px">
@<?=$host->username?>
</div>

</div>

<div class="d-flex align-items-center col-4 justify-content-center">
<img src="<?=base_url('assets/images/dice.png')?>" height="50px" />
</div>


        <div class="text-end col-4">
           
 
<img src="<?=base_url('assets/images/avatars/'.$joiner->avatar)?>" width="40px" height="40px" class="rounded-circle border border-danger border-2 shadow"/>
<div class="fw-bold" style="font-size:10px">
@<?=$joiner->username?>
</div>





 


</div>


    </div>
   
 
</div>
</div>

            <?php
        } ?>

</div>
    <?php
}
?>
</div>



<!-- activematchesend -->

<div id="winnings">
<?php
if($winnings){
    ?>
<div class="p-2 mt-3 card">
<h5><i class="bi bi-fire"></i> Recent Winnings</h5>

<?php
  foreach($winnings as $txn){

            $match = $this->db->where('id',$txn->match_id)->get('matches')->row();
            $game = $this->db->where('id',$match->game)->get('games')->row();
            $winner = $this->db->where('id',$match->winner)->get('users')->row();
            $looser = $this->db->where('id',$match->looser)->get('users')->row();

            ?>

<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex justify-content-between">
         <div class="d-flex gap-2 align-items-center">
<img src="<?=base_url('assets/images/avatars/'.$winner->avatar)?>" width="50px" height="50px" style="" class="rounded-circle border border-primary border-2 shadow"/>
<div class="">
<div style="font-size:13px"><b>@<?=$winner->username?></b> Wins  <span class="fw-bold fs-6 text-nowrap" style="color:#28B463">
           

 ₹ <?=$txn->amount?>
  </span> in a <b><?=$game->game_name?></b> Match with <b>@<?=@$looser->username?></b></div>
<div style="font-size:12px"><i class="bi bi-clock-history"></i> <?=date('d M Y, h:i a',$txn->created_at)?></div>

</div>

</div>

       


    </div>


</div>
</div>
            <?php
        } ?>

</div>
    <?php
}
?>
</div>





</div>





<?php
if($this->db->get('system')->row()->app_download_link){
  ?>
<style>


#installInstructions {
  position: fixed;
  bottom:20px;
  right: 10px;
}
#download{
    background-color:transparent;
    border:0px;
}
</style>
<div id="installInstructions" class="animate__animated animate__pulse animate__infinite	infinite">
<button class="feedback " id="download"><img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->app_download_image)?>" height="50px" /></button>
</div>

  <?php
}
?>