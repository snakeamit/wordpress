<?php
  function addCurrencyRates2($url, $idd) {
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
  
    $API_KEY = "IST8D38ECP4146E8";    
    $ch = curl_init();
    $url = $url.$API_KEY;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //added new line
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Cache-control: no-cache'));
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $server_output = curl_exec ($ch);
    curl_close ($ch);
    $result = json_decode($server_output);

    $fromCurr = "";
    $fromName = "";
    $toCurr = "";
    $to_name = ""; 
    $exR = "";
    $date= "";
    $timeZone = "";
 
    if(! $result->{Note}){
    $inrToCurr= $result->{'Realtime Currency Exchange Rate'};
    $fromCurr = $inrToCurr->{'1. From_Currency Code'};
    $fromName = $inrToCurr->{'2. From_Currency Name'};
    $toCurr = $inrToCurr->{'3. To_Currency Code'};
    $to_name = $inrToCurr->{'4. To_Currency Name'}; 
    $exR = $inrToCurr->{'5. Exchange Rate'};
    $date= $inrToCurr->{'6. Last Refreshed'};
    $timeZone = $inrToCurr->{'7. Time Zone'};
    }
    
    $date = date('Y-m-d H:i:s');

    echo "<br/>ID: ".$idd."<br/>";
    echo "From: ".$fromCurr."<br/>";
    echo "Name: ".$fromName."<br/>";
    echo "To: ".$toCurr."<br/>";
    echo "Name: ".$to_name."<br/>";
    echo "Rate: ".$exR."<br/>";
    echo "Date: ".$date."<br/>";   
    echo "TimeZone: ".$timeZone."<br/><hr/>";

    if($exR){
      $sql = "UPDATE live_ex_rates SET ex_rates='$exR', last_refresh='$date' WHERE id='1'";
    
    if ($conn->query($sql) === TRUE) {
      #echo "Record updated successfully";
    } else {
      #echo "Error updating record: " . $conn->error;
    }
    }
    
    $conn->close();
  }

  addCurrencyRates2("https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=USD&to_currency=INR&apikey=","1");
?>
