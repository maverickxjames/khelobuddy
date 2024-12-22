
<?php
$fonts=["'Caveat', cursive;",
"'Dancing Script', cursive;",
"'Exo', sans-serif;",
"'Fuggles', cursive;",
"'Gloria Hallelujah', cursive;",
"'Indie Flower', cursive;",
"'Kalam', cursive;",
"'Mooli', sans-serif;",
"'Nunito', sans-serif;",
"'Questrial', sans-serif;",
"'Roboto', sans-serif;",
"'Source Serif 4', serif;",
"'Space Grotesk', sans-serif;",
"'Whisper', cursive;",
"'Zilla Slab', serif;"];
?>
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Theme Settings</h5>

<hr>
<form class="mx-2" method="post" action="<?=base_url('admin/updatetheme')?>" enctype="multipart/form-data">

 
  
  <div class="mb-3 row">
    <?php
if($system->background){
    ?>
<div> <img src="<?=base_url('assets/images/'.$system->background)?>" height="150px" /> </div>
    <?php
}
    ?>
      
    <label for="staticEmail" class="col-sm-2 col-form-label">Background</label>
    <div class="col-sm-10">
     
      <input type="file" class="form-control mt-2" accept=".jpeg,.jpg,.png" name="background">
      <div><a href="<?=base_url('admin/removeback')?>" class="showloading text-decoration-none">Remove Background</a></div>
    </div>
  </div>

<hr>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Font</label>
    <div class="col-sm-10">
    <select name="font" class="form-control">
      <option value="" <?=$system->font==''?'selected':''?>>System Default</option>
      <?php
foreach($fonts as $font){
    ?>
<option value="<?=$font?>" style="font-family:<?=$font?>" <?=$system->font==$font?'selected':''?>><?=str_replace("'",'',explode(',',$font)[0])?></option>
    <?php
}
      ?>

    </select>
    </div>
  </div>


  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Theme</label>
    <div class="col-sm-10">
    <select name="theme" class="form-control">
      <option value="" <?=$system->theme==''?'selected':''?>>WhiteList</option>
      <option value="theme/blackgrid/" <?=$system->theme=='theme/blackgrid/'?'selected':''?>>BlackGrid</option>
      <option value="theme/mixgrid/" <?=$system->theme=='theme/mixgrid/'?'selected':''?>>MixGrid</option>
    </select>
    </div>
  </div>

 

<div class="text-end">
  <button class="btn btn-primary">Update Site Settings</button>
</div>
</form>
</div>
</div>