<?php
if(isset($_POST)){
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
  $histData = '';
  
  if(isset($_POST['data'])){
    $fromDate = (string)$_POST['t1'];
    $toDate = (string)$_POST['t2'];
    
    $opt = $_POST['pair'];
    $flag = 0;
    
    switch ($opt) {
        case 1:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histusdinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
        case 2:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histeurinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
        case 3:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histgbpinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
        case 4:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histaudinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
        case 5:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histcadinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
        case 6:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histnzdinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
        case 7:
            $query = "SELECT `dateP`, `open`, `high`, `low`, `close` FROM `histthbinr` WHERE `dateP`>='$fromDate' && `dateP`<='$toDate' ORDER BY `dateP` DESC";
            break;
            
        default:
            $flag = 1;
            print_r("Error");
    }
    
    if($flag != 1){
        $result = $conn->query($query);
    
        if ($result->num_rows > 0) {
            $rw = $result->num_rows;
            $histData = $rw;
            while($row = $result->fetch_assoc()) {
                $histData =$histData.'#'.(string)$row["dateP"].'#'.(string)$row["open"].'#'.(string)$row["high"].'#'.(string)$row["low"].'#'.(string)$row["close"];
        
            }
        }else{
            print_r("Error");
        }    
    }
  }
 
  print_r($histData);
}
?>