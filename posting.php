<?php 
session_start(); 

if (!isset($_SESSION["auth_logged_in"])) {

  header('location: index.php');

}

?>
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

<!--   <link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
  <link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.4/filepond.css" />
  
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

      <a href="index.html" class="d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="img/logo.png" alt="" style="height: 80px !important;">
       <!--  <h1>Province of Batangas</h1> -->
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="places.php">Places</a></li>
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
        <button class="btn btn-danger" id="makepost"><i class="bi bi-camera"></i> Make a post</button>
        <div class="section-header">
          <h2>My Postings</h2>
          <p>Your <span>Recent</span> Posts</p>
        </div>

        <div class="row gy-4" id="post-container">



        </div>

      </div>
    </section><!-- End Chefs Section -->


  </main><!-- End #main -->

  <footer id="footer" class="footer">



    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Batangas</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Batangas</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <?php include 'modal.php' ?>

  <div class="modal fade" id="details-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">District</label>
          <select class="form-control" id="edistrict">
            
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Title</label>
          <input type="text" class="form-control" id="epost-title" placeholder="Name of Place">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Address</label>
          <input type="text" class="form-control" id="epost-address" placeholder="Address of Place">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Transportation Info</label>
          <textarea class="form-control" id="epost-transpo" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Description</label>
          <textarea class="form-control" id="epost-desc" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">History</label>
          <textarea class="form-control" id="epost-history" rows="3"></textarea>
        </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="update">Update post</button>
        </div>
      </div>
    </div>
  </div>
  
<div class="modal fade" id="post-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Location Map</label>
      <div id="googleMap" style="width:100%;height:400px;"></div>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Place Images</label>
      <input type="file" class="filepond-233" name="image233" data-allow-reorder="true" data-max-file-size="15MB" data-max-files="15" multiple="" />
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">District</label>
      <select class="form-control" id="district">
        
      </select>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input type="text" class="form-control" id="post-title" placeholder="Name of Place">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Category</label>
      <select class="form-control" id="category">
          <option value="Historical">Historical</option>
          <option value="Falls and Rivers">Falls and Rivers</option>
          <option value="Resorts">Resorts</option>
          <option value="Coffee Shop">Coffee Shop</option>
          <option value="Restaurant">Restaurant</option>
          <option value="Eatery">Eatery</option>
          <option value="Leisure Spots">Leisure Spots</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Address</label>
      <input type="text" class="form-control" id="post-address" placeholder="Address of Place">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Transportation Info</label>
      <textarea class="form-control" id="post-transpo" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Description</label>
      <textarea class="form-control" id="post-desc" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">History</label>
      <textarea class="form-control" id="post-history" rows="3"></textarea>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="published" data-img="0" data-lat="0" data-long="0">Publish post</button>
      </div>
    </div>
  </div>
</div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--FilePond -->
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script> 
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script> 
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.4/filepond.min.js"></script>

  <script src="assets/rater-js/index.js?v=2"></script>
  <script src="js/rater-js.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="js/system.js"></script>


  <script type="text/javascript">

  var map;
  var marker = null;

    $.ajax({
        url:"api/load-post",
        type: "GET",
        dataType: "json",
        success: (data) => { 

        $("#post-container").empty();
        
        $.each(data.posts, (i, e)=>{
          let text = '';
          if (e.status == 1) {
            text = '<b style="color: blue;">Approved</b>';
          }else if (e.status == 2) {
            text = '<b style="color: red;">Rejected</b>';
          }else{
            text = '<b style="color: orange;">Pending</b>';
          }

          $("#post-container").append(`
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <div class="member-img">
                <img src="${e.images[0].dir}" class="img-fluid" alt="" style="height: 255px !important;">

              </div>
              <div class="member-info">
                <h4>${e.title}</h4> ${data.online == 1 ? text : ''}
                <span>Posted: ${e.date_posted}</span>
                <span>${e.address}</span>
                <div id="rater-${e.id}"></div>
                <p>${e.desc}</p>
                <a class="btn btn-danger" href="viewpost.php?id=${e.id}"><i class="bi bi-eye"></i> View more</a>
                ${ data.online == 1 ? '<button class="btn btn-primary" id="edit-post" data-id="'+e.id+'"> Edit </button> <button class="btn btn-danger" id="delete-post" data-id="'+e.id+'"> Delete </button>' : '' }
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
        $.each(data.district, (i, e)=>{
          $("#district").append(`
            <option value="${e.id}">${e.district_name}</option>
          `);
        });
        $("#edistrict").empty();
        $.each(data.district, (i, e)=>{
          $("#edistrict").append(`
            <option value="${e.id}">${e.district_name}</option>
          `);
        });



        }
       });


  function myMap() {

  var mapProp= {
      center:new google.maps.LatLng(13.717081, 121.107087),
      zoom:10,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

  google.maps.event.addListener(map, 'click', function(event) {

  $("#published").attr("data-lat", event.latLng.lat()); 
  $("#published").attr("data-long", event.latLng.lng());   
  var myLatlng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());

   if (marker) {
       marker.setMap(null);
   }

   marker = new google.maps.Marker({
       position: myLatlng,
       map: map,
       draggable: true
   });

  });

  }




     // google.maps.event.addDomListener(window, 'load', initialize);

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1jYeeUK51mgxab03YqTxuZeFFZZDqEIA&callback=myMap"></script>
</body>

</html>