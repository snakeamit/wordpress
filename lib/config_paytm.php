<?php
/*
- Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
- Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
- Above details will be different for testing and production environment.
*/
define('PAYTM_ENVIRONMENT', 'PROD'); // PROD // TEST for test
define('PAYTM_MERCHANT_KEY', 'lIVpLbZpT@bZ7UET'); // Sw3ZNts45A4gA&VM 'XON3kL8ugCIJX!J4' Merchant key received from Paytm.
define('PAYTM_MERCHANT_MID', 'qRDswb07125522319590'); // Learna67904958348267 TEST 'Learna52077899840336' MID (Merchant ID) received from Paytm.
define('PAYTM_MERCHANT_WEBSITE', 'WEBPROD'); //'WEBSTAGING' Website name received from Paytm.
$PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
$PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
if (PAYTM_ENVIRONMENT == 'PROD') {
	$PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
	$PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
}
define('PAYTM_REFUND_URL', '');
define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
?>