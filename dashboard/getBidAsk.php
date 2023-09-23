<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  
  $bidUSD = "";
  $askUSD = "";
  $bidEUR = "";
  $askEUR = "";
  $bidGBP = "";
  $askGBP = "";
  
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }  
    
  $uid = $_SESSION['userid'];
  $uemail = $_SESSION['useremail'];
  
  $qryq = "SELECT `rate`,`bid`,`ask`,`from_curr`,`to_curr` FROM `live-rates-ibr`";
  
  $resq = $conn->query($qryq);
                  
  while($rw = $resq->fetch_assoc()){  
    switch($rw['from_curr']){
        case "USD":
          if($rw['to_curr']=="INR"){    
            $bidUSD = $rw['bid'];
            $askUSD = $rw['ask'];
          }
        break;
        
        case "EUR":
          if($rw['to_curr']=="INR"){    
            $bidEUR = $rw['bid'];
            $askEUR = $rw['ask'];
          }    
        break;
        
        case "GBP":
          if($rw['to_curr']=="INR"){    
            $bidGBP = $rw['bid'];
            $askGBP = $rw['ask'];
          }
        break;
    } 
  }
  
  $conn->close();
?>
