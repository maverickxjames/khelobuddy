<div class="text-center mt-4">
    <img src="<?=base_url('assets/images/customer-service.png')?>" class="w-75 mx-auto" />
<div class="w-100 p-3">

<?php
if($this->db->get('system')->row()->whatsapp){
    ?>
      <a href="https://api.whatsapp.com/send?phone=<?=$this->db->get('system')->row()->whatsapp?>" class="w-100 btn btn-lg text-white mb-3" target="_blank" style="background-color:#1EBEA5"><i class="bi bi-whatsapp"></i> Contact On Whatsapp</a>
    <?php
}
?>

<?php
if($this->db->get('system')->row()->instagram){
    ?>
    <a href="<?=$this->db->get('system')->row()->instagram?>" class="btn btn-lg btn-dark w-100 mb-3 instagram border-0" target="_blank"><i class="bi bi-instagram"></i> Connect On Instagram</a>
    <?php
}
?>

<?php
if($this->db->get('system')->row()->email){
    ?>
 <a href="mailto:<?=$this->db->get('system')->row()->email?>" class="btn btn-lg btn-dark w-100"><i class="bi bi-envelope"></i> Reach Us Via Email</a>
    <?php
}
?>


  



</div>