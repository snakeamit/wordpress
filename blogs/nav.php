<?php
include_once '../lib/database.php';
$conn = OpenCon();
$conn = OpenCon();
$sqld = "SELECT * FROM blogs where published = true ORDER BY id DESC limit 9";
$result = $conn->query($sqld);

?>
    <div class="col-sm-4">
	    <!-- List-Group Panel -->
	    <div class="panel panel-default panelBorderColor" style="margin-top: 10px;">
		    <div class="panel-heading">
		        <h1 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> <strong>Recent Blogs</strong></h1> 
		    </div>    
		    <div class="list-group" id="leftnav">
				<?php 
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
				 <a id="b-8" href="single.php?post_slug=<?php echo $row['slug'];?>" class="list-group-item"><i class="fa fa-angle-double-right"></i><?php echo $row['title'];?></a>
				<?php } 
				}
				?>
		       
		        <!-- <a id="b-7" href="eefc-accounts-everything-exporters-need-to-know" class="list-group-item"><i class="fa fa-angle-double-right"></i> EEFC Account: Everything Exporters Need to Know! </a>      
		        <a id="b-6" href="ofac-meaning-types-countries-list-tips-for-exporter-importer" class="list-group-item"><i class="fa fa-angle-double-right"></i> What is OFAC? How to deal with OFAC Countries as an Importer or Exporter?</a>
		        <a id="b-1" href="usd-to-inr-exchange-rate-by-settlement-date" class="list-group-item"><i class="fa fa-angle-double-right"></i> How understanding of USD to INR CASH, TOM, SPOT & FORWARD rates can benefit an Exporter or Importer?</a>
		        <a id="b-2" href="currency-forward-contract-definition-booking-cancellation" class="list-group-item"><i class="fa fa-angle-double-right"></i> Currency Forward Contract</a>
		        <a id="b-3" href="powerful-strategies-booking-currency-forward-contract-for-exporters" class="list-group-item"><i class="fa fa-angle-double-right"></i> 10 Powerful Strategies of Booking Currency Forward Contract For Exporters</a>
		        <a id="b-4" href="fx-retail-platform-exporters-importers-usd-inr-transactions" class="list-group-item"><i class="fa fa-angle-double-right"></i> Fx Retail platform for Exporters & Importers USD-INR transactions</a>
		        <a id="b-5" href="foreign-currency-abroad-for-travel-business-education-purpose" class="list-group-item"><i class="fa fa-angle-double-right"></i> Limit of foreign currency one can take abroad for travel, business and education purpose</a> -->
		    </div>
        </div>			
    </div><!--/Left Column-->
<?php    
?>    