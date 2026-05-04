<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Conference</title>

  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= BASE ?>/assets/css/vertical-layout-light/style.css">

  <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon"> 
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0 bg-secondary">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left pt-2 pb-5 px-4 px-sm-5 rounded shadow-lg" id="authlog">
              <div class="brand-logo">
                <img class="w-100" src="<?= ROOT ?>/assets/images/login_logo.webp" alt="logo">
              </div>
              
    
              <span style="color:red;">


              </span>
              
              <?php echo Recaptcha::getScript(); ?>
              <?php echo Recaptcha::renderScript('login_form', 'loginForm'); ?>

              <form class="pt-3" id="loginForm" method="post" action="index.php?controller=authentication&action=authenticate"> 
                 <?php echo Csrf::field(); ?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username/Email" name="username" required> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required> 
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN"> 
                </div>
                <div class="my-2 text-right">
                  <!-- <a href="" class="auth-link text-black">Forgot password?</a> -->
                  <a href="index.php?controller=home&action=home" class="auth-link text-black">Home Page</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <script src="<?= BASE ?>/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= BASE ?>/assets/js/off-canvas.js"></script>
  <script src="<?= BASE ?>/assets/js/hoverable-collapse.js"></script>
  <script src="<?= BASE ?>/assets/js/template.js"></script>
  <script src="<?= BASE ?>/assets/js/settings.js"></script>
  <script src="<?= BASE ?>/assets/js/todolist.js"></script>
</body>

</html>