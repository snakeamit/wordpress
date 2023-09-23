<?php
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

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

  $query0 = "SELECT id, month, settleDate, bidPrem, askPrem FROM usdFwdRate";
  $result0 = $conn->query($query0);
  $arrayBid = array();
  $arrayAsk = array();

  $endSettleDate;
  
  while($row0 = $result0->fetch_assoc()){ 
      
    $arrDateSettle = date("d-m-Y", strtotime($row0['settleDate']));
    $arrayBid[$arrDateSettle] = $row0['bidPrem'];
    
    $arrayAsk[$arrDateSettle] = $row0['askPrem'];
    
    $endSettleDate = date("d-m-Y", strtotime($row0['settleDate']));
  }	

  $arrayBidinit = array_values($arrayBid);
  $arrayAskinit = array_values($arrayAsk);
  
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
      
      $premBidEUR = $_POST['spotBidPremEUR-'.$i];
      $premAskEUR = $_POST['spotAskPremEUR-'.$i];
      
      $premBidGBP = $_POST['spotBidPremGBP-'.$i];
      $premAskGBP = $_POST['spotAskPremGBP-'.$i];
    
#$sql="UPDATE usdFwdRate SET settleDate='$newKey', bidPrem='$premBid', askPrem='$premAsk', bidPremEUR='$premBidEUR', askPremEUR='$premAskEUR', bidPremGBP='$premBidGBP', askPremGBP='$premAskGBP' WHERE id=$i";
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

  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['usdinrbid']) && isset($_SESSION['eurusdbid']) && isset($_SESSION['gbpusdbid']) && isset($_SESSION['usdinrask']) && isset($_SESSION['eurusdask']) && isset($_SESSION['gbpusdask'])){
      
  }else{
      $URL="https://currencydatafeed.com/api/data.php?currency=USD/INR+EUR/USD+GBP/USD&token=6zjjohdl41grpddyxv4k";
      $ch = curl_init();

      curl_setopt ($ch, CURLOPT_URL, $URL);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_TIMEOUT, 120);

      $server_output = curl_exec($ch);
      curl_close ($ch);
    
      $result = json_decode($server_output);
      $sts = $result->{'status'};
    
      $rate = "";
      #print_r($result); 
      if(!isset($result->{'currency'}[0]->{'value'})){
        $sts = 0;
      }
      
      $i = 0;
      if($sts == 1){
        $rateUSDINR = $result->{'currency'}[0]->{'value'};    
        for ($i = 0; $i < 3; $i++) {
          switch ($i) {
            case 0:
                $_SESSION['usdinrbid'] = $result->{'currency'}[$i]->{'bid'}; 
                $_SESSION['usdinrask'] = $result->{'currency'}[$i]->{'ask'};
            break;
            
            case 1:
                $_SESSION['eurusdbid'] = $result->{'currency'}[$i]->{'bid'}; 
                $_SESSION['eurusdask'] = $result->{'currency'}[$i]->{'ask'};
            break;
            
            case 2:
                $_SESSION['gbpusdbid'] = $result->{'currency'}[$i]->{'bid'}; 
                $_SESSION['gbpusdask'] = $result->{'currency'}[$i]->{'ask'};
            break;
          }
          
        }
      }
  }
  
  if(isset($_POST['spotBidPremEURinit-1'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      $err = "Error! Try again Later!";
    }else{
      $succ = "Connection established";
    } 

    for ($i = 1; $i <= 12; $i++) {
      
      $premBidEURinit = $_POST['spotBidPremEURinit-'.$i];
      $premAskEURinit = $_POST['spotAskPremEURinit-'.$i];
      
      $premBidGBPinit = $_POST['spotBidPremGBPinit-'.$i];
      $premAskGBPinit = $_POST['spotAskPremGBPinit-'.$i];
      
      #echo $_SESSION['usdinrbid'];
      #echo " / ";
      #echo $arrayBidinit[$i-1]/100;
      #echo " / ";
      #echo $_SESSION['eurusdbid'];
      #echo " / ";
      #echo $premBidEURinit;
      #echo " / ";
      #echo $_SESSION['usdinrbid'];
      #echo " / ";
      #echo $_SESSION['eurusdbid'];
      #echo " ## ";
      
      #echo $arrayBidinit[$i-1]; 
      #echo " / ";
      $finalBidEUR = ((($_SESSION['usdinrbid'] + ($arrayBidinit[$i-1]/100)) * ($_SESSION['eurusdbid'] + $premBidEURinit)) - ($_SESSION['usdinrbid'] * $_SESSION['eurusdbid']))*100;
      
      $finalBidEUR = number_format((float)$finalBidEUR, 4, '.', '');
      
      $finalAskEUR = ((($_SESSION['usdinrask'] + ($arrayAskinit[$i-1]/100)) * ($_SESSION['eurusdask'] + $premAskEURinit)) - ($_SESSION['usdinrask'] * $_SESSION['eurusdask']))*100;
      
      $finalAskEUR = number_format((float)$finalAskEUR, 4, '.', '');
      
      $finalBidGBP = ((($_SESSION['usdinrbid'] + ($arrayBidinit[$i-1]/100)) * ($_SESSION['gbpusdbid'] + $premBidGBPinit)) - ($_SESSION['usdinrbid'] * $_SESSION['gbpusdbid']))*100;
      
      $finalBidGBP = number_format((float)$finalBidGBP, 4, '.', '');
      
      $finalAskGBP = ((($_SESSION['usdinrask'] + ($arrayAskinit[$i-1]/100)) * ($_SESSION['gbpusdask'] + $premAskGBPinit)) - ($_SESSION['usdinrask'] * $_SESSION['gbpusdask']))*100;
      
      $finalAskGBP = number_format((float)$finalAskGBP, 4, '.', '');
      
$sql="UPDATE usdFwdRate SET bidPremEUR='$finalBidEUR', askPremEUR='$finalAskEUR', bidPremGBP='$finalBidGBP', askPremGBP='$finalAskGBP', bidPremEURinit='$premBidEURinit', askPremEURinit='$premAskEURinit', bidPremGBPinit='$premBidGBPinit', askPremGBPinit='$premAskGBPinit' WHERE id=$i";

      if ($conn->query($sql) === TRUE) {
        $succ = "Record updated successfully";
      } else {
        $err = "Error updating record: " . $conn->error;
      }
    }
    
    $conn->close();
  }
  
  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7"){

    }else{
      header("Location: profile.php");
      exit();
    }
  }else{
    header("Location: login.php");
    exit();
  }

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];    
    $allow = $_SESSION['userallow']; 
  }else{
    $user="";
    $allow="";
  }

  if($user==""){
    header("Location: login.php"); 
    exit();
  }else{
    if($allow==""){
      
    }else{
      
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>USD Spot - Forward | IBR Live</title>
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
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  
  <style>
    .no-border {
        border-width:0px; border:none
    }
    
    th.ui-datepicker-week-end,
    td.ui-datepicker-week-end {
        display: none;
    }
  </style>
  <script>
    function CalSpotFwdBid(sourceForm){
        var ds = sourceForm.dateExp.value;
        ds = ds.toString().split('-');
        ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);
        
        var bidArray = <?php echo json_encode($arrayBid); ?>;
        var dummyBid = document.getElementById('dummyRate').value;

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
            
            //alert(dprev_);
            //alert(dnext_);
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));
                
                //alert(pprev_);
                //alert(dp_);
                //alert(ddiff_);
                //alert(dmdiff_);
                
                spotFwdRate = parseFloat(parseFloat(dummyBid) + fwdprem/100).toFixed(5);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdExp').value = parseFloat(spotFwdRate).toFixed(5);
        }else{
            document.getElementById('fwdExp').value = "Not Available";
        }
    }
    
    function CalSpotFwdBidOrg(sourceForm){
        selectedDate = new Date(sourceForm.dateExp.value);
        var dd = selectedDate.getDate(); 
        var mm = selectedDate.getMonth() + 1; 
  
        var yyyy = selectedDate.getFullYear(); 
        if (dd < 10) { 
            dd = '0' + dd; 
        } 
        if (mm < 10) { 
            mm = '0' + mm; 
        } 
        var dateSelected = dd + '-' + mm + '-' + yyyy; 
        var ds = dateSelected.toString().split('-');
        var ds_ = new Date(ds[2], ds[1] - 1, ds[0]); // Date selected by user
        ds_.setHours(0,0,0,0);
        
        var bidArray = <?php echo json_encode($arrayBid); ?>;
        var dummyBid = document.getElementById('dummyRate').value;

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
            
            //alert(dprev_);
            //alert(dnext_);
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));
                
                //alert(pprev_);
                //alert(dp_);
                //alert(ddiff_);
                //alert(dmdiff_);
                
                spotFwdRate = parseFloat(parseFloat(dummyBid) + fwdprem/100).toFixed(5);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdExp').value = parseFloat(spotFwdRate).toFixed(5);
        }else{
            document.getElementById('fwdExp').value = "Not Available";
        }
    }
    
    function CalSpotFwdAsk(sourceForm){
        var ds = sourceForm.dateImp.value;
        ds = ds.toString().split('-');
        ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);
        
        var askArray = <?php echo json_encode($arrayAsk); ?>;
        var dummyAsk = document.getElementById('dummyAskRate').value;

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
                
                spotFwdRate = parseFloat(parseFloat(dummyAsk) + fwdprem/100).toFixed(5);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdImp').value = parseFloat(spotFwdRate).toFixed(5);
        }else{
            document.getElementById('fwdImp').value = "Not Available";
        }
    }
    
    function CalSpotFwdAskOrg(sourceForm){
        var day = new Date(sourceForm.dateImp.value).getUTCDay();

        //if(day == 0 || day == 6){
        //  document.getElementById('fwdImp').value = "";
        //  alert('Holiday. No Value Available.');
        //  return;
        //}
        alert(day);
        selectedDate = new Date(sourceForm.dateImp.value);
        
        
        var dd = selectedDate.getDate(); 
        var mm = selectedDate.getMonth() + 1; 
  
        var yyyy = selectedDate.getFullYear(); 
        if (dd < 10) { 
            dd = '0' + dd; 
        } 
        if (mm < 10) { 
            mm = '0' + mm; 
        } 
        var dateSelected = dd + '-' + mm + '-' + yyyy; 

        var ds = dateSelected.toString().split('-');
        var ds_ = new Date(ds[2], ds[1] - 1, ds[0]); // Date selected by user
        ds_.setHours(0,0,0,0);
        
        var askArray = <?php echo json_encode($arrayAsk); ?>;
        var dummyAsk = document.getElementById('dummyAskRate').value;

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
            
            //alert(dprev_);
            //alert(dnext_);
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));
                
                //alert(pprev_);
                //alert(dp_);
                //alert(ddiff_);
                //alert(dmdiff_);
                //alert(dummyAsk);
                spotFwdRate = parseFloat(parseFloat(dummyAsk) + fwdprem/100).toFixed(5);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        if(flag == 1){
            document.getElementById('fwdImp').value = parseFloat(spotFwdRate).toFixed(5);
        }else{
            document.getElementById('fwdImp').value = "Not Available";
        }
    }
    
    function CalFwd(sourceForm){
        selectedDate = new Date(sourceForm.dateExp.value);
        var dd = selectedDate.getDate(); 
        var mm = selectedDate.getMonth() + 1; 
  
        var yyyy = selectedDate.getFullYear(); 
        if (dd < 10) { 
            dd = '0' + dd; 
        } 
        if (mm < 10) { 
            mm = '0' + mm; 
        } 
        var dateSelected = dd + '-' + mm + '-' + yyyy; 
        
        var bidArray = <?php echo json_encode($arrayBid); ?>;
        var dummyBid = document.getElementById('dummyRate').value;
        
//alert(oDateOne - oDateTwo < 0);
//alert(oDateOne - oDateTwo > 0);

        var ct=0;
        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        
        var fs_ = new Date(fs);
        fs_.setHours(0,0,0,0);
        
        var ds = dateSelected.toString().split('-');
        var ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
        ds_.setHours(0,0,0,0);
        
        var dc;
        
        for( var key in bidArray ) {
            var value = bidArray[key];
            dc = key.toString().split('-');
            
            dc_ = new Date(dc[2], dc[1] - 1, dc[0]);
            dc_.setHours(0,0,0,0);
            
            //alert(ds_);
            //alert(fs_);
            
            if(ds_ <= dc_ && ct == 0){  // check for 0th month
                var d = parseInt((ds_ - fs_)/ (1000 * 60 * 60 * 24)) + 1; 
                var p = parseFloat(value - 0); // premium is fixed in this case

                var dd = parseInt((dc_ - fs_) / (1000 * 60 * 60 * 24)) + 1; 
                
                //alert(p);
                //alert(d);
                //alert(dd);
                //document.getElementById('fwdExp').value = parseFloat(parseFloat(dummyBid) + parseFloat(bidArray[key]/100)).toFixed(2);
                document.getElementById('fwdExp').value = parseFloat(parseFloat(dummyBid) + (0 + (p * (d/dd)))/100 ).toFixed(5);
                break;
            }
            
            if(ds_ - dc_ === 0){
            }
            else{
                document.getElementById('fwdExp').value = parseFloat(parseFloat(dummyBid)).toFixed(2);    
            }
        
            ct++;    
        }
        
        //if( bidArray[dateSelected] === undefined ) {
        //}else{
        //}

        //console.table(bidArray);
        //$arrayBid
    }
  </script>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">


  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
       

        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Spot Rate and Forward Rates - USD/INR</b></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">           <button class="btn btn-primary"><a style="color: white;" href="profile">Back To Profile</a></button>       
                </div>
              </div>
            </div>
            <!-- /.box-header -->
          </div>
        </div>
            
        <div class="col-md-12">
          <div class="box">    
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Date Today</th>
                  <th>Spot Settlement Date</th>
                  <th>Forward Start Date</th> 
		        </tr>
                <tr>
                  <td><input readonly name="dateToday" value=<?php echo $tday->format('d-m-Y');?> style="color:blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="dateSettle" value=<?php echo $mainSettleDt->format('d-m-Y') ;?> style="color:blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="dateFwd" id="dateFwd" value=<?php echo $mainFwdStartDt->format('d-m-Y') ;?> style="color:blue; font-size: 16px;border-width:0px; border:none;"></td>
                </tr>    
                <tr>
                  <td colspan=2></td>    
                </tr>    
              </table>
            </div>
            
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover w-auto">
                <tr>
                  <th>Month</th>
                  <th>Settlement Date</th>
                  <th>Bid Prem (USD/INR)</th>      
		          <th>Ask Prem (USD/INR)</th>
		          <th>Bid Prem (EUR/INR)</th>      
		          <th>Ask Prem (EUR/INR)</th>
		          <th>Bid Prem (GBP/INR)</th>      
		          <th>Ask Prem (GBP/INR)</th>
                </tr>
                
                <?php    
                //Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $custId= $_SESSION['sessCustomerID'];
                $query = "SELECT id, month, settleDate, bidPrem, askPrem, bidPremEUR, askPremEUR, bidPremGBP, askPremGBP FROM usdFwdRate";
                $result2 = $conn->query($query);
	
                $pname = "";
                $m=0;
                
                ?>
                <form action="" method="post"> 
                <?php
                $d=0;
                while($row2 = $result2->fetch_assoc()){ 
                  $end = new DateTime($arrDay[$m+1]);
                  $start = new DateTime($arrDay[$m]);
                  
                  $dif = $end->diff($start); 
                  $dif = intval($dif->d)+1;
                  
                  $d++;
                  echo "<tr>
                  <td><input style='width:3em' id='spotMonth-". $d."' type='text' name='spotMonth-". $d."' readonly class='no-border' value=". $row2['month'] . "></td>
                  
                  <td><input style='width:10em' id='spotSettleDt-". $d."' type='text' name='spotSettleDt-". $d."' readonly class='no-border' value=". $arrDay[$m] . "></td>
                  
                  <td>&#8377; <input id='spotBidPrem-". $d."' value=". $row2['bidPrem'] ." name='spotBidPrem-". $d."' type='text' class='numbersonly' style='width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input id='spotAskPrem-". $d."' value=". $row2['askPrem'] ." name='spotAskPrem-". $d."' type='text' class='numbersonly' style='width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input readonly id='spotBidPremEUR-". $d."' value=". $row2['bidPremEUR'] ." name='spotBidPremEUR-". $d."' type='text' class='numbersonly' style='background: #DCDCDC; width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input readonly id='spotAskPremEUR-". $d."' value=". $row2['askPremEUR'] ." name='spotAskPremEUR-". $d."' type='text' class='numbersonly' style='background: #DCDCDC; width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input readonly id='spotBidPremGBP-". $d."' value=". $row2['bidPremGBP'] ." name='spotBidPremGBP-". $d."' type='text' class='numbersonly' style='background: #DCDCDC; width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input readonly id='spotAskPremGBP-". $d."' value=". $row2['askPremGBP'] ." name='spotAskPremGBP-". $d."' type='text' class='numbersonly' style='background: #DCDCDC; width:8em; font-size: 16px; color: blue'></td>

                  </tr>";  
                  
                  $m++;
                }
                ?>
                
                <tr>
                  <td colspan="3"></td>
                  <td colspan=3><button name="submit" value="Submit" id="submit_form" class="btn btn-warning"><i class="fa fa-save fa-lg" style=""> Save All </i></button></td>    
                </tr> 
                
                </form>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div> 
        
        <div class="col-md-12">
          <div class="box">    
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>USD/INR Spot Bid</th>
                  <th>EUR/USD Spot Bid</th>
                  <th>EUR/INR Spot Bid</th> 
                  <th>USD/INR Spot Ask</th>
                  <th>EUR/USD Spot Ask</th>
                  <th>EUR/INR Spot Ask</th> 
		        </tr>
		        
		        <?php
		          if(isset($_SESSION['usdinrbid'])){
		        ?>
		        <tr>
                  <td><input readonly name="usdinrbidt2" id="usdinrbidt2" value=<?php echo $_SESSION['usdinrbid'];?> style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="eurusdbidt2" id="eurusdbidt2" value=<?php echo $_SESSION['eurusdbid'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="eurinrbidt2" id="eurinrbidt2" value=<?php echo $_SESSION['usdinrbid']*$_SESSION['eurusdbid'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="usdinraskt2" id="usdinraskt2" value=<?php echo $_SESSION['usdinrask'];?> style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="eurusdaskt2" id="eurusdaskt2" value=<?php echo $_SESSION['eurusdask'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="eurinraskt2" id="eurinraskt2" value=<?php echo $_SESSION['usdinrask']*$_SESSION['eurusdask'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                </tr>
                <?php }else{
                ?>
                <tr>
                  <td><input readonly name="usdinrbidt2" id="usdinrbidt2" value="0" style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="eurusdbidt2" id="eurusdbidt2" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="eurinrbidt2" id="eurinrbidt2" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="usdinraskt2" id="usdinraskt2" value="0" style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="eurusdaskt2" id="eurusdaskt2" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="eurinraskt2" id="eurinraskt2" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                </tr> 
                
                <?php
                }
                ?>
                <tr>
                  <td colspan=2></td>    
                </tr>    
              </table>

              <table class="table table-hover">
                <tr>
                  <th>USD/INR Spot Bid</th>
                  <th>GBP/USD Spot Bid</th>
                  <th>GBP/INR Spot Bid</th> 
                  <th>USD/INR Spot Ask</th>
                  <th>GBP/USD Spot Ask</th>
                  <th>GBP/INR Spot Ask</th> 
		        </tr>
		        
		        <?php
		          if(isset($_SESSION['usdinrbid'])){
		        ?>
                <tr>
                  <td><input readonly name="usdinrbidt3" id="usdinrbidt3" value=<?php echo $_SESSION['usdinrbid'];?> style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="gbpusdbidt3" id="gbpusdbidt3" value=<?php echo $_SESSION['gbpusdbid'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="gbpinrbidt3" id="gbpinrbidt3" value=<?php echo $_SESSION['usdinrbid']*$_SESSION['gbpusdbid'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="usdinraskt3" id="usdinraskt3" value=<?php echo $_SESSION['usdinrask'];?> style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="gbpusdaskt3" id="gbpusdaskt3" value=<?php echo $_SESSION['gbpusdask'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="gbpinraskt3" id="gbpinraskt3" value=<?php echo $_SESSION['usdinrask']*$_SESSION['gbpusdask'];?> style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                </tr> 
                <?php
		          }else{
                ?>
                <tr>
                  <td><input readonly name="usdinrbidt3" id="usdinrbidt3" value="0" style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="gbpusdbidt3" id="gbpusdbidt3" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="gbpinrbidt3" id="gbpinrbidt3" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="usdinraskt3" id="usdinraskt3" value="0" style="color: blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="gbpusdaskt3" id="gbpusdaskt3" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                  <td><input readonly name="gbpinraskt3" id="gbpinraskt3" value="0" style="color: blue; font-size: 16px;border-width:0px; border:none;"></td>
                </tr> 
                <?php
		          }
                ?>
                
                <tr>
                  <td colspan=2></td>    
                </tr>    
              </table>    
            </div>
            
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover w-auto">
                <tr>
                  <th>Month</th>
                  <th>Bid Prem (EUR/USD)</th>      
		          <th>Ask Prem (EUR/USD)</th>
		          <th>Bid Prem (GBP/USD)</th>      
		          <th>Ask Prem (GBP/USD)</th>
                </tr>
                <?php    
                //Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $custId= $_SESSION['sessCustomerID'];
                $query = "SELECT id, month, bidPremEURinit, askPremEURinit, bidPremGBPinit, askPremGBPinit FROM usdFwdRate";
                $result2 = $conn->query($query);
	
                $pname = "";
                $m=0;
                
                ?>
                <form action="" method="post"> 
                <?php
                $d=0;
                while($row2 = $result2->fetch_assoc()){ 
                  $d++;
                  echo "<tr>
                  <td><input style='width:3em' id='spotMonthinit-". $d."' type='text' name='initspotMonth-". $d."' class='no-border' value=". $row2['month'] . "></td>
                  
                  <td>&#8377; <input id='spotBidPremEURinit-". $d."' value=". $row2['bidPremEURinit'] ." name='spotBidPremEURinit-". $d."' type='text' class='numbersonly' style='width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input id='spotAskPremEURinit-". $d."' value=". $row2['askPremEURinit'] ." name='spotAskPremEURinit-". $d."' type='text' class='numbersonly' style='width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input id='spotBidPremGBPinit-". $d."' value=". $row2['bidPremGBPinit'] ." name='spotBidPremGBPinit-". $d."' type='text' class='numbersonly' style='width:8em; font-size: 16px; color: blue'></td>
                  
                  <td>&#8377; <input id='spotAskPremGBPinit-". $d."' value=". $row2['askPremGBPinit'] ." name='spotAskPremGBPinit-". $d."' type='text' class='numbersonly' style='width:8em; font-size: 16px; color: blue'></td>

                  </tr>";  
                  
                  $m++;
                }
                ?>
                
                <tr>
                  <td colspan="2"></td>
                  <td colspan=3><button name="submit" value="SubmitNow" id="submit_form_init" class="btn btn-warning"><i class="fa fa-save fa-lg" style=""> Update </i></button></td>    
                </tr> 
                
                </form>
                
              </table>
            </div>
          </div>
        </div>    
            
      </div>

    </section>



  <?php include_once("include/footer.php"); ?>
  </div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

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
         beforeShowDay: DisableDates
     });
     
     $("#dateExp").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy',
         minDate: minD,
         maxDate: maxD,
         beforeShowDay: DisableDates
     });
});
</script>
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
