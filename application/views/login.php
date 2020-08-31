<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><img src="<?= base_url().'uploads/logo/logo.png' ?>" class="img img-responsive img-circle" width="150" height="150"> </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Form Login</b></p>

      <form action="<?= base_url().'auth/login' ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          
        </div>
        <?= form_error('username'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           
        </div>
        <?= form_error('password'); ?>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>

      <?php
      if($this->session->flashdata('message')){
        echo $this->session->flashdata('message');
      }
      ?>
    <!-- /.login-card-body -->
  </div>
</div>