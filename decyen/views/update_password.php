<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enter Password</title>

    <link rel="stylesheet" href="<?=BASE?>/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?=BASE?>/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?=BASE?>/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=BASE?>/assets/css/vertical-layout-light/style.css">
    <link href="<?=ROOT?>/assets/images/favicon.png" rel="icon">
</head>

<body>

<div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper ">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto ">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 rounded shadow-lg" id="authlog">
                            <div class="brand-logo">
                              <img class="w-100" src="<?=ROOT?>/assets/images/login_logo.webp" alt="logo">
                            </div>


                            <span style="color:red;">
                                <input type="hidden" name="useremail" id="useremail" value="<?php echo $username;?>">


                            </span>
                            <form class="pt-3" method="post" action="index.php?controller=authentication&action=ajaxUpdatePassword">
                                <?php echo Csrf::field(); ?>
                                <div class="form-group">
                                    <input type="text " class="form-control form-control-lg text-dark"
                                        id="exampleInputEmail1" placeholder="Username/Email" name="username" readonly
                                        value="<?php echo $username;?>">
                                    <input type="hidden" name="useremail" id="useremail"
                                        value="<?php echo $username;?>">
                                    <input type="hidden" name="userid" value="<?php echo $userid;?>">
                                </div>


                                <div class="form-group pass">
                                    <input type="password" class="form-control form-control-lg" id="newpassword"
                                        placeholder="New password" name="new_password" required>
                                </div>
                                <div class="form-group pass">
                                    <input type="text" class="form-control form-control-lg" id="confirmpass"
                                        placeholder="Confirm New Password" name="confirmpass" required>
                                    <span id="cnfm_msg"></span>
                                </div>
                                <div class="mt-3 pass">
                                    <button class="btn btn-primary btn-block" id="csubmit" type="submit">Submit</button>
                                </div>
                                <?php

                              
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

  <script>
    $(document).ready(function() {

        var err_or = true;
        $('#confirmpass').keyup(function() {
            confirm_pass();
        });

        function confirm_pass() {

            var new_pass = $('#newpassword').val();
            var confirmpass = $('#confirmpass').val();
            if (new_pass != confirmpass) {
                $('#cnfm_msg').html("not matched");
                $('#cnfm_msg').css("color", "red");
                err_or = false;
                return false;

            } else {

                $('#cnfm_msg').html("matched");
                $('#cnfm_msg').css("color", "green");
            }
        }
    });  
 </script>