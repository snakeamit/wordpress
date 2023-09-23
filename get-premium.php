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
  $spotFwd = '';
  if(isset($_POST['data'])){
    $query = "SELECT id, month, fromDate, toDate, days, premium FROM spotForward";
    $result = $conn->query($query);
                
    $spotFwd = 0;

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $spotFwd =$spotFwd.'#'.(string)$row["id"].'#'.(string)$row["month"].'#'.(string)$row["fromDate"].'#'.(string)$row["toDate"].'#'.(string)$row["days"].'#'.(string)$row["premium"];		
      }
    }else{
      print_r("Error");
    }
  }
 
  print_r($spotFwd);
}
?>