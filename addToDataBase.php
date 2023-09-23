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

  if(isset($_POST['data'])){
    $idval= $_POST['data'];

    $API_KEY = "IST8D38ECP4146E8";    
    $ch = curl_init();

    switch($idval){
      case '1':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=USD&apikey=";
      break;

      case '2':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=EUR&apikey=";
      break;

      case '3':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=GBP&apikey=";
      break;

      case '4':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=AUD&apikey=";
      break;

      case '5':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=CAD&apikey=";
      break;

      case '6':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=NZD&apikey=";
      break;

      case '7':
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=INR&to_currency=THB&apikey=";
      break;
    }

    $url = $url.$API_KEY;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLOPT_TIMEOUT, 90);
    curl_setopt($crl, CURLOPT_HTTPHEADER, array('Cache-control: no-cache'));
    curl_setopt($crl, CURLOPT_HEADER, 0);

    $server_output = curl_exec ($ch);
    curl_close ($ch);
    $result = json_decode($server_output);

    $inrToCurr= $result->{'Realtime Currency Exchange Rate'};
    $fromCurr = $inrToCurr->{'1. From_Currency Code'};
    $fromName = $inrToCurr->{'2. From_Currency Name'};
    $toCurr = $inrToCurr->{'3. To_Currency Code'};
    $to_name = $inrToCurr->{'4. To_Currency Name'}; 
    $exR = $inrToCurr->{'5. Exchange Rate'};
    $date= $inrToCurr->{'6. Last Refreshed'};
    $timeZone = $inrToCurr->{'7. Time Zone'};

    $date = date('Y-m-d H:i:s');

    echo "<br/>ID: ".$$idval."<br/>";
    echo "From: ".$fromCurr."<br/>";
    echo "Name: ".$fromName."<br/>";
    echo "To: ".$toCurr."<br/>";
    echo "Name: ".$to_name."<br/>";
    echo "Rate: ".$exR."<br/>";
    echo "Date: ".$date."<br/>";   
    echo "TimeZone: ".$timeZone."<br/><hr/>";
    
    $sql = "UPDATE live_ex_rates SET ex_rates='$exR', last_refresh='$date' WHERE id='$idval'";
    
    if ($conn->query($sql) === TRUE) {
      #echo "Record updated successfully";
    } else {
      #echo "Error updating record: " . $conn->error;
    }

    $conn->close();
  }  
}
?>