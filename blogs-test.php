<?php
 if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
  }

  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }
  error_reporting(0);
?>



<?php
//   if ($_SERVER['HTTPS'] != "on") {
//     $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//     header("Location: $url");
//     exit;
//   }

  
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


?>    

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
  <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

  <title>Home | IBR Live</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="bower_components/jquery-ui/jquery-ui.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/noborder.css">
  <link rel="stylesheet" href="css/converter.css">

  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
  <link rel="manifest" href="/images/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <style type="text/css">
    .cke_textarea_inline{
       border: 1px solid black;
    }

    </style>


  <style>
      
       
      hr.divider {
       max-width: 3.25rem;
       border-width: 0.2rem;
       border-color: #f4623a;
   }
     
     .card {
   background: #fff;
   transition: .5s;
   border: 0;
   margin-bottom: 30px;
   border-radius: .55rem;
   position: relative;
   width: 100%;
   box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.card .body {
   color: #444;
   padding: 20px;
   font-weight: 400;
}
.card .header {
   color: #444;
   padding: 20px;
   position: relative;
   box-shadow: none;
}
.single_post {
   -webkit-transition: all .4s ease;
   transition: all .4s ease
}

.single_post .body {
   padding: 30px
}

.single_post .img-post {
   position: relative;
   overflow: hidden;
   max-height: 500px;
   margin-bottom: 30px
}

.single_post .img-post>img {
   -webkit-transform: scale(1);
   -ms-transform: scale(1);
   transform: scale(1);
   opacity: 1;
   -webkit-transition: -webkit-transform .4s ease, opacity .4s ease;
   transition: transform .4s ease, opacity .4s ease;
   max-width: 100%;
   filter: none;
   -webkit-filter: grayscale(0);
   -webkit-transform: scale(1.01)
}

.single_post .img-post:hover img {
   -webkit-transform: scale(1.02);
   -ms-transform: scale(1.02);
   transform: scale(1.02);
   opacity: .7;
   filter: gray;
   -webkit-filter: grayscale(1);
   -webkit-transition: all .8s ease-in-out
}

.single_post .img-post:hover .social_share {
   display: block
}

.single_post .footer {
   padding: 0 30px 30px 30px
}

.single_post .footer .actions {
   display: inline-block
}

.single_post .footer .stats {
   cursor: default;
   list-style: none;
   padding: 0;
   display: inline-block;
   float: right;
   margin: 0;
   line-height: 35px
}

.single_post .footer .stats li {
   border-left: solid 1px rgba(160, 160, 160, 0.3);
   display: inline-block;
   font-weight: 400;
   letter-spacing: 0.25em;
   line-height: 1;
   margin: 0 0 0 2em;
   padding: 0 0 0 2em;
   text-transform: uppercase;
   font-size: 13px
}

.single_post .footer .stats li a {
   color: #777
}

.single_post .footer .stats li:first-child {
   border-left: 0;
   margin-left: 0;
   padding-left: 0
}

.single_post h3 {
   font-size: 20px;
   text-transform: uppercase
}

.single_post h3 a {
   color: #242424;
   text-decoration: none
}

.single_post p {
   font-size: 16px;
   line-height: 26px;
   font-weight: 300;
   margin: 0
}

.single_post .blockquote p {
   margin-top: 0 !important
}

.single_post .meta {
   list-style: none;
   padding: 0;
   margin: 0
}

.single_post .meta li {
   display: inline-block;
   margin-right: 15px
}

.single_post .meta li a {
   font-style: italic;
   color: #959595;
   text-decoration: none;
   font-size: 12px
}

.single_post .meta li a i {
   margin-right: 6px;
   font-size: 12px
}

.single_post2 {
   overflow: hidden
}

.single_post2 .content {
   margin-top: 15px;
   margin-bottom: 15px;
   padding-left: 80px;
   position: relative
}

.single_post2 .content .actions_sidebar {
   position: absolute;
   top: 0px;
   left: 0px;
   width: 60px
}

.single_post2 .content .actions_sidebar a {
   display: inline-block;
   width: 100%;
   height: 60px;
   line-height: 60px;
   margin-right: 0;
   text-align: center;
   border-right: 1px solid #e4eaec
}

.single_post2 .content .title {
   font-weight: 100
}

.single_post2 .content .text {
   font-size: 15px
}

.right-box .categories-clouds li {
   display: inline-block;
   margin-bottom: 5px
}

.right-box .categories-clouds li a {
   display: block;
   border: 1px solid;
   padding: 6px 10px;
   border-radius: 3px
}

.right-box .instagram-plugin {
   overflow: hidden
}

.right-box .instagram-plugin li {
   float: left;
   overflow: hidden;
   border: 1px solid #fff
}

.comment-reply li {
   margin-bottom: 15px
}

.comment-reply li:last-child {
   margin-bottom: none
}

.comment-reply li h5 {
   font-size: 18px
}

.comment-reply li p {
   margin-bottom: 0px;
   font-size: 15px;
   color: #777
}

.comment-reply .list-inline li {
   display: inline-block;
   margin: 0;
   padding-right: 20px
}

.comment-reply .list-inline li a {
   font-size: 13px
}

@media (max-width: 640px) {
   .blog-page .left-box .single-comment-box>ul>li {
       padding: 25px 0
   }
   .blog-page .left-box .single-comment-box ul li .icon-box {
       display: inline-block
   }
   .blog-page .left-box .single-comment-box ul li .text-box {
       display: block;
       padding-left: 0;
       margin-top: 10px
   }
   .blog-page .single_post .footer .stats {
       float: none;
       margin-top: 10px
   }
   .blog-page .single_post .body,
   .blog-page .single_post .footer {
       padding: 30px
   }
}
 </style>
    
  <meta name="theme-color" content="#ffffff">

</head>
<body class="hold-transition skin-blue layout-top-nav">


  <?php include_once('include/top-menu.php'); ?>

  <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="">
              <div class="box-header" align=center>
                <i class="fa fa-newspaper-o"></i>
                <p class="box-title" style="font-size: 22px;"><b>Blogs </p>
                <hr class="divider">
              </div>
            </div>
          </div><!-- /.col -->

        <div id="main-content" class="blog-page">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 left-box">
                    <?php

$list = $conn->query("SELECT * FROM blogs WHERE published = 1");
while ($row = mysqli_fetch_assoc($list)) {
    $id = $row['id'];
$title = $row['title'];
$slug = $row['slug'];
$author = $row['posted_by'];
$description = $row['description'];
$mdescription = $row['mdescription'];

$image = $row['image'];
$permalink = "p/".$slug;
?>
 <div class="card single_post">
                            <div class="body">
                                <h3><a href="/<?php echo $permalink; ?>"><?php echo $title ?> </a></h3>
                                <p><?php  echo substr($mdescription, 0, 200 ) ?></p>
                            </div>
                            <div class="footer">
                                <div class="actions">
                                    <a href="/<?php echo $permalink; ?>" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>

<?php
}



?>
                       
                        
                                                
                        <!-- <ul class="pagination pagination-primary">
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                        </ul> -->               
                    </div>
              </div>
        
            </div>
        </div>
		        
        </div><!-- ./row -->
    </section>

  <?php require 'include/footer.php'; ?>


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script type="text/javascript">



CKEDITOR.replace('long_desc',{

  width: "auto",
  height: "200px"

}); 

</script>

</body>
</html>