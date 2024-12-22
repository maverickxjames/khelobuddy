<div class="bg-white">
      <?php
if($this->db->get('messages')->row()->on_homepage_top){
    ?>
 <p class="text-center pt-3 px-2 small"><?=$this->db->get('messages')->row()->on_homepage_top?></p>
    <?php
}
    ?>

    <img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->homepage_banner)?>" class="w-100" />
    <?php
if($this->db->get('messages')->row()->on_homepage_bottom){
    ?>
 <p class="text-center p-3 small"><?=$this->db->get('messages')->row()->on_homepage_bottom?></p>
    <?php
}
    ?>
   
</div>
<br>
<br>
<br>
<div class="position-fixed bottom-0 col-12 col-md-8 col-lg-5 mx-auto d-flex gap-2 px-2 pb-3" style="margin-bottom:50px">
<a href="<?=base_url('login')?>" class="btn btn-lg btn-dark w-100 fw-bold showloading"><i class="bi bi-controller"></i> Play Now</a>
<a href="<?=base_url('support')?>" class="btn btn-lg btn-danger d-inline-block showloading"><i class="bi bi-headset"></i></a>

</div>