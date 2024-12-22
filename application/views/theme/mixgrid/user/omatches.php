


<div class="py-3 px-2">
   
<div class="d-flex justify-content-between align-items-center">
    <div>
<span class="fw-bold fs-4 text-danger">Game : <?=$game->game_name?></span>
</div>
<div>
  <a class="btn btn-sm btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#rules" aria-controls="rules">
     <i class="bi bi-info-circle"></i> Rules
</a>
</div>
</div>
</div>
<div class="px-2">


<div class="text-center p-2 mt-3 card">
<h5>Create Match</h5>
<div class="d-flex justify-content-center gap-2">
<div class="input-group mb-3" style="">

  <input type="number" class="form-control form-control-sm fw-bold" placeholder="0" value="" id="match-amount" aria-label="Username" aria-describedby="basic-addon1" >
<input type="hidden" id="match" value="<?=@$game_id?>" />
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
<div class="p-2 mt-3 card border-0">
<h5 class="mb-3"><i class="bi bi-trophy"></i> Running Matches</h5>

<?php
  foreach($matches as $match){

           $reward=($match->amount*2)-(($match->amount)/100*(100-$fn->get_reward_percentage($match->amount)));
           $reward=floor($reward);

            $game = $this->db->where('id',$match->game)->get('games')->row();
            $host = $this->db->where('id',$match->host_id)->get('users')->row();
            $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();

            ?>



<div class="card my-2 border-none">
    <div class="card-header bg-primary text-white d-flex justify-content-between fw-bold" style="font-size:12px;padding:5px">

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







</div>

