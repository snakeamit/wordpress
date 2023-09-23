<?php  
  include_once("check-FE.php");

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
      header("Location: foreign-exchange-test.php"); 
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
  <title>FE-Mock17 | IBR Live</title>
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
				  tempItem2="femock17q"+i;
				  
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
			var nid="fe17-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("fe17-status").style.display = "block";
			document.getElementById("fe17-guide").style.display = "none";  
			document.getElementById("fe17-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=25;i++){
				qhid = "fe17-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
            if(parseInt(localStorage.getItem("started"))==parseInt(216)){

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
		
            document.getElementById("fe17-q1").style.display = "block"; 
			document.getElementById("fe17-status").style.display = "block";
			document.getElementById("fe17-guide").style.display = "none"; 
			document.getElementById("fe17-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));		
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(216)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "femock17q"+qno;
			  
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
				
				qval = "femock17q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "femock17q"+i+"a"; tcheckb = "femock17q"+i+"b"; tcheckc = "femock17q"+i+"c"; tcheckd = "femock17q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "femock17q"+i+"a"; tcheckb = "femock17q"+i+"b"; tcheckc = "femock17q"+i+"c"; tcheckd = "femock17q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "femock17q"+i+"a"; tcheckb = "femock17q"+i+"b"; tcheckc = "femock17q"+i+"c"; tcheckd = "femock17q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "femock17q"+i+"a"; tcheckb = "femock17q"+i+"b"; tcheckc = "femock17q"+i+"c"; tcheckd = "femock17q"+i+"d";
						
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
			$.post('testfe25', {
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
				tLabel = "femock17q"+i;
				val = localStorage.getItem(tLabel); 						
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('17'); //test-017
			
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
			  tempItem2="femock17q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>IIBF's Certificate Course in Foreign Exchange - Mock Test 17</b></p>
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
          <div class="nav-tabs-custom" id="fe17-guide">
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
				<li class="fli"> This is a Mock Test for <b>IIBF's Certificate Course in Foreign Exchange</b> examination preparation.</li>
				<li class="fli"> Mock Test 17 has total 25 questions of 1 mark each. Please note that the actual examination have 100 questions that has to be completed in 2 hours.</li>
				<li class="fli"> There is no negative marking.</li>
				<li class="fli"> The passing score on the examination is 50%.</li>	
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for <b>IIBF's Certificate Course in Foreign Exchange</b> examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('216')">Take the Test</button></li>
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
          <div class="box box-solid " id="fe17-tut">
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
              <button class="btn btn-primary" onclick="location.href='fe-mock-0215'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>       
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
              <button class="btn btn-primary" onclick="location.href='fe-mock-0217'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
	
	<section class="col-lg-9" style="display:none" id="fe17-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. Advance remittance for import of goods is allowed by AD Bank</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="femock17q1" ID="femock17q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> If the importer is their customer and his account is fully compliant with RBI KYC/AML guidelines<div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="femock17q1" ID="femock17q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The Importer hold the EC copy of a valid Import License under the Foreign Trade Policy in force<div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="femock17q1" ID="femock17q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No RBI Permission is required if the remittance for import of goods is up to  US $ 200,000<div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="femock17q1" ID="femock17q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above<div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. Which one of the below is not one of the objectives of FEMA</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="femock17q2" ID="femock17q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Facilitating external trade<div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="femock17q2" ID="femock17q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Promote orderly development of foreign exchange market in India<div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="femock17q2" ID="femock17q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Restrict Import payments<div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="femock17q2" ID="femock17q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Make offences related to foreign exchange as civil offences<div id="2dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. Advance Remittances for imports</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="femock17q3" ID="femock17q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Require RBI permission<div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="femock17q3" ID="femock17q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Can be allowed by AD Category-I banks subject to terms and conditions<div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="femock17q3" ID="femock17q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Cannot be allowed<div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="femock17q3" ID="femock17q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Can be allowed on approval of DGFT<div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. Evidence of Import does not include</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="femock17q4" ID="femock17q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exchange Control copy of Bill of Entry for Warehousing in case of 100% EOU<div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="femock17q4" ID="femock17q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Exchange Control copy of Bill of Entry for home consumption<div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="femock17q4" ID="femock17q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Self certification cum declaration of Importer<div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="femock17q4" ID="femock17q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Post Appraisal Form<div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. One of the conditions by which AD Category-I Bank may accept, in lieu of EC copy of Bill of Entry for home consumption, a certificate from theCEO or auditor of the company is</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="femock17q5" ID="femock17q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Amount of foreign exchange remitted is less than USD 1,000,000<div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="femock17q5" ID="femock17q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Amount of foreign exchange remitted is less than USD 100,000<div id="5bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5c" NAME="femock17q5" ID="femock17q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Amount of foreign exchange remitted is less than USD 500,000`<div id="5ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5d" NAME="femock17q5" ID="femock17q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Amount of foreign exchange remitted is less than USD 750,000<div id="5dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. "Precious Metals" for import include</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="femock17q6" ID="femock17q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Platinum, Rhodium and Silver<div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="femock17q6" ID="femock17q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Does not include Rhodium<div id="6bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6c" NAME="femock17q6" ID="femock17q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Does not include Palladium<div id="6ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6d" NAME="femock17q6" ID="femock17q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Includes Rhenium<div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. Evidence of Import received at the branch has to be preserved by AD Category-I banks for a period of _____ year/s from date of its verification</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="femock17q7" ID="femock17q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 2 years<div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="femock17q7" ID="femock17q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 years<div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="femock17q7" ID="femock17q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 1 year<div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="femock17q7" ID="femock17q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 6 months<div id="7dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. Documentary Evidence of import should be submitted within _____ months from the date of remittance exceeding USD 100,000</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="femock17q8" ID="femock17q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3<div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="femock17q8" ID="femock17q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 6<div id="8bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8c" NAME="femock17q8" ID="femock17q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 9<div id="8ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8d" NAME="femock17q8" ID="femock17q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 12<div id="8dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. AD Category-I banks should acknowledge receipt of evidence of import by issuing acknowledgement slips containing all relevant particulars of shipment</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="femock17q9" ID="femock17q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> FALSE<div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="femock17q9" ID="femock17q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> TRUE<div id="9bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. For installation of equipment by Business Process Outsourcing (BPO)at their overseas site</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="femock17q10" ID="femock17q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Permission from RBI is required<div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="femock17q10" ID="femock17q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Permission from Ministry of Information Technology, GOI is required<div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="femock17q10" ID="femock17q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AD Category-I may allow permission<div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="femock17q10" ID="femock17q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Licence required from DGFT<div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. Evidence of Import received at the branch has to be preserved by AD Category I banks for a period of _____ year/s from date of its verification</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="femock17q11" ID="femock17q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 2 years<div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="femock17q11" ID="femock17q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 years<div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="femock17q11" ID="femock17q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 1 year<div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="femock17q11" ID="femock17q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 6 months<div id="11dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. AD Bank has been vested with powers to approve requests from borrowers for extension of matured but unpaid ECB, if</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="femock17q12" ID="femock17q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> No additional cost is incurred<div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="femock17q12" ID="femock17q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Lender’s consent is available<div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="femock17q12" ID="femock17q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Reporting requirements are fulfilled<div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="femock17q12" ID="femock17q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above<div id="12dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. A person resident in India means</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="femock17q13" ID="femock17q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A person who has come to India or who stays in India for or on taking up employment<div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="femock17q13" ID="femock17q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A person who has come to or stays in India for carrying  on  a business or vocation in India<div id="13bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13c" NAME="femock17q13" ID="femock17q13c" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> A person who has come to India  for any other purposes and  circumstances show that he has an intention of staying in India for an uncertain period<div id="13ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13d" NAME="femock17q13" ID="femock17q13d" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the  above<div id="13dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. Drawal of foreign exchange which has the effect of creating foreign exchange liability can be effected by an authorized person through</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="femock17q14" ID="femock17q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> By opening Letter of Credit<div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="femock17q14" ID="femock17q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Use of International Credit or Debit Card<div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="femock17q14" ID="femock17q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B) above<div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="femock17q14" ID="femock17q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="14dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. Exchange facility for transactions which require prior approval from the Ministry/Department of Government of India has been included</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="femock17q15" ID="femock17q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In Schedule 1 <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="femock17q15" ID="femock17q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> In schedule II<div id="15bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15c" NAME="femock17q15" ID="femock17q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> In schedule III<div id="15ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15d" NAME="femock17q15" ID="femock17q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="15dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. Entitlement of a resident individual under LRS, going abroad for Business Visit is</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="femock17q16" ID="femock17q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 25000.00 per visit<div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="femock17q16" ID="femock17q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 100000.00 per financial annum<div id="16bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16c" NAME="femock17q16" ID="femock17q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 125000.00 per financial annum<div id="16ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16d" NAME="femock17q16" ID="femock17q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 250000.00 per financial annum<div id="16dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. Remittance under LRS for investment in units of Mutual Funds, Venture Capital Funds, Unrated debt securities, Promissory notes, etc. is permitted without the approval of RBI</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="femock17q17" ID="femock17q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True<div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="femock17q17" ID="femock17q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="17bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. For which of the following purposes remittances under LRS is prohibited?</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="femock17q18" ID="femock17q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Gift<div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="femock17q18" ID="femock17q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Emigration<div id="18bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18c" NAME="femock17q18" ID="femock17q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Employment<div id="18ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18d" NAME="femock17q18" ID="femock17q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Margins or margin calls to overseas exchanges/ overseas counterparty<div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. When RBI has announced the Liberalized Remittance Scheme (LRS)? </b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="femock17q19" ID="femock17q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Feb-2004<div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="femock17q19" ID="femock17q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Nov-2005<div id="19bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19c" NAME="femock17q19" ID="femock17q19c" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Oct-2004<div id="19ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19d" NAME="femock17q19" ID="femock17q19d" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Oct-2005<div id="19dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. Entitlement of a resident individual under LRS, going abroad on a Private visit is</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="femock17q20" ID="femock17q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 75000<div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="femock17q20" ID="femock17q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 100000<div id="20bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20c" NAME="femock17q20" ID="femock17q20c" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 125000<div id="20ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20d" NAME="femock17q20" ID="femock17q20d" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 250000<div id="20dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. Remittances to among following countries are not permitted</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="femock17q21" ID="femock17q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> NATO Countries<div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="femock17q21" ID="femock17q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> NAM Countries<div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="femock17q21" ID="femock17q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> NCCT Countries<div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="femock17q21" ID="femock17q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> GCC Countries<div id="21dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. Any resident individual may remit up-to USD _____ in one FY as gift to a person residing outside India or as donation to an organization outside India</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="femock17q22" ID="femock17q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 2,50,000<div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="femock17q22" ID="femock17q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 1,50,000<div id="22bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22c" NAME="femock17q22" ID="femock17q22c" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 2,00,000<div id="22ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22d" NAME="femock17q22" ID="femock17q22d" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B)<div id="22dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. Extending loans including loans in Indian Rupees to Non-resident Indians (NRIs) who are relatives as defined in Companies Act _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="femock17q23" ID="femock17q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 1954<div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="femock17q23" ID="femock17q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 1956<div id="23bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23c" NAME="femock17q23" ID="femock17q23c" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 1958<div id="23ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23d" NAME="femock17q23" ID="femock17q23d" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 1970<div id="23dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. Entitlement of a resident individual under LRS, to remit abroad for maintenance of Close Relative is:</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="femock17q24" ID="femock17q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 75000.00 per financial annum<div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="femock17q24" ID="femock17q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 100000.00 per financial annum<div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="femock17q24" ID="femock17q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 125000.00 per financial annum<div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="femock17q24" ID="femock17q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 250000.00 per financial annum<div id="24dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe17-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. Entitlement under LRS is</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock17q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="femock17q25" ID="femock17q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> per month<div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="femock17q25" ID="femock17q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> per quarter<div id="25bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25c" NAME="femock17q25" ID="femock17q25c" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> per annum<div id="25ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25d" NAME="femock17q25" ID="femock17q25d" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> per transaction<div id="25dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-3" style="display: none" id="fe17-status">
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