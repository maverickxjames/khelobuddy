<div class="d-flex align-items-center justify-content-center" style="height:100vh">
    <div class="p-3 rounded shadow bg-white m-2 border border-3">
    <div class="d-flex gap-2 align-items-center justify-content-center">
<img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" height="70px" />
<div class="border-start border-dark border-2 px-2">
<h5><?=$this->db->get('system')->row()->brand_name?></h2>
<h5 class="fw-bold">BLOCKED</h2>

</div>
</div>
<div class="text-center mt-4">
    <!-- <img src="<?=base_url('assets/images/um.png')?>" class="w-75 mx-auto" /> -->
<p class="px-4 text-center fs-4 fw-bold">Hi, <?=$user->username?></p>
<p class="px-4 text-center text-danger fs-4"><b>your account is blocked by admin.</b> contact admin on instagram</p>
<?php
if($this->db->get('system')->row()->instagram){
    ?>
    <a href="<?=$this->db->get('system')->row()->instagram?>" class="btn text-white instagram text-start justify-content-between" target="_blank">
    
  <span> <i class="bi bi-instagram"></i> Instagram</span>
  </a>
    <?php
}
?>
<br>
<br>
<a href="<?=base_url('user/logout2')?>" class="btn btn-danger showloading"><i class="bi bi-box-arrow-left"></i> Logout</a>

</div>

</div>