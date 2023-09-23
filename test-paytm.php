<?php
    // following file need to be included
    require_once("./lib/encdec_paytm.php");
    $orderId = "IBR-113";
    $merchantMid = "Learna52077899840336";
    $merchantKey = "XON3kL8ugCIJX!J4";
    $paytmParams["MID"] = $merchantMid;
    $paytmParams["ORDERID"] = $orderId; 
    $paytmChecksum = getChecksumFromArray($paytmParams, $merchantKey);
    $paytmParams['CHECKSUMHASH'] = urlencode($paytmChecksum);
    $postData = "JsonData=".json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
    $connection = curl_init(); // initiate curl
    // $transactionURL = "https://securegw.paytm.in/merchant-status/getTxnStatus"; // for production
    $transactionURL = "https://securegw-stage.paytm.in/merchant-status/getTxnStatus";
    curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($connection, CURLOPT_URL, $transactionURL);
    curl_setopt($connection, CURLOPT_POST, true);
    curl_setopt($connection, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $responseReader = curl_exec($connection);
    $responseData = json_decode($responseReader, true);
    echo "<pre>"; print_r($responseData); echo "</pre>";
?>