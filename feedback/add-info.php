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
  
  
if(isset($_REQUEST['submit-add-info']) and $_REQUEST['submit-add-info']!=""){
	extract($_REQUEST);
	if($remarks==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=urm');
		exit;
	}else{
		
		$userCount	=	$db->getQueryCount('follow','id');
		if($userCount[0]['total']<10000){
			$data	=	array(
							'uid'=>$_REQUEST['infoId'],
							'followdt'=>$followdt,
							'remarks'=>$remarks
						);
			$insert	=	$db->insert('follow',$data);
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

	<title>Exporter followup | IBRLive</title>

	

	<link rel="shortcut icon" href="https://ibrlive.com/favicon.ico">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>

	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	<![endif]-->

    <style>
    textarea {
    resize:none;
    }
    </style>
</head>



<body>

   	<div class="container-fluid">

		<h3><a href="https://ibrlive.com">Home | IBRLive </a></h3>
		<hr>

		<?php

		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="urm"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Remarks cannot be empty!</strong></div>';

		}

		?>

		<div class="card">

			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add exporter follow up info</strong> <a href="track" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse exporters</a></div>

			<div class="card-body">
				<div class="col-sm-12">

					<h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>

					<form method="post">
					  <div class="row">
						<div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Exporter</strong></label>

							<input type="text" name="username" id="username" class="form-control" placeholder="Name"  readonly value="<?php echo $_REQUEST['infoName']; ?>" >
                          </div>
                        </div>  
                        
                        <div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Contact Person</strong></label>

							<input type="text" name="person" id="person" class="form-control" placeholder="Name"  readonly value="<?php echo $_REQUEST['infoPerson']; ?>" >
                          </div>
                        </div> 

                        <div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Phone 1</strong></label>

							<input type="text" name="phone1" id="phone1" class="form-control" placeholder="Phone1"  readonly value="<?php echo $_REQUEST['infoPhone1']; ?>" >
                          </div>
                        </div> 
                        <div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Phone 2</strong></label>

							<input type="text" name="phone2" id="phone2" class="form-control" placeholder="Phone2"  readonly value="<?php echo $_REQUEST['infoPhone2']; ?>" >

                          </div>
                        </div> 
                        <div class="col-sm-4">
                          <div class="form-group">
						    <label><strong>Follow-up date</strong> <span class="text-danger">*</span></label>

							<input type="date" name="followdt" id="followdt" class="form-control" placeholder="Follow-up call date" required>
                          </div>
                        </div>
                        
                        <div class="col-sm-12">
                          <div class="form-group">
						    <label><strong>Remarks</strong> <span class="text-danger">*</span></label>

							<textarea rows=5 maxlength=2000 name="remarks" id="remarks" class="form-control" placeholder="Add remarks" required></textarea>
                          </div>
                        </div>	

                        <div class="col-sm-12">
						  <div class="form-group">
							<button type="submit" name="submit-add-info" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add Info</button>
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
