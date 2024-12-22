<?php
$w = $this->db->where('id', 1)->get('withdraw_reqs')->row();
echo $w->txn_id;
?>