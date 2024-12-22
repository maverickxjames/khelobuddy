<div class="bg-white p-2 m-2">

<h5>Recent Deposits</h5>

<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped datatable1">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Name</th>

<th class="text-nowrap fw-bold">Username</th>
<th class="text-nowrap fw-bold">Mobile No</th>
<th class="text-nowrap fw-bold">Txn Id</th>
<th class="text-nowrap fw-bold">Amount</th>
<th class="text-nowrap fw-bold">Date & Time</th>
</tr>
</thead>
<tbody>
<?php
if(!$deposits){
  ?>
  <tr><td colspan="8">
<p class="text-center">No Deposits Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($deposits as $txn){
         $user=$this->db->where('id',$txn->user_id)->get('users')->row();
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <p class=" m-0"><?=$user->full_name?></p>
  </td>

  <td class="text-nowrap">
    <p class="m-0"><a href="<?=base_url('admin/user/'.$user->id)?>" class="showloading text-decoration-none">@<?=$user->username?></a></p>
  </td>
  <td class="text-nowrap">
    <p class="m-0"><?=$user->mobile_no?></p>
  </td>
   <td class="text-nowrap">
    <p class="m-0"><?=$txn->order_id?></p>
  </td>
    <td class="text-nowrap">
    <?php echo '₹ ' . number_format($txn->amount, 2);?>
    </td>
    <td class="text-wrap">
     <?=date('d M Y, h:i A',$txn->created_at)?>
    
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