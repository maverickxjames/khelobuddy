<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" type="image/png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
  
        </style>
  </head>
  <body>

    <div id="loading" style="display:none">
  <div style="width:100%;height:100vh;position:fixed;z-index:+99999;background-color:rgba(0,0,0,0.6);" class="d-flex justify-content-center align-items-center">
<img src="<?=base_url('assets/images/loading.gif')?>" width="50px"/>
</div>
</div>
