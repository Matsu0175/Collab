<?php

session_start(); 

if (!isset($_SESSION["auth_logged_in"])) {

  header('location: login.php');

}


?>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link rel="shortcut icon" type="image/png" href="../img/logo.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/rater-js/lib/style.css"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <link rel="stylesheet" href="../assets/extensions/filepond/filepond.css">
  <link rel="stylesheet" href="../assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.4/filepond.css" />

  <style type="text/css">
    .fancybox__container {
      z-index: 1080 !important
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="../index.php" target="_blank" class="text-nowrap logo-img">
            <img src="../img/logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">


            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MENU</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php if (isset($_GET['dashboard'])) { echo 'active'; } ?>" href="?dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php if (isset($_GET['posts'])) { echo 'active'; } ?>" href="?posts" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Site Posts</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php if (isset($_GET['gallery'])) { echo 'active'; } ?>" href="?gallery" aria-expanded="false">
                <span>
                  <i class="ti ti-camera"></i>
                </span>
                <span class="hide-menu">Gallery</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php if (isset($_GET['feedbacks'])) { echo 'active'; } ?>" href="?feedbacks" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Feedbacks</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php if (isset($_GET['users'])) { echo 'active'; } ?>" href="?users" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>

            
            </li>
          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="https://cdn-icons-png.flaticon.com/512/9131/9131529.png" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="?myprofile" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a style="cursor: pointer;" id="logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container">


        <?php

        if (isset($_GET['dashboard'])) {
          include 'pages/dashboard.php';
        }else if (isset($_GET['posts'])) {
          include 'pages/posts.php';
        }else if (isset($_GET['gallery'])) {
          include 'pages/gallery.php';
        }else if (isset($_GET['feedbacks'])) {
          include 'pages/feedback.php';
        }else if (isset($_GET['users'])) {
          include 'pages/user.php';
        }else if (isset($_GET['myprofile'])) {
          include 'pages/myprofile.php';
        }


        ?>

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="" target="_blank" class="pe-1 text-primary text-decoration-underline">Sample.com</a> Distributed by <a href="">Sample</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/rater-js/index.js?v=2"></script>
  <script src="../js/rater-js.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>


  <!--FilePond -->
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script> 
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script> 
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.4/filepond.min.js"></script>
  
  <?php

  if (isset($_GET['dashboard'])) {
   ?> 
    <script src="js/dashboard.js"></script> 
  <?php
  }else if (isset($_GET['posts'])) {
   ?> 
    <script src="js/post.js"></script> 
  <?php
  }else if (isset($_GET['gallery'])) {
   ?> 
    <script src="js/gallery.js"></script> 
  <?php
  }else if (isset($_GET['feedbacks'])) {
   ?> 
    <script src="js/feedback.js"></script> 
  <?php
  }else if (isset($_GET['users'])) {
   ?> 
    <script src="js/user.js"></script> 
  <?php
  }else if (isset($_GET['myprofile'])) {
   ?> 
    <script src="js/myprofile.js"></script> 
  <?php
  }

  ?>

  <script type="text/javascript">
  $(document).on("click", "#logout", ()=>{

  $.ajax({
      url:"../api/user-logout",
      type: "POST",
      dataType: "json",
      data: {
          data: 1
      },
      beforeSend: (e) => {
      Swal.fire({
        html: 'Loading...',
        didOpen: () => {
          Swal.showLoading()
        }
      })
      },
      success: (data) => { 

      Swal.close(); 

      location.reload();


      }
     });

  });
  </script>
</body>

</html>