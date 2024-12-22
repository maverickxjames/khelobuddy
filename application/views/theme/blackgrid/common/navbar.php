<?php if ($this->db->get('messages')->row()->on_header_top_strip): ?>
<div class="fw-bold text-white text-center py-1 small col-md-8 col-lg-5 mx-auto " style="background-color: black; 
">
  <?= $this->db->get('messages')->row()->on_header_top_strip ?>
</div>
<?php endif; ?>

<nav class="navbar z-9999 navbar-expand-lg navbar-dark
py-2 col-md-8 col-lg-5 mx-auto" style=background-color:rgba(0,0,0,0.6)>
  <div class="container-fluid ">
    <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="bi bi-list-nested"></i>
      </button>
      <a class="navbar-brand" href="<?= base_url() ?>">
          
        <img src="<?= base_url('assets/images/'.$this->db->get('system')->row()->brand_logo) ?>" alt="" height="40"> 
      </a>
    </div>
<div class="d-flex align-items-center gap-2 ms-auto">
      <?php $balance = isset($balance) ? $balance : 0; ?>
      <?php if (isset($user)): ?>
      <a class="btn btn-outline-light btn-sm d-flex align-items-center gap-1" href="<?= base_url('user/wallet') ?>">
       <img src="<?=base_url('assets/images/money2.png')?>" height="17px"/>₹ <?= number_format($balance) ?><i class="bi bi-plus-square-fill ms-1"></i>
      </a>
      <?php $pbalance = isset($pbalance) ? $pbalance : 0; ?> 
      <a class="btn btn-outline-light btn-sm d-flex align-items-center gap-1" href="<?= base_url('user/withdraws') ?>">
<img src="<?=base_url('assets/images/prize.png')?>" height="17px"/> ₹ <?= number_format($pbalance) ?>
      </a>

      <?php else: ?>
     <!-- <a class="btn btn-outline-light btn-sm" href="<?= base_url('signup') ?>" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
        <i class="bi bi-person-add"></i> Register
      </a>-->
        <a class="btn btn-outline-light btn-sm " href="<?= base_url('terms') ?>">
        <i class="bi bi-info-circle me-1"></i>Terms
      </a>
      <?php endif; ?>
   </div>
  </div>
</nav>


<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header bg-dark text-light">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel"><i class="bi bi-info-circle"></i> How To Play Game & Earn?</h5>
    <button type="button" class="btn-close btn-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="video-container col-12 col-md-8 d-block">
      <iframe style="width:100%" id="iframe-instruction" src="<?= $this->db->get('system')->row()->instruction ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div>
</div>

