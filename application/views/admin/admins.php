
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
    <div class="d-flex justify-content-between">
<h5>Manage Admins</h5>
<button class="btn btn-primary btn-sm" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addnewgame">Add Admin</button>
</div>

<div class="modal fade" id="addnewgame" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Admin</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url("admin/addnewadmin")?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">

      
      <div class="my-1">
    <label for="" class="form-label">Admin Name</label>
    <input type="text" class="form-control form-control-sm" id="" name="full_name" placeholder='enter admin name...' required>
  </div>

    <div class="my-1">
    <label for="" class="form-label">Admin Email</label>
    <input type="email" class="form-control form-control-sm" id="" name="email" placeholder='enter admin name...' required>
  </div>

  <div class="my-1">
    <label for="" class="form-label">Admin Password</label>
    <input type="text" class="form-control form-control-sm" id="" name="password" placeholder='enter admin password here...' required>
  </div>
  <div>Access</div>
  <div>


<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_r" value="1" id="car">
  <label class="form-check-label" for="car">
    Reports
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_rd" value="1" id="card">
  <label class="form-check-label" for="card">
    Recent Deposits
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_cr" value="1" id="cr">
  <label class="form-check-label" for="cr">
    Cancellation Requests
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_mc" value="1" id="mc">
  <label class="form-check-label" for="mc">
    Match Conflicts
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_mp" value="1" id="mp">
  <label class="form-check-label" for="mp">
    Manage Players
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_kycr" value="1" id="kycr">
  <label class="form-check-label" for="kycr">
    KYC Requests
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_m" value="1" id="m">
  <label class="form-check-label" for="m">
    Matches
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_mg" value="1" id="mg">
  <label class="form-check-label" for="mg">
    Manage Games
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_wr" value="1" id="wr">
  <label class="form-check-label" for="wr">
    Withdraw Requests
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_rab" value="1" id="rab">
  <label class="form-check-label" for="rab">
    Reward & Bonus
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_nam" value="1" id="nam">
  <label class="form-check-label" for="nam">
    Notes & Messages
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_ps" value="1" id="ps">
  <label class="form-check-label" for="ps">
   Pages
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_th" value="1" id="th">
  <label class="form-check-label" for="th">
   Theme
  </label>
</div>

 </div>




  

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-white">Add Admin</button>


      </div>
      </form>
    </div>
  </div>
</div>

<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Name</th>
<th class="text-nowrap fw-bold">Email</th>
<th class="text-nowrap fw-bold">Access</th>
<th class="text-nowrap fw-bold">Action</th>

