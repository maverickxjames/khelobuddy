<?php
foreach($matches as $match){
            $game = $this->db->where('id',$match->game)->get('games')->row();
              $host = $this->db->where('id',$match->host_id)->get('users')->row();
              $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();

            ?>
   <?php
 $reward=($match->amount*2)-(($match->amount)/100*(100-$fn->get_reward_percentage($match->amount)));
$reward=floor($reward);
         ?>
<div class="card mt-3">
  <div class="card-header d-flex text-dark justify-content-between" style="font-size:15px;padding:5px">
  <div class="fw-bold small">Entry : ₹ <?=$match->amount?></div>
  <div class="fw-bold small">Prize : ₹ <?=$reward?></div>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between">
         <div class="text-center">
<img src="<?=base_url('assets/images/avatars/'.$host->avatar)?>" width="40px" height="40px" style="" class="rounded-circle border border-primary border-2 shadow"/>
<div class="fw-bold" style="font-size:16px">
<?php
if($fn->user->username==$host->username){
    echo "You";
}else{
    echo '@'.$host->username;
}
?>
</div>
</div>

<div class="d-flex align-items-center">
<img src="<?=base_url('assets/images/vs.png')?>" height="35px" />
</div>
        <div class="text-center">
            <?php
if($match->joiner_id){
    $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();
?>
<img src="<?=base_url('assets/images/avatars/'.$joiner->avatar)?>" width="50px" height="50px" class="rounded-circle border border-danger border-2 shadow"/>
<div class="fw-bold" style="font-size:16px"><?php
if($fn->user->username==$joiner->username){
    echo "You";
}else{
    echo '@'.$joiner->username;
}
?></div>
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
    <?php
if($match->joiner_id){ ?>

 <a href="<?=base_url('user/match/'.$match->id)?>" class="btn btn-sm btn-dark w-100 mt-1 showloading"><i class="bi bi-dice-6"></i> Open Match</a>
<?php
}else{
    ?>
 <a href="<?=base_url('user/cancelmatch/'.$match->id.'/'.$game_id)?>" class="btn btn-sm btn-danger w-100 mt-1 showloading"><i class="bi bi-x-circle"></i> Cancel Match</a>
    <?php
}
    ?>
 
</div>
</div>
            <?php
        }