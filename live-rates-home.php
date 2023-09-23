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
	
	$.post('get-live-rates', {
	  data: "1"
	}, function(response) {
          var res = response.split("-");     
          usdToINRrate = 0;
          
          if(res[1]=="0")
            document.getElementById("inrToUSD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[2]).toFixed(5);
              var ask=parseFloat(res[3]).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              usdToINRrate=liverate;
              
            document.getElementById("inrToUSD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            document.getElementById("inrToUSDopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[6]).toFixed(5) + "</font>";
            
            document.getElementById("inrToUSDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[4]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[5]).toFixed(5) + "</font>";
            //document.getElementById("inrToUSDdate").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+res[8]+'-'+res[9]+'-'+res[10]+"</font>";
          }
          
          
          
          if(res[11]=="0")
            document.getElementById("inrToEUR").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[12]).toFixed(5);
              var ask=parseFloat(res[13]).toFixed(5);
              var liverate=0;

              liverate=usdToINRrate * (parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              
            document.getElementById("inrToEUR").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            document.getElementById("inrToEURopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate * res[16]).toFixed(5) + "</font>";
            
            document.getElementById("inrToEURhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate * res[14]).toFixed(5) + "</font>";
            document.getElementById("inrToEURlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate * res[15]).toFixed(5) + "</font>";
            
          }
          
          if(res[21]=="0")
            document.getElementById("inrToGBP").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[22]).toFixed(5);
              var ask=parseFloat(res[23]).toFixed(5);
              var liverate=0;

              liverate=usdToINRrate * (parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              
            document.getElementById("inrToGBP").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            document.getElementById("inrToGBPopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ parseFloat(usdToINRrate * res[26]).toFixed(5) + "</font>";
            
            document.getElementById("inrToGBPhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ parseFloat(usdToINRrate * res[24]).toFixed(5) + "</font>";
            document.getElementById("inrToGBPlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ parseFloat(usdToINRrate * res[25]).toFixed(5) + "</font>";
          }
          
          if(res[31]=="0")
            document.getElementById("inrToAUD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[32]).toFixed(5);
              var ask=parseFloat(res[33]).toFixed(5);
              var liverate=0;

              liverate=usdToINRrate * (parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              
            document.getElementById("inrToAUD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            document.getElementById("inrToAUDopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate *res[36]).toFixed(5) + "</font>";
            
            document.getElementById("inrToAUDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate *res[34]).toFixed(5) + "</font>";
            document.getElementById("inrToAUDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate *res[35]).toFixed(5) + "</font>";
          }
          
          if(res[41]=="0")
            document.getElementById("inrToCAD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(1/parseFloat(res[42]).toFixed(5)).toFixed(5);
              var ask=parseFloat(1/parseFloat(res[43]).toFixed(5)).toFixed(5);
              var liverate=0;

              liverate=usdToINRrate * (parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              
            document.getElementById("inrToCAD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            document.getElementById("inrToCADopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate * (1/res[46])).toFixed(5) + "</font>";
            
            document.getElementById("inrToCADhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate * (1/res[44])).toFixed(5) + "</font>";
            document.getElementById("inrToCADlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate * (1/res[45])).toFixed(5) + "</font>";
          }
          
          if(res[51]=="0")
            document.getElementById("inrToNZD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[52]).toFixed(5);
              var ask=parseFloat(res[53]).toFixed(5);
              var liverate=0;

              liverate=usdToINRrate *(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              
            document.getElementById("inrToNZD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            document.getElementById("inrToNZDopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate *res[56]).toFixed(5) + "</font>";
            
            document.getElementById("inrToNZDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate *res[54]).toFixed(5) + "</font>";
            document.getElementById("inrToNZDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(usdToINRrate *res[55]).toFixed(5) + "</font>";
          }
          
          if(res[61]=="0")
            document.getElementById("inrToTHB").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(1/parseFloat(res[62]).toFixed(5)).toFixed(5);
              var ask=parseFloat(1/parseFloat(res[63]).toFixed(5)).toFixed(5);
              var liverate=0;

              liverate=usdToINRrate * (parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              
            document.getElementById("inrToTHB").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            //document.getElementById("inrToTHBopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[66]).toFixed(5) + "</font>";
            
            //document.getElementById("inrToTHBhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[64]).toFixed(5) + "</font>";
            //document.getElementById("inrToTHBlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[65]).toFixed(5) + "</font>";
            
            document.getElementById("inrToTHBopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ "-" + "</font>";
            document.getElementById("inrToTHBhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+"-"+ "</font>";
            document.getElementById("inrToTHBlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+"-" + "</font>";
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
            currVal = (1/parseFloat(document.getElementById("inrToUSD").getElementsByTagName('font')[0].innerHTML)); 
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
            currVal = parseFloat(document.getElementById("inrToUSD").getElementsByTagName('font')[0].innerHTML); 
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
            <div class="col-md-12">
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
                      <th class="numeric"><h4><b>LIVE RATES</b></h4></th>
                      <th class="numeric"><h4><b>OPEN</b></h4></th>
                      <th class="numeric"><h4><b>HIGH</b></h4></th>
                      <th class="numeric"><h4><b>LOW</b></h4></th>
                    </tr>
                    </thead>
                    <tbody>
                       
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;"/> 1 USD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToUSD"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToUSDopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToUSDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToUSDlow"></td>
                    </tr>   
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;"/> 1 EUR (&#8364;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToEUR"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToEURopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToEURhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToEURlow"></td>
                    </tr>  
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;"/> 1 GBP (&#163;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToGBP"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToGBPopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToGBPhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToGBPlow"></td>
                    </tr>                 
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;"/> 1 AUD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToAUD"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToAUDopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToAUDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToAUDlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;"/> 1 CAD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToCAD"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToCADopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToCADhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToCADlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;"/> 1 NZD (&#36;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToNZD"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToNZDopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToNZDhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToNZDlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"><h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;"/> 1 THB (&#3647;)</b></h4></td>
                      <td data-title="RATE (&#8377;)" id="inrToTHB"></td>
                      <td data-title="OPEN (&#8377;)" id="inrToTHBopen"></td>
                      <td data-title="HIGH (&#8377;)" id="inrToTHBhigh"></td>
                      <td data-title="LOW (&#8377;)" id="inrToTHBlow"></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <h5><b>Real Time Exchange Rates ( Mid Market Values)</b><br/> 
Real Time Exchange rates (Mid Market Rates/Interbank Rates/Spot rates)- Mid Market rates are average of buy & sell transactional rates of a currency pair. <br/>These rates are just for reference purpose and not for transaction purpose.</h5>
                        </td>
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
                            <option>EUR</option>
                            <option>GBP</option>
                            <option>AUD</option>
                            <option>CAD</option>
                            <option>NZD</option>
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
                            <option style="display: none;">THB</option>                              
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
                            <option style="display: none;">EUR</option>
                            <option style="display: none;">GBP</option>
                            <option style="display: none;">AUD</option>
                            <option style="display: none;">CAD</option>
                            <option style="display: none;">NZD</option>
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
                            <option>THB</option>                              
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
