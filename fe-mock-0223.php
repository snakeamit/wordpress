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
  <title>FE-Mock24 | IBR Live</title>
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
				
				for(var j=1; j<=100; j++){
				  var tempItem1;
				  var tempItem2;
				  
				  tempItem1="q"+i+"status";
				  tempItem2="femock24q"+i;
				  
  				  localStorage.removeItem(tempItem1); 
				  localStorage.removeItem(tempItem2);
				  clearTimeout(myTimer);
				}
                var tid; 
                for(var j=1; j<=100; j++){
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
				localStorage.setItem("min", parseInt(119));
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
			var nid="fe24-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("fe24-status").style.display = "block";
			document.getElementById("fe24-guide").style.display = "none";  
			document.getElementById("fe24-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=100;i++){
				qhid = "fe24-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
            if(parseInt(localStorage.getItem("started"))==parseInt(223)){

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
		
            document.getElementById("fe24-q1").style.display = "block"; 
			document.getElementById("fe24-status").style.display = "block";
			document.getElementById("fe24-guide").style.display = "none"; 
			document.getElementById("fe24-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));		
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(223)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "femock24q"+qno;
			  
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
                        
			for(i=1; i<=100; i++){
				qtochange="q"+i+"status"; 
				idtochange="status"+i;
				
				if(!localStorage.getItem(qtochange)){
					localStorage.setItem(qtochange, "round-button");
					document.getElementById(idtochange).className = localStorage.getItem(qtochange);
				}else{
					//localStorage.setItem(qtochange, "round-button-ans");
					document.getElementById(idtochange).className = localStorage.getItem(qtochange);
				}
				
				qval = "femock24q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "femock24q"+i+"a"; tcheckb = "femock24q"+i+"b"; tcheckc = "femock24q"+i+"c"; tcheckd = "femock24q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "femock24q"+i+"a"; tcheckb = "femock24q"+i+"b"; tcheckc = "femock24q"+i+"c"; tcheckd = "femock24q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "femock24q"+i+"a"; tcheckb = "femock24q"+i+"b"; tcheckc = "femock24q"+i+"c"; tcheckd = "femock24q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "femock24q"+i+"a"; tcheckb = "femock24q"+i+"b"; tcheckc = "femock24q"+i+"c"; tcheckd = "femock24q"+i+"d";
						
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
			$.post('testfe100', {
				data: userans
			}, function(response) {
                var res = response.split("-");
                var tval=0;
                var tstr;
                var tci;

				document.getElementById("endscore").innerHTML = "<font style='color:black; background:#ADFF2F; padding:10px;'><b>Your Score: </b>"+res[0]+"/100";

                for(var j=0; j<=99; j++){
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
            for(var j=1; j<=100; j++){
                tid="endexam"+j;
			    document.getElementById(tid).style.display = "none"; 
            }
			
			for(var i=1;i<=100;i++){
				tLabel = "femock24q"+i;
				val = localStorage.getItem(tLabel); 						
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('24'); //test-023
			
			document.getElementById("starttime").style.display = "none";
			document.getElementById("showtime").style.display = "none";	
			document.getElementById("endscore").style.display = "block";
			document.getElementById("reexam").style.display = "block";

			localStorage.removeItem("starttime");
			localStorage.removeItem("min"); 
			localStorage.removeItem("sec"); 
			
			
			for(var j=1; j<=100; j++){
			  var tempItem1;
			  var tempItem2;			  
			  
			  tempItem1="q"+j+"status";
			  tempItem2="femock24q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>IIBF's Certificate Course in Foreign Exchange - Mock Test 24</b></p>
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
          <div class="nav-tabs-custom" id="fe24-guide">
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
				<li class="fli"> Duration of Test: 2 hours. Total questions: 100. Marks: 1 mark per question.</li>
				<li class="fli"> There is no negative marking.</li>
				<li class="fli"> The passing score on the examination is 50%</li>
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for <b>IIBF's Certificate Course in Foreign Exchange</b> examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('223')">Take the Test</button></li>
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
          <div class="box box-solid " id="fe24-tut">
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
              <button class="btn btn-primary" onclick="location.href='fe-mock-0222'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button> 		  
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
			  <button class="btn btn-primary" onclick="location.href='fe-mock-0224'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i> </button>       
            </div>
          </div>
        </section>
	
		<section class="col-lg-12" style="display:none" id="fe24-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. DGFT comes under purview of which ministry</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="femock24q1" ID="femock24q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Ministry of Finance <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="femock24q1" ID="femock24q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ministry of Home Affairs <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="femock24q1" ID="femock24q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Ministry of Commerce & Industry <div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="femock24q1" ID="femock24q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None. It is independent organization <div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="next"><button class="btn btn-primary" onclick="showQ('2')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                      
                      <li class="" id="endexam1"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. By whom the regulations relating to export of goods and services from India have been notified?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="femock24q2" ID="femock24q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> RBI <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="femock24q2" ID="femock24q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Government of India <div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="femock24q2" ID="femock24q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> SEBI <div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="femock24q2" ID="femock24q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="2dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('1')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam2"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('3')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. Where are the instructions regarding use of Indian Rupee in trade transactions, non-resident importers and exporters to hedge their currency risk in respect of exports from and imports to India invoiced in Indian Currency contained?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="femock24q3" ID="femock24q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Part-I Forward Contracts <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="femock24q3" ID="femock24q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Part-II Forward Contracts <div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="femock24q3" ID="femock24q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Part-III forward contracts <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="femock24q3" ID="femock24q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('2')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam3"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('4')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. By whom the EDF (Export Declaration Form) for export of goods or software are completed?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="femock24q4" ID="femock24q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Importer <div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="femock24q4" ID="femock24q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Exporter <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="femock24q4" ID="femock24q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AD Bank <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="femock24q4" ID="femock24q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('3')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam4"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('5')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. The transactions related to documents negotiated / sent for collection by AD Category-I bank are reported through R-Supplementary Return to:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="femock24q5" ID="femock24q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Govt. of India <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="femock24q5" ID="femock24q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Reserve Bank of India (RBI) <div id="5bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5c" NAME="femock24q5" ID="femock24q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> SEBI <div id="5ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5d" NAME="femock24q5" ID="femock24q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="5dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('4')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam5"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('6')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. For Mid-sea Trans-shipment of catches by Indian Owned Deep Sea Vessels, the norms to be followed have been prescribed by:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="femock24q6" ID="femock24q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Reserve Bank of India <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="femock24q6" ID="femock24q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ministry of Agriculture, GOI <div id="6bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6c" NAME="femock24q6" ID="femock24q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Finance Ministry, GOI <div id="6ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6d" NAME="femock24q6" ID="femock24q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('5')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam6"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('7')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. The requirement of declaration of export of goods and software in the prescribed form is not applicable to:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="femock24q7" ID="femock24q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Trade samples of goods and publicity material supplied free of cost <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="femock24q7" ID="femock24q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Gift of goods declared by exporter not more than five lakhs rupees in value <div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="femock24q7" ID="femock24q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Goods imported free of cost on re-export basis <div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="femock24q7" ID="femock24q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="7dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('6')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam7"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('8')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. The receipt of foreign exchange against payment for export from India to Nepal and Bhutan cannot be:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="femock24q8" ID="femock24q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In Indian Rupees <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="femock24q8" ID="femock24q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> In free foreign exchange if permitted by Nepal Rashtra Bank <div id="8bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8c" NAME="femock24q8" ID="femock24q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> By debit to ACU Dollar / Euro Account in India of a Bank of member country <div id="8ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8d" NAME="femock24q8" ID="femock24q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="8dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('7')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam8"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('9')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. Units in SEZs, Status Holder Exporters, EOUs, Units in EHTPs, STPs & BTPs can realise export payments within</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="femock24q9" ID="femock24q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The period prescribed by RBI <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="femock24q9" ID="femock24q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> No stipulation regarding the time limit by RBI as they occupy special status <div id="9bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9c" NAME="femock24q9" ID="femock24q9c" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> (A) and (B) above <div id="9ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9d" NAME="femock24q9" ID="femock24q9d" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> The period prescribed by DGFT <div id="9dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('8')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam9"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('10')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. Following is not a feature of OPGSP is a system where </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="femock24q10" ID="femock24q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Where export realizations can be received up to USD 10,000 only <div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="femock24q10" ID="femock24q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A NOSTRO collection account is opened for receipt of the export related payments facilitated through such arrangements <div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="femock24q10" ID="femock24q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Permissible debits to NOSTRO collection account are for repatriation of funds representing export proceeds to India <div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="femock24q10" ID="femock24q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Where export realizations can be received upto USD 100,000 only  <div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('9')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam10"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('11')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. Counter Trade proposals involving adjustment of value of goods imported against value of exports through an Escrow account is permitted by </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="femock24q11" ID="femock24q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Reserve Bank of India <div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="femock24q11" ID="femock24q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Directorate General of Foreign Trade <div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="femock24q11" ID="femock24q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> (B) only <div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="femock24q11" ID="femock24q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="11dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe24-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. Choose the incorrect statement. Exchange Earners’ Foreign Currency (EEFC) Account </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="femock24q12" ID="femock24q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Can be opened by a non-resident <div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="femock24q12" ID="femock24q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Can be opened by a resident of India <div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="femock24q12" ID="femock24q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Can be opened jointly with close relatives <div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="femock24q12" ID="femock24q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Can be opened with any AD Category - I bank in India <div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('11')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam12"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('13')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. A person resident in India being a project / service exporter may open, hold and maintain foreign currency account with a bank outside or in India </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="femock24q13" ID="femock24q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> with RBI permission <div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="femock24q13" ID="femock24q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Subject to the standard terms and conditions in the Memorandum PEM <div id="13bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13c" NAME="femock24q13" ID="femock24q13c" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> (A) only <div id="13ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13d" NAME="femock24q13" ID="femock24q13d" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="13dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('12')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam13"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('14')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. When a SEZ unit does netting off of export receivables against import payments </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="femock24q14" ID="femock24q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Netted amount is only reported as purchase or sale as the case may be in R return <div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="femock24q14" ID="femock24q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Both the transactions of sale and purchase are reported separately in R return <div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="femock24q14" ID="femock24q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Netting off not allowed under FEMA <div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="femock24q14" ID="femock24q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Netting off allowed only to EPZ <div id="14dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('13')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam14"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('15')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. In case of Goods exported to a warehouse established outside India, realization should be within __________months from the date of shipment of goods. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="femock24q15" ID="femock24q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 12 <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="femock24q15" ID="femock24q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 6 <div id="15bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15c" NAME="femock24q15" ID="femock24q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 9 <div id="15ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15d" NAME="femock24q15" ID="femock24q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 15 <div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('14')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam15"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('16')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. Short Shipment means </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="femock24q16" ID="femock24q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Shipment has to reach in a short time <div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="femock24q16" ID="femock24q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Shipment has been made for lesser than the Invoice value <div id="16bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16c" NAME="femock24q16" ID="femock24q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Shipment can be made in short instalments <div id="16ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16d" NAME="femock24q16" ID="femock24q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Shipment is in small vessels <div id="16dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('15')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam16"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('17')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. In case of self-write-off, exporter should submit which of the following to the concerned AD Bank?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="femock24q17" ID="femock24q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Chartered Accountant's certificate <div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="femock24q17" ID="femock24q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A self-certification to AD Category-I bank <div id="17bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17c" NAME="femock24q17" ID="femock24q17c" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> (A) and (B) both <div id="17ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17d" NAME="femock24q17" ID="femock24q17d" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Not allowed by RBI under FEMA <div id="17dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('16')" style="float:left">&#8656; BACK</button></li>
					  <li class="next" id="endexam17"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
					  <li class="next"><button class="btn btn-primary" onclick="showQ('18')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. "Netting off" of export receivables against import payments </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="femock24q18" ID="femock24q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Allowed for Units in Special Economic Zones (SEZs)<div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="femock24q18" ID="femock24q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Allowed for ACU countries <div id="18bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18c" NAME="femock24q18" ID="femock24q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> (A) only <div id="18ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18d" NAME="femock24q18" ID="femock24q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('17')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam18"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('19')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. Find out the correct statement </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="femock24q19" ID="femock24q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The Shipping Bill No. on the SDF form need not be the same as that appearing on the Bill of Lading <div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="femock24q19" ID="femock24q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The Shipping Bill No. on the SDF form need not appear on the Bill of Lading <div id="19bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19c" NAME="femock24q19" ID="femock24q19c" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The Shipping Bill No. on the SDF form should be the same as that appearing on the Bill of Lading <div id="19ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19d" NAME="femock24q19" ID="femock24q19d" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> The Shipping Bill No. should be mentioned on all the export documents <div id="19dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('18')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam19"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('20')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. If exported goods are found defective and re-imported, export proceeds can be refunded after </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="femock24q20" ID="femock24q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exercising due diligence regarding the track record of the importer <div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="femock24q20" ID="femock24q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Verifying the bona-fides of the transactions <div id="20bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20c" NAME="femock24q20" ID="femock24q20c" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Obtaining a certificate issued by overseas authorities <div id="20ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20d" NAME="femock24q20" ID="femock24q20d" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Self certification of the exporter <div id="20dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('19')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam20"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('21')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. Which of the following statement is incorrect? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="femock24q21" ID="femock24q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> EDF has replaced erstwhile GR/PP forms <div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="femock24q21" ID="femock24q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> EDF is used for declaration of export of Goods at Non-EDI ports. <div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="femock24q21" ID="femock24q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> EDF form is submitted in duplicate to the Customs by the exporter <div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="femock24q21" ID="femock24q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> EDF has replaced SOFTEX form <div id="21dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('20')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam21"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('22')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. A consolidated statement submitted by AD to RBI giving details of all export bills outstanding beyond six months from the date of export as at the end of June and December every year is known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="femock24q22" ID="femock24q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> EDF <div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="femock24q22" ID="femock24q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SDF <div id="22bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22c" NAME="femock24q22" ID="femock24q22c" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> SOFTEX <div id="22ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22d" NAME="femock24q22" ID="femock24q22d" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> XOS <div id="22dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('21')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam22"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('23')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. If bill amount is reduced for any reason after it has been negotiated or sent for collection, AD Category - I banks may approve such reduction, </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="femock24q23" ID="femock24q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> If it is satisfied about the genuineness of the request <div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="femock24q23" ID="femock24q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The reduction does not exceed 30 per cent of invoice value:<div id="23bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23c" NAME="femock24q23" ID="femock24q23c" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The exporter is advised to surrender proportionate export incentives availed of, if any. <div id="23ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23d" NAME="femock24q23" ID="femock24q23d" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (C) <div id="23dcheck" style="display: inline-block;"></div><BR/>
					<BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('22')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam23"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('24')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. The Reserve Bank of India has permitted the AD Category - I banks to extend the period of realization of export proceeds beyond_______months from the date of export, up to a period of ________ months, at a time, irrespective of the invoice value of the export subject to the following conditions: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="femock24q24" ID="femock24q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 12 and 6 <div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="femock24q24" ID="femock24q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 9 and 6 <div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="femock24q24" ID="femock24q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 6 and 3 <div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="femock24q24" ID="femock24q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 6 and 6 <div id="24dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('23')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam24"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('25')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>		
		
		<section class="col-lg-12" style="display:none" id="fe24-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. Export trade is regulated by </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="femock24q25" ID="femock24q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Ministry of Finance under Govt. of India<div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="femock24q25" ID="femock24q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Reserve Bank of India under Ministry of Commerce <div id="25bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25c" NAME="femock24q25" ID="femock24q25c" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Directorate General of Foreign Trade under Ministry of Commerce, GOI <div id="25ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25d" NAME="femock24q25" ID="femock24q25d" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Foreign Trade Department in Reserve Bank of India under Ministry of Commerce, GOI <div id="25dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('24')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam25"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('26')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q26">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 26. While making scrutiny of declaration from the AD Bank should verify that: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q26">
					<INPUT TYPE="RADIO" VALUE="26a" NAME="femock24q26" ID="femock24q26a" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The number of the duplicate copy of the EDF from is the same as that of original <div id="26acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="26b" NAME="femock24q26" ID="femock24q26b" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The shipping bill number is the same as that appearing in the Bill of Lading <div id="26bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26c" NAME="femock24q26" ID="femock24q26c" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The copy of the EDF form has been duly verified and authenticated by custom authorities <div id="26ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26d" NAME="femock24q26" ID="femock24q26d" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="26dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('25')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam26"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('27')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q27">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 27. In certain lines of export trade, it is the practice to leave a small part of the invoice value undrawn for payment after adjustment due to difference in weight, quality etc. What is that small part? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q27">
					<INPUT TYPE="RADIO" VALUE="27a" NAME="femock24q27" ID="femock24q27a" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 5% of Full Export Value <div id="27acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="27b" NAME="femock24q27" ID="femock24q27b" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 10% of Full Export Value <div id="27bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27c" NAME="femock24q27" ID="femock24q27c" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 15% of full export value <div id="27ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27d" NAME="femock24q27" ID="femock24q27d" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="27dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('26')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam27"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('28')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q28">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 28. In the case of bills remains outstanding beyond the due date for payment from the date of export, the matter should be reported to: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q28">
					<INPUT TYPE="RADIO" VALUE="28a" NAME="femock24q28" ID="femock24q28a" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Ministry of Finance, Govt.  of India <div id="28acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="28b" NAME="femock24q28" ID="femock24q28b" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ministry of External Affairs <div id="28bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28c" NAME="femock24q28" ID="femock24q28c" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Reserve Bank of India <div id="28ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28d" NAME="femock24q28" ID="femock24q28d" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="28dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('27')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam28"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('29')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q29">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 29. The Reduction in invoice value of the bill negotiated or sent for collection is permitted by AD category bank if: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q29">
					<INPUT TYPE="RADIO" VALUE="29a" NAME="femock24q29" ID="femock24q29a" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The reduction does not exceed 25% of invoice value <div id="29acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="29b" NAME="femock24q29" ID="femock24q29b" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> To allow overseas buyer cash discount for prepayment of the usance bills <div id="29bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29c" NAME="femock24q29" ID="femock24q29c" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> It does not relate to an export of commodities subject to floor price stipulations <div id="29ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29d" NAME="femock24q29" ID="femock24q29d" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above  <div id="29dcheck" style="display: inline-block;"></div><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('28')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam29"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('30')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q30">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 30. AD Category-1 Banks with the permission of RBI can extend the period of realization of export proceeds beyond stipulated period of realization from the date of export up to a period of: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q30">
					<INPUT TYPE="RADIO" VALUE="30a" NAME="femock24q30" ID="femock24q30a" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 months at a time <div id="30acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="30b" NAME="femock24q30" ID="femock24q30b" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 6 months at a time <div id="30bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30c" NAME="femock24q30" ID="femock24q30c" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 9 months at a time <div id="30ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30d" NAME="femock24q30" ID="femock24q30d" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="30dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('29')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam30"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('31')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q31">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 31. The right of "Set-Off" is available to AD category-1 Banks from export receivables against import payables in respect of: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q31">
					<INPUT TYPE="RADIO" VALUE="31a" NAME="femock24q31" ID="femock24q31a" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The overseas buyer and supplier are the same and consent of set-off is obtained from him <div id="31acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="31b" NAME="femock24q31" ID="femock24q31b" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Both the transactions of sale and purchase have been reported separately in’R’returns <div id="31bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31c" NAME="femock24q31" ID="femock24q31c" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The import is as per the Foreign Trade Policy in force <div id="31ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31d" NAME="femock24q31" ID="femock24q31d" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="31dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('30')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam31"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('32')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q32">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 32. Import trade is regulated by: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q32">
					<INPUT TYPE="RADIO" VALUE="32a" NAME="femock24q32" ID="femock24q32a" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Directorate General of Foreign Trade (DGFT) <div id="32acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="32b" NAME="femock24q32" ID="femock24q32b" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ministry of external affairs <div id="32bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32c" NAME="femock24q32" ID="femock24q32c" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Reserve Bank of India <div id="32ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32d" NAME="femock24q32" ID="femock24q32d" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="32dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('31')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam32"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('33')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q33">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 33. While undertaking Import Transactions, the AD Banks should ensure that imports into India are in conformity with: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q33">
					<INPUT TYPE="RADIO" VALUE="33a" NAME="femock24q33" ID="femock24q33a" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Foreign Trade Policy in force <div id="33acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="33b" NAME="femock24q33" ID="femock24q33b" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign Exchange Management Rules  2000 <div id="33bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="33c" NAME="femock24q33" ID="femock24q33c" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Directions issued by RBI under FEMA, 1999<div id="33ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="33d" NAME="femock24q33" ID="femock24q33d" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="33dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('32')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam33"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('34')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q34">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 34. AD Banks can freely open letters of credit and allow remittances for import of goods without Import License if such goods are: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q34">
					<INPUT TYPE="RADIO" VALUE="34a" NAME="femock24q34" ID="femock24q34a" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Not included in the restrictive list requiring license under the FTP in force on the basis of licenses marked ‘for exchange control purposes’ <div id="34acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="34b" NAME="femock24q34" ID="femock24q34b" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Included in the restrictive list requiring license under the FTP in force <div id="34bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34c" NAME="femock24q34" ID="femock24q34c" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> All type of goods <div id="34ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34d" NAME="femock24q34" ID="femock24q34d" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="34dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('33')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam34"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('35')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q35">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 35. In terms of instructions contained in FEMA-1999, it is obligatory on the part of person acquiring foreign exchange: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q35">
					<INPUT TYPE="RADIO" VALUE="35a" NAME="femock24q35" ID="femock24q35a" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> To use it either for the purpose mentioned in the declaration made by him  <div id="35acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="35b" NAME="femock24q35" ID="femock24q35b" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> To use it for any other purpose for which acquisition is permissible under FEMA <div id="35bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35c" NAME="femock24q35" ID="femock24q35c" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Where foreign exchange acquired has been utilized for import of goods, the acquirer to furnish the proof of such import <div id="35ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35d" NAME="femock24q35" ID="femock24q35d" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="35dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('34')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam35"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('36')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q36">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 36. Advance remittance for import of goods is allowed by AD Bank: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q36">
					<INPUT TYPE="RADIO" VALUE="36a" NAME="femock24q36" ID="femock24q36a" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> If the importer is their customer and his account is fully compliant with RBI KYC/AML guidelines <div id="36acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="36b" NAME="femock24q36" ID="femock24q36b" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The Importer hold the EC copy of a valid Import License under the Foreign Trade Policy in force <div id="36bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36c" NAME="femock24q36" ID="femock24q36c" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No RBI Permission is required if the remittance for import of goods is up to  US $ 200,000 <div id="36ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36d" NAME="femock24q36" ID="femock24q36d" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="36dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('35')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam36"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('37')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q37">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 37. The limit of advance remittance without bank guarantee in case of import of Aircrafts, Helicopters and Other aviation related purpose is: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q37">
					<INPUT TYPE="RADIO" VALUE="37a" NAME="femock24q37" ID="femock24q37a" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Up to US $ 10 Million <div id="37acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="37b" NAME="femock24q37" ID="femock24q37b" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Up to US $ 50 Million <div id="37bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="37c" NAME="femock24q37" ID="femock24q37c" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Up to US $ 100 Million <div id="37ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="37d" NAME="femock24q37" ID="femock24q37d" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="37dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('36')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam37"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('38')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q38">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 38. GJEPC stands for </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q38">
					<INPUT TYPE="RADIO" VALUE="38a" NAME="femock24q38" ID="femock24q38a" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Gujrat Jewellery Export Promotion Council <div id="38acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="38b" NAME="femock24q38" ID="femock24q38b" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Gems and Jewellery Export Promotion Council <div id="38bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38c" NAME="femock24q38" ID="femock24q38c" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gujrat Jewellery Export Products Council <div id="38ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38d" NAME="femock24q38" ID="femock24q38d" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gujrat Jewellery Export Products Council <div id="38dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('37')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam38"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('39')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q39">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 39. Authorized dealers may allow payment of interest on import usance bills or overdue interest for import of capital goods maximum for a period of </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q39">
					<INPUT TYPE="RADIO" VALUE="39a" NAME="femock24q39" ID="femock24q39a" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Up to six months <div id="39acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="39b" NAME="femock24q39" ID="femock24q39b" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Up to 1 year <div id="39bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39c" NAME="femock24q39" ID="femock24q39c" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Up to 2 years<div id="39ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39d" NAME="femock24q39" ID="femock24q39d" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Up to 3 years <div id="39dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('38')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam39"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('40')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q40">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 40. Among other directives, Import Trade is also regulated by </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q40">
					<INPUT TYPE="RADIO" VALUE="40a" NAME="femock24q40" ID="femock24q40a" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Foreign Exchange Management (Import) Rules 2000 <div id="40acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="40b" NAME="femock24q40" ID="femock24q40b" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign Exchange Management (Trade Transactions) Rules 2000<div id="40bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40c" NAME="femock24q40" ID="femock24q40c" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Foreign Exchange Management (Current Account Transactions) Rules 2000 <div id="40ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40d" NAME="femock24q40" ID="femock24q40d" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Foreign Exchange Management (Import and Export) Rules 2000 <div id="40dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('39')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam40"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('41')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q41">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 41. CDF form is required at the Customs Authorities at the Airport to declare foreign exchange if </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q41">
					<INPUT TYPE="RADIO" VALUE="41a" NAME="femock24q41" ID="femock24q41a" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Aggregate value of Travellers Cheques, Currency note, Bank notes exceeds USD 10,000 <div id="41acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="41b" NAME="femock24q41" ID="femock24q41b" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Aggregate value of foreign Currency note exceeds USD 5,000 <div id="41bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41c" NAME="femock24q41" ID="femock24q41c" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> CDF is an export declaration form<div id="41ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41d" NAME="femock24q41" ID="femock24q41d" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="41dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('40')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam41"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('42')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q42">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 42. Deferred Payment arrangement includes </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q42">
					<INPUT TYPE="RADIO" VALUE="42a" NAME="femock24q42" ID="femock24q42a" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Suppliers' Credit<div id="42acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="42b" NAME="femock24q42" ID="femock24q42b" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Buyers' Credit <div id="42bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42c" NAME="femock24q42" ID="femock24q42c" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B)<div id="42ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42d" NAME="femock24q42" ID="femock24q42d" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Letter of Credit <div id="42dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('41')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam42"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('43')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q43">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 43. For import of goods included in the negative list, a licence is required </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q43">
					<INPUT TYPE="RADIO" VALUE="43a" NAME="femock24q43" ID="femock24q43a" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Under UCPDC <div id="43acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="43b" NAME="femock24q43" ID="femock24q43b" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Under URC <div id="43bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43c" NAME="femock24q43" ID="femock24q43c" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Under the Foreign Trade Policy in force <div id="43ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43d" NAME="femock24q43" ID="femock24q43d" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="43dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('42')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam43"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('44')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q44">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 44. As a sector specific measure, airline companies which have been permitted by the Directorate General of Civil Aviation to operate as a schedule air transport service, can make advance remittance without bank guarantee, up to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q44">
					<INPUT TYPE="RADIO" VALUE="44a" NAME="femock24q44" ID="femock24q44a" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 5 million <div id="44acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="44b" NAME="femock24q44" ID="femock24q44b" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 50 million <div id="44bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44c" NAME="femock24q44" ID="femock24q44c" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 20 million <div id="44ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44d" NAME="femock24q44" ID="femock24q44d" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 100 million <div id="44dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('43')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam44"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('45')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q45">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 45. CDF is the format used to declare to Custom authorities foreign exchange brought into India (beyond a certain limit) in the form of </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q45">
					<INPUT TYPE="RADIO" VALUE="45a" NAME="femock24q45" ID="femock24q45a" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Currency Notes, Travellers Cheques or Bank Notes<div id="45acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="45b" NAME="femock24q45" ID="femock24q45b" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> TravellersCheques, Coins or Bitcoins <div id="45bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45c" NAME="femock24q45" ID="femock24q45c" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bank Notes and Bitcoins <div id="45ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45d" NAME="femock24q45" ID="femock24q45d" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Rupee Drafts, Rupees brought into India and FC Notes<div id="45dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('44')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam45"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('46')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q46">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 46. If the amount of advance remittance exceeds USD 200,000 or its equivalent </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q46">
					<INPUT TYPE="RADIO" VALUE="46a" NAME="femock24q46" ID="femock24q46a" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> An unconditional, irrevocable standby Letter of Credit is required <div id="46acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="46b" NAME="femock24q46" ID="femock24q46b" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A bank guarantee is required from an international bank of repute situated outside India <div id="46bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46c" NAME="femock24q46" ID="femock24q46c" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> A guarantee of an AD Category - I bank in India, if such a guarantee is issued against the counter-guarantee of an international bank of repute situated outside India  <div id="46ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46d" NAME="femock24q46" ID="femock24q46d" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Any one of (A), (B) or (C) required <div id="46dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('45')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam46"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('47')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q47">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 47. AD Category - I bank may allow advance remittance to Public Sector Company or a Department/ Undertaking of the Government of India/ State Governments for import of services without any bank guarantee up to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q47">
					<INPUT TYPE="RADIO" VALUE="47a" NAME="femock24q47" ID="femock24q47a" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 100,000<div id="47acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="47b" NAME="femock24q47" ID="femock24q47b" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 500,000 <div id="47bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47c" NAME="femock24q47" ID="femock24q47c" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 1000,000 <div id="47ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47d" NAME="femock24q47" ID="femock24q47d" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 2,00,000 <div id="47dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('46')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam47"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('48')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q48">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 48. Any person coming into India from any place outside India (Other than Nepal and Bhutan) can bring currency notes of GOI and RBI up to an amount not exceeding </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q48">
					<INPUT TYPE="RADIO" VALUE="48a" NAME="femock24q48" ID="femock24q48a" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Rs. 10,000 <div id="48acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="48b" NAME="femock24q48" ID="femock24q48b" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Rs. 50,000 <div id="48bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="48c" NAME="femock24q48" ID="femock24q48c" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Rs. 25,000 <div id="48ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="48d" NAME="femock24q48" ID="femock24q48d" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Rs. 1,000 <div id="48dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('47')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam48"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('49')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q49">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 49. In case of Merchanting Trade transactions bank can give </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q49">
					<INPUT TYPE="RADIO" VALUE="49a" NAME="femock24q49" ID="femock24q49a" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Supplier's credit <div id="49acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="49b" NAME="femock24q49" ID="femock24q49b" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Buyers'Credit <div id="49bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49c" NAME="femock24q49" ID="femock24q49c" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Either Buyers' or Suppliers' credit depending upon requirement <div id="49ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49d" NAME="femock24q49" ID="femock24q49d" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> No such credit can be given <div id="49dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('48')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam49"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('50')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q50">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 50. Evidence of Import does not include </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q50">
					<INPUT TYPE="RADIO" VALUE="50a" NAME="femock24q50" ID="femock24q50a" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exchange Control copy of Bill of Entry for Warehousing in case of 100% EOU <div id="50acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="50b" NAME="femock24q50" ID="femock24q50b" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Exchange Control copy of Bill of Entry for home consumption <div id="50bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50c" NAME="femock24q50" ID="femock24q50c" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Self certification cum declaration of Importer <div id="50ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50d" NAME="femock24q50" ID="femock24q50d" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Post Appraisal Form <div id="50dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('49')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam50"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('51')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q51">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 51. Remittance on winding up of companies out of assets of Indian companies under liquidation under the provision of Companies Act 1956 is allowed by AD Bank subject to: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q51">
					<INPUT TYPE="RADIO" VALUE="51a" NAME="femock24q51" ID="femock24q51a" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Remittance is in compliance with the order issued by a court in India/order issued by official liquidator<div id="51acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="51b" NAME="femock24q51" ID="femock24q51b" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> No objection or Tax clearance certificate from Income Tax Authority is submitted<div id="51bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51c" NAME="femock24q51" ID="femock24q51c" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Auditor’s certificate confirming that all liabilities in India has been fully paid/adequately provided for <div id="51ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51d" NAME="femock24q51" ID="femock24q51d" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="51dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('50')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam51"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('52')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q52">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 52. The individual limits of ECB that can be raised by companies in software development sectors per financial year under the automatic route is: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q52">
					<INPUT TYPE="RADIO" VALUE="52a" NAME="femock24q52" ID="femock24q52a" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Up to USD 750 Million <div id="52acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="52b" NAME="femock24q52" ID="femock24q52b" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Up to USD 500 Million <div id="52bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52c" NAME="femock24q52" ID="femock24q52c" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Up to USD 200 Million <div id="52ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52d" NAME="femock24q52" ID="femock24q52d" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Up to USD 100 Million <div id="52dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('51')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam52"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('53')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q53">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 53. Conversion of ECB into equity is permitted subject to: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q53">
					<INPUT TYPE="RADIO" VALUE="53a" NAME="femock24q53" ID="femock24q53a" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The activity of the borrowing company is covered under the automatic route for Foreign Direct Investment (FDI) <div id="53acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="53b" NAME="femock24q53" ID="femock24q53b" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Approval from the Foreign Promotion Board (FIPB) need not be obtained as per extant FDI policy <div id="53bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53c" NAME="femock24q53" ID="femock24q53c" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Applicable price guidelines for shares need not be complied with <div id="53ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53d" NAME="femock24q53" ID="femock24q53d" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="53dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('52')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam53"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('54')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q54">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 54. Minimum Average maturity period for startups to raise ECB under the automatic route is: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q54">
					<INPUT TYPE="RADIO" VALUE="54a" NAME="femock24q54" ID="femock24q54a" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 years <div id="54acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="54b" NAME="femock24q54" ID="femock24q54b" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 years <div id="54bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="54c" NAME="femock24q54" ID="femock24q54c" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 7 years <div id="54ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="54d" NAME="femock24q54" ID="femock24q54d" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 10 years <div id="54dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('53')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam54"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('55')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q55">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 55. Minimum original maturity period for Rupee denominated bonds raised above USD 50 million equivalents in INR per financial year will be: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q55">
					<INPUT TYPE="RADIO" VALUE="55a" NAME="femock24q55" ID="femock24q55a" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 years <div id="55acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="55b" NAME="femock24q55" ID="femock24q55b" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 years <div id="55bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55c" NAME="femock24q55" ID="femock24q55c" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 7 years <div id="55ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55d" NAME="femock24q55" ID="femock24q55d" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 10 years <div id="55dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('54')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam55"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('56')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q56">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 56. Overseas investments in joint ventures and wholly owned subsidiaries are an important avenue for: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q56">
					<INPUT TYPE="RADIO" VALUE="56a" NAME="femock24q56" ID="femock24q56a" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Promoting global business by Indian Entrepreneurs in terms of foreign exchange earnings <div id="56acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="56b" NAME="femock24q56" ID="femock24q56b" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Increased exports of Plant and Machinery and goods from India <div id="56bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56c" NAME="femock24q56" ID="femock24q56c" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Economic cooperation between India and other countries <div id="56ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56d" NAME="femock24q56" ID="femock24q56d" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="56dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('55')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam56"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('57')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q57">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 57. Direct Investment outside India is prohibited from: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q57">
					<INPUT TYPE="RADIO" VALUE="57a" NAME="femock24q57" ID="femock24q57a" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Making investment in foreign entity engaged in real estate without prior approval of RBI <div id="57acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="57b" NAME="femock24q57" ID="femock24q57b" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Development of townships, construction of residential/ commercial premises, roads or bridge  <div id="57bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57c" NAME="femock24q57" ID="femock24q57c" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Banking business with the prior approval of RBI <div id="57ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57d" NAME="femock24q57" ID="femock24q57d" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="57dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('56')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam57"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('58')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q58">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 58. Who cannot make direct investment in an overseas joint venture or wholly owned subsidiary outside India? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q58">
					<INPUT TYPE="RADIO" VALUE="58a" NAME="femock24q58" ID="femock24q58a" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Resident Individual <div id="58acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="58b" NAME="femock24q58" ID="femock24q58b" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Company incorporated in India <div id="58bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58c" NAME="femock24q58" ID="femock24q58c" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Registered Partnership firm <div id="58ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58d" NAME="femock24q58" ID="femock24q58d" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Registered Limited Liability Partnership (LLP) <div id="58dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('57')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam58"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('59')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q59">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 59. An Indian party can make direct investment in an overseas joint venture or wholly owned subsidiary outside India up to an extent of their net worth as on the date of last audited balance sheet</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q59">
					<INPUT TYPE="RADIO" VALUE="59a" NAME="femock24q59" ID="femock24q59a" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 100 % <div id="59acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="59b" NAME="femock24q59" ID="femock24q59b" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 200% <div id="59bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="59c" NAME="femock24q59" ID="femock24q59c" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 300% <div id="59ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="59d" NAME="femock24q59" ID="femock24q59d" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 400% <div id="59dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('58')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam59"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('60')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q60">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 60. Automatic route facility is not available for investment in: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q60">
					<INPUT TYPE="RADIO" VALUE="60a" NAME="femock24q60" ID="femock24q60a" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Nepal <div id="60acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="60b" NAME="femock24q60" ID="femock24q60b" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Bhutan <div id="60bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60c" NAME="femock24q60" ID="femock24q60c" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Pakistan <div id="60ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60d" NAME="femock24q60" ID="femock24q60d" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bangladesh <div id="60dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('59')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam60"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('61')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q61">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 61. Who empowers RBI to frame regulations to restrict, regulate and prohibit the maintenance of deposits between a resident in India and a person resident of India. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q61">
					<INPUT TYPE="RADIO" VALUE="61a" NAME="femock24q61" ID="femock24q61a" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> FEMA-1999 <div id="61acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="61b" NAME="femock24q61" ID="femock24q61b" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ministry of External Affairs, GOI <div id="61bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61c" NAME="femock24q61" ID="femock24q61c" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Ministry of Commerce and Industry, GOI <div id="61ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61d" NAME="femock24q61" ID="femock24q61d" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="61dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('60')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam61"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('62')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q62">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 62. Who is Person of Indian Origin (PIO)? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q62">
					<INPUT TYPE="RADIO" VALUE="62a" NAME="femock24q62" ID="femock24q62a" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A person resident outside India who is a citizen of any country except Pakistan or Bangladesh or any such country as specified by GOI <div id="62acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="62b" NAME="femock24q62" ID="femock24q62b" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Who is a citizen of India by virtue of the constitution of India or the Citizenship Act, 1955 <div id="62bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="62c" NAME="femock24q62" ID="femock24q62c" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Who is a child /grandchild /great grandchild  of a citizen of India or  a spouse of foreign origin of a citizen of India <div id="62ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="62d" NAME="femock24q62" ID="femock24q62d" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="62dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('61')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam62"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('63')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q63">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 63. Non-resident (External) account can be opened with authorized dealers and with banks authorized by RBI in the form of: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q63">
					<INPUT TYPE="RADIO" VALUE="63a" NAME="femock24q63" ID="femock24q63a" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Savings Bank <div id="63acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="63b" NAME="femock24q63" ID="femock24q63b" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Current Account <div id="63bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63c" NAME="femock24q63" ID="femock24q63c" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Term Deposit and Recurring Deposit <div id="63ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63d" NAME="femock24q63" ID="femock24q63d" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="63dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('62')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam63"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('64')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q64">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 64. FCNR (B) can be opened with authorized dealers and with banks authorized by RBI in the form of: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q64">
					<INPUT TYPE="RADIO" VALUE="64a" NAME="femock24q64" ID="femock24q64a" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Savings Bank <div id="64acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="64b" NAME="femock24q64" ID="femock24q64b" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Current Account <div id="64bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64c" NAME="femock24q64" ID="femock24q64c" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Recurring Deposit <div id="64ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64d" NAME="femock24q64" ID="femock24q64d" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Term Deposit  <div id="64dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('63')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam64"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('65')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q65">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 65. Non-resident (External) account in the form of Term Deposit can be opened for a period of: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q65">
					<INPUT TYPE="RADIO" VALUE="65a" NAME="femock24q65" ID="femock24q65a" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Less than 1 year <div id="65acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="65b" NAME="femock24q65" ID="femock24q65b" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> From 1 to 3 years <div id="65bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65c" NAME="femock24q65" ID="femock24q65c" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> More than 3 years <div id="65ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65d" NAME="femock24q65" ID="femock24q65d" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> More than 5 years <div id="65dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('64')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam65"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('66')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q66">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 66. The Authorized Dealers/Banks in India can grant loans against the security of funds held in NRE accounts to the account holder /third party in India. Which of the following statement is not true? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q66">
					<INPUT TYPE="RADIO" VALUE="66a" NAME="femock24q66" ID="femock24q66a" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The Loan can be without limit subject to usual margin requirements <div id="66acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="66b" NAME="femock24q66" ID="femock24q66b" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Loan amount can be repatriated outside India <div id="66bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="66c" NAME="femock24q66" ID="femock24q66c" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Loan can be used for acquiring flat / house in India for own residential use. <div id="66ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="66d" NAME="femock24q66" ID="femock24q66d" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Facility for premature withdrawal of deposits is not available where loans against such deposits are availed of <div id="66dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('65')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam66"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('67')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q67">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 67. Which of the following statement is not correct about Foreign Currency (Non-resident) Account (Banks) FCNR (B) accounts? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q67">
					<INPUT TYPE="RADIO" VALUE="67a" NAME="femock24q67" ID="femock24q67a" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> These can be opened by NRIs and PIOs in permissible foreign currency <div id="67acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="67b" NAME="femock24q67" ID="femock24q67b" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> These accounts can be maintained only in the form of Term Deposit  <div id="67bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="67c" NAME="femock24q67" ID="femock24q67c" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Term Deposit can be for a maturity period of minimum one year and maximum 5 years <div id="67ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="67d" NAME="femock24q67" ID="femock24q67d" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Accounts can be in the form of Recurring Deposits also <div id="67dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('66')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam67"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('68')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q68">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 68. Which of the following statement is not correct about Foreign Currency (Non-resident) Account (Banks) FCNR (B) account? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q68">
					<INPUT TYPE="RADIO" VALUE="68a" NAME="femock24q68" ID="femock24q68a" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The account can be a good option for NRIs /PIOs looking to invest in India without worrying about currency risks <div id="68acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="68b" NAME="femock24q68" ID="femock24q68b" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The interest rates vary between terms and from currency to currency and interest is tax free in India <div id="68bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68c" NAME="femock24q68" ID="femock24q68c" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Balance in FCNR (B) accounts can be used for making local payments in India <div id="68ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68d" NAME="femock24q68" ID="femock24q68d" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Balances in these accounts can be freely repatriated outside India <div id="68dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('67')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam68"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('69')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q69">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 69. With reference to FCNR (B) accounts consider the following statements:
				<br/>1.	It is a term deposit account
				<br/>2.	It is maintained in foreign currency
				<br/>3.	It can be opened both by NRIs and PIOs
				<br/>4.	There is no currency risk associated with it
				</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q69">
					<INPUT TYPE="RADIO" VALUE="69a" NAME="femock24q69" ID="femock24q69a" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 1, 2, 3 and 4 <div id="69acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="69b" NAME="femock24q69" ID="femock24q69b" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 2 and 4 only <div id="69bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69c" NAME="femock24q69" ID="femock24q69c" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 3 and 4 only <div id="69ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69d" NAME="femock24q69" ID="femock24q69d" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 1, 2 and 3 only <div id="69dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('68')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam69"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('70')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q70">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 70. With reference to Non-resident (Ordinary) account (NRO) consider the following statements:
				<br/>1.	It is an account of NRE to manage the income earned in India
				<br/>2.	It can be opened in the form of savings, currency, recurring and term deposits accounts
				<br/>3.	Deposit in the accounts can be in Indian as well as foreign currency but the withdrawals in Indian currency only
				<br/>4.	The interest earned is taxable
				</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q70">
					<INPUT TYPE="RADIO" VALUE="70a" NAME="femock24q70" ID="femock24q70a" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 1, 2, 3 and 4 <div id="70acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="70b" NAME="femock24q70" ID="femock24q70b" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 2 and 4 only <div id="70bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70c" NAME="femock24q70" ID="femock24q70c" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 3 and 4 only <div id="70ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70d" NAME="femock24q70" ID="femock24q70d" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 1, 2 and 3 only <div id="70dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('69')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam70"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('71')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q71">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 71. Which of the following statement is not correct with respect of SNRR (Special Non-resident Rupee)account?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q71">
					<INPUT TYPE="RADIO" VALUE="71a" NAME="femock24q71" ID="femock24q71a" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Account can be opened by a person resident outside having a business interest in India <div id="71acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="71b" NAME="femock24q71" ID="femock24q71b" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Person resident in India can also open the account <div id="71bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71c" NAME="femock24q71" ID="femock24q71c" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Putting of bona fide transactions in rupee which are in conformity with the provisions of FEMA rules <div id="71ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71d" NAME="femock24q71" ID="femock24q71d" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Account carries nomenclature of business for which opened <div id="71dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('70')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam71"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('72')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q72">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 72. What is an ESCROW account? Which of the following statement is correct? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q72">
					<INPUT TYPE="RADIO" VALUE="72a" NAME="femock24q72" ID="femock24q72a" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> It is a temporary pass through account held by a third party (Escrow Agent) during the process of a transaction between two parties. <div id="72acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="72b" NAME="femock24q72" ID="femock24q72b" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> It operates until a transaction process is completed after all the conditions between the buyer and seller  are settled <div id="72bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72c" NAME="femock24q72" ID="femock24q72c" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> From the account the amount is not transferred to seller until the project is completed <div id="72ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72d" NAME="femock24q72" ID="femock24q72d" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="72dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('71')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam72"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('73')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q73">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 73. Non-resident Indians can be granted loans against the security of funds held in NRE Term Deposit and in FCNR (B) by AD Banks. Which of the following statement is not correct? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q73">
					<INPUT TYPE="RADIO" VALUE="73a" NAME="femock24q73" ID="femock24q73a" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Loan can be without any ceiling but subject to usual margin requirement<div id="73acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="73b" NAME="femock24q73" ID="femock24q73b" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Loan can be for personal purposes or for carrying on business activities  <div id="73bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73c" NAME="femock24q73" ID="femock24q73c" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Loan can be for relending or carrying on agricultural/plantation activities or investment in real estate business <div id="73ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73d" NAME="femock24q73" ID="femock24q73d" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Loan can be for acquisition of flat/house for own residential use <div id="73dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('72')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam73"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('74')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q74">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 74. "Non-resident Bank Accounts" refer to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q74">
					<INPUT TYPE="RADIO" VALUE="74a" NAME="femock24q74" ID="femock24q74a" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> nostro account <div id="74acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="74b" NAME="femock24q74" ID="femock24q74b" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> vostro account <div id="74bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74c" NAME="femock24q74" ID="femock24q74c" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> accounts opened in offshore centers <div id="74ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74d" NAME="femock24q74" ID="femock24q74d" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> none of the above <div id="74dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('73')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam74"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('75')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q75">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 75. A foreign currency account maintained by a bank abroad is its </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q75">
					<INPUT TYPE="RADIO" VALUE="75a" NAME="femock24q75" ID="femock24q75a" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> nostro account <div id="75acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="75b" NAME="femock24q75" ID="femock24q75b" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> vostro account <div id="75bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75c" NAME="femock24q75" ID="femock24q75c" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> loro account <div id="75ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75d" NAME="femock24q75" ID="femock24q75d" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> foreign bank account <div id="75dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('74')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam75"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('76')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q76">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 76. The term "Nostro account" means </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q76">
					<INPUT TYPE="RADIO" VALUE="76a" NAME="femock24q76" ID="femock24q76a" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> our account with you <div id="76acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="76b" NAME="femock24q76" ID="femock24q76b" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> your account with us <div id="76bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="76c" NAME="femock24q76" ID="femock24q76c" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> their account with them <div id="76ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="76d" NAME="femock24q76" ID="femock24q76d" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> none of the above <div id="76dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('75')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam76"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('77')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q77">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 77. The term "Vostro account" means </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q77">
					<INPUT TYPE="RADIO" VALUE="77a" NAME="femock24q77" ID="femock24q77a" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> our account with you <div id="77acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="77b" NAME="femock24q77" ID="femock24q77b" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> your account with us <div id="77bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77c" NAME="femock24q77" ID="femock24q77c" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> their account with them <div id="77ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77d" NAME="femock24q77" ID="femock24q77d" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> none of the above <div id="77dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('76')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam77"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('78')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q78">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 78. Name the two schemes introduced under the new foreign trade policy? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q78">
					<INPUT TYPE="RADIO" VALUE="78a" NAME="femock24q78" ID="femock24q78a" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Merchandise Export from India Scheme & Services Export from India Scheme <div id="78acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="78b" NAME="femock24q78" ID="femock24q78b" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Services Export from India Scheme & Services Import from India Scheme<div id="78bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78c" NAME="femock24q78" ID="femock24q78c" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Services Import from India Scheme & Merchandise Export from India Scheme <div id="78ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78d" NAME="femock24q78" ID="femock24q78d" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Merchandise Import from India Scheme & Services Export from India Scheme <div id="78dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('77')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam78"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('79')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q79">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 79. Consider the following statements about the Foreign Trade Policy 2015-20 unveiled on 1st Apr’15.
				<br/>A. This policy focuses on boosting exports and create jobs while supporting the Centre’s Make In India' and Digital India' programs.
				<br/>B. The new policy is to create architecture for the Indian economy so that it can gain global competitiveness and promote the diversification of Indian export.
				<br/>C. The policy is to move towards paperless working in 24x7 environments.
				<br/>D. The policy comes at a time when export growth contracted 15 per cent in February 2014-15, reporting a negative growth for the third consecutive month.
				</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q79">
					<INPUT TYPE="RADIO" VALUE="79a" NAME="femock24q79" ID="femock24q79a" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A & B is correct <div id="79acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="79b" NAME="femock24q79" ID="femock24q79b" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> B & C is correct <div id="79bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="79c" NAME="femock24q79" ID="femock24q79c" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> A, B & D is correct <div id="79ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="79d" NAME="femock24q79" ID="femock24q79d" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above is correct <div id="79dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('78')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam79"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('80')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q80">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 80. The Indian Government unveiled the new Foreign Trade Policy 2015-20 on _____. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q80">
					<INPUT TYPE="RADIO" VALUE="80a" NAME="femock24q80" ID="femock24q80a" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 30th Mar 2015 <div id="80acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="80b" NAME="femock24q80" ID="femock24q80b" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 31st Mar 2015 <div id="80bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80c" NAME="femock24q80" ID="femock24q80c" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 1st April 2015 <div id="80ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80d" NAME="femock24q80" ID="femock24q80d" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 30th April 2015 <div id="80dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('79')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam80"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('81')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q81">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 81. IEC (Importer-Exporter code) is a number allotted by DGFT which is mandatory for undertaking any export/ import activity. It consists of </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q81">
					<INPUT TYPE="RADIO" VALUE="81a" NAME="femock24q81" ID="femock24q81a" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> five digits <div id="81acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="81b" NAME="femock24q81" ID="femock24q81b" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> eight digits <div id="81bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81c" NAME="femock24q81" ID="femock24q81c" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> seven digits <div id="81ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81d" NAME="femock24q81" ID="femock24q81d" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> ten digits <div id="81dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('80')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam81"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('82')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q82">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 82. Which of the following is true for Five Star Trading House? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q82">
					<INPUT TYPE="RADIO" VALUE="82a" NAME="femock24q82" ID="femock24q82a" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> They must be from SEZs <div id="82acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="82b" NAME="femock24q82" ID="femock24q82b" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> They get special EO concession under EPCG <div id="82bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82c" NAME="femock24q82" ID="femock24q82c" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Their export performance should be USD two billion <div id="82ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82d" NAME="femock24q82" ID="femock24q82d" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of above <div id="82dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('81')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam82"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('83')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q83">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 83. MEIS (Merchandise Export from India Scheme) was framed in new FTP by simplification and merger of different reward schemes available in earlier FTP. How many schemes were merged? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q83">
					<INPUT TYPE="RADIO" VALUE="83a" NAME="femock24q83" ID="femock24q83a" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Six <div id="83acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="83b" NAME="femock24q83" ID="femock24q83b" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Five <div id="83bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83c" NAME="femock24q83" ID="femock24q83c" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Four <div id="83ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83d" NAME="femock24q83" ID="femock24q83d" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Three <div id="83dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('82')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam83"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('84')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q84">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 84. The Export Obligation (EO) under EPCG is to be fulfilled in _______ years reckoned from the date of issue of authorization </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q84">
					<INPUT TYPE="RADIO" VALUE="84a" NAME="femock24q84" ID="femock24q84a" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Three <div id="84acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="84b" NAME="femock24q84" ID="femock24q84b" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Six <div id="84bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="84c" NAME="femock24q84" ID="femock24q84c" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Ten <div id="84ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="84d" NAME="femock24q84" ID="femock24q84d" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Eight <div id="84dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('83')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam84"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('85')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q85">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 85. The policy proposes mentoring of new and potential exporters through _____ scheme. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q85">
					<INPUT TYPE="RADIO" VALUE="85a" NAME="femock24q85" ID="femock24q85a" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Aayat Bandhu <div id="85acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="85b" NAME="femock24q85" ID="femock24q85b" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Niryat Bandhu <div id="85bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85c" NAME="femock24q85" ID="femock24q85c" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Aayat Niryat Bandhu <div id="85ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85d" NAME="femock24q85" ID="femock24q85d" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of above <div id="85dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('84')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam85"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('86')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q86">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 86. For training under "Niryat Bandhu Scheme" Which of the following have been roped in: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q86">
					<INPUT TYPE="RADIO" VALUE="86a" NAME="femock24q86" ID="femock24q86a" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> DGCI&S <div id="86acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="86b" NAME="femock24q86" ID="femock24q86b" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> NIFT <div id="86bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86c" NAME="femock24q86" ID="femock24q86c" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> IIFT <div id="86ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86d" NAME="femock24q86" ID="femock24q86d" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> SCOMET <div id="86dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('85')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam86"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('87')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q87">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 87. Under e commerce export certain category of goods having FOB value of _____ per consignment are eligible for export through designated Foreign Post Offices  </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q87">
					<INPUT TYPE="RADIO" VALUE="87a" NAME="femock24q87" ID="femock24q87a" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> INR 10,000 <div id="87acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="87b" NAME="femock24q87" ID="femock24q87b" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> INR 100,000 <div id="87bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87c" NAME="femock24q87" ID="femock24q87c" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> INR 50,000 <div id="87ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87d" NAME="femock24q87" ID="femock24q87d" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> INR 25,000 <div id="87dcheck" style="display: inline-block;"></div>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('86')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam87"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('88')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q88">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 88. Maximum how many IEC numbers can be issued against one PAN NUMBER? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q88">
					<INPUT TYPE="RADIO" VALUE="88a" NAME="femock24q88" ID="femock24q88a" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> One <div id="88acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="88b" NAME="femock24q88" ID="femock24q88b" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ten <div id="88bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88c" NAME="femock24q88" ID="femock24q88c" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Two <div id="88ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88d" NAME="femock24q88" ID="femock24q88d" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Five <div id="88dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('87')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam88"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('89')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q89">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 89. A Four Star Export house needs to achieve export performance FOB value of  </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q89">
					<INPUT TYPE="RADIO" VALUE="89a" NAME="femock24q89" ID="femock24q89a" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> INR 1000 crores <div id="89acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="89b" NAME="femock24q89" ID="femock24q89b" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 500 million <div id="89bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="89c" NAME="femock24q89" ID="femock24q89c" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> INR 100 crores <div id="89ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="89d" NAME="femock24q89" ID="femock24q89d" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 200 million <div id="89dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('88')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam89"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('90')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q90">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 90. Import under EPCG scheme is subject to Export obligation equivalent to _____ times the duty saved on capital goods </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q90">
					<INPUT TYPE="RADIO" VALUE="90a" NAME="femock24q90" ID="femock24q90a" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Three <div id="90acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="90b" NAME="femock24q90" ID="femock24q90b" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ten  <div id="90bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="90c" NAME="femock24q90" ID="femock24q90c" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Eight <div id="90ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="90d" NAME="femock24q90" ID="femock24q90d" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Six <div id="90dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('89')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam90"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('91')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q91">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 91. The new additions to list of Towns of Export Excellence in new policy are </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q91">
					<INPUT TYPE="RADIO" VALUE="91a" NAME="femock24q91" ID="femock24q91a" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Haldia and Asansol in West Bengal <div id="91acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="91b" NAME="femock24q91" ID="femock24q91b" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Visakhapatnam and Bheemavaram in Andhra Pradesh <div id="91bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91c" NAME="femock24q91" ID="femock24q91c" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Nagpur and Jalgaon in Maharastra <div id="91ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91d" NAME="femock24q91" ID="femock24q91d" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Surat and Anand in Gujrat <div id="91dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('90')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam91"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('92')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q92">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 92. Validity of SCOMET (dual use items) export authorization has been extended to _____ months. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q92">
					<INPUT TYPE="RADIO" VALUE="92a" NAME="femock24q92" ID="femock24q92a" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 12 <div id="92acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="92b" NAME="femock24q92" ID="femock24q92b" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 18 <div id="92bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92c" NAME="femock24q92" ID="femock24q92c" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 24 <div id="92ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92d" NAME="femock24q92" ID="femock24q92d" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 15 <div id="92dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('91')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam92"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('93')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q93">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 93. A Three star Export House needs to achieve export performance FOB value of </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q93">
					<INPUT TYPE="RADIO" VALUE="93a" NAME="femock24q93" ID="femock24q93a" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 100 million <div id="93acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="93b" NAME="femock24q93" ID="femock24q93b" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 500 million <div id="93bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93c" NAME="femock24q93" ID="femock24q93c" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> INR 500 crores <div id="93ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93d" NAME="femock24q93" ID="femock24q93d" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> INR 2000 crores <div id="93dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('92')" style="float:left">&#8656; BACK</button></li>
                      <li class="next" id="endexam93"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('94')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q94">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 94. With the addition of Visakhapatnam and Bhimavaram, the total number of Towns of Export Excellence has reached </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q94">
					<INPUT TYPE="RADIO" VALUE="94a" NAME="femock24q94" ID="femock24q94a" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 25 <div id="94acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="94b" NAME="femock24q94" ID="femock24q94b" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 35 <div id="94bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94c" NAME="femock24q94" ID="femock24q94c" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 55 <div id="94ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94d" NAME="femock24q94" ID="femock24q94d" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 75 <div id="94dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('93')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam94"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('95')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q95">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 95. What is the full form of ITC (HS) </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q95">
					<INPUT TYPE="RADIO" VALUE="95a" NAME="femock24q95" ID="femock24q95a" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Indian Trade Categorisation (harmonized system) <div id="95acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="95b" NAME="femock24q95" ID="femock24q95b" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Indian Trade Categorisation (homogeneous system) <div id="95bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95c" NAME="femock24q95" ID="femock24q95c" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Indian Trade Classification (homogeneous system) <div id="95ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95d" NAME="femock24q95" ID="femock24q95d" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Indian Trade Clarification (harmonized system) <div id="95dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                     <li class="previous"><button class="btn btn-primary" onclick="showQ('94')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam95"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                      <li class="next"><button class="btn btn-primary" onclick="showQ('96')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q96">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 96. While interacting with an exporter or importer, a banker should normally know: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q96">
					<INPUT TYPE="RADIO" VALUE="96a" NAME="femock24q96" ID="femock24q96a" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> About Import-Export Code (IEC) and Registration-cum-Membership Certificate (ECMC) <div id="96acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="96b" NAME="femock24q96" ID="femock24q96b" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Registration with Excise or similar authority as ‘manufacturer’ <div id="96bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96c" NAME="femock24q96" ID="femock24q96c" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Status certificate issued by DGFT <div id="96ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96d" NAME="femock24q96" ID="femock24q96d" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="96dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('95')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam96"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('97')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q97">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 97. RCMC (Registration-cum-membership Certificate is issued by: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q97">
					<INPUT TYPE="RADIO" VALUE="97a" NAME="femock24q97" ID="femock24q97a" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> RBI <div id="97acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="97b" NAME="femock24q97" ID="femock24q97b" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> DGFT <div id="97bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="97c" NAME="femock24q97" ID="femock24q97c" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Export Promotion Councils and Commodity Boards <div id="97ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="97d" NAME="femock24q97" ID="femock24q97d" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="97dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('96')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam97"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('98')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q98">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 98. Which of the following statement is not correct about High Seas Sale? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q98">
					<INPUT TYPE="RADIO" VALUE="98a" NAME="femock24q98" ID="femock24q98a" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The original importer enters into an agreement and transfers the ownership of goods by endorsing the original documents in favour of high seas sales buyer <div id="98acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="98b" NAME="femock24q98" ID="femock24q98b" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The Bill of entry is filed by the new buyer who clears the goods from the customs. <div id="98bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98c" NAME="femock24q98" ID="femock24q98c" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The high seas buyers pay money in overseas currency to original importer  <div id="98ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98d" NAME="femock24q98" ID="femock24q98d" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> High seas agreement must be concluded prior to arrival of the vessel or before the consignment is unloaded <div id="98dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('97')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam98"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('99')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q99">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 99. How many clusters have been identified under MSME for focused interventions to boost export: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q99">
					<INPUT TYPE="RADIO" VALUE="99a" NAME="femock24q99" ID="femock24q99a" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 100 <div id="99acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="99b" NAME="femock24q99" ID="femock24q99b" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 105 <div id="99bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99c" NAME="femock24q99" ID="femock24q99c" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 108<div id="99ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99d" NAME="femock24q99" ID="femock24q99d" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 118 <div id="99dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('98')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam99"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
		      <li class="next"><button class="btn btn-primary" onclick="showQ('100')" style="margin-left: 10px; float:left;">NEXT &#8658;</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-12" style="display:none" id="fe24-q100">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 100. Which of the following is not an important document in foreign trade? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock24q100">
					<INPUT TYPE="RADIO" VALUE="100a" NAME="femock24q100" ID="femock24q100a" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A check for the value of goods. <div id="100acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="100b" NAME="femock24q100" ID="femock24q100b" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A draft. <div id="100bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="100c" NAME="femock24q100" ID="femock24q100c" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bill of lading <div id="100ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="100d" NAME="femock24q100" ID="femock24q100d" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> A letter of credit <div id="100dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('99')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam100"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>		
		
		<section class="col-lg-12" style="display: none" id="fe24-status">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             

              <i class="fa fa-spinner"></i>

              <h3 class="box-title">
                <b>Your Progress</b>
              </h3><hr/>
            </div>
            
			<div class="tab-content no-padding">
			    <div class="box-header pad table-responsive" style="text-align: center;">	                  
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

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('5')" id="status5">5</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('6')" id="status6">6</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('7')" id="status7">7</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('8')" id="status8">8</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('9')" id="status9">9</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('10')" id="status10">10</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('11')" id="status11">11</button></td>

							<td style="padding:10px;"></td>
                                                        <td><button onclick="showQ('12')" id="status12">12</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('13')" id="status13">13</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('14')" id="status14">14</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('15')" id="status15">15</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('16')" id="status16">16</button></td>

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

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('25')" id="status25">25</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('26')" id="status26">26</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('27')" id="status27">27</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('28')" id="status28">28</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('29')" id="status29">29</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('30')" id="status30">30</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('31')" id="status31">31</button></td>

							<td style="padding:10px;"></td>
                                                        <td><button onclick="showQ('32')" id="status32">32</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('33')" id="status33">33</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('34')" id="status34">34</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('35')" id="status35">35</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('36')" id="status36">36</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('37')" id="status37">37</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('38')" id="status38">38</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('39')" id="status39">39</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('40')" id="status40">40</button></td>
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
							<td><button onclick="showQ('41')" id="status41">41</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('42')" id="status42">42</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('43')" id="status43">43</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('44')" id="status44">44</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('45')" id="status45">45</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('46')" id="status46">46</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('47')" id="status47">47</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('48')" id="status48">48</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('49')" id="status49">49</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('50')" id="status50">50</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('51')" id="status51">51</button></td>

							<td style="padding:10px;"></td>
                                                        <td><button onclick="showQ('52')" id="status52">52</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('53')" id="status53">53</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('54')" id="status54">54</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('55')" id="status55">55</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('56')" id="status56">56</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('57')" id="status57">57</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('58')" id="status58">58</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('59')" id="status59">59</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('60')" id="status60">60</button></td>
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
							<td><button onclick="showQ('61')" id="status61">61</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('62')" id="status62">62</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('63')" id="status63">63</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('64')" id="status64">64</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('65')" id="status65">65</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('66')" id="status66">66</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('67')" id="status67">67</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('68')" id="status68">68</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('69')" id="status69">69</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('70')" id="status70">70</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('71')" id="status71">71</button></td>

							<td style="padding:10px;"></td>
                                                        <td><button onclick="showQ('72')" id="status72">72</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('73')" id="status73">73</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('74')" id="status74">74</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('75')" id="status75">75</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('76')" id="status76">76</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('77')" id="status77">77</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('78')" id="status78">78</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('79')" id="status79">79</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('80')" id="status80">80</button></td>
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
							<td><button onclick="showQ('81')" id="status81">81</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('82')" id="status82">82</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('83')" id="status83">83</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('84')" id="status84">84</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('85')" id="status85">85</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('86')" id="status86">86</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('87')" id="status87">87</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('88')" id="status88">88</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('89')" id="status89">89</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('90')" id="status90">90</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('91')" id="status91">91</button></td>

							<td style="padding:10px;"></td>
                                                        <td><button onclick="showQ('92')" id="status92">92</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('93')" id="status93">93</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('94')" id="status94">94</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('95')" id="status95">95</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('96')" id="status96">96</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('97')" id="status97">97</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('98')" id="status98">98</button></td>

							<td style="padding:10px;"></td>
							<td><button onclick="showQ('99')" id="status99">99</button></td>

                                                        <td style="padding:10px;"></td>
							<td><button onclick="showQ('100')" id="status100">100</button></td>
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