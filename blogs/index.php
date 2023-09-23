<?php include_once('../lib/database.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blogs | IBR Live</title>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
   AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. 
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../css/style.css"> -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="../bower_components/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/noborder.css">
    <link rel="stylesheet" href="../css/converter.css">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>



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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3HB1M04NFG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3HB1M04NFG');
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
                <h4 class="display-3 text-white mb-md-4 animated zoomIn">Blogs </h4>
            </div>
        </div>
    </div>

    <?php //include_once('../include/top-menu.php'); 
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">


            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 left-box">
                    <?php
                    // Create connection
                    $conn = OpenCon();
                    $sqld = "SELECT * FROM blogs where published = true order by id desc";
                    $result = $conn->query($sqld);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <div class="card single_post">
                                <div class="body">
                                    <?php if ($row['image_path']) { ?>
                                        <a href="single.php?post_slug=<?php echo $row['slug'] ?>" title="<?php $row['title']; ?>">
                                            <img src="<?php echo 'https://ibrlive.com/' . $row['image_path']; ?>" class="post_image" style="width: 100%; height:300px">
                                        </a>
                                    <?php } else { ?>
                                        <a href="single.php?post_slug=<?php echo $row['slug'] ?>" title="<?php $row['title']; ?>">
                                            <img src="<?php echo 'https://ibrlive.com/images/no_image.jpg' ?>" class="post_image" style="width: 100%; height:300px">
                                        </a>
                                    <?php } ?>
                                    <h3 style="margin-top: 15px;"><a href="single.php?post_slug=<?php echo $row['slug']; ?>"><?php echo $row['title']; ?></a></h3>
                                    <p><?php //echo substr_replace(html_entity_decode($row['description']), "...", 200); ?></p>
                                </div>
                                <div class="footer">
                                    <div class="actions">
                                        <a href="single.php?post_slug=<?php echo $row['slug']; ?>" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo 'No more blogs';
                    }
                    $conn->close();
                    ?>
                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/legal-entity-identifier-code">Legal Entity Identifier, Objective, Necessity, Timelines, Pricing </a></h3>
                            <p><b>Evolution of Legal Entity Identifier: </b> During 2007-2008, it was the time of financial crisis. So, the regulators realized that it was difficult to estimate the amount of risk exposure in the market. It became very hard to resolve the problems of failing institutions in the market.</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/legal-entity-identifier-code" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/eefc-accounts-everything-exporters-need-to-know">EEFC Account: Everything Exporters Need to Know! </a></h3>
                            <p><b>What is an EEFC account?</b> Exchange Earners Foreign Currency Account is called an EEFC account. An EEFC account is like a current account maintained in foreign currency with a bank authorized to deal in foreign exchange. However, there is no interest given on this type of account. </p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/eefc-accounts-everything-exporters-need-to-know" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/ofac-meaning-types-countries-list-tips-for-exporter-importer">What is OFAC? How to deal with OFAC Countries as an Importer or Exporter?</a></h3>
                            <p><b>What is OFAC?</b> OFAC stands for Office of Foreign Assets Control. It is administrated by the Treasury Department of the United States. OFAC carries out economic sanctions (penalty or rules) which are imposed by the U.S on Foreign Countries. The program may freeze assets of sanctioned countries and may restrict services to sanctioned countries. It can also restrict payment of funds to the person or entities named in the SDN list (Specially Designated Nationals and Blocked Persons List).</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/ofac-meaning-types-countries-list-tips-for-exporter-importer" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/usd-to-inr-exchange-rate-by-settlement-date">How understanding of USD to INR CASH, TOM, SPOT & FORWARD rates can benefit an Exporter or Importer?</a></h3>
                            <p>When it comes to USD to INR exchange, there are four types of exchange rates differentiated by settlement date. With an understanding of these rates, you can save a lot of money & hedge your currency exposure.</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/usd-to-inr-exchange-rate-by-settlement-date" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/currency-forward-contract-definition-booking-cancellation">Currency Forward Contract</a></h3>
                            <p>What Is a Currency Forward Contract?
                                A currency forward contract can be defined as buying or selling a specific currency at a specified future price for delivery on a specified future date.</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/currency-forward-contract-definition-booking-cancellation" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>

                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/powerful-strategies-booking-currency-forward-contract-for-exporters">10 Powerful Strategies of Booking Currency Forward Contract For Exporters</a></h3>
                            <p>Booking a currency forward contract hedge your adverse currency movement risk, but by adopting the following strategies, you may earn good profits out of it.</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/powerful-strategies-booking-currency-forward-contract-for-exporters" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>

                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="https://ibrlive.com/blogs/fx-retail-platform-exporters-importers-usd-inr-transactions">Fx Retail platform for Exporters & Importers USD-INR transactions</a></h3>
                            <p>What is the Fx Retail platform? It is a platform developed by Clear Corp Dealing Systems India Pvt Ltd. a subsidiary of Clearing Corporation of India Limited in association with RBI. It was launched on 1st July 2019 and started doing transactions on August 5th, 2019. The platform provides sale & purchase of USD/INR pair by retail customers of banks for delivery-based Cash, TOM, SPOT, and Forward transactions up to 13 months.</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="https://ibrlive.com/blogs/fx-retail-platform-exporters-importers-usd-inr-transactions" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>

                        </div>
                    </div>

                    <div class="card single_post">
                        <div class="body">
                            <h3><a href="foreign-currency-abroad-for-travel-business-education-purpose">Limit of foreign currency one can take abroad for travel, business and education purpose</a></h3>
                            <p>Amount of foreign currency one can take abroad on private visit: Any resident India can take up to USD 250000 or equivalent in a financial year under liberalized remittance scheme by RBI. USD 250000 as on 15.08.2021 are equivalent to Rs. 1,85,61,500.

                                There is no limit on number of travels but in any case, the limit should not exceed USD 250000 per financial year.</p>
                        </div>
                        <div class="footer">
                            <div class="actions">
                                <a href="foreign-currency-abroad-for-travel-business-education-purpose" class="btn btn-primary">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 right-box">

                    <div class="card">
                        <div class="header">
                            <h2>Popular Posts</h2>
                        </div>
                        <div class="body widget popular-post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single_post" style="cursor: pointer;" onclick="location.href='https://ibrlive.com/blogs/legal-entity-identifier-code';">
                                        <p class="m-b-0">Legal Entity Identifier, Objective ...</p>
                                        <span></span>
                                        <div class="img-post">
                                            <img src="https://ibrlive.com/images/blogs/LEI.jpeg" alt="Legal Entity">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single_post" style="cursor: pointer;" onclick="location.href='https://ibrlive.com/blogs/usd-to-inr-exchange-rate-by-settlement-date';">
                                        <p class="m-b-0">... benefit an Exporter, Importer</p>
                                        <span></span>
                                        <div class="img-post">
                                            <img src="https://ibrlive.com/images/blogs/inr-usd.png" alt="understand rates">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single_post" style="cursor: pointer;" onclick="location.href='https://ibrlive.com/blogs/currency-forward-contract-definition-booking-cancellation';">
                                        <p class="m-b-0">Currency Forward Contract</p>
                                        <span></span>
                                        <div class="img-post">
                                            <img src="https://ibrlive.com/images/blogs/fwd-cnt.png" alt="Currency Forward">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single_post" style="cursor: pointer;" onclick="location.href='https://ibrlive.com/blogs/powerful-strategies-booking-currency-forward-contract-for-exporters';">
                                        <p class="m-b-0">10 Powerful Strategies For Exporters</p>
                                        <span></span>
                                        <div class="img-post">
                                            <img src="https://ibrlive.com/images/blogs/10-points.png" alt="Powerful Strategies">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <?php include_once("../include/footer.php");
    ?>
    <!-- ./wrapper -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>
