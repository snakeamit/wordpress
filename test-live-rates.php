<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Live Rates Testing | IBR Live</title>
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
                              
          if(res[1]=="0")
            document.getElementById("inrToUSD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
            document.getElementById("inrToUSD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[1]).toFixed(5)+"</font>";
            document.getElementById("inrToUSDbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">" +parseFloat(res[2]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">" +parseFloat(res[3]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[4]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[5]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[6]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDclose").innerHTML = "<font style=\"font-size: 20px; color:#2E86C1;\">"+parseFloat(res[7]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDdate").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+res[8]+'-'+res[9]+'-'+res[10]+"</font>";
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
            document.getElementById("inrToUSD").style.backgroundColor = "white";
            document.getElementById("inrToEUR").style.backgroundColor = "white";
            document.getElementById("inrToGBP").style.backgroundColor = "white";
            document.getElementById("inrToAUD").style.backgroundColor = "white";
            document.getElementById("inrToCAD").style.backgroundColor = "white";
            document.getElementById("inrToNZD").style.backgroundColor = "white";
            document.getElementById("inrToTHB").style.backgroundColor = "white";

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

            <div class="col-md-3">
              <div class="box box-primary"></div>
            </div>

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
                      <th class="numeric"></th>
                      <th class="numeric"><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;"/><h4 style="display:inline;"> <b>1 USD (&#36;)</b></h4></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;"/><h4 style="display:inline;"> <b>INR (&#8377;)</b></h4></td>
                      <td class="numeric">RATE</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSD"></td>
                    </tr>   
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">BID</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDbid"></td>
                    </tr>  
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">ASK</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDask"></td>
                    </tr>                 
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">HIGH</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDhigh"></td>
                    </tr>
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">LOW</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDlow"></td>
                    </tr>
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">OPEN</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDopen"></td>
                    </tr>
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">CLOSE</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDclose"></td>
                    </tr>
                    <tr>
                      <td class="numeric"></td>
                      <td class="numeric">DATE-TIME</td>
                      <td data-title="1 USD (&#36;)" id="inrToUSDdate"></td>
                    </tr>
                    
                    <tbody> 
                  </table>
                </div><!-- /.box -->
              </div>
            </div><!-- /.col -->            

            <div class="col-md-3">
              <div class="box box-primary"></div>
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