</tr>
</thead>
<tbody>
<?php
if(!$admins){
  ?>
  <tr><td colspan="5">
<p class="text-center">No Admin Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($admins as $admin){
  $access=$this->db->where('admin_email',$admin->email)->get('admin_access')->row();
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <p class=" m-0"><?=$admin->full_name?></p>
  </td>

  <td class="text-wrap">
    <p class=" m-0"><?=$admin->email?></p>
  </td>
<td>
<?=$access->can_access_r?'<span class="badge bg-success m-1">Reports</span>':''?>
<?=$access->can_access_rd?'<span class="badge bg-success m-1">Recent Deposits</span>':''?>
<?=$access->can_access_cr?'<span class="badge bg-success m-1">Cancellation Requests</span>':''?>
<?=$access->can_access_mc?'<span class="badge bg-success m-1">Match Conflicts</span>':''?>
<?=$access->can_access_mp?'<span class="badge bg-success m-1">Manage Players</span>':''?>
<?=$access->can_access_kycr?'<span class="badge bg-success m-1">KYC Requests</span>':''?>
<?=$access->can_access_m?'<span class="badge bg-success m-1">Matches</span>':''?>
<?=$access->can_access_mg?'<span class="badge bg-success m-1">Manage Games</span>':''?>
<?=$access->can_access_wr?'<span class="badge bg-success m-1">Withdraw Requests</span>':''?>
<?=$access->can_access_rab?'<span class="badge bg-success m-1">Reward & Bonus</span>':''?>
<?=$access->can_access_nam?'<span class="badge bg-success m-1">Note & Messages</span>':''?>
<?=$access->can_access_ps?'<span class="badge bg-success m-1">Pages</span>':''?>
<?=$access->can_access_th?'<span class="badge bg-success m-1">Theme</span>':''?>
</td>
    <td class="text-nowrap">
        <a href="#" class=" btn btn-primary btn-sm text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addnewgame<?=$admin->id?>"><i class="bi bi-pencil-square"></i> Edit</a>
    <a href="<?=base_url('admin/deleteadmin/'.$admin->id)?>" class="showloading btn btn-danger btn-sm text-white"><i class="bi bi-trash3"></i> Delete</a>


    
<div class="modal fade" id="addnewgame<?=$admin->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Admin</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="<?=base_url("admin/udpateadmin/".$admin->id)?>" enctype="multipart/form-data" method="post">
<div class="modal-body">
       
      <div class="my-1">
    <label for="" class="form-label">Admin Name</label>
    <input type="text" class="form-control form-control-sm" id="" value="<?=$admin->full_name?>" name="full_name" placeholder='enter admin name...' required>
  </div>

    <div class="my-1">
    <label for="" class="form-label">Admin Email</label>
    <input type="email" class="form-control form-control-sm" id="" value="<?=$admin->email?>" name="email" placeholder='enter admin name...' required>
  </div>

  <div class="my-1">
    <label for="" class="form-label">New Password</label>
    <input type="text" class="form-control form-control-sm" id="" name="password" placeholder='enter new password here...'>
  </div>
  <div>Access</div>
  <div>


<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_r" value="1" id="car<?=$admin->id?>" <?=$access->can_access_r?'checked':''?>>
  <label class="form-check-label" for="car<?=$admin->id?>">
    Reports
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_rd" value="1" id="card<?=$admin->id?>" <?=$access->can_access_rd?'checked':''?>>
  <label class="form-check-label" for="card<?=$admin->id?>">
    Recent Deposits
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_cr" value="1" id="cr<?=$admin->id?>" <?=$access->can_access_cr?'checked':''?>>
  <label class="form-check-label" for="cr<?=$admin->id?>">
    Cancellation Requests
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_mc" value="1" id="mc<?=$admin->id?>" <?=$access->can_access_mc?'checked':''?>>
  <label class="form-check-label" for="mc<?=$admin->id?>">
    Match Conflicts
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_mp" value="1" id="mp<?=$admin->id?>" <?=$access->can_access_mp?'checked':''?>>
  <label class="form-check-label" for="mp<?=$admin->id?>">
    Manage Players
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_kycr" value="1" id="kycr<?=$admin->id?>" <?=$access->can_access_kycr?'checked':''?>> 
  <label class="form-check-label" for="kycr<?=$admin->id?>">
    KYC Requests
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_m" value="1" id="m<?=$admin->id?>" <?=$access->can_access_m?'checked':''?>>
  <label class="form-check-label" for="m<?=$admin->id?>">
    Matches
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_mg" value="1" id="mg<?=$admin->id?>" <?=$access->can_access_mg?'checked':''?>>
  <label class="form-check-label" for="mg<?=$admin->id?>">
    Manage Games
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_wr" value="1" id="wr<?=$admin->id?>" <?=$access->can_access_wr?'checked':''?>>
  <label class="form-check-label" for="wr<?=$admin->id?>">
    Withdraw Requests
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_rab" value="1" id="rab<?=$admin->id?>" <?=$access->can_access_rab?'checked':''?>>
  <label class="form-check-label" for="rab<?=$admin->id?>">
    Reward & Bonus
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_nam" value="1" id="nam<?=$admin->id?>" <?=$access->can_access_nam?'checked':''?>>
  <label class="form-check-label" for="nam<?=$admin->id?>">
    Notes & Messages
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_ps" value="1" id="ps<?=$admin->id?>" <?=$access->can_access_ps?'checked':''?>>
  <label class="form-check-label" for="ps<?=$admin->id?>">
   Pages
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="can_access_th" value="1" id="th<?=$admin->id?>" <?=$access->can_access_th?'checked':''?>>
  <label class="form-check-label" for="th<?=$admin->id?>">
   Theme
  </label>
</div>

 </div>




  

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-white">Update Admin</button>


      </div>
      </form>
    </div>
  </div>
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