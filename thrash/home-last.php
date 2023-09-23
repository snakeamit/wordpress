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

  $queryTom = "SELECT * FROM `cash-tom`";
  $resultTom = $conn->query($queryTom);
  
  $cashBidUsd = 0; $cashBidEur = 0; $cashBidGbp = 0;
  $cashAskUsd = 0; $cashAskEur = 0; $cashAskGbp = 0;
  
  $tomBidUsd = 0; $tomBidEur = 0; $tomBidGbp = 0;
  $tomAskUsd = 0; $tomAskEur = 0; $tomAskGbp = 0;
  
  while($rowTom = $resultTom->fetch_assoc()){ 
    switch($rowTom['id']){
        case '1':
            $cashBidUsd = $rowTom['cashBid'];
            $cashAskUsd = $rowTom['cashAsk'];
            $tomBidUsd = $rowTom['tomBid'];
            $tomAskUsd = $rowTom['tomAsk'];
        break;
        
        case '2':
            $cashBidEur = $rowTom['cashBid'];
            $cashAskEur = $rowTom['cashAsk'];
            $tomBidEur = $rowTom['tomBid'];
            $tomAskEur = $rowTom['tomAsk'];
        break;
        
        case '3':
            $cashBidGbp = $rowTom['cashBid'];
            $cashAskGbp = $rowTom['cashAsk'];
            $tomBidGbp = $rowTom['tomBid'];
            $tomAskGbp = $rowTom['tomAsk'];
        break;
    }
  }	
  
  $query0 = "SELECT id, month, settleDate, bidPrem, askPrem, bidPremEUR, askPremEUR, bidPremGBP, askPremGBP FROM usdFwdRate";
  $result0 = $conn->query($query0);
  $arrayBid = array();
  $arrayAsk = array();

  $arrayBidEUR = array();
  $arrayAskEUR = array();

  $arrayBidGBP = array();
  $arrayAskGBP = array();

  $endSettleDate;
  
  while($row0 = $result0->fetch_assoc()){ 
      
    $arrDateSettle = date("d-m-Y", strtotime($row0['settleDate']));
    $arrayBid[$arrDateSettle] = $row0['bidPrem'];
    $arrayAsk[$arrDateSettle] = $row0['askPrem'];
    
    $arrayBidEUR[$arrDateSettle] = $row0['bidPremEUR'];
    $arrayAskEUR[$arrDateSettle] = $row0['askPremEUR'];
    
    $arrayBidGBP[$arrDateSettle] = $row0['bidPremGBP'];
    $arrayAskGBP[$arrDateSettle] = $row0['askPremGBP'];
    
    $endSettleDate = date("d-m-Y", strtotime($row0['settleDate']));
  }	

  //print_r($arrayBid);
  
  $query = "SELECT holiday FROM holidays ORDER BY holiday ASC";
  $result = $conn->query($query);
	
  $d=0;
  $listHoliday = array();
  
  while($row = $result->fetch_assoc()){ 
    $d++;
    $hd=$row['holiday'];
    $splitIt = explode("-", $hd);
     
    $newKey = $splitIt[2].'-'.$splitIt[1].'-'.$splitIt[0];
    
    $listHoliday[$newKey]=1;
  }
   
  //print_r($listHoliday);
   
  $conn->close();
  
  if(isset($_POST['spotBidPrem-1'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      $err = "Error! Try again Later!";
    }else{
      $succ = "Connection established";
    } 

    for ($i = 1; $i <= 12; $i++) {
      $settleDate = strval($_POST['spotSettleDt-'.$i]);
      
      $settleDateN = explode("-", $settleDate);
      $newKey = $settleDateN[2].'-'.$settleDateN[1].'-'.$settleDateN[0];
    
      $premBid = $_POST['spotBidPrem-'.$i];
      $premAsk = $_POST['spotAskPrem-'.$i];
    
$sql="UPDATE usdFwdRate SET settleDate='$newKey', bidPrem='$premBid', askPrem='$premAsk' WHERE id=$i";
    
      if ($conn->query($sql) === TRUE) {
        $succ = "Record updated successfully";
      } else {
        $err = "Error updating record: " . $conn->error;
      }
    }
    
    $conn->close();
  }

  $dateToday = new DateTime('today');
  $tday = new DateTime('today'); 
  
  $tday->format('d-m-Y');
  
  $dt = new DateTime('today + 3 day'); 

  function addMonth($day, $dt, $mt) {
    $dt->modify('first day of +1 month');
    $dt->modify('+' . (min($day, $dt->format('t')) - $mt) . ' days');
    return $dt->format('d-m-Y');
  }      

  function addDay($dt) {
    $dt = new DateTime($dt);
    $dt->modify('+1 day');
    return $dt->format('d-m-Y');  
  }
  
  function add3Days($dt) {
    $dt->modify('+3 days');
    return $dt->format('d-m-Y');  
  }
  
  function removeDay($dt) {
    $dt = new DateTime($dt);
    $dt->modify('-1 day');
    return $dt->format('d-m-Y');  
  }  
  
  function addSimpleDay($dt) {
    $dt = new DateTime($dt);
    $dt->modify('+1 day');
    return $dt;  
  }

  $countSettleDt=0;
  $mainSettleDt=new DateTime('today');
  $minDay='';
  $maxDay='';
  
  while($countSettleDt<2){
    $mainSettleDt->modify('+1 day');  
    
    if(array_key_exists($mainSettleDt->format('d-m-Y'), $listHoliday) == 1){
       
    }else{
      $countSettleDt++;    
    } 
  }
    
  $arrDay = array();
  
  $arrDay[0]=new DateTime($mainSettleDt->format('d-m-Y'));
  
  for($k=0; $k<12; $k++){
    $tempArrDay0=new DateTime($mainSettleDt->format('d-m-Y'));  
    $m=$k+1;
    $tempArrDay0->modify('+'.$m.' month');
    
    $countSettleDt=0;
    while(1){
      if(array_key_exists($tempArrDay0->format('d-m-Y'), $listHoliday) == 1){
        $tempArrDay0->modify('+1 day');  
      }else{
        break;    
      }
    }
    $arrDay[$k]=$tempArrDay0->format('d-m-Y');    
  }
  
  $mainFwdStartDt=new DateTime($mainSettleDt->format('d-m-Y'));
  $countFwdSDt=0;
  while($countFwdSDt<1){
    $mainFwdStartDt->modify('+1 day');  
    
    if(array_key_exists($mainFwdStartDt->format('d-m-Y'), $listHoliday) == 1){
       
    }else{
      $countFwdSDt++;    
    }  
      
  }
  
  $dateToday = new DateTime('today');

  function add365Days($dt) {
    $dt->modify('+365 days');
    return $dt->format('Y-m-d');  
  }

  $minDay = $mainFwdStartDt->format('d-m-Y');
  $maxDay = $endSettleDate; //add365Days($dateToday);

  include("check-FXPRESS.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Most Accurate & Live Currency Rates. USD INR Forward Rates. Currency Calculator. USD INR Historical Data. USD to INR Forecast. IIBF's Certificate Course In Foreign Exchange Study Material. Mutual Fund Distributors Examination MCQ">
  <meta name="keywords" content="IIBF Certificate, Foreign Exchange, NISM, Mutual Fund, Distributors, ibrlive, Currency Rates, Exchange Rates, RBI Circulars, Foreign Exchange, Currency Calculator, Currency Converter">

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

  <meta name="theme-color" content="#ffffff">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="calculations.js"></script>
  <![endif]-->

    
    
    <style>
    .rwd-media {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* 16:9 */
    }

    .rwd-media iframe,
    .rwd-media video {
        position: absolute;
        width: 100%;
        height: 100%;  
    }

    #d2c.show-bg {
        background: url("https://ibrlive.com/images/login-required.png") !important;
        background-size: 100% 100% !important;
    }

    #d2c.hide-bg {
        background-image: none !important;
        background: transparent !important;
    }
    
    #d2b.show-bg {
        background: url("https://ibrlive.com/images/login-required.png") !important;
        background-size: 100% 100% !important;
    }

    #d2b.hide-bg {
        background-image: none !important;
        background: transparent !important;
    }
    
    #no-more-tables2.show-bg {
        background: url("https://ibrlive.com/images/login-required.png") !important;
        background-size: 100% 100% !important;
    }

    #no-more-tables2.hide-bg {
        background-image: none !important;
        background: transparent !important;
    }
    th.ui-datepicker-week-end,
    td.ui-datepicker-week-end {
        display: none;
    }
    
    input[type=date]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
    }
    
    .img-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    
    .modal-wide {
      width: 90%; 
    }
    
    .carousel-indicators .active {
  background: #31708f;
}


.adjust1 {
  float: left;
  width: 100%;
  margin-bottom: 0;
}

.adjust2 {
  margin: 0;
}

.carousel-indicators li {
  border: 1px solid #ccc;
}

.carousel-control {
  color: #31708f;
  width: 5%;
}

.carousel-control:hover,
.carousel-control:focus {
  color: #31708f;
}

.carousel-control.left,
.carousel-control.right {
  background-image: none;
}

.media-object {
  margin: auto;
  margin-top: 15%;
}

