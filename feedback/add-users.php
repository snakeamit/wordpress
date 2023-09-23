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
  
  
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($username==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($useremail==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($userphone==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
		
		$userCount	=	$db->getQueryCount('users','id');
		if($userCount[0]['total']<1000000){
			$data	=	array(
							'username'=>$username,
							'person'=>$person,
							'useremail'=>$useremail,
							'userphone'=>$userphone,
							'userphone2'=>$userphone2,
							'usercity'=>$usercity,
							'userstate'=>$userstate,
							'userstatus'=>$userstatus,
							'userdt'=>$userdt,
							'userremarks'=>$userremarks
						);
			$insert	=	$db->insert('users',$data);
			if($insert){
				header('location:track?msg=ras');
				exit;
			}else{
				header('location:track?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
	}
}
?>

<!doctype html>


<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Add exporter | IBRLive</title>

	

	<link rel="shortcut icon" href="https://ibrlive.com/favicon.ico">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>

	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	<![endif]-->

</head>



<body>

   	<div class="container-fluid">

		<h3><a href="https://ibrlive.com">Home | IBRLive </a></h3>
		<hr>

		<?php

		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

		}

		?>

		<div class="card">

			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add exporter</strong> <a href="track" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse exporters</a></div>

			<div class="card-body">
				<div class="col-sm-12">

					<h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>

					<form method="post" action="">
					  <div class="row">
						<div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Exporter</strong> <span class="text-danger">*</span></label>

							<input type="text" name="username" id="username" class="form-control" placeholder="Name" required>
                          </div>
                        </div>  
						
						<div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Contact Person</strong> <span class="text-danger">*</span></label>

							<input type="text" name="person" id="person" class="form-control" placeholder="Name" required>
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
						  <div class="form-group">
							<label><strong>Email</strong> <span class="text-danger">*</span></label>

							<input type="email" name="useremail" id="useremail" class="form-control" placeholder="Email" required>
						  </div>    
						</div>

                        <div class="col-sm-4">
						  <div class="form-group">
							<label><strong>Phone-1</strong> <span class="text-danger">*</span></label>

							<input type="tel" maxlength="15" class="tel form-control" name="userphone" id="userphone" x-autocompletetype="tel" placeholder="Phone-1" required>
                          </div>
						</div>
						
						<div class="col-sm-4">
						  <div class="form-group">
							<label><strong>Phone-2</strong> </label>

							<input type="tel" maxlength="15" class="tel form-control" name="userphone2" id="userphone2" x-autocompletetype="tel" placeholder="Phone-2" >
                          </div>
						</div>
						
						<div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>City</strong> </label>

							<input type="text" name="usercity" id="usercity" class="form-control" placeholder="City" >
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>State</strong> </label>

							<input type="text" name="userstate" id="userstate" class="form-control" placeholder="State">
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Last call date</strong> </label>

							<input type="date" name="userdt" id="userdt" class="form-control" placeholder="Last call date">
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
								<label><strong>Status</strong></label>
								<select name="userstatus" id="userstatus" class="form-control">
								<option value="">Select option</option>
									    
								<option value="1">Not interested</option>
								<option value="2">Prospective</option>
								<option value="3">Confirmed</option>
								<option value="4">Not contacted</option>
								<option value="5">Invalid</option>
								</select>    
							</div>
						</div>	

						<div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Remarks</strong> </label>

							<input type="text" name="userremarks" id="userremarks" class="form-control" placeholder="Remarks" >
			  </div>

                        </div>
                        <div class="col-sm-12">
						  <div class="form-group">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add User</button>
                          </div>
						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
	<script>
		$(document).ready(function() {
		jQuery(function($){
			  var input = $('[type=tel]')
			  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  input.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  })
			 });
		});
	</script>

    

</body>

</html>
