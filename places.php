<?php session_start(); ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Batangas</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logo2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&family=Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/rater-js/lib/style.css"> 
  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style type="text/css">
#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}    
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" class="d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="img/logo.png" alt="" style="height: 80px !important;">
       <!--  <h1>Province of Batangas</h1> -->
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="places.php" class="active">Places</a></li>
        </ul>
      </nav><!-- .navbar -->

      <?php include 'profile.php' ?>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->


  <main id="main">

    <section class="chefs section-bg">
    </section>  

    <!-- ======= Chefs Section ======= -->
    <section id="chefs" class="chefs section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>All Postings</h2>
          <p>All places in <span>Batangas</span></p>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>Sort by District</label>
            <select class="form-control" id="district">
              <option>
                
              </option>
            </select>
          </div> 
          <div class="col-md-3">
            <label>Sort by Category</label>
            <select class="form-control" id="sortcategory">
            
                <option value="0"  selected="">All Categories</option>
                <option value="Historical">Historical</option>
                <option value="Falls and Rivers">Falls and Rivers</option>
                <option value="Resorts">Resorts</option>
                <option value="Coffee Shop">Coffee Shop</option>
                <option value="Restaurant">Restaurant</option>
                <option value="Eatery">Eatery</option>
                <option value="Leisure Spots">Leisure Spots</option>
           
            </select>
          </div> 
          <div class="col-md-4">
            <label>Search Place</label>
            <input type="text" id="placename" class="form form-control" placeholder="Search by keyword">
          </div> 
        </div>
        <br>
        <div class="row gy-4" id="post-container">



        </div>

      </div>
    </section><!-- End Chefs Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">



    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Batangas</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a>Batangas</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

    <?php include 'modal.php' ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/rater-js/index.js?v=2"></script>
  <script src="js/rater-js.js"></script>  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="js/system.js"></script>
  <script type="text/javascript">

    $.ajax({
        url:"api/load-post-all",
        type: "GET",
        dataType: "json",
        success: (data) => { 

        $("#post-container").empty();
        
        $.each(data.posts, (i, e)=>{

          $("#post-container").append(`
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <div class="member-img">
                <img src="${e.images[0].dir}" class="img-fluid" alt="" style="height: 255px !important;">

              </div>
              <div class="member-info">
                <h4>${e.title}</h4>
                <span>Posted: ${e.date_posted}</span>
                <span>${e.address}</span>
                <div id="rater-${e.id}"></div>
                <p>${e.desc}</p>
                <a class="btn btn-danger" href="viewpost.php?id=${e.id}"><i class="bi bi-eye"></i> View more</a>
              </div>
            </div>
          </div>
          `)
        raterJs({
                max:5, 
                rating: Number(e.rating), 
                element:document.querySelector("#rater-"+e.id), 
                disableText:"Custom disable text!", 
                ratingText:"My custom rating text {rating}",
                showToolTip:true
            })
        });  
        $("#district").empty();
        $("#district").append(`
          <option value="0" >All Districts</option>
        `);
        $.each(data.district, (i, e)=>{
          $("#district").append(`
            <option value="${e.id}">${e.district_name}</option>
          `);
        });

        }
       });

  </script>
</body>

</html>