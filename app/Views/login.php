<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hisona Store | login</title>
  <link rel="icon" href="<?= base_url('assets/img/store.jpg') ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
  
</head>
<body class="hold-transition login-page bg-info">

<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body bg-white img-circle">
      
      
      <p class="login-box-msg" >
        <img src="<?= base_url('assets/img/store.jpg') ?>" width="20%" >
        <div style="text-align: center;" >
        <h1 style="font-size: 30px; font-style: bold;">HISONA STORE</h1>
      </div>
        <br> <p style="text-align: center; font-style:oblique; opacity: 50%;">Sign in to manage your store inventory</p>
      </p>

      <!-- ERROR MESSAGE ONLY -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('/auth') ?>" method="post">
        <?= csrf_field() ?>

        <div class="input-group mb-3 shadow">
          <input type="username" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3 shadow">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">Remember Me</label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-danger btn-block">
              <i class='fas fa-sign-in-alt'></i> Sign in
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>