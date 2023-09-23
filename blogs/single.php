<?php
include_once('../lib/database.php');
$conn = OpenCon();
// Get single post slug
$post_slug = $_GET['post_slug'];
$sql = "SELECT * FROM blogs WHERE slug='$post_slug' AND published=true";
$result = mysqli_query($conn, $sql);
$conn->close();
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $row['title']; ?> | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="<?php echo $row['mdescription'] ?>">
  <meta name="keywords" content="<?php echo $row['keywords'] ?>">

  <!-- Bootstrap 3.3.7 -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

  <link rel="stylesheet" href="../bower_components/jquery-ui/jquery-ui.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- <link rel="stylesheet" href="js/dist/assets/owl.carousel.css">
  <link rel="stylesheet" href="js/dist/assets/owl.theme.default.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/noborder.css">
  <link rel="stylesheet" href="../css/converter.css">
  <link rel="stylesheet" href="../js/ckeditor5/build/content-styles.css" type="text/css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>



  <style>
    .pager li>a,
    .pager li>span {
      color: white !important;
      background: #337ab7 !important;
    }

    hr.divider {
      max-width: 3.25rem;
      border-width: 0.2rem;
      border-color: #f4623a;
    }

    /* table {
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    }
    table, td {
        border: 1px solid black;
    } */
  </style>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-123754068-1');
  </script>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body>
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <div class="nav-cont">
    <nav class="navbar navbar-expand-lg navbar-dark py-3 py-lg-0">

<div class="container">

    <a href="/home" class="navbar-brand p-0 mt-3">
        <h1 class="m-0"><img src="../img/logo.png" alt="IBrlive Pvt Ltd" class="logo"></h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="/home" class="nav-item nav-link active">Home</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                <div class="dropdown-menu m-0">
                    <a href="/usd-inr-forecast" class="dropdown-item">Forecast</a>
                    <a href="/forward-rates" class="dropdown-item">Forward rate</a>
                    <a href="/central-bank-interest-rates" class="dropdown-item">Benchmark rate</a>
                    <a href="/plans-and-pricing" class="dropdown-item">Rate alert</a>
                </div>
            </div>
            <a href="/lei-code" class="nav-item nav-link">Get LEI</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Resources</a>
                <div class="dropdown-menu m-0">
                    <a href="/blogs" class="dropdown-item">Blogs</a>
                    <a href="https://ibrlive.estudium.org/products/Paid-NISM-Series%20V-A-Mutual%20Funds-English" target="_blank" class="dropdown-item">Mutual Funds</a>
                    <a href="https://ibrlive.estudium.org/products/Paid-IIBF-FE-Foreign%20Exchange-English" target="_blank" class="dropdown-item">Foreign Exchange</a>
                    <a href="/rbi-master-directions" class="dropdown-item">RBI Master Directions</a>
                </div>
            </div>
            <a href="/plans-and-pricing" class="nav-item nav-link">Plan and Pricing</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Company</a>
                <div class="dropdown-menu m-0">
                    <a href="/about" class="dropdown-item">About</a>
                    <a href="/contact" class="dropdown-item">Contact Us</a>
                </div>
            </div>
        </div>
        <?php if ($user == "") { ?>

            <div class="dropdown px-4 ms-3">
                <button class="btn btn-secondary dropdown-toggle my-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/register">New User</a></li>
                    <li><a class="dropdown-item" href="/login">Existing User</a></li>
                </ul>
            </div>

        <?php } else { ?>
            <div class="dropdown px-4 ms-3">
                <button class="btn btn-secondary dropdown-toggle my-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="dropdown-item"><a href="#"><b> <?= $user ?> </b></a></li>
                    <li class="dropdown-item"><a href="/profile"><b>My Profile</b></a></li>
                    <li class="dropdown-item"><a href="/viewCart"><b>View Cart</b></a></li>
                    <li class="dropdown-item"><a href="/logout"><b>Logout</b></a></li>
                </ul>
            </div>
        <?php } ?>
    </div>

