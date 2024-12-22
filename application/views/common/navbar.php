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
      ₹<?=number_format(@$pbalance)?>
    </a>
  <?php
}else{
  ?>
   
  <a class="btn btn-sm btn-outline-danger" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
     <i class="bi bi-info-circle"></i> Instructions
    </a>
  <?php
}
      ?>
   

 
</div>
  </div>
</nav>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header bg-danger text-white">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">How To Play Game & Earn ?</h5>
    <button type="button" class="btn-close close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

 <div class="video-container col-12 col-md-8 d-block">
    <iframe style="width:100%" id="iframe-instruction" src="<?=$this->db->get('system')->row()->instruction?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
    </div>
</div>

<div class="offcanvas offcanvas-start"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-danger text-white">
    <h3 class="offcanvas-title" id="offcanvasExampleLabel"><img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" alt="" height="40" class="d-inline-block align-text-top">
    </a> <?=$this->db->get('system')->row()->brand_name?></h3>
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
    <a href="<?=base_url('user/dashboard')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-controller"></i> Play</span> <span><i class="bi bi-chevron-right"></i></span></a>
    <a href="<?=base_url('user/wallet')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-wallet2"></i> Wallet</span> <span><i class="bi bi-chevron-right"></i></span></a>

    <a href="<?=base_url('user/history')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-clock-history"></i> History</span> <span><i class="bi bi-chevron-right"></i></span></a>

     <a href="<?=base_url('user/withdraws')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-bank"></i> Withdraws</span> <span><i class="bi bi-chevron-right"></i></span></a>


    <a href="<?=base_url('user/profile')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-person-circle"></i> Profile</span> <span><i class="bi bi-chevron-right"></i></span></a>
    <a href="<?=base_url('user/referral')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-gift"></i> Refer & Earn</span> <span><i class="bi bi-chevron-right"></i></span></a>


<?php
}else{
  ?>
    <a href="<?=base_url('login')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-controller"></i> Play</span> <span><i class="bi bi-chevron-right"></i></span></a>

    <a href="<?=base_url('signup')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-controller"></i> Register</span> <span><i class="bi bi-chevron-right"></i></span></a>

  <?php
}
?>


    <a href="<?=base_url('support')?>" class="my-3 btn btn-outline-dark w-100 text-start fs-5 d-flex justify-content-between showloading"><span><i class="bi bi-headset"></i> Support</span> <span><i class="bi bi-chevron-right"></i></span></a>

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

<div class="col-md-8 col-lg-5 mx-auto" style="position:relative">