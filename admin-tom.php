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

    for ($i = 1; $i <= 3; $i++) {  
      $c1 = $_POST['c1-'.$i];
      $c2 = $_POST['c2-'.$i];
      $c3 = $_POST['c3-'.$i];
      $c4 = $_POST['c4-'.$i];

$sql="UPDATE `cash-tom` SET `cashBid`=$c1, `tomBid`=$c2, `cashAsk`=$c3, `tomAsk`=$c4  WHERE `id`=$i ";
    
    if ($conn->query($sql) === TRUE) {
      $succ = "Record updated successfully";
    } else {
      $err = "Error updating record: " . $conn->error;
    }        
    }
    
    $conn->close();
  }


  if(session_id()=='' || !isset($_SESSION)){
    session_start();
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
  <title>Cash, Tom - Spot | IBR Live</title>
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Cash Tom Spot</h4>
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
            <div class="box-header"  style="float: right; padding-top: 20px">
  
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">           <button class="btn btn-primary"><a style="color: white;" href="profile">Back To Profile</a></button>       
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            
            <form action="" method="post" style="padding-top: 80px;">

            <div class="box-body table-responsive no-padding">
              <table class="table">
                   
                <tr>
                    <td style="font-size: 16px;"><strong>ID</strong></td>
                    <td style="font-size: 16px;"><strong>Pair</strong></td>
                    <td style="font-size: 16px;"><strong>Cash Spot (Bid)</strong></td>
                    <td style="font-size: 16px;"><strong>Tom Spot (Bid)</strong></td>
                    <td style="font-size: 16px;"><strong>Cash Spot (Ask)</strong></td>
                    <td style="font-size: 16px;"><strong>Tom Spot (Ask)</strong></td>
                </tr>
                
                <?php
                //Create connection
                $conn = OpenCon();
                //$conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT `id`, `pair`, `cashBid`, `tomBid`, `cashAsk`, `tomAsk` FROM `cash-tom`";
                $result3 = $conn->query($query);
	
                $d=0;
                while($row3 = $result3->fetch_assoc()){ 
                  $d++;
                  echo "<tr>
                  <td><input id='uid-". $d."' type='text' name='uid-". $d."' readonly style='font-size: 16px; padding: 10px; background-color: #E8E8E8; color: black;' class='no-border text-center' value=". $row3['id'] . "></td>
                  
                  <td><input id='pair-". $d."' type='text' name='pair-". $d."' readonly style='font-size: 16px; padding: 10px; background-color: #E8E8E8; color: black;' class='no-border text-center' value=". $row3['pair'] . "></td>
                  
                  <td><input style='font-size: 16px; padding: 10px; background-color: #D6EAF8 ; color: black;' id='c1-". $d."' type='text' name='c1-". $d."' class='no-border text-center' value=". $row3['cashBid'] . "></td>
                  
                  <td><input style='font-size: 16px; padding: 10px; background-color: #D6EAF8 ; color: black;' id='c2-". $d."' type='text' name='c2-". $d."' class='no-border text-center' value=". $row3['tomBid'] . "></td>
                  
                  <td><input style='font-size: 16px; padding: 10px; background-color: #D6EAF8 ; color: black;' id='c3-". $d."' type='text' name='c3-". $d."' class='no-border text-center' value=". $row3['cashAsk'] . "></td>
                  
                  <td><input style='font-size: 16px; padding: 10px; background-color: #D6EAF8 ; color: black;' id='c4-". $d."' type='text' name='c4-". $d."' class='no-border text-center' value=". $row3['tomAsk'] . "></td>
                  
                  </tr>";  
                }
                
                $conn->close();
                ?>
                
                <tr>
                  <td colspan="3"></td>
                  <td colspan=3><button name="submit" value="Submit" id="submit_form" class="btn btn-warning" style="float:right;"><i class="fa fa-save fa-lg" style=""> Save All </i></button></td>    
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
</body>
</html>