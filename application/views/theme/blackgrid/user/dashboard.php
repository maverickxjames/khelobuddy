

 <?php
if($this->db->get('messages')->row()->on_dashboard_top_marque){
  ?>
<marquee class="alert-dark fw-bold  py-2">
 <i class="bi bi-megaphone"></i> <?=$this->db->get('messages')->row()->on_dashboard_top_marque?>
</marquee>
  <?php
}
?>
<div class="py-3 px-3 bg-white shadow">
    <?php
if($this->db->get('messages')->row()->on_dashboard_top){
  ?>
<div class="alert alert-danger small fw-bold">
 <?=$this->db->get('messages')->row()->on_dashboard_top?>
 <!--<a href="https://tawk.to/chat/66177d601ec1082f04e11907/1hr5s3gsj" class="my-3 btn-success btn text-white text-start justify-content-between" target="_blank" >-->
    
 <!-- <span><b> <i class="bi bi-chat"></i>LIVE CHAT 24x7</span> <span><i class="bi bi-chevron-right"></i></b></span>-->
 <!-- </a>-->
 <?php
if($this->db->get('system')->row()->instagram){
    ?>
    <a href="<?=$this->db->get('system')->row()->instagram?>" class="btn text-white instagram text-start justify-content-between" target="_blank">
    
  <span> <i class="bi bi-instagram"></i> Connect On Instagram <b>FREE LOOT!!!</b></span> <span><i class="bi bi-chevron-right"></i></span>
  </a>
    <?php
}
?>
</div>
  <?php
}
?>
<style>
.gc:hover{
cursor:pointer;
opacity:0.7;
}
  </style>
<div class="d-flex justify-content-between ">
<span class=" fs-4">Games</span>
<div>
    <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="modal" data-bs-target="#rules" aria-controls="rules">
     <i class="bi bi-info-circle"></i> Rules
    </a>
 <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
     <i class="bi bi-info-circle"></i> Instructions
    </a>
</div>
</div>

<div class="d-flex flex-wrap col-12 mt-2">
<?php
foreach($games as $index=>$game){
    if($game->status==1){
            $live=true;
        }else{
            $live=false;
        }
    
    
  ?>

<div class="col-6 p-2 pb-2">
  <a href="<?=base_url('user/matches/'.$game->id)?>" class="showloading text-decoration-none text-dark gc" style="<?=$live?'':'opacity:0.6;pointer-events: none;'?>">
  <div class=" text-center h-100">
 <?php
 if($live){
  $animate="animate__animated animate__tada animate__infinite	infinite";
     ?>
      <p class="p-0 m-0 text-danger animate__animated animate__flash animate__infinite	infinite" style="font-size:10px;text-align:right;opacity:0.2"><i class="bi bi-circle-fill"></i> Live</p>
     <?php
 }else{
  $animate='';
  ?>
<p class="p-0 m-0 text-dark" style="font-size:10px;text-align:right;opacity:0.9"> Coming Soon</p>
  <?php
 }
     ?>
   
<img src="<?=base_url('assets/images/'.($game->logo?$game->logo:'no-img.png'))?>" class="w-100" />
<p class="m-0 p-0 <?=@$animate?>  d-inline-block px-2 py-1"><i class="bi bi-dice-6"></i> <?=$game->game_name?></p>
</div>
</a>
</div>

  <?php
}
?>
</div>





   <div>
<div class="d-flex mt-3">
  <div>
  <img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" alt="" width="100"><br>
 
</div>
<div class="small px-2">
  <b><?=$this->db->get('system')->row()->brand_name?></b><br>
<?=$this->db->get('system')->row()->meta_desc?>
</div>
</div>
<div class="d-flex flex-wrap justify-content-center gap-2 text-secondary" style="opacity:0.8">


</div>
</div>





</div>
<br>
<br>
<?php
if($this->db->get('system')->row()->app_download_link){
  ?>
<style>


#installInstructions {
  position: fixed;
  bottom:60px;
  left: 10px;
  width: 50 ;
}
#download{
    background-color:transparent;
    border:0px;
}
</style>
<div id="installInstructions" class="animate__animated animate__pulse animate__infinite	infinite">
<button class="feedback " id="download"><img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->app_download_image)?>" height="50px" /></button>
</div>

  <?php
}
?>