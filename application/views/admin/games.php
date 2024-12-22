
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
    <div class="d-flex justify-content-between">
<h5>Games</h5>
<button class="btn btn-primary btn-sm" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addnewgame">Add New Game</button>
</div>

<div class="modal fade" id="addnewgame" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Game</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url("admin/addnewgame")?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">

       <div class="my-1">
    <label for="" class="form-label">Game Logo <small>(optional)</small></label>
    <input type="file" class="form-control" id="" name="logo" accept=".jpg,.jpeg,.png,.gif">
  </div>
      <div class="my-3">
    <label for="" class="form-label">Game Name</label>
    <input type="text" class="form-control" id="" name="game_name" placeholder='enter the game name here' required>
  </div>

  <div class="my-3">
    <label for="" class="form-label">Game Status</label>
  <select class="form-control" name="status">
      <option value="1">Active</option>
      <option value="0">In-Active</option>
      <option value="2">Coming Soon</option>
      
  </select>
  </div>
    <div class="my-3">
    <label for="" class="form-label">Game Instructions</label>
    <textarea type="text" class="form-control" id="" name="instructions" placeholder='enter game instructions here'></textarea>
  </div>




  

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-white">Add Game</button>


      </div>
      </form>
    </div>
  </div>
</div>

<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th class="text-nowrap fw-bold">Game Name</th>
<th class="text-nowrap fw-bold">Instructions</th>
<th class="text-nowrap fw-bold">Actions</th>

</tr>
</thead>
<tbody>
<?php
if(!$games){
  ?>
  <tr><td colspan="4">
<p class="text-center">No Games Found</p>
</td></tr>
  <?php
}
$count=1;
foreach($games as $game){
    ?>
<tr>
    <td><?=$count?></td>

    <td class="text-nowrap text-center">
      <img src="<?=base_url('assets/images/'.($game->logo?$game->logo:'no-img.png'))?>" class="rounded img border" width="80" height="80"/>
    <p class=" m-0 text-center"><?=$game->game_name?></p>
  </td>

  <td class="text-wrap">
    <p class="m-0"><?=$game->instructions==''?'no instructions':$game->instructions?></p>
    <?php
    if($game->status==0){
        ?>
        <span class="badge bg-danger">Inactive</span>
        <?php
    }elseif($game->status==1){
       ?>
        <span class="badge bg-success">Active</span>
        <?php 
    }elseif($game->status==2){
        ?>
        <span class="badge bg-warning">Coming Soon</span>
        <?php
    }
    ?>
  </td>

    <td class="text-nowrap">
        <a href="#" class=" btn btn-primary btn-sm text-white" data-coreui-toggle="modal" title="Delete Student" data-coreui-target="#addnewgame<?=$game->id?>"><i class="bi bi-pencil-square"></i> Edit</a>
    <a href="<?=base_url('admin/deletegame/'.$game->id)?>" class="showloading btn btn-danger btn-sm text-white"><i class="bi bi-trash3"></i> Delete</a>


    
<div class="modal fade" id="addnewgame<?=$game->id?>" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Game</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>

         <form action="<?=base_url("admin/updategame/".$game->id)?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">

       <div class="my-1">
        <img src="<?=base_url('assets/images/'.($game->logo?$game->logo:'no-img.png'))?>" class="rounded img border" width="80" height="80"/><br>
    <label for="" class="form-label">Game Logo</label>
    <input type="file" class="form-control" id="" name="logo" accept=".jpg,.jpeg,.png,.gif">
  </div>

      <div class="my-1">
    <label for="" class="form-label">Game Name</label>
    <input type="text" class="form-control" id="" value="<?=@$game->game_name?>" name="game_name" placeholder='enter the game name here' required>
  </div>
  
  <div class="my-3">
    <label for="" class="form-label">Game Status</label>
  <select class="form-control" name="status">
      <option value="1" <?=$game->status==1?'selected':''?>>Active</option>
      <option value="0" <?=$game->status==0?'selected':''?>>In-Active</option>
      <option value="2" <?=$game->status==2?'selected':''?>>Coming Soon</option>
      
  </select>
  </div>

    <div class="my-3">
    <label for="" class="form-label">Game Instructions</label>
    <textarea type="text" class="form-control" id="" name="instructions" placeholder='enter game instructions here'><?=@$game->instructions?></textarea>
  </div>




  

      </div>
      <div class="modal-footer">
     

        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-white">Update Game</button>


      </div>
      </form>
    </div>
  </div>
</div>

    </td>
  
  

</tr>
    <?php
    $count++;
}
?>
</tbody>
</table>
</div>


</div>
</div>