<?php

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://currencydatafeed.com/api/symbol.php?token=6zjjohdl41grpddyxv4k&symbol=BTC+ETH+USDT+BNB+BUSD+XRP+ADA+DOT+SOL+SHIB+DOGE+LUNA',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',

));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
