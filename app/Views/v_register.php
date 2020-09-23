<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href=<?php echo base_url("resources/plugins/fontawesome-free/css/all.min.css")?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=<?php echo base_url("resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css")?>>
  <!-- Theme style -->
  <link rel="stylesheet" href=<?php echo base_url("resources/dist/css/adminlte.min.css")?>>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
	<img src="<?= base_url("resources/dist/img/store.png"); ?>" alt="Umkm" class="brand-image img-circle elevation-3" style="opacity: .8">
	<span class="brand-text font-weight-light">Form Register</span>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Lengkapi data di bawah ini dengan benar</p>

      <?php echo form_open('register/posRegister'); ?>
      <?php
          $inputs = session()->getFlashdata('inputs');
          $errors = session()->getFlashdata('errors');
          $danger = session()->getFlashdata('danger');
          $success = session()->getFlashdata('success');
          if(!empty($errors)){ ?>
          <div class="alert alert-danger" role="alert">
              Whoops! Ada kesalahan saat input data :
              <!-- <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul> -->
          </div>
          <?php
          }
          if(!empty($danger)){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $danger ?>
            </div>
            <?php
            }
          if(!empty($success)){ ?>
          <div class="alert alert-success" role="alert">
              <?php echo $success?>
          </div>
          <?php } 
      ?>
      
        <div class="form-group">
          <label>Nama</label>
          <?php echo $errors['nama'] ?>
          <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
        </div>
        <div class="form-group">
          <label>Email</label>
          <?php echo $errors['email'] ?>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label>Username</label>
          <?php echo $errors['username'] ?>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
          <label>Pasword</label>
          <?php echo $errors['password'] ?>
          <input type="text" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
          <label>No Hp</label>
          <?php echo $errors['no_hp'] ?>
          <input type="number" name="no_hp" class="form-control" placeholder="No HP">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <?php echo $errors['alamat'] ?>
          <textarea type="text" name="alamat" rows="3" class="form-control" placeholder="Alamat"></textarea>
        </div>
      
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src=<?php echo base_url("resources/plugins/jquery/jquery.min.js")?>></script>
<!-- Bootstrap 4 -->
<script src=<?php echo base_url("resources/plugins/bootstrap/js/bootstrap.bundle.min.js")?>></script>
<!-- AdminLTE App -->
<script src=<?php echo base_url("resources/dist/js/adminlte.min.js")?>></script>

</body>
</html>
