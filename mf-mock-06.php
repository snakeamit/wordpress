<?php  
  include_once("check-MF.php");

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];  
  }else{
    $user="";
    $allow="NO";
  }

  if($user==""){
    header("Location: login.php"); 
    exit();
  }else{
    if($allow=="NO"){
      header("Location: mutual-fund-test.php"); 
      exit();
    }else{
      
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MF-Mock06 | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="jQuery/jQuery-2.1.3.min.js" type="text/javascript" language="javascript"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script>
	if (typeof(Storage) !== "undefined") {
		// Code for localStorage/sessionStorage.
	}else {
		// Sorry! No Web Storage support..
		alert("Broswer not supported.");
	}
		
	</script>
    <script type="text/javascript"> 
		var tim;
        var f = new Date();
		var myTimer;

		//var start = new Date().getTime() 
		var time = 0, elapsed = '0.0';

		$(document).ready(function () {
			//Disable selection - full page
			document.onselectstart = new Function('return false;');

			//Disable right click - full page
			$("body").on("contextmenu",function(e){
				return false;
			});

			//Disable cut copy paste - full page
			$('body').bind('cut copy paste', function (e) {
				e.preventDefault();
			});
		});

		function instance()
		{
			time += 1000;

			elapsed = Math.floor(time / 1000);
			
			localStorage.setItem("sec", 60-elapsed); 
			if(isNaN(parseInt(localStorage.getItem("min")))){				
				$("#coverScreen").show();
			}
			if(parseInt(localStorage.getItem("min")) <2){
				document.getElementById("showtime").innerHTML = "<font style='color:red'><b>Time Left: </b>"+parseInt(localStorage.getItem("min"))+" Minutes & " + parseInt(localStorage.getItem("sec"))+" Seconds";
			}else{
				document.getElementById("showtime").innerHTML = "<font style='color:green'><b>Time Left: </b>"+parseInt(localStorage.getItem("min"))+" Minutes & " + parseInt(localStorage.getItem("sec"))+" Seconds";
			}
			
			
			var ch = new Date().getTime();
			var myDate2 = Date.parse(localStorage['starttime']);
			
			var diff = (ch - myDate2) - time;
			
			if(parseInt(localStorage.getItem("sec")) <= 0){
			  localStorage.setItem("min", parseInt(localStorage.getItem("min"))-1);
			  
			  var myDate3 = new Date(); 
			  localStorage['starttime'] = String(myDate3);
			  
		      time=0;
			  elapsed = '0.0'
			}		
			
			if(parseInt(localStorage.getItem("sec")) <= 0 && parseInt(localStorage.getItem("min")) <0){
                checkAnswer();
                localStorage.setItem("started", parseInt(0)); //end quiz flag

				localStorage.removeItem("starttime");
				localStorage.removeItem("min"); 
                localStorage.removeItem("sec"); 
				
				for(var j=1; j<=25; j++){
				  var tempItem1;
				  var tempItem2;
				  
				  tempItem1="q"+i+"status";
				  tempItem2="mfmock6q"+i;
				  
  				  localStorage.removeItem(tempItem1); 
				  localStorage.removeItem(tempItem2);
				  clearTimeout(myTimer);
				}
                var tid; 
                for(var j=1; j<=25; j++){
                    tid="endexam"+j;
				    document.getElementById(tid).style.display = "none"; 
                }
                document.getElementById("starttime").style.display = "none";
			    document.getElementById("showtime").style.display = "none";	
			    document.getElementById("endscore").style.display = "block";			
			}else{				
				myTimer = window.setTimeout(instance, (1000 - diff));
			}
		}	

		function clock() {	
			if(!localStorage.getItem("min") || isNaN(localStorage.getItem("min"))){
				localStorage.setItem("min", parseInt(59));
			}
			if(!localStorage.getItem("sec") || isNaN(localStorage.getItem("sec"))){
				localStorage.setItem("sec", parseInt(60));
			}		
			if(!localStorage.getItem("starttime")){	
				var myDate1 = new Date(); 
				localStorage['starttime'] = String(myDate1);
			}
			
			myTimer = window.setTimeout(instance, 1000); //setInterval(myClock); 
		}
		
        function showQ(qno) { 
			var nid="mf06-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("mf06-status").style.display = "block";
			document.getElementById("mf06-guide").style.display = "none";  
			document.getElementById("mf06-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=25;i++){
				qhid = "mf06-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
            if(parseInt(localStorage.getItem("started"))==parseInt(6)){

            }else{
                          if(parseInt(localStorage.getItem("started"))!=parseInt(0) || isNaN(parseInt(localStorage.getItem("started")))){
                             
                            var urltext;
					if(parseInt(localStorage.getItem("started")) > 0 && parseInt(localStorage.getItem("started")) < 200){
						urltext = "mf-mock-0"+parseInt(localStorage.getItem("started"));
					}else{
						if(parseInt(localStorage.getItem("started")) > 199 && parseInt(localStorage.getItem("started")) < 400){
							var tempT;
							tempT = parseInt(localStorage.getItem("started"));
								
							urltext = "fe-mock-0"+tempT;
						}	
					}
			    var txt = "You have not finished "+urltext+" Redirecting ...";
                            alert(txt);

	                    urltext=urltext+".php";
                            window.location = urltext;
                            return false;
                           }else{   
                           }	
                        }
		
            document.getElementById("mf06-q1").style.display = "block"; 
			document.getElementById("mf06-status").style.display = "block";
			document.getElementById("mf06-guide").style.display = "none"; 
			document.getElementById("mf06-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));		
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(6)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "mfmock6q"+qno;
			  
			    form = document.getElementById(qval);			
			  
			    qval2 = form.elements[qval].value;
			    localStorage.setItem(String(qval), String(qval2)); 
            }
		}		
		
		function allChanges(){
			var i;
			var qtochange;
			var idtochange;
			var qval;
			var tval;
			var tchecka;
			var tcheckb;
			var tcheckc;
			var tcheckd;
			
			$("#coverScreen").hide();
                        
			if(isNaN(localStorage.getItem("started")) || !localStorage.getItem("started")){
                localStorage.setItem("started", parseInt(0));
            }
                        
			for(i=1; i<=25; i++){
				qtochange="q"+i+"status"; 
				idtochange="status"+i;
				
				if(!localStorage.getItem(qtochange)){
					localStorage.setItem(qtochange, "round-button");
					document.getElementById(idtochange).className = localStorage.getItem(qtochange);
				}else{
					//localStorage.setItem(qtochange, "round-button-ans");
					document.getElementById(idtochange).className = localStorage.getItem(qtochange);
				}
				
				qval = "mfmock6q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "mfmock6q"+i+"a"; tcheckb = "mfmock6q"+i+"b"; tcheckc = "mfmock6q"+i+"c"; tcheckd = "mfmock6q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "mfmock6q"+i+"a"; tcheckb = "mfmock6q"+i+"b"; tcheckc = "mfmock6q"+i+"c"; tcheckd = "mfmock6q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "mfmock6q"+i+"a"; tcheckb = "mfmock6q"+i+"b"; tcheckc = "mfmock6q"+i+"c"; tcheckd = "mfmock6q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "mfmock6q"+i+"a"; tcheckb = "mfmock6q"+i+"b"; tcheckc = "mfmock6q"+i+"c"; tcheckd = "mfmock6q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = true;
						
					break;
				}
			}			
			
		}

		var userans = new Array(); 
		var sendData = function() {
                        $("#coverScreen").show();
			document.getElementById("endscore").innerHTML = "<font style='color:green'><b>Calculating Score...</b>";
			$.post('testmf25', {
				data: userans
			}, function(response) {
                var res = response.split("-");
                var tval=0;
                var tstr;
                var tci;

				document.getElementById("endscore").innerHTML = "<font style='color:black; background:#ADFF2F; padding:10px;'><b>Your Score: </b>"+res[0]+"/25";

                for(var j=0; j<=24; j++){
                    tval=j+1;
                    tstr="status"+tval;
                                  
                    if(String(res[tval])==String(userans[j])){                                 
                        document.getElementById(tstr).style.backgroundColor = "green";                                                             
                    }else{
                        if(String(userans[j])=='z'){
                        }else{
                            document.getElementById(tstr).style.backgroundColor = "red"; 
                            tci=tval+String(userans[j])+"check";
                            document.getElementById(tci).innerHTML = "<font style=\"color: red;\">&#10006;</font>";                             
                        }
                    }

                    tci=tval+String(res[tval])+"check"; 
                                  
                    document.getElementById(tci).innerHTML = "<font style=\"color: green;\">&#10004;</font>";  

                    document.getElementById("opta").className = "round-button-correct";
                    document.getElementById("optb").className = "round-button-incorrect";
                    document.getElementById("opt1").innerHTML = "<b>CORRECT</b>";
                    document.getElementById("opt2").innerHTML = "<b>INCORRECT</b>";
                    document.getElementById("optc").style.display = "block";
                    document.getElementById("opt3").innerHTML = "<b>NOT ANSWERED</b>";
                    $("#coverScreen").hide();
                }                                
			});
		}
				
		function checkAnswer(){
			var radios; 
			var val;
			var tLabel;			
            var tid;

            clearTimeout(myTimer);
            localStorage.setItem("started", parseInt(0)); //end quiz flag 
            for(var j=1; j<=25; j++){
                tid="endexam"+j;
			    document.getElementById(tid).style.display = "none"; 
            }
			
			for(var i=1;i<=25;i++){
				tLabel = "mfmock6q"+i;
				val = localStorage.getItem(tLabel); 						
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('6'); //test-01
			
			document.getElementById("starttime").style.display = "none";
			document.getElementById("showtime").style.display = "none";	
			document.getElementById("endscore").style.display = "block";
			document.getElementById("reexam").style.display = "block";

			localStorage.removeItem("starttime");
			localStorage.removeItem("min"); 
			localStorage.removeItem("sec"); 
			
			
			for(var j=1; j<=25; j++){
			  var tempItem1;
			  var tempItem2;			  
			  
			  tempItem1="q"+j+"status";
			  tempItem2="mfmock6q"+j;
				  
  			  localStorage.removeItem(tempItem1); 
			  localStorage.removeItem(tempItem2);
			}
			sendData();
		}	
    </script>   
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" onload="allChanges()">
<div id="coverScreen" class="LockOn"></div>

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <div class="small-box" style="background: white;">
            <div class="inner">
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>NISM-Series-V-A: Mutual Fund Distributors Certification - Mock Test 6</b></p>
			  <div style="font-size: 22px;" align=center id="starttime"></div> 
			  <div style="font-size: 22px;" align=center style="display:none;" id="endscore"></div> 
			  <div style="font-size: 22px;" align=center id="showtime"></div>
            </div>            
          </div>
        </div>
        <!-- ./col -->        
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom" id="mf06-guide">
            <div class="box-header">             

              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">
                <b>Guidelines</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
			  <ul>
				<li class="fli"> This is a Mock Test for <b>NISM-Series-V-A: Mutual Fund Distributors Certification Examination</b> preparation.</li>
				<li class="fli"> Mock Test 6 has total 25 questions of 1 mark each. Please note that the actual examination for NISM-Series-V-A: Mutual Fund Distributors has 100 questions of 1 mark each.</li>
				<li class="fli"> There is no negative marking.</li>
				<li class="fli"> The passing score on the examination is 50%</li>	
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for NISM-Series-V-A: Mutual Fund Distributor Certification Examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('6')">Take the Test</button></li>
              </ul>
			  </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-3">

          <!-- Map box -->
          <div class="box box-solid " id="mf06-tut">
            <div class="box-header">             

              <i class="fa fa-question-circle"></i>

              <h3 class="box-title">
                <b>Help</b>
              </h3><hr/>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;" align=CENTER>
				<video playsinline autoplay muted loop>
					<source src="../options.mp4" type="video/mp4">
					Your browser does not support the video tag.
					</video>
			  </div>
            </div>
            <!-- /.box-body-->
            
          </div>
          <!-- /.box -->
		  
        </section>
        <!-- right col -->
	
	<section class="col-lg-12" id="reexam" style="display: none;">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header" style="text-align: center;">  
              <button class="btn btn-primary" onclick="location.href='mf-mock-05'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>           
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
              <button class="btn btn-primary" onclick="location.href='mf-mock-07'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
 
	<section class="col-lg-9" style="display:none" id="mf06-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. What is a mutual fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="mfmock6q1" ID="mfmock6q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> It is a pool of investor’s money <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="mfmock6q1" ID="mfmock6q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Mutual fund is a vehicle to mobilize money from investors to invest in different markets and securities <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="mfmock6q1" ID="mfmock6q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Mutual Fund provide professional fund management services to investors <div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="mfmock6q1" ID="mfmock6q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="next" id="endexam1"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('2')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. What is the role of Mutual fund? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="mfmock6q2" ID="mfmock6q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Help Investor in earning income and building wealth <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="mfmock6q2" ID="mfmock6q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> To benefit government and companies <div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="mfmock6q2" ID="mfmock6q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> To raise money to invest in various projects<div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="mfmock6q2" ID="mfmock6q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="2dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('1')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam2"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('3')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. Investment made by an investor in a scheme is translated into _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="mfmock6q3" ID="mfmock6q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A certain number of units in a scheme. <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="mfmock6q3" ID="mfmock6q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Portfolio<div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="mfmock6q3" ID="mfmock6q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Fund Value <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="mfmock6q3" ID="mfmock6q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> NAV <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('2')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam3"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('4')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. The relative size of a mutual fund company is assessed by?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="mfmock6q4" ID="mfmock6q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Asset under management(AUM) <div id="4acheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4b" NAME="mfmock6q4" ID="mfmock6q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Face value of All its schemes <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="mfmock6q4" ID="mfmock6q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both of the above <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="mfmock6q4" ID="mfmock6q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('3')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam4"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('5')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Commodity funds are those in which investments are made in _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="mfmock6q5" ID="mfmock6q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Commodities like wheat, spices, cotton <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="mfmock6q5" ID="mfmock6q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> copper and aluminium. <div id="5bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5c" NAME="mfmock6q5" ID="mfmock6q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> oil and gas, gold and silver  <div id="5ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5d" NAME="mfmock6q5" ID="mfmock6q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above.  <div id="5dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('4')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam5"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('6')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Who appoints the AMC? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="mfmock6q6" ID="mfmock6q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Trustees <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="mfmock6q6" ID="mfmock6q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sponsor <div id="6bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6c" NAME="mfmock6q6" ID="mfmock6q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Custodian <div id="6ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6d" NAME="mfmock6q6" ID="mfmock6q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('5')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam6"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('7')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. Open ended schemes generally offer exit option through stock exchange?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="mfmock6q7" ID="mfmock6q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True  <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="mfmock6q7" ID="mfmock6q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="7bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('6')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam7"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('8')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. Type of equity funds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="mfmock6q8" ID="mfmock6q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Diversified equity funds and sector funds <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="mfmock6q8" ID="mfmock6q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Arbitrage fund <div id="8bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8c" NAME="mfmock6q8" ID="mfmock6q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Thematic fund <div id="8ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8d" NAME="mfmock6q8" ID="mfmock6q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="8dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('7')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam8"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('9')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. Unit holders can hold there units in demat form?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="mfmock6q9" ID="mfmock6q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="mfmock6q9" ID="mfmock6q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="9bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('8')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam9"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('10')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. After how many days, open ended schemes should reopen for sale or repurchase?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="mfmock6q10" ID="mfmock6q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 5 Business days <div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="mfmock6q10" ID="mfmock6q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 15 Business days <div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="mfmock6q10" ID="mfmock6q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 30 Business days <div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="mfmock6q10" ID="mfmock6q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 10 Business days <div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('9')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam10"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('11')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. At what time scheme wise annual report has to be emailed to all unit holders?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="mfmock6q11" ID="mfmock6q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b>Within 6 months <div id="11acheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11b" NAME="mfmock6q11" ID="mfmock6q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Within 3 months <div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="mfmock6q11" ID="mfmock6q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Within 2 months <div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="mfmock6q11" ID="mfmock6q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Within 9 months <div id="11dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('10')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam11"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('12')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. How many parts are there of a Mutual Fund offer document?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="mfmock6q12" ID="mfmock6q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 <div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="mfmock6q12" ID="mfmock6q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 4 <div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="mfmock6q12" ID="mfmock6q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 5 <div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="mfmock6q12" ID="mfmock6q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 2 <div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('11')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam12"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('13')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. Is SAI part of SID?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="mfmock6q13" ID="mfmock6q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="mfmock6q13" ID="mfmock6q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="13bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('12')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam13"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('14')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14.What is KIM?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="mfmock6q14" ID="mfmock6q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> KIM is a summary of KYC <div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="mfmock6q14" ID="mfmock6q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> KIM is a summary of SAI & SID <div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="mfmock6q14" ID="mfmock6q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> None of the above <div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="mfmock6q14" ID="mfmock6q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> all of the above <div id="14dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('13')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam14"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('15')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. Who manages the scheme of a mutual fund? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="mfmock6q15" ID="mfmock6q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Distributor <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="mfmock6q15" ID="mfmock6q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Fund Manager <div id="15bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15c" NAME="mfmock6q15" ID="mfmock6q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="15ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15d" NAME="mfmock6q15" ID="mfmock6q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AMC <div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('14')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam15"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('16')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. What are some newer mutual fund distribution channels?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="mfmock6q16" ID="mfmock6q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Internet and stock exchange <div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="mfmock6q16" ID="mfmock6q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> New cadre of distributors like postal agent, retired govt. official, retired teachers & retired bank officers with a service of atleast 10 years<div id="16bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16c" NAME="mfmock6q16" ID="mfmock6q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="16ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16d" NAME="mfmock6q16" ID="mfmock6q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above. <div id="16dcheck" style="display: inline-block;"></div><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('15')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam16"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('17')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. Who is exempted from passing the NISM mutual fund distributor exam?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="mfmock6q17" ID="mfmock6q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> No one is exempted <div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="mfmock6q17" ID="mfmock6q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Every one is exempted <div id="17bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17c" NAME="mfmock6q17" ID="mfmock6q17c" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Employees above the age of 50 years with an experience of minimum 5 year as on 30th  sep 2003. <div id="17ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17d" NAME="mfmock6q17" ID="mfmock6q17d" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Employees above the age of 50 years with no experience as on 30th sep 2003 <div id="17dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('16')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam17"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('18')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. What are the different type of commissions paid to the distributors?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="mfmock6q18" ID="mfmock6q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Initial Commission <div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="mfmock6q18" ID="mfmock6q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trail commission <div id="18bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18c" NAME="mfmock6q18" ID="mfmock6q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Annual Commission <div id="18ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18d" NAME="mfmock6q18" ID="mfmock6q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) & (B) <div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('17')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam18"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('19')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. Is the practice of giving/ sharing commission to investor permitted?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="mfmock6q19" ID="mfmock6q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> No <div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="mfmock6q19" ID="mfmock6q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Yes <div id="19bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('18')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam19"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('20')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. When the scheme has been existed for less than 1 year, past performance is not provided?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="mfmock6q20" ID="mfmock6q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="mfmock6q20" ID="mfmock6q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="20bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('19')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam20"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('21')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. NAV is calculated as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="mfmock6q21" ID="mfmock6q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Net asset/ No of unit <div id="21acheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21b" NAME="mfmock6q21" ID="mfmock6q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Net asset/ Face value <div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="mfmock6q21" ID="mfmock6q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Net asset * Face value <div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="mfmock6q21" ID="mfmock6q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above. <div id="21dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('20')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam21"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('22')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. What are the different type of Expenses made by a mutual fund scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="mfmock6q22" ID="mfmock6q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Initial Issue Expense <div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="mfmock6q22" ID="mfmock6q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Operating Expense <div id="22bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22c" NAME="mfmock6q22" ID="mfmock6q22c" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Recurring Expense <div id="22ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22d" NAME="mfmock6q22" ID="mfmock6q22d" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the Above <div id="22dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('21')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam22"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('23')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. PAN Card is not required for Mutual Fund investments below Rs 50000 Per Mutual Fund Per Financial Year, where Payment is in cash?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="mfmock6q23" ID="mfmock6q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="mfmock6q23" ID="mfmock6q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="23bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('22')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam23"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('24')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. Which of the following is truly International  asset class?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="mfmock6q24" ID="mfmock6q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Real Estate <div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="mfmock6q24" ID="mfmock6q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity <div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="mfmock6q24" ID="mfmock6q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Debt <div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="mfmock6q24" ID="mfmock6q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gold <div id="24dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('23')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam24"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('25')" style="margin-left: 10px; float:left;">NEXT &#8658; </button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-9" style="display:none" id="mf06-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. According to the certified financial planner boards of students USA , the first stage in financial planning is _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock6q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="mfmock6q25" ID="mfmock6q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Analyse and Evaluate Clients Financial Status <div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="mfmock6q25" ID="mfmock6q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Establish and Define the Client Planner Relationship <div id="25bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25c" NAME="mfmock6q25" ID="mfmock6q25c" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gather Client Data, Define Clients Goals <div id="25ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25d" NAME="mfmock6q25" ID="mfmock6q25d" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Develop and Present Financial Planning  Recommendations or options <div id="25dcheck" style="display: inline-block;"></div><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('24')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam25"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-3" style="display: none" id="mf06-status">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             

              <i class="fa fa-spinner"></i>

              <h3 class="box-title">
                <b>Your Progress</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
			    <div class="box-header" style="text-align: center;">	                  
				    <table border=0 align=center>
						<tr>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('1')" id="status1">1</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('2')" id="status2">2</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('3')" id="status3">3</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('4')" id="status4">4</button></td>							
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
						</tr>
						<tr>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('5')" id="status5">5</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('6')" id="status6">6</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('7')" id="status7">7</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('8')" id="status8">8</button></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
						</tr>
						<tr>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('9')" id="status9">9</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('10')" id="status10">10</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('11')" id="status11">11</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('12')" id="status12">12</button></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
						</tr>
						<tr>		
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('13')" id="status13">13</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('14')" id="status14">14</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('15')" id="status15">15</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('16')" id="status16">16</button></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
						</tr>
						<tr>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('17')" id="status17">17</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('18')" id="status18">18</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('19')" id="status19">19</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('20')" id="status20">20</button></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
						</tr>
						<tr>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('21')" id="status21">21</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('22')" id="status22">22</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('23')" id="status23">23</button></td>
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('24')" id="status24">24</button></td>						
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
						</tr>
						<tr>	
							<td style="padding:10px;"></td>
							<td><button onclick="showQ('25')" id="status25">25</button></td>							
						</tr>
					</table>	
					<hr/>
					<table border=0 align=center>
						<tr>
							<td style="padding:10px;"></td>
							<td><a href="#" class="round-button" style="pointer-events: none;" id="opta"></a></td>
							<td style="padding:10px;"></td>
							<td id="opt1" style="text-align: left;"><b>NOT ANSWERED</b></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding:10px;"></td>
							<td></td>							
						</tr>
						<tr>
							<td style="padding:10px;"></td>
							<td><a href="#" class="round-button-ans" style="pointer-events: none;" id="optb"></a></td>
							<td style="padding:10px;"></td>
							<td id="opt2" style="text-align: left;"><b>ANSWERED</b></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding:10px;"></td>
							<td></td>
							<td style="padding:10px;"></td>
							<td></td>
						</tr>
                        <tr>
							<td style="padding:10px;"></td>
							<td><a href="#" class="round-button" style=" display:none; pointer-events: none;" id="optc"></a></td>
							<td style="padding:10px;"></td>
							<td id="opt3" style="text-align: left;"></td>
						</tr>
						
					</table>				
                </div><!-- /.box-header -->   
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <?php include_once("include/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>