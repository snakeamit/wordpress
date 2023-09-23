<?php 
//require '../lib/database.php';
if(strpos($_SERVER['REMOTE_ADDR'], "157.36.10.52") === 0)
{
    die();
}

if(session_id()=='' || !isset($_SESSION)){
    session_start();
}
$allow="";
if(isset($_SESSION['username'])){
  $user = $_SESSION['username'];    
  //$allow = $_SESSION['userallow']; 
  
}else{
  if(!empty($_COOKIE['email']) && !empty($_COOKIE['token'])){ 
    $servername = "localhost";
    // $username = "root";
    // $password = "";
    $username = "ibrlive";
    $password = "tubelight";
    $dbname = "ibrMock";

    $allow=""; 
    //Create connection
    //$conn = OpenCon();
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $email=$_COOKIE['email'];
    $token=$_COOKIE['token'];

    $sqld = "SELECT id, name, phone, paid, created, validity, amount,passcookie FROM customers WHERE email='$email'";
    $result = $conn->query($sqld);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $hash = $row['passcookie'];
        if($hash==""){
        }else{
          $auth = password_verify($token, $hash); 
          if($auth == 1){
            $_SESSION['userid'] = $row['id'];  
            $_SESSION['sessCustomerID'] = $row['id'];
            $_SESSION['userallow'] = $row['paid'];
            $user = $_SESSION['username'] = $row['name']; 
            $_SESSION['useremail'] = $email;  
            $_SESSION['userphone'] = $row['phone'];
          }
        }
      }
    }
    $conn->close();
  }else{      
    $user="";
    $allow="NO";   
  }
}
?>
  <script>
    function showMF(){document.getElementById("mfopt").style.display="block",document.getElementById("feopt").style.display="none"}function showFE(){document.getElementById("feopt").style.display="block",document.getElementById("mfopt").style.display="none"}function hideMFFE(){document.getElementById("feopt").style.display="none",document.getElementById("mfopt").style.display="none"}
  </script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  <style>
  
  .blink_me {
  animation: blinker 1s linear infinite;
  
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
  .skin-blue .main-header .navbar {
    background-color: #337ab7;
  }
  </style>
  <header class="main-header" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1)">

    <nav class="navbar navbar-static-top">
<font style="font-size: 20px; text-align: center;">
					
					<marquee scrollamount="2" width="100%" behavior="alternate" bgcolor="#244050" style="color: white;">  
&#10070; India's most preferred financial information provider &#10070; Live Currency Rates &#10070; Forward Rates &#10070; Historical Rates &#10070; Currency Forecast &#10070; 
 Currency Calculator &#10070; 
