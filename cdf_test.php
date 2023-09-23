<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$url = "https://currencydatafeed.com/api/data.php?currency=USD/INR+EUR/INR+GBP/USD+AUD/USD+USD/CAD+NZD/USD+USD/THB&token=6zjjohdl41grpddyxv4k";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 90);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Cache-control: no-cache'));
echo $result = curl_exec($ch);

echo '<br>';
echo 'Errors: ' . curl_errno($ch) . ' ' . curl_error($ch) . '<br><br>';

curl_close($ch);
?>
