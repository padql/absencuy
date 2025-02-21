<?php
  session_start();

// Import header dan koneksi database
include 'header.html';
include 'db/conn.php';

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Cuy Absen</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- font awesome style -->
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <script>
    window.onpopstate = function () {
    document.getElementById("myModal").style.display = "block";
};
  </script>
</head>

<body>
    <!-- slider section -->
    <section class="slider_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <h1 class="index">
                SMK NEGERI
                MARINEFORD
              </h1>
              <p class="index-p">
                Absensi siswa SMK Negeri Marineford 1 berbasis web.
                Web absensi untuk mempermudah para guru 
                dalam mengabsen siswa.
              </p>
                  <a href="login.php" class="btn btn-primary">
                    Login
                  </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/absen.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
</body>

</html>

<?php
include 'footer.html';
?>