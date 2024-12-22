
  
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
            <div class="card col-md-5 text-white bg-dark py-3">
                <div class="card-body text-center">
                  <div class="d-flex flex-column align-items-center mt-2">
                    <img src="<?=base_url('assets/images/'.$this->db->get('system')->row()->brand_logo)?>" height="120px" width="120px"/>
                    <h2><?=$this->db->get('system')->row()->brand_name?> </h2>
                    <p>Admin Login Panel</p>
               
                   
                    <!-- <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button> -->
                  </div>
                </div>
              </div>
              <div class="card col-md-7 p-4 mb-0">
              <?php 
              echo form_open('admin/verifylogin'); 
              ?>
                <div class="card-body">
                  <h1>Login</h1>
                  <p class="text-medium-emphasis">Sign In to your account</p>
                  <div class="input-group mb-3"><span class="input-group-text">
                  <i class="bi bi-person"></i></span>
                    <input class="form-control" type="email" placeholder="Email" name="email" value="<?=$this->session->flashdata('login-email')?>" required>
                  </div>
                  <div class="input-group mb-2"><span class="input-group-text">
                  <i class="bi bi-key"></i>
                      </span>
                    <input class="form-control" type="password" placeholder="Password" name="password" required>
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <p class="text-danger mb-2"><?=$this->session->flashdata('login-error')?></p>
                      <button type="submit" class="btn btn-dark px-4" type="button">Login</button>
                    </div>
                    <div class="col-6 text-end">
                      <!-- <button class="btn btn-link px-0" type="button">Forgot password?</button> -->
                    </div>
                  </div>
                </div>
</form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
   