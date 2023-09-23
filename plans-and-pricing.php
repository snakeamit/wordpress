<?php
include_once('lib/database.php');
//include("gen_captcha.php");
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Plan and pricing | IBR Live</title>
    <?php include_once('include/head.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        .formerror {
            display: none;
            margin-left: 10px;
        }

        .error_show {
            color: red;
            margin-left: 10px;
        }



        #pswd_info {
            background: #dfdfdf none repeat scroll 0 0;
            color: #fff;
            left: 20px;
            position: absolute;
            top: 280px;
        }

        #pswd_info h4 {
            background: black none repeat scroll 0 0;
            display: block;
            font-size: 14px;
            letter-spacing: 0;
            padding: 17px 0;
            text-align: center;
            text-transform: uppercase;
        }

        #pswd_info ul {
            list-style: outside none none;
        }

        #pswd_info ul li {
            padding: 10px 45px;
        }



        .valid {
            background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/vq43s2wib/valid.png") no-repeat scroll 2px 6px;
            color: green;
            line-height: 21px;
            padding-left: 22px;
        }

        .invalid {
            background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/olmaj1p8z/invalid.png") no-repeat scroll 2px 6px;
            color: red;
            line-height: 21px;
            padding-left: 22px;
        }


        #pswd_info::before {
            background: #dfdfdf none repeat scroll 0 0;
            content: "";
            height: 25px;
            left: -13px;
            margin-top: -12.5px;
            position: absolute;
            top: 50%;
            transform: rotate(45deg);
            width: 25px;
        }

        #pswd_info {
            display: none;
        }

        label {
            width: 300px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        label span {
            font-size: 1rem;
        }

        label.error {
            color: red;
            font-size: 1.3rem;
            display: block;
            margin-top: 5px;
        }

        input.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }

        .has-feedback label~.form-control-feedback {
            top: 45px;
        }

        /*  Pricing style  */
        .bgk {
            background-image: url('wave.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right;
        }

        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 151px;
        }

        .pricing-box {
            -webkit-box-shadow: 0px 5px 30px -10px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 5px 30px -10px rgba(0, 0, 0, 0.1);
            padding: 35px 50px;
            border-radius: 20px;
            position: relative;
            background-color: #fff;
        }

        .pricing-box .plan {
            font-size: 27px;
        }

        .pricing-badge {
            position: absolute;
            top: 0;
            z-index: 999;
            right: 0;
            width: 100%;
            display: block;
            font-size: 15px;
            padding: 0;
            overflow: hidden;
            height: 100px;
        }

        .pricing-badge .badge {
            float: right;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            right: -67px;
            top: 17px;
            position: relative;
            text-align: center;
            width: 200px;
            font-size: 13px;
            margin: 0;
            padding: 7px 10px;
            font-weight: 500;
            color: #ffffff;
            background: #fb7179;
        }

        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important;
        }

        p {
            line-height: 1.7;
        }
    </style>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function openNewWebsite(obj) {
            //alert(obj.value);
            if (obj.value == "Student-Banker") {
                window.location = "https://ibrlive.estudium.org/signup";
            }

        }
    </script>

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
        <?php include_once('include/top-menu.php'); ?>

        <div id="header-carousel" class="slide-header">
            <div class="p-3" style="max-width: 900px; margin: 0 auto;">
                <h4 class="display-3 text-white mb-md-4 animated zoomIn">Plans and Pricing</h4>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

            <section class="section bgk" id="pricing">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box text-center">
                                <h3 class="title-heading mt-4">Product and Services </h3>

                                <img src="images/home-border.png" height="15" class="mt-3" alt="">
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5 pt-4" id="sxpress_standard">
                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">Fxpress Standard</h3>

                                <div class="mt-4 pt-2">
                                    <p class="mb-2 f-18">Features</p>

                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Live Interbank Exchange Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Cash Tom Spot Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Monthly & Broken Date Forward Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Currency Forecast</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Currency Calculator</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Historical Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Day opening and closing SMS</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Forward Contract Management Tool</p>
                                    <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i> RPC & PCFC Management Tool</p>
                                    <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i> One-time Fx rate negotiation with bank</p>
                                    <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i> RPC & PCFC ROI Negotiations</p>
                                    <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i> Full-year professional consultancy</p>
                                </div>

                                <div class="pricing-plan mt-4 pt-2">
                                    <h6 class="text-muted"><s style="text-decoration: none;">INR </s><span class="plan pl-3 text-dark" id="fx-std-price">2599/- p.a + taxes</span></h6>
                                </div>


                                <div class="mt-4 pt-3">
                                    <!-- <select class="form-select btn-primary selectpicker show-tick" aria-label="Default select" name='fx-standard' id="fx-standard">
                                    <option value='FX-stand-90' selected>90 Days</option>
                                        <option value='FX-stand-180'>180 Days</option>
                                        <option value='FXPRESS'>365 Days</option>
                                    </select> -->
                                    <select name='fx-standard' id="fx-standard" class="selectpicker show-tick" data-style="btn-primary">
                                        <option value='FX-stand-30' selected>30 Days</option>
                                        <option value='FX-stand-90'>90 Days</option>
                                        <option value='FX-stand-180'>180 Days</option>
                                        <option value='FXPRESS'>365 Days</option>
                                    </select>
                                    <a class="btn btn-primary" id="fx-stand-cart-btn" href="cartAction.php?action=addToCart&code=FX-stand-90"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <!-- <div class="pricing-badge">
                                <span class="badge">Featured</span>
                            </div> -->

                                <h3 class="f-20 text-primary">Fxpress Gold</h3>


                                <div class="mt-4 pt-2">
                                    <p class="mb-2 f-18">Features</p>

                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Live Interbank Exchange Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Cash Tom Spot Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Monthly & Broken Date Forward Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Currency Forecast</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Currency Calculator</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Historical Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Day opening and closing SMS</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Forward Contract Management Tool</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> RPC & PCFC Management Tool</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success mr-2"></i> One-time Fx rate negotiation with bank</p>
                                    <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i> RPC & PCFC ROI Negotiations</p>
                                    <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i> Full-year professional consultancy</p>
                                </div>

                                <div class="pricing-plan mt-4 pt-2">
                                    <h6 class="text-muted"><s style="text-decoration: none;">INR </s><span class="plan pl-3 text-dark" id="fx-gold-price">13900/- p.a + taxes</span></h6>
                                </div>

                                <div class="mt-4 pt-3">
                                    <select name='fx-gold' id="fx-gold" class="selectpicker show-tick" data-style="btn-primary  ">
                                        <option value='FX-gold-90' selected>90 Days</option>
                                        <option value='FX-gold-180'>180 Days</option>
                                        <option value='FX-gold-365'>365 Days</option>
                                    </select>
                                    <a class="btn btn-primary" id="fx-gold-cart-btn" href="cartAction.php?action=addToCart&code=FX-gold-90"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">Fxpress Platinum</h3>


                                <div class="mt-4 pt-2">
                                    <p class="mb-2 f-18">Features</p>

                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Live Interbank Exchange Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Cash Tom Spot Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Monthly & Broken Date Forward Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Currency Forecast</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Currency Calculator</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Historical Rates</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Day opening and closing SMS</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Forward Contract Management Tool</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> RPC & PCFC Management Tool</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> One-time Fx rate negotiation with bank</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> RPC & PCFC ROI Negotiations</p>
                                    <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i> Full-year professional consultancy</p>
                                </div>
                                <div class="pricing-plan mt-4 pt-2" style="margin-top: 46px !important;">
                                    <h4 class="text-muted"><s></s> <span class="plan pl-3 text-dark"> </span></h4>
                                    <p></p>
                                    <p></p>
                                </div>
                                <p></p>
                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section bgk" id="pricing">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box text-center">
                                <h3 class="title-heading mt-4"></h3>

                                <img src="images/home-border.png" height="15" class="mt-3" alt="">
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5 pt-4 bgk">
                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">EDPMS</h3>
                                <p style="color:black;"><b>One-stop solution for all your problems</b></p>
                                <div class="mt-4 pt-2" style="overflow-y: scroll; height:300px">
                                    <ul>
                                        <li>Getting frequent letters & calls from your bank to clear bills of entries & shipping bills?</li>
                                        <li>Made an advance payment for import but the seller refused to ship the goods?</li>
                                        <li>Shipped the goods but didn't receive the payment?</li>
                                        <li>Unknowingly exported goods to OFAC-sanctioned countries?</li>
                                        <li>Export payment received from a third party?</li>
                                        <li>Less payment received for the export invoice?</li>
                                        <li>Payment received as an advance against exports but goods not exported?</li>
                                        <li>Goods imported through courier but didn't receive the courier BOE?</li>
                                    </ul>
                                </div>

                                <p><i> Don't worry we have got solutions for every issue mentioned above. Our team of ex-bankers having expertise in a similar field can help you get rid of all these issues.</i></p>
                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <!-- <div class="pricing-badge">
                                <span class="badge">Featured</span>
                            </div> -->

                                <h3 class="f-20 text-primary">Legal Entity Identifier</h3>

                                <p style="color:black"><b>Get your LEI code issuance within 2 hours</b></p>
                                <div class="mt-4 pt-2" style="overflow-y: hidden; height:361px">
                                    <ul>
                                        <li>We are the cheapest and fastest across the industry.</li>
                                        <li>Get your LEI code issuance within 2 hours.</li>
                                        <li>It doesn't matter if the LEI was issued with some other service provider earlier but you can now renew the same with us at very economical rates.</li>
                                        <li>Just click here to issue/renew your LEI code.</li>
                                    </ul>
                                </div>
                                <div class="mt-4 pt-3 text-center">
                                    <a href="https://ibrlive.com/lei-code" class="btn btn-primary btn-rounded">Click here</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" id="lending_service">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">Lending Services</h3>
                                <p style="color:black"><b>How does it benefit you?</b></p>

                                <div class="mt-4 pt-2" style="overflow-y: scroll; height:392px">
                                    <ul>
                                        <li>We have tied up with some of the leading banks specifically for FX funding like RPC, PCFC, Buyer’s Credit, FCTL & FCDL.</li>
                                        <li>We can get you the lowest interest rates on these limits across the banking industry.</li>
                                        <li>We also help you in the process to shift your packing credit limits from one bank to another by negotiating with a new banker for better interest rates, exchange rates, forex fees & all other aspects where you can significantly reduce your interest cost and bank charges.</li>
                                        <li>We guide you on when to take rupee packing credit and when to avail of packing credit in foreign currency to save interest costs.</li>
                                        <li>We also arrange better buyer’s credit quotes from some of the foreign banks</li>
                                    </ul>
                                </div>

                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section bgk" id="pricing">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box text-center">
                                <h3 class="title-heading mt-4"></h3>
                                <img src="images/home-border.png" height="15" class="mt-3" alt="">
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5 pt-4 bgk">
                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">Factoring Services</h3>
                                <p style="color:black"><b>Are these your pain points as well?</b></p>
                                <div class="mt-4 pt-2" style="overflow-y: hidden; height:323px">
                                    <ul>
                                        <li>Are you in need of funds but do not have collateral to give for securing the bill purchase limit?</li>
                                        <li>The bill is not under LC but still, you want to discount it for getting early money?</li>
                                        <li>Existing credit limits exhausted and you still need money?</li>
                                    </ul>
                                </div>
                                <p><i>Don't worry we got you covered. Just route your export bill through us and get instant funds by factoring in your export invoices.</i></p>

                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" id="send_money">
                            <div class="pricing-box mt-4">
                                <!-- <div class="pricing-badge">
                                <span class="badge">Featured</span>
                            </div> -->

                                <h3 class="f-20 text-primary">Send Money Abroad</h3>
                                <h4 style="text-align: center;">International wire transfers</h4>
                                <div style="overflow-y: scroll; height:377px">
                                    <div class="mt-4 pt-2">
                                        <ul>
                                            <li>Gift Remittances, Family Maintenance, Education fees & GIC</li>
                                            <li>Flywire, CIBC, Paymytuition, WUBS</li>
                                            <li>Unmatchable Exchange Rates</li>
                                            <li>Lower Commission Charges</li>
                                            <li>Same-day transaction</li>
                                            <li>Transaction confirmation swift copy on mail</li>
                                            <li>No need to visit the office</li>
                                        </ul>
                                    </div>

                                    <h4 style="text-align: center;">Multi-Currency Forex Travel Card</h4>
                                    <div class="mt-4 pt-2">
                                        <ul>
                                            <li>Load multiple currencies in a single card</li>
                                            <li>Safer than carrying cash</li>
                                            <li>Cheaper than debit or credit cards with zero cross-currency and swipe charges</li>
                                            <li>Reloading and unloading are possible at any time</li>
                                            <li>Get discounts on travel services, international SIM and lots of other privileges.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" id="scrip_sale">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">RoDTEP & RoSCTL Scrip Sale & Purchase</h3>
                                <p>Exhaustive checking of scrips before buying & Selling, we eliminate chance of misuse and erroneous scrips </p>

                                <div class="mt-4 pt-2" style="overflow-y: hidden; height:280px">
                                    <ul>
                                        <li>Bringing genuine KYC Compliant buyers and sellers together on one platform</li>
                                        <li>Offering unbeatable pricing</li>
                                        <li>Fast & smooth process</li>
                                        <li>24-hour support</li>
                                    </ul>
                                </div>
                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section bgk" id="pricing">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box text-center">
                                <h3 class="title-heading mt-4"></h3>
                                <img src="images/home-border.png" height="15" class="mt-3" alt="">
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5 pt-4 bgk">
                        <div class="col-lg-4">
                            <div class="pricing-box mt-4">
                                <h3 class="f-20 text-primary">Overseas Direct Investment & Foreign Direct Investment Consultancy</h3>
                                <p style="color:black"><b>Get benefited from our expertise in FDI & ODI domain</b></p>
                                <div class="mt-4 pt-2" style="overflow-y: hidden; height:323px">
                                    <ul>
                                        <li>Fulfilment of all banking requirements as per latest RBI directions</li>
                                        <li>Immense saving on part of banking fees and exchange margins</li>
                                        <li>Guidance on setting up of company in India & receiving FDI</li>
                                        <li>Guidance on setting up of company abroad & sending ODI</li>
                                        <li>Fulfilling all necessary legal & documentary requirements</li>
                                        <li>Allotment of Unique Identification number (UIN)</li>
                                        <li>Submission of Annual Performance Report to bank (APR)</li>
                                        <li>Guidance on issuance of share certificates in return of investment</li>
                                        <li>Registration on RBI's FIRMS portal</li>
                                    </ul>
                                </div>
                                <div class="mt-4 pt-3 text-center">
                                    <a href="" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#modalForm">Avail Service</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <br />
        </div>
    </div>


    <!-- Modal -->
    <!-- <div class="modal fade" id="form_coupon" tabindex="-1" role="dialog" aria-hidden="true"> -->
    <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Enquiry Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close">
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="col-sm-12">
                        <div class="form-container">
                            <p id="msg" class="text-danger"></p>
                            <p id="success"></p>
                            <div id="hide_form">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label">Name </label>
                                        <input type="text" name="fname" id="fname" class="form-control" placeholder="What's your name?">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Email </label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="What's your email?">
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="label">Mobile</label>
                                        <input type="number" name="mobile" id="mobile" max="10" onkeypress="if (this.value.length > 9) return false;" class="form-control" placeholder="What's your mobile number?">
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="label">Service interested In</label>
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="">Service interested In </option>
                                            <option value="Fxpress Platinum">Fxpress Platinum</option>
                                            <option value="EDPMS">EDPMS</option>
                                            <option value="Legal Entity Identifier">Legal Entity Identifier</option>
                                            <option value="Lending Services">Lending Services</option>
                                            <option value="Factoring Services">Factoring Services</option>
                                            <option value="Send Money Abroad">Send Money Abroad</option>
                                            <option value="Scrips">Scrips</option>
                                            <option value="ODI & FDI Consultancy">Overseas Direct Investment & Foreign Direct Investment Consultancy</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">

                                        </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-4">
                                        <label class="label"></label>
                                        <br>
                                        <span style="float: right;">
                                            <img src="gen_captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
                                        </span>
                                        <p>Can't read the image? <a href='javascript: refreshCaptcha();'>click here</a> to refresh</p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="label"></label>
                                        <input type="text" name="captcha_val" style="margin-top: 23px;" id="captcha_val" class="form-control" placeholder="Enter Captcha">
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-12">
                                        <div class="form-group text-center">
                                            <br>
                                            <button class="btn btn-primary" id="sendnow">Send Query </button>
                                            <div id="subloader"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <?php include_once("include/footer.php"); ?>

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->
    <script>
        $("#fx-standard").change(function() {
            var newUrl = '';
            if ($("#fx-standard").val() === 'FX-stand-30') {
                $("#fx-std-price").text('2599/- p.a + taxes');
                newUrl = 'cartAction.php?action=addToCart&code=FX-stand-30';
            } else if ($("#fx-standard").val() === 'FX-stand-90') {
                $("#fx-std-price").text('7500/- p.a + taxes');
                newUrl = 'cartAction.php?action=addToCart&code=FX-stand-90';
            } else if ($("#fx-standard").val() === 'FX-stand-180') {
                $("#fx-std-price").text('13500/- p.a + taxes');
                newUrl = 'cartAction.php?action=addToCart&code=FX-stand-180';
            } else {
                $("#fx-std-price").text('25000/- p.a + taxes');
                newUrl = 'cartAction.php?action=addToCart&code=FXPRESS';
            }

            $("#fx-stand-cart-btn").attr("href", newUrl);
        });

        $("#fx-gold").change(function() {
            //$("#fx-gold-price").text($("#fx-gold").val()+'/- p.a + taxes');
            var newUrl2 = '';
            if ($("#fx-gold").val() === 'FX-gold-90') {
                $("#fx-gold-price").text('13900/- p.a + taxes');
                newUrl2 = 'cartAction.php?action=addToCart&code=FX-gold-90';
            } else if ($("#fx-gold").val() === 'FX-gold-180') {
                $("#fx-gold-price").text('26900/- p.a + taxes');
                newUrl2 = 'cartAction.php?action=addToCart&code=FX-gold-180';
            } else {
                $("#fx-gold-price").text('49000/- p.a + taxes');
                newUrl2 = 'cartAction.php?action=addToCart&code=FX-gold-365';
            }

            $("#fx-gold-cart-btn").attr("href", newUrl2);
        });


        $(document).ready(function() {
            if (window.location.hash) {
                var hash = window.location.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 500);
            };

            $('#close').click(function() {
                window.location.reload();
            });

            // $('#modalForm').on('hidden.bs.modal', function () {
            //     $(this).find('form').trigger('reset');
            // })

            $("#sendnow").click(function() {
                var email = $('#email').val().trim();
                var fname = $('#fname').val().trim();
                var category = $('#category').val().trim();
                var mobile = $('#mobile').val().trim();
                var captcha_val = $('#captcha_val').val().trim();
                //var msg =$('textarea[name="msg"]').val();
                $.ajax({
                    method: "POST",
                    url: "enquiry_action",
                    data: {
                        fname: fname,
                        category: category,
                        mobile: mobile,
                        email: email,
                        captcha_val: captcha_val
                    },
                    beforeSend: function() {
                        $('#sendnow').hide();
                        $('#subloader').show();
                        $('#subloader').html('<img src="loader.gif" height="100">');
                    },
                    success: function(data) {
                        //$('#msg').html(data);
                        var obj = JSON.parse(data);
                        $('#msg').html(obj.errors);
                        var status = obj.status;
                        $('#subloader').hide();
                        $('#subloader').html("");
                        $('#sendnow').show();
                        if (status == 'success') {
                            $('#hide_form').hide();
                            $('#success').html('Thank you for showing interest in our services. We have received your inquiry and we will get back to you soon..');
                            setTimeout(() => window.location.reload(), 5000);
                        }
                        //$("#captcha").attr('src','captchaimg.php');

                    }
                });
            });
        });
        //Refresh Captcha
        function refreshCaptcha() {
            var img = document.images['captcha_image'];
            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        }
    </script>
