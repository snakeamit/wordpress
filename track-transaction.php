<?php
    if(session_id()=='' || !isset($_SESSION)){
      session_start();
    }
    $oid=intval($_POST['oid']);
?>

<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	// following files need to be included
	require_once("./lib/config_paytm.php");
	require_once("./lib/encdec_paytm.php");

	$ORDER_ID = "";
	$requestParamList = array();
	$responseParamList = array();


	if (isset($_POST["oid"]) && $_POST["oid"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
		$ORDER_ID = "IBR-".intval($_POST['oid']);

		// Create an array having all required parameters for status query.
		$requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $ORDER_ID);  
		
		$StatusCheckSum = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY);
		
		$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

		// Call the PG's getTxnStatusNew() function for verifying the transaction status.
		$responseParamList = getTxnStatusNew($requestParamList);
		
	}
	

?>

    <div style="margin-left:50px;">
        <form name="updateticket" id="updateticket" method="post"> 
            <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr height="30">
                    <td  class="fontkink1"><b>order Id:</b></td>
                    <td  class="fontkink"><?php echo $oid;?></td>
                </tr>

                <?php

					foreach($responseParamList as $paramName => $paramValue) {
				?>
				<tr >
				    <?php
				        
				        if($paramName=="TXNID"){
				            echo "<td class='fontkink1'><label>Transaction ID</label></td>";
					        echo "<td class='fontkink1'>". $paramValue. "</td>";
				        }
				        
				        if($paramName=="TXNAMOUNT"){
				            echo "<td class='fontkink1'><label>Transaction Amount</label></td>";
					        echo "<td class='fontkink1'>". $paramValue."</td>";
				        }
				        
				        if($paramName=="STATUS"){
				            echo "<td class='fontkink1'><label>Transaction Status</label></td>";
					        echo "<td class='fontkink1'>". $paramValue."</td>";
				        }

				        if($paramName=="TXNDATE"){
				            echo "<td class='fontkink1'><label>Transaction Date</label></td>";
					        echo "<td class='fontkink1'>".$paramValue."</td>";
				        }
				        
				        if($paramName=="PAYMENTMODE"){
				            echo "<td class='fontkink1'><label>Payment Mode</label></td>";
					        echo "<td class='fontkink1'>".$paramValue."</td>";
				        }
				        
				        if($paramName=="RESPMSG"){
				            echo "<td class='fontkink1'><label>Remarks </label></td>";
					        echo "<td class='fontkink1'>".$paramValue."</td>";
				        }
				        
				        
				    ?>
					
				</tr>
				<?php
					}
					
				?>


            </table>
        </form>
    </div>