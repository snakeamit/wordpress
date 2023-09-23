
<?php  

  if(isset($_SESSION['username'])){    
    $user = $_SESSION['username'];   
  
  }else{
    if(isset($_SESSION['sessCustomerID'])){
      
    }else{
      $user="";
      $allow="NO";      
    }
  }
 
?>
<?php 
$your_email = 'no-reply@ibrlive.com';
session_start();
$errors = '';
$usename = '';
$subject = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	$usename = $_POST['name'];
	$visitor_email = $_POST['email'];
	$visitor_phone = $_POST['phone'];
	$user_message = $_POST['message'];
	///------------Do Validations-------------


	if($_POST['captcha'] == $_SESSION['code']){
		//$errors .= "correct captcha";
	}else{
		$errors .= "Invalid captcha";
	}
	
	if(empty($visitor_email))
	{
		$errors .= "Email is required fields.\n";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "Bad email value!\n";
	}
	if(empty($usename))
	{
		$errors .= "Name is required fields.\n";	
	}	
	if(empty($errors))
	{
		//send the email
		$to = "contact@ibrlive.com";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "<html><body><table><tr style='background: #eee;'><td><strong>$usename</strong> wants you to contact him/her.</td>\n".
				"<tr><td><strong>Name:</strong> $usename</td></tr>\n".
                		"<tr><td><strong>Subject:</strong> 'Answer My Query'</td></tr>\n".
                                "<tr><td><strong>Phone:</strong> "." $visitor_phone</td></tr>\n".
				"<tr><td><strong>User Email:</strong> ".
				"$visitor_email</td>
				<td><strong>Message:</strong> ".
				"$user_message</td></tr></table></body></html>\n\n";//.
				"IP: $ip\n";	
				$headers = array("From: $from",
					"Reply-To: $visitor_email",
					"MIME-Version: 1.0",
					"Content-type:text/html;charset=UTF-8",
					"X-Mailer: PHP/" . PHP_VERSION
				);
		$headers = implode("\r\n", $headers);
		
		if(mail($to, 'contact form', $body,$headers)){  
		  header('location: thank-you.php');
		  exit;
		}
		else{
		  header('location: regret.php');
		  exit;
		}
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>

<!-- a helper script for vaidating the form-->
<script language="JavaScript" src="contact-form/script/gen_validatorv31.js" type="text/javascript"></script>	

<div id='contact_form_errorloc' style="text-align:center; color:red;" class='err'></div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FXPRESS | IBR Live</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Bank Forex card rates,Forward Exchange Contract,Fx rates live,bank charges for currency conversion,currency exchange fee,currency conversion fee,exchange margin,better exchange rates" name="keywords"><!-- Favicon -->
    <meta name="description" content="Get live IBR Rates, Forward Premium USD INR, USD to INR Historical Data. Trusted by millions of exporters & importers for negotiation on exchange margin.">
	

    <!-- Favicon -->
    <link href="/landing-page/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/landing-page/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/landing-page/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/landing-page/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/landing-page/css/style.css" rel="stylesheet">
    
     <!-- Global site tag (gtag.js) - Google Analytics -->
  
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-123754068-1');
    </script>
    <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "dcrqpo0b2s");
</script>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <header class="main-header"  style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1)">
                <font style="font-size: 20px; text-align: center;background-color: #244050;">
                                
                    <marquee scrollamount="2" width="100%" behavior="alternate" bgcolor="#244050" style="color: white;">  
    ❖ India's most preferred financial information provider ❖ Live Currency Rates ❖ Forward Rates ❖ Historical Rates ❖ Currency Forecast ❖ Currency Calculator ❖ 
    </marquee>  
                </font>	
            </header>
           
            <nav class="navbar navbar-expand-sm  navbm px-4 px-lg-5 py-3 py-lg-0 " style="background-color:#337ab7;" >
                
                <a href="/" class="navbar-brand p-0">
                    <!--h1 class="m-0">BizConsult</h1-->
                     <img src="https://ibrlive.com/pix.jpg" alt="Logo"> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        <a class="nav-item nav-link" href="/home">HOME</a>
                        <!-- <li><a href="#">TOOLS</a></li> -->
                        <a href="/usd-inr-forecast" class="nav-item nav-link">CURRENCY FORECAST</a>
                        <div  class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">LEARN <span class="caret"></span></a>
                            
                            <div class="dropdown-menu" role="menu">
                             <a class="dropdown-item" href="/rbi-master-directions"><i class="fa fa-plus"></i><b>RBI Master Directions</b></a>
              
                              
                             <a  class="dropdown-item" href="/mutual-fund" style=""><i class="fa fa-plus"></i><b> MUTUAL FUNDS</b></a>
                     		
                              
                             <a class="dropdown-item"  href="/foreign-exchange" style=""><i class="fa fa-plus"></i><b> FOREIGN EXCHANGE</b></a>
                      
                            </div>  
                        </div>
                        <!--a class="nav-item nav-link" href="/blogs/">BLOGS</a-->
                        <a class="nav-item nav-link" href="/our-products">PRODUCTS</a>
                        <!--div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> LINKS <span class="caret"></span></a>
                              <div class="dropdown-menu" role="menu">
                                
                                <a class="dropdown-item" target="_blank" href="https://services.gst.gov.in/services/searchtp"><b>GST Verification</b></a>
                                
                                <a class="dropdown-item" target="_blank" href="https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp"><b>PAN Verification</b></a>	
                              </div>
                            </div-->
                    <!-- <li><a href="#">MOBILE APP</a></li> -->
                    <a class="nav-item nav-link" href="/central-bank-interest-rates">BENCHMARK RATES</a>
                    <a class="nav-item nav-link" href="/lei-code">GET LEI</a>
                    <a  class="nav-item nav-link" href="/about">ABOUT US</a>
                    <a class="nav-item nav-link" href="/contact">CONTACT US</a>
                    
                    
                         <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-angle-double-down"></i> User</a></a>
                            <div class="dropdown-menu m-0">
                                <a class="dropdown-item" href="/register"><b>New User - Registration</b></a>			
                               
                                <a class="dropdown-item" href="/login"><b>Existing User - Login</b></a>		
                            </div>
                         </div>
            
                  </ul>
                   
                </div>
            </nav>

            <div class="container-xxl  hero-header" style="background-color:#2f668d ;">
                <div class="container">
                    <div class="row g-5 align-items-center">
                       
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid animated zoomIn" style="border-radius:15px;" src="/images/fxprees_red.png" alt="">
                            <h4 style="color:white;text-align:center;font-family: " serif;"><i>Authentic &amp; Real time exchange rates with CASH TOM SPOT values,
Forward premiums, Currency forecast , Historical rates and many more.</i></h4><br><br><br>
                           
                        </div>
                         <div class="col-lg-6">
                           
 <div class="row">
                      <video id="video1"  controls muted="true"  played="false">
   <source src="/IBRLive_real.mp4" type="video/mp4" />
                    <source src="/IBRLive_real.mp4" type="video/webm" />
  Your browser does not support the video tag.
</video>  
                 </div>
    

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->
        
          <!-- Service Start -->
        <div class="container-xxl " >
            <div class="container">
            \
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                
                   
                    <h2 class="mb-5 text-uppercase">Unlock the premium benefits with Fxpress Standard Plan-</h2>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded h-100">
                            <div class="d-flex justify-content-between">
                                <div class="service-icon">
                                    <i class="fa fa-user-tie fa-2x"></i>
                                </div>
                                <a class="service-btn" href="https://ibrlive.com/register">
                                    <i class="fa fa-link fa-2x"></i>
                                </a>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-3">
                                    Live Interbank Exchange Rate</h5>
                                <span><ul>
                                    <li>Real Time Exchange rates changing in seconds</li>
                                    <li>View MID Market Rates, BID & Ask Rates, Days High & Low values.</li>
                                    <li>Empowers you to negotiate with your bank to get better exchange rate.</li>
                                </ul></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded h-100">
                            <div class="d-flex justify-content-between">
                                <div class="service-icon">
                                    <i class="fa fa-chart-pie fa-2x"></i>
                                </div>
                                <a class="service-btn" href="https://ibrlive.com/register">
                                    <i class="fa fa-link fa-2x"></i>
                                </a>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-3">Cash Tom Spot Rates</h5>
                                <span><ul>
                                    <li>Rates are available for all Cash Tom & Spot values.</li>
                                    <li>Facilitates wise decision to book Cash, Tom or Spot Rate.</li>
                                    <li>Every penny counts.</li>
                                </ul></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item rounded h-100">
                            <div class="d-flex justify-content-between">
                                <div class="service-icon">
                                    <i class="fa fa-chart-line fa-2x"></i>
                                </div>
                                <a class="service-btn" href="https://ibrlive.com/register">
                                    <i class="fa fa-link fa-2x"></i>
                                </a>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-3">Currency Forecast</h5>
                                <span><ul>
                                    <li>Daily, Weekly and Monthly Forecast by experts in currency trading.</li>
                                    <li>More than 70% accurate forecasts.</li>
                                    <li>We analyse the market 24 X 7.</li>
                                </ul></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded h-100">
                            <div class="d-flex justify-content-between">
                                <div class="service-icon">
                                    <i class="fa fa-chart-area fa-2x"></i>
                                </div>
                                <a class="service-btn" href="https://ibrlive.com/register">
                                    <i class="fa fa-link fa-2x"></i>
                                </a>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-3">Forward Contract Management Tool</h5>
                                <span><ul>
                                    <li>Tool to calculate actual profit & loss for booked contracts.</li>
                                    <li>Maintain records of all ongoing and completed contracts.</li>
                                    <li>Reduces the hassle of maintaining excel.</li>
                                </ul></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded h-100">
                            <div class="d-flex justify-content-between">
                                <div class="service-icon">
                                    <i class="fa fa-balance-scale fa-2x"></i>
                                </div>
                                <a class="service-btn" href="https://ibrlive.com/register">
                                    <i class="fa fa-link fa-2x"></i>
                                </a>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-3">Monthly & Broken Date Forward Rate</h5>
                                <span><ul>
                                    <li>Month wise forward Rates/Broken date forward rates are available.</li>
                                    <li>Empowers you to negotiate for fair premium with your bank.</li>
                                    <li>Offers immense savings.</li>
                                </ul></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item rounded h-100">
                            <div class="d-flex justify-content-between">
                                <div class="service-icon">
                                    <i class="fa fa-house-damage fa-2x"></i>
                                </div>
                                <a class="service-btn" href="https://ibrlive.com/register">
                                    <i class="fa fa-link fa-2x"></i>
                                </a>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-3">Others</h5>
                               <span> <ul>
                                    <li> Currency Calculator</li>
                                    <li> Historical Rates</li>
                                    <li>Day opening and closing SMS</li>
                                </ul></span>
                               
                               
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->
       
    <div class="container-xxl  my-2 pt-2 wow fadeInUp" style="" data-wow-delay="0.1s">
            <div class="container px-lg-5 ">
                <div class="row align-items-center  px-lg-1" >
                    <div class="col-12 col-md-12   "><i>
                        <h3 class=" text-center">STOP WORRYING!!!</h3>
                         <h2 class=" text-center">&</h2>
                        <h3 class=" text-center">START SAVING!!!</h3>
                        </i>
                        
                   
                </div>
            </div>
        </div>

     <div class="container-xxl  my-2 wow fadeInUp" style="background-color:#164f75 ;" data-wow-delay="0.1s">
            <div class="container px-lg-5 ">
                <div class="row align-items-center  px-lg-5" style="height: 250px;">
                    <div class="col-12 col-md-12   ">
                        <h3 class="text-white text-center">Start your 10 Days FREE TRIAL</h3>
                        <small class="text-white"><p class="text-center">Without any credit card details.</p></small>
                        <div class="position-relative w-100 mt-3 text-center ">
                            <button class="btn btn-primary btn-lg text-center" onclick="location.href='https://ibrlive.com/register'">START NOW</button></div>
                    </div>
                   
                </div>
            </div>
        </div>


         <!-- Testimonial Start -->
        <div class="container-xxl py-2 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-2 px-lg-5">
               
                <h1 class="text-center mb-5 text-uppercase" style="font-family: Serif;"><i>Be among the ones who saved their lacs by being part of the IBRL<span style="text-transform:lowercase;">ive</span> community</i></h1>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x textcolor mt-n4 me-3"></i>In just one small transaction, I could manage to save money equivalent to 6 years of your website subscription fees.
                            Thanks a lot for all the help and support during my first transaction and in negotiating with my bank</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="/landing-page/img/vi.png" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Animesh Kumar</h5>
                                <span>Virtue International</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x textcolor mt-n4 me-3"></i>The rates shown on the screen almost matches with the banker screen and it had helped us to cover the exchange rate difference that we were paying to banks from last so many year. Wish you all the best for your best services.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="/landing-page/img/sheen-tex.png" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Kiran Miglani</h5>
                                <span>Sheen Tex India</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x textcolor mt-n4 me-3"></i> Since a long time we were getting lower exchange rates from the bank but now we have started to use IBRLive Screen for last three months (Since Nov 2021). It has helped us a lot to book the forward contract and credit the exporter bill payments at best exchange rates and to negotiate with the bank for the better exchange rate to show the IBRLive screen. As a result we are getting a big advantage of exchange rate difference.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="/landing-page/img/adarsh.png" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Mayank Singhal</h5>
                                <span> Adarsh Fabs</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x textcolor mt-n4 me-3"></i>I have been using the portal for almost 2 months (since November 2021) now. The rates shown on the screen matches exact with the banker screen and it had helped me so much to cover the exchange rate difference that I've been paying to banks from last so many years.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="/landing-page/img/weavetex-logo.jpg" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Abhishek Gupta</h5>
                                <span>  Weavetex Exports</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"><i class="fa fa-quote-left fa-4x textcolor mt-n4 me-3"></i> We are using the facility since almost last one year. The rates quoted are genuine and matches with the rates offered by various banks. Due to the support we are able to hedge our forex exposures.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="/landing-page/img/adarsh.png" style="width: 65px; height: 65px;">
                            <div class="ps-4">
                                <h5 class="mb-1">Sahil Sharma</h5>
                                <span>Javi Home Pvt. Ltd.</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Testimonial End -->


        <!-- Newsletter Start -->
       
        <!-- Newsletter End -->
        <div class="container-xxl py-2">
            <div class="container py-2 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    
                    <h1 class="text-center mb-5" style="text-transform:uppercase;">HOW THE PORTAL WORKS??</h1>
                </div>
                <div class="row">
                    <video id="video1" controls  played="false">
   <source src="/landing-page/img/myvideo.mp4" type="video/mp4" />
                    <source src="/landing-page/img/myvideo.mp4" type="video/webm" />
  Your browser does not support the video tag.
</video>
                  
                 </div>
            </div>
            
        </div>
        <div class="container-xxl  mt-6 wow fadeInUp" style="background-color:#164f75 ;" data-wow-delay="0.1s">
            <div class="container px-lg-5 ">
                <div class="row align-items-center  px-lg-5" style="height: 250px;">
                    <div class="col-12 col-md-12   ">
                        <h3 class="text-white text-center">Start your 10 Days FREE TRIAL</h3>
                        <small class="text-white"><p class="text-center">Without any credit card details</p></small>
                        <div class="position-relative w-100 mt-3 text-center ">
                            <button class="btn btn-primary btn-lg text-center" onclick="location.href='https://ibrlive.com/register'">START NOW</button></div>
                    </div>
                   
                </div>
            </div>
        </div>
       
      


        <!-- Features Start -->
       
        <!-- Features End -->


        <!-- Client Start -->
        
        <!-- Client End -->
       


        <div class="container-xxl py-4"  style="background-color: #ebf5fb;">
            <div class="container  " id="about" >
                <div class="row g-2 align-items-center">
                    <h1 class=" text-center" style="text-transform:uppercase;padding:40px;">WHY CHOOSE US??</h1>
                    
                    <div class="col-lg-6">
                        <ul>
                            <li> Helps you record and monitor your underlying exposure and
                                respective hedges at real time.</li>
                            <li> Negotiate with your bank for better exchange rates and forward
                                    premiums to maximize your profits.</li>
                            <li>Helps you to build a risk management Policy which consist of what,
                                how and when to hedge the currency exposure.</li>
                            <li> Provides you forward contract management tool to record and
                                monitor your ongoing and historical contracts. Also shows the actual
                                profit & loss for each contract.</li>
                                </ul>
                    </div>
                   
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        
                        
                         
                            
                            <ul>
                                <li>Provides you packing credit management tool to record and monitor
                                    your ongoing and completed packing credit disbursements. Notifies
                                    you for upcoming due dates for PC.</li>
                                <li>Guides you to do natural hedge through PCFC and opposite side
                                    exposures.</li>
                                <li>Provides you accurate currency forecasts on daily, weekly & monthly
                                    basis.</li>
                                <li>Minimize your interest cost by converting your domestic long term
                                    borrowings into foreign currency borrowings.</li>
                            </ul>
                       
                    </div>
                   
                </div>
            </div>
        </div>

   
       

        <!-- Team Start -->
        <div class="container-xxl py-6" style="background-color:#164f75;">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                   
                    <h2 class="mb-5 text-uppercase" style="color: white;">Frequently Asked Questions</h2>
                </div>
                <div class="row g-4">
                    <div class="accordion" id="accordionExample">
                     
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How can your forex subscription helps me in saving money?
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Provide accurate information which empowers you to save your
                                earnings by negotiating with your bank for better deals on following
                                transactions:
                                <ul>
                                    <li>Inward/Outward remittances</li>
                                    <li>Premium on forward bookings</li>
                                    <li>Rate of interest on RPC & PCFC disbursements</li>
                                    <li>Choosing between rupee export credit and foreign export credit.</li>
                                    <li>Hedging Services</li>
                                </ul>
                             
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                What is forward contract management tool?
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Features of the tool:-
                                <ul>
                                    <li>Recording of booked forward contracts in digital form.</li>
                                    <li>Provides real time profit and loss on any booked contract</li>
                                    <li> Calculate Swap points on early utilization and profit and loss on
                                        cancellation of forward contract.</li>
                                    <li>Notifies about contracts being due or expiring.</li>
                                    <li>Full and partial utilization of contract available</li>
                                    <li>Maintains historical data of all the contracts</li>
                                </ul>
                            
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                What is RPC/PCFC management tool?
                              </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                  Features of the tool:-
                                  <ul>
                                      <li>Recording of RPC/PCFC disbursed transactions in digital form.</li>
                                      <li>Notifies about RPC/PCFC being due or expiring.</li>
                                      <li>Maintains historical data of all disbursements.</li>
                                      <li>Uploading and retrieval of purchase orders used for disbursements.</li>
                                  </ul>
                              
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Can I book rate on your portal?
                              </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                No, you cannot book rate on our portal but you can get the real
                                time information related to currency rates to negotiate better rates with
                                your bank.
                              
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                How accurate are your currency forecasts?
                              </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                A team with technical expertise provides forecasts with more than
                                70% accuracy.
                              
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                What payment options are available to me?
                              </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Payment can be made online by debit card, credit card, internet
banking and UPI. You can also make RTGS/NEFT or draw a cheque
in the name of the company.
                              
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                Can I pay the subscription amount in instalments?
                              </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                The quarterly instalment option is available only in Fxpress
Platinum Plan.
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
           <div class="container-xxl py-6" style="background-color:#ebf5fb;">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                   
               
                  <p class="box-title"><b><i class="fa fa-envelope-open-o" aria-hidden="true"></i>Still have some queries?? Write to us and we’ll get back to you at the earliest!!!</b></p>
                  <hr>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
		if(!empty($errors)){
		  echo "<p class='err' style='text-align: center; color:red; font-size: 14px;'>ERROR: ".nl2br($errors)."</p>";
		}
	        ?>
                <form role="form" method="POST" name="contact_form" action="">
                  
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input required type="text" class="form-control" maxlength="20" name="name" id="name" placeholder="Enter full name">
                    </div>

                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input required type="email" class="form-control" maxlength="50" name="email" id="email" placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Phone</label>
                      <input type="text" class="form-control" maxlength="15" name="phone" id="phone" onKeyPress="return isNumberKey(event);" 
 placeholder="Enter your phone">
                    </div>

                    <div class="form-group">
                      <label for="message">Your Query</label>
                      <textarea required class="form-control" id="message" name="message" placeholder="Enter your query (max 250 chars)" maxlength="250" rows="3" style="resize: none;"></textarea>
                    </div>
                    
                    <div class="form-group">
                    <img src="captcha.php" />
                    <br/>
                    Write the code below:
                    <br/>
                    <input type="text" name="captcha" />
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align=center>
                    <button value="Submit" name="submit"  type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>

                <script language="JavaScript">
	          var frmvalidator  = new Validator("contact_form");
	          frmvalidator.addValidation("name","req","Please provide your name"); 
                  frmvalidator.addValidation("email","req","Please provide your email"); 
	          frmvalidator.addValidation("email","email","Please enter a valid email address"); 
	        </script>
              </div><!-- /.box -->
            </div>
  
     <div class="container-xxl   wow fadeInUp" style="background-color:#164f75 ;" data-wow-delay="0.1s">
            <div class="container px-lg-5 ">
                <div class="row align-items-center  px-lg-5" style="height: 250px;">
                    <div class="col-12 col-md-12   ">
                        <h3 class="text-white text-center">Start your 10 Days FREE TRIAL</h3>
                        <small class="text-white"><p class="text-center">Without any credit card details</p></small>
                        <div class="position-relative w-100 mt-3 text-center ">
                            <button class="btn btn-primary btn-lg text-center" onclick="location.href='https://ibrlive.com/register'">START NOW</button></div>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="container-xxl py-6" style="background-color: #ebf5fb;">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <div class="d-inline-block border rounded-pill text-primary px-4 mb-3">Contact Us</div>
                <h2 class="mb-5">Reach out to us on-</h2>
            </div>
                <div class="row g-4 d-flex  justify-content-center">
                    <div class="col-lg-10 col-md-10 wow fadeInUp "  data-wow-delay="0.1s">
                        <div class=" rounded h-100" >
                           <div class=" row d-flex justify-content-around">
                            <div class=" contact-item col-lg-2 col-sm-4" onclick="location.href='mailto:contact@ibrlive.com';">
                                <i class="bi bi-envelope"></i>
                                <p>contact@ibrlive.com</p>
                            </div>
                            <div class="contact-item col-lg-2 col-sm-4" onclick="location.href='https://www.facebook.com/ibrliveindia/';">
                                <i class="bi bi-facebook"></i>
                                <p>@ibrliveindia</p>
                            </div>
                            <div class="contact-item col-lg-2 col-sm-4" onclick="location.href='https://twitter.com/ibr_live';">
                                <i class="bi bi-twitter"></i>
                                <p>@ibr_live</p>
                            </div>
                            <div class="contact-item col-lg-2 col-sm-4" onclick="location.href='https://wa.me/919813097272?text=Hello';">
                                <i class="bi bi-whatsapp"></i>
                                <p>+91 98130 97272</p>
                            </div>
                            <div class="contact-item col-lg-2 col-sm-4" onclick="location.href='https://www.linkedin.com/company/ibrlive';">
                                <i class="bi bi-linkedin"></i>
                                <p>@ibrlive</p>
                            </div>
                            <div class="contact-item col-lg-2 col-sm-4" onclick="location.href='https://www.instagram.com/ibrlive/';">
                                <i class="bi bi-instagram"></i>
                                <p>@ibrlive</p>
                            </div>
                            
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- Footer Start -->
        <footer class="main-footer" style="background-color:#0e2e50 ;">
            <div class="container">
              <div class="row ">
                <div class="col-md-2 "> 
                  <a style="color: #94e2ff;"  href="/privacy-policy">Privacy Policy</a>
                </div>
                <div class="col-md-2">
                  <a style="color: #94e2ff;" href="/terms-and-conditions">Terms and Conditions</a>
                </div>
                <div class="col-md-2">
                  <a style="color: #94e2ff;" href="/refund-cancellation">Refund and Cancellation</a>
                </div>
                <div class="col-md-4" style="color:white;">
                  <strong >Copyright &copy; 2022 <a style="color: #94e2ff;" href="https://www.ibrlive.com">IBRLive India Private Limited</a>. All rights reserved.</strong>
                </div>
                <div class="col-md-2" style="color:white;">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                </div>
              </div>
            
            </div>
            <!-- /.container -->
            
          </footer>
        <!-- Footer End -->
       
       
        <!-- Back to Top -->
        
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/landing-page/lib/wow/wow.min.js"></script>
    <script src="/landing-page/lib/easing/easing.min.js"></script>
    <script src="/landing-page/lib/waypoints/waypoints.min.js"></script>
    <script src="/landing-page/lib/owlcarousel/owl.carousel.min.js"></script>
   


    <script>
        function playPauseVideo() {
    let videos = document.querySelectorAll("video");
    videos.forEach((video) => {
        // We can only control playback without insteraction if video is mute
         video.muted = true;
        // Play is a promise so we need to check we have it
        let playPromise = video.play();
        if (playPromise !== undefined) {
            playPromise.then((_) => {
                let observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (
                                entry.intersectionRatio !== 1 &&
                                !video.paused
                            ) {
                                video.pause();
                            } else if (video.paused) {
                                video.play();
                            }
                        });
                    },
                    { threshold: 0.2 }
                );
                observer.observe(video);
            });
        }
    });
}

// And you would kick this off where appropriate with:
playPauseVideo();

    </script>
    
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5fc481da920fc91564cbdf67/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

    <!-- Template Javascript -->
    <script src="/landing-page/js/main.js"></script>
</body>

</html>
