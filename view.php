<?php
$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  $err = "Error! Try again Later!";
}else{
  $succ = "Connection established";
}

$id = $_GET['id'];

$sql = "Select * FROM blogs WHERE slug = '$id'";
$result = mysqli_query($conn, $sql);

$invalid = mysqli_num_rows($result);
if ($invalid == 0) {
    header("location: $url_path");
}

$hsql = "SELECT * FROM blogs WHERE slug = '$id'";
$res = mysqli_query($conn, $hsql);
$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$title = $row['title'];
$img = $row['image'];
$description = $row['description'];
$author = $row['posted_by'];
$mdescription = $row['mdescription'];
$keywords = $row['keywords'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php echo '<meta name="description"  content="'.$mdescription.'">';
    echo '<meta name="keywords" content="'.$keywords.'">
' ?>
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>



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

<body class="hold-transition skin-blue layout-top-nav">

    <div class="wrapper">
        <?php include_once('include/top-menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: white !important;">

            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <!-- Right Column -->
                    <div class="col-md-8">

                        <!-- List-Group Panel -->
                        <div class="panel panel-default panelBorderColor">
                            <div class="panel-heading">
                                <h1 class="panel-title"><strong>
                                        <? echo $title ?>
                                    </strong></h1>
                            </div>
                            <div class="panel-body" style="font-family: Verdana, sans-serif; font-size: 14px;">

                                <!--<h4 class="text-center"><strong>Currency Forward Contract</strong></h4>-->

                                <?php echo '<img class="img-responsive center-block" style="width: 50%" src="/images/'.$img.'"/>'; ?>
                                <br />

                                <?php echo $description; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <!-- List-Group Panel -->
                        <div class="panel panel-default panelBorderColor">
                            <div class="panel-heading">
                                <h1 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span>
                                    <strong>Recent Blogs</strong>
                                </h1>
                            </div>
                            <br>
                            <div class="list-group" id="leftnav">
                            <?php

$list = $conn->query("SELECT * FROM blogs WHERE published = 1");
while ($row = mysqli_fetch_assoc($list)) {
    $id = $row['id'];
    $title = $row['title'];
    $slug = $row['slug'];
    $author = $row['posted_by'];
    $description = $row['description'];
    $permalink = "p/".$slug;
    
    echo "<a href='/$permalink' class='list-group-item' ><i class='fa fa-angle-double-right'></i>$title</a>";  
                


}

?>
                            </div>

                        </div>
                    </div>
                        <!--/Left Column-->



                        <!-- <div class="col-sm-10">
            <ul class="pager">
              <li class="previous"><a href="usd-to-inr-exchange-rate-by-settlement-date"><i class="fa fa-angle-double-left"></i> Previous</a></li>
              
              <li class="next"><a href="powerful-strategies-booking-currency-forward-contract-for-exporters">Next <i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div>      -->
                    </div><!-- ./row -->
            </section>
        </div>


        <?php include_once("include/footer.php"); ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>