<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  
  if(isset($_POST['updateProfPass'])){
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    
    $uid = $_SESSION['userid'];
    $upwd = $_POST['pwd']; 
    $urepwd = $_POST['repwd']; 

    if(strcmp($upwd,$urepwd) == 0)
      $noMsg = "";
    else
      $errorProf = "Passwords do not match.";

    if($errorProf == ""){  
      $upass = password_hash($upwd, PASSWORD_DEFAULT);	    

      $res = mysqli_query($conn,"update customers set password='$upass' WHERE id='$uid' ");
   
      if($res){
        $successProf="Updation Successful!";
      }else{
	    $errorProf="Try later, please!";
      }
    }  
  }

?>
