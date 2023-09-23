<?php
include_once('lib/database.php');
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  $succ = "";
  $err = "";
    
  if(isset($_POST['submit'])) {
    $conn = OpenCon();
    //$conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      $err = "Error! Try again Later!";
    }else{
      $succ = "Connection established";
    } 

 
      $dnow = $_POST['dateNow'];
      $dtext = $_POST['dailyText'];
      $wfrom = $_POST['weekFrom'];
      $wto = $_POST['weekTo'];
      $wtext = $_POST['weekText'];
      $month = $_POST['month'];
      $monthtext = $_POST['monthText'];
      $endday = $_POST['endDay'];

      $i = 1;
      
$sql="UPDATE `curr-forecast` SET dateNow='$dnow', dailyText='$dtext', weekFrom='$wfrom', weekTo='$wto', weekText='$wtext', month='$month', monthText='$monthtext', endDay='$endday' WHERE id=1";

    
    if ($conn->query($sql) === TRUE) {
      $succ = "Record updated successfully";
      #echo $succ;
    } else {
      $err = "Error updating record: " . $conn->error;
      #echo $err;
    }        
    
    $conn->close();
  }


  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7" || $_SESSION['sessCustomerID'] == "628"){

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
  <title>Currency Forecast | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once('include/head.php'); ?>
  
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
  </style>
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Update Currency Forecast</h4>
      </div>
    </div>
  </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">

      <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box">
            <div class="box-header" style="float: right; padding-top: 20px">

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">           <button class="btn btn-primary"><a style="color: white;" href="profile">Back To Profile</a></button>       
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            
            <form action="" method="post"  style="padding-top: 80px;">

            <div class="box-body table-responsive">
              <table class="table">
                <?php
                //Create connection
                //$conn = new mysqli($servername, $username, $password, $dbname);
                $conn = OpenCon();
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT * FROM `curr-forecast` WHERE id=1";
                $result3 = $conn->query($query);
	
                while($row3 = $result3->fetch_assoc()){ 
      #               $dnow = $_POST['dateNow'];
      #$dailytext = $_POST['dailyText'];
      #$wfrom = $_POST['weekFrom'];
      #$wto = $_POST['weekTo'];
      #$wtext = $_POST['weekText'];
      #$month = $_POST['month'];
      #$monthtext = $_POST['monthText'];
      #$endday = $_POST['endDay'];
                ?>    
                    <tr>
                        <td style="font-size: 16px;"><strong>Date Now</strong></td>
                        <td><input id="dateNow" name="dateNow" class="form-control" type="date" value="<?php echo $row3['dateNow'];?>"/></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px;"><strong>Daily Text</strong></td>
                        <td colspan="2"><textarea rows=8 id="dailyText" name="dailyText" class="form-control"><?php echo $row3['dailyText'];?></textarea></td>
                        
                    </tr>
                    <tr>
                        <td style="font-size: 16px;"><strong>Week Date</strong></td>
                        <td><input id="weekFrom" name="weekFrom" class="form-control" type="date" value="<?php echo $row3['weekFrom'];?>"/></td>
                        <td><input id="weekTo" name="weekTo" class="form-control" type="date" value="<?php echo $row3['weekTo'];?>"/></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px;"><strong>Week Text</strong></td>
                        <td colspan="2"><textarea rows=8 id="weekText" name="weekText" class="form-control"><?php echo $row3['weekText']?></textarea></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px;"><strong>Month</strong></td>
                        <td colspan="2"><input id="month" name="month" class="form-control" value="<?php echo $row3['month'];?>"/></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px;"><strong>Month Text</strong></td>
                        <td colspan="2"><textarea rows=8 id="monthText" name="monthText" class="form-control"><?php echo $row3['monthText'];?></textarea></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px;"><strong>End Day Text</strong></td>
                        <td colspan="2"><textarea rows=8 id="endDay" name="endDay" class="form-control"><?php echo $row3['endDay'];?></textarea></td>
                    </tr>
                <?php    
                }
                
                $conn->close();
                ?>
                
                <tr>
                  <td></td>
                  <td colspan=2><button name="submit" value="Submit" id="submit_form" class="btn btn-warning"><i class="fa fa-save fa-lg" style=""> Save All </i></button></td>    
                </tr> 
                
                
              </table>
            </div>
            <!-- /.box-body -->
            </form>
            
          </div>
          <!-- /.box -->
        </div> 
      </div>

    </section>



  <?php include_once("include/footer.php"); ?>
  </div>
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