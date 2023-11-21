<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="../index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../img/logo.png" width="180" alt="">
                </a>
                <p class="text-center">Admin Panel</p>
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">

                  <a style="cursor: pointer;" id="signin" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</a>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    
  $(document).on("click", "#signin", ()=>{
    console.log("sadasd");
  $.ajax({
      url:"../api/user-admin",
      type: "POST",
      dataType: "json",
      data: {
          email: $("#email").val(),
          password: $("#password").val()
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

      if (data.status == 1) {

      $("#login-modal").modal("hide");

      window.location.href = "http://localhost/batangas/admin/?dashboard";

      }else{

      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: data.response
      });
      
      }


      }
     });

  });  


  </script>
</body>

</html>