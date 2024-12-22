
<div class="bg-white p-2 m-2 rounded shadow-sm">
<div>
<h5>Notes / Messages</h5>

<hr>
<form class="mx-2" method="post" action="<?=base_url('admin/updatemessages')?>" enctype="multipart/form-data">
<div class="small mb-3 text-secondary">
Note : for disable the message or note, submit it empty or blank !
</div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Homepage Top</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_homepage_top"><?=$msg->on_homepage_top?></textarea>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Homepage Bottom</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_homepage_bottom"><?=$msg->on_homepage_bottom?></textarea>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Dashboard Top</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_dashboard_top"><?=$msg->on_dashboard_top?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Dashboard Top Marquee</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_dashboard_top_marque"><?=$msg->on_dashboard_top_marque?></textarea>
    </div>
  </div>
 
   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Header Top Strip</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_header_top_strip"><?=$msg->on_header_top_strip?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Match Page Top</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_match_screen_top"><?=$msg->on_match_screen_top?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Match Page Middle</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_match_screen_middle"><?=$msg->on_match_screen_middle?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Match Page Bottom</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_match_screen_bottom"><?=$msg->on_match_screen_bottom?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Under Maintenance Page</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_under_maintenance"><?=$msg->on_under_maintenance?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Win Result Submit</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_win_pop_up"><?=$msg->on_win_pop_up?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Lose Result Submit</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_lose_pop_up"><?=$msg->on_lose_pop_up?></textarea>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Rules Pop Up</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_conflict_pop_up"><?=$msg->on_conflict_pop_up?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Add Money Tab</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_add_money"><?=$msg->on_add_money?></textarea>
    </div>
  </div>

   <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">On Withdraw Money Tab</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="on_withdraw_money"><?=$msg->on_withdraw_money?></textarea>
    </div>
  </div>

<div class="text-end">
  <button class="btn btn-primary">Update Notes/Messages</button>
</div>
</form>
</div>
</div>