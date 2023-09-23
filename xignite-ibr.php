<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Most Accurate & Live Foreign Exchange Rates, Free Mutual Fund Distributors Examination Mock Tests, IIBF's Certificate Course In Foreign Exchange Free Mock Tests, Currency Converter and Latest RBI Master Directions on Foreign Exchange">
  <meta name="keywords" content="IIBF Certificate, Foreign Exchange, NISM, Mutual Fund, Distributors, ibrlive, Currency Rates, Exchange Rates, RBI Circulars, Foreign Exchange, Currency Calculator, Currency Converter">

  <title>Home | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  
  <![endif]-->

    <script>
      var rcvData = function() {
        
        var count = 10, timer = setInterval(function() {
        document.getElementById("counter").innerHTML = count--+" seconds";
        if(count == 0) clearInterval(timer);
        }, 1000);
	
	$.post('get-xignite-live-rates', {
	  data: "1"
	}, function(response) {
          var res = response.split("-");     
          usdToINRrate = 0;

          if(res[1]=="0")
            document.getElementById("inrToUSDmid").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[1]).toFixed(5);
              var ask=parseFloat(res[2]).toFixed(5);
              var mid=parseFloat(res[3]).toFixed(5);
              var spread=parseFloat(res[4]).toFixed(5);
               
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              usdToINRrate=liverate;
            
            document.getElementById("inrToUSDbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[1]).toFixed(5) + "</font>";
            
            document.getElementById("inrToUSDask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[2]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDmid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[3]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDspread").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[4]).toFixed(5) + "</font>";

          }
          
          var tid = setInterval(function(){
            //document.getElementById("inrToUSD").style.backgroundColor = "#F2D7D5";
            //document.getElementById("inrToEUR").style.backgroundColor = "#EBDEF0";
            //document.getElementById("inrToGBP").style.backgroundColor = "#D4E6F1";
            //document.getElementById("inrToAUD").style.backgroundColor = "#D1F2EB";
            //document.getElementById("inrToCAD").style.backgroundColor = "#D4EFDF";
            //document.getElementById("inrToNZD").style.backgroundColor = "#FCF3CF";
            //document.getElementById("inrToTHB").style.backgroundColor = "#FAE5D3";
          },1000);

          setTimeout(function(){
            //document.getElementById("inrToUSD").style.backgroundColor = "white";
            //document.getElementById("inrToEUR").style.backgroundColor = "white";
            //document.getElementById("inrToGBP").style.backgroundColor = "white";
            //document.getElementById("inrToAUD").style.backgroundColor = "white";
            //document.getElementById("inrToCAD").style.backgroundColor = "white";
            //document.getElementById("inrToNZD").style.backgroundColor = "white";
            //document.getElementById("inrToTHB").style.backgroundColor = "white";

            clearInterval(tid); 
          },2000);
	});
                      
	$.post('get-xignite-fwd-rates', {
	  data: "1"
	}, function(response) {
          var res = response.split("-"); 
          
          document.getElementById("inrToUSDFwdPoints").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[1]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[2]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[3]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[4]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[5]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[6] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints1").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[7]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate1").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[8]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk1").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[9]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid1").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[10]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid1").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[11]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration1").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[12] + "</font>";

          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints2").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[13]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate2").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[14]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk2").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[15]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid2").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[16]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid2").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[17]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration2").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[18] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints3").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[19]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate3").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[20]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk3").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[21]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid3").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[22]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid3").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[23]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration3").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[24] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints4").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[25]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate4").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[26]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk4").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[27]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid4").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[28]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid4").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[29]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration4").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[30] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints5").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[31]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate5").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[32]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk5").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[33]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid5").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[34]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid5").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[35]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration5").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[36] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints6").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[37]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate6").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[38]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk6").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[39]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid6").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[40]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid6").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[41]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration6").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[42] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints7").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[43]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate7").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[44]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk7").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[45]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid7").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[46]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid7").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[47]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration7").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[48] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints8").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[49]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate8").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[50]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk8").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[51]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid8").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[52]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid8").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[53]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration8").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[54] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints9").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[55]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate9").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[56]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk9").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[57]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid9").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[58]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid9").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[59]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration9").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[60] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints10").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[61]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate10").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[62]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk10").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[63]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid10").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[64]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid10").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[65]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration10").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[66] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints11").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[67]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate11").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[68]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk11").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[69]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid11").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[70]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid11").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[71]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration11").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[72] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints12").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[73]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate12").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[74]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk12").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[75]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid12").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[76]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid12").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[77]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration12").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[78] + "</font>";
          
          // -----------------------------
          
          document.getElementById("inrToUSDFwdPoints13").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[79]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdSpotRate13").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[80]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdAsk13").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[81]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdBid13").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[82]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdMid13").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[83]).toFixed(5) + "</font>";
          document.getElementById("inrToUSDFwdExpiration13").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ res[84] + "</font>";
	});
	
      }   

      setInterval(function(){	
        rcvData();
      }, 1000);
    </script>

    <script>
      function CalculateUnit(sourceForm, targetForm) {
        // A simple wrapper function to validate input before making the conversion
        var sourceValue = sourceForm.unit_input.value;
        
        // First check if the user has given numbers or anything that can be made to one...
        sourceValue = parseFloat(sourceValue);
        
        var currVal=0;
 
        switch(targetForm.unit_menu.value){
          case 'INR':
            currVal = sourceValue;
          break;

          case 'USD':
            currVal = (1/parseFloat(document.getElementById("inrToUSDmid").getElementsByTagName('font')[0].innerHTML)); 
          break;

          case 'EUR':
            currVal = (1/parseFloat(document.getElementById("inrToEUR").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'GBP':
            currVal = (1/parseFloat(document.getElementById("inrToGBP").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'AUD':
            currVal = (1/parseFloat(document.getElementById("inrToAUD").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'CAD':
            currVal = (1/parseFloat(document.getElementById("inrToCAD").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'NZD':
            currVal = (1/parseFloat(document.getElementById("inrToNZD").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'THB':
            currVal = (1/parseFloat(document.getElementById("inrToTHB").getElementsByTagName('font')[0].innerHTML));
          break;     
                  
        }

        if (!isNaN(sourceValue) || sourceValue == 0) {
          // If we can make a valid floating-point number, put it in the text box and convert!
          sourceForm.unit_input.value = sourceValue;

          if(targetForm.unit_menu.value=='INR')
            targetForm.unit_input.value = sourceValue; 
          else
            targetForm.unit_input.value = (sourceValue*currVal).toFixed(5);
        }else{          
          targetForm.unit_input.value = '';
        }
     }

     function CalculateUnit2(sourceForm, targetForm) {
        // A simple wrapper function to validate input before making the conversion
        var sourceValue = sourceForm.unit2_input.value;
        
        // First check if the user has given numbers or anything that can be made to one...
        sourceValue = parseFloat(sourceValue);
        
        var currVal=0;
 
        switch(sourceForm.unit2_menu.value){
          case 'INR':
            currVal = sourceValue;
          break;

          case 'USD':
            currVal = parseFloat(document.getElementById("inrToUSDmid").getElementsByTagName('font')[0].innerHTML); 
          break;

          case 'EUR':
            currVal = parseFloat(document.getElementById("inrToEUR").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'GBP':
            currVal = parseFloat(document.getElementById("inrToGBP").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'AUD':
            currVal = parseFloat(document.getElementById("inrToAUD").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'CAD':
            currVal = parseFloat(document.getElementById("inrToCAD").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'NZD':
            currVal = parseFloat(document.getElementById("inrToNZD").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'THB':
            currVal = parseFloat(document.getElementById("inrToTHB").getElementsByTagName('font')[0].innerHTML);
          break;     
                  
        }

        if (!isNaN(sourceValue) || sourceValue == 0) {
          // If we can make a valid floating-point number, put it in the text box and convert!
          sourceForm.unit2_input.value = sourceValue;

          if(sourceForm.unit2_menu.value=='INR')
            targetForm.unit2_input.value = sourceValue; 
          else
            targetForm.unit2_input.value = (sourceValue*currVal).toFixed(5); //.toFixed(6)
        }else{          
          targetForm.unit2_input.value = '';
        }
     }
    </script>
    <meta name="google-site-verification" content="BJ7SrXsVSkkq6qIuc_hFQGACiOBm5QVhm--yW_F7tG0" />
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" onload="rcvData();">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-home"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Welcome to LEARN AND SPREAD</b></p>
                </div>
              </div>
            </div>

            <!--<div class="col-md-3">
              <div class="box box-primary"></div>
            </div>
            -->
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-money"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Live Currency Rates </p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body pad table-responsive" id="no-more-tables">
                  
                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                    <tr>
                      <th class="numeric"><h4><b>Quote Currency</b></h4></th>
                      <th colspan="4" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;"/><h4 style="display:inline;"> <b>INR (&#8377;)</b></h4></h4>
                      </th>
                    </tr>
                    <tr>
                      <th class="numeric"><h4><b>Base Currency</b></h4></th>

                      <th class="numeric"><h4><b>BID</b></h4></th>
                      <th class="numeric"><h4><b>ASK</b></h4></th>
                      <th class="numeric"><h4><b>MID</b></h4></th>
                      <th class="numeric"><h4><b>SPREAD</b></h4></th>
                    </tr>
                    </thead>
                    <tbody>
                       
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;"/> 1 USD (&#36;)</b></h4></td>

                      <td data-title="BID (&#8377;)" id="inrToUSDbid"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDask"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDmid"></td>
                      <td data-title="SPREAD (&#8377;)" id="inrToUSDspread"></td>
                    </tr>  
                    <tr>
                        <td colspan="5">
                            <h5><b>Real Time Exchange Rates ( Mid Market Values)</b><br/> 
Real Time Exchange rates (Mid Market Rates/Interbank Rates/Spot rates)- Mid Market rates are average of buy & sell transactional rates of a currency pair. <br/>These rates are just for reference purpose and not for transaction purpose.</h5>
                        </td>
                    </tr>    
                    <tbody> 
                    
                  </table>
                   
                </div>       
              </div>       
            </div>       
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-money"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Forward Rates (USD to INR)</p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body pad table-responsive" id="no-more-tables">
                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                   
                    <tr>
                      <th class="numeric"><h4><b>POINTS</b></h4></th>
                      <th class="numeric"><h4><b>SPOT RATE</b></h4></th>
                      <th class="numeric"><h4><b>ASK</b></h4></th>
                      <th class="numeric"><h4><b>MID</b></h4></th>
                      <th class="numeric"><h4><b>BID</b></h4></th>
                      <th class="numeric"><h4><b>EXPIRATION</b></h4></th>
                    </tr>
                    </thead>
                    <tbody>
                       
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration"></td>
                    </tr>  
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints1"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate1"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk1"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid1"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid1"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration1"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints2"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate2"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk2"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid2"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid2"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration2"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints3"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate3"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk3"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid3"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid3"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration3"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints4"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate4"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk4"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid4"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid4"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration4"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints5"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate5"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk5"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid5"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid5"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration5"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints6"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate6"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk6"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid6"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid6"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration6"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints7"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate7"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk7"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid7"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid7"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration7"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints8"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate8"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk8"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid8"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid8"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration8"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints9"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate9"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk9"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid9"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid9"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration9"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints10"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate10"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk10"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid10"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid10"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration10"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints11"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate11"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk11"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid11"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid11"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration11"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints12"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate12"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk12"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid12"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid12"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration12"></td>
                    </tr> 
                    
                    <tr>
                      <td data-title="POINTS (&#8377;)" id="inrToUSDFwdPoints13"></td>
                      <td data-title="SPOT RATE (&#8377;)" id="inrToUSDFwdSpotRate13"></td>
                      <td data-title="ASK (&#8377;)" id="inrToUSDFwdAsk13"></td>
                      <td data-title="MID (&#8377;)" id="inrToUSDFwdMid13"></td>
                      <td data-title="BID (&#8377;)" id="inrToUSDFwdBid13"></td>
                      <td data-title="EXPIRATION (&#8377;)" id="inrToUSDFwdExpiration13"></td>
                    </tr> 
                    
                    <tbody> 
                    
                  </table>
                  
                </div><!-- /.box -->
                
              </div>
            </div><!-- /.col -->            

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
            
                        <div class="col-md-6">
              <div class="box box-primary">
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
                          </select>
                        </span>
                      </form>
                    </div> <!-- /converter-side-f -->
                  </div><!-- /converter-wrapper -->                                
                </div>
              </div>
            </div>  
            
                        <div class="col-md-6">
              <div class="box box-primary">
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
                                                         
                          </select>
                        </span>
                      </form>
                    </div> <!-- /converter-side-b -->
                  </div><!-- /converter-wrapper -->                                
                </div>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-file"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Mutual Fund Distributors Certification - Mock Test</p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body" align=center>  


            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>5 Free Tests</h3>
                  <p style="font-size: 25px;"></p>
                </div>
                <div class="inner" style="background-color: white;">
                  <h3><a href="mutual-fund-test"><img style="height: 150px;" src="images/mutual-funds.png"/></a></h3>
                  <p></p>
                </div>                
                
              </div>
            </div><!-- ./col -->

                
            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Standard</h3>
                  <p style="font-size: 25px;">5 Days (All Tests)</p>
                </div>
                <div class="inner" style="background-color: #eafdfd; color: #2874a6;">
                  <h3>&#8377; 99/- Only</h3>
                  <p></p>
                </div>                
                <a href="check-auth" class="small-box-footer" style="font-size: 25px;">Buy Now <i class="fa fa-shopping-cart"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Gold</h3>
                  <p style="font-size: 25px;">30 Days (All Tests)</p>
                </div>
                <div class="inner" style="background-color: #fcf3cf; color: #7d6608;">
                  <h3>&#8377; 495/- Only</h3>
                  <p></p>
                </div> 
                <a href="check-auth" class="small-box-footer" style="font-size: 25px;">Buy Now <i class="fa fa-shopping-cart"></i></a>
              </div>
            </div><!-- ./col -->
            
            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Platinum</h3>
                  <p style="font-size: 25px;">90 Days (All Tests)</p>
                </div>
                <div class="inner" style="background-color:  #f6ddcc; color:  #6e2c00;">
                  <h3>&#8377; 995/- Only</h3>
                  <p></p>
                </div> 
                <a href="check-auth" class="small-box-footer" style="font-size: 25px;">Buy Now <i class="fa fa-shopping-cart"></i></a>
              </div>
            </div><!-- ./col -->                             
                </div>
              </div>
            </div>


            <div class="col-md-12">
              <div class="box box-primary">             
                <div class="box-header" align=center>
                  <i class="fa fa-file"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Certificate Course in Foreign Exchange - Mock Test</p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body" align=center>            

            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Standard</h3>
                  <p style="font-size: 25px;">30 Days (All Tests)</p>
                </div>
                <div class="inner" style="background-color: #eafdfd; color: #2874a6;">
                  <h3>&#8377; 495/- Only</h3>
                  <p></p>
                </div>                
                <a href="check-auth" class="small-box-footer" style="font-size: 25px;">Buy Now <i class="fa fa-shopping-cart"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Gold</h3>
                  <p style="font-size: 25px;">180 Days (All Tests)</p>
                </div>
                <div class="inner" style="background-color: #fcf3cf; color: #7d6608;">
                  <h3>&#8377; 995/- Only</h3>
                  <p></p>
                </div> 
                <a href="check-auth" class="small-box-footer" style="font-size: 25px;">Buy Now <i class="fa fa-shopping-cart"></i></a>
              </div>
            </div><!-- ./col -->
            
            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Platinum</h3>
                  <p style="font-size: 25px;">365 Days (All Tests)</p>
                </div>
                <div class="inner" style="background-color:  #f6ddcc; color:  #6e2c00;">
                  <h3>&#8377; 1495/- Only</h3>
                  <p></p>
                </div> 
                <a href="check-auth" class="small-box-footer" style="font-size: 25px;">Buy Now <i class="fa fa-shopping-cart"></i></a>
              </div>
            </div><!-- ./col --> 

            <div class="col-md-3" style="text-align: center;">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>5 Free Tests</h3>
                  <p style="font-size: 25px;"></p>
                </div>
                <div class="inner" style="background-color: white;">
                  <h3><a href="foreign-exchange-test"><img style="height: 150px;" src="images/foreign-exchange.jpg"/></a></h3>
                  <p></p>
                </div>                
                
              </div>
            </div><!-- ./col -->
                      
                </div>
              </div>
            </div>      
                      



            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-newspaper-o"></i>
                  <p class="box-title" style="font-size: 22px;"><b>News Feed </p><font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body">
                  <script type="text/javascript" src="https://www.24-7pressrelease.com/js/newsfeed.js"></script>
                  <script type="text/javascript" src="https://www.24-7pressrelease.com/js/js_press_releases.php?category_id=116&limit=4"></script>  
                  <script type="text/javascript">

                    js_style = 1;
                    target = "_blank";
                   
                    if (newsfeed){
                      showNews(newsfeed, js_style);
                    } else {
                      document.write("No News Feed Available.");
                    }
                  </script>   
                  <div align=center><a href="news"><button class="btn btn-primary">Click here for more News</button></a></div>          
                </div>
              </div>
            </div>

          </div><!-- ./row -->

          
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
<script src="dist/js/demo.js"></script>
</body>
</html>
