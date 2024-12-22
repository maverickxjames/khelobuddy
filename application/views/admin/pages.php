
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>

<?php
$params=$this->db->order_by('price_limit','ASC')->get('wr_params')->result();
?>

<div class="d-flex justify-content-between align-items-center mb-2">
<h5>Manage Pages</h5>
<a href="<?=base_url('admin/addpage')?>" class="btn btn-sm btn-dark showloading">+ Add Page</a>
</div>




<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr class="bg-dark text-white">

<th>Page Name</th>
<th>Page Slug</th>
<th>Placement</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  <?php
if($pages){
  foreach($pages as $index=>$page){
?>
<tr>
<td><?=$page->page_name?></td>
<td><?=$page->page_slug?></td>
<td><?=($page->placement==1)?'SideBar Main':'SideBar Footer'?></td>
<td>
  <a href="<?=base_url('admin/deletepage/'.$page->id)?>" class="btn btn-sm btn-danger text-white">Delete</a>
  <a href="<?=base_url('admin/editpage/'.$page->id)?>" class="btn btn-sm btn-primary text-white">Edit Page</a>

</td>

</tr>
<?php
  }
}else{
  ?>
  <tr>
<td colspan="4" class="text-center">
no pages found !
</td>
</tr>
  <?php
}
  ?>

</tbody>
</table>
</div>
</div>
</div>