<?php
  function addLiveCurrencyRates($url, $idd) {
    $servername = "localhost";
    $username = "ibrlive";
    $password = "tubelight";
    $dbname = "ibrMock";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      echo "Connection error";
      die("Connection failed: " . $conn->connect_error);
    }else{
      echo "Connection established";
    } 
  
    $API_KEY = "eca3772a45"; //"nhw45dt6nj0khu0n569l"; //"eca3772a45";    
    $ch = curl_init();
    $url = $url.$API_KEY;
    echo "<br/>".$url."<br/>";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //added new line
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Cache-control: no-cache'));
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $server_output = curl_exec ($ch);
    curl_close ($ch);
    $result = json_decode($server_output);
    //print_r($result->{'currency'}[0]->{'value'}); echo "<br/>";

    $rate = "";
    $bid = "";
    $ask= "";
    $high = ""; 
    $low = "";
    $open = "";
    $close = "";
    $timestamp = ""; 
    
    $rate = $result[0]->{'rate'}; //$result->{'currency'}[0]->{'value'}; //$result[0]->{'rate'};
    $bid = $result[0]->{'bid'}; //$result->{'currency'}[0]->{'bid'}; //$result[0]->{'bid'};
    $ask= $result[0]->{'ask'}; //$result->{'currency'}[0]->{'ask'}; //$result[0]->{'ask'};
    $high = $result[0]->{'high'}; //$result->{'currency'}[0]->{'daily_highest'}; //$result[0]->{'high'}; 
    $low = $result[0]->{'low'}; //$result->{'currency'}[0]->{'daily_lowest'}; //$result[0]->{'low'};
    $open = $result[0]->{'open'};
    $close = $result[0]->{'close'};
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = $result[0]->{'timestamp'}; //$result->{'currency'}[0]->{'date'}; //$result[0]->{'timestamp'};     
    
    echo "<br/>ID: ".$idd."<br/>";
    echo "Rate: ".$rate."<br/>";
    echo "Bid: ".$bid."<br/>";
    echo "Ask: ".$ask."<br/>";
    echo "High: ".$high."<br/>";
    echo "Low: ".$low."<br/>";
    echo "Open: ".$open."<br/>";   
    echo "Close: ".$close."<br/>";       
    echo $timestamp."<br/><hr/>";
    $timestamp = $timestamp/1000;
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date('Y-m-d H:i:s', $timestamp)."<br/><hr/>";
    //$timestamp = date($timestamp)."<br/><hr/>";

    if($rate){
$sql="UPDATE `live-rates-ibr` SET `rate`=$rate,`bid`=$bid,`ask`=$ask,`high`=$high,`low`=$low,`open`=$open,`close`=$close,`timestamp`='$timestamp' WHERE `id`=6";
    
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
    }
    
    $conn->close();
  }

  addLiveCurrencyRates("https://www.live-rates.com/api/price?rate=NZD_USD&key=","6");
  //addLiveCurrencyRates("https://currencydatafeed.com/api/data.php?currency=USD/INR&token=","1");
?>