@media screen and (max-width: 768px) {
  .media-object {
    margin-top: 0;
  }
}
    
    .card{ background-color: #fff; border: 1px solid transparent; border-radius: 6px; }
.card > .card-link{ color: #333; }
.card > .card-link:hover{  text-decoration: none; }
.card > .card-link .card-img img{ border-radius: 6px 6px 0 0; }
.card .card-img{ position: relative; padding: 0; display: table; }
.card .card-img .card-caption{
  position: absolute;
  right: 0;
  bottom: 16px;
  left: 0;
}
.card .card-body{ display: table; width: 100%; padding: 12px; }
.card .card-header{ border-radius: 6px 6px 0 0; padding: 8px; }
.card .card-footer{ border-radius: 0 0 6px 6px; padding: 8px; }
.card .card-left{ position: relative; float: left; padding: 0 0 8px 0; }
.card .card-right{ position: relative; float: left; padding: 8px 0 0 0; }
.card .card-body h1:first-child,
.card .card-body h2:first-child,
.card .card-body h3:first-child, 
.card .card-body h4:first-child,
.card .card-body .h1,
.card .card-body .h2,
.card .card-body .h3, 
.card .card-body .h4{ margin-top: 0; }
.card .card-body .heading{ display: block;  }
.card .card-body .heading:last-child{ margin-bottom: 0; }

.card .card-body .lead{ text-align: center; }

@media( min-width: 768px ){
  .card .card-left{ float: left; padding: 0 8px 0 0; }
  .card .card-right{ float: left; padding: 0 0 0 8px; }
    
  .card .card-4-8 .card-left{ width: 33.33333333%; }
  .card .card-4-8 .card-right{ width: 66.66666667%; }

  .card .card-5-7 .card-left{ width: 41.66666667%; }
  .card .card-5-7 .card-right{ width: 58.33333333%; }
  
  .card .card-6-6 .card-left{ width: 50%; }
  .card .card-6-6 .card-right{ width: 50%; }
  
  .card .card-7-5 .card-left{ width: 58.33333333%; }
  .card .card-7-5 .card-right{ width: 41.66666667%; }
  
  .card .card-8-4 .card-left{ width: 66.66666667%; }
  .card .card-8-4 .card-right{ width: 33.33333333%; }
}

/* -- default theme ------ */
.card-default{ 
  border-color: #ddd;
  background-color: #fff;
  margin-bottom: 24px;
}
.card-default > .card-header,
.card-default > .card-footer{ color: #333; background-color: #ddd; }
.card-default > .card-header{ border-bottom: 1px solid #ddd; padding: 8px; }
.card-default > .card-footer{ border-top: 1px solid #ddd; padding: 8px; }
.card-default > .card-body{  }
.card-default > .card-img:first-child img{ border-radius: 6px 6px 0 0; }
.card-default > .card-left{ padding-right: 4px; }
.card-default > .card-right{ padding-left: 4px; }
.card-default p:last-child{ margin-bottom: 0; }
.card-default .card-caption { color: #fff; text-align: center; text-transform: uppercase; }
    </style>
    
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/daterangepicker/daterangepicker.css" />
    
    <script>
    var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
    var bidArray = <?php echo json_encode($arrayBid); ?>;
    var askArray = <?php echo json_encode($arrayAsk); ?>;
    
    	function CalSpotFwdBidSample(sourceForm){
        var bid;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        n=document.getElementById("pairSelExp").value;
 
        if(n == 1 || n == 2 || n == 3){
            
        }else{
            document.getElementById('fwdExp').value = "Not Available";
            document.getElementById('fwdPremBid').value = "Not Available";
            alert("Soon Available!");
            return;
        }
		
		var bidArray;
		
		if(n == 1){
			bodyText = document.getElementById("inrToUSDbid").innerHTML;
			bidArray = <?php echo json_encode($arrayBid); ?>;
		}else if(n == 2){
			bodyText = document.getElementById("inrToEURbid").innerHTML;
			bidArray = <?php echo json_encode($arrayBidEUR); ?>;			
		}else if(n == 3){
			bodyText = document.getElementById("inrToGBPbid").innerHTML;
			bidArray = <?php echo json_encode($arrayBidGBP); ?>;
		}else{
			return;
		}		
        
        bodyText = bodyText.replace(re, '');
        bid = parseFloat(bodyText);
          
        var ds = sourceForm.dateExp.value;
        if(ds == ""){
            return;
        }
        
        ds = ds.toString().split('-');
        ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);        		

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        var fs_ = new Date(fs); //Forward Start Date
        fs_.setHours(0,0,0,0);
        
        var dprev_ = fs_; // date prev month = forward start date (Initially)
        var dnext_; // this will be set in for loop (see next)
        var pprev_ = 0; // forward premium = 0 (Initially)
        var pnext_ = 0; // this will be set in for loop (see next)
        var fwdprem = 0;
        var spotFwdRate = 0;
        var flag = 0 ; // got the final spot fwd rate
        
        for( var key in bidArray ) {
            var value = bidArray[key];
            sd = key.toString().split('-');
            sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
            sd_.setHours(0,0,0,0);
            
            dnext_ = sd_; // bidArray key is settlement date = date next 
            ddiff_ = parseInt((ds_ - dprev_)/(1000 * 60 * 60 * 24))+1; 
            pnext_ = parseFloat(value);
            dp_ = parseFloat(pnext_ - pprev_); // difference premium
            dmdiff_ = parseInt((dnext_ - dprev_)/(1000 * 60 * 60 * 24))+1;

            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                spotFwdRate = parseFloat(parseFloat(bid) + fwdprem/100).toFixed(4);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdExp').value = parseFloat(spotFwdRate).toFixed(4);
            document.getElementById('fwdPremBid').value = parseFloat(fwdprem/100).toFixed(4);
        }else{
            document.getElementById('fwdExp').value = "Not Available";
            document.getElementById('fwdPremBid').value = "Not Available";
        }
    }
    
    function CalSpotFwdAskSample(sourceForm){
        var ask;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        
        n=document.getElementById("pairSelImp").value;
        if(n == 1 || n == 2 || n == 3){
            
        }else{
            document.getElementById('fwdImp').value = "";
            document.getElementById('fwdPremAsk').value = "";
            //alert("Soon Available!");
            return;
        }
        
        var ds = sourceForm.dateImp.value;
        if(ds == ""){
            return;
        }
        ds = ds.toString().split('-');
        ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);
        
        var askArray = <?php echo json_encode($arrayAsk); ?>;
		
		if(n == 1){
			bodyText = document.getElementById("inrToUSDask").innerHTML;
			askArray = <?php echo json_encode($arrayAsk); ?>;
		}else if(n == 2){
			bodyText = document.getElementById("inrToEURask").innerHTML;
			askArray = <?php echo json_encode($arrayAskEUR); ?>;			
		}else if(n == 3){
			bodyText = document.getElementById("inrToGBPask").innerHTML;
			askArray = <?php echo json_encode($arrayAskGBP); ?>;
		}else{
			return;
		}	
		
        bodyText = bodyText.replace(re, '');
        ask = parseFloat(bodyText);
		
        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        var fs_ = new Date(fs); //Forward Start Date
        fs_.setHours(0,0,0,0);
        
        var dprev_ = fs_; // date prev month = forward start date (Initially)
        var dnext_; // this will be set in for loop (see next)
        var pprev_ = 0; // forward premium = 0 (Initially)
        var pnext_ = 0; // this will be set in for loop (see next)
        var fwdprem = 0;
        var spotFwdRate = 0;
        var flag = 0 ; // got the final spot fwd rate
        
        for( var key in askArray ) {
            var value = askArray[key];
            sd = key.toString().split('-');
            sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
            sd_.setHours(0,0,0,0);
            
            dnext_ = sd_; // askArray key is settlement date = date next 
            ddiff_ = parseInt((ds_ - dprev_)/(1000 * 60 * 60 * 24))+1; 
            pnext_ = parseFloat(value);
            dp_ = parseFloat(pnext_ - pprev_); // difference premium
            dmdiff_ = parseInt((dnext_ - dprev_)/(1000 * 60 * 60 * 24))+1;
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));
                
                spotFwdRate = parseFloat(parseFloat(ask) + fwdprem/100).toFixed(4);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdImp').value = parseFloat(spotFwdRate).toFixed(4);
            document.getElementById('fwdPremAsk').value = parseFloat(fwdprem/100).toFixed(4);
        }else{
            document.getElementById('fwdImp').value = "Not Available";
            document.getElementById('fwdPremAsk').value = "Not Available";
        }
    }
    
    function CalSpotFwdBid(sourceForm){
        var bid;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        n=document.getElementById("pairSelExp").value;
        if(n == 1){
            
        }else{
            document.getElementById('fwdExp').value = "Not Available";
            document.getElementById('fwdPremBid').value = "Not Available";
            //alert("Soon Available!");
            return;
        }
        bodyText = document.getElementById("inrToUSDbid").innerHTML;
        bodyText = bodyText.replace(re, '');
        bid = parseFloat(bodyText);
          
        var ds = sourceForm.dateExp.value;
        if(ds == ""){
            document.getElementById('fwdExp').value = "Not Available";
            document.getElementById('fwdPremBid').value = "Not Available";
            //alert("Soon Available!");
            return;
        }
        
        ds = ds.toString().split('-');
        ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);
        
        var bidArray = <?php echo json_encode($arrayBid); ?>;

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        var fs_ = new Date(fs); //Forward Start Date
        fs_.setHours(0,0,0,0);
        
        var dprev_ = fs_; // date prev month = forward start date (Initially)
        var dnext_; // this will be set in for loop (see next)
        var pprev_ = 0; // forward premium = 0 (Initially)
        var pnext_ = 0; // this will be set in for loop (see next)
        var fwdprem = 0;
        var spotFwdRate = 0;
        var flag = 0 ; // got the final spot fwd rate
        
        for( var key in bidArray ) {
            var value = bidArray[key];
            sd = key.toString().split('-');
            sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
            sd_.setHours(0,0,0,0);
            
            dnext_ = sd_; // bidArray key is settlement date = date next 
            ddiff_ = parseInt((ds_ - dprev_)/(1000 * 60 * 60 * 24))+1; 
            pnext_ = parseFloat(value);
            dp_ = parseFloat(pnext_ - pprev_); // difference premium
            dmdiff_ = parseInt((dnext_ - dprev_)/(1000 * 60 * 60 * 24))+1;

            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                spotFwdRate = parseFloat(parseFloat(bid) + fwdprem/100).toFixed(4);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdExp').value = parseFloat(spotFwdRate).toFixed(4);
            document.getElementById('fwdPremBid').value = parseFloat(fwdprem/100).toFixed(4);
        }else{
            document.getElementById('fwdExp').value = "Not Available";
            document.getElementById('fwdPremBid').value = "Not Available";
        }
    }
    
    function CalSpotFwdAsk(sourceForm){
        var ask;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        bodyText = document.getElementById("inrToUSDask").innerHTML;
        bodyText = bodyText.replace(re, '');
        ask = parseFloat(bodyText);
        n=document.getElementById("pairSelImp").value;
        if(n == 1){
            
        }else{
            document.getElementById('fwdImp').value = "Not Available";
            document.getElementById('fwdPremAsk').value = "Not Available";
            //alert("Soon Available!");
            return;
        }
        
        var ds = sourceForm.dateImp.value;
        if(ds == ""){
            document.getElementById('fwdImp').value = "Not Available";
            document.getElementById('fwdPremAsk').value = "Not Available";
            //alert("Soon Available!");
            return;
        }
        ds = ds.toString().split('-');
        ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);
        
        var askArray = <?php echo json_encode($arrayAsk); ?>;

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        var fs_ = new Date(fs); //Forward Start Date
        fs_.setHours(0,0,0,0);
        
        var dprev_ = fs_; // date prev month = forward start date (Initially)
        var dnext_; // this will be set in for loop (see next)
        var pprev_ = 0; // forward premium = 0 (Initially)
        var pnext_ = 0; // this will be set in for loop (see next)
        var fwdprem = 0;
        var spotFwdRate = 0;
        var flag = 0 ; // got the final spot fwd rate
        
        for( var key in askArray ) {
            var value = askArray[key];
            sd = key.toString().split('-');
            sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
            sd_.setHours(0,0,0,0);
            
            dnext_ = sd_; // askArray key is settlement date = date next 
            ddiff_ = parseInt((ds_ - dprev_)/(1000 * 60 * 60 * 24))+1; 
            pnext_ = parseFloat(value);
            dp_ = parseFloat(pnext_ - pprev_); // difference premium
            dmdiff_ = parseInt((dnext_ - dprev_)/(1000 * 60 * 60 * 24))+1;
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));
                
                spotFwdRate = parseFloat(parseFloat(ask) + fwdprem/100).toFixed(4);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdImp').value = parseFloat(spotFwdRate).toFixed(4);
            document.getElementById('fwdPremAsk').value = parseFloat(fwdprem/100).toFixed(4);
        }else{
            document.getElementById('fwdImp').value = "Not Available";
            document.getElementById('fwdPremAsk').value = "Not Available";
        }
    }
    </script>
    
        <script>
    //var urlNews="https://newsapi.org/v2/top-headlines?country=in&pageSize=15&category=business&apiKey=ae6228a1b731425fb97446ca3424d2bf",req=new Request(urlNews);
    
    function findHistData(){var e=document.getElementById("startTimestamp").value,t=document.getElementById("endTimestamp").value,n=document.getElementById("pairSel").value;$("#hist-data td").remove(),$("#coverScreen").show(),$.post("get-hist-data",{data:"1",pair:n,t1:e,t2:t},function(e){var t=e.split("#"),n=document.getElementById("hist-data"),d=t[0],a=0;if($("#hist-data td").remove(),$("#hist-data").show(),d>0)for(var i=0;i<d;i++){var r;tr=document.createElement("tr"),(r=document.createElement("td")).style.fontSize="16px",r.className="numeric";var l=document.createElement("td");l.style.fontSize="16px",l.className="numeric";var c=document.createElement("td");c.style.fontSize="16px",c.className="numeric";var m=document.createElement("td");m.style.fontSize="16px",m.className="numeric";var b=document.createElement("td");b.style.fontSize="16px",b.className="numeric"; t[a=5*i+1].split(" ");var o=new Date(t[a].replace(/-/g,"/"));r.appendChild(document.createTextNode(o.toLocaleDateString("en-US",{weekday:"long",year:"numeric",month:"long",day:"numeric"}))),l.appendChild(document.createTextNode(t[a+1])),c.appendChild(document.createTextNode(t[a+2])),m.appendChild(document.createTextNode(t[a+3])),b.appendChild(document.createTextNode(t[a+4])),tr.appendChild(r),tr.appendChild(l),tr.appendChild(c),tr.appendChild(m),tr.appendChild(b),n.appendChild(tr)}else tr=document.createElement("tr"),(r=document.createElement("td")).style.fontSize="16px",r.colSpan="5",r.appendChild(document.createTextNode("No Data Available")),tr.appendChild(r),n.appendChild(tr);$("#coverScreen").hide()})}
    
    //fetch(req).then(function(e){return e.json()}).then(function(e){document.getElementById("newsFeed1").innerHTML=e.articles[0].title,document.getElementById("newsFeed2").innerHTML=e.articles[1].title,document.getElementById("newsFeed3").innerHTML=e.articles[2].title,document.getElementById("newsFeed4").innerHTML=e.articles[3].title,document.getElementById("newsFeed5").innerHTML=e.articles[4].title,document.getElementById("newsFeed6").innerHTML=e.articles[5].title,document.getElementById("newsFeed7").innerHTML=e.articles[6].title,document.getElementById("newsFeed8").innerHTML=e.articles[7].title,document.getElementById("newsFeed9").innerHTML=e.articles[8].title,document.getElementById("newsFeed10").innerHTML=e.articles[9].title});
    </script>
    
    <script>
   var prevVal = 0,
    prevValEUR = 0,
    prevValGBP = 0,
    prevValAUD = 0,
    prevValCAD = 0,
    prevValNZD = 0,
    prevValAED = 0,
    prevValSGD = 0,
    prevValTHB = 0,
    newVal = 0,
    newValEUR = 0,
    newValGBP = 0,
    newValAUD = 0,
    newValCAD = 0,
    newValNZD = 0,
    newValAED = 0,
    newValSGD = 0,
    newValTHB = 0,
    rcvData = function () {
        "1" != sessionStorage.getItem("infodone") && sessionStorage.setItem("infodone", "1");
        setInterval(function () {
            0;
        }, 1e3);
        $("#coverScreen").hide(),
            $.post("get-live-rates", { data: "1" }, function (e) {
                findTomSpotBidData("1");
                findTomSpotAskData("1");
                var t = e.split("-");
                if (((usdToINRrate = 0), "0" == t[1])) document.getElementById("inrToUSD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    var o = parseFloat(t[2]).toFixed(4),
                        n = parseFloat(t[3]).toFixed(4),
                        a = 0;
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (usdToINRrate = a),
                        (document.getElementById("inrToUSDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToUSDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToUSD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        (document.getElementById("frate-1").value = parseFloat(a).toFixed(4)),
                        0 == prevVal
                            ? ((newVal = parseFloat(a).toFixed(4)), (prevVal = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevVal
                            ? ((newVal = parseFloat(a).toFixed(4)), (prevVal = parseFloat(a).toFixed(4)))
                            : ((newVal = parseFloat(a).toFixed(4)), (prevVal = newVal), (document.getElementById("inrToUSD").style.backgroundColor = "#F2D7D5")),
                        (document.getElementById("inrToUSDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[4]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToUSDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[5]).toFixed(4) + "</font>");
                }
                if ("0" == t[11]) document.getElementById("inrToEUR").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(t[12]).toFixed(4)), (n = parseFloat(t[13]).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToEURbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToEURask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToEUR").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        (document.getElementById("frate-2").value = parseFloat(a).toFixed(4)),
                        0 == prevValEUR
                            ? ((newValEUR = parseFloat(a).toFixed(4)), (prevValEUR = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValEUR
                            ? ((newValEUR = parseFloat(a).toFixed(4)), (prevValEUR = parseFloat(a).toFixed(4)))
                            : ((newValEUR = parseFloat(a).toFixed(4)), (prevValEUR = newValEUR), (document.getElementById("inrToEUR").style.backgroundColor = "#EBDEF0")),
                        (document.getElementById("inrToEURhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[14]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToEURlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[15]).toFixed(4) + "</font>");
                }
                if ("0" == t[21]) document.getElementById("inrToGBP").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(t[22]).toFixed(4)), (n = parseFloat(t[23]).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToGBPbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToGBPask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToGBP").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        (document.getElementById("frate-3").value = parseFloat(a).toFixed(4)),
                        0 == prevValGBP
                            ? ((newValGBP = parseFloat(a).toFixed(4)), (prevValGBP = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValGBP
                            ? ((newValGBP = parseFloat(a).toFixed(4)), (prevValGBP = parseFloat(a).toFixed(4)))
                            : ((newValGBP = parseFloat(a).toFixed(4)), (prevValGBP = newValGBP), (document.getElementById("inrToGBP").style.backgroundColor = "#D4E6F1")),
                        (document.getElementById("inrToGBPhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[24]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToGBPlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[25]).toFixed(4) + "</font>");
                }
                if ("0" == t[31]) document.getElementById("inrToAUD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(t[32]).toFixed(4)), (n = parseFloat(t[33]).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToAUDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToAUDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToAUD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        0 == prevValAUD
                            ? ((newValAUD = parseFloat(a).toFixed(4)), (prevValAUD = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValAUD
                            ? ((newValAUD = parseFloat(a).toFixed(4)), (prevValAUD = parseFloat(a).toFixed(4)))
                            : ((newValAUD = parseFloat(a).toFixed(4)), (prevValAUD = newValAUD), (document.getElementById("inrToAUD").style.backgroundColor = "#D1F2EB")),
                        (document.getElementById("inrToAUDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[34]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToAUDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[35]).toFixed(4) + "</font>");
                }
                if ("0" == t[41]) document.getElementById("inrToCAD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(parseFloat(t[42]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[43]).toFixed(4)).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToCADbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToCADask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToCAD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        0 == prevValCAD
                            ? ((newValCAD = parseFloat(a).toFixed(4)), (prevValCAD = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValCAD
                            ? ((newValCAD = parseFloat(a).toFixed(4)), (prevValCAD = parseFloat(a).toFixed(4)))
                            : ((newValCAD = parseFloat(a).toFixed(4)), (prevValCAD = newValCAD), (document.getElementById("inrToCAD").style.backgroundColor = "#D4EFDF")),
                        (document.getElementById("inrToCADhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[44]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToCADlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[45]).toFixed(4) + "</font>");
                }
                if ("0" == t[51]) document.getElementById("inrToNZD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(t[52]).toFixed(4)), (n = parseFloat(t[53]).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToNZDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToNZDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToNZD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        0 == prevValNZD
                            ? ((newValNZD = parseFloat(a).toFixed(4)), (prevValNZD = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValNZD
                            ? ((newValNZD = parseFloat(a).toFixed(4)), (prevValNZD = parseFloat(a).toFixed(4)))
                            : ((newValNZD = parseFloat(a).toFixed(4)), (prevValNZD = newValNZD), (document.getElementById("inrToNZD").style.backgroundColor = "#FCF3CF")),
                        (document.getElementById("inrToNZDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[54]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToNZDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[55]).toFixed(4) + "</font>");
                }
                if ("0" == t[61]) document.getElementById("inrToTHB").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(parseFloat(t[62]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[63]).toFixed(4)).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToTHBbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToTHBask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToTHB").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        0 == prevValTHB
                            ? ((newValTHB = parseFloat(a).toFixed(4)), (prevValTHB = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValTHB
                            ? ((newValTHB = parseFloat(a).toFixed(4)), (prevValTHB = parseFloat(a).toFixed(4)))
                            : ((newValTHB = parseFloat(a).toFixed(4)), (prevValTHB = newValTHB), (document.getElementById("inrToTHB").style.backgroundColor = "#FAE5D3")),
                        (document.getElementById("inrToTHBhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[64]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToTHBlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[65]).toFixed(4) + "</font>");
                }
                if ("0" == t[71]) document.getElementById("inrToAED").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(parseFloat(t[72]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[73]).toFixed(4)).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToAEDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToAEDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToAED").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        0 == prevValAED
                            ? ((newValAED = parseFloat(a).toFixed(4)), (prevValAED = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValAED
                            ? ((newValAED = parseFloat(a).toFixed(4)), (prevValAED = parseFloat(a).toFixed(4)))
                            : ((newValAED = parseFloat(a).toFixed(4)), (prevValAED = newValAED), (document.getElementById("inrToAED").style.backgroundColor = "#FAE5D3")),
                        (document.getElementById("inrToAEDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[74]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToAEDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[75]).toFixed(4) + "</font>");
                }
                if ("0" == t[81]) document.getElementById("inrToSGD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                else {
                    (o = parseFloat(parseFloat(t[82]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[83]).toFixed(4)).toFixed(4)), (a = 0);
                    (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                        (document.getElementById("inrToSGDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                        (document.getElementById("inrToSGDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                        (document.getElementById("inrToSGD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                        0 == prevValSGD
                            ? ((newValSGD = parseFloat(a).toFixed(4)), (prevValSGD = parseFloat(a).toFixed(4)))
                            : parseFloat(a).toFixed(4) == prevValSGD
                            ? ((newValSGD = parseFloat(a).toFixed(4)), (prevValSGD = parseFloat(a).toFixed(4)))
                            : ((newValSGD = parseFloat(a).toFixed(4)), (prevValSGD = newValSGD), (document.getElementById("inrToSGD").style.backgroundColor = "#FAE5D3")),
                        (document.getElementById("inrToSGDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[84]).toFixed(4) + "</font>"),
                        (document.getElementById("inrToSGDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[85]).toFixed(4) + "</font>");
                }
                setTimeout(function () {
                    (document.getElementById("inrToUSD").style.backgroundColor = "#f9f9f9"),
                        (document.getElementById("inrToEUR").style.backgroundColor = "white"),
                        (document.getElementById("inrToGBP").style.backgroundColor = "#f9f9f9"),
                        (document.getElementById("inrToAUD").style.backgroundColor = "white"),
                        (document.getElementById("inrToCAD").style.backgroundColor = "#f9f9f9"),
                        (document.getElementById("inrToNZD").style.backgroundColor = "white"),
                        (document.getElementById("inrToAED").style.backgroundColor = "#f9f9f9"),
                        (document.getElementById("inrToTHB").style.backgroundColor = "#f9f9f9"),
                        (document.getElementById("inrToSGD").style.backgroundColor = "white");
                }, 1e4);
            }),
            $("#coverScreen").hide();
    };
setInterval(function () {
    rcvData();
}, 1e3);
var f1 = 0;
function CalculateGST(e, t, o) {
    var n,
        a = e.unit_input.value,
        l = t.unit_input.value,
        r = 0;
    isNaN(a) && (a = a.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (a = a.replace(/\.+$/, "")),
        isNaN(l) && (l = l.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (l = l.replace(/\.+$/, "")),
        (n = parseFloat(a) * parseFloat(l)),
        a <= 0 || l <= 0 ? (r = 0) : n <= 1e5 ? (n <= 250 ? (r = 45) : (r = 0.01 * n * 0.18) <= 45 && (r = 45)) : (r = n > 1e5 && n <= 1e6 ? 0.18 * (1e3 + 0.005 * (n - 1e5)) : n < 555e5 ? 0.18 * (5500 + 0.001 * (n - 1e6)) : 10800),
        (e.unit_input.value = a),
        (t.unit_input.value = l),
        (o.unit_input.value = r.toFixed(2));
}
function CalculateUnit(e, t) {
    var o = e.unit_input.value;
    isNaN(o) && (o = o.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (o = o.replace(/\.+$/, ""));
    var n = 0;
    switch (t.unit_menu.value) {
        case "INR":
            n = o;
            break;
        case "USD":
            n = 1 / parseFloat(document.getElementById("inrToUSD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "EUR":
            n = 1 / parseFloat(document.getElementById("inrToEUR").getElementsByTagName("font")[0].innerHTML);
            break;
        case "GBP":
            n = 1 / parseFloat(document.getElementById("inrToGBP").getElementsByTagName("font")[0].innerHTML);
            break;
        case "AUD":
            n = 1 / parseFloat(document.getElementById("inrToAUD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "CAD":
            n = 1 / parseFloat(document.getElementById("inrToCAD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "NZD":
            n = 1 / parseFloat(document.getElementById("inrToNZD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "THB":
            n = 1 / parseFloat(document.getElementById("inrToTHB").getElementsByTagName("font")[0].innerHTML);
            break;
        case "SGD":
            n = 1 / parseFloat(document.getElementById("inrToSGD").getElementsByTagName("font")[0].innerHTML);
            break;    
        case "AED":
            n = 1 / parseFloat(document.getElementById("inrToAED").getElementsByTagName("font")[0].innerHTML);
    }
    isNaN(o) && 0 != o ? (t.unit_input.value = "") : ((e.unit_input.value = o), "INR" == t.unit_menu.value ? (t.unit_input.value = o) : (t.unit_input.value = (o * n).toFixed(2)));
}
function CalculateUnit2(e, t) {
    var o = e.unit2_input.value;
    isNaN(o) && (o = o.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (o = o.replace(/\.+$/, ""));
    var n = 0;
    switch (e.unit2_menu.value) {
        case "INR":
            n = o;
            break;
        case "USD":
            n = parseFloat(document.getElementById("inrToUSD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "EUR":
            n = parseFloat(document.getElementById("inrToEUR").getElementsByTagName("font")[0].innerHTML);
            break;
        case "GBP":
            n = parseFloat(document.getElementById("inrToGBP").getElementsByTagName("font")[0].innerHTML);
            break;
        case "AUD":
            n = parseFloat(document.getElementById("inrToAUD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "CAD":
            n = parseFloat(document.getElementById("inrToCAD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "NZD":
            n = parseFloat(document.getElementById("inrToNZD").getElementsByTagName("font")[0].innerHTML);
            break;
        case "THB":
            n = parseFloat(document.getElementById("inrToTHB").getElementsByTagName("font")[0].innerHTML);
            break;
        case "SGD":
            n = parseFloat(document.getElementById("inrToSGD").getElementsByTagName("font")[0].innerHTML);
            break;    
        case "AED":
            n = parseFloat(document.getElementById("inrToAED").getElementsByTagName("font")[0].innerHTML);
    }
    isNaN(o) && 0 != o ? (t.unit2_input.value = "") : ((e.unit2_input.value = o), "INR" == e.unit2_menu.value ? (t.unit2_input.value = o) : (t.unit2_input.value = (o * n).toFixed(2)));
}



    </script>
     
    <!-- <meta name="google-site-verification" content="BJ7SrXsVSkkq6qIuc_hFQGACiOBm5QVhm--yW_F7tG0" /> -->
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-123754068-1');
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

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" onload="rcvData();">
<!-- <div id="coverScreen" class="LockOnHome"></div> -->

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: white;">

    <!-- Main content -->
    <section class="content">
      
          <div class="row">
        
            <div class="col-md-12">
              <div style="background-color: #EAF2F8;">
                <div class="box-header" align=center>
                  <i class="fa fa-home"></i>
                  <p class="box-title" style="font-size: 22px; padding: 5px;"><b>Welcome to Learn and Spread!</b></p>
                  
                  <?php 
                  if(!isset($_SESSION['username'])){
                  ?>
                  <p><a href="https://ibrlive.com/register"><button type="button" style="margin-top:5px;" class="btn btn-warning"><i class="fa fa-user"></i>  Register now for free trial! </button></a></p>
                  <?php
                  }
                  ?>
                </div>
              </div>
              
            <!--  
            <div class="col-md-12 callout callout-success">    
              <h4>We are back!</h4>
              Due to some urgent technical maintenance, the site was down for some time. We appreciate your support. The site is up and working fine now!

            </div>
            -->            
            
            <!--
            <div class="col-md-12 callout callout-info">    
              <h4>Notification!</h4>
              Due to some urgent technical maintenance, the live rates are not available for some time. We appreciate your support.
            </div>
            -->
    
            <div class="modal fade" id="information" width=100%>
            <div class="modal-dialog modal-wide">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&#10006;</span></button>
                <h3 class="modal-title text-center"><b>Do not Panic!</b></h3>
              </div>
              <div class="modal-body">
                  <img class="img-responsive pad img-center" src="images/ei.jpg"/>
              </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        
            <div class="col-md-8" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-money"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Live Currency Rates </p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body pad table-responsive" id="no-more-tables">
                  
                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                    <thead class="cf">
                    <tr>
                      <th class="numeric"><h4><b>Quote Currency</b></h4></th>
                      <th colspan="3" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;"/><h4 style="display:inline;"> <b>INR (&#8377;)</b></h4></h4>
                      </th>
                    </tr>
                    <tr>
                      <th class="numeric"><h4><b>Base Currency</b></h4></th>
                      <th class="numeric"><h4><b>LIVE RATES <br/>(Mid Values) (&#8377;)</b></h4></th>
                      
                      <th class="numeric"><h4><b>HIGH (&#8377;)</b></h4></th>
                      <th class="numeric"><h4><b>LOW (&#8377;)</b></h4></th>
                    </tr>
                    </thead>
                    <tbody>
                       
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;"/> 1 USD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToUSD"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToUSDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToUSDlow"></td>
                    </tr>   
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;"/> 1 EUR (&#8364;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToEUR"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToEURhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToEURlow"></td>
                    </tr>  
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;"/> 1 GBP (&#163;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToGBP"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToGBPhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToGBPlow"></td>
                    </tr>                 
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;"/> 1 AUD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToAUD"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToAUDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToAUDlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;"/> 1 CAD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToCAD"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToCADhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToCADlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;"/> 1 NZD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToNZD"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToNZDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToNZDlow"></td>
                    </tr>
                    
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;"/> 1 AED (&#1583;.&#1573;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToAED"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToAEDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToAEDlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;"/> 1 SGD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToSGD"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToSGDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToSGDlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;"/> 1 THB (&#3647;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToTHB"></td>
                      
                      <td data-title="HIGH (&#8377;)" id="inrToTHBhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToTHBlow"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <h5><b>Real Time Exchange Rates ( Mid Market Values)</b><br/> 
Real Time Exchange rates (Mid Market Rates/Interbank Rates/Spot rates)- Mid Market rates are average of buy & sell transactional rates of a currency pair. <br/>These rates are just for reference purpose and not for transaction purpose.</h5>
                        </td>
                    </tr>    
                    <tbody> 
                    
                  </table>
                   
                </div><!-- /.box -->
                
              </div>
            </div><!-- /.col -->            

            <div class="col-md-4 " style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Currency Converter</p><font style="font-size: 16px;"></b> <b>(Others to INR)</b></font>
                </div>
                
                <div class="box-body" align=center>
                  <div class="converter-wrapper">
                    <!-- <p style="font-size: 20px;">Other Currencies to INR</p> -->
                    <div class="converter-side-e">
                      <form name="form_E" onSubmit="return false">
                        <input type="text" class="numbersonly" name="unit2_input" maxlength="10" value="0" onKeyUp="CalculateUnit2(document.form_E, document.form_F)" style="font-size: 16px;">
                        
                        <span>
                          <select style="text-align:center;" name="unit2_menu" onChange="CalculateUnit2(document.form_E, document.form_F)">

                            <option>USD</option>
                            <option>EUR</option>
                            <option>GBP</option>
                            <option>AUD</option>
                            <option>CAD</option>
                            <option>NZD</option>
                            <option>AED</option>
                            <option>SGD</option>
                            <option>THB</option>  
                          </select>
                        </span>    
                        
                      </form>
                    </div> <!-- /converter-side-e -->
  
                    <div class="converter-equals">
                      <p>=</p>
                    </div> <!-- /converter-side-e -->

                    <div class="converter-side-f">
                      <form name="form_F" onSubmit="return false">
                        <input type="text" class="numbersonly" name="unit2_input" maxlength="10" value="0" onkeyup="CalculateUnit(document.form_E, document.form_F)" readonly style="font-size: 16px; background-color: #e6eff3;">
                        <span>
                          <select disabled style="text-align:center;" name="unit2_menu" onChange="CalculateUnit(document.form_E, document.form_F)">                            
                            <option>INR</option>
                            <option style="display: none;">USD</option>
                            <option style="display: none;">EUR</option>
                            <option style="display: none;">GBP</option>
                            <option style="display: none;">AUD</option>
                            <option style="display: none;">CAD</option>
                            <option style="display: none;">NZD</option>
                            <option style="display: none;">AED</option>
                            <option style="display: none;">SGD</option>
                            <option style="display: none;">THB</option>                              
                          </select>
                        </span>
                      </form>
                    </div> <!-- /converter-side-f -->
                  </div><!-- /converter-wrapper -->                                
                </div>
              </div>
            </div>
            
            <div class="col-md-4 " style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Currency Converter</p><font style="font-size: 16px;"></b> <b>(INR to Others)</b></font>
                </div>
                
                <div class="box-body" align=center>
                  <div class="converter-wrapper">
                    <!-- <p style="font-size: 20px;">INR to Other Currencies</p> -->
                    <div class="converter-side-a">
                      <form name="form_A" onSubmit="return false">
                        <input type="text" class="numbersonly" name="unit_input" maxlength="10" value="0" onKeyUp="CalculateUnit(document.form_A, document.form_B)" style="font-size: 16px;">
                        
                        <span>
                          <select disabled style="text-align:center;" name="unit_menu" onChange="CalculateUnit(document.form_A, document.form_B)">
                            <option>INR</option>
                            <option style="display: none;">USD</option>
                            <option style="display: none;">EUR</option>
                            <option style="display: none;">GBP</option>
                            <option style="display: none;">AUD</option>
                            <option style="display: none;">CAD</option>
                            <option style="display: none;">NZD</option>
                            <option style="display: none;">AED</option>
                            <option style="display: none;">SGD</option>
                            <option style="display: none;">THB</option>  
                          </select>
                        </span>    
                        
                      </form>
                    </div> <!-- /converter-side-a -->
  
                    <div class="converter-equals">
                      <p>=</p>
                    </div> <!-- /converter-side-a -->

                    <div class="converter-side-b">
                      <form name="form_B" onSubmit="return false">
                        <input type="text" class="numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateUnit(document.form_A, document.form_B)" readonly style="font-size: 16px; background-color: #e6eff3;">
                        <span>
                          <select style="text-align:center;" name="unit_menu" onChange="CalculateUnit(document.form_A, document.form_B)">                            
                            <option>USD</option>
                            <option>EUR</option>
                            <option>GBP</option>
                            <option>AUD</option>
                            <option>CAD</option>
                            <option>NZD</option>
                            <option>AED</option>
                            <option>SGD</option>
                            <option>THB</option>                              
                          </select>
                        </span>
                      </form>
                    </div> <!-- /converter-side-b -->
                  </div><!-- /converter-wrapper -->                                
                </div>
              </div>
            </div>
        
            <div class="col-md-4 " style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>GST on Currency Conversion</b>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-question-circle"> Help</i></button></p>
                </div>
                
                <div class="box-body" align=center>
                    <div class="converter-wrapper">
                        
                        <table class="table table-bordered text-center table-bordered table-striped table-condensed cf">

                            <tbody>
                                <tr>
                                    <td class="">
                                        <h4><b>Amount (Foreign Currency)</b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <form name="form_I" onSubmit="return false">
                                            <input value=0 type="text" class="numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateGST(document.form_I, document.form_J, document.form_K)" style="font-size: 16px; background-color: #fff;">
                                        </form>
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Rate (INR)</b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <form name="form_J" onSubmit="return false">
                                            <input value=0 type="text" class="numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateGST(document.form_I, document.form_J, document.form_K)" style="font-size: 16px; background-color: #fff;">
                                        </form>
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td class="">
                                        <h4><b>GST Payable (INR)</b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <form name="form_K" onSubmit="return false">
                                            <input value=0 type="text" class="numbersonly" name="unit_input"  readonly style="font-size: 16px; background-color: #e6eff3;">
                                        </form>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>  
                    </div>
                </div>
              </div>
            </div>
    
                
            <?php
                $row_date = strtotime('31-01-2021');
                $today = strtotime(date('Y-m-d'));

                if($row_date >= $today){
            ?>
             <div class="col-md-12 text-center" style="margin-top: 10px;">
                <a href="https://ibrlive.com/foreign-exchange-test"><img class="img-responsive img-center" src="images/ads/ad-01.png"/></a>
            </div>
            <?php
            }
            ?>
    <?php
        if($allowFC!="YES"){
    ?>
    <div class="col-md-12" style="margin-top: 10px;">
        <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="box-header" align=center>
            
            <p class="box-title" style="font-size: 22px;"><i class="fa fa-bullseye"></i> <b>FXPRESS by IBRLive <a href="https://ibrlive.com/register"><font style="color: green;">(Register now to start 10 Days Free Trial!)</font></a></b></p>
            </div>    
            
        <div class="box-body" align=center>    
            
            <div class="col col-lg-4 text-center" style="background: #fff; ">
                <div class="h-100 p-2 rounded-3 position-relative"><iframe style="width:100%; height: 100%;" src="https://www.youtube.com/embed/7YRYQRNNtMg?rel=0" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            </div>
         
            <div class="col col-lg-8 text-center"  style="margin-bottom: 10px;">
                <h4 class="bg-danger" style="padding: 5px;"><i>Exporter or Importer?</i></h4>
                <h4 class="bg-info" style="padding: 5px;"><i>Paying Heavy Exchange Margin on currency conversion?</i></h4>
                <h4 class="bg-success" style="padding: 5px;"><i>
                If Yes, then you are at right place to put hold on your increasing financial cost</i></h4>
                <hr>        
                
                <a href="fxpress"><button type="button" style="margin-top:5px;" class="btn btn-success"><i class="fa fa-info-circle"></i>  Click for more information! </button></a>
                
                <a href="our-products" style="margin-top:5px;"><button type="button" style="margin-top:5px;" class="btn btn-warning"> <i class="fa fa-angle-double-right"></i> Subscribe to FXPRESS Now! </button></a>
            </div>
        </div>
        </div>
    </div>     
    <?php
    }
    ?>
    
    <?php
        if($allowFC!="YES"){
    ?>
    <div class="col-md-12" style="display: none; margin-top: 10px;"> <!-- Tom-spot -->

      <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="box-header with-border" align=center>
          
        <i class="fa fa-money"></i>
        <p class="box-title" style="font-size: 22px;"><b>Cash Tom Spot Rate</p><font style="font-size: 16px;"></b></font>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Currency Pair (Bid)</label>
                <select id="pairSelTomBid" class="form-control select2" style="width: 100%;">
                  
                  <option value="1">USD/INR</option>
                  <!-- <option value="2">EUR/INR</option>
                  <option value="3">GBP/INR</option> -->
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Spot Rate</label>
                <input value=0 type="text" class="form-control" name="tspotRateBid" id="tspotRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control" name="tcashSpotBid" id="tcashSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control" name="tcashRateBid" id="tcashRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control" name="ttomSpotBid" id="ttomSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control" name="ttomRateBid" id="ttomRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
          <hr>
          
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Currency Pair (Ask)</label>
                <select id="pairSelTomAsk" class="form-control select2" style="width: 100%;">
                    
                  <option value="1">USD/INR</option>
                  <!-- <option value="2">EUR/INR</option>
                  <option value="3">GBP/INR</option> -->
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Spot Rate</label>
                <input value=0 type="text" class="form-control" name="tspotRateAsk" id="tspotRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control" name="tcashSpotAsk" id="tcashSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control" name="tcashRateAsk" id="tcashRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control" name="ttomSpotAsk" id="ttomSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control" name="ttomRateAsk" id="ttomRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
 
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
      
      </div> <!-- /.tom-spot --> 
      <?php
      } else{
      ?>
            <div class="col-md-12" style="margin-top: 10px;"> <!-- Tom-spot -->

      <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="box-header with-border" align=center>
          
        <i class="fa fa-money"></i>
        <p class="box-title" style="font-size: 22px;"><b>Cash Tom Spot Rate</p><font style="font-size: 16px;"></b></font>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Currency Pair (Bid)</label>
                <select id="pairSelTomBid" class="form-control select2" style="width: 100%;">
                  
                  <option value="1">USD/INR</option>
                  <!-- <option value="2">EUR/INR</option>
                  <option value="3">GBP/INR</option> -->
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Spot Rate</label>
                <input value=0 type="text" class="form-control" name="tspotRateBid" id="tspotRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control" name="tcashSpotBid" id="tcashSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control" name="tcashRateBid" id="tcashRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control" name="ttomSpotBid" id="ttomSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control" name="ttomRateBid" id="ttomRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
          <hr>
          
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Currency Pair (Ask)</label>
                <select id="pairSelTomAsk" class="form-control select2" style="width: 100%;">
                    
                  <option value="1">USD/INR</option>
                  <!-- <option value="2">EUR/INR</option>
                  <option value="3">GBP/INR</option> -->
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Spot Rate</label>
                <input value=0 type="text" class="form-control" name="tspotRateAsk" id="tspotRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control" name="tcashSpotAsk" id="tcashSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control" name="tcashRateAsk" id="tcashRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control" name="ttomSpotAsk" id="ttomSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control" name="ttomRateAsk" id="ttomRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
 
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
      
      </div> <!-- /.tom-spot --> 

      <?php
      }
      ?>
            
            <?php
                if($allowFC!="YES"){
            ?>
            <div class="col-md-4 " style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                <div class="box-body pad table-responsive" id="no-more-tables2" style="display: none;">
                  
                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed" id="t-bid-ask">
                    <thead class="cf">
                    <tr>
                      <th class="numeric"><h4><b>Quote Currency</b></h4></th>
                      <th colspan="2" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;"/><h4 style="display:inline;"><b> INR (&#8377;)</b></h4></h4>
                      </th>
                    </tr>
                    <tr>
                      <th class="numeric"><h4><b>Base Currency</b></h4></th>
                      <th class="numeric"><h4><b>BID (&#8377;)</b> (to be referred by Exporters/Sellers) </h4></th>
                      
                      <th class="numeric"><h4><b>ASK (&#8377;)</b> (to be referred by Importers/Buyers) </h4></th>
                    </tr>
                    </thead>
                    <tbody>
                       
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;"/> 1 USD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToUSDask"></td>
                    </tr>   
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;"/> 1 EUR (&#8364;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToEURbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToEURask"></td>
                    </tr>  
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;"/> 1 GBP (&#163;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToGBPbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToGBPask"></td>
                    </tr>                 
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;"/> 1 AUD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToAUDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToAUDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;"/> 1 CAD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToCADbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToCADask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;"/> 1 NZD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToNZDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToNZDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;"/> 1 AED (&#1583;.&#1573;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToAEDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToAEDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;"/> 1 SGD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToSGDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToSGDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;"/> 1 THB (&#3647;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToTHBbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToTHBask"></td>
                    </tr>
                    <tbody> 
                    
                  </table>
                   
                </div><!-- /.box -->
                
              </div>
            </div><!-- /.col -->
            <?php
            }else{    
            ?>
            
            <div class="col-md-8 " style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-money"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Live Currency Rates &ndash; Bid and Ask</p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body pad table-responsive" id="no-more-tables2">
                  
                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed" id="t-bid-ask">
                    <thead class="cf">
                    <tr>
                      <th class="numeric"><h4><b>Quote Currency</b></h4></th>
                      <th colspan="2" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;"/><h4 style="display:inline;"><b> INR (&#8377;)</b></h4></h4>
                      </th>
                    </tr>
                    <tr>
                      <th class="numeric"><h4><b>Base Currency</b></h4></th>
                      <th class="numeric"><h4><b>BID (&#8377;)</b> (to be referred by Exporters/Sellers) </h4></th>
                      
                      <th class="numeric"><h4><b>ASK (&#8377;)</b> (to be referred by Importers/Buyers) </h4></th>
                    </tr>
                    </thead>
                    <tbody>
                       
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;"/> 1 USD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToUSDask"></td>
                    </tr>   
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;"/> 1 EUR (&#8364;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToEURbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToEURask"></td>
                    </tr>  
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;"/> 1 GBP (&#163;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToGBPbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToGBPask"></td>
                    </tr>                 
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;"/> 1 AUD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToAUDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToAUDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;"/> 1 CAD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToCADbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToCADask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;"/> 1 NZD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToNZDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToNZDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;"/> 1 AED (&#1583;.&#1573;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToAEDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToAEDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;"/> 1 SGD (&#36;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToSGDbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToSGDask"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;"/> 1 THB (&#3647;)</b></h4></td>
                      <td data-title="BID (&#8377;)" id="inrToTHBbid"></td>
                      
                      <td data-title="ASK (&#8377;)" id="inrToTHBask"></td>
                    </tr>
                    <tbody> 
                    
                  </table>
                   
                </div><!-- /.box -->
                
              </div>
            </div><!-- /.col -->
            <?php
            }
            ?>
            
            <?php
            if($allowFC!="YES"){
            ?>
          
            

            <?php
            }else{
            #if(isset($_SESSION['sessCustomerID'])){
            #  if($_SESSION['sessCustomerID'] == "7"){
            ?>
            <div class="col-md-4" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Export/Sell Forward Contract</b>
                  </p>
                </div>
                
                <div class="box-body" align=center>
                    <div id="d2b" class="converter-wrapper">
                        <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" id="tfwdbid">

                            <tbody>
                                <tr>
                                    <td class="">
                                        <h4><b>Currency Pair</b></h4>
                                    </td>
                                    
                                    <td class="" style="text-align: center;">
                                        <b>
                                        <select onchange="CalSpotFwdBidSample(document.form_EFD);" id="pairSelExp" class="form-control select2" style="font-size: 16px; text-align-last: center; width: 100%;">
                                        <option selected="selected" value="1"><b>USD/INR</b></option>
                                        <option value="2"><b>EUR/INR</b></option>
                                        <option value="3"><b>GBP/INR</b></option>
                                        </select>
                                        </b>
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Select Date</b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <form name="form_EFD" onSubmit="return false">
                                            <input readonly placeholder="Select Date" required="required" type="text" name="dateExp" id="dateExp" onchange="CalSpotFwdBidSample(document.form_EFD);" style="cursor: pointer; font-size: 16px; background-color: #fff;">
                                        </form>
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Premium</b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <input value=0 type="text" class="" name="fwdPremBid" id="fwdPremBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Forward Rate (INR)</b></h4>
                                    </td>

                                    <td class="">
                                        <form name="form_EFR" onSubmit="return false">
                                            <input value=0 type="text" class="" name="fwdExp" id="fwdExp" readonly style="font-size: 16px; background-color: #e6eff3;">
                                        </form>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>  
                    </div>
                </div>
              </div>
            </div>            
            
            <div class="col-md-4" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Import/Buy Forward Contract</b>
                  </p>
                </div>
                
                <div class="box-body" align=center>
                    <div id="d2c" class="converter-wrapper">
                        <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" id="tfwdask">

                            <tbody>
                                <tr>
                                    <td class="">
                                        <h4><b>Currency Pair</b></h4>
                                    </td>
                                    
                                    <td class="" style="text-align: center;">
                                        <b>
                                        <select onchange="CalSpotFwdAskSample(document.form_IFD);" id="pairSelImp" class="form-control select2" style="font-size: 16px; text-align-last: center; width: 100%;">
                                        <option selected="selected" value="1"><b>USD/INR</b></option>
                                        <option value="2"><b>EUR/INR</b></option>
                                        <option value="3"><b>GBP/INR</b></option>
                                        </select>
                                        </b>
                                    
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Select Date</b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <form name="form_IFD" onSubmit="return false">
                                            <input readonly placeholder="Select Date" required="required" type="text" name="dateImp" id="dateImp" onchange="CalSpotFwdAskSample(document.form_IFD);" style="cursor: pointer; font-size: 16px; background-color: #fff;">
                                        </form>
                                    </td>
                                </tr> 
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Premium </b></h4>
                                    </td>
                                    
                                    <td class="">
                                        <input value=0 type="text" class="" name="fwdPremAsk" id="fwdPremAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="">
                                        <h4><b>Forward Rate (INR)</b></h4>
                                    </td>

                                    <td class="">
                                        <form name="form_IFR" onSubmit="return false">
                                            <input value=0 type="text" class="" name="fwdImp" id="fwdImp" readonly style="font-size: 16px; background-color: #e6eff3;">
                                        </form>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>  
                    </div>
                </div>
              </div>
            </div>
            <?php
              #}
            #}
            }
            ?>
            
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><b>GST on Currency Conversion</b></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered text-center table-bordered table-striped table-condensed cf">
                                <thead>
                                    <tr>
                                        <th>Transaction Amount</th>
                                        <th>Value on Service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Less than or equal to &#8377; 1,00,000</td>
                                        <td>1% of the transaction amount, subject to minimum of &#8377; 250/- ( minimum GST payable = &#8377; 45)</td>
                                    </tr>
                                    <tr>
                                        <td>Greater than &#8377; 1,00,000 and less than or equal to &#8377; 10,00,000</td>
                                        <td>&#8377; 1000 + 0.5% of the transaction amount</td>
                                    </tr>
                                    <tr>
                                        <td>Greater than &#8377; 10,00,000</td>
                                        <td>&#8377; 5,500 + 0.1% of the transaction amount, subject to maximum of &#8377; 60,000/-. (Maximum GST payable = &#8377; 10,800/-)</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><b>* GST: 18% of Value on Service</b></td>
                                    </tr>
                                </tbody>    
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
            </div>
            
            <?php 
            if(0){
            ?>
            <div class="col-md-6">
              <div class="box box-solid"  style="text-align: center;">
                
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                    </ol>
                    <div class="carousel-inner" align=center>
                      <div class="item active">
                        <img src="images/slide01.png" alt="First slide">
                        <div class="carousel-caption">
                          <!-- First Slide -->
                        </div>
                      </div>
                      <div class="item">
                        <img src="images/slide02.png" alt="Second slide">
                        <div class="carousel-caption">
                          <!-- Second Slide -->
                        </div>
                      </div>
                      <div class="item">
                        <img src="images/slide03.png" alt="Third slide">
                        <div class="carousel-caption">
                          <!-- Third Slide -->
                        </div>
                      </div>
                      <div class="item">
                        <img src="images/slide04.png" alt="Fourth slide">
                        <div class="carousel-caption">
                          <!-- Fourth Slide -->
                        </div>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col --> 
            <?php
            }
            ?>
            
    <div class="col-md-12" style="margin-top: 10px;">

      <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

        <!-- /.box-header -->
        
        <?php
        if($allowFC!="YES"){
        ?>
       
        <div style="display: none;" class="box-body table-responsive">
         <table id="forecast" class="table table-bordered text-center table-bordered table-condensed cf" style="border-color: #D5D8DC;" border=1 >
          <thead style="background-color: #EAEDED;">
              <?php 
                $servername = "localhost";
                $username = "ibrlive";
                $password = "tubelight";
                $dbname = "ibrMock";

                //Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }   
                $query = "SELECT pair, rate, c1, c2, c3, c4, updatedOn FROM forecasthead WHERE id=1";

                $result = $conn->query($query);
              ?>    
            
                <?php
                
                while($r2 = $result->fetch_assoc()){ 
                
                ?> 
            <tr>
                <th class="numeric" colspan=6>Updated on: <font style="color: blue;"><?php echo $r2['updatedOn'] ?> </font></th>
            </tr>        
            <tr>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['pair'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['rate'] ?> </b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c1'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c2'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c3'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c4'] ?></b></h4></th>
            </tr>
                <?php } ?>
                
          </thead>
          <tbody>
              <?php 
              $query = "SELECT pair, rate, c1, c2, c3, c4 FROM forecast";

                $result = $conn->query($query);
                $cforecast = 0;
                while($r3 = $result->fetch_assoc()){ 
                $cforecast++;
                ?> 
            <tr>
                <td class="numeric"><?php echo $r3['pair'] ?></td>
                <?php echo "<td class='numeric'><b><input class='no-border' id='frate-". $cforecast."' name='frate-". $cforecast."' readonly style='text-align: center;'></b></td>"; ?>
                <td class="numeric"><?php echo $r3['c1'] ?></td>
                <td class="numeric"><?php echo $r3['c2'] ?></td>
                <td class="numeric"><?php echo $r3['c3'] ?></td>
                <td class="numeric"><?php echo $r3['c4'] ?></td>
            </tr>
                <?php
                }
                $conn->close();
                ?>
             
          </tbody>             
        </table>
        <p><b>Disclaimer:</b> Currency forecasts are based on technical and fundamental analysis and taken from some trusted sources. IBR Live does not make its on forecasts. Forecasts may change frequently based on present facts and future events and may differ from actual prices. One should not fully rely on the above forecasts while making any financial decision. IBR live takes no responsibility on making any financial decisions based on the above forecasts.</p>
        </div>
        <?php
        } else {
        ?>
        <div class="box-header with-border" align=center>
          
        <i class="fa fa-line-chart"></i>
        <p class="box-title" style="font-size: 22px;"><b>Currency Forecasts </p><font style="font-size: 16px;"></b></font>
        </div>
        <div class="box-body table-responsive">
         <table id="forecast" class="table table-bordered text-center table-bordered table-condensed cf" style="border-color: #D5D8DC;" border=1 >
          <thead style="background-color: #EAEDED;">
              <?php 
                $servername = "localhost";
                $username = "ibrlive";
                $password = "tubelight";
                $dbname = "ibrMock";

                //Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }   
                $query = "SELECT pair, rate, c1, c2, c3, c4, updatedOn FROM forecasthead WHERE id=1";

                $result = $conn->query($query);
              ?>    
            
                <?php
                
                while($r2 = $result->fetch_assoc()){ 
                
                ?> 
            <tr>
                <th class="numeric" colspan=6>Updated on: <font style="color: blue;"><?php echo $r2['updatedOn'] ?> </font></th>
            </tr>        
            <tr>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['pair'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['rate'] ?> </b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c1'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c2'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c3'] ?></b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b><?php echo $r2['c4'] ?></b></h4></th>
            </tr>
                <?php } ?>
                
          </thead>
          <tbody>
              <?php 
              $query = "SELECT pair, rate, c1, c2, c3, c4 FROM forecast";

                $result = $conn->query($query);
                $cforecast = 0;
                while($r3 = $result->fetch_assoc()){ 
                $cforecast++;
                ?> 
            <tr>
                <td class="numeric"><?php echo $r3['pair'] ?></td>
                <?php echo "<td class='numeric'><b><input class='no-border' id='frate-". $cforecast."' name='frate-". $cforecast."' readonly style='text-align: center;'></b></td>"; ?>
                <td class="numeric"><?php echo $r3['c1'] ?></td>
                <td class="numeric"><?php echo $r3['c2'] ?></td>
                <td class="numeric"><?php echo $r3['c3'] ?></td>
                <td class="numeric"><?php echo $r3['c4'] ?></td>
            </tr>
                <?php
                }
                $conn->close();
                ?>
             
          </tbody>             
        </table>
        <p><b>Disclaimer:</b> Currency forecasts are based on technical and fundamental analysis and taken from some trusted sources. IBR Live does not make its on forecasts. Forecasts may change frequently based on present facts and future events and may differ from actual prices. One should not fully rely on the above forecasts while making any financial decision. IBR live takes no responsibility on making any financial decisions based on the above forecasts.</p>
        </div>
        <?php
        }
        ?>    
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
      
      </div> 

            <?php
            #if(isset($_SESSION['sessCustomerID'])){
            #  if($_SESSION['sessCustomerID'] == "7"){
            ?>
            
                
        
    <div class="col-md-12" style="margin-top: 10px;">

      <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

        <!-- /.box-header -->
        
        <?php 
        if($allowFC!="YES")
        {?>

        <div class="box-body" style="display: none;">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Select Pair</label>
                <select id="pairSel" class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="1">USD/INR</option>
                  <option value="2">EUR/INR</option>
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label>Select Date Range</label>
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
                <input id="startTimestamp" style="display: none;"/>
                <input id="endTimestamp" style="display: none;"/>
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Submit Query</label>
                <button class="form-control btn btn-primary" onclick="findHistData()">Submit</button>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
        <table id="hist-data" class="table text-center table-condensed" style="table-layout: fixed; border-color: #D5D8DC; display: none;" border=1 >
          <thead class="cf" style="background-color: #EAEDED;">
            <tr>
                <th class="numeric" style="color: #21618C"><h4><b>Date</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>Open (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>High (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>Low (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>Close (&#8377;)</b></h4></th> 
            </tr>
          </thead>
               
        </table>
 
        </div>
        <!-- /.box-body -->
        <?php
        } else {
        ?>
        <div class="box-header with-border" align=center>
        <i class="fa fa-money"></i>
        <p class="box-title" style="font-size: 22px;"><b>Historical Data </p><font style="font-size: 16px;"></b></font>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Select Pair</label>
                <select id="pairSel" class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="1">USD/INR</option>
                  <option value="2">EUR/INR</option>
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label>Select Date Range</label>
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
                <input id="startTimestamp" style="display: none;"/>
                <input id="endTimestamp" style="display: none;"/>
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Submit Query</label>
                <button class="form-control btn btn-primary" onclick="findHistData()">Submit</button>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
        <table id="hist-data" class="table text-center table-condensed" style="table-layout: fixed; border-color: #D5D8DC; display: none;" border=1 >
          <thead class="cf" style="background-color: #EAEDED;">
            <tr>
                <th class="numeric" style="color: #21618C"><h4><b>Date</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>Open (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>High (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>Low (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>Close (&#8377;)</b></h4></th> 
            </tr>
          </thead>
               
        </table>
 
        </div>
        <!-- /.box-body -->
        <?php
        }
        ?>
      </div>
      <!-- /.box -->

 
      
      </div> 

    
            <?php    
              #}
            #}
            ?>
            <!-- 
            <div class="col-md-6" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-file"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Mutual Fund Distributors Certification - Mock Test</p><font style="font-size: 16px;"></b><hr/></font>
                </div>
                <div class="box-body" align=center>  


            <div class="col-md-6" style="text-align: center;">
              
              <div class="small-box bg-orange">
                <div class="inner">
                  <h3>5 Free Tests</h3>
                  <p style="font-size: 25px;"></p>
                </div>
                <div class="inner" style="background-color: white;">
                  <h3><a href="mutual-fund-test"><img style="height: 130px;" src="images/mutual-funds.png"/></a></h3>
                  <p></p>
                </div>                
                
              </div>
            </div>

                
            <div class="col-md-6" style="text-align: center;">
              
              <div class="small-box bg-orange">
                <div class="inner">
                  
                  <p style="font-size: 25px;"></p>
                </div>
                <div class="inner" style="background-color: #fcf3cf; color: #7d6608;">
                  <p style="font-size: 18px;">Looking to pass <strong>Mutual Fund Distributors Certification</strong> Examination? <br/> Join our Mock test series starting from <strong>&#8377; 99/-</strong> Only</p>
                </div>                
                <a href="mutual-fund" class="small-box-footer" style="font-size: 25px;">More Information <i class="fa fa-info-circle"></i></a>
              </div>
            </div>

                       
                </div>
              </div>
            </div> -->

            <!--
            <div class="col-md-6" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">             
                <div class="box-header" align=center>
                  <i class="fa fa-file"></i>
                  <p class="box-title" style="font-size: 22px;"><b>IIBF's Certificate Course in Foreign Exchange - Mock Test</p><font style="font-size: 16px;"></b><hr/></font>
                </div>
                <div class="box-body" align=center>        

            <div class="col-md-6" style="text-align: center;">
            
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>5 Free Tests</h3>
                  <p style="font-size: 25px;"></p>
                </div>
                <div class="inner" style="background-color: white;">
                  <h3><a href="foreign-exchange-test"><img style="height: 130px;" src="images/foreign-exchange.jpg"/></a></h3>
                  <p></p>
                </div>         
              </div>
            </div>
            
            <div class="col-md-6" style="text-align: center;">
          
              <div class="small-box bg-red">
                <div class="inner">
                  
                  <p style="font-size: 25px;"></p>
                </div>
                <div class="inner" style="background-color:  #f6ddcc; color:  #6e2c00;">
                  <p style="font-size: 18px;">Looking to pass <strong>Certificate Course in Foreign Exchange</strong> Examination? <br/> Join our Mock test series starting from <strong>&#8377; 495/-</strong> Only</p>
                </div>                
                <a href="foreign-exchange" class="small-box-footer" style="font-size: 25px;">More Information <i class="fa fa-info-circle"></i></a>
              </div>
            </div>

          
                </div>
              </div>
            </div> 
            -->
            <!--
            <div class="col-md-12">
              <div class="box box-primary">             
                <div class="box-header" align=center>
                  <i class="fa fa-newspaper-o"></i>
                  <p class="box-title" style="font-size: 22px;"><b>News Headlines</p><font style="font-size: 16px;"></b><hr/></font>
                </div>
                <div class="box-body" align=center>            
                    <div class="col-md-12" style="text-align: left;">
                      <ul style="line-height:250%; text-decoration: underline; text-decoration-color: #F8F8F8; text-underline-position: under;">
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed1" name="newsFeed1">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed2" name="newsFeed2">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed3" name="newsFeed3">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed4" name="newsFeed4">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed5" name="newsFeed5">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed6" name="newsFeed6">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed7" name="newsFeed7">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed8" name="newsFeed8">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed9" name="newsFeed9">
                        </li>
                        
                        <li style="color: #3c8dbc; font-size: 18px;" id="newsFeed10" name="newsFeed10">
                        </li>
                      </ul>
                      
                      <div style="text-align: center;">
                      <a href="https://www.ibrlive.com/news"><button class="btn btn-primary">Click here to read news in detail</button></a>
                      </div>
                      
                      <hr/>
                      <p style="font-size: 13px;"><b>*Disclaimer:</b> <i> This news-feed is from third party. The linked sites are not under our control and we are not responsible for the contents of any linked site or any link contained in a linked site, or any changes or updates to such sites. We are providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by us of the site.</i></p>
                    </div>
                </div>
              </div>
            </div>
            -->    
          <div class="col-md-12" style="margin-top: 10px; background-color: #EBF5FB;">
            <div class="box-header" align=center>
            
            <p class="box-title" style="font-size: 22px; margin-bottom: 10px; margin-top: 10px;"><i class="fa fa-newspaper-o  "></i> <b>Latest blogs </b></p>
            </div>
            
            <div class="col-md-4">
                <a href="https://ibrlive.com/blogs/usd-to-inr-exchange-rate-by-settlement-date">
                <div class="card card-default" style="height: 400px;">
                    <div class="card-body">
                        <div class="card-left" style="margin-bottom: 10px;">
                            <img src="https://ibrlive.com/images/blogs/inr-usd.png" class="img-responsive">
                        </div>
                        <div class="card-right">
                            <h4 style="color: black;"><strong>How understanding of USD to INR CASH, TOM, SPOT & FORWARD rates can benefit an Exporter or Importer?</strong></h4>
                            <p style="color: black;">When it comes to USD to INR exchange, there are four types of exchange rates differentiated by settlement date. With an understanding of these rates, you can save a lot of money & hedge your currency exposure.</p>
      
                            <div style="margin-top: 10px;">
                            <a href="https://ibrlive.com/blogs/usd-to-inr-exchange-rate-by-settlement-date">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>  
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="https://ibrlive.com/blogs/currency-forward-contract-definition-booking-cancellation">
                <div class="card card-default" style="height: 400px;">
                    <div class="card-body">
                        <div class="card-left" style="margin-bottom: 10px;">
                            <img src="https://ibrlive.com/images/blogs/fwd-cnt.png" class="img-responsive">
                        </div>
                        <div class="card-right">
                            <h4 style="color: black;"><strong>Currency Forward Contract</strong></h4>
                            <p style="color: black;">What Is a Currency Forward Contract? A currency forward contract can be defined as buying or selling a specific currency at a specified future price for delivery on a specified future date.</p>
      
                            <div style="margin-top: 10px;">
                            <a href="https://ibrlive.com/blogs/currency-forward-contract-definition-booking-cancellation">Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>  
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            <div class="col-md-4">
                <a href="https://ibrlive.com/blogs/powerful-strategies-booking-currency-forward-contract-for-exporters" >
                <div class="card card-default" style="height: 400px;">
                    <div class="card-body">
                        <div class="card-left" style="margin-bottom: 10px;">
                            <img src="https://ibrlive.com/images/blogs/10-points.png" class="img-responsive">
                        </div>
                        <div class="card-right">
                            <h4 style="color: black;"><strong>10 Powerful Strategies of Booking Currency Forward Contract For Exporters</strong></h4>
                            <p style="color: black;">Booking a currency forward contract hedge your adverse currency movement risk, but by adopting the following strategies, you may earn good profits out of it.</p>
      
                            <div style="margin-top: 10px;">
                            <a href="https://ibrlive.com/blogs/powerful-strategies-booking-currency-forward-contract-for-exporters" >Continue Reading <i class="fa fa-angle-double-right"></i></a>
                            </div>  
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            <div class="col-md-12" align=center>
                <a href="https://ibrlive.com/blogs"><button type="button" style="margin-top:5px; margin-bottom:30px;" class="btn btn-warning"> Click to read more blogs <i class="fa fa-angle-double-right"></i></button></a>
            </div>
            

        </div>
        
        <div class="col-md-12" style="margin-top: 20px;">

            <div class="box-header" align=center>
            
            <p class="box-title" style="font-size: 22px;"><i class="fa fa-users  "></i> <b>What our clients say! </b></p>
            </div>    
            
        <div class="box-body">    
        
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="row">
          <div class="col-xs-12">
            <div class="thumbnail adjust1">
              <div class="col-md-2 col-sm-2 col-xs-12">
                <img class="media-object img-rounded img-responsive" src="images/vi.png">
              </div>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="caption">
                  <p class="text-info lead adjust2">It is a great experience doing transaction with the help of <a href="https://ibrlive.com">IBRLive.com</a>.</p>
                  <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> In just one small transaction, I could manage to save money equivalent to 6 years of your website subscription fees. <br/> Thanks a lot for all the help and support during my first transaction and in negotiating with my bank</p>
                  <blockquote class="adjust2">
                    <p>Animesh Kumar, Virtue International</p> <small><cite title="Virtue International"><i class="glyphicon glyphicon-globe"></i> http://www.virtueinternational.co.in/</cite></small>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="item">
        <div class="row">
          <div class="col-xs-12">
            <div class="thumbnail adjust1">
              <div class="col-md-2 col-sm-2 col-xs-12">
                <img class="media-object img-rounded img-responsive" src="images/Javi-home-logo.png">
              </div>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="caption">
                  <p class="text-info lead adjust2"></p>
                  <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> We are using the facility since almost last one year. The rates quoted are genuine and matches with the rates offered by various banks. Due to the support we are able to hedge our forex exposures.</p>
                  <blockquote class="adjust2">
                    <p>Sahil Sharma, Javi Home Pvt. Ltd. </p> <small><cite title="Javi Home"><i class="glyphicon glyphicon-globe"></i> https://www.javihome.com/</cite></small>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- 
      <div class="item">
        <div class="row">
          <div class="col-xs-12">
            <div class="thumbnail adjust1">
              <div class="col-md-2 col-sm-2 col-xs-12">
                <img class="media-object img-rounded img-responsive" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
              </div>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="caption">
                  <p class="text-info lead adjust2">I can't wait to test this out.</p>
                  <p><span class="glyphicon glyphicon-thumbs-up"></span>.This is a testimonial window. Feedback of user can be displayed here.</p>
                  <blockquote class="adjust2">
                    <p>Client - 2</p> <small><cite title="Source Title"><i class="glyphicon glyphicon-globe"></i> www.example2.com</cite></small>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="item">
        <div class="row">
          <div class="col-xs-12">
            <div class="thumbnail adjust1">
              <div class="col-md-2 col-sm-2 col-xs-12">
                <img class="media-object img-rounded img-responsive" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
              </div>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="caption">
                  <p class="text-info lead adjust2">I can't wait to test this out.</p>
                  <p><span class="glyphicon glyphicon-thumbs-up"></span>.This is a testimonial window. Feedback of user can be displayed here.</p>
                  <blockquote class="adjust2">
                    <p>Client - 3</p> <small><cite title="Source Title"><i class="glyphicon glyphicon-globe"></i> www.example3.com</cite></small>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      -->
      
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev" style="width: 30px"> <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"style="width: 30px"> <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>
    </div>
      </div>
        </div>

    </section>
  </div>  

    
  <?php include_once("include/footer.php"); ?>
</div>
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
<!-- <script src="dist/js/demo.js"></script> -->
  <script src="bower_components/jquery-ui/jquery-ui.js"></script>
<script>

var holidayArr = <?php echo json_encode($listHoliday); ?>;
var holidayArr_=[];
for( var key in holidayArr ) {
    holidayArr_.push(key);
}
    
function DisableDates(date) {
    var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    return [holidayArr_.indexOf(string) == -1];
}


$(function() {
     var minD = <?php echo json_encode($minDay); ?>;
     var maxD = <?php echo json_encode($maxDay); ?>;
     
     $("#dateImp").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy',
         minDate: minD,
         maxDate: maxD,
         ignoreReadonly: true,
         beforeShowDay: DisableDates
     });
     
     $("#dateExp").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy',
         minDate: minD,
         maxDate: maxD,
         ignoreReadonly: true,
         beforeShowDay: DisableDates
     });
});
</script>

<script type="text/javascript" src="plugins/moment/moment.min.js"></script>
    <script type="text/javascript" src="plugins/daterangepicker/daterangepicker.min.js"></script>
    
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
        $('#startTimestamp').val(start.format('YYYY-MM-DD'));
        $('#endTimestamp').val(end.format('YYYY-MM-DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
        
    var op = <?PHP echo (!empty($user) ? json_encode($user) : '""'); ?>;
    if(op){
        document.getElementById("tfwdbid").style.opacity = 1.0;
        document.getElementById("tfwdask").style.opacity = 1.0;
        document.getElementById("t-bid-ask").style.opacity = 1.0;
        $('#d2b').removeClass("show-bg");
        $('#d2c').removeClass("show-bg");
        $('#no-more-tables2').removeClass("show-bg");
        $('#d2b').addClass("hide-bg");
        $('#d2c').addClass("hide-bg");
        $('#no-more-tables2').addClass("hide-bg");
    }
    else{
        document.getElementById("tfwdbid").style.opacity = 0.03;
        document.getElementById("tfwdask").style.opacity = 0.03;
        document.getElementById("t-bid-ask").style.opacity = 0.03;
        //$('.d2c').removeClass("hide-bg");
        $('#d2b').addClass("show-bg");
        $('#d2c').addClass("show-bg");
        $('#no-more-tables2').addClass("show-bg");
    }

    function findTomSpotBidData(pairSelTomBid){
        var bid;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        
        switch(pairSelTomBid){
            case '1':
                bodyText = document.getElementById('inrToUSDbid').innerHTML;
                bodyText = bodyText.replace(re, '');
                bid = parseFloat(bodyText);
                document.getElementById('tspotRateBid').value=bid.toFixed(4);
                document.getElementById('tcashSpotBid').value=<?php echo $cashBidUsd; ?> ;
                document.getElementById('tcashRateBid').value=(document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
                document.getElementById('ttomSpotBid').value=<?php echo $tomBidUsd; ?>;
                document.getElementById('ttomRateBid').value=(document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
            break;
            
            case '2':
                bodyText = document.getElementById('inrToEURbid').innerHTML;
                bodyText = bodyText.replace(re, '');
                bid = parseFloat(bodyText);
                document.getElementById('tspotRateBid').value=bid.toFixed(4);
                document.getElementById('tcashSpotBid').value=<?php echo $cashBidEur; ?> ;;
                document.getElementById('tcashRateBid').value=(document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
                document.getElementById('ttomSpotBid').value=<?php echo $tomBidEur; ?>;
                document.getElementById('ttomRateBid').value=(document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
            break;
            
            case '3':
                bodyText = document.getElementById('inrToGBPbid').innerHTML;
                bodyText = bodyText.replace(re, '');
                bid = parseFloat(bodyText);
                document.getElementById('tspotRateBid').value=bid.toFixed(4);
                document.getElementById('tcashSpotBid').value=<?php echo $cashBidGbp; ?> ;;
                document.getElementById('tcashRateBid').value=(document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
                document.getElementById('ttomSpotBid').value=<?php echo $tomBidGbp; ?>;
                document.getElementById('ttomRateBid').value=(document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
            break;
        }

    }
    
    function findTomSpotAskData(pairSelTomAsk){
        var ask;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        
        switch(pairSelTomAsk){
            case '1':
                bodyText = document.getElementById('inrToUSDask').innerHTML;
                bodyText = bodyText.replace(re, '');
                ask = parseFloat(bodyText);
                document.getElementById('tspotRateAsk').value=ask.toFixed(4);
                document.getElementById('tcashSpotAsk').value=<?php echo $cashAskUsd; ?> ;
                document.getElementById('tcashRateAsk').value=(document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
                document.getElementById('ttomSpotAsk').value=<?php echo $tomAskUsd; ?>;
                document.getElementById('ttomRateAsk').value=(document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
            break;
            
            case '2':
                bodyText = document.getElementById('inrToEURask').innerHTML;
                bodyText = bodyText.replace(re, '');
                ask = parseFloat(bodyText);
                document.getElementById('tspotRateAsk').value=ask.toFixed(4);
                document.getElementById('tcashSpotAsk').value=<?php echo $cashAskEur; ?> ;;
                document.getElementById('tcashRateAsk').value=(document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
                document.getElementById('ttomSpotAsk').value=<?php echo $tomAskEur; ?>;
                document.getElementById('ttomRateAsk').value=(document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
            break;
            
            case '3':
                bodyText = document.getElementById('inrToGBPask').innerHTML;
                bodyText = bodyText.replace(re, '');
                ask = parseFloat(bodyText);
                document.getElementById('tspotRateAsk').value=ask.toFixed(4);
                document.getElementById('tcashSpotAsk').value=<?php echo $cashAskGbp; ?> ;;
                document.getElementById('tcashRateAsk').value=(document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
                document.getElementById('ttomSpotAsk').value=<?php echo $tomAskGbp; ?>;
                document.getElementById('ttomRateAsk').value=(document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
            break;
        }

    }
        
</script>
</body>
</html>
