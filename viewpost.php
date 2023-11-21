<?php 
session_start(); 

require 'vendor/autoload.php';
use Hashids\Hashids;

$hash = new Hashids('', 10);

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'batangas_db';
DB::$encoding = 'utf8';

$newid = $hash->decode($_GET['id'])[0];
$info = DB::query("SELECT * FROM posts Where id='$newid'");


       

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

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
          <li><a href="places.php">Places</a></li>
        </ul>
      </nav><!-- .navbar -->

      <?php include 'profile.php' ?>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <?php include 'modal.php' ?>
  <input type="text" id="postid" hidden="" value="<?php echo $_GET['id']; ?>">
  <main id="main">

    <section class="chefs section-bg">
    </section>  


    <!-- ======= Chefs Section ======= -->
    <section id="chefs" class="chefs section-bg " style="background-color: white;">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <p><span id="title">Recent</span></p>
        </div>

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="row" id="img-row">
                


            </div>
          </div>

          <div class="col-md-6">
            <div class="chef-member">
              <div class="member-info" id="place-info">

              </div>
            </div>
          </div>
          <br>
          <div id="googleMap" style="width:100%;height:400px;"></div>
        </div>

      </div>
    </section><!-- End Chefs Section -->

    <section id="chefs" class="chefs section-bg " style="background-color: white;">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <p><span>Comments</span></p>
        </div>

        <div class="row gy-4">

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" >Leave a comment at rate this place.</label>
            <textarea class="form-control" id="usercomment" rows="3" ></textarea>
            <br>
            <button class="btn btn-danger" style="float: right;" id="postcomment">Comment</button>
          </div>

        </div>
        <div class="row gy-4" id="comments-row">


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

  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

  <script src="assets/rater-js/index.js?v=2"></script>
  <script src="js/rater-js.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="js/system.js"></script>
  <script type="text/javascript">
  function myMap() {
    console.log("loaded");
  var mapProp= {
      center:new google.maps.LatLng('<?= $info[0]['latitude'] ?>', '<?= $info[0]['longitude'] ?>'),
      zoom:15,
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  var myLatlng = new google.maps.LatLng('<?= $info[0]['latitude'] ?>','<?= $info[0]['longitude'] ?>');

  var marker = new google.maps.Marker({
      position: myLatlng,
      title:"Places!"
  });

  // To add the marker to the map, call setMap();
  marker.setMap(map);

  }
    $.ajax({
        url:"api/load-single-post",
        type: "POST",
        dataType: "json",
        data: {
           id: $("#postid").val()
        },
        success: (data) => { 

        $("#title").text(data.posts[0].title);  

        $.each(data.posts[0].images, (i, e)=>{

          $("#img-row").append(`
            <div class="col-md-4" style="  padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;">
              <a
                 data-fancybox="gallery"
                 data-src="${e.dir}"
                 data-caption="Picture taken as of November 2023,&lt;br /&gt;Copyright &lt;em&gt;User&lt;/em&gt; owner"c
                 >
                <img src="${e.dir}" style="height: 200px; width: 200px;" />
              </a>
            </div>
          `)

        });

        $("#place-info").empty().append(`
          <h4>${data.posts[0].title}</h4>
          <span>${data.posts[0].address}</span>
          <p>${data.posts[0].desc}</p>
          <h4>Transportation Info</h4>
          <p>${data.posts[0].transpo}</p>
          <h4>Place History</h4>
          <p>${data.posts[0].history}</p>
        `);

        Fancybox.bind('[data-fancybox]', {
          // Your custom options
        }); 

        $("#comments-row").empty();
        $.each(data.comments, (i, e)=>{
          $("#comments-row").append(`
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <h4>${e.username}</h4>
                      <div class="stars">
                      <div id="rater-${e.id}"></div>
                      </div>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        ${e.comment}
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>

                    </div>
                  </div>
          `);
          
          raterJs({
              max:5, 
              rating: Number(e.rate), 
              element:document.querySelector("#rater-"+e.id), 
              disableText:"Custom disable text!", 
              ratingText:"My custom rating text {rating}",
              showToolTip:true,
              rateCallback:function rateCallback(rating, done) {
                  starRating.setRating(rating); 
                  starRating.disable(); 
                  done(); 
              }
          })

        })

        }
       });

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1jYeeUK51mgxab03YqTxuZeFFZZDqEIA&callback=myMap"></script>
</body>

</html>