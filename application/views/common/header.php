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
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" type="image/png" />
    <link rel="manifest" href="<?=base_url('./assets/manifest.json')?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Exo&family=Fuggles&family=Gloria+Hallelujah&family=Indie+Flower&family=Kalam&family=Mooli&family=Nunito&family=Questrial&family=Roboto&family=Source+Serif+4:opsz@8..60&family=Space+Grotesk&family=Whisper&family=Zilla+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?=@$title?></title>
    <meta name="title" content="<?=$this->db->get('system')->row()->meta_title?>">
    <meta name="description" content="<?=$this->db->get('system')->row()->meta_desc?>">
  <meta name="keywords" content="<?=$this->db->get('system')->row()->meta_keywords?>">
    <style>
.instagram{
  background: #f09433; 
background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
  }

  .btn-success{
    background-color:#28B463;
    border:none;
  }

   body{
  
          background-image:url('<?=base_url('assets/images/'.$this->db->get('system')->row()->background)?>');
          background-attachment: fixed;
          font-family:<?=$this->db->get('system')->row()->font?>
    }

     #installInstructions {
   display: none
}
@media (display-mode: browser) {
   #installInstructions {
     display: block
   }
}
  
        </style>

       
  </head>
  <body>
    <div style="display:none">
<audio id="notsound" controls>
        <source id="source" src="<?=base_url('assets/notify.wav')?>" type="audio/wav">
        Your browser does not support the audio element.
    </audio>

  </div>

   
   <?php
if(isset($match) && !$match->room_code){
  ?>
  <div style="display:none">
<audio id="clock" controls>
        <source id="source" src="<?=base_url('assets/beep.wav')?>" type="audio/wav">
        Your browser does not support the audio element.
    </audio>

  </div>
  <?php
}
   ?>
 
    <div id="loading" style="display:none">
  <div style="width:100%;height:100vh;position:fixed;z-index:+99999;background-color:rgba(0,0,0,0.6);" class="d-flex justify-content-center align-items-center">
<img src="<?=base_url('assets/images/loading.gif')?>" width="50px"/>
</div>
</div>
