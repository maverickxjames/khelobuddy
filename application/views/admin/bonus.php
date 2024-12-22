
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Rewards & Bonus</h5>

<hr>
<form class="mx-2" method="post" action="<?=base_url('admin/updatebonus')?>" enctype="multipart/form-data">

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Joining Bonus (In Rupees)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="joining_bonus" value="<?=$system->joining_bonus?>" required>
    </div>
  </div>
  
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Referral Bonus (In %)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="ref_commission" value="<?=$system->ref_commission?>" required>
    </div>
  </div>
  
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-3 col-form-label">lvl 2 Referral Bonus (In %)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="lvl2ref_commission" value="<?=$system->lvl2ref_commission?>" required>
    </div>
  </div>
  
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-3 col-form-label">lvl 3 Referral Bonus (In %)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="lvl3ref_commission" value="<?=$system->lvl3ref_commission?>" required>
    </div>
  </div>
  
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-3 col-form-label">lvl 4 Referral Bonus (In %)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="lvl4ref_commission" value="<?=$system->lvl4ref_commission?>" required>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Default Winning Reward (In %)</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="wining_reward" value="<?=$system->wining_reward?>" required>
    </div>
  </div>
  
<div class="text-end">
  <button class="btn btn-primary">Update Rewards & Bonus</button>
</div>

</form>
<?php
$params=$this->db->order_by('price_limit','ASC')->get('wr_params')->result();
?>
<hr>
<div class="d-flex justify-content-between align-items-center mb-2">
<h6>Winning Reward Parameters</h6>
<button class="btn btn-sm btn-dark" data-coreui-toggle="modal"  data-coreui-target="#dmoney">+ Add Parameter</button>

</div>
<div class="modal fade" id="dmoney" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Reward Parameter</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <?=form_open('admin/addparameter')?>
      <div class="modal-body">

      <div class=" my-1 mb-3">
    <label for="" class="form-label">Amount Limit<sup class="text-danger">*</sup></label>
    <input type="number" class="form-control" id="" name="price_limit" placeholder='enter amount limit' required>
  </div>

   <div class=" my-1">
    <label for="" class="form-label">Reward (%)<sup class="text-danger">*</sup></label>
    <input type="number" class="form-control" id="" name="reward" placeholder='enter reward percentage' required>
  </div>
    


  

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-white">Add Parameter</button>


      </div>
      </form>
    </div>
  </div>
</div>



<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr class="bg-dark text-white">
<th>#</th>
<th>Amount Limit</th>
<th>Rewards (%)</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  <?php
if($params){
  foreach($params as $index=>$param){
?>
<tr>
<td><?=$index+1?></td>
<td><?=$param->price_limit?> ₹</td>
<td><?=$param->reward?> %</td>
<td>
  <a href="<?=base_url('admin/deleteparam/'.$param->id)?>" class="btn btn-sm btn-danger text-white">Delete</a>
</td>

</tr>
<?php
  }
}else{
  ?>
  <tr>
<td colspan="4" class="text-center">
no reward parameters found !
</td>
</tr>
  <?php
}
  ?>

</tbody>
</table>
</div>
</div>
</div>