<div class="offcanvas offcanvas-start text-light p-4" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background: linear-gradient(135deg, #3a3d99, #8a44a1); backdrop-filter: blur(10px);">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title d-flex align-items-center" id="offcanvasExampleLabel">
      <img src="<?= base_url('assets/images/'.$this->db->get('system')->row()->brand_logo) ?>" alt="brand logo" height="50" class="rounded-circle shadow-sm me-2">
      <span style="font-family:'satisfy', cursive;"><?= $this->db->get('system')->row()->brand_name ?></span>
    </h3>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php if (isset($user)): ?>
      <a 
  class="text-decoration-none d-flex align-items-center gap-3 p-3 mb-4 rounded shadow-sm" 
  href="<?= base_url('user/profile') ?>" 
  style="background: linear-gradient(45deg, #ff7eb3, #ff758c, #fd8a5e); color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); transition: transform 0.3s ease, box-shadow 0.3s ease;">
  
  <img 
    src="<?= base_url('assets/images/avatars/'.$user->avatar) ?>" 
    alt="user avatar" 
    class="rounded-circle shadow-sm" 
    style="width: 50px; height: 50px; border: 2px solid rgba(255, 255, 255, 0.7); transition: border 0.3s ease;">
  
  <div>
    <div class="fw-bold" style="font-size: 1rem;"><?= $user->full_name ?></div>
    <div class="small" style="opacity: 0.9;">@<?= $user->username ?></div>
  </div>
</a>

    

    <nav class="nav flex-column">
    <a href="<?= base_url('user/dashboard') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-house-door"></i> <span>Home</span>
                </div>
            </a>
            <a href="<?= base_url('user/referral') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-share"></i> <span>Refer</span>
                </div>
            </a>
            <a href="<?= base_url('user/wallet') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-wallet2"></i> <span>Wallet</span>
                </div>
            </a>
            <a href="<?= base_url('user/history') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-clock-history"></i> <span>History</span>
                </div>
            </a>
            <a href="<?= base_url('user/withdraws') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-currency-dollar"></i> <span>Withdraws</span>
                </div>
            </a>
            <a href="<?= base_url('user/profile') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-person"></i> <span>Profile</span>
                </div>
            </a>
            <a href="<?= base_url('terms') ?>" class="nav-link-custom">
                <div class="nav-item">
                    <i class="bi bi-file-earmark-text-fill"></i> <span>Legal Terms</span>
                </div>
            </a>
       <?php else: ?><!-- User is not logged in -->
      <a class="text-decoration-none text-white d-flex align-items-center gap-3 p-3 mb-4 bg-secondary bg-opacity-25 rounded shadow-sm" href="<?= base_url('user/login') ?>">
        <i class="bi bi-person-circle fs-3"></i>
        
          <div class="fw-bold">Login</div>
          
        
      </a>
      <a class="text-decoration-none text-white d-flex align-items-center gap-3 p-3 mb-4 bg-secondary bg-opacity-25 rounded shadow-sm" href="<?= base_url('user/signup') ?>">
        <i class="bi bi-person-plus fs-3"></i>
        
          <div class="fw-bold">Sign Up<span class="ms-2 bonus-badge">10rs. Bonus</span></div>  
          
        
      </a>
      <a class="text-decoration-none text-white d-flex align-items-center gap-3 p-3 mb-4 bg-secondary bg-opacity-25 rounded shadow-sm" href="<?= base_url('user/terms') ?>">
<i class="bi bi-file-earmark-text-fill fs-3"></i>
      
          <div class="fw-bold">Legal Terms</div>
          
        
      </a>

    <?php endif; ?>
     
    </nav>

    <div class="d-flex justify-content-around mt-4">
      <?php if ($this->db->get('system')->row()->whatsapp): ?>
      <a href="https://api.whatsapp.com/send?phone=<?= $this->db->get('system')->row()->whatsapp ?>" class="btn btn-square btn-success d-flex align-items-center justify-content-center" target="_blank" style="width: 50px; height: 50px;">
        <i class="bi bi-whatsapp fs-4"></i>
      </a>
      <?php endif; ?>

      <?php if ($this->db->get('system')->row()->instagram): ?>
      <a href="<?= $this->db->get('system')->row()->instagram ?>" class="btn btn-square btn-instagram d-flex align-items-center justify-content-center" target="_blank" style="width: 50px; height: 50px;">
        <i class="bi bi-instagram fs-4"></i>
      </a>
      <?php endif; ?>

      <?php if ($this->db->get('system')->row()->email): ?>
      <a href="mailto:<?= $this->db->get('system')->row()->email ?>" class="btn btn-square btn-dark d-flex align-items-center justify-content-center" target="_blank" style="width: 50px; height: 50px;">
        <i class="bi bi-envelope fs-4"></i>
      </a>
      <?php endif; ?>
    </div>

    <!--<?php $mlinks = $this->db->where('placement', 1)->get('pages')->result(); ?>-->
    <!--<?php foreach ($mlinks as $link): ?>-->
    <!--<a href="<?= base_url('user/page/'.$link->page_slug) ?>" class="btn btn-outline-light w-100 mb-2"><i class="bi bi-link-45deg"></i> <?= $link->page_name ?></a>-->
    <!--<?php endforeach; ?>-->

    <!--<div class="text-center text-secondary mt-2">-->
    <!--  <?php $flinks = $this->db->where('placement', 2)->get('pages')->result(); ?>-->
    <!--  <?php foreach ($flinks as $link): ?>-->
    <!--  <a href="<?= base_url('user/page/'.$link->page_slug) ?>" class="text-decoration-none small d-block"><i class="bi bi-link"></i> <?= $link->page_name ?></a>-->
    <!--  <?php endforeach; ?>-->
    <!--</div>-->
  </div>
</div>

<style>

.nav-link-custom span {
        font-size: 1.1rem;
    }
.nav-link-custom {
        display: block;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link-custom:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .nav-link-custom i {
        margin-right: 15px;
        font-size: 1.4rem;
    }
  .offcanvas {
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    
    height: 100vh;
  }

  .offcanvas-body .nav-link {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 12px 0;
  }
.offcanvas-body .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 5px; /* Optional: Adds a little rounding on hover */
  }
  .btn-square {
    border-radius: 50%; /* Square buttons with rounded corners */
  }

  .btn-instagram {
    background-color: #E1306C;
    color: white;
  }

  .btn-instagram:hover {
    background-color: #c4295b;
  }

  .offcanvas-header img {
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
  }

  .bottombar {
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 1030;
    background-color: #343a40;
  }

  .bottombar a {
    color: #ffffff;
  }

  .bottombar .fs-1 {
    font-size: 1.5rem;
  }
  
         .bonus-badge {
            background-color: #28a745;
            color: white;
            padding: 5px;
            font-size: 0.9rem;
            border-radius: 5px;
        }
</style>

<!--<div class="bottombar d-md-none shadow">-->
<!--  <div class="container-fluid border-top bg-dark">-->
<!--    <div class="d-flex justify-content-around py-2">-->
<!--      <?php if (isset($user)): ?>-->
<!--      <a href="<?= base_url() ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-house"></i></div>-->
<!--      </a>-->
<!--      <a href="<?= base_url('user/profile') ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-person-circle"></i></div>-->
<!--      </a>-->
<!--      <a href="<?= base_url('user/wallet') ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-wallet2"></i></div>-->
<!--      </a>-->
<!--      <a href="<?= base_url('user/referral') ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-share"></i></div>-->
<!--      </a>-->
<!--      <a href="<?= base_url('user/history') ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-clock-history"></i></div>-->
<!--      </a>-->
<!--      <?php else: ?>-->
<!--      <a href="<?= base_url('user/login') ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-person"></i></div>-->
       
<!--      </a>-->
<!--      <a href="<?= base_url('user/signup') ?>" class="text-center">-->
<!--        <div class="fs-1"><i class="bi bi-person-fill-add"></i></div>-->
        
<!--      </a>-->
<!--      <?php endif; ?>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<div class="col-md-8 col-lg-5 mx-auto" style="position:relative">