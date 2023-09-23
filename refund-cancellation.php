<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
$allow = $_SESSION['userallow'];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Refund and Cancellation | IBR Live</title>
  <?php include_once('include/head.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body>


  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <?php include_once('include/top-menu.php'); ?>

    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Refund and Cancellation </h4>
      </div>
    </div>
  </div>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <p>Our focus is complete customer satisfaction. In the event, if you are displeased with the services provided, we will refund back the money, provided the reasons are genuine and proved after investigation. Please read the fine prints of each deal before buying it, it provides all the details about the services or the product you purchase.</p>

      <p>In case of dissatisfaction from our services, clients have the liberty to cancel their projects and request a refund from us. Our Policy for the cancellation and refund will be as follows:</p>

      <p><b>Cancellation Policy</b></p>

      <p>For Cancellations please contact the us via contact us link. </p>

      <p>Requests received later than 5 business days prior to the end of the current service period will be treated as cancellation of services for the next service period.</p>

      <p><b>Refund Policy</b></p>

      <p>We will try our best to create the suitable design concepts for our clients.</p>

      <p>In case any client is not completely satisfied with our products we can provide a refund.</p>

      <p>If paid by credit card, refunds will be issued to the original credit card provided at the time of purchase and in case of payment gateway name payments refund will be made to the same account.</p>

    </div>

  </div>


  <?php include_once("include/footer.php"); ?>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>