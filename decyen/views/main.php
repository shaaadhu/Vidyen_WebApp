<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Conference Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/css/vendor.bundle.base.css">
  <link href="<?= BASE ?>/assets/vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE ?>/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE ?>/assets/js/select.dataTables.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= BASE ?>/assets/css/vertical-layout-light/style.css?v=3">
  <link rel="stylesheet" href="<?= BASE ?>/assets/css/regi.css">
  <!-- endinject -->
  <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">


</head>

<body>
  <div class="container-scroller ">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 scol-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5 " href="index.php?controller=authentication&action=dashboard">
          <h2 class="text-primary"><b>VIDYEN</b></h2>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php?controller=authentication&action=dashboard"><img src="<?= ROOT ?>/assets/images/favicon.png" alt="logo" style="height: 43px; width: 100%;" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class=" navbar-toggler align-self-center " type="button" data-toggle="minimize">
          <i class=" fa-solid fa-chevron-left"></i>
        </button>

        <ul class="navbar-nav mr-lg-2">
          <!--<li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li> -->
        </ul>

        <ul class="navbar-nav navbar-nav-right pr-2">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?= BASE ?>/assets/images/avatar.png" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

              <a href="index.php?controller=authentication&action=logout" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center p-0" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>

    <?php
    ?>
    <div class="container-fluid page-body-wrapper mt-4">

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link " href="index.php?controller=authentication&action=dashboard">
              <i class="fa-solid fa-border-all menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <?php


          // admin stART HERE

          if ($user_type == 'admin') {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?controller=admin&action=admin_reg_view">
                <i class="fa-solid fa-people-group menu-icon"></i>
                <span class="menu-title">Registration</span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="index.php?controller=admin&action=preconference_view">
                <i class="fa-solid fa-file-alt menu-icon"></i>
                <span class="menu-title">Pre-Conference</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=admin&action=workshop_view">
                <i class="fa-solid fa-file-alt menu-icon"></i>
                <span class="menu-title">Workshop</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=admin&action=abstract_view">
                <i class="fa-solid fa-file-arrow-up menu-icon"></i>
                <span class="menu-title">Abstract</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=admin&action=reviewer_view">
                <i class="fa-solid fa-chalkboard-user menu-icon"></i>
                <span class="menu-title">Reviewer</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=admin&action=conference_room_view">
                <i class="fa-solid fa-building menu-icon"></i>
                <span class="menu-title">Conference room</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#certificates" aria-expanded="false" aria-controls="certificates">
                <i class="fa-solid fa-certificate menu-icon"></i>
                <span class="menu-title">Certificates</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="certificates">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link " href="index.php?controller=admin&action=certificate_generates">Generate Certificates</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="index.php?controller=admin&action=viewGeneratedCertificates">View Generated List</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=admin&action=contact_view">
                <i class="fa-solid fa-comments menu-icon"></i>
                <span class="menu-title">Contact</span>
              </a>
            </li>
          <?php
          }

          if ($user_type == 'participant') {
          ?>


            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=participant&action=regestration_view">
                <i class="fa-solid fa-file-pen menu-icon"></i>
                <span class="menu-title">Registration View</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=participant&action=preconference_view">
                <i class="fa-solid fa-file-alt menu-icon"></i>
                <span class="menu-title">Pre-Conference</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=participant&action=workshop_view">
                <i class="fa-solid fa-file-alt menu-icon"></i>
                <span class="menu-title">Workshop</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=participant&action=abstract_view">
                <i class="fa-solid fa-file-arrow-up menu-icon"></i>
                <span class="menu-title">Abstract</span>
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="index.php?controller=participant&action=certificates_view">
                <i class="fa-solid fa-certificate menu-icon"></i>
                <span class="menu-title">Certificate</span>
              </a>
            </li>

            <?php
          }


          if ($user_type == 'reviewer') {




            if ($rev_type == 'Abstract Reviewer') {
            ?>

              <li class="nav-item  ">
                <a class="nav-link " href="index.php?controller=reviewer&action=abstract_view">
                  <i class="fa-solid fa-file-arrow-up menu-icon"></i>
                  <span class="menu-title">Abstract</span>
                </a>
              </li>

            <?php }
            if ($rev_type == 'PreConference Reviewer') {
            ?>

              <li class="nav-item">
                <a class="nav-link " href="index.php?controller=reviewer&action=preconference_view">
                  <i class="fa-solid fa-file-pen menu-icon"></i>
                  <span class="menu-title">Pre Conference</span>
                </a>
              </li>


            <?php }
            if ($rev_type == 'Workshop Reviewer') {
            ?>
              <li class="nav-item">
                <a class="nav-link " href="index.php?controller=reviewer&action=workshop_view">
                  <i class="fa-solid fa-file-pen menu-icon"></i>
                  <span class="menu-title">Workshop</span>
                </a>
              </li>
          <?php
            }
          }
          ?>

          <!--  <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="form-elements" data-target="#family_new">
            <i class="fa-solid fa-key menu-icon"></i>
            <span class="menu-title">Password</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="family_new">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="change_password.php">Change Password</a></li>

            </ul>
          </div>
        </li>  -->

          <li class="nav-item ">
            <a class="nav-link" href="index.php?controller=authentication&action=logout">
              <i class="fa-solid fa-right-from-bracket menu-icon"></i>
              <span class="menu-title">Logout</span></a>
          </li>

        </ul>
      </nav>

      <div class="main-panel">

        <!-- plugins:js -->
        <script src="<?= BASE ?>/assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- Plugin js for this page -->
        <script src="<?= BASE ?>/assets/vendors/chart.js/Chart.min.js"></script>
        <script src="<?= BASE ?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="<?= BASE ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="<?= BASE ?>/assets/js/dataTables.select.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- inject:js -->
        <script src="<?= BASE ?>/assets/js/off-canvas.js"></script>
        <script src="<?= BASE ?>/assets/js/hoverable-collapse.js"></script>
        <!-- <script src="<?= BASE ?>/assets/js/template.js"></script> -->
        <script src="<?= BASE ?>/assets/js/settings.js"></script>
        <script src="<?= BASE ?>/assets/js/todolist.js"></script>

        <!-- Custom js for this page-->
        <script src="<?= BASE ?>/assets/js/dashboard.js"></script>
        <script src="<?= BASE ?>/assets/js/Chart.roundedBarCharts.js"></script>


        <?php
        if (file_exists($content_file)) {
          require_once $content_file;
        }
        ?>

        <script>
          (function($) {
            'use strict';
            $(function() {
              var body = $('body');
              var contentWrapper = $('.content-wrapper');
              var scroller = $('.container-scroller');
              var footer = $('.footer');
              var sidebar = $('.sidebar');

              // Get current controller and action from URL
              var params = new URLSearchParams(window.location.search);
              var currentController = params.get('controller');
              var currentAction = params.get('action');

              // Add active class to nav-link based on controller/action dynamically
              function addActiveClass(element) {
                var href = element.attr('href');
                var hrefParams = new URLSearchParams(href.split('?')[1] || '');
                var linkController = hrefParams.get('controller');
                var linkAction = hrefParams.get('action');

                if (currentController === linkController && currentAction === linkAction) {
                  element.parents('.nav-item').last().addClass('active');

                  if (element.parents('.sub-menu').length) {
                    element.closest('.collapse').addClass('show');
                    element.addClass('active');
                  }

                  if (element.parents('.submenu-item').length) {
                    element.addClass('active');
                  }
                }
              }

              // Apply to sidebar links
              $('.nav li a', sidebar).each(function() {
                addActiveClass($(this));
              });

              // Apply to horizontal menu links
              $('.horizontal-menu .nav li a').each(function() {
                addActiveClass($(this));
              });

              // Close other submenu in sidebar on opening any
              sidebar.on('show.bs.collapse', '.collapse', function() {
                sidebar.find('.collapse.show').collapse('hide');
              });

              // Change sidebar and content-wrapper height
              applyStyles();

              function applyStyles() {
                // Applying perfect scrollbar
                if (!body.hasClass("rtl")) {
                  if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
                    const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
                  }
                  if ($('.chats').length) {
                    const chatsScroll = new PerfectScrollbar('.chats');
                  }
                  if (body.hasClass("sidebar-fixed")) {
                    if ($('#sidebar').length) {
                      var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
                    }
                  }
                }
              }

              $('[data-toggle="minimize"]').on("click", function() {
                if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
                  body.toggleClass('sidebar-hidden');
                } else {
                  body.toggleClass('sidebar-icon-only');
                }
              });

              // checkbox and radios
              $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

              // Horizontal menu in mobile
              $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
                $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
              });

              // Horizontal menu navigation in mobile menu on click
              var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
              navItemClicked.on("click", function(event) {
                if (window.matchMedia('(max-width: 991px)').matches) {
                  if (!($(this).hasClass('show-submenu'))) {
                    navItemClicked.removeClass('show-submenu');
                  }
                  $(this).toggleClass('show-submenu');
                }
              });

              $(window).scroll(function() {
                if (window.matchMedia('(min-width: 992px)').matches) {
                  var header = $('.horizontal-menu');
                  if ($(window).scrollTop() >= 70) {
                    $(header).addClass('fixed-on-scroll');
                  } else {
                    $(header).removeClass('fixed-on-scroll');
                  }
                }
              });
            });

            // focus input when clicking on search icon
            $('#navbar-search-icon').click(function() {
              $("#navbar-search-input").focus();
            });
          })(jQuery);
        </script>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. <a href="#" target="_blank">VIDYEN</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Developed By <a target="_blank" href="http://ytincubator.com/">YTI</a></span>
          </div>
          <!-- Sponsor Section -->
          
        </footer>
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->

  </div>
  <!-- container-scroller -->

</body>

</html>