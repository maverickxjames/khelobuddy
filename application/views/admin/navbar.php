<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
       
        <img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" width="50" height="50"/>
       <div class="mx-2">
<h5 class="m-0"><?=$this->db->get('system')->row()->brand_name?> </h5>
<p class="m-0">Admin Panel</p>
       </div>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard</a></li>
            <?php
$access = $this->db->where('admin_email',$user->email)->get('admin_access')->row();
            ?>

            <?php
if(@$access->can_access_r || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/reports')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-find-in-page"></use>
            </svg> Reports</a></li>
  <?php
}
            ?>

  <?php
if(@$access->can_access_rd || $user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/deposits')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
            </svg>Recent Deposits</a></li>
  <?php
}
            ?>

  <?php
if(@$access->can_access_rd || $user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/Wdeposit')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
            </svg>Wallet Deposit</a></li>
  <?php
}
            ?>

  <?php
if(@$access->can_access_rd || $user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/Rdeposit')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
            </svg>Reward deposit</a></li>
  <?php
}
            ?>

  <?php
if(@$access->can_access_rd || $user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/penalty')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
            </svg>Recent Penalty</a></li>
  <?php
}
            ?>
  
  <?php
if(@$access->can_access_cr || $user->id==1){
  ?>
  <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/requests')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-braille"></use>
            </svg> Cancellation Requests</a></li>
  <?php
}
            ?>


  <?php
if(@$access->can_access_mc || $user->id==1){
  ?>
  <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/conflicts')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-life-ring"></use>
            </svg>Match Conflicts</a></li>
  <?php
}
            ?>

             <?php
if(@$access->can_access_mp || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/manageusers')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg>Manage Players</a></li>
  <?php
}
            ?>

              


              <?php
if(@$access->can_access_kycr || $user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/kycs')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-fingerprint"></use>
            </svg>KYC Requests</a></li>
  <?php
}
            ?>

  <?php
if(@$access->can_access_m || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/matches')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg> Matches</a></li>
  <?php
}
            ?>            
         
            

       <?php
if(@$access->can_access_mg || $user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link  showloading" href="<?=base_url('admin/managegames')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-gamepad"></use>
            </svg>Manage Games</a></li>
  <?php
}
            ?>       
            

           <?php
if(@$access->can_access_wr || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link  showloading" href="<?=base_url('admin/withdrawreqs')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-bank"></use>
            </svg>Withdraw Requests</a></li>
  <?php
}
            ?>

            
           <?php
if(@$access->can_access_wr || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link  showloading" href="<?=base_url('admin/withf')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-bank"></use>
            </svg>Withdraw Requests(fast)</a></li>
  <?php
}
            ?>
          

          
          
              <?php
if(@$access->can_access_rab || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/rewards')?>"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-diamond"></use></svg> Rewards & Bonus</a></li>
  <?php
}
            ?>
  <?php
if(@$access->can_access_nam || $user->id==1){
  ?>
 <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/messages')?>"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-bullhorn"></use></svg> Notes & Messages</a></li>
  <?php
}
            ?>

            
  


              <?php
if(@$access->can_access_th || $user->id==1){
  ?>
  <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/theme')?>"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-brush-alt"></use></svg> Theme</a></li>
  <?php
}
            ?>

    <?php
if(@$access->can_access_ps || $user->id==1){
  ?>
  <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/pages')?>"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-window-maximize"></use></svg> Pages</a></li>
  <?php
}
            ?>         

<?php
if($user->id==1){
  ?>
   <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/system')?>"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-apps"></use></svg> Site Setting</a></li>
 <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/manageadmins')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg>Manage Admins</a></li>
           
           
            <!-- <li class="nav-item"><a class="nav-link" href="buttons/button-group.html"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-people"></use></svg> Manage Admins</a></li> -->
            <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/apiaccess')?>"><svg class="nav-icon"><use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-sitemap"></use></svg> API Config</a></li>

            <!-- <li class="nav-item"><a class="nav-link showloading" href="<?=base_url('admin/system')?>">
            <svg class="nav-icon">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-shield-alt"></use>
            </svg>Settings</a></li> -->
  <?php
}
?>
     

            

            
        
       
       
      </ul>
   
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-0">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button>
         
          <ul class="header-nav d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#"><?=$user->full_name?></a></li>
          </ul>
          <ul class="header-nav ms-auto">
            <!-- <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg></a></li>
            
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed"></use>
                </svg></a></li> -->
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img border" src="<?=base_url('assets/images/admin.png')?>" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Settings</div>

                </div>
                <!-- <a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg>Edit Profile</a> -->

           <a class="dropdown-item" href="<?=base_url('admin/logout')?>">
                  <svg class="icon me-2">
                    <use xlink:href="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </header>