<?php
  function cvf_convert_object_to_array($data) {

    if (is_object($data)) {
        $data = get_object_vars($data);
    }

    if (is_array($data)) {
        return array_map(__FUNCTION__, $data);
    }
    else {
        return $data;
    }
  }

  function addLiveCurrencyRates() {
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
  
    // define the SOAP client using the url for the service
    $client = new soapclient('http://globalcurrencies.xignite.com/xGlobalCurrencies.asmx?WSDL');

    // create an array of parameters 
    $param = array(
               "Symbol" => "USDINR");

    // add authentication info
    $xignite_header = new SoapHeader('http://www.xignite.com/services/',
     "Header", array("Username" => "9B17E368106C44689592CD659DE89E59"));
    $client->__setSoapHeaders(array($xignite_header));

    // call the service, passing the parameters and the name of the operation 
    $result = $client->GetRealTimeRate($param);
    // assess the results 
    if (is_soap_fault($result)) {
       echo '<h2>Fault</h2><pre>';
       print_r($result);
       echo '</pre>';
    } else {
       echo '<h2>Result</h2><pre>';
       print_r($result);
       $res = cvf_convert_object_to_array($result);
       #var_dump($res);

       $bid = "";
       $ask= "";
       $mid = "";
       $spread = "";
       
       $bid = $res['GetRealTimeRateResult']['Bid']; 
       $ask= $res['GetRealTimeRateResult']['Ask']; 
       $mid = $res['GetRealTimeRateResult']['Mid']; 
       $spread = $res['GetRealTimeRateResult']['Spread']; 
       
       date_default_timezone_set('Asia/Kolkata');
       
       $idd = 1;
       echo "<br/>ID: ".$idd."<br/>";
       echo "Bid: ".$bid."<br/>";
       echo "Ask: ".$ask."<br/>";
       echo "Mid: ".$mid."<br/>";
       echo "Spread: ".$spread."<br/>";
       
       date_default_timezone_set('Asia/Kolkata');

       if($mid){
$sql="UPDATE `xignite-rates-ibr` SET `bid`=$bid,`ask`=$ask, `mid`=$mid, `spread`=$spread WHERE `id`=1";
    
         if ($conn->query($sql) === TRUE) {
           echo "Record updated successfully";
         } else {
           echo "Error updating record: " . $conn->error;
         }
       }
       echo '</pre>';
    }

    
    $conn->close();
  }

  addLiveCurrencyRates();
?>
