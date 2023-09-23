<?php
if(session_id()=='' || !isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['username'])){
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
  date_default_timezone_set('Asia/Kolkata');
  $ldate=date( 'd-m-Y h:i:s A', time () );

  $uemail = $_SESSION['useremail'];
  
    mysqli_query($conn,"update userlog set logout='$ldate' WHERE userEmail='$uemail' ORDER BY id DESC LIMIT 1");

  
  $user = "";    
  $allow = ""; 
  unset($_SESSION['username']);
  unset($_SESSION['userallow']);
  unset($_SESSION['member']);
  unset($_SESSION['MFEXAM']);
  unset($_SESSION['FEEXAM']);
  unset($_SESSION['sessCustomerID']);
  unset($_SESSION['SUBSCRIPTION_CHECKING']);

  setcookie("email", "", time()-60, "/", "", 1);
  setcookie("token", "", time()-60, "/", "", 1);
  
  $conn->close();
  header("Location: home.php"); 
  exit();
}else{
  $user="";
  $allow="NO";
  
  header("Location: home.php"); 
  exit();
}
?>