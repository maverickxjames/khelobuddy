<?php
if($user->id==1){
  ?>
<div class="bg-white p-2 m-2">
<h5>Today (<?=date("d M,Y")?>)</h5>
<div class="row">
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ttotaldeposits)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ttotaladm)?></div>
                    <div class="fs-5 fw-bold pb-3">Deposits by admin</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ttotalpenalty)?> </div>
                    <div class="fs-5 fw-bold pb-3">Total Penalty</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ttotalwithdraws)?> </div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold"><?=number_format(@$ttotalusers)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white <?=$tcommision<1?'bg-danger':'bg-success'?>">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$tcommision)?></div>
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






<div class="bg-white p-2 m-2">
<h5>This Weak (<?=@$week?>)</h5>
<div class="row">
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$wtotaldeposits)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$wtotaladm)?></div>
                    <div class="fs-5 fw-bold pb-3">Deposits by admin</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$wtotalpenalty)?> </div>
                    <div class="fs-5 fw-bold pb-3">Total Penalty</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$wtotalwithdraws)?> </div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold"><?=number_format(@$wtotalusers)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white <?=$wcommision<1?'bg-danger':'bg-success'?>">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$wcommision)?></div>
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
<div class="bg-white p-2 m-2">
<h5>This Month (<?=@$month?>)</h5>
<div class="row">
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$mtotaldeposits)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$mtotaladm)?></div>
                    <div class="fs-5 fw-bold pb-3">Deposits by admin</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$mtotalpenalty)?> </div>
                    <div class="fs-5 fw-bold pb-3">Total Penalty</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$mtotalwithdraws)?> </div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold"><?=number_format(@$mtotalusers)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white <?=$mcommision<1?'bg-danger':'bg-success'?>">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$mcommision)?></div>
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

<div class="bg-white p-2 m-2">
<h5>This Year (<?=@$year?>)</h5>
<div class="row">
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ytotaldeposits)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ytotaladm)?></div>
                    <div class="fs-5 fw-bold pb-3">Deposits by admin</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ytotalpenalty)?> </div>
                    <div class="fs-5 fw-bold pb-3">Total Penalty</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ytotalwithdraws)?> </div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold"><?=number_format(@$ytotalusers)?></div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white <?=$ycommision<1?'bg-danger':'bg-success'?>">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$ycommision)?></div>
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

<div class="bg-white p-2 m-2">
<h5>Lifetime</h5>
<div class="row">
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-success">
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$totaladm)?></div>
                    <div class="fs-5 fw-bold pb-3">Deposits by admin</div>
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$totalpenalty)?> </div>
                    <div class="fs-5 fw-bold pb-3">Total Penalty</div>
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
            <div class="col-sm-6 col-lg-2">
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
            <div class="col-sm-6 col-lg-2">
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
            <div class="col-sm-6 col-lg-2">
              <div class="card mb-4 text-white <?=$lcommision<1?'bg-danger':'bg-success'?>">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-1 fw-semibold">₹ <?=number_format(@$lcommision)?></div>
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
<?php
}
?>
