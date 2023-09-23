<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Most Accurate & Live Foreign Exchange Rates, Free Mutual Fund Distributors Examination Mock Tests, IIBF's Certificate Course In Foreign Exchange Free Mock Tests, Currency Converter and Latest RBI Master Directions on Foreign Exchange">
  <meta name="keywords" content="IIBF Certificate, Foreign Exchange, NISM, Mutual Fund, Distributors, ibrlive, Currency Rates, Exchange Rates, RBI Circulars, Foreign Exchange, Currency Calculator, Currency Converter">

  <title>Historical Data | IBR Live</title>
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

  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/daterangepicker/daterangepicker.css" />

    <script>
      var rcvData = function() {
         $("#coverScreen").hide(); 
      }
      
      function findHistData(){
        var dt1 = document.getElementById("startTimestamp").value;
        var dt2 = document.getElementById("endTimestamp").value;
        var pair = document.getElementById("pairSel").value;  
        $("#hist-data td").remove(); 
        $("#coverScreen").show(); 
         
        $.post('get-hist-data', {
	      data: "1",
	      t1: dt1,
	      t2: dt2
	    }, function(response) {
          var res = response.split("#");    
          var tbl = document.getElementById("hist-data");

          var tRows = res[0];
          var j = 0;
          
          $("#hist-data").show();
          
          if(tRows > 0){
            for (var i = 0; i < tRows; i++) {
                tr = document.createElement('tr');
                var td1 = document.createElement('td');
                td1.style.fontSize = "16px";
                td1.className="numeric";
            
                var td2 = document.createElement('td');
                td2.style.fontSize = "16px";
                td2.className="numeric";
            
                var td3 = document.createElement('td');
                td3.style.fontSize = "16px";
                td3.className="numeric";
            
                var td4 = document.createElement('td');
                td4.style.fontSize = "16px";
                td4.className="numeric";
            
                var td5 = document.createElement('td');
                td5.style.fontSize = "16px";
                td5.className="numeric";
            
                j = (i*5) + 1;
            
                var dtTime = (res[j]).split(" ");
                
                td1.appendChild(document.createTextNode(dtTime[0]));
                td2.appendChild(document.createTextNode(res[j+1]));
                td3.appendChild(document.createTextNode(res[j+2]));
                td4.appendChild(document.createTextNode(res[j+3]));
                td5.appendChild(document.createTextNode(res[j+4]));
            
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
            
                tbl.appendChild(tr);
            }  
          }else{
               tr = document.createElement('tr');
               var td1 = document.createElement('td');
               td1.style.fontSize = "16px";
               td1.colSpan ="5";
               td1.appendChild(document.createTextNode("No Data Available"));
               tr.appendChild(td1);
               tbl.appendChild(tr);
          }
          
          $("#coverScreen").hide(); 
          
	    });
      }   
      
    </script>
    
    <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
    </style>
  
    <meta name="google-site-verification" content="BJ7SrXsVSkkq6qIuc_hFQGACiOBm5QVhm--yW_F7tG0" />
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" onload="rcvData();">
<!--<div id="coverScreen" class="LockOnHome"></div>-->
<div id="coverScreen" class="LockOnHome"></div>
<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
    <div class="row">
        
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-header with-border" align=center>
          
        <i class="fa fa-money"></i>
        <p class="box-title" style="font-size: 22px;"><b>Historical Data </p><font style="font-size: 16px;"></b></font>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Select Pair</label>
                <select id="pairSel" class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="1">USD/INR</option>
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
          
          
          
        <table id="hist-data" class="table text-center table-condensed" style="border-color: #D5D8DC; display: none;" border=1>
          <thead class="cf" style="background-color: #EAEDED;">
            <tr>
                <th class="numeric" style="color: #21618C"><h4><b>DATE</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>OPEN (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>HIGH (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>LOW (&#8377;)</b></h4></th>
                <th class="numeric" style="color: #21618C"><h4><b>CLOSE (&#8377;)</b></h4></th>
            </tr>
          </thead>
               
        </table>
          
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

 
      
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
</script>
</body>
</html>
