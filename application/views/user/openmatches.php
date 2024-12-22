<?php

foreach($matches as $match){
            $game = $this->db->where('id',$match->game)->get('games')->row();
            $host = $this->db->where('id',$match->host_id)->get('users')->row();
            ?>

<div class="card mt-3 opm " data-id="m<?=$match->id?>">
  <div class="card-body">
    <div class="d-flex justify-content-between">
         <div class="d-flex gap-2 align-items-center">
<img src="<?=base_url('assets/images/avatars/'.$host->avatar)?>" width="40px" height="40px" style="" class="rounded-circle border border-primary border-2 shadow"/>
<div class="fw-bold">
<div style="font-size:13px"><?=$game->game_name?></div>
<div style="font-size:12px">@<?=$host->username?></div>

</div>
</div>

        <div class="fw-bold fs-6 text-primary text-nowrap">
         <?php
 $reward=($match->amount*2)-(($match->amount)/100*(100-$fn->get_reward_percentage($match->amount)));
$reward=floor($reward);
         ?>

Prize : ₹ <?=$reward?>
</div>


    </div>


 <a href="<?=base_url('user/joinmatch/'.$match->id)?>" class="btn btn-sm btn-success w-100 mt-3 showloading"><i class="bi bi-play-fill"></i> Play Match ( ₹ <?=$match->amount?>)</a>

 
</div>
</div>
            <?php
        }