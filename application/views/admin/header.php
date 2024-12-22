<?php

$conflictsfix=$this->db->where('status',1)->get('conflicts')->result();
foreach($conflictsfix as $conflictfix){
  $matchfix=$this->db->where('status',0)->where('id',$conflictfix->match_id)->get('matches')->row();
if($matchfix){
  $this->db->where('id',$conflictfix->id)->delete('conflicts');
}

}

$txnsfix = $this->db->select('match_id,count(id) as w')->where('(ctg="MATCH_WININGS")')->group_by('match_id')->having('w > 1')->order_by('match_id','desc')->get('transections')->result();
    
    
    
    foreach($txnsfix as $tx){
       $dup= $this->db->where('match_id',$tx->match_id)->where('(ctg="MATCH_WININGS")')->order_by('id','desc')->get('transections')->row();
       if($dup){
            $this->db->where('id',$dup->id)->delete('transections');
       }
      
    }
    
    // $txnsfix2 = $this->db->select('match_id,count(id) as w')->where('(ctg="REFERRAL_BONUS")')->group_by('match_id')->having('w > 1')->order_by('match_id','desc')->get('transections')->result();
    
    // foreach($txnsfix2 as $tx){
      
       
    //   $dup2= $this->db->where('match_id',$tx->match_id)->where('(ctg="REFERRAL_BONUS")')->order_by('id','desc')->get('transections')->row();
    //     if($dup2){
    //         $this->db->where('id',$dup2->id)->delete('transections');
    //   }
       
        
   
    // }
    
    $txnsfix2 = $this->db->select('match_id,user_id,count(id) as w')->where('(ctg="REFERRAL_BONUS")')->group_by('match_id, user_id')->having('w > 1')->order_by('match_id','desc')->get('transections')->result();
    
    foreach($txnsfix2 as $tx){
      
       
       $dup2= $this->db->where('match_id',$tx->match_id)->where('user_id', $tx->user_id)->where('(ctg="REFERRAL_BONUS")')->order_by('id','desc')->get('transections')->row();
        if($dup2){
            $this->db->where('id',$dup2->id)->delete('transections');
       }
       
        
   
    }
     
?>
<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">
  <head>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->db->get('system')->row()->brand_name?> | Admin Panel</title>
    <link rel="icon" type="image/png" href="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>">

  <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Exo&family=Fuggles&family=Gloria+Hallelujah&family=Indie+Flower&family=Kalam&family=Mooli&family=Nunito&family=Questrial&family=Roboto&family=Source+Serif+4:opsz@8..60&family=Space+Grotesk&family=Whisper&family=Zilla+Slab&display=swap" rel="stylesheet">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="<?=base_url('assets/adminpanel/dist')?>/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="<?=base_url('assets/adminpanel/dist')?>/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="<?=base_url('assets/adminpanel/dist')?>/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="<?=base_url('assets/adminpanel/dist')?>/css/examples.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
      id="theme-styles"
    />
    <style>
#loadingscreen{
    position:fixed;
    top:0;
    left:0;
    bottom:0;
    right:0;
    background:rgba(0,0,0,0.4);
    z-index:+99999999999;
    display:flex;
    justify-content:center;
    align-items:center;

}
        </style>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  </head>
  <body>
<div id="loadingscreen" style="display:none">
    <img src="<?=base_url('assets/images/loading.gif')?>" width="50px" height="50px"/>
</div>
<?php
if(isset($_SESSION['AdminAuth'])){
  ?>
<div class="text-white fw-bold text-end notstrip" style="background-color:red;display:none">

</div>
  <?php
}
?>
