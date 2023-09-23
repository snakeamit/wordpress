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

  function addLiveForwardRates() {
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
    $result = $client->GetForwardRate($param);
    // assess the results 
    if (is_soap_fault($result)) {
       echo '<h2>Fault</h2><pre>';
       print_r($result);
       echo '</pre>';
    } else {
       echo '<h2>Result</h2><pre>';
       #print_r($result);
       $res = cvf_convert_object_to_array($result);
       #var_dump($res);

       $arr = array(
         0 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][0]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][0]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][0]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][0]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][0]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][0]['Expiration']
         ),
         
         1 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][1]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][1]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][1]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][1]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][1]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][1]['Expiration']
         ),
         
         2 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][2]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][2]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][2]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][2]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][2]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][2]['Expiration']
         ),
         
         3 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][3]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][3]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][3]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][3]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][3]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][3]['Expiration']
         ),
         
         4 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][4]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][4]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][4]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][4]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][4]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][4]['Expiration']
         ),
         
         5 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][5]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][5]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][5]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][5]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][5]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][5]['Expiration']
         ),
         
         6 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][6]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][6]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][6]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][6]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][6]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][6]['Expiration']
         ),
         
         7 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][7]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][7]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][7]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][7]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][7]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][7]['Expiration']
         ),
         
         8 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][8]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][8]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][8]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][8]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][8]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][8]['Expiration']
         ),
         
         9 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][9]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][9]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][9]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][9]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][9]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][9]['Expiration']
         ),
         
         10 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][10]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][10]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][10]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][10]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][10]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][10]['Expiration']
         ),
         
         11 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][11]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][11]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][11]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][11]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][11]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][11]['Expiration']
         ),
         
         12 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][12]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][12]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][12]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][12]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][12]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][12]['Expiration']
         ),
         
         13 => array(
           'bid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][13]['Bid'],
           'mid' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][13]['Mid'],
           'ask' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][13]['Ask'],
           'spotrate' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][13]['SpotRate'],
           'points' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][13]['Points'],
           'expiration' => $res['GetForwardRateResult']['ForwardRates']['ForwardContract'][13]['Expiration']
         )
       );
       
   
       #echo $arr[0][0].'='; #bid
       #echo $arr[0][1].'='; #mid
       #echo $arr[0][2].'='; #ask
       #echo $arr[0][3].'='; #spotrate
       #echo $arr[0][4].'='; #points
       #echo $arr[0][5]; #expiration
       $arrEx01 = $arr[0]['expiration'];
       $arrEx02 = $arr[1]['expiration'];
       $arrEx03 = $arr[2]['expiration'];
       $arrEx04 = $arr[3]['expiration'];
       $arrEx05 = $arr[4]['expiration'];
       $arrEx06 = $arr[5]['expiration'];
       $arrEx07 = $arr[6]['expiration'];
       $arrEx08 = $arr[7]['expiration'];
       $arrEx09 = $arr[8]['expiration'];
       $arrEx10 = $arr[9]['expiration'];
       $arrEx11 = $arr[10]['expiration'];
       $arrEx12 = $arr[11]['expiration'];
       $arrEx13 = $arr[12]['expiration'];
       $arrEx14 = $arr[13]['expiration'];
       
       if($arr[0]['bid']){
#$sql= "INSERT INTO `xignite-fwd-ibr` (`bid`, `mid`, `ask`, `spotrate`, `points`, `expiration`, `id`) VALUES (".$arr[0][0].", ".$arr[0]['1'].", ".$arr[0]['2'].", ".$arr[0]['3'].", ".$arr[0]['4'].", ".$arr[0]['5'].", '1') ON DUPLICATE KEY UPDATE points=VALUES(`points`), spotrate=VALUES(`spotrate`), ask=VALUES(`ask`), mid=VALUES(`mid`), bid=VALUES(`bid`)";               
 
$sql= "INSERT INTO `xignite-fwd-ibr` (`bid`, `mid`, `ask`, `spotrate`, `points`, `expiration`, `id`) VALUES (".$arr[0]['bid'].", ".$arr[0]['mid'].", ".$arr[0]['ask'].", ".$arr[0]['spotrate'].", ".$arr[0]['points'].", '$arrEx01', '1'), (".$arr[1]['bid'].", ".$arr[1]['mid'].", ".$arr[1]['ask'].", ".$arr[1]['spotrate'].", ".$arr[1]['points'].", '$arrEx02', '2'), (".$arr[2]['bid'].", ".$arr[2]['mid'].", ".$arr[2]['ask'].", ".$arr[2]['spotrate'].", ".$arr[2]['points'].", '$arrEx03', '3'), (".$arr[3]['bid'].", ".$arr[3]['mid'].", ".$arr[3]['ask'].", ".$arr[3]['spotrate'].", ".$arr[3]['points'].", '$arrEx04', '4'), (".$arr[4]['bid'].", ".$arr[4]['mid'].", ".$arr[4]['ask'].", ".$arr[4]['spotrate'].", ".$arr[4]['points'].", '$arrEx05', '5'), (".$arr[5]['bid'].", ".$arr[5]['mid'].", ".$arr[5]['ask'].", ".$arr[5]['spotrate'].", ".$arr[5]['points'].", '$arrEx06', '6'), (".$arr[6]['bid'].", ".$arr[6]['mid'].", ".$arr[6]['ask'].", ".$arr[6]['spotrate'].", ".$arr[6]['points'].", '$arrEx07', '7'), (".$arr[7]['bid'].", ".$arr[7]['mid'].", ".$arr[7]['ask'].", ".$arr[7]['spotrate'].", ".$arr[7]['points'].", '$arrEx08', '8'), (".$arr[8]['bid'].", ".$arr[8]['mid'].", ".$arr[8]['ask'].", ".$arr[8]['spotrate'].", ".$arr[8]['points'].", '$arrEx09', '9'), (".$arr[9]['bid'].", ".$arr[9]['mid'].", ".$arr[9]['ask'].", ".$arr[9]['spotrate'].", ".$arr[9]['points'].", '$arrEx10', '10'), (".$arr[10]['bid'].", ".$arr[10]['mid'].", ".$arr[10]['ask'].", ".$arr[10]['spotrate'].", ".$arr[10]['points'].", '$arrEx11', '11'), (".$arr[11]['bid'].", ".$arr[11]['mid'].", ".$arr[11]['ask'].", ".$arr[11]['spotrate'].", ".$arr[11]['points'].", '$arrEx12', '12'), (".$arr[12]['bid'].", ".$arr[12]['mid'].", ".$arr[12]['ask'].", ".$arr[12]['spotrate'].", ".$arr[12]['points'].", '$arrEx13', '13'), (".$arr[13]['bid'].", ".$arr[13]['mid'].", ".$arr[13]['ask'].", ".$arr[13]['spotrate'].", ".$arr[13]['points'].", '$arrEx14', '14') ON DUPLICATE KEY UPDATE bid=VALUES(`bid`), mid=VALUES(`mid`), ask=VALUES(`ask`), spotrate=VALUES(`spotrate`), points=VALUES(`points`), expiration=VALUES(`expiration`)"; 

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

  addLiveForwardRates();
?>
