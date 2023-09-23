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
  <title>FE-Mock27 | IBR Live</title>
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
				  tempItem2="femock27q"+i;
				  
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
			var nid="fe27-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("fe27-status").style.display = "block";
			document.getElementById("fe27-guide").style.display = "none";  
			document.getElementById("fe27-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=100;i++){
				qhid = "fe27-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
            if(parseInt(localStorage.getItem("started"))==parseInt(226)){

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
		
            document.getElementById("fe27-q1").style.display = "block"; 
			document.getElementById("fe27-status").style.display = "block";
			document.getElementById("fe27-guide").style.display = "none"; 
			document.getElementById("fe27-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));		
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(226)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "femock27q"+qno;
			  
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
				
				qval = "femock27q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "femock27q"+i+"a"; tcheckb = "femock27q"+i+"b"; tcheckc = "femock27q"+i+"c"; tcheckd = "femock27q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "femock27q"+i+"a"; tcheckb = "femock27q"+i+"b"; tcheckc = "femock27q"+i+"c"; tcheckd = "femock27q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "femock27q"+i+"a"; tcheckb = "femock27q"+i+"b"; tcheckc = "femock27q"+i+"c"; tcheckd = "femock27q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "femock27q"+i+"a"; tcheckb = "femock27q"+i+"b"; tcheckc = "femock27q"+i+"c"; tcheckd = "femock27q"+i+"d";
						
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
				tLabel = "femock27q"+i;
				val = localStorage.getItem(tLabel); 						
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('27'); //test-023
			
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
			  tempItem2="femock27q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>IIBF's Certificate Course in Foreign Exchange - Mock Test 27</b></p>
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
          <div class="nav-tabs-custom" id="fe27-guide">
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
				<li class="fli"> The passing score on the examination is 50%.</li>	
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for <b>IIBF's Certificate Course in Foreign Exchange</b> examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('226')">Take the Test</button></li>
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
          <div class="box box-solid " id="fe27-tut">
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
              <button class="btn btn-primary" onclick="location.href='fe-mock-0225'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>       
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
            </div>
          </div>
        </section>
	
		<section class="col-lg-12" style="display:none" id="fe27-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. ISBP stands for:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="femock27q1" ID="femock27q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> International Standard Banking Practice <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="femock27q1" ID="femock27q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Internal standard Banking Practice <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="femock27q1" ID="femock27q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> International Sellers  Banking Practice <div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="femock27q1" ID="femock27q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. ISBP-745, the current version of ISBP, was released in:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="femock27q2" ID="femock27q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> October 2013 <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="femock27q2" ID="femock27q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> October 2012 <div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="femock27q2" ID="femock27q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> April 2013 <div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="femock27q2" ID="femock27q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> April 2012 <div id="2dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. What is not true about the drawing of a draft? It must be drawn in case of acceptance credits. However, it is optional in case of sight payment and deferred payment credits</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="femock27q3" ID="femock27q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The name of bank on whom it is to be drawn and for what amount must be clearly indicated  <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="femock27q3" ID="femock27q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> In case of usance credits, the credit must indicate clearly the tenor at which it has to be drawn and the date from which such tenor would be reckoned <div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="femock27q3" ID="femock27q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The draft should be got drawn payable from an indefinite determinable date <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="femock27q3" ID="femock27q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. Guidelines and Rules of FEDAI are relating to:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="femock27q4" ID="femock27q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Hours of Business <div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="femock27q4" ID="femock27q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Import transactions <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="femock27q4" ID="femock27q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Export Transactions <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="femock27q4" ID="femock27q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Proceeds of Export bills sent on collection basis when credited to Nostro account will be purchased at:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="femock27q5" ID="femock27q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TT Buying Rate/ Forward Rate <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="femock27q5" ID="femock27q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Bill Buying Rate <div id="5bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5c" NAME="femock27q5" ID="femock27q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> TT Buying Rate<div id="5ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5d" NAME="femock27q5" ID="femock27q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="5dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Normal Transit Period allowed for a Sight bill is:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="femock27q6" ID="femock27q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 7 days <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="femock27q6" ID="femock27q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 15 days <div id="6bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6c" NAME="femock27q6" ID="femock27q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 25 days <div id="6ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6d" NAME="femock27q6" ID="femock27q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 30 days <div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. The rate applicable for crystallizing an import bill will be:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="femock27q7" ID="femock27q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TT selling rate <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="femock27q7" ID="femock27q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> TT buying rate<div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="femock27q7" ID="femock27q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bill selling/ Forward Rate <div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="femock27q7" ID="femock27q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="7dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. For Crystallization of export bill, the Authorized Dealers applies:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="femock27q8" ID="femock27q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bill Selling Rate <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="femock27q8" ID="femock27q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> TT Buying Rate <div id="8bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8c" NAME="femock27q8" ID="femock27q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bill Buying Rate <div id="8ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8d" NAME="femock27q8" ID="femock27q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> TT Selling Rate <div id="8dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. The rates of interest applicable for all export transactions shall be as prescribed by:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="femock27q9" ID="femock27q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Reserve Bank of India <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="femock27q9" ID="femock27q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> FEDAI <div id="9bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9c" NAME="femock27q9" ID="femock27q9c" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> DGFT <div id="9ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9d" NAME="femock27q9" ID="femock27q9d" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> FIMMDA <div id="9dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. The rate of interest on Export Advance in foreign currency (Packing Credit or Post shipment advance) is decided by _____? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="femock27q10" ID="femock27q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AD Bank as per the guidelines of FEDAI<div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="femock27q10" ID="femock27q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> AD Bank as per their independent business judgment <div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="femock27q10" ID="femock27q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Reserve Bank of India  <div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="femock27q10" ID="femock27q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AD Banks fix interest rate as per MCLR of the respective bank <div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. Which one of the given options is not a function of the FEDAI? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="femock27q11" ID="femock27q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Publishing average rates of identified nine foreign currencies for the use in compliance to AS-11 (Accounting Standard)  <div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="femock27q11" ID="femock27q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Publishing daily foreign exchange turnover data  <div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="femock27q11" ID="femock27q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Publishing month end Revaluation Rate for important foreign currencies <div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="femock27q11" ID="femock27q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Publishing 'Base Rate' for FCNR Deposits on the last working day of every month <div id="11dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. An NRI Customer offered A D Bank FCNR Deposit of USD 20 Million provided bank is ready offer differential higher interest rate. Can bank offer differential higher Interest rate for large value FCNR deposits?  </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="femock27q12" ID="femock27q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> No, FCNR Interest rate can not be more than what is advised by the RBI at beginning of each month <div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="femock27q12" ID="femock27q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> No, FCNR Rate can not be more than what is advised by the RBI at the beginning of each month  <div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="femock27q12" ID="femock27q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No, FCNR Rate can not be more than what is advised by the FEDAI at the beginning of each month <div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="femock27q12" ID="femock27q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Yes, bank can offer any FCNR interest rate for deposit more than Rs. 25 Cr. <div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. As per the FEDAI Rule 2.1(b) overdue export bills (Purchased/Negotiated/Discounted) are required to be crystallized at TT Sale Rate. The AD Bank observes that on the date of export crystallisation, the TT Sale Rate is less than original bill purchased rate and the amount of liability to be recovered from exporter is less than the amount disbursed at the time of post shipment advance. Should bank apply TT Sale Rate or Original Bill Purchase Rate (whichever is higher) for crystallization?  </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="femock27q13" ID="femock27q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bank should be guided by FEDAI Rule and apply the TT Sale Rate  <div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="femock27q13" ID="femock27q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Here, the exporter defaulted to get export bill realised on due date and must not get benefit of exchange rate. Bank should apply the TT Sale Rate or Original Bill Purchased Rate, whichever is higher <div id="13bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13c" NAME="femock27q13" ID="femock27q13c" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AD Banks are free to form their policy to decide exchange rate for crystallisation of export bill  <div id="13ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13d" NAME="femock27q13" ID="femock27q13d" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bank should apply the rate as mutually agreed in the Credit Sanction Note <div id="13dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. Mrs. Ann, a pensioner maintaining saving bank account received foreign inward remittance of USD 40,000 sent by her son. She came to branch and requested immediate credit at best conversion rate. The present best USD/INR TT spot rate quoted by dealer is Rs.65.12 / Rs 65.20 and Cash-spot difference is Two Paisa. What best rate you would quote to the customer?  </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="femock27q14" ID="femock27q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Rs. 65.12  <div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="femock27q14" ID="femock27q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Rs. 65.10  <div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="femock27q14" ID="femock27q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Rs.65.18  <div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="femock27q14" ID="femock27q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Any rate above Rs.65.12 <div id="14dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. The reduction in the value of a currency due to market forces is known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="femock27q15" ID="femock27q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Revaluation <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="femock27q15" ID="femock27q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Depreciation <div id="15bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15c" NAME="femock27q15" ID="femock27q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Appreciation <div id="15ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15d" NAME="femock27q15" ID="femock27q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Inflation <div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. The largest foreign exchange market in the world is </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="femock27q16" ID="femock27q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Newyork <div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="femock27q16" ID="femock27q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> London <div id="16bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16c" NAME="femock27q16" ID="femock27q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Japan <div id="16ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16d" NAME="femock27q16" ID="femock27q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Swiss <div id="16dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. In the following quote: Spot USD 1 = Rs.45.6500/650, Spot September 100/150, September forward Buying rate for dollar is - </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="femock27q17" ID="femock27q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Rs.45.6800 <div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="femock27q17" ID="femock27q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Rs.45.6600 <div id="17bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17c" NAME="femock27q17" ID="femock27q17c" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Rs.45.7500 <div id="17ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17d" NAME="femock27q17" ID="femock27q17d" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Rs.45.6500 <div id="17dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. The transaction where the exchange of currencies takes place two days after the date of the contract is known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="femock27q18" ID="femock27q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Ready transaction<div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="femock27q18" ID="femock27q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Value today <div id="18bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18c" NAME="femock27q18" ID="femock27q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Spot transactions <div id="18ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18d" NAME="femock27q18" ID="femock27q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Value tomorrow <div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. The transaction where the exchange of currencies takes place on the same date is known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="femock27q19" ID="femock27q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Tom <div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="femock27q19" ID="femock27q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Cash/Ready transaction <div id="19bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19c" NAME="femock27q19" ID="femock27q19c" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Spot transactions <div id="19ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19d" NAME="femock27q19" ID="femock27q19d" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Value tomorrow <div id="19dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. A transaction in which the currencies to be exchanged the next day of the transaction is known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="femock27q20" ID="femock27q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Ready transaction <div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="femock27q20" ID="femock27q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Value today <div id="20bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20c" NAME="femock27q20" ID="femock27q20c" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Spot transactions <div id="20ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20d" NAME="femock27q20" ID="femock27q20d" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Value tomorrow <div id="20dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. The transaction in which the exchange of currencies takes place at a specified future date, subsequent to the spot date is known as a </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="femock27q21" ID="femock27q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Swap transaction <div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="femock27q21" ID="femock27q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Forward transaction <div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="femock27q21" ID="femock27q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Future transaction <div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="femock27q21" ID="femock27q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Non-deliverable forwards <div id="21dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. One month forward contract entered into on 22nd March will fall due on </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="femock27q22" ID="femock27q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 21th April <div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="femock27q22" ID="femock27q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 22nd April <div id="22bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22c" NAME="femock27q22" ID="femock27q22c" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 23rd April <div id="22ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22d" NAME="femock27q22" ID="femock27q22d" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 24th April <div id="22dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. The buying rate is also known as the </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="femock27q23" ID="femock27q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bid rate <div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="femock27q23" ID="femock27q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Offer rate<div id="23bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23c" NAME="femock27q23" ID="femock27q23c" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Spread <div id="23ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23d" NAME="femock27q23" ID="femock27q23d" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Swap <div id="23dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. The selling rate is also known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="femock27q24" ID="femock27q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bid rate <div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="femock27q24" ID="femock27q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Offer rate <div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="femock27q24" ID="femock27q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Spread <div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="femock27q24" ID="femock27q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Swap <div id="24dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. Direct quotation is also known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="femock27q25" ID="femock27q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Home currency quotation <div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="femock27q25" ID="femock27q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign currency quotation <div id="25bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25c" NAME="femock27q25" ID="femock27q25c" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Currency quotation <div id="25ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25d" NAME="femock27q25" ID="femock27q25d" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> American quotation <div id="25dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q26">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 26. In direct quotation the principle adopted by the bank is to</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q26">
					<INPUT TYPE="RADIO" VALUE="26a" NAME="femock27q26" ID="femock27q26a" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Buy low only <div id="26acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="26b" NAME="femock27q26" ID="femock27q26b" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Buy low; sell high <div id="26bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26c" NAME="femock27q26" ID="femock27q26c" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Buy high; sell low<div id="26ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26d" NAME="femock27q26" ID="femock27q26d" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Sell low only <div id="26dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q27">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 27. In indirect quotation the principle adopted by the bank is to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q27">
					<INPUT TYPE="RADIO" VALUE="27a" NAME="femock27q27" ID="femock27q27a" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Buy low only<div id="27acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="27b" NAME="femock27q27" ID="femock27q27b" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Buy low; sell high <div id="27bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27c" NAME="femock27q27" ID="femock27q27c" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Buy high; sell low <div id="27ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27d" NAME="femock27q27" ID="femock27q27d" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Sell low only <div id="27dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q28">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 28. Indirect quotation is also known as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q28">
					<INPUT TYPE="RADIO" VALUE="28a" NAME="femock27q28" ID="femock27q28a" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Home currency quotation<div id="28acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="28b" NAME="femock27q28" ID="femock27q28b" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign currency quotation <div id="28bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28c" NAME="femock27q28" ID="femock27q28c" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> European quotation <div id="28ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28d" NAME="femock27q28" ID="femock27q28d" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> American quotation <div id="28dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q29">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 29. Derivatives can be used by an exporter for managing- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q29">
					<INPUT TYPE="RADIO" VALUE="29a" NAME="femock27q29" ID="femock27q29a" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Currency risk <div id="29acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="29b" NAME="femock27q29" ID="femock27q29b" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Cargo risk <div id="29bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29c" NAME="femock27q29" ID="femock27q29c" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Credit risk  <div id="29ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29d" NAME="femock27q29" ID="femock27q29d" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All the above  <div id="29dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q30">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 30. Under the forward exchange contract- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q30">
					<INPUT TYPE="RADIO" VALUE="30a" NAME="femock27q30" ID="femock27q30a" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The exchange rate is determined on the future date <div id="30acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="30b" NAME="femock27q30" ID="femock27q30b" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The parties agree to meet at a future date for finalization <div id="30bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30c" NAME="femock27q30" ID="femock27q30c" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Delivery of foreign exchange is done on a predetermined future date <div id="30ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30d" NAME="femock27q30" ID="femock27q30d" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="30dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
				<section class="col-lg-12" style="display:none" id="fe27-q31">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 31. Normally forward purchase contract booked should be used by the customer- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q31">
					<INPUT TYPE="RADIO" VALUE="31a" NAME="femock27q31" ID="femock27q31a" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> For executing the export order for which the contract was booked<div id="31acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="31b" NAME="femock27q31" ID="femock27q31b" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> For any export order from the same buyer <div id="31bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31c" NAME="femock27q31" ID="femock27q31c" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> For any export order for the same commodity <div id="31ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31d" NAME="femock27q31" ID="femock27q31d" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> For any export order <div id="31dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q32">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 32. Which of the following statements is true? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q32">
					<INPUT TYPE="RADIO" VALUE="32a" NAME="femock27q32" ID="femock27q32a" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exchange exposure leads to exchange risk <div id="32acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="32b" NAME="femock27q32" ID="femock27q32b" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Exchange risk leads to exchange exposure <div id="32bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32c" NAME="femock27q32" ID="femock27q32c" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exchange exposure and exchange risk are unrelated <div id="32ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32d" NAME="femock27q32" ID="femock27q32d" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="32dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q33">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 33. The exchange loss/gain due to transaction exposure is reckoned on-</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q33">
					<INPUT TYPE="RADIO" VALUE="33a" NAME="femock27q33" ID="femock27q33a" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Entering into a transaction in foreign exchange <div id="33acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="33b" NAME="femock27q33" ID="femock27q33b" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Quoting a price for a foreign currency transaction <div id="33bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="33c" NAME="femock27q33" ID="femock27q33c" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Conversion of foreign currency into domestic currency <div id="33ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="33d" NAME="femock27q33" ID="femock27q33d" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Entry in the books of accounts <div id="33dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q34">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 34. The external methods of hedging transaction exposure does not include- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q34">
					<INPUT TYPE="RADIO" VALUE="34a" NAME="femock27q34" ID="femock27q34a" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Forward contract hedge <div id="34acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="34b" NAME="femock27q34" ID="femock27q34b" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Money market hedge <div id="34bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34c" NAME="femock27q34" ID="femock27q34c" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Cross hedging <div id="34ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34d" NAME="femock27q34" ID="femock27q34d" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Futures hedging <div id="34dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q35">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 35. The true cost of hedging transaction exposure by using forward market is- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q35">
					<INPUT TYPE="RADIO" VALUE="35a" NAME="femock27q35" ID="femock27q35a" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The difference between agreed rate and the spot rate at the time of entering into the contact <div id="35acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="35b" NAME="femock27q35" ID="femock27q35b" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The difference between agreed rate and the spot rate on the due date of the contract. <div id="35bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35c" NAME="femock27q35" ID="femock27q35c" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The forward premium/discount annualised <div id="35ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35d" NAME="femock27q35" ID="femock27q35d" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="35dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q36">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 36. The cost of hedging through options includes- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q36">
					<INPUT TYPE="RADIO" VALUE="36a" NAME="femock27q36" ID="femock27q36a" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Option premium <div id="36acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="36b" NAME="femock27q36" ID="femock27q36b" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Interest on option premium till due date of the contract <div id="36bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36c" NAME="femock27q36" ID="femock27q36c" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B) above<div id="36ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36d" NAME="femock27q36" ID="femock27q36d" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> (A) above and differences between option price and spot price <div id="36dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q37">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 37. A firm operating in India cannot hedge its foreign currency exposure through </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q37">
					<INPUT TYPE="RADIO" VALUE="37a" NAME="femock27q37" ID="femock27q37a" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Forwards <div id="37acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="37b" NAME="femock27q37" ID="femock27q37b" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Futures <div id="37bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="37c" NAME="femock27q37" ID="femock27q37c" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Options <div id="37ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="37d" NAME="femock27q37" ID="femock27q37d" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> none of the above <div id="37dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q38">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 38. Foreign currency exposure can be avoided by </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q38">
					<INPUT TYPE="RADIO" VALUE="38a" NAME="femock27q38" ID="femock27q38a" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Entering into forward contracts <div id="38acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="38b" NAME="femock27q38" ID="femock27q38b" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Denominating the transaction in domestic currency <div id="38bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38c" NAME="femock27q38" ID="femock27q38c" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exposure netting <div id="38ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38d" NAME="femock27q38" ID="femock27q38d" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Maintaining foreign currency account <div id="38dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q39">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 39. Leading refers to- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q39">
					<INPUT TYPE="RADIO" VALUE="39a" NAME="femock27q39" ID="femock27q39a" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Advancing of receivables <div id="39acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="39b" NAME="femock27q39" ID="femock27q39b" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Advancing of payables <div id="39bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39c" NAME="femock27q39" ID="femock27q39c" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Advancing payments either receivables or payables<div id="39ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39d" NAME="femock27q39" ID="femock27q39d" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Advancing of receivables and delaying of payables <div id="39dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q40">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 40. Translation exposure arises in respect of items translated at - </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q40">
					<INPUT TYPE="RADIO" VALUE="40a" NAME="femock27q40" ID="femock27q40a" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Current rate <div id="40acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="40b" NAME="femock27q40" ID="femock27q40b" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Historical rate <div id="40bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40c" NAME="femock27q40" ID="femock27q40c" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Average rate <div id="40ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40d" NAME="femock27q40" ID="femock27q40d" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All the above <div id="40dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q41">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 41. For the purpose of translation, current rate refers to- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q41">
					<INPUT TYPE="RADIO" VALUE="41a" NAME="femock27q41" ID="femock27q41a" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The rate current at the time of the transaction <div id="41acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="41b" NAME="femock27q41" ID="femock27q41b" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The rate prevalent on the date of the balance sheet<div id="41bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41c" NAME="femock27q41" ID="femock27q41c" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The rate prevalent on the date of preparation of the balance sheet <div id="41ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41d" NAME="femock27q41" ID="femock27q41d" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> The spot rate<div id="41dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q42">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 42. A positive exposure will lead to _______ when the currency of the subsidiary company appreciates. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q42">
					<INPUT TYPE="RADIO" VALUE="42a" NAME="femock27q42" ID="femock27q42a" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Translation gain<div id="42acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="42b" NAME="femock27q42" ID="femock27q42b" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Translation loss <div id="42bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42c" NAME="femock27q42" ID="femock27q42c" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exchange gain <div id="42ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42d" NAME="femock27q42" ID="femock27q42d" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Exchange loss <div id="42dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q43">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 43. The following method cannot be used for managing translation exposure </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q43">
					<INPUT TYPE="RADIO" VALUE="43a" NAME="femock27q43" ID="femock27q43a" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Forward contract <div id="43acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="43b" NAME="femock27q43" ID="femock27q43b" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Option contract <div id="43bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43c" NAME="femock27q43" ID="femock27q43c" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exposure netting <div id="43ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43d" NAME="femock27q43" ID="femock27q43d" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Leading and lagging <div id="43dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q44">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 44. Economic exposure does not deal with- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q44">
					<INPUT TYPE="RADIO" VALUE="44a" NAME="femock27q44" ID="femock27q44a" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Changes in real exchange rates <div id="44acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="44b" NAME="femock27q44" ID="femock27q44b" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Future cash flows of the firm<div id="44bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44c" NAME="femock27q44" ID="femock27q44c" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Expected exchange rate changes <div id="44ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44d" NAME="femock27q44" ID="femock27q44d" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="44dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q45">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 45.If rupee depreciates in real terms, cash inflows of a firm engaged in exports is- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q45">
					<INPUT TYPE="RADIO" VALUE="45a" NAME="femock27q45" ID="femock27q45a" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Definite to increase <div id="45acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="45b" NAME="femock27q45" ID="femock27q45b" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Definite to decrease <div id="45bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45c" NAME="femock27q45" ID="femock27q45c" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Generally will increase, if government does not intervene <div id="45ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45d" NAME="femock27q45" ID="femock27q45d" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Will increase provided the demand for its exports is elastic <div id="45dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q46">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 46. Ideal time for launching a product in foreign market is </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q46">
					<INPUT TYPE="RADIO" VALUE="46a" NAME="femock27q46" ID="femock27q46a" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> When domestic currency has depreciated <div id="46acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="46b" NAME="femock27q46" ID="femock27q46b" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> When domestic currency has appreciated <div id="46bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46c" NAME="femock27q46" ID="femock27q46c" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> When exchange rate in the markets are fluctuating violently  <div id="46ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46d" NAME="femock27q46" ID="femock27q46d" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="46dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q47">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 47. Financial strategies for managing economic exposure does not include- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q47">
					<INPUT TYPE="RADIO" VALUE="47a" NAME="femock27q47" ID="femock27q47a" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Minimizing cost of borrowing by sourcing from cheaper market <div id="47acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="47b" NAME="femock27q47" ID="femock27q47b" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Matching of assets and liabilities in a currency <div id="47bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47c" NAME="femock27q47" ID="femock27q47c" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Securing parallel loans and swaps <div id="47ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47d" NAME="femock27q47" ID="femock27q47d" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Delaying the product launch <div id="47dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q48">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 48. The transaction in which the bank receives foreign currency from the customer and pays him in local currency is a - </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q48">
					<INPUT TYPE="RADIO" VALUE="48a" NAME="femock27q48" ID="femock27q48a" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Purchase transaction<div id="48acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="48b" NAME="femock27q48" ID="femock27q48b" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sale transaction <div id="48bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="48c" NAME="femock27q48" ID="femock27q48c" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Direct transaction <div id="48ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="48d" NAME="femock27q48" ID="femock27q48d" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Indirect transaction <div id="48dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q49">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 49. The transaction in which the bank receives local currency from the customer and pays him foreign currency is a- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q49">
					<INPUT TYPE="RADIO" VALUE="49a" NAME="femock27q49" ID="femock27q49a" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Purchase transaction<div id="49acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="49b" NAME="femock27q49" ID="femock27q49b" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sale transaction<div id="49bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49c" NAME="femock27q49" ID="femock27q49c" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Direct transaction <div id="49ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49d" NAME="femock27q49" ID="femock27q49d" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Indirect transaction <div id="49dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q50">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 50. The following is not a sale transaction of foreign exchange: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q50">
					<INPUT TYPE="RADIO" VALUE="50a" NAME="femock27q50" ID="femock27q50a" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Issue of a foreign demand draft <div id="50acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="50b" NAME="femock27q50" ID="femock27q50b" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Payment of an import bill <div id="50bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50c" NAME="femock27q50" ID="femock27q50c" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Realization of an export bill <div id="50ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50d" NAME="femock27q50" ID="femock27q50d" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="50dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q51">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 51. The minimum fraction in which exchange rates are quoted by banks to their customers is- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q51">
					<INPUT TYPE="RADIO" VALUE="51a" NAME="femock27q51" ID="femock27q51a" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 0.0001 <div id="51acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="51b" NAME="femock27q51" ID="femock27q51b" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 0.005 <div id="51bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51c" NAME="femock27q51" ID="femock27q51c" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 0.0025 <div id="51ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51d" NAME="femock27q51" ID="femock27q51d" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 0.01 <div id="51dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q52">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 52. The exchange rates quoted by an authorised dealer to its customers are known as- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q52">
					<INPUT TYPE="RADIO" VALUE="52a" NAME="femock27q52" ID="femock27q52a" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Authorised rates <div id="52acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="52b" NAME="femock27q52" ID="femock27q52b" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Commercial rates <div id="52bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52c" NAME="femock27q52" ID="femock27q52c" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Merchant rates <div id="52ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52d" NAME="femock27q52" ID="femock27q52d" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Indirect rates <div id="52dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q53">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 53. TT buying rate is not applicable for the following transaction- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q53">
					<INPUT TYPE="RADIO" VALUE="53a" NAME="femock27q53" ID="femock27q53a" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Encashment of a DD for which cover has already been received <div id="53acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="53b" NAME="femock27q53" ID="femock27q53b" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Encashment of an MT for which paying bank has to make reimbursement claim with the issuing bank <div id="53bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53c" NAME="femock27q53" ID="femock27q53c" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Realisation of a foreign bill sent for collection <div id="53ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53d" NAME="femock27q53" ID="femock27q53d" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Payment of a cable transfer <div id="53dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q54">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 54. Bill buying rates are applicable to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q54">
					<INPUT TYPE="RADIO" VALUE="54a" NAME="femock27q54" ID="femock27q54a" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> All export transactions <div id="54acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="54b" NAME="femock27q54" ID="femock27q54b" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Any transaction to which tt buying rate is not applicable<div id="54bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="54c" NAME="femock27q54" ID="femock27q54c" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Realisation of a foreign bill sent for collection <div id="54ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="54d" NAME="femock27q54" ID="femock27q54d" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Only for puchase/negotiation of export bills<div id="54dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q55">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 55. Buying Rate for Ready Merchant Rate Is Derived From- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q55">
					<INPUT TYPE="RADIO" VALUE="55a" NAME="femock27q55" ID="femock27q55a" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Interbank Spot Buying Rate <div id="55acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="55b" NAME="femock27q55" ID="femock27q55b" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Interbank Ready Buying Rate <div id="55bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55c" NAME="femock27q55" ID="femock27q55c" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Interbank Spot Selling Rate<div id="55ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55d" NAME="femock27q55" ID="femock27q55d" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Interbank Ready Selling Rate <div id="55dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q56">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 56. An export bill is taken for collection by the bank. The exchange rate applied for the transaction will be: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q56">
					<INPUT TYPE="RADIO" VALUE="56a" NAME="femock27q56" ID="femock27q56a" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bill buying rate <div id="56acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="56b" NAME="femock27q56" ID="femock27q56b" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Bill selling rate <div id="56bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56c" NAME="femock27q56" ID="femock27q56c" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> TT buying rate as on the date of sending the bill for collection <div id="56ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56d" NAME="femock27q56" ID="femock27q56d" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> TT buying rate as on the date of realization of the bill <div id="56dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q57">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 57. TT Buying Rate Is Applicable For Transactions Where- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q57">
					<INPUT TYPE="RADIO" VALUE="57a" NAME="femock27q57" ID="femock27q57a" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Remittance Is Received By Telecommunicaton <div id="57acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="57b" NAME="femock27q57" ID="femock27q57b" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Remittance Is Sent By Telecommunication<div id="57bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57c" NAME="femock27q57" ID="femock27q57c" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The Nostro Account Of The Bank Is Already Credited <div id="57ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57d" NAME="femock27q57" ID="femock27q57d" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> The Nostro Account Of The Bank Is Already Debited <div id="57dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q58">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 58. The term notional due date refers to- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q58">
					<INPUT TYPE="RADIO" VALUE="58a" NAME="femock27q58" ID="femock27q58a" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The date on which an export bill is likely to be paid <div id="58acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="58b" NAME="femock27q58" ID="femock27q58b" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Due date arrived at without considering the holidays <div id="58bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58c" NAME="femock27q58" ID="femock27q58c" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Due date of a bill drawn without a due dateOpt 3 here <div id="58ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58d" NAME="femock27q58" ID="femock27q58d" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="58dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q59">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 59. TT selling rate is applicable for transactions of- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q59">
					<INPUT TYPE="RADIO" VALUE="59a" NAME="femock27q59" ID="femock27q59a" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Issue of telegraphic transfers <div id="59acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="59b" NAME="femock27q59" ID="femock27q59b" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Outward remittances other than for retirement of import bill <div id="59bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="59c" NAME="femock27q59" ID="femock27q59c" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Retirement of import bill for which remittance is sent by TT <div id="59ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="59d" NAME="femock27q59" ID="femock27q59d" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Payment of telegraphic transfer <div id="59dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q60">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 60. Cover deal by a dealer of an authorized dealer is undertaken to- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q60">
					<INPUT TYPE="RADIO" VALUE="60a" NAME="femock27q60" ID="femock27q60a" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Profit from exchange rate movements <div id="60acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="60b" NAME="femock27q60" ID="femock27q60b" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Cover up mistakes done by the dealer <div id="60bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60c" NAME="femock27q60" ID="femock27q60c" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Square up the position resulting from dealings with customers <div id="60ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60d" NAME="femock27q60" ID="femock27q60d" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="60dcheck" style="display: inline-block;"></div><BR/><BR/>
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
        
        		<section class="col-lg-12" style="display:none" id="fe27-q61">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 61. For funding the vostro acount, the bank in India will apply- </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q61">
					<INPUT TYPE="RADIO" VALUE="61a" NAME="femock27q61" ID="femock27q61a" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Its TT Buying Rate <div id="61acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="61b" NAME="femock27q61" ID="femock27q61b" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Its TT Selling Rate<div id="61bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61c" NAME="femock27q61" ID="femock27q61c" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Interbank Spot Buying Rate <div id="61ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61d" NAME="femock27q61" ID="femock27q61d" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Interbank Spot Selling Rate <div id="61dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q62">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 62. A swap deal is executed by </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q62">
					<INPUT TYPE="RADIO" VALUE="62a" NAME="femock27q62" ID="femock27q62a" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Settling the difference interest rates <div id="62acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="62b" NAME="femock27q62" ID="femock27q62b" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Actual delivery of currencies <div id="62bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="62c" NAME="femock27q62" ID="femock27q62c" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Entering into another swap dealOpt 3 here <div id="62ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="62d" NAME="femock27q62" ID="femock27q62d" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="62dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q63">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 63. Euro was launched on </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q63">
					<INPUT TYPE="RADIO" VALUE="63a" NAME="femock27q63" ID="femock27q63a" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 1999 <div id="63acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="63b" NAME="femock27q63" ID="femock27q63b" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 2000<div id="63bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63c" NAME="femock27q63" ID="femock27q63c" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 2001 <div id="63ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63d" NAME="femock27q63" ID="femock27q63d" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 2002 <div id="63dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q64">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 64. In a ________ transaction the quoting bank parts with foreign currency and acquires home currency </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q64">
					<INPUT TYPE="RADIO" VALUE="64a" NAME="femock27q64" ID="femock27q64a" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sale <div id="64acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="64b" NAME="femock27q64" ID="femock27q64b" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Purchase <div id="64bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64c" NAME="femock27q64" ID="femock27q64c" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Spot <div id="64ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64d" NAME="femock27q64" ID="femock27q64d" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Forward <div id="64dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q65">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 65. The rate applied when payment of demand draft drawn on the bank where bank's NOSTRO account is already credited </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q65">
					<INPUT TYPE="RADIO" VALUE="65a" NAME="femock27q65" ID="femock27q65a" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TT selling rate   <div id="65acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="65b" NAME="femock27q65" ID="femock27q65b" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Bill selling rate <div id="65bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65c" NAME="femock27q65" ID="femock27q65c" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bill buying rate <div id="65ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65d" NAME="femock27q65" ID="femock27q65d" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> TT buying rate <div id="65dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q66">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 66. The rate applied when foreign bills collected and the bank's NOSTRO account abroad is credited </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q66">
					<INPUT TYPE="RADIO" VALUE="66a" NAME="femock27q66" ID="femock27q66a" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TT buying rate <div id="66acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="66b" NAME="femock27q66" ID="femock27q66b" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> TT selling rate <div id="66bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="66c" NAME="femock27q66" ID="femock27q66c" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bill selling rate <div id="66ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="66d" NAME="femock27q66" ID="femock27q66d" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bill buying rate <div id="66dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q67">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 67. The rate used for all transactions that do not involve handling of documents by the banks is </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q67">
					<INPUT TYPE="RADIO" VALUE="67a" NAME="femock27q67" ID="femock27q67a" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TT buying rate <div id="67acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="67b" NAME="femock27q67" ID="femock27q67b" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> TT selling rate <div id="67bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="67c" NAME="femock27q67" ID="femock27q67c" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bill selling rate <div id="67ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="67d" NAME="femock27q67" ID="femock27q67d" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bill buying rate <div id="67dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q68">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 68. In India exchange rates for foreign currencies other than us dollar are calculated as </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q68">
					<INPUT TYPE="RADIO" VALUE="68a" NAME="femock27q68" ID="femock27q68a" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TT buying rate <div id="68acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="68b" NAME="femock27q68" ID="femock27q68b" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Cross rates<div id="68bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68c" NAME="femock27q68" ID="femock27q68c" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> TT selling rate <div id="68ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68d" NAME="femock27q68" ID="femock27q68d" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bill selling rate <div id="68dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q69">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 69. Convertibility of rupee refers to its convertibility into a ________ as desired by its holder </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q69">
					<INPUT TYPE="RADIO" VALUE="69a" NAME="femock27q69" ID="femock27q69a" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Foreign currency <div id="69acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="69b" NAME="femock27q69" ID="femock27q69b" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Local currency <div id="69bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69c" NAME="femock27q69" ID="femock27q69c" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bank notes <div id="69ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69d" NAME="femock27q69" ID="femock27q69d" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Demand draft <div id="69dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q70">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 70. For balance of payments statistics, visible trade refers to trade in </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q70">
					<INPUT TYPE="RADIO" VALUE="70a" NAME="femock27q70" ID="femock27q70a" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Goods only <div id="70acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="70b" NAME="femock27q70" ID="femock27q70b" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Service only <div id="70bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70c" NAME="femock27q70" ID="femock27q70c" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Goods/commodities <div id="70ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70d" NAME="femock27q70" ID="femock27q70d" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gold <div id="70dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q71">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 71. Generally imports are recorded at ________ value in balance of payments </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q71">
					<INPUT TYPE="RADIO" VALUE="71a" NAME="femock27q71" ID="femock27q71a" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> FOB <div id="71acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="71b" NAME="femock27q71" ID="femock27q71b" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> CIF <div id="71bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71c" NAME="femock27q71" ID="femock27q71c" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> CPT<div id="71ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71d" NAME="femock27q71" ID="femock27q71d" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> CIP <div id="71dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q72">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 72. A credit in balance of payments indicates </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q72">
					<INPUT TYPE="RADIO" VALUE="72a" NAME="femock27q72" ID="femock27q72a" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Accumulation of bank balances abroad <div id="72acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="72b" NAME="femock27q72" ID="femock27q72b" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign direct investment received into the country<div id="72bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72c" NAME="femock27q72" ID="femock27q72c" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Earning of foreign exchange by the country <div id="72ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72d" NAME="femock27q72" ID="femock27q72d" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Earning of foreign exchange or incurring of liability abroad or decrease in asset abroad <div id="72dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q73">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 73. A debit in balance of payments does not indicate </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q73">
					<INPUT TYPE="RADIO" VALUE="73a" NAME="femock27q73" ID="femock27q73a" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Import of goods and services <div id="73acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="73b" NAME="femock27q73" ID="femock27q73b" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign tourists encashing travellers cheque in the country<div id="73bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73c" NAME="femock27q73" ID="femock27q73c" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Investments made abroad <div id="73ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73d" NAME="femock27q73" ID="femock27q73d" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="73dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q74">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 74. The current account of balance of payments includes </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q74">
					<INPUT TYPE="RADIO" VALUE="74a" NAME="femock27q74" ID="femock27q74a" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Unilateral payments <div id="74acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="74b" NAME="femock27q74" ID="femock27q74b" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Portfolio investments <div id="74bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74c" NAME="femock27q74" ID="femock27q74c" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Short term borrowings <div id="74ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74d" NAME="femock27q74" ID="femock27q74d" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Long term borrowings <div id="74dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q75">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 75.A Country imports gold worth USD 100 million for commercial purposes. The transaction will affect </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q75">
					<INPUT TYPE="RADIO" VALUE="75a" NAME="femock27q75" ID="femock27q75a" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Current account only <div id="75acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="75b" NAME="femock27q75" ID="femock27q75b" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Capital account only <div id="75bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75c" NAME="femock27q75" ID="femock27q75c" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Official reserves account only <div id="75ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75d" NAME="femock27q75" ID="femock27q75d" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both current account and capital account <div id="75dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q76">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 76. Packing credit is </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q76">
					<INPUT TYPE="RADIO" VALUE="76a" NAME="femock27q76" ID="femock27q76a" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> An advance made for packing goods for export. <div id="76acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="76b" NAME="femock27q76" ID="femock27q76b" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Pre-shipment finance for export. <div id="76bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="76c" NAME="femock27q76" ID="femock27q76c" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> A priority sector advance <div id="76ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="76d" NAME="femock27q76" ID="femock27q76d" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Advance for importer <div id="76dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q77">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 77. Which of the following person is not eligible for packing credit? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q77">
					<INPUT TYPE="RADIO" VALUE="77a" NAME="femock27q77" ID="femock27q77a" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A merchant exporter <div id="77acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="77b" NAME="femock27q77" ID="femock27q77b" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A person making deemed exports <div id="77bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77c" NAME="femock27q77" ID="femock27q77c" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sub-suppliers to manufacture exporter <div id="77ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77d" NAME="femock27q77" ID="femock27q77d" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Supplier to sub-supplier to manufacture exporter <div id="77dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q78">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 78. The advantage to the exporter of running account facility of packing credit is </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q78">
					<INPUT TYPE="RADIO" VALUE="78a" NAME="femock27q78" ID="femock27q78a" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Production of letter of credit or firm order is completely waive <div id="78acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="78b" NAME="femock27q78" ID="femock27q78b" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The period of facility need not be adhered to <div id="78bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78c" NAME="femock27q78" ID="femock27q78c" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Production of letter of credit on firm order is waived immediately they must be produced within Reasonable time <div id="78ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78d" NAME="femock27q78" ID="femock27q78d" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> The rate of interest is low <div id="78dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q79">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 79. The substitution of commodity/fresh export of adjustment of packing credit is not available for </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q79">
					<INPUT TYPE="RADIO" VALUE="79a" NAME="femock27q79" ID="femock27q79a" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Advance against sensitive commodities <div id="79acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="79b" NAME="femock27q79" ID="femock27q79b" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transactions of sister/associate/group concerns. <div id="79bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="79c" NAME="femock27q79" ID="femock27q79c" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exports availing running account facility <div id="79ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="79d" NAME="femock27q79" ID="femock27q79d" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Exports with imports <div id="79dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q80">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 80. Normally the maximum period for which packing credit advances are made is </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q80">
					<INPUT TYPE="RADIO" VALUE="80a" NAME="femock27q80" ID="femock27q80a" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 90 days <div id="80acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="80b" NAME="femock27q80" ID="femock27q80b" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 135 days <div id="80bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80c" NAME="femock27q80" ID="femock27q80c" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 180 days <div id="80ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80d" NAME="femock27q80" ID="femock27q80d" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 360 days <div id="80dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q81">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 81. A packing credit was granted against an export order but the export could not take place </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q81">
					<INPUT TYPE="RADIO" VALUE="81a" NAME="femock27q81" ID="femock27q81a" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> It should be reported to the RBI<div id="81acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="81b" NAME="femock27q81" ID="femock27q81b" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The exporter should be black list <div id="81bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81c" NAME="femock27q81" ID="femock27q81c" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Claim should be preferred with ECG <div id="81ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81d" NAME="femock27q81" ID="femock27q81d" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Interest at domestic rate should be charged on the advance from the date of advance <div id="81dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q82">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 82. The following is not a post-shipment advance </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q82">
					<INPUT TYPE="RADIO" VALUE="82a" NAME="femock27q82" ID="femock27q82a" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Negotiation of bill under letter of credit <div id="82acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="82b" NAME="femock27q82" ID="femock27q82b" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Purchase of foreign bill. <div id="82bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82c" NAME="femock27q82" ID="femock27q82c" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Advance against foreign bill for collection <div id="82ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82d" NAME="femock27q82" ID="femock27q82d" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Packing credit <div id="82dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q83">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 83. A bill drawn under a letter of credit contains discrepancies, the Bank:</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q83">
					<INPUT TYPE="RADIO" VALUE="83a" NAME="femock27q83" ID="femock27q83a" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Should refuse to negotiate documents <div id="83acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="83b" NAME="femock27q83" ID="femock27q83b" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Take the bill on collection basis only <div id="83bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83c" NAME="femock27q83" ID="femock27q83c" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Must negotiate irrespective of discrepancies <div id="83ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83d" NAME="femock27q83" ID="femock27q83d" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> May purchase it or take it for collection, but should not refuse to handle the bill <div id="83dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q84">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 84. The following is a must for an export through post office </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q84">
					<INPUT TYPE="RADIO" VALUE="84a" NAME="femock27q84" ID="femock27q84a" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> GR form<div id="84acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="84b" NAME="femock27q84" ID="femock27q84b" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> EP form<div id="84bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="84c" NAME="femock27q84" ID="femock27q84c" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> PP form <div id="84ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="84d" NAME="femock27q84" ID="femock27q84d" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> GRX form <div id="84dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q85">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 85.Duty drawback is the refund of duty chargeable on </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q85">
					<INPUT TYPE="RADIO" VALUE="85a" NAME="femock27q85" ID="femock27q85a" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exported material<div id="85acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="85b" NAME="femock27q85" ID="femock27q85b" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Imported material <div id="85bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85c" NAME="femock27q85" ID="femock27q85c" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Damaged material <div id="85ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85d" NAME="femock27q85" ID="femock27q85d" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Exports to Indian owned warehouses in Europe <div id="85dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q86">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 86. Availing post-shipment credit in foreign currency is compulsory for </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q86">
					<INPUT TYPE="RADIO" VALUE="86a" NAME="femock27q86" ID="femock27q86a" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exporters who have not availed packing credit <div id="86acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="86b" NAME="femock27q86" ID="femock27q86b" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> All exporters who have availed packing credit <div id="86bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86c" NAME="femock27q86" ID="femock27q86c" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exporters who have availed pre-shipment credit in foreign currencyOpt 3 here <div id="86ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86d" NAME="femock27q86" ID="femock27q86d" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Exporters who have availed credit from banks <div id="86dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q87">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 87. Advance remittance from importer can be accepted by an exporter in India provided: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q87">
					<INPUT TYPE="RADIO" VALUE="87a" NAME="femock27q87" ID="femock27q87a" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The advance does not carry interest payment.<div id="87acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="87b" NAME="femock27q87" ID="femock27q87b" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Shipment will be made only after one year from the date of receipt of advance <div id="87bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87c" NAME="femock27q87" ID="femock27q87c" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Advance does not exceed 25% of export value. <div id="87ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87d" NAME="femock27q87" ID="femock27q87d" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Rate of interest, if payable, does not exceed LIBOR plus 1%. <div id="87dcheck" style="display: inline-block;"></div>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q88">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 88. A bank may refuse to accept an export bill for collection </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q88">
					<INPUT TYPE="RADIO" VALUE="88a" NAME="femock27q88" ID="femock27q88a" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> When the customer has sufficient limits under bill discounting facility<div id="88acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="88b" NAME="femock27q88" ID="femock27q88b" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> When the documents have discrepancies when compared to letter of credit requirements<div id="88bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88c" NAME="femock27q88" ID="femock27q88c" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> When the documents are received from a non-customer <div id="88ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88d" NAME="femock27q88" ID="femock27q88d" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> When the documents are received from a customer <div id="88dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q89">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 89. If export cargo is lost in transit, the exporter should </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q89">
					<INPUT TYPE="RADIO" VALUE="89a" NAME="femock27q89" ID="femock27q89a" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Claim under marine insurance <div id="89acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="89b" NAME="femock27q89" ID="femock27q89b" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Claim with ECGC <div id="89bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="89c" NAME="femock27q89" ID="femock27q89c" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Seek write off of post-shipment credit <div id="89ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="89d" NAME="femock27q89" ID="femock27q89d" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Seek refund of customs duty<div id="89dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q90">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 90. Pre-shipment rupee credit from EXIM bank is available for </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q90">
					<INPUT TYPE="RADIO" VALUE="90a" NAME="femock27q90" ID="femock27q90a" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Period up to 180 days <div id="90acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="90b" NAME="femock27q90" ID="femock27q90b" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Period beyond 180 days<div id="90bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="90c" NAME="femock27q90" ID="femock27q90c" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Trunkey projects only<div id="90ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="90d" NAME="femock27q90" ID="femock27q90d" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Foreign currency components only <div id="90dcheck" style="display: inline-block;"></div><BR/><BR/>
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
        
        		<section class="col-lg-12" style="display:none" id="fe27-q91">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 91. Which of the following is not a common feature of direct lending by Exim bank? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q91">
					<INPUT TYPE="RADIO" VALUE="91a" NAME="femock27q91" ID="femock27q91a" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> They are for medium or long term <div id="91acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="91b" NAME="femock27q91" ID="femock27q91b" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The size of the loan is high<div id="91bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91c" NAME="femock27q91" ID="femock27q91c" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Security is not insisted upon. <div id="91ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91d" NAME="femock27q91" ID="femock27q91d" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Interest rates are relatively low <div id="91dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q92">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 92. EXIM bank issues guarantees on behalf of </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q92">
					<INPUT TYPE="RADIO" VALUE="92a" NAME="femock27q92" ID="femock27q92a" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> All exporters from India <div id="92acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="92b" NAME="femock27q92" ID="femock27q92b" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Exporters of construction and turnkey projects <div id="92bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92c" NAME="femock27q92" ID="femock27q92c" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Banks in India <div id="92ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92d" NAME="femock27q92" ID="femock27q92d" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Govt, of India <div id="92dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q93">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 93. Factoring refers to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q93">
					<INPUT TYPE="RADIO" VALUE="93a" NAME="femock27q93" ID="femock27q93a" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Discounting of any export bill <div id="93acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="93b" NAME="femock27q93" ID="femock27q93b" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Discounting of medium term export bill<div id="93bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93c" NAME="femock27q93" ID="femock27q93c" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Writing off unrealized export bill <div id="93ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93d" NAME="femock27q93" ID="femock27q93d" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Waiver of charges on export bills <div id="93dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q94">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 94. Export factoring encourages the following method of payment </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q94">
					<INPUT TYPE="RADIO" VALUE="94a" NAME="femock27q94" ID="femock27q94a" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Open account system <div id="94acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="94b" NAME="femock27q94" ID="femock27q94b" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Letter of credit method <div id="94bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94c" NAME="femock27q94" ID="femock27q94c" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Documentary bill <div id="94ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94d" NAME="femock27q94" ID="femock27q94d" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Advance payment <div id="94dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q95">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 95. Against the pre-shipment credit, the refinance is available from _______ maximum for _______ days: </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q95">
					<INPUT TYPE="RADIO" VALUE="95a" NAME="femock27q95" ID="femock27q95a" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> RBI, 90 days <div id="95acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="95b" NAME="femock27q95" ID="femock27q95b" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> EXIM Bank, 90 days <div id="95bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95c" NAME="femock27q95" ID="femock27q95c" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exim Bank, 180 days <div id="95ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95d" NAME="femock27q95" ID="femock27q95d" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Refinance is not available <div id="95dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q96">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 96. The small exporter's policy of ECGC is issued to </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q96">
					<INPUT TYPE="RADIO" VALUE="96a" NAME="femock27q96" ID="femock27q96a" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Any exporter in the SSI category <div id="96acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="96b" NAME="femock27q96" ID="femock27q96b" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Any exporter who is exempt from excise duty. <div id="96bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96c" NAME="femock27q96" ID="femock27q96c" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> An exporter with expected turnover of Rs. 1 crore. <div id="96ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96d" NAME="femock27q96" ID="femock27q96d" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> An exporter with an anticipated turnover in the next twelve months not exceeding of Rs. 50 lakhs <div id="96dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q97">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 97. The maturity factoring facility of ECGC protects the exporters against </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q97">
					<INPUT TYPE="RADIO" VALUE="97a" NAME="femock27q97" ID="femock27q97a" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Failure of the buyer to obtain authority as per the regulations of his country. <div id="97acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="97b" NAME="femock27q97" ID="femock27q97b" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Risk normally covered by General Insurance. <div id="97bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="97c" NAME="femock27q97" ID="femock27q97c" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Failure of the buyer to pay. <div id="97ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="97d" NAME="femock27q97" ID="femock27q97d" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="97dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q98">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 98. Pre-shipment advances granted in excess of FOB value of contract against duty drawback can be Covered under </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q98">
					<INPUT TYPE="RADIO" VALUE="98a" NAME="femock27q98" ID="femock27q98a" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Packing credit guarantee <div id="98acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="98b" NAME="femock27q98" ID="femock27q98b" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Whole turnover packing credit guarantee <div id="98bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98c" NAME="femock27q98" ID="femock27q98c" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Export production finance guarantee <div id="98ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98d" NAME="femock27q98" ID="femock27q98d" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Export finance guarantee <div id="98dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q99">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 99. Export finance guarantee of ECGC protects</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q99">
					<INPUT TYPE="RADIO" VALUE="99a" NAME="femock27q99" ID="femock27q99a" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Banks providing foreign currency loans to correspondents <div id="99acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="99b" NAME="femock27q99" ID="femock27q99b" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Banks providing foreign currency loans to contractors <div id="99bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99c" NAME="femock27q99" ID="femock27q99c" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Overseas branches financing Indian exports <div id="99ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99d" NAME="femock27q99" ID="femock27q99d" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Overseas branches financing Indian imports. <div id="99dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="fe27-q100">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 100. The risk to a bank in confirming a letter of credit is covered by ECGC under </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock27q100">
					<INPUT TYPE="RADIO" VALUE="100a" NAME="femock27q100" ID="femock27q100a" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Export performance guarantee <div id="100acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="100b" NAME="femock27q100" ID="femock27q100b" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transfer guarantee <div id="100bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="100c" NAME="femock27q100" ID="femock27q100c" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Export finance guarantee <div id="100ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="100d" NAME="femock27q100" ID="femock27q100d" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Import and export finance guarantee <div id="100dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display: none" id="fe27-status">
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