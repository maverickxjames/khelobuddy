
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Reports & Stats</h5>
<form>

<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">From Date</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="from_date" value="<?=@$_GET['from_date']?>" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">To Date</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="to_date"  value="<?=@$_GET['to_date']?>" required>
    </div>
  </div>
<div class="text-end">
<button class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
</div>
</form>
<hr>
<div class="bg-white py-2 my-2">
<h5 class="mb-3">Duration ( <?=$fromdate?> to <?=$todate?>)</h5>
<div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$totaldeposits)?></div>
                    <div class="fs-5 fw-bold pb-3">Total Deposits</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$totalwithdraws)?> </div>
                    <div class="fs-5 fw-bold pb-3">Total Withdrawals</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
               
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold"><?=number_format(@$totalusers)?></div>
                    <div class="fs-5 fw-bold pb-3">New Users Joined</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
             
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white <?=$commision<1?'bg-danger':'bg-success'?>">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$commision)?></div>
                    <div class="fs-5 fw-bold pb-3">Admin Commission</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
               
              </div>
            </div>
            <!-- /.col-->
          </div>

          <div>



</div>
</div>

<h5 class="mb-3">Users Joined</h5>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Name</th>
<th class="text-nowrap fw-bold">Username</th>
<th class="text-nowrap fw-bold">Mobile No</th>
<th class="text-nowrap fw-bold">KYC</th>
<th class="text-nowrap fw-bold">Refferal Code</th>
<th class="text-nowrap fw-bold">Registered On</th>
<th class="text-nowrap fw-bold">Actions</th>

</tr>
</thead>
<tbody>
<?php
if(!$users){
  ?>
  <tr><td colspan="8">
<p class="text-center">No Users Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($users as $user){
         $kyc=$this->db->where('user_id',$user->id)->get('kycs')->row();
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap">
    <p class=" m-0"><?=$user->full_name?></p>
  </td>

  <td class="text-nowrap">
    <p class="m-0">@<?=$user->username?></p>
  </td>
  <td class="text-nowrap">
    <p class="m-0"><?=$user->mobile_no?></p>
  </td>
  <td>
<?=$kyc?'Completed':'Pending'?>
</td>
   <td class="text-nowrap">
    <p class="m-0"><?=$user->code?></p>
  </td>
    <td class="text-nowrap">
    <?=date('d M Y, h:i A',$user->created_at)?>
    </td>
    <td class="text-wrap">
      <a href="<?=base_url('admin/user/'.$user->id)?>" class="btn btn-sm btn-primary text-white showloading text-nowrap"><i class="bi bi-person"></i> Open</a>
      <a href="<?=base_url('user/loginasuser/'.$user->id)?>" target="_blank" class="btn btn-sm btn-success text-white text-nowrap"><i class="bi bi-box-arrow-in-right"></i> Login</a>

    
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