<?php
  function addLiveCurrencyRates($url, $idd) {
    $servername = "localhost";
    $username = "ibrlive";
    $password = "tubelight";
    $dbname = "ibrMock";
    $success = "";  
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      echo "Connection error";
      die("Connection failed: " . $conn->connect_error);
    }else{
      $success="Connection established";
    } 
  
    $API_KEY = "6zjjohdl41grpddyxv4k";     
    $ch = curl_init();
    
    #$URL="http://www.currencydatafeed.com/api/data.php?currency=USD/INR+EUR/INR+GBP/USD+AUD/USD+USD/CAD+NZD/USD+USD/THB&token=6zjjohdl41grpddyxv4k";
    $URL="https://currencydatafeed.com/api/data.php?currency=USD/INR+EUR/INR+GBP/USD+AUD/USD+USD/CAD+NZD/USD+USD/THB+USD/AED+USD/SGD+USD/CNY&token=6zjjohdl41grpddyxv4k";

    $ch = curl_init();

    #echo "URL = $URL <br>\n";
    #echo "---START---";
    curl_setopt ($ch, CURLOPT_URL, $URL);
    #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    
    #curl_setopt($ch, CURLOPT_VERBOSE, 1);
    #curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
    #curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_TIMEOUT, 120);

    
    $server_output = curl_exec($ch);
    
    #echo $server_output;
    #echo "------------";
    #echo 'Errors: ' . curl_errno($ch) . ' ' . curl_error($ch) . '<br><br>';
    #echo "output: " . $server_output;
    
    curl_close ($ch);
    
    //exit();
    $result = json_decode($server_output);
echo json_last_error(); 
if($result != null){   
    #echo "------------";
    
    #print_r($result);
    $sts = $result->{'status'};
    
    $rate = "";
    #print_r($result); 
    #echo $sts; 
    
    #echo "<br/>ID: ".$idd."<br/>";
    #echo "<br/>STATUS: ".$sts."<br/>";
    #echo "Rate: ".$rate."<br/>";
    #echo "Bid: ".$bid."<br/>";
    #echo "Ask: ".$ask."<br/>";
    #echo "High: ".$high."<br/>";
    #echo "Low: ".$low."<br/>";
    #echo "Open: ".$open."<br/>";   
    #echo "Close: ".$close."<br/>";  
    #echo "---END---";
    if(!isset($result->{'currency'}[0]->{'value'})){
      $sts = 0;
    }
    
    $i = 0;
    if($sts == 1){
      $rateUSDINR = $result->{'currency'}[0]->{'value'};
	$rateUSDINRR= $rateUSDINR + 0.02;
echo $rateUSDINRR;    
      for ($i = 0; $i < 10; $i++) {
        $rate = "";
        $bid = "";
        $ask= "";
        $high = ""; 
        $low = "";
        $timestamp = ""; 
    
        switch ($i) {
            case 2:
            case 3:
            case 5:
                $rate = $result->{'currency'}[$i]->{'value'};
                $rate = $rate * $rateUSDINR;
                
                $bid = $result->{'currency'}[$i]->{'bid'}; 
                $bid = $bid * $rateUSDINR;
                
                $ask= $result->{'currency'}[$i]->{'ask'}; 
                $ask = $ask * $rateUSDINR;
                
                $high = $result->{'currency'}[$i]->{'daily_highest'};  
                $high = $high * $rateUSDINR;
                
                $low = $result->{'currency'}[$i]->{'daily_lowest'}; 
                $low = $low * $rateUSDINR;
            break;
            
            case 4:
            case 6:
            case 7:
            case 8:
            case 9:
                $rate = $result->{'currency'}[$i]->{'value'};
                $rateTemp = $rate;
                if($rate>0)
                    $rate = (1/$rate) * $rateUSDINR;
                else
                    $rate = "0";
                
                $bid = $result->{'currency'}[$i]->{'bid'}; 
                if($bid>0)
                    $bid = ($rate/$rateTemp) * $bid;
                else
                    $bid = "0";
                
                $ask= $result->{'currency'}[$i]->{'ask'}; 
                if($ask>0)
                    #$ask = (1/$ask) * $rateUSDINR;
                    $ask = ($rate/$rateTemp) * $ask;
                else
                    $ask = "0";
                
                $high = $result->{'currency'}[$i]->{'daily_highest'};  
                if($high>0)
                    $high = ($rate/$rateTemp) * $high;
                else
                    $high = "0";
                    
                $low = $result->{'currency'}[$i]->{'daily_lowest'}; 
                if($low>0)
                    $low = ($rate/$rateTemp) * $low;
                else
                    $low = "0";
            break;
            
            default:
                $rate = $result->{'currency'}[$i]->{'value'}; 
                $bid = $result->{'currency'}[$i]->{'bid'}; 
                $ask= $result->{'currency'}[$i]->{'ask'}; 
                $high = $result->{'currency'}[$i]->{'daily_highest'};  
                $low = $result->{'currency'}[$i]->{'daily_lowest'}; 
        }
      
        echo "Rate: ".$rate."<br/>";
        echo "Bid: ".$bid."<br/>";
        echo "Ask: ".$ask."<br/>";
        echo "High: ".$high."<br/>";
        echo "Low: ".$low."<br/>";
        echo "Open: ".$open."<br/>";   
        echo "Close: ".$close."<br/>";  
    
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = $result->{'currency'}[$i]->{'date'};    
        
        $j=$i+1;    
        #echo "Id: " . $j."<br/>";
$sql="UPDATE `live-rates-ibr` SET `rate`=$rate,`bid`=$bid,`ask`=$ask,`high`=$high,`low`=$low,`timestamp`='$timestamp' WHERE `id`=$j";
    
        if ($conn->query($sql) === TRUE) {
          $success="Record updated successfully";
          #echo $success;
	  #echo "-";
        } else {
          echo "Error updating record: " . $conn->error;
        }
      }
    }
}
    $conn->close();
  }

  addLiveCurrencyRates("https://www.currencydatafeed.com/api/data.php?currency=USD/INR+EUR/INR+GBP/USD+AUD/USD+USD/CAD+NZD/USD+USD/THB+USD/AED+USD/SGD+USD/CNY&token=","1");
  
?>
