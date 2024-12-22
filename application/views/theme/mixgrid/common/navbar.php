<?php
if($this->db->get('messages')->row()->on_header_top_strip){
  ?>
<div class="bg-danger text-white text-center py-1 small">
 <?=$this->db->get('messages')->row()->on_header_top_strip?>
</div>
  <?php
}
?>
<nav class="navbar navbar-light bg-light border-bottom py-1">
  <div class="container-fluid col-md-8 col-lg-5 mx-auto">
   
  <div class="d-flex align-items-center gap-2">
   <a class="btn btn-sm fs-4" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
<i class="bi bi-list"></i>
</a>
    <a class="navbar-brand showloading" href="<?=base_url()?>">
      <img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" alt="" height="40" class="d-inline-block align-text-top">
    </a>
</div>
    <div class="d-flex align-items-center gap-2">
      <?php
if(isset($user)){
  ?>
   <a class="btn btn-sm border d-flex align-items-center showloading gap-1" href="<?=base_url('user/wallet')?>">
  
     <img src="<?=base_url('assets/images/money2.png')?>" height="17px"/>
      ₹ <?=number_format(@$balance)?>
    </a>

      <a class="btn btn-sm border d-flex align-items-center showloading gap-1" href="<?=base_url('user/withdraws')?>">
  
     <img src="<?=base_url('assets/images/prize.png')?>" height="17px"/>
      ₹ <?=number_format(@$pbalance)?>
    </a>
  <?php
}else{
  ?>
  <a class="btn btn-sm btn-outline-primary" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
     <i class="bi bi-info-circle"></i> Instructions
    </a>
  <?php
}
      ?>
   

 
</div>
  </div>
</nav>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header bg-dark text-white">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">How To Play Game & Earn ?</h5>
    <button type="button" class="btn-close close btn-white bg-white text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

 <div class="video-container col-12 col-md-8 d-block">
    <iframe style="width:100%" id="iframe-instruction" src="<?=$this->db->get('system')->row()->instruction?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
    </div>
</div>

<div class="offcanvas offcanvas-start"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-danger text-white">
    <h2 class="offcanvas-title fw-bold d-flex align-items-center" id="offcanvasExampleLabel"><img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" alt="" height="40" class="d-inline-block align-text-top">
     <?=$this->db->get('system')->row()->brand_name?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
   


<?php
if(isset($user)){
?>
<a href="<?=base_url('user/profile')?>" class="text-decoration-none text-dark showloading">
<div class="d-flex gap-2 border p-2 rounded">
<img src="<?=base_url('assets/images/avatars/'.$user->avatar)?>" height="45px" width="45px"/>
<div>
<div class=""><?=$user->full_name?></div>
<div class="small">@<?=$user->username?></div>


</div>

</div>
<a>
    <a href="<?=base_url('user/dashboard')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-house"></i> Home</span> <span><i class="bi bi-chevron-right"></i></span></a>
    <a href="<?=base_url('user/wallet')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-wallet2"></i> Wallet</span> <span><i class="bi bi-chevron-right"></i></span></a>

    <a href="<?=base_url('user/history')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-clock-history"></i> History</span> <span><i class="bi bi-chevron-right"></i></span></a>

     <a href="<?=base_url('user/withdraws')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-bank"></i> Withdraws</span> <span><i class="bi bi-chevron-right"></i></span></a>


    <a href="<?=base_url('user/profile')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-person-circle"></i> Profile</span> <span><i class="bi bi-chevron-right"></i></span></a>
    <a href="<?=base_url('user/referral')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-gift"></i> Refer & Earn</span> <span><i class="bi bi-chevron-right"></i></span></a>


<?php
}else{
  ?>
    <a href="<?=base_url('login')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-person"></i> Login</span> <span><i class="bi bi-chevron-right"></i></span></a>

    <a href="<?=base_url('signup')?>" class="my-3 btn btn-outline-dark w-100 text-start d-flex justify-content-between showloading"><span><i class="bi bi-person-fill-add"></i> Register</span> <span><i class="bi bi-chevron-right"></i></span></a>

  <?php
}
?>


 