</div>
</nav>
    </div>
    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Blog </h4>
      </div>
    </div>
  </div>
  <?php //include_once('../include/top-menu.php'); 
  ?>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- Right Column -->
          <div class="col-sm-8">

            <!-- List-Group Panel -->
            <div class="panel panel-default panelBorderColor" style="margin-top: 10px;">
              <div class="panel-heading">
                <h1 class="panel-title"><strong> <?php echo $row['title']; ?> </strong></h1>
              </div>
              <div class="panel-body" style="font-family: Verdana, sans-serif; font-size: 14px;">

                <strong style="font-size: 18px;">Author:</strong> <?php echo $row['author']; ?>
                <hr />
                <?php if ($row['image_path']) { ?>
                  <img class="img-responsive center-block" style="width: 100%; margin-bottom:20px" src="<?php echo 'https://ibrlive.com/' . $row['image_path']; ?>" />
                <?php  } ?>
                <br />
                <?php echo html_entity_decode($row['description'], ENT_QUOTES); ?>

              </div>
            </div>
          </div>
          <?php
          include("nav.php");
          ?>

          <!-- <div class="col-sm-10">
            <ul class="pager">
   
            <li class="next"><a href="eefc-accounts-everything-exporters-need-to-know">Next <i class="fa fa-angle-double-right"></i></a></li>
          </ul>  
          </div>        -->
        </div><!-- ./row -->
      </section>
    </div>
  </div>


  <!-- Footer start here -->
  <div class="container-fluid bg-dark text-light pt-4 footer-se mt-5 wow bg-4 footer " data-wow-delay="0.1s">
    <div class="container">
      <div class="row gx-5">
        <div class="col-lg-12 col-md-6">
          <div class="section-title text-center position-relative pb-3 mb-4 mx-auto">
            <h3 class="text-light mb-4 mt-4">Talk To Us</h3>
            <h5 class="text-light mb-4" style="font-weight: 300 !important;">Feel free to call, email, or hit us up on our social media accounts</h5>
            <a href="https://ibrlive.com/contact" class="btn btn-light py-md-3 px-md-5 animated">CONTACT US</a>
          </div>
        </div>
      </div>
      <div class="row gx-5">
        <div class="col-lg-4 col-md-12 pt-2 mb-5">
          <div class="section-title section-title-sm position-relative pb-3 mb-4">
            <h3 class="text-light mb-2">PHONE</h3>
            <h5 class="text-light" style="font-weight: 300 !important;">+91-9991622344</h5>
          </div>
          <p class="f-18"><a href="https://ibrlive.com/privacy-policy" class="text-light">Privacy Policy</a></p>
        </div>
        <div class="col-lg-4 col-md-12 pt-2 mb-5">
          <div class="section-title section-title-sm position-relative pb-3 mb-4">
            <h3 class="text-light mb-2">EMAIL</h3>
            <h5 class="text-light" style="font-weight: 300 !important;">contact@ibrlive.com</h5>
          </div>
          <p class="f-18"><a href="https://ibrlive.com/terms-and-conditions" class="text-light">Terms and Conditions</a></p>
        </div>
        <div class="col-lg-4 col-md-12 pt-2 mb-5">
          <div class="section-title section-title-sm position-relative pb-3 mb-4">
            <h3 class="text-light mb-2">FOLLOW US</h3>
            <h4 style="font-weight: 300 !important;"><a href="https://www.facebook.com/ibrliveindia/" class="text-light"><i class="fab fa-facebook-f"></i></a> &nbsp; <a href="https://twitter.com/ibr_live" class="text-light"><i class="fab fa-twitter"></i></a> &nbsp; <a href="https://www.instagram.com/ibrlive/" class="text-light"><i class="fab fa-instagram"></i></a> &nbsp; <a href="https://www.linkedin.com/company/ibrlive/" class="text-light"><i class="fab fa-linkedin"></i></a></h4>
          </div>
          <p class="f-18"><a href="https://ibrlive.com/refund-cancellation" class="text-light">Refund and Cancellation</a></p>
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/wow/wow.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/waypoints/waypoints.min.js"></script>
  <script src="../lib/counterup/counterup.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    (function(w, d, s, c, r, a, m) {
      w['KiwiObject'] = r;
      w[r] = w[r] || function() {
        (w[r].q = w[r].q || []).push(arguments)
      };
      w[r].l = 1 * new Date();
      a = d.createElement(s);
      m = d.getElementsByTagName(s)[0];
      a.async = 1;
      a.src = c;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', "https://app.interakt.ai/kiwi-sdk/kiwi-sdk-17-prod-min.js?v=" + new Date().getTime(), 'kiwi');
    window.addEventListener("load", function() {
      kiwi.init('', 'Zlw2804l9EzYOcZ43XoLkBDSBvuUJjUV', {});
    });
  </script>


  <?php // include_once("../include/footer.php"); 
  ?>
  <!-- ./wrapper -->
</body>

</html>