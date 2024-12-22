
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Matches</h5>
<form>
<div class="input-group mb-3">
  <input type="text" class="form-control" name="search" value="<?=@$_GET['search']?>" placeholder="enter game id"  aria-describedby="button-addon2">
  <button type="submit" class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i> Search</button>
</div>
</form>
<hr>
<div class="table-responsive">
<table class="table">
<thead class="bg-dark text-white">
    <tr>
<th class="text-nowrap">Match Id</th>
<th class="text-nowrap">Host</th>
<th class="text-nowrap">Joiner</th>
<th class="text-nowrap">Room Code</th>
<th class="text-nowrap">Winner</th>
<th class="text-nowrap">Looser</th>
<th class="text-nowrap">Amount</th>
<th class="text-nowrap">Date & Time</th>
<th class="text-nowrap">Action</th>

</tr>
</thead>
<tbody>
<?php
if($matches){
    foreach($matches as $match){
        $host = $this->db->where('id',$match->host_id)->get('users')->row();
              $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();
              $winner= $this->db->where('id',$match->winner)->get('users')->row();
              $looser= $this->db->where('id',$match->looser)->get('users')->row();

?>
<tr>
<td  class="text-nowrap">#MID<?=$match->id+1427?></td>
<td  class="text-nowrap"><a href="<?=base_url('admin/user/'.$host->id)?>" class="text-decoration-none showloading"><?=$host->username?> <small>(<?=$host->mobile_no?>)</small></td>

<td  class="text-nowrap"> <?php
if($joiner){
  ?>
<a href="<?=base_url('admin/user/'.$joiner->id)?>" class="text-decoration-none showloading"><?=$joiner->username?> <small>(<?=$joiner->mobile_no?>)</small></a>

  <?php
}else{
    echo "none";
}

?>
</td>
<td  class="text-nowrap"><?=$match->room_code==0?'none':$match->room_code?></td>
<td  class="text-nowrap"> <?=$winner?$winner->username:'none'?></td>
<td  class="text-nowrap"> <?=$looser?$looser->username:'none'?></td>
<td  class="text-nowrap">₹ <?=number_format($match->amount)?></td>


<td  class="text-nowrap"><?=date("d M Y, h:i A",$match->created_at)?></td>
<td  class="text-nowrap"><?php
if($match->status==1){
?>
<a href="<?=base_url('admin/match/'.$match->id)?>" class="btn btn-sm btn-success showloading w-100 text-white">Open (View Info)</a>
<?php
}else{
  ?>
<a href="<?=base_url('admin/match/'.$match->id)?>" class="btn btn-sm btn-danger showloading w-100 text-white">Closed (View Info)</a>
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
</div>