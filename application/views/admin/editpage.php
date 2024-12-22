
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
  <div class="d-flex justify-content-between align-items-center">
<h5>Update Page</h5>
<a href="<?=base_url('admin/pages')?>" class="btn btn-sm btn-primary showloading">Back</a>
</div>
<hr>
<form class="mx-2" method="post" action="<?=base_url('admin/updatepage/'.$page->id)?>" enctype="multipart/form-data">

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Placement</label>
    <div class="col-sm-10">
      <select class="form-select" name="placement">
        <option value="2" <?=$page->placement==2?'selected':''?>>SideBar Footer</option>
        <option value="1" <?=$page->placement==1?'selected':''?>>SideBar Main</option>

</select>
    </div>
  </div>
  
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Page Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="page_name" value="<?=$page->page_name?>" required>
    </div>
  </div>
  
     <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Page Slug</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="page_slug" value="<?=$page->page_slug?>" placeholder="please use letters,numbers,hyphan or underscore" required>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Page Content</label>
    <div class="col-sm-10">
      <textarea id="page_content" class="form-control" name="page_content" required><?=$page->page_content?></textarea>
    </div>
  </div>
   

<div class="text-end">
  <button class="btn btn-primary">Update Page</button>
</div>

</form>

</div>
</div>