<div class="d-flex align-items-center justify-content-center" style="height:100vh">
    <div class="p-3 rounded shadow bg-white m-2 border">
    <div class="d-flex gap-2 align-items-center justify-content-center">
<img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" height="70px" />
<div class="border-start border-dark border-2 px-2">
<h5><?=$this->db->get('system')->row()->brand_name?></h2>
<h5 class="fw-bold">UNDER MAINTENANCE</h2>

</div>
</div>
<div class="text-center mt-4">
    <img src="<?=base_url('assets/images/um.png')?>" class="w-75 mx-auto" />
<p class="px-4 text-center"><?=$this->db->get('messages')->row()->on_under_maintenance?></p>
</div>

</div>