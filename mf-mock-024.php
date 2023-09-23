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
  <title>MF-Mock024 | IBR Live</title>
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
			  //start = new Date().getTime();
			  var myDate3 = new Date(); 
			  localStorage['starttime'] = String(myDate3);
			  
		      time=0;
			  elapsed = '0.0'
			}		
			
			if(parseInt(localStorage.getItem("sec")) <= 0 && parseInt(localStorage.getItem("min")) <0){
				// Stop here. Calculate Score
                checkAnswer();
                localStorage.setItem("started", parseInt(0)); //end quiz flag

				localStorage.removeItem("starttime");
				localStorage.removeItem("min"); 
                localStorage.removeItem("sec"); 
				
				for(var j=1; j<=100; j++){
				  var tempItem1;
				  var tempItem2;
				  
				  tempItem1="q"+i+"status";
				  tempItem2="mfmock24q"+i;
				  
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
			var nid="mf24-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("mf24-status").style.display = "block";
			document.getElementById("mf24-guide").style.display = "none";  
			document.getElementById("mf24-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=100;i++){
				qhid = "mf24-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
                        if(parseInt(localStorage.getItem("started"))==parseInt(24)){

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
                        document.getElementById("mf24-q1").style.display = "block"; 
			document.getElementById("mf24-status").style.display = "block";
			document.getElementById("mf24-guide").style.display = "none"; 
			document.getElementById("mf24-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));
				
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(24)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "mfmock24q"+qno;
			  
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
				
				qval = "mfmock24q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "mfmock24q"+i+"a"; tcheckb = "mfmock24q"+i+"b"; tcheckc = "mfmock24q"+i+"c"; tcheckd = "mfmock24q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "mfmock24q"+i+"a"; tcheckb = "mfmock24q"+i+"b"; tcheckc = "mfmock24q"+i+"c"; tcheckd = "mfmock24q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "mfmock24q"+i+"a"; tcheckb = "mfmock24q"+i+"b"; tcheckc = "mfmock24q"+i+"c"; tcheckd = "mfmock24q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "mfmock24q"+i+"a"; tcheckb = "mfmock24q"+i+"b"; tcheckc = "mfmock24q"+i+"c"; tcheckd = "mfmock24q"+i+"d";
						
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
			$.post('testmf100', {
				data: userans
			}, function(response) {
                var res = response.split("-");

				document.getElementById("endscore").innerHTML = "<font style='color:black; background:#ADFF2F; padding:10px;'><b>Your Score: </b>"+res[0]+"/100";

                var tval=0;
                var tstr;
                var tci;  
                for(var j=0; j<=99; j++){
                    tval=j+1;
                    tstr="status"+tval;
                                  
                    if(String(res[tval])==String(userans[j])){                                 
                        document.getElementById(tstr).style.backgroundColor = "green"; 
                    }else{
                        if(String(userans[j])=='z'){
                            //document.getElementById(tstr).style.backgroundColor = "red";
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
				tLabel = "mfmock24q"+i;
				val = localStorage.getItem(tLabel); 
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('24');

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
			  tempItem2="mfmock24q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>NISM-Series-V-A: Mutual Fund Distributors Certification - Mock Test 24</b></p>
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
          <div class="nav-tabs-custom" id="mf24-guide">
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
				<li class="fli"> Duration of Test: 2 hours. Total questions: 100. Marks: 1 mark per question.</li>
				<li class="fli"> There is no negative marking.</li>
				<li class="fli"> The passing score on the examination is 50%</li>	
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for NISM-Series-V-A: Mutual Fund Distributor Certification Examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('24')">Take the Test</button></li>
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
          <div class="box box-solid " id="mf24-tut">
            <div class="box-header">             

              <i class="fa fa-question-circle"></i>

              <h3 class="box-title">
                <b>Help</b>
              </h3><hr/>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;" align=CENTER>
				<video playsinline autoplay muted loop>
					<source src="options.mp4" type="video/mp4">
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
              <button class="btn btn-primary" onclick="location.href='mf-mock-023'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>           
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
              <button class="btn btn-primary" onclick="location.href='mf-mock-025'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
	
	<section class="col-lg-12" style="display:none" id="mf24-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. Where Mutual Fund can deploy unclaimed dividend and redemption amount?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="mfmock24q1" ID="mfmock24q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In Money Market <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="mfmock24q1" ID="mfmock24q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign Exchange Market <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="mfmock24q1" ID="mfmock24q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Share Market <div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="mfmock24q1" ID="mfmock24q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Debentures <div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. Fundamental Analysis is Evaluation of the strength of the company’s price volume cart?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="mfmock24q2" ID="mfmock24q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="mfmock24q2" ID="mfmock24q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="2bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. According to the certified financier planner – Boards Of Students USA, the first stage in financial planning is _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="mfmock24q3" ID="mfmock24q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Analyze and Evaluate Clients Financial Status. <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="mfmock24q3" ID="mfmock24q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Establish and Define the Client Planner Relationship. <div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="mfmock24q3" ID="mfmock24q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gather Client Data, Define Clients Goals. <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="mfmock24q3" ID="mfmock24q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Develop and Present Financial Planning Recommendations or options. <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. Investment planning for buying a luxury car in next four years is a type of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="mfmock24q4" ID="mfmock24q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Comprehensive financial plan. <div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="mfmock24q4" ID="mfmock24q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Goal oriented financial plan. <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="mfmock24q4" ID="mfmock24q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Need based financial plan. <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="mfmock24q4" ID="mfmock24q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Long term financial plan. <div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Securities issued by the government are called?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="mfmock24q5" ID="mfmock24q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> G-Sec or gilt <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="mfmock24q5" ID="mfmock24q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Commercial papers <div id="5bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5c" NAME="mfmock24q5" ID="mfmock24q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Debentures <div id="5ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5d" NAME="mfmock24q5" ID="mfmock24q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Preference shares <div id="5dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Value Investment Style is an approach of picking up stocks which are priced lower than their intrinsic value?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="mfmock24q6" ID="mfmock24q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="mfmock24q6" ID="mfmock24q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="6bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. Who Invests in the capital of AMC?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="mfmock24q7" ID="mfmock24q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Central Government <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="mfmock24q7" ID="mfmock24q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trustees <div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="mfmock24q7" ID="mfmock24q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="mfmock24q7" ID="mfmock24q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RTA <div id="7dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. Is there a Mutual Fund Trust exempt from tax on its income?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="mfmock24q8" ID="mfmock24q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="mfmock24q8" ID="mfmock24q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="8bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. Capital loss either Short term or Long term cannot be set off against any other head of income?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="mfmock24q9" ID="mfmock24q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="mfmock24q9" ID="mfmock24q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="9bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. Define Mutual Fund Scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="mfmock24q10" ID="mfmock24q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> It is a pool of money. <div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="mfmock24q10" ID="mfmock24q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> It has a preannounced investment objective. <div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="mfmock24q10" ID="mfmock24q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> It is always open to accept money from investors. <div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="mfmock24q10" ID="mfmock24q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B). <div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. What is the process of recovery of unclaimed amount by investor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="mfmock24q11" ID="mfmock24q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> If the investor claim money within 3 years then he gets the payment on current NAV <div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="mfmock24q11" ID="mfmock24q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> If the investors claim money after 3 years then he gets payment on previous NAV at the end of 3 year. <div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="mfmock24q11" ID="mfmock24q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="mfmock24q11" ID="mfmock24q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Only A <div id="11dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. In mutual fund how much loss an investment can bear?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="mfmock24q12" ID="mfmock24q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Up to the investment amount the investor has made. <div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="mfmock24q12" ID="mfmock24q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Up to entry load of scheme. <div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="mfmock24q12" ID="mfmock24q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Up to the exit load of the scheme. <div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="mfmock24q12" ID="mfmock24q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Up to the initial issue expenses of the scheme. <div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. The returns from equity investments are fixed and guaranteed?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="mfmock24q13" ID="mfmock24q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="mfmock24q13" ID="mfmock24q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="13bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. Which of the following statements defines legal structure of Mutual Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="mfmock24q14" ID="mfmock24q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Regulated by SEBI & Mutual Fund is established as a trust. <div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="mfmock24q14" ID="mfmock24q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Mutual Funds are governed by Indian trust act 1882. <div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="mfmock24q14" ID="mfmock24q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Mutual Fund can be created by one or more person. <div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="mfmock24q14" ID="mfmock24q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above. <div id="14dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. What are the steps taken in portfolio building using top down approach?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="mfmock24q15" ID="mfmock24q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Identification of suitable industries- stock selection within the identified industry- analysis of economic factors <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="mfmock24q15" ID="mfmock24q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Stock Selection- suitable industries selection- analysis of economic factors <div id="15bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15c" NAME="mfmock24q15" ID="mfmock24q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Analysis of economic factor- Selection of suitable industries-stock selection within the identified industry <div id="15ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15d" NAME="mfmock24q15" ID="mfmock24q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Identification of suitable industry-analysis of economic factors- stock selection within the identified industry <div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. Who vet the offered document?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="mfmock24q16" ID="mfmock24q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> RBI vet the offered document. <div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="mfmock24q16" ID="mfmock24q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI vet the offered document. <div id="16bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16c" NAME="mfmock24q16" ID="mfmock24q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI vet the offered document. <div id="16ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16d" NAME="mfmock24q16" ID="mfmock24q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above. <div id="16dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. Who can distribute the Mutual Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="mfmock24q17" ID="mfmock24q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Independent financial advisor <div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="mfmock24q17" ID="mfmock24q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Non-bank distributors like brokerage houses, non-banking finance company <div id="17bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17c" NAME="mfmock24q17" ID="mfmock24q17c" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Banks <div id="17ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17d" NAME="mfmock24q17" ID="mfmock24q17d" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="17dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. What are the different types of commission?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="mfmock24q18" ID="mfmock24q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Initial Commission <div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="mfmock24q18" ID="mfmock24q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trail commission <div id="18bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18c" NAME="mfmock24q18" ID="mfmock24q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Only A <div id="18ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18d" NAME="mfmock24q18" ID="mfmock24q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) & (B) <div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. Invested some amount in a scheme then NAV was Rs 12 after some time NAV grown to Rs 15. Calculate the simple return?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="mfmock24q19" ID="mfmock24q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 10% <div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="mfmock24q19" ID="mfmock24q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 25% <div id="19bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19c" NAME="mfmock24q19" ID="mfmock24q19c" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 15% <div id="19ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19d" NAME="mfmock24q19" ID="mfmock24q19d" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 40% <div id="19dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. High yield bond schemes invest in junk bonds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="mfmock24q20" ID="mfmock24q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="mfmock24q20" ID="mfmock24q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="20bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. What is in Person Verification (IPV)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="mfmock24q21" ID="mfmock24q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Face to Face verification by an authorized person for KYC of investor. <div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="mfmock24q21" ID="mfmock24q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Verification by the way of video conferencing  <div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="mfmock24q21" ID="mfmock24q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Verification on account of a fraud conducted by someone <div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="mfmock24q21" ID="mfmock24q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Face to Face verification by anyone for KYC of investor <div id="21dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. Gold Futures are superior to ETF Gold as a vehicle for life long Investment in gold?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="mfmock24q22" ID="mfmock24q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="mfmock24q22" ID="mfmock24q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="22bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. Investment in a debt security entails a return in the form of interest and refund of a pre-specified amount at the end of pre-specified period?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="mfmock24q23" ID="mfmock24q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="mfmock24q23" ID="mfmock24q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="23bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. Is the offer document need to be filed with SEBI?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="mfmock24q24" ID="mfmock24q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="mfmock24q24" ID="mfmock24q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="24bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. EPS=5, P/E=15 Calculate Market Price of the scrip?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="mfmock24q25" ID="mfmock24q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 100 <div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="mfmock24q25" ID="mfmock24q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 75 <div id="25bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25c" NAME="mfmock24q25" ID="mfmock24q25c" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 125 <div id="25ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="25d" NAME="mfmock24q25" ID="mfmock24q25d" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 225 <div id="25dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q26">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 26. Investment in debt portfolio increases as the person grows older is an example of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q26">
					<INPUT TYPE="RADIO" VALUE="26a" NAME="mfmock24q26" ID="mfmock24q26a" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Strategic Asset Allocation <div id="26acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="26b" NAME="mfmock24q26" ID="mfmock24q26b" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Tactical Asset Allocation <div id="26bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26c" NAME="mfmock24q26" ID="mfmock24q26c" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="26ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26d" NAME="mfmock24q26" ID="mfmock24q26d" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="26dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q27">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 27. Risk Appetite of investors is assessed through _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q27">
					<INPUT TYPE="RADIO" VALUE="27a" NAME="mfmock24q27" ID="mfmock24q27a" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Risk Appetizers <div id="27acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="27b" NAME="mfmock24q27" ID="mfmock24q27b" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Asset Allocators <div id="27bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27c" NAME="mfmock24q27" ID="mfmock24q27c" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Risk Profilers <div id="27ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27d" NAME="mfmock24q27" ID="mfmock24q27d" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Financial Plan <div id="27dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q28">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 28. Full form of UIDAI?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q28">
					<INPUT TYPE="RADIO" VALUE="28a" NAME="mfmock24q28" ID="mfmock24q28a" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Urban Identification Authority of India <div id="28acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="28b" NAME="mfmock24q28" ID="mfmock24q28b" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Unique Identity Detailing Authority of India <div id="28bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28c" NAME="mfmock24q28" ID="mfmock24q28c" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Unbiased Identification Authority of India <div id="28ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28d" NAME="mfmock24q28" ID="mfmock24q28d" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Unique Identification Authority of India <div id="28dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q29">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 29. Full form of STT?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q29">
					<INPUT TYPE="RADIO" VALUE="29a" NAME="mfmock24q29" ID="mfmock24q29a" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Service Transaction Tax <div id="29acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="29b" NAME="mfmock24q29" ID="mfmock24q29b" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Security Transaction Tax <div id="29bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29c" NAME="mfmock24q29" ID="mfmock24q29c" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Scheme Transaction Tax  <div id="29ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29d" NAME="mfmock24q29" ID="mfmock24q29d" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Silent Transaction Tax <div id="29dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q30">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 30. Unit certificate are _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q30">
					<INPUT TYPE="RADIO" VALUE="30a" NAME="mfmock24q30" ID="mfmock24q30a" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Transferable <div id="30acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="30b" NAME="mfmock24q30" ID="mfmock24q30b" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Non-Transferable <div id="30bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q31">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 31. On which website final SID is posted before how many days of NFO?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q31">
					<INPUT TYPE="RADIO" VALUE="31a" NAME="mfmock24q31" ID="mfmock24q31a" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMFI’S Website & 2 days before NFO. <div id="31acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="31b" NAME="mfmock24q31" ID="mfmock24q31b" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> CRISIL Website & 2 days before NFO . <div id="31bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31c" NAME="mfmock24q31" ID="mfmock24q31c" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RBI Website & 5 days before NFO . <div id="31ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31d" NAME="mfmock24q31" ID="mfmock24q31d" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> SEBI’S Website & 2 days before NFO. <div id="31dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q32">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 32. Which of the following fund is preferred in case of high inflation, political, economic and fiscal uncertainties?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q32">
					<INPUT TYPE="RADIO" VALUE="32a" NAME="mfmock24q32" ID="mfmock24q32a" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity fund <div id="32acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="32b" NAME="mfmock24q32" ID="mfmock24q32b" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Gold fund <div id="32bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32c" NAME="mfmock24q32" ID="mfmock24q32c" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Debt fund <div id="32ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32d" NAME="mfmock24q32" ID="mfmock24q32d" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Real estate fund <div id="32dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q33">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 33. NAV is calculated as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q33">
					<INPUT TYPE="RADIO" VALUE="33a" NAME="mfmock24q33" ID="mfmock24q33a" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Net asset/ No of unit <div id="33acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="33b" NAME="mfmock24q33" ID="mfmock24q33b" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Net asset/ Face value <div id="33bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="33c" NAME="mfmock24q33" ID="mfmock24q33c" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Net asset * Face value <div id="33ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="33d" NAME="mfmock24q33" ID="mfmock24q33d" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="33dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q34">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 34. What is considered as an international asset?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q34">
					<INPUT TYPE="RADIO" VALUE="34a" NAME="mfmock24q34" ID="mfmock24q34a" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Shares issued by Indian companies <div id="34acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="34b" NAME="mfmock24q34" ID="mfmock24q34b" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Debentures issued by Indian companies <div id="34bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34c" NAME="mfmock24q34" ID="mfmock24q34c" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Real Estate <div id="34ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34d" NAME="mfmock24q34" ID="mfmock24q34d" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gold <div id="34dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q35">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 35. Schemes whose beta is more than one (1) are riskier than the market?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q35">
					<INPUT TYPE="RADIO" VALUE="35a" NAME="mfmock24q35" ID="mfmock24q35a" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="35acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="35b" NAME="mfmock24q35" ID="mfmock24q35b" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="35bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q36">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 36. What kind of investment style is advisable for retirement stage?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q36">
					<INPUT TYPE="RADIO" VALUE="36a" NAME="mfmock24q36" ID="mfmock24q36a" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Hybrid funds with low equity exposure <div id="36acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="36b" NAME="mfmock24q36" ID="mfmock24q36b" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Hybrid Funds with high equity exposure <div id="36bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36c" NAME="mfmock24q36" ID="mfmock24q36c" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Only saving Bank Deposits <div id="36ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36d" NAME="mfmock24q36" ID="mfmock24q36d" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Only Debt <div id="36dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q37">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 37. Risk appetite of an investor is higher with steady jobs?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q37">
					<INPUT TYPE="RADIO" VALUE="37a" NAME="mfmock24q37" ID="mfmock24q37a" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="37acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="37b" NAME="mfmock24q37" ID="mfmock24q37b" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="37bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q38">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 38. Investment planning for daughter’s marriage, son’s college admission & buying a house taken together is a type of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q38">
					<INPUT TYPE="RADIO" VALUE="38a" NAME="mfmock24q38" ID="mfmock24q38a" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Comprehensive Financial plan <div id="38acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="38b" NAME="mfmock24q38" ID="mfmock24q38b" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Goal oriented financial plan <div id="38bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38c" NAME="mfmock24q38" ID="mfmock24q38c" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Need based financial plan <div id="38ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38d" NAME="mfmock24q38" ID="mfmock24q38d" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Long term financial plan <div id="38dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q39">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 39. What is net asset?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q39">
					<INPUT TYPE="RADIO" VALUE="39a" NAME="mfmock24q39" ID="mfmock24q39a" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Unit holders fund in the scheme is commonly referred to as net asset <div id="39acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="39b" NAME="mfmock24q39" ID="mfmock24q39b" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Investment only made in equity scheme is called as net assets <div id="39bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39c" NAME="mfmock24q39" ID="mfmock24q39c" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No. of units held by an Investor is called net assets <div id="39ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39d" NAME="mfmock24q39" ID="mfmock24q39d" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="39dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q40">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 40. Which of the following is the non-government securities-based index?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q40">
					<INPUT TYPE="RADIO" VALUE="40a" NAME="mfmock24q40" ID="mfmock24q40a" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> NSE’S MIBOR <div id="40acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="40b" NAME="mfmock24q40" ID="mfmock24q40b" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> CRISIL liquid FEX <div id="40bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40c" NAME="mfmock24q40" ID="mfmock24q40c" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> CRISIL’S AAA Corporate bond index <div id="40ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40d" NAME="mfmock24q40" ID="mfmock24q40d" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Nifty 50 <div id="40dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q41">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 41. For which investment PAN is not mandatory?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q41">
					<INPUT TYPE="RADIO" VALUE="41a" NAME="mfmock24q41" ID="mfmock24q41a" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> For micro sips, where single investment does not exceed Rs. 50000 <div id="41acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="41b" NAME="mfmock24q41" ID="mfmock24q41b" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> For micro sips, where annual investment does not exceed Rs. 25000 <div id="41bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41c" NAME="mfmock24q41" ID="mfmock24q41c" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> For micro sips, where single investment does not exceed Rs. 25000 <div id="41ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41d" NAME="mfmock24q41" ID="mfmock24q41d" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> For micro sips, where annual investment does not exceed Rs. 50000 <div id="41dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q42">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 42. Who are the beneficiaries of a Mutual Fund Trust?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q42">
					<INPUT TYPE="RADIO" VALUE="42a" NAME="mfmock24q42" ID="mfmock24q42a" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Investors who invest in various schemes. <div id="42acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="42b" NAME="mfmock24q42" ID="mfmock24q42b" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trustees of Mutual fund trust <div id="42bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42c" NAME="mfmock24q42" ID="mfmock24q42c" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="42ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42d" NAME="mfmock24q42" ID="mfmock24q42d" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RTA <div id="42dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q43">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 43. Trail commission are linked to valuation of the portfolio in the market value?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q43">
					<INPUT TYPE="RADIO" VALUE="43a" NAME="mfmock24q43" ID="mfmock24q43a" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="43acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="43b" NAME="mfmock24q43" ID="mfmock24q43b" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="43bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q44">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 44. An investor willing to take additional risk for better returns will prefer to choose _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q44">
					<INPUT TYPE="RADIO" VALUE="44a" NAME="mfmock24q44" ID="mfmock24q44a" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity growth fund <div id="44acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="44b" NAME="mfmock24q44" ID="mfmock24q44b" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Long term gilt fund <div id="44bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44c" NAME="mfmock24q44" ID="mfmock24q44c" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Balanced fund <div id="44ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44d" NAME="mfmock24q44" ID="mfmock24q44d" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Liquid fund <div id="44dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q45">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 45. What can be taken as proof of address as part of KYC documents?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q45">
					<INPUT TYPE="RADIO" VALUE="45a" NAME="mfmock24q45" ID="mfmock24q45a" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Passport, Voter Id <div id="45acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="45b" NAME="mfmock24q45" ID="mfmock24q45b" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Driving License  <div id="45bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45c" NAME="mfmock24q45" ID="mfmock24q45c" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Bank Account Statement, Utility Bills <div id="45ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45d" NAME="mfmock24q45" ID="mfmock24q45d" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="45dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q46">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 46. Consolidated Account Statement details all the holdings across the scheme of all mutual funds and equity shares & it is sent by the post/ email by the 10th day of succeeding month to the investor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q46">
					<INPUT TYPE="RADIO" VALUE="46a" NAME="mfmock24q46" ID="mfmock24q46a" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="46acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="46b" NAME="mfmock24q46" ID="mfmock24q46b" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="46bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q47">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 47. At What time NAV is updated daily on website of AMFI?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q47">
					<INPUT TYPE="RADIO" VALUE="47a" NAME="mfmock24q47" ID="mfmock24q47a" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 9 P.M in case of all schemes and 10 P.M in case of only fund of funds schemes. <div id="47acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="47b" NAME="mfmock24q47" ID="mfmock24q47b" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> NAV is not updated daily. <div id="47bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47c" NAME="mfmock24q47" ID="mfmock24q47c" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 3 P.M in case of all schemes and 10 P.M in case of only fund of funds schemes. <div id="47ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47d" NAME="mfmock24q47" ID="mfmock24q47d" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 12 P.M in case of all schemes and 10 P.M in case of only fund of funds schemes. <div id="47dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q48">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 48. Which of the following funds suits the investor who want equity exposure but with lower risk?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q48">
					<INPUT TYPE="RADIO" VALUE="48a" NAME="mfmock24q48" ID="mfmock24q48a" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Thematic Funds <div id="48acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="48b" NAME="mfmock24q48" ID="mfmock24q48b" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Hybrid fund <div id="48bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="48c" NAME="mfmock24q48" ID="mfmock24q48c" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sector specific equity fund <div id="48ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="48d" NAME="mfmock24q48" ID="mfmock24q48d" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Diversified equity fund <div id="48dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q49">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 49. Fund accounting activity of the scheme is to be compulsorily outsourced?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q49">
					<INPUT TYPE="RADIO" VALUE="49a" NAME="mfmock24q49" ID="mfmock24q49a" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="49acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="49b" NAME="mfmock24q49" ID="mfmock24q49b" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="49bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q50">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 50.The post-tax returns to all investors in dividend payout option & growth option will remain same?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q50">
					<INPUT TYPE="RADIO" VALUE="50a" NAME="mfmock24q50" ID="mfmock24q50a" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> No, since tax applicable on interest & capital loss earned are different. <div id="50acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="50b" NAME="mfmock24q50" ID="mfmock24q50b" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Yes, since tax applicable on dividend & capital gains earned are same. <div id="50bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50c" NAME="mfmock24q50" ID="mfmock24q50c" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No, since tax applicable on dividend & capital gains earned are different. <div id="50ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50d" NAME="mfmock24q50" ID="mfmock24q50d" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Yes, since tax applicable on interest & capital loss earned are different. <div id="50dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q51">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 51. If the dividend is not dispatched within 30 days, then interest is paid by AMC to its holder by what percent?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q51">
					<INPUT TYPE="RADIO" VALUE="51a" NAME="mfmock24q51" ID="mfmock24q51a" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 10% <div id="51acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="51b" NAME="mfmock24q51" ID="mfmock24q51b" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5% <div id="51bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51c" NAME="mfmock24q51" ID="mfmock24q51c" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 15% <div id="51ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51d" NAME="mfmock24q51" ID="mfmock24q51d" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 20% <div id="51dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q52">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 52. Which of the following is a type of hybrid fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q52">
					<INPUT TYPE="RADIO" VALUE="52a" NAME="mfmock24q52" ID="mfmock24q52a" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> ELSS <div id="52acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="52b" NAME="mfmock24q52" ID="mfmock24q52b" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Capital protected funds <div id="52bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52c" NAME="mfmock24q52" ID="mfmock24q52c" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gilt funds <div id="52ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52d" NAME="mfmock24q52" ID="mfmock24q52d" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Floating rate funds <div id="52dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q53">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 53. Which Fund is not a specialty fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q53">
					<INPUT TYPE="RADIO" VALUE="53a" NAME="mfmock24q53" ID="mfmock24q53a" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Diversified equity funds <div id="53acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="53b" NAME="mfmock24q53" ID="mfmock24q53b" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sector fund <div id="53bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53c" NAME="mfmock24q53" ID="mfmock24q53c" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Diversified debt fund <div id="53ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53d" NAME="mfmock24q53" ID="mfmock24q53d" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Thematic fund <div id="53dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q54">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 54. Risk Appetite of an investor is higher with longer life expectancy?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q54">
					<INPUT TYPE="RADIO" VALUE="54a" NAME="mfmock24q54" ID="mfmock24q54a" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="54acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="54b" NAME="mfmock24q54" ID="mfmock24q54b" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="54bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q55">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 55. Minimum Net worth Requirement for a setting up a new AMC is _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q55">
					<INPUT TYPE="RADIO" VALUE="55a" NAME="mfmock24q55" ID="mfmock24q55a" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 50 Crore <div id="55acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="55b" NAME="mfmock24q55" ID="mfmock24q55b" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 Crore <div id="55bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55c" NAME="mfmock24q55" ID="mfmock24q55c" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 10 Crore <div id="55ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55d" NAME="mfmock24q55" ID="mfmock24q55d" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 4 Crore <div id="55dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q56">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 56. What is a non-traded security?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q56">
					<INPUT TYPE="RADIO" VALUE="56a" NAME="mfmock24q56" ID="mfmock24q56a" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Which has not been traded for 30 days prior to valuation date <div id="56acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="56b" NAME="mfmock24q56" ID="mfmock24q56b" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Which has not been traded for 60 days prior to valuation date <div id="56bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56c" NAME="mfmock24q56" ID="mfmock24q56c" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> which has not been traded for 90 days prior to valuation date <div id="56ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56d" NAME="mfmock24q56" ID="mfmock24q56d" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> which has not been traded for 120 days prior to valuation date <div id="56dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q57">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 57. Full form of SAI?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q57">
					<INPUT TYPE="RADIO" VALUE="57a" NAME="mfmock24q57" ID="mfmock24q57a" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Statement of additional information. <div id="57acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="57b" NAME="mfmock24q57" ID="mfmock24q57b" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Schemes of additional information. <div id="57bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57c" NAME="mfmock24q57" ID="mfmock24q57c" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> System Additional Information. <div id="57ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57d" NAME="mfmock24q57" ID="mfmock24q57d" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the Above. <div id="57dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q58">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 58. What is KIM?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q58">
					<INPUT TYPE="RADIO" VALUE="58a" NAME="mfmock24q58" ID="mfmock24q58a" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> KIM is a summary of KYC <div id="58acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="58b" NAME="mfmock24q58" ID="mfmock24q58b" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> KIM is a summary of SAI & SID <div id="58bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58c" NAME="mfmock24q58" ID="mfmock24q58c" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> None of the above <div id="58ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58d" NAME="mfmock24q58" ID="mfmock24q58d" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="58dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q59">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 59. Trail commission is paid by AMC on Quarterly Basis?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q59">
					<INPUT TYPE="RADIO" VALUE="59a" NAME="mfmock24q59" ID="mfmock24q59a" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="59acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="59b" NAME="mfmock24q59" ID="mfmock24q59b" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="59bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q60">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 60. Physical assets have more liquidity than financial assets?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q60">
					<INPUT TYPE="RADIO" VALUE="60a" NAME="mfmock24q60" ID="mfmock24q60a" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="60acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="60b" NAME="mfmock24q60" ID="mfmock24q60b" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="60bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q61">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 61. Providing Funds for a Daughter’s Marriage is an example of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q61">
					<INPUT TYPE="RADIO" VALUE="61a" NAME="mfmock24q61" ID="mfmock24q61a" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Goal Oriented Financial Plan <div id="61acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="61b" NAME="mfmock24q61" ID="mfmock24q61b" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Comprehensive Financial Plan <div id="61bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61c" NAME="mfmock24q61" ID="mfmock24q61c" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Financial Goal <div id="61ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61d" NAME="mfmock24q61" ID="mfmock24q61d" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the Above <div id="61dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q62">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 62. Investor can get in to long term investments commitment in _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q62">
					<INPUT TYPE="RADIO" VALUE="62a" NAME="mfmock24q62" ID="mfmock24q62a" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Distribution Phase <div id="62acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="62b" NAME="mfmock24q62" ID="mfmock24q62b" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transition Phase <div id="62bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="62c" NAME="mfmock24q62" ID="mfmock24q62c" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Inter-Generational Phase <div id="62ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="62d" NAME="mfmock24q62" ID="mfmock24q62d" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Accumulation Phase <div id="62dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q63">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 63. What is a yield?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q63">
					<INPUT TYPE="RADIO" VALUE="63a" NAME="mfmock24q63" ID="mfmock24q63a" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Yield is a return that an investor earns on a debt security <div id="63acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="63b" NAME="mfmock24q63" ID="mfmock24q63b" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Yield is a combination of interest and capital gain, if the redemption proceed is higher than the amount invested <div id="63bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63c" NAME="mfmock24q63" ID="mfmock24q63c" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Yield is a combination of interest and capital loss, if the redemption proceeds are lower than the amount invested. <div id="63ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63d" NAME="mfmock24q63" ID="mfmock24q63d" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="63dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q64">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 64. Monthly income plan is a type of _____?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q64">
					<INPUT TYPE="RADIO" VALUE="64a" NAME="mfmock24q64" ID="mfmock24q64a" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Debt funds <div id="64acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="64b" NAME="mfmock24q64" ID="mfmock24q64b" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity funds <div id="64bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64c" NAME="mfmock24q64" ID="mfmock24q64c" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Hybrid funds <div id="64ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64d" NAME="mfmock24q64" ID="mfmock24q64d" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="64dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q65">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 65. In case of sudden wealth creation by winning lotteries or very high capital gains, What is advisable as an immediate course of action?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q65">
					<INPUT TYPE="RADIO" VALUE="65a" NAME="mfmock24q65" ID="mfmock24q65a" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Park the money in liquid scheme <div id="65acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="65b" NAME="mfmock24q65" ID="mfmock24q65b" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Invest the money in equity scheme <div id="65bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65c" NAME="mfmock24q65" ID="mfmock24q65c" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Invest the money in real estate <div id="65ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65d" NAME="mfmock24q65" ID="mfmock24q65d" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Invest the money in international funds<div id="65dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q66">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 66. Daring & adventurous people with better mental state have higher risk appetite?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q66">
					<INPUT TYPE="RADIO" VALUE="66a" NAME="mfmock24q66" ID="mfmock24q66a" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="66acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="66b" NAME="mfmock24q66" ID="mfmock24q66b" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="66bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q67">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 67. What documents are mandatory for KYC registration of power of attorney holder (POA)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q67">
					<INPUT TYPE="RADIO" VALUE="67a" NAME="mfmock24q67" ID="mfmock24q67a" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Address & Identity proof of both investor & POA holder <div id="67acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="67b" NAME="mfmock24q67" ID="mfmock24q67b" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> PAN Card of POA holder <div id="67bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="67c" NAME="mfmock24q67" ID="mfmock24q67c" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Aadhaar card of POA holder is enough <div id="67ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="67d" NAME="mfmock24q67" ID="mfmock24q67d" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> PAN & AADHAAR of POA holder <div id="67dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q68">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 68. The Asset Allocation that is worked out for an investor based on risk profiling is called _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q68">
					<INPUT TYPE="RADIO" VALUE="68a" NAME="mfmock24q68" ID="mfmock24q68a" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Tactical Asset Allocation <div id="68acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="68b" NAME="mfmock24q68" ID="mfmock24q68b" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Fixed Asset Allocation <div id="68bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68c" NAME="mfmock24q68" ID="mfmock24q68c" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Flexible Asset Allocation <div id="68ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68d" NAME="mfmock24q68" ID="mfmock24q68d" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Strategic Asset Allocation <div id="68dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q69">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 69. Which of the following aspects of portfolio would an investor in a debt scheme give most importance?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q69">
					<INPUT TYPE="RADIO" VALUE="69a" NAME="mfmock24q69" ID="mfmock24q69a" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sector Selection <div id="69acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="69b" NAME="mfmock24q69" ID="mfmock24q69b" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Stock Selection <div id="69bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69c" NAME="mfmock24q69" ID="mfmock24q69c" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Weighted Average Maturity <div id="69ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69d" NAME="mfmock24q69" ID="mfmock24q69d" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Number of Securities in Portfolio <div id="69dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q70">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 70. Trust Deed is Executed between whom?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q70">
					<INPUT TYPE="RADIO" VALUE="70a" NAME="mfmock24q70" ID="mfmock24q70a" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sponsor and Trustee <div id="70acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="70b" NAME="mfmock24q70" ID="mfmock24q70b" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sponsor and RTA <div id="70bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70c" NAME="mfmock24q70" ID="mfmock24q70c" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor and Investors <div id="70ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70d" NAME="mfmock24q70" ID="mfmock24q70d" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Sponsor and AMC <div id="70dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q71">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 71. Which equity mutual fund is considered to have lowest risk?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q71">
					<INPUT TYPE="RADIO" VALUE="71a" NAME="mfmock24q71" ID="mfmock24q71a" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sector specific funds <div id="71acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="71b" NAME="mfmock24q71" ID="mfmock24q71b" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Small cap funds <div id="71bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71c" NAME="mfmock24q71" ID="mfmock24q71c" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Mid cap funds <div id="71ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71d" NAME="mfmock24q71" ID="mfmock24q71d" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Arbitrage funds <div id="71dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q72">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 72. When investors opt for the safer root of offering for re-purchase a constant value of units over a period, it is called as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q72">
					<INPUT TYPE="RADIO" VALUE="72a" NAME="mfmock24q72" ID="mfmock24q72a" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Systematic Withdrawal Plan (SWP) <div id="72acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="72b" NAME="mfmock24q72" ID="mfmock24q72b" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Systematic Investment Plan (SIP) <div id="72bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72c" NAME="mfmock24q72" ID="mfmock24q72c" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Straight Through Processing (STP) <div id="72ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72d" NAME="mfmock24q72" ID="mfmock24q72d" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="72dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q73">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 73. Who can be a sponsor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q73">
					<INPUT TYPE="RADIO" VALUE="73a" NAME="mfmock24q73" ID="mfmock24q73a" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Any Indian Institution <div id="73acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="73b" NAME="mfmock24q73" ID="mfmock24q73b" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Any Foreign Institution <div id="73bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73c" NAME="mfmock24q73" ID="mfmock24q73c" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Any Indian or Foreign predominantly Joint Venture <div id="73ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73d" NAME="mfmock24q73" ID="mfmock24q73d" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="73dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q74">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 74. AMC’s are member of which organization?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q74">
					<INPUT TYPE="RADIO" VALUE="74a" NAME="mfmock24q74" ID="mfmock24q74a" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMFI <div id="74acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="74b" NAME="mfmock24q74" ID="mfmock24q74b" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="74bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74c" NAME="mfmock24q74" ID="mfmock24q74c" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RBI <div id="74ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74d" NAME="mfmock24q74" ID="mfmock24q74d" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> NSE <div id="74dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q75">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 75. What is a Record Date?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q75">
					<INPUT TYPE="RADIO" VALUE="75a" NAME="mfmock24q75" ID="mfmock24q75a" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Record Date is used as cut off to determine the eligibility to receive the dividend by investors. <div id="75acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="75b" NAME="mfmock24q75" ID="mfmock24q75b" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Record Date is used as cut off to determine the penalty to be charged from investors. <div id="75bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75c" NAME="mfmock24q75" ID="mfmock24q75c" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Record Date is used as cut off to calculate the NAV of the fund. <div id="75ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75d" NAME="mfmock24q75" ID="mfmock24q75d" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above. <div id="75dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q76">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 76. Suppose you invested 10000 in a bank deposit for 3 years at the rate of 10% P.A. please calculate the compounded value of your investment at the end of 3 year?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q76">
					<INPUT TYPE="RADIO" VALUE="76a" NAME="mfmock24q76" ID="mfmock24q76a" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 13310 <div id="76acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="76b" NAME="mfmock24q76" ID="mfmock24q76b" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 13000 <div id="76bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="76c" NAME="mfmock24q76" ID="mfmock24q76c" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 12310 <div id="76ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="76d" NAME="mfmock24q76" ID="mfmock24q76d" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 13210 <div id="76dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q77">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 77. What is a significance unit holder?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q77">
					<INPUT TYPE="RADIO" VALUE="77a" NAME="mfmock24q77" ID="mfmock24q77a" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Any investor holding 5% or less of a scheme of a mutual fund <div id="77acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="77b" NAME="mfmock24q77" ID="mfmock24q77b" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Any investor holding 5% or more of a scheme of a mutual fund <div id="77bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77c" NAME="mfmock24q77" ID="mfmock24q77c" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both of the above <div id="77ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77d" NAME="mfmock24q77" ID="mfmock24q77d" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="77dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q78">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 78. A nomination cannot be made in favor of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q78">
					<INPUT TYPE="RADIO" VALUE="78a" NAME="mfmock24q78" ID="mfmock24q78a" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Trust <div id="78acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="78b" NAME="mfmock24q78" ID="mfmock24q78b" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Partnership <div id="78bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78c" NAME="mfmock24q78" ID="mfmock24q78c" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Society <div id="78ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78d" NAME="mfmock24q78" ID="mfmock24q78d" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the Above <div id="78dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q79">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 79. Permanent retirement account number (PRAN) is not portable?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q79">
					<INPUT TYPE="RADIO" VALUE="79a" NAME="mfmock24q79" ID="mfmock24q79a" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="79acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="79b" NAME="mfmock24q79" ID="mfmock24q79b" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="79bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q80">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 80. Which of the following investments are available for young unmarried people?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q80">
					<INPUT TYPE="RADIO" VALUE="80a" NAME="mfmock24q80" ID="mfmock24q80a" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity <div id="80acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="80b" NAME="mfmock24q80" ID="mfmock24q80b" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Debt <div id="80bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80c" NAME="mfmock24q80" ID="mfmock24q80c" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Hybrid <div id="80ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80d" NAME="mfmock24q80" ID="mfmock24q80d" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bank Deposit <div id="80dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q81">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 81. What are the advantages of mutual fund for investors?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q81">
					<INPUT TYPE="RADIO" VALUE="81a" NAME="mfmock24q81" ID="mfmock24q81a" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Professional management, affordable portfolio diversification <div id="81acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="81b" NAME="mfmock24q81" ID="mfmock24q81b" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Economies of scale <div id="81bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81c" NAME="mfmock24q81" ID="mfmock24q81c" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Tax deferral/benefit <div id="81ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81d" NAME="mfmock24q81" ID="mfmock24q81d" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above. <div id="81dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q82">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 82. Who is a custodian?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q82">
					<INPUT TYPE="RADIO" VALUE="82a" NAME="mfmock24q82" ID="mfmock24q82a" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Who keeps the custody or safekeeping of the assets of the scheme. <div id="82acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="82b" NAME="mfmock24q82" ID="mfmock24q82b" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Who handles the day to day operations of AMC. <div id="82bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82c" NAME="mfmock24q82" ID="mfmock24q82c" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Who Keep records of the sale and purchase of securities. <div id="82ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82d" NAME="mfmock24q82" ID="mfmock24q82d" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Who keep record of day to day expenses of the scheme. <div id="82dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q83">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 83. Risk appetite of an investor decreases as the number of dependent members increases?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q83">
					<INPUT TYPE="RADIO" VALUE="83a" NAME="mfmock24q83" ID="mfmock24q83a" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="83acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="83b" NAME="mfmock24q83" ID="mfmock24q83b" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="83bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q84">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 84. Security Transaction Tax is applicable to Equity Schemes?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q84">
					<INPUT TYPE="RADIO" VALUE="84a" NAME="mfmock24q84" ID="mfmock24q84a" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="84acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="84b" NAME="mfmock24q84" ID="mfmock24q84b" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="84bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q85">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 85. The Objective of Asset Allocation is Risk Management.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q85">
					<INPUT TYPE="RADIO" VALUE="85a" NAME="mfmock24q85" ID="mfmock24q85a" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="85acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="85b" NAME="mfmock24q85" ID="mfmock24q85b" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="85bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q86">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 86. What is true in case of bonds & debentures?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q86">
					<INPUT TYPE="RADIO" VALUE="86a" NAME="mfmock24q86" ID="mfmock24q86a" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bonds are issued for tenors beyond a year <div id="86acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="86b" NAME="mfmock24q86" ID="mfmock24q86b" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Government & public companies issue bonds <div id="86bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86c" NAME="mfmock24q86" ID="mfmock24q86c" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Private sector companies issue debentures <div id="86ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86d" NAME="mfmock24q86" ID="mfmock24q86d" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="86dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q87">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 87. SEBI has prescribed maximum exit load of___ percent if investor exited from the scheme within a year?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q87">
					<INPUT TYPE="RADIO" VALUE="87a" NAME="mfmock24q87" ID="mfmock24q87a" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 7 <div id="87acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="87b" NAME="mfmock24q87" ID="mfmock24q87b" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 <div id="87bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87c" NAME="mfmock24q87" ID="mfmock24q87c" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 2 <div id="87ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87d" NAME="mfmock24q87" ID="mfmock24q87d" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 6 <div id="87dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q88">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 88. Types of hybrid or balanced funds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q88">
					<INPUT TYPE="RADIO" VALUE="88a" NAME="mfmock24q88" ID="mfmock24q88a" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Monthly income plans <div id="88acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="88b" NAME="mfmock24q88" ID="mfmock24q88b" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Capital protected shares <div id="88bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88c" NAME="mfmock24q88" ID="mfmock24q88c" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both of the above <div id="88ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88d" NAME="mfmock24q88" ID="mfmock24q88d" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="88dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q89">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 89. Distribution Phase of wealth cycle is a parallel of retirement phase of life cycle.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q89">
					<INPUT TYPE="RADIO" VALUE="89a" NAME="mfmock24q89" ID="mfmock24q89a" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="89acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="89b" NAME="mfmock24q89" ID="mfmock24q89b" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="89bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q90">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 90. Which of the following options have the benefit of letting the money grow in the fund on gross basis?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q90">
					<INPUT TYPE="RADIO" VALUE="90a" NAME="mfmock24q90" ID="mfmock24q90a" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Dividend payout option <div id="90acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="90b" NAME="mfmock24q90" ID="mfmock24q90b" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Growth option <div id="90bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="90c" NAME="mfmock24q90" ID="mfmock24q90c" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Dividend reinvestment option <div id="90ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="90d" NAME="mfmock24q90" ID="mfmock24q90d" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="90dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q91">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 91. Most investor service centers are offices of _____?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q91">
					<INPUT TYPE="RADIO" VALUE="91a" NAME="mfmock24q91" ID="mfmock24q91a" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Trustee <div id="91acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="91b" NAME="mfmock24q91" ID="mfmock24q91b" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Registrar <div id="91bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91c" NAME="mfmock24q91" ID="mfmock24q91c" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Custodian  <div id="91ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91d" NAME="mfmock24q91" ID="mfmock24q91d" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Fund Accountant <div id="91dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q92">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 92. Which of the following schemes are exempt from paying DDT?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q92">
					<INPUT TYPE="RADIO" VALUE="92a" NAME="mfmock24q92" ID="mfmock24q92a" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity Fund <div id="92acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="92b" NAME="mfmock24q92" ID="mfmock24q92b" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Liquid Fund <div id="92bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92c" NAME="mfmock24q92" ID="mfmock24q92c" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gilt Fund <div id="92ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92d" NAME="mfmock24q92" ID="mfmock24q92d" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Fixed Maturity Plan <div id="92dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q93">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 93. Sponsors must contribute a minimum of Rs _____ as initial contribution to the corpus of the mutual fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q93">
					<INPUT TYPE="RADIO" VALUE="93a" NAME="mfmock24q93" ID="mfmock24q93a" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 200000 <div id="93acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="93b" NAME="mfmock24q93" ID="mfmock24q93b" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5000000 <div id="93bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93c" NAME="mfmock24q93" ID="mfmock24q93c" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 150000 <div id="93ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93d" NAME="mfmock24q93" ID="mfmock24q93d" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 100000 <div id="93dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q94">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 94. Full form of ACE’S?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q94">
					<INPUT TYPE="RADIO" VALUE="94a" NAME="mfmock24q94" ID="mfmock24q94a" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Assets Classification Enrollment <div id="94acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="94b" NAME="mfmock24q94" ID="mfmock24q94b" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> AMFI Customer Engagement <div id="94bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94c" NAME="mfmock24q94" ID="mfmock24q94c" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI code of ethics <div id="94ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94d" NAME="mfmock24q94" ID="mfmock24q94d" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AMFI Certificate of Excellence <div id="94dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q95">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 95. What is CDSC?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q95">
					<INPUT TYPE="RADIO" VALUE="95a" NAME="mfmock24q95" ID="mfmock24q95a" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> When the entry load is charged high for one year and low after two and very low after three years such load structure is called CDSC. <div id="95acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="95b" NAME="mfmock24q95" ID="mfmock24q95b" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> When the exit load is charged high for one year and low after two and very low after three years such load structure is called CDSC. <div id="95bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95c" NAME="mfmock24q95" ID="mfmock24q95c" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> When the exit load is charged very low for one year and low after two and high after three years such load structure is called CDSC. <div id="95ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95d" NAME="mfmock24q95" ID="mfmock24q95d" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> When the entry load is charged very low for one year and low after two and high after three years such load structure is called CDSC. <div id="95dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q96">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 96. Risk appetite of an investor decreases as the number of earning members increases?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q96">
					<INPUT TYPE="RADIO" VALUE="96a" NAME="mfmock24q96" ID="mfmock24q96a" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="96acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="96b" NAME="mfmock24q96" ID="mfmock24q96b" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="96bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q97">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 97. What are the steps taken in portfolio building using bottom up approach?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q97">
					<INPUT TYPE="RADIO" VALUE="97a" NAME="mfmock24q97" ID="mfmock24q97a" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Identification of suitable industries- stock selection within the identified industry- analysis of economic factors. <div id="97acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="97b" NAME="mfmock24q97" ID="mfmock24q97b" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Analysis of economic factor- Selection of suitable industries-stock selection within the identified industry. <div id="97bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="97c" NAME="mfmock24q97" ID="mfmock24q97c" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Identification of suitable industry-analysis of economic factors- stock selection within the identified industry. <div id="97ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="97d" NAME="mfmock24q97" ID="mfmock24q97d" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Analysis of company specific factor-industry factor-macro economic factors. <div id="97dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q98">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 98. Custodian must be registered with?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q98">
					<INPUT TYPE="RADIO" VALUE="98a" NAME="mfmock24q98" ID="mfmock24q98a" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> SEBI <div id="98acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="98b" NAME="mfmock24q98" ID="mfmock24q98b" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> RBI <div id="98bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98c" NAME="mfmock24q98" ID="mfmock24q98c" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> NSDL <div id="98ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98d" NAME="mfmock24q98" ID="mfmock24q98d" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="98dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q99">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 99. For equity schemes, which of the following is suitable benchmark?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q99">
					<INPUT TYPE="RADIO" VALUE="99a" NAME="mfmock24q99" ID="mfmock24q99a" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sensex <div id="99acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="99b" NAME="mfmock24q99" ID="mfmock24q99b" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Nifty <div id="99bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99c" NAME="mfmock24q99" ID="mfmock24q99c" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="99ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99d" NAME="mfmock24q99" ID="mfmock24q99d" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> CRISIL BanaCEX. <div id="99dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf24-q100">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 100. What is systematic Investment Plan?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock24q100">
					<INPUT TYPE="RADIO" VALUE="100a" NAME="mfmock24q100" ID="mfmock24q100a" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> SIP Averages the unit holder's cost of acquisition. <div id="100acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="100b" NAME="mfmock24q100" ID="mfmock24q100b" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> More units are bought for the same amount of investment, when the price/ market is down <div id="100bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="100c" NAME="mfmock24q100" ID="mfmock24q100c" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Fewer units are bought for the same amount of investment when the price/ markets are high <div id="100ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="100d" NAME="mfmock24q100" ID="mfmock24q100d" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="100dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		
        <section class="col-lg-12" style="display: none" id="mf24-status">
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