</marquee>  
				</font>	
      <div class="container">
			
        <div class="navbar-header">
          <a href="/home" class="navbar-brand"><img style="display:inline; margin-top: -16px; width: 100px;" src="/pix.jpg"/></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left fontmenu"  id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li id="navhome" class="active"><a href="/home">HOME</a></li>
            <!-- <li><a href="#">TOOLS</a></li> -->
	        <li><a href="/usd-inr-forecast">FORECAST</a></li>
	    
            <li id="navblog"><a href="/blogs/">BLOGS</a></li>
            <li id="navblog"><a href="/forward-rates">FORWARD RATE</a></li>
            <li id="navour-products"><a href="/plans-and-pricing">PRODUCTS</a></li>
            <!--li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> LINKS <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    
                    <li class="fontsubmenu" style="text-align: center;"><a target="_blank" href="https://services.gst.gov.in/services/searchtp"><b>GST Verification</b></a></li>		
                    <li class="divider"></li>
                    <li class="fontsubmenu" style="text-align: center;"><a target="_blank" href="https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp"><b>PAN Verification</b></a></li>		
                  </ul>
                </li-->
	    <!-- <li><a href="#">MOBILE APP</a></li> -->
	    <li id="navabout"><a href="/central-bank-interest-rates">BENCHMARK RATE</a></li>
	    <li id="navabout"><a href="/lei-code"   >GET LEI</a></li>
	    <!--li id="navabout"><a href="/jobs">JOBS</a></li-->
      <li id="navlearn" class="dropdown">
              <a onmouseover="hideMFFE()" href="#" class="dropdown-toggle" data-toggle="dropdown">LEARN <span class="caret"></span></a>
              
              <ul class="dropdown-menu" role="menu">
                <li class="fontsubmenu"><a href="/rbi-master-directions"><i class="fa fa-plus"></i><b>RBI Master Directions</b></a></li>

                <li class="divider"></li>
                <li class="fontsubmenu"><a href="https://ibrlive.estudium.org/products/Paid-NISM-Series%20V-A-Mutual%20Funds-English" target="_blank" style=""><i class="fa fa-external-link"></i><b> MUTUAL FUNDS</b></a></li> 
                <li class="fontsubmenu"><a href="https://ibrlive.estudium.org/products/Paid-IIBF-FE-Foreign%20Exchange-English" target="_blank" style=""><i class="fa fa-external-link"></i><b> FOREIGN EXCHANGE</b></a></li> 
                <!-- <li class="fontsubmenu"><a onmouseover="showMF()" href="/mutual-fund" style=""><i class="fa fa-plus"></i><b> MUTUAL FUNDS</b></a></li> -->
		<!--<ul id="mfopt" style="display: none;">
		  <li class="dropdown fontsubmenu"><a href="/mf-mock-01">Mock Test 01 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/mf-mock-02">Mock Test 02 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/mf-mock-03">Mock Test 03 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/mf-mock-04">Mock Test 04 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/mf-mock-05">Mock Test 05 (Free)</a></li>
                  <li class="dropdown fontsubmenu"><a href="/mutual-fund-test"><font style="color: #000080;"><b>MORE TESTS HERE</b></font></a></li>
		</ul>-->			
        <!--        <li class="divider"></li> -->
        <!--        <li class="fontsubmenu"><a onmouseover="showFE()" href="/foreign-exchange" style=""><i class="fa fa-plus"></i><b> FOREIGN EXCHANGE</b></a></li> -->
		<!-- <ul id="feopt" style="display: none;">
		  <li class="dropdown fontsubmenu"><a href="/fe-mock-0200">Mock Test 01 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/fe-mock-0201">Mock Test 02 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/fe-mock-0202">Mock Test 03 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/fe-mock-0203">Mock Test 04 (Free)</a></li>
		  <li class="dropdown fontsubmenu"><a href="/fe-mock-0204">Mock Test 05 (Free)</a></li>
                  <li class="dropdown fontsubmenu"><a href="/foreign-exchange-test"><font style="color: #000080;"><b>MORE TESTS HERE</b></font></a></li>
		      </ul>	 -->
              </ul>
            </li>
	    <li id="navabout"><a href="/about">ABOUT US</a></li>
	    <!-- <li id="navcontact"><a href="/contact">CONTACT US</a></li>  -->
        <!--li id="navfac"><a target="_blank" href="https://www.facebook.com/Learn-and-Spread-IBRLive-114805613401798"><i class="fa fa-facebook"></i></a></li--> 
        
            <?php
              if($user==""){
                echo "<li class=\"dropdown\">
                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-angle-double-down\"></i> User</a></a>
                  <ul class=\"dropdown-menu\" role=\"menu\">
                    <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/register\"><b>New User - Registration</b></a></li>				
                    <li class=\"divider\"></li>
                    <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/login\"><b>Existing User - Login</b></a></li>		
                  </ul>
                </li>";
              }else{

                if($allow==""){
                  echo "<li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-angle-double-down\"></i> Welcome</a></a>
                      <ul class=\"dropdown-menu\" role=\"menu\">
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"#\"><b> $user </b></a></li>
			<li class=\"divider\"></li>
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/profile\"><b>My Profile</b></a></li>	
                        <li class=\"divider\"></li>
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/viewCart\"><b>View Cart</b></a></li>		
                        <li class=\"divider\"></li>
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/logout\"><b>Logout</b></a></li>		
                     </ul>
                    </li>";
                }else{
                  echo "<li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-angle-double-down\"></i> Welcome</a></a>
                      <ul class=\"dropdown-menu\" role=\"menu\">
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"#\"><b> $user </b></a></li>
			<li class=\"divider\"></li>
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/profile\"><b>My Profile</b></a></li>
                        <li class=\"divider\"></li> 				
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/viewCart\"><b>View Cart</b></a></li>			                       
                        <li class=\"divider\"></li>
                        <li class=\"fontsubmenu\" style=\"text-align: center;\"><a href=\"/logout\"><b>Logout</b></a></li>		
                     </ul>
                    </li>";
                }
              } 
            ?>


	  </ul>
          
        </div>
        <!-- /.navbar-collapse -->

        <div class="collapse navbar-collapse pull-right fontmenu" id="navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            
          </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>

  </header>