<?php
if($this->db->get('system')->row()->whatsapp){
    ?>
      <a href="https://api.whatsapp.com/send?phone=<?=$this->db->get('system')->row()->whatsapp?>" class="my-3 btn w-100 text-white text-start d-flex justify-content-between" target="_blank" style="background-color:#1EBEA5">
    
      <span><i class="bi bi-whatsapp"></i> Contact On Whatsapp</span> <span><i class="bi bi-chevron-right"></i></span>
    
    </a>
    <?php
}
?>

<?php
if($this->db->get('system')->row()->instagram){
    ?>
    <a href="<?=$this->db->get('system')->row()->instagram?>" class="my-3 btn w-100 text-white instagram text-start d-flex justify-content-between" target="_blank">
    
  <span> <i class="bi bi-instagram"></i> Connect On Instagram</span> <span><i class="bi bi-chevron-right"></i></span>
  </a>
    <?php
}
?>

<?php
if($this->db->get('system')->row()->email){
    ?>

 
  <a href="mailto:<?=$this->db->get('system')->row()->email?>" class="my-3 btn w-100 text-white btn-dark text-start d-flex justify-content-between" target="_blank">
    
  <span> <i class="bi bi-envelope"></i> Reach Us Via Email</span> <span><i class="bi bi-chevron-right"></i></span>
  </a>
    <?php
}
?>


    <?php
$mlinks=$this->db->where('placement',1)->get('pages')->result();
foreach($mlinks as $link){
  ?>
<a href="<?=base_url('user/page/'.$link->page_slug)?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-link-45deg"></i><?=$link->page_name?></span> <span><i class="bi bi-chevron-right"></i></span></a>
  <?php
}
?>

   <div>
<div class="d-flex flex-wrap justify-content-center gap-2 text-secondary" style="opacity:0.8">
<?php
$flinks=$this->db->where('placement',2)->get('pages')->result();
foreach($flinks as $link){
  ?>
<a href="<?=base_url('user/page/'.$link->page_slug)?>" class="text-decoration-none small showloading"><?=$link->page_name?></a>
  <?php
}
?>

</div>
</div>

    <?php
if(isset($user)){
?>

<?php
}
?>
  </div>
</div>
<style>
    .bottombar small{
        font-size:11px;
    }
    
      .bottombar i{
        font-size:25px;
    }
</style>
<div class="navbar m-0 p-0 w-100 d-md-none bottombar" style="position:fixed;bottom:0px;z-index:+1">
<div class=" col-12 col-md-8 col-lg-5 mx-auto  border-top shadow" style="background-color:#F1F1F1">
<div class="d-flex justify-content-around bg-primary">
<?php
if(isset($user)){
  ?>
<a href="<?=base_url()?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-house"></i></div>

</div>
</a>

<a href="<?=base_url('user/profile')?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-person-circle"></i></div>

</div>
</a>

<a href="<?=base_url('user/wallet')?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-wallet2"></i></div>

</div>
</a>



<a href="<?=base_url('user/referral')?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-share"></i></div>

</div>
</a>

<a href="<?=base_url('user/history')?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-clock-history"></i></div>

</div>
</a>
  <?php

}else{
?>
<a href="<?=base_url('user/login')?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-person"></i></div>

</div>
</a>
<a href="<?=base_url('user/signup')?>" class="showloading text-decoration-none text-white">
<div class="text-center d-flex flex-column">
<div class="fs-1 p-0 m-0"><i class="bi bi-person-fill-add"></i></div>

</div>
</a>
<?php
}
?>


</div>
</div>
</div>

<div class="col-md-8 col-lg-5 mx-auto" style="position:relative">