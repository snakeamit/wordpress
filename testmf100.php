<?php
if(isset($_POST)){
  $score=0;
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

  if(isset($_POST['data'])){
    $k=0;
    $userans = $_POST['data'];
    $qry = "mfmock".$userans[100];
    $sql = "SELECT id, qno, rightopt FROM $qry";
    $result = $conn->query($sql);

    $addans='';

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if(strcmp((string)$row["rightopt"], (string)$userans[$k]) == 0)
	  $score=$score+1;
	
        $addans=$addans.'-'.(string)$row["rightopt"]; 		
	$k=$k+1;	
      }
    }else{
      print_r("Error");
    }
  }
 
  print_r($score.$addans);
}
?>