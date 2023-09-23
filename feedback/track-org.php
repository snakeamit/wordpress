<?php include_once('config.php');

if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7"){

    }else{
      header("Location: ../profile.php");
      exit();
    }
  }else{
    header("Location: ../login.php");
    exit();
  }
  
?>
<!doctype html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Track Feedback | IBRLive </title>
	
	<link rel="shortcut icon" href="https://ibrlive.com/favicon.ico">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<style>
	td {
  white-space: normal !important; 
  word-wrap: break-word;  
}

table {
  table-layout: fixed;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
	</style>
</head>

<body style="font-size: 14px;">

	
	<?php
	$condition	=	'';
	if(isset($_REQUEST['username']) and $_REQUEST['username']!=""){
		$condition	.=	' AND username LIKE "%'.$_REQUEST['username'].'%" ';
	}
	if(isset($_REQUEST['person']) and $_REQUEST['person']!=""){
		$condition	.=	' AND person LIKE "%'.$_REQUEST['person'].'%" ';
	}
	if(isset($_REQUEST['useremail']) and $_REQUEST['useremail']!=""){
		$condition	.=	' AND useremail LIKE "%'.$_REQUEST['useremail'].'%" ';
	}
	if(isset($_REQUEST['userphone']) and $_REQUEST['userphone']!=""){
		$condition	.=	' AND userphone LIKE "%'.$_REQUEST['userphone'].'%" ';
		$condition	.=	' OR userphone2 LIKE "%'.$_REQUEST['userphone'].'%" ';
	}
	#if(isset($_REQUEST['userphone']) and $_REQUEST['userphone']!=""){
	#	$condition	.=	' AND userphone2 LIKE "%'.$_REQUEST['userphone'].'%" ';
	#}
	if(isset($_REQUEST['usercity']) and $_REQUEST['usercity']!=""){
		$condition	.=	' AND usercity LIKE "%'.$_REQUEST['usercity'].'%" ';
	}
	if(isset($_REQUEST['userstate']) and $_REQUEST['userstate']!=""){
		$condition	.=	' AND userstate LIKE "%'.$_REQUEST['userstate'].'%" ';
	}
	if(isset($_REQUEST['userstatus']) and $_REQUEST['userstatus']!=""){
		$condition	.=	' AND userstatus LIKE "%'.$_REQUEST['userstatus'].'%" ';
	}

	if(isset($_REQUEST['userdt']) and $_REQUEST['userdt']!=""){

		$condition	.=	' AND DATE(userdt)="'.$_REQUEST['userdt'].'" ';

	}

    if($condition != ''){
	$userData	=	$db->getAllRecords('users','*',$condition,'ORDER BY id ASC ');
    }
	?>
   	<div class="container-fluid">
		<h3><a href="https://ibrlive.com">Home | IBRLive </a></h3>
		<hr>
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Browse Exporter</strong> <a href="add-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add Exporter</a></div>
			<div class="card-body">
				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong <strong>Please try again!</strong></div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
					echo	'<div class="alert alert-success"><i class="fa fa-exclamation-triangle"></i> Record added successfully!</strong></div>';
				}
				?>
				<div class="col-sm-12">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Find Exporter</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>Exporter</strong></label>
									<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_REQUEST['username'])?$_REQUEST['username']:''?>" placeholder="Exporter Name">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>Contact Person</strong></label>
									<input type="text" name="person" id="person" class="form-control" value="<?php echo isset($_REQUEST['person'])?$_REQUEST['person']:''?>" placeholder="Contact Person">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>Email</strong></label>
									<input type="email" name="useremail" id="useremail" class="form-control" value="<?php echo isset($_REQUEST['useremail'])?$_REQUEST['useremail']:''?>" placeholder="Email">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>Phone</strong></label>
									<input type="tel" name="userphone" id="userphone" class="form-control" value="<?php echo isset($_REQUEST['userphone'])?$_REQUEST['userphone']:''?>" placeholder="Phone">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>City</strong></label>
									<input type="text" name="usercity" id="usercity" class="form-control" value="<?php echo isset($_REQUEST['usercity'])?$_REQUEST['usercity']:''?>" placeholder="City">
								</div>
							</div>
							
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>State</strong></label>
									<input type="text" name="userstate" id="userstate" class="form-control" value="<?php echo isset($_REQUEST['userstate'])?$_REQUEST['userstate']:''?>" placeholder="State">
								</div>
							</div>
							
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>Last Call Date</strong></label>
									<input type="date" name="userdt" id="userdt" class="form-control" value="<?php echo isset($_REQUEST['userdt'])?$_REQUEST['userdt']:''?>" placeholder="Last call date">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label><strong>Status</strong></label>
									<select name="userstatus" id="userstatus" class="form-control">
									    <option value="">Select option</option>
									    
									    <option value="Not interested" <?php if($_REQUEST['userstatus']=="Not interested") echo "selected";?>>Not interested</option>
									    <option <?php if($_REQUEST['userstatus']=="Prospective") echo "selected";?>  value="Prospective">Prospective</option>
									    <option <?php if($_REQUEST['userstatus']=="Confirmed") echo "selected";?> value="Confirmed">Confirmed</option>
									    <option <?php if($_REQUEST['userstatus']=="Not contacted") echo "selected";?> value="Not contacted">Not contacted</option>
									</select>    
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> </button>
										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> </a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>
		
		<div>
			<table id="exporter" name="exporter" class="table table-striped table-bordered" style="height: 500px;">
				<thead>
					<tr class="bg-primary text-white">
						<th style="width: 60px;">#</th>
						<th>Exporter</th>
						<th>Contact Person</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Telephone</th>
						<th>City</th>
						<th>Last Call Date</th>
						<th>Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
					?>
					<tr>
						<td class="bg-primary text-white"><?php echo $s;?></td>
						<td><?php echo $val['username'];?></td>
						<td><?php echo $val['person'];?></td>
						<td><?php echo trim($val['useremail']);?></td>
						<td><?php echo $val['userphone'];?></td>
						<td><?php echo $val['userphone2'];?></td>
						<td><?php echo $val['usercity'];?></td>
						<td><?php 
						$date = empty($val['userdt']) ? "" : date("d-m-Y", strtotime($val['userdt']));
                        echo $date;
						?>
						</td>
						
						<td><?php echo $val['userstatus'];?></td>
						<td align="center">
						    <a href="add-info.php?infoId=<?php echo $val['id'];?> &infoName=<?php echo $val['username'];?> &infoPerson=<?php echo $val['person'];?>" class="text-primary"><i class="fa fa-fw fa-plus"></i></a> |
						    <a href="view-info.php?viewId=<?php echo $val['id'];?> &viewName=<?php echo $val['username'];?>" class="text-primary"><i class="fa fa-fw fa-eye"></i></a> |
							<a href="edit-users.php?editId=<?php echo $val['id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i></a> | 
							<a href="delete.php?delId=<?php echo $val['id'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i></a>
						</td>

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="10" align="center">
					    <?php if($condition=='') echo "No Search Option Selected!"; 
					    else echo "No Record(s) found!"; ?></td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
	</div>
	
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
	<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
    <script>
		$(document).ready(function() {
		    $('#exporter').after('<div id="nav" class="pagination"></div>');
        var rowsShown = 10;
        var rowsTotal = $('#exporter tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#exporter tbody tr').hide();
        $('#exporter tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#exporter tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
        
        
			jQuery(function($){
				  var input = $('[type=tel]')
				  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
				  input.bind('country.mobilePhoneNumber', function(e, country) {
					$('.country').text(country || '')
				  })
			 });
			 
			 //From, To date range start
			var dateFormat	=	"yy-mm-dd";
			fromDate	=	$(".fromDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function(){
				toDate.datepicker("option", "minDate", getDate(this));
			}),
			toDate	=	$(".toDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function() {
				fromDate.datepicker("option", "maxDate", getDate(this));
			});
			
			
			function getDate(element){
				var date;
				try{
					date = $.datepicker.parseDate(dateFormat,element.value);
				}catch(error){
					date = null;
				}
				return date;
			}
			//From, To date range End here	
			
		});
	</script>
</body>
</html>
