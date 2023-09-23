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
  <title>MF-Mock023 | IBR Live</title>
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
				  tempItem2="mfmock23q"+i;
				  
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
			var nid="mf23-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("mf22-status").style.display = "block";
			document.getElementById("mf23-guide").style.display = "none";  
			document.getElementById("mf23-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=100;i++){
				qhid = "mf23-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
                        if(parseInt(localStorage.getItem("started"))==parseInt(23)){

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
                        document.getElementById("mf23-q1").style.display = "block"; 
			document.getElementById("mf22-status").style.display = "block";
			document.getElementById("mf23-guide").style.display = "none"; 
			document.getElementById("mf23-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));
				
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(23)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "mfmock23q"+qno;
			  
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
				
				qval = "mfmock23q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "mfmock23q"+i+"a"; tcheckb = "mfmock23q"+i+"b"; tcheckc = "mfmock23q"+i+"c"; tcheckd = "mfmock23q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "mfmock23q"+i+"a"; tcheckb = "mfmock23q"+i+"b"; tcheckc = "mfmock23q"+i+"c"; tcheckd = "mfmock23q"+i+"d";
						
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "mfmock23q"+i+"a"; tcheckb = "mfmock23q"+i+"b"; tcheckc = "mfmock23q"+i+"c"; tcheckd = "mfmock23q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "mfmock23q"+i+"a"; tcheckb = "mfmock23q"+i+"b"; tcheckc = "mfmock23q"+i+"c"; tcheckd = "mfmock23q"+i+"d";
						
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
				tLabel = "mfmock23q"+i;
				val = localStorage.getItem(tLabel); 
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('23');

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
			  tempItem2="mfmock23q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>NISM-Series-V-A: Mutual Fund Distributors Certification - Mock Test 23</b></p>
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
          <div class="nav-tabs-custom" id="mf23-guide">
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
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('23')">Take the Test</button></li>
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
          <div class="box box-solid " id="mf23-tut">
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
              <button class="btn btn-primary" onclick="location.href='mf-mock-022'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>           
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
              <button class="btn btn-primary" onclick="location.href='mf-mock-024'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
	
	<section class="col-lg-12" style="display:none" id="mf23-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. What is KIM?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="mfmock23q1" ID="mfmock23q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> KIM is a summary of KYC <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="mfmock23q1" ID="mfmock23q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> KIM is a summary of SAI & SID <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="mfmock23q1" ID="mfmock23q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> None of the above<div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="mfmock23q1" ID="mfmock23q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above<div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. When does a scheme is called equity oriented?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="mfmock23q2" ID="mfmock23q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> More than 85% of the scheme funds are invested in equity shares. <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="mfmock23q2" ID="mfmock23q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 100% of the scheme funds are invested in equity shares. <div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="mfmock23q2" ID="mfmock23q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> More than 65% of the scheme funds are invested in equity shares. <div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="mfmock23q2" ID="mfmock23q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> More than 90% of the scheme funds are invested in equity shares. <div id="2dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. Which of the following benchmarks is appropriate for liquid schemes?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="mfmock23q3" ID="mfmock23q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Nifty 50 <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="mfmock23q3" ID="mfmock23q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> BSE Sensex <div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="mfmock23q3" ID="mfmock23q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Nifty infrastructure index <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="mfmock23q3" ID="mfmock23q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> NSE’S MIBOR <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. Which of the following statements defines legal structure of Mutual Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="mfmock23q4" ID="mfmock23q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Regulated by SEBI & Mutual Fund is established as a trust. <div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="mfmock23q4" ID="mfmock23q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Mutual Funds are governed by Indian trust act 1882. <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="mfmock23q4" ID="mfmock23q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Mutual Fund can be created by one or more person. <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="mfmock23q4" ID="mfmock23q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above. <div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Long term Debt funds earns capital gains in rising interest rate scenario?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="mfmock23q5" ID="mfmock23q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="mfmock23q5" ID="mfmock23q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="5bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Monthly income plan is a type of _____ ?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="mfmock23q6" ID="mfmock23q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Debt funds <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="mfmock23q6" ID="mfmock23q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity funds <div id="6bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6c" NAME="mfmock23q6" ID="mfmock23q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Hybrid funds <div id="6ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6d" NAME="mfmock23q6" ID="mfmock23q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. Arbitrage funds are meant to give better equity risk exposure.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="mfmock23q7" ID="mfmock23q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="mfmock23q7" ID="mfmock23q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="7bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. Security Transaction Tax is applicable to Equity Schemes?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="mfmock23q8" ID="mfmock23q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="mfmock23q8" ID="mfmock23q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="8bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. Gilt schemes have a higher price risk because there NAV can fluctuate a lot more, on account of changes in yield in the market?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="mfmock23q9" ID="mfmock23q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="mfmock23q9" ID="mfmock23q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="9bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. A high standard deviation indicated greater volatility in the returns & greater risk?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="mfmock23q10" ID="mfmock23q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="mfmock23q10" ID="mfmock23q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="10bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. Original documents of identity & Address proof are mandatory to be verified with the copies provided by investor for KYC updation?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="mfmock23q11" ID="mfmock23q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="mfmock23q11" ID="mfmock23q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="11bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. Who is not required to comply with KYD/ bio metric requirement?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="mfmock23q12" ID="mfmock23q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Everyone is Exempted <div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="mfmock23q12" ID="mfmock23q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The new cadre of distributors who should have experience of at least 10 years in govt. post office or bank service are exempted. <div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="mfmock23q12" ID="mfmock23q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No one is exempted <div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="mfmock23q12" ID="mfmock23q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. STP is a combination of SIP & SWP?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="mfmock23q13" ID="mfmock23q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="mfmock23q13" ID="mfmock23q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="13bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. Investment in land, gold or other physical assets does not benefit the economy while investment in financial assets like mutual funds, shares, and debentures is productive for economy?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="mfmock23q14" ID="mfmock23q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="mfmock23q14" ID="mfmock23q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="14bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. Which of the following is truly International asset class?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="mfmock23q15" ID="mfmock23q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Real Estate <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="mfmock23q15" ID="mfmock23q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity <div id="15bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15c" NAME="mfmock23q15" ID="mfmock23q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Debt <div id="15ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15d" NAME="mfmock23q15" ID="mfmock23q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gold <div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. Identify the stage of wealth cycle when a person is in earning age and builds his wealth?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="mfmock23q16" ID="mfmock23q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Accumulation <div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="mfmock23q16" ID="mfmock23q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transition <div id="16bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16c" NAME="mfmock23q16" ID="mfmock23q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Reaping/ Distribution <div id="16ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16d" NAME="mfmock23q16" ID="mfmock23q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Inter-generational transfer <div id="16dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. When the scheme has been existed for less than 1 year passed performance is not provided?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="mfmock23q17" ID="mfmock23q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="mfmock23q17" ID="mfmock23q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="17bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. What is SEBI’S 20.25 Rule?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="mfmock23q18" ID="mfmock23q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Minimum 20 investors in a scheme and no investor should more than 25% of net assets of a scheme. <div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="mfmock23q18" ID="mfmock23q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Maximum investment by an investor in a scheme can be 20% and minimum 25 investors are mandatory. <div id="18bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18c" NAME="mfmock23q18" ID="mfmock23q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Maximum investors in a scheme can be only 20 only and minimum investment by an investor should be at least 20%. <div id="18ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18d" NAME="mfmock23q18" ID="mfmock23q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Minimum investment by an investor should be 20% and maximum investors can be 25. <div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. Mid cap and small cap stocks are less liquid?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="mfmock23q19" ID="mfmock23q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="mfmock23q19" ID="mfmock23q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="19bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. Is commission paid to the distributor for their own investment?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="mfmock23q20" ID="mfmock23q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="mfmock23q20" ID="mfmock23q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="20bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. Investments in Mutual Fund can be made using _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="mfmock23q21" ID="mfmock23q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Cheque / DD <div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="mfmock23q21" ID="mfmock23q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Remittance <div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="mfmock23q21" ID="mfmock23q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> ASBA <div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="mfmock23q21" ID="mfmock23q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Any of the Above <div id="21dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. In which of the following wealth cycle phases investor should prefer to keep its investment in liquid schemes & bank deposits?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="mfmock23q22" ID="mfmock23q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Accumulation Phase <div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="mfmock23q22" ID="mfmock23q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transition phase <div id="22bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22c" NAME="mfmock23q22" ID="mfmock23q22c" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Inter-generational transfer phase <div id="22ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22d" NAME="mfmock23q22" ID="mfmock23q22d" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Reaping / Distribution phase <div id="22dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. Full form of STT?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="mfmock23q23" ID="mfmock23q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Service Transaction Tax <div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="mfmock23q23" ID="mfmock23q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Security Transaction Tax <div id="23bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23c" NAME="mfmock23q23" ID="mfmock23q23c" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Scheme Transaction Tax <div id="23ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23d" NAME="mfmock23q23" ID="mfmock23q23d" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Silent Transaction Tax <div id="23dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. How many parts are there of Mutual Fund offer documents?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="mfmock23q24" ID="mfmock23q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 <div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="mfmock23q24" ID="mfmock23q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 4 <div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="mfmock23q24" ID="mfmock23q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 5 <div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="mfmock23q24" ID="mfmock23q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 2 <div id="24dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. The returns from equity investments are fixed and guaranteed?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="mfmock23q25" ID="mfmock23q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="mfmock23q25" ID="mfmock23q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="25bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q26">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 26. Full Form of CDSC?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q26">
					<INPUT TYPE="RADIO" VALUE="26a" NAME="mfmock23q26" ID="mfmock23q26a" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Compounded annual deferred sales charge <div id="26acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="26b" NAME="mfmock23q26" ID="mfmock23q26b" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Common deposit sales charge <div id="26bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26c" NAME="mfmock23q26" ID="mfmock23q26c" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Contingent deferred sales charge <div id="26ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26d" NAME="mfmock23q26" ID="mfmock23q26d" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="26dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q27">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 27. A nomination cannot be made in favor of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q27">
					<INPUT TYPE="RADIO" VALUE="27a" NAME="mfmock23q27" ID="mfmock23q27a" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Trust <div id="27acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="27b" NAME="mfmock23q27" ID="mfmock23q27b" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Partnership <div id="27bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27c" NAME="mfmock23q27" ID="mfmock23q27c" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Society <div id="27ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27d" NAME="mfmock23q27" ID="mfmock23q27d" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the Above <div id="27dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q28">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 28. What is an investment objective?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q28">
					<INPUT TYPE="RADIO" VALUE="28a" NAME="mfmock23q28" ID="mfmock23q28a" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> To generate capital appreciation by investing in equity Mutual Fund. <div id="28acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="28b" NAME="mfmock23q28" ID="mfmock23q28b" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> To generate income by investing in Debt and Money Market. <div id="28bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28c" NAME="mfmock23q28" ID="mfmock23q28c" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> To achieve growth and income generation by invested in balanced Mutual Fund. <div id="28ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28d" NAME="mfmock23q28" ID="mfmock23q28d" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above. <div id="28dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q29">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 29. Who manages the scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q29">
					<INPUT TYPE="RADIO" VALUE="29a" NAME="mfmock23q29" ID="mfmock23q29a" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Distributor <div id="29acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="29b" NAME="mfmock23q29" ID="mfmock23q29b" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Fund Manager <div id="29bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29c" NAME="mfmock23q29" ID="mfmock23q29c" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="29ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29d" NAME="mfmock23q29" ID="mfmock23q29d" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AMC <div id="29dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q30">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 30. Types of equity funds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q30">
					<INPUT TYPE="RADIO" VALUE="30a" NAME="mfmock23q30" ID="mfmock23q30a" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Diversified equity funds and sector funds <div id="30acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="30b" NAME="mfmock23q30" ID="mfmock23q30b" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Arbitrage fund <div id="30bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30c" NAME="mfmock23q30" ID="mfmock23q30c" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Thematic fund <div id="30ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30d" NAME="mfmock23q30" ID="mfmock23q30d" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="30dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q31">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 31. At married with young children stage, what should be the preferred investment style?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q31">
					<INPUT TYPE="RADIO" VALUE="31a" NAME="mfmock23q31" ID="mfmock23q31a" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity for long term goals & debt for medium term goals. <div id="31acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="31b" NAME="mfmock23q31" ID="mfmock23q31b" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Debt for long term goals & equity for medium term goals. <div id="31bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31c" NAME="mfmock23q31" ID="mfmock23q31c" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Money market instruments. <div id="31ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31d" NAME="mfmock23q31" ID="mfmock23q31d" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bank deposit for better liquidity. <div id="31dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q32">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 32. Permanent retirement account number (PRAN) is not portable?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q32">
					<INPUT TYPE="RADIO" VALUE="32a" NAME="mfmock23q32" ID="mfmock23q32a" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="32acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="32b" NAME="mfmock23q32" ID="mfmock23q32b" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="32bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q33">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 33. Offer document of Mutual Fund schemes are approved by SEBI?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q33">
					<INPUT TYPE="RADIO" VALUE="33a" NAME="mfmock23q33" ID="mfmock23q33a" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="33acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="33b" NAME="mfmock23q33" ID="mfmock23q33b" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="33bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q34">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 34. Where Mutual Fund can deploy unclaimed dividend and redemption amount?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q34">
					<INPUT TYPE="RADIO" VALUE="34a" NAME="mfmock23q34" ID="mfmock23q34a" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In Money Market <div id="34acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="34b" NAME="mfmock23q34" ID="mfmock23q34b" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign Exchange Market <div id="34bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34c" NAME="mfmock23q34" ID="mfmock23q34c" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Share Market <div id="34ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34d" NAME="mfmock23q34" ID="mfmock23q34d" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Debentures <div id="34dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q35">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 35. In mutual fund how much loss an investment can bear?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q35">
					<INPUT TYPE="RADIO" VALUE="35a" NAME="mfmock23q35" ID="mfmock23q35a" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Up to the investment amount the investor has made. <div id="35acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="35b" NAME="mfmock23q35" ID="mfmock23q35b" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Up to entry load of scheme. <div id="35bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35c" NAME="mfmock23q35" ID="mfmock23q35c" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Up to the exit load of the scheme. <div id="35ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35d" NAME="mfmock23q35" ID="mfmock23q35d" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Up to the initial issue expenses of the scheme. <div id="35dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q36">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 36. When the investment is said to have been handled profitably?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q36">
					<INPUT TYPE="RADIO" VALUE="36a" NAME="mfmock23q36" ID="mfmock23q36a" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Positive interest income, positive Dividend income. <div id="36acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="36b" NAME="mfmock23q36" ID="mfmock23q36b" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Positive realized capital gain, negative realized capital loss. <div id="36bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36c" NAME="mfmock23q36" ID="mfmock23q36c" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Positive valuation gain, negative valuation loss, negative scheme expenses. <div id="36ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36d" NAME="mfmock23q36" ID="mfmock23q36d" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above. <div id="36dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q37">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 37. Frequent churning of the portfolio means?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q37">
					<INPUT TYPE="RADIO" VALUE="37a" NAME="mfmock23q37" ID="mfmock23q37a" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> High broking cost <div id="37acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="37b" NAME="mfmock23q37" ID="mfmock23q37b" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Indication of unsteady investment management <div id="37bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="37c" NAME="mfmock23q37" ID="mfmock23q37c" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="37ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="37d" NAME="mfmock23q37" ID="mfmock23q37d" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> option D. <div id="37dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q38">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 38. Mutual Fund is not a company?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q38">
					<INPUT TYPE="RADIO" VALUE="38a" NAME="mfmock23q38" ID="mfmock23q38a" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="38acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="38b" NAME="mfmock23q38" ID="mfmock23q38b" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="38bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q39">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 39. Sponsors must contribute a minimum of Rs _____ as initial contribution to the corpus of the mutual fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q39">
					<INPUT TYPE="RADIO" VALUE="39a" NAME="mfmock23q39" ID="mfmock23q39a" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 200000 <div id="39acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="39b" NAME="mfmock23q39" ID="mfmock23q39b" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5000000 <div id="39bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39c" NAME="mfmock23q39" ID="mfmock23q39c" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 150000 <div id="39ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39d" NAME="mfmock23q39" ID="mfmock23q39d" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 100000 <div id="39dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q40">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 40. Every unit of a mutual fund has face value of how much Rupees?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q40">
					<INPUT TYPE="RADIO" VALUE="40a" NAME="mfmock23q40" ID="mfmock23q40a" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 10 <div id="40acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="40b" NAME="mfmock23q40" ID="mfmock23q40b" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 25 <div id="40bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40c" NAME="mfmock23q40" ID="mfmock23q40c" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 100 <div id="40ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="40d" NAME="mfmock23q40" ID="mfmock23q40d" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) & (C) <div id="40dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q41">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 41. Mutual Fund Utilities (MFU) is a transaction aggregating platform that connects Investor, RTA, Distributor, Bank, AMC.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q41">
					<INPUT TYPE="RADIO" VALUE="41a" NAME="mfmock23q41" ID="mfmock23q41a" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="41acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="41b" NAME="mfmock23q41" ID="mfmock23q41b" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="41bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q42">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 42. Which of the following investments are available for young unmarried people?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q42">
					<INPUT TYPE="RADIO" VALUE="42a" NAME="mfmock23q42" ID="mfmock23q42a" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity <div id="42acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="42b" NAME="mfmock23q42" ID="mfmock23q42b" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Debt <div id="42bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42c" NAME="mfmock23q42" ID="mfmock23q42c" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Hybrid <div id="42ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42d" NAME="mfmock23q42" ID="mfmock23q42d" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Bank Deposit <div id="42dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q43">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 43. How many investors are required for an open-ended scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q43">
					<INPUT TYPE="RADIO" VALUE="43a" NAME="mfmock23q43" ID="mfmock23q43a" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Minimum 10 investors <div id="43acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="43b" NAME="mfmock23q43" ID="mfmock23q43b" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Minimum 20 investors <div id="43bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43c" NAME="mfmock23q43" ID="mfmock23q43c" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Maximum 20 investors <div id="43ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43d" NAME="mfmock23q43" ID="mfmock23q43d" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Maximum 15 investors <div id="43dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q44">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 44. Investor can get in to long term investments commitment in _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q44">
					<INPUT TYPE="RADIO" VALUE="44a" NAME="mfmock23q44" ID="mfmock23q44a" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Distribution Phase <div id="44acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="44b" NAME="mfmock23q44" ID="mfmock23q44b" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transition Phase <div id="44bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44c" NAME="mfmock23q44" ID="mfmock23q44c" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Inter-Generational Phase <div id="44ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44d" NAME="mfmock23q44" ID="mfmock23q44d" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Accumulation Phase <div id="44dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q45">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 45. Debt market are more liquid than equity?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q45">
					<INPUT TYPE="RADIO" VALUE="45a" NAME="mfmock23q45" ID="mfmock23q45a" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="45acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="45b" NAME="mfmock23q45" ID="mfmock23q45b" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="45bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q46">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 46. Full form of ACE’S?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q46">
					<INPUT TYPE="RADIO" VALUE="46a" NAME="mfmock23q46" ID="mfmock23q46a" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Assets Classification Enrollment <div id="46acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="46b" NAME="mfmock23q46" ID="mfmock23q46b" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> AMFI Customer Engagement <div id="46bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46c" NAME="mfmock23q46" ID="mfmock23q46c" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI code of ethics <div id="46ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46d" NAME="mfmock23q46" ID="mfmock23q46d" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AMFI Certificate of Excellence <div id="46dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q47">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 47. A bond pays 20% return per annum & inflation rate for the year is 10%, calculate effective real rate of return?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q47">
					<INPUT TYPE="RADIO" VALUE="47a" NAME="mfmock23q47" ID="mfmock23q47a" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 4.76 <div id="47acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="47b" NAME="mfmock23q47" ID="mfmock23q47b" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5.50 <div id="47bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47c" NAME="mfmock23q47" ID="mfmock23q47c" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 6 <div id="47ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47d" NAME="mfmock23q47" ID="mfmock23q47d" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 8 <div id="47dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q48">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 48. Daring & adventurous people with better mental state have higher risk appetite?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q48">
					<INPUT TYPE="RADIO" VALUE="48a" NAME="mfmock23q48" ID="mfmock23q48a" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="48acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="48b" NAME="mfmock23q48" ID="mfmock23q48b" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="48bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q49">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 49. What are the different types of Expenses made by mutual fund scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q49">
					<INPUT TYPE="RADIO" VALUE="49a" NAME="mfmock23q49" ID="mfmock23q49a" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Initial Issue Expense <div id="49acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="49b" NAME="mfmock23q49" ID="mfmock23q49b" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Operating Expense <div id="49bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49c" NAME="mfmock23q49" ID="mfmock23q49c" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Recurring Expense <div id="49ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49d" NAME="mfmock23q49" ID="mfmock23q49d" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the Above <div id="49dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q50">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 50. Investment planning for daughter’s marriage, son’s college admission & buying a house taken together is a type of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q50">
					<INPUT TYPE="RADIO" VALUE="50a" NAME="mfmock23q50" ID="mfmock23q50a" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Comprehensive Financial plan <div id="50acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="50b" NAME="mfmock23q50" ID="mfmock23q50b" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Goal oriented financial plan <div id="50bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50c" NAME="mfmock23q50" ID="mfmock23q50c" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Need based financial plan <div id="50ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50d" NAME="mfmock23q50" ID="mfmock23q50d" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Long term financial plan <div id="50dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q51">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 51. KIM must be updated every 6 months?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q51">
					<INPUT TYPE="RADIO" VALUE="51a" NAME="mfmock23q51" ID="mfmock23q51a" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="51acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="51b" NAME="mfmock23q51" ID="mfmock23q51b" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="51bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q52">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 52. What are certificates of deposits?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q52">
					<INPUT TYPE="RADIO" VALUE="52a" NAME="mfmock23q52" ID="mfmock23q52a" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Issued by bank for 7 days to 1 year <div id="52acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="52b" NAME="mfmock23q52" ID="mfmock23q52b" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Issued by financial institution for 1 to 3 year <div id="52bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52c" NAME="mfmock23q52" ID="mfmock23q52c" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Called as debt instrument <div id="52ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="52d" NAME="mfmock23q52" ID="mfmock23q52d" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="52dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q53">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 53. The amount withdrawn from a scheme is re-invested in some other scheme of the same mutual fund, it is called as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q53">
					<INPUT TYPE="RADIO" VALUE="53a" NAME="mfmock23q53" ID="mfmock23q53a" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Systematic Investment Plan (SIP) <div id="53acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="53b" NAME="mfmock23q53" ID="mfmock23q53b" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Systematic Transfer Plan (STP) <div id="53bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53c" NAME="mfmock23q53" ID="mfmock23q53c" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Systematic Withdrawal Plan (SWP) <div id="53ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="53d" NAME="mfmock23q53" ID="mfmock23q53d" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Straight Through Processing (STP) <div id="53dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q54">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 54. How much % of a scheme a single investor can hold?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q54">
					<INPUT TYPE="RADIO" VALUE="54a" NAME="mfmock23q54" ID="mfmock23q54a" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Minimum 25% <div id="54acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="54b" NAME="mfmock23q54" ID="mfmock23q54b" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Maximum 25%  <div id="54bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="54c" NAME="mfmock23q54" ID="mfmock23q54c" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Minimum 20% <div id="54ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="54d" NAME="mfmock23q54" ID="mfmock23q54d" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="54dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q55">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 55. Which of the following fund has high risk of misjudgment?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q55">
					<INPUT TYPE="RADIO" VALUE="55a" NAME="mfmock23q55" ID="mfmock23q55a" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Dividend yield fund <div id="55acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="55b" NAME="mfmock23q55" ID="mfmock23q55b" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Contra funds <div id="55bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55c" NAME="mfmock23q55" ID="mfmock23q55c" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Arbitrage funds <div id="55ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="55d" NAME="mfmock23q55" ID="mfmock23q55d" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Sector specific funds <div id="55dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q56">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 56. Unit holders can hold their unit in demat form?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q56">
					<INPUT TYPE="RADIO" VALUE="56a" NAME="mfmock23q56" ID="mfmock23q56a" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="56acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="56b" NAME="mfmock23q56" ID="mfmock23q56b" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="56bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q57">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 57. Which is not a credit rating agency?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q57">
					<INPUT TYPE="RADIO" VALUE="57a" NAME="mfmock23q57" ID="mfmock23q57a" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> CRISIL <div id="57acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="57b" NAME="mfmock23q57" ID="mfmock23q57b" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> ICRA <div id="57bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57c" NAME="mfmock23q57" ID="mfmock23q57c" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Fitch <div id="57ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57d" NAME="mfmock23q57" ID="mfmock23q57d" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> IRDA <div id="57dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q58">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 58. Within how many days dividend warrant must be dispatched to investor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q58">
					<INPUT TYPE="RADIO" VALUE="58a" NAME="mfmock23q58" ID="mfmock23q58a" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 15 days <div id="58acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="58b" NAME="mfmock23q58" ID="mfmock23q58b" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 30 days <div id="58bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58c" NAME="mfmock23q58" ID="mfmock23q58c" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 5 days <div id="58ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58d" NAME="mfmock23q58" ID="mfmock23q58d" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 10 days <div id="58dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q59">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 59. Which of the following is the right stage to get health & life insurance?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q59">
					<INPUT TYPE="RADIO" VALUE="59a" NAME="mfmock23q59" ID="mfmock23q59a" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Children <div id="59acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="59b" NAME="mfmock23q59" ID="mfmock23q59b" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Young Unmarried <div id="59bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="59c" NAME="mfmock23q59" ID="mfmock23q59c" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Retired <div id="59ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="59d" NAME="mfmock23q59" ID="mfmock23q59d" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Young Married <div id="59dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q60">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 60. NAV is to be calculated up to _____ places in case of equity and Balanced Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q60">
					<INPUT TYPE="RADIO" VALUE="60a" NAME="mfmock23q60" ID="mfmock23q60a" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 2 Decimal places <div id="60acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="60b" NAME="mfmock23q60" ID="mfmock23q60b" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 3 Decimal places <div id="60bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60c" NAME="mfmock23q60" ID="mfmock23q60c" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 1 Decimal places <div id="60ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60d" NAME="mfmock23q60" ID="mfmock23q60d" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the Above <div id="60dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q61">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 61. Short term capital loss can be set off against _____. </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q61">
					<INPUT TYPE="RADIO" VALUE="61a" NAME="mfmock23q61" ID="mfmock23q61a" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Capital loss <div id="61acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="61b" NAME="mfmock23q61" ID="mfmock23q61b" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Short term capital gain <div id="61bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61c" NAME="mfmock23q61" ID="mfmock23q61c" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Long term capital gain <div id="61ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61d" NAME="mfmock23q61" ID="mfmock23q61d" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (B) & (C) <div id="61dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q62">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 62. The reduced NAV after a dividend payout is called ex-dividend NAV?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q62">
					<INPUT TYPE="RADIO" VALUE="62a" NAME="mfmock23q62" ID="mfmock23q62a" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="62acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="62b" NAME="mfmock23q62" ID="mfmock23q62b" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="62bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q63">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 63. Who is a custodian?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q63">
					<INPUT TYPE="RADIO" VALUE="63a" NAME="mfmock23q63" ID="mfmock23q63a" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Who keeps the custody or safekeeping of the assets of the scheme. <div id="63acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="63b" NAME="mfmock23q63" ID="mfmock23q63b" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Who handles the day to day operations of AMC. <div id="63bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63c" NAME="mfmock23q63" ID="mfmock23q63c" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Who Keep records of the sale and purchase of securities. <div id="63ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63d" NAME="mfmock23q63" ID="mfmock23q63d" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Who keep record of day to day expenses of the scheme. <div id="63dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q64">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 64. Short maturity debt schemes suffer lesser fluctuations than longer maturity debt schemes?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q64">
					<INPUT TYPE="RADIO" VALUE="64a" NAME="mfmock23q64" ID="mfmock23q64a" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="64acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="64b" NAME="mfmock23q64" ID="mfmock23q64b" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="64bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q65">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 65. Beta as a measure of risk is relevant only for _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q65">
					<INPUT TYPE="RADIO" VALUE="65a" NAME="mfmock23q65" ID="mfmock23q65a" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Debt schemes <div id="65acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="65b" NAME="mfmock23q65" ID="mfmock23q65b" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity schemes <div id="65bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65c" NAME="mfmock23q65" ID="mfmock23q65c" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Hybrid schemes <div id="65ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65d" NAME="mfmock23q65" ID="mfmock23q65d" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="65dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q66">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 66. Which of the following funds suits the investor who want equity exposure but with lower risk?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q66">
					<INPUT TYPE="RADIO" VALUE="66a" NAME="mfmock23q66" ID="mfmock23q66a" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Thematic Funds <div id="66acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="66b" NAME="mfmock23q66" ID="mfmock23q66b" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Hybrid fund <div id="66bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="66c" NAME="mfmock23q66" ID="mfmock23q66c" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sector specific equity fund <div id="66ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="66d" NAME="mfmock23q66" ID="mfmock23q66d" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Diversified equity fund <div id="66dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q67">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 67. Bank account detail is mandatory for investing in a mutual fund scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q67">
					<INPUT TYPE="RADIO" VALUE="67a" NAME="mfmock23q67" ID="mfmock23q67a" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="67acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="67b" NAME="mfmock23q67" ID="mfmock23q67b" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="67bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q68">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 68. Are third party cheques allowed for investments?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q68">
					<INPUT TYPE="RADIO" VALUE="68a" NAME="mfmock23q68" ID="mfmock23q68a" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="68acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="68b" NAME="mfmock23q68" ID="mfmock23q68b" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="68bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q69">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 69. Who issues treasury bills on behalf of the Government of India?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q69">
					<INPUT TYPE="RADIO" VALUE="69a" NAME="mfmock23q69" ID="mfmock23q69a" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> SEBI <div id="69acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="69b" NAME="mfmock23q69" ID="mfmock23q69b" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> RBI <div id="69bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69c" NAME="mfmock23q69" ID="mfmock23q69c" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI <div id="69ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69d" NAME="mfmock23q69" ID="mfmock23q69d" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AMC <div id="69dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q70">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 70. What is in Person Verification (IPV)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q70">
					<INPUT TYPE="RADIO" VALUE="70a" NAME="mfmock23q70" ID="mfmock23q70a" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Face to Face verification by an authorized person for KYC of investor. <div id="70acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="70b" NAME="mfmock23q70" ID="mfmock23q70b" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Verification by the way of video conferencing  <div id="70bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70c" NAME="mfmock23q70" ID="mfmock23q70c" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Verification on account of a fraud conducted by someone  <div id="70ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70d" NAME="mfmock23q70" ID="mfmock23q70d" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Face to Face verification by anyone for KYC of investor <div id="70dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q71">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 71. Who can distribute the Mutual Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q71">
					<INPUT TYPE="RADIO" VALUE="71a" NAME="mfmock23q71" ID="mfmock23q71a" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Independent financial advisor <div id="71acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="71b" NAME="mfmock23q71" ID="mfmock23q71b" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Non-bank distributors like brokerage houses, non-banking finance company. <div id="71bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71c" NAME="mfmock23q71" ID="mfmock23q71c" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Banks <div id="71ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71d" NAME="mfmock23q71" ID="mfmock23q71d" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="71dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q72">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 72. Equity Markets are not predictable in the long term than short term.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q72">
					<INPUT TYPE="RADIO" VALUE="72a" NAME="mfmock23q72" ID="mfmock23q72a" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="72acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="72b" NAME="mfmock23q72" ID="mfmock23q72b" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="72bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q73">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 73. The portfolio is not the main driver of returns in a mutual fund scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q73">
					<INPUT TYPE="RADIO" VALUE="73a" NAME="mfmock23q73" ID="mfmock23q73a" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="73acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="73b" NAME="mfmock23q73" ID="mfmock23q73b" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="73bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q74">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 74. Loads and Taxes may Account for the difference between scheme returns and the investor returns?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q74">
					<INPUT TYPE="RADIO" VALUE="74a" NAME="mfmock23q74" ID="mfmock23q74a" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="74acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="74b" NAME="mfmock23q74" ID="mfmock23q74b" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="74bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q75">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 75. Application form is attached to _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q75">
					<INPUT TYPE="RADIO" VALUE="75a" NAME="mfmock23q75" ID="mfmock23q75a" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> SAI <div id="75acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="75b" NAME="mfmock23q75" ID="mfmock23q75b" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SID <div id="75bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75c" NAME="mfmock23q75" ID="mfmock23q75c" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> KIM <div id="75ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75d" NAME="mfmock23q75" ID="mfmock23q75d" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="75dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q76">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 76. In a Top down approach of portfolio building, the portfolio manager evaluates economic factors first then industries & then identified the stock within selected industries?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q76">
					<INPUT TYPE="RADIO" VALUE="76a" NAME="mfmock23q76" ID="mfmock23q76a" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="76acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="76b" NAME="mfmock23q76" ID="mfmock23q76b" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="76bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q77">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 77. At what of the following stages investor needs the funds that have been accumulated?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q77">
					<INPUT TYPE="RADIO" VALUE="77a" NAME="mfmock23q77" ID="mfmock23q77a" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Accumulation stage <div id="77acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="77b" NAME="mfmock23q77" ID="mfmock23q77b" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Reaping Distribution stage <div id="77bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77c" NAME="mfmock23q77" ID="mfmock23q77c" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Transition stage <div id="77ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77d" NAME="mfmock23q77" ID="mfmock23q77d" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Inter-generational transfer <div id="77dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q78">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 78. What are some newer Mutual fund distribution channel?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q78">
					<INPUT TYPE="RADIO" VALUE="78a" NAME="mfmock23q78" ID="mfmock23q78a" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Internet and stock exchange <div id="78acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="78b" NAME="mfmock23q78" ID="mfmock23q78b" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> New cadre of distributors like postal agent, retired govt. official, retired teachers & retired bank officers with a service <div id="78bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78c" NAME="mfmock23q78" ID="mfmock23q78c" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="78ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78d" NAME="mfmock23q78" ID="mfmock23q78d" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="78dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q79">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 79. Which of the followings is not a type of debt fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q79">
					<INPUT TYPE="RADIO" VALUE="79a" NAME="mfmock23q79" ID="mfmock23q79a" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Junk bond scheme <div id="79acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="79b" NAME="mfmock23q79" ID="mfmock23q79b" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Gilt fund <div id="79bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="79c" NAME="mfmock23q79" ID="mfmock23q79c" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Money market fund <div id="79ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="79d" NAME="mfmock23q79" ID="mfmock23q79d" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> ELSS <div id="79dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q80">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 80. Can a company become a trustee of mutual fund trust?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q80">
					<INPUT TYPE="RADIO" VALUE="80a" NAME="mfmock23q80" ID="mfmock23q80a" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Yes <div id="80acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="80b" NAME="mfmock23q80" ID="mfmock23q80b" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> No <div id="80bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q81">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 81. The risk is cancelled out normally between cash market and f & o market. Identify the fund best justify the above statement?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q81">
					<INPUT TYPE="RADIO" VALUE="81a" NAME="mfmock23q81" ID="mfmock23q81a" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Contra Funds <div id="81acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="81b" NAME="mfmock23q81" ID="mfmock23q81b" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Dividend yield fund <div id="81bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81c" NAME="mfmock23q81" ID="mfmock23q81c" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Arbitrage fund <div id="81ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81d" NAME="mfmock23q81" ID="mfmock23q81d" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Thematic fund <div id="81dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q82">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 82. A unit certificate only mentions the number of units held by the investors?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q82">
					<INPUT TYPE="RADIO" VALUE="82a" NAME="mfmock23q82" ID="mfmock23q82a" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="82acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="82b" NAME="mfmock23q82" ID="mfmock23q82b" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="82bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q83">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 83. Identifying companies that are expected to grow at rates higher than the average economic growth rate is called as _____?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q83">
					<INPUT TYPE="RADIO" VALUE="83a" NAME="mfmock23q83" ID="mfmock23q83a" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Growth strategy <div id="83acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="83b" NAME="mfmock23q83" ID="mfmock23q83b" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Value strategy <div id="83bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83c" NAME="mfmock23q83" ID="mfmock23q83c" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="83ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83d" NAME="mfmock23q83" ID="mfmock23q83d" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="83dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q84">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 84. Full form of KIM?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q84">
					<INPUT TYPE="RADIO" VALUE="84a" NAME="mfmock23q84" ID="mfmock23q84a" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Key information memorandum <div id="84acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="84b" NAME="mfmock23q84" ID="mfmock23q84b" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Know interim management <div id="84bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="84c" NAME="mfmock23q84" ID="mfmock23q84c" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Key important memorandum <div id="84ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="84d" NAME="mfmock23q84" ID="mfmock23q84d" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Know information memorandum <div id="84dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q85">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 85. Who made the application to SEBI for registration of Mutual Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q85">
					<INPUT TYPE="RADIO" VALUE="85a" NAME="mfmock23q85" ID="mfmock23q85a" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC <div id="85acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="85b" NAME="mfmock23q85" ID="mfmock23q85b" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trustees <div id="85bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85c" NAME="mfmock23q85" ID="mfmock23q85c" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="85ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85d" NAME="mfmock23q85" ID="mfmock23q85d" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RTA <div id="85dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q86">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 86. Withholding tax on Mutual Fund capital gain are applicable for _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q86">
					<INPUT TYPE="RADIO" VALUE="86a" NAME="mfmock23q86" ID="mfmock23q86a" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Non-Resident <div id="86acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="86b" NAME="mfmock23q86" ID="mfmock23q86b" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Resident Indian <div id="86bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86c" NAME="mfmock23q86" ID="mfmock23q86c" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both of the above <div id="86ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="86d" NAME="mfmock23q86" ID="mfmock23q86d" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="86dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q87">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 87. National Unified USSD Platform (NUUP) is a mobile banking service which allows transaction without a smart phone and internet.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q87">
					<INPUT TYPE="RADIO" VALUE="87a" NAME="mfmock23q87" ID="mfmock23q87a" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="87acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="87b" NAME="mfmock23q87" ID="mfmock23q87b" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="87bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q88">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 88. What are the steps taken in portfolio building using bottom up approach?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q88">
					<INPUT TYPE="RADIO" VALUE="88a" NAME="mfmock23q88" ID="mfmock23q88a" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Identification of suitable industries- stock selection within the identified industry- analysis of economic factors <div id="88acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="88b" NAME="mfmock23q88" ID="mfmock23q88b" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Analysis of economic factor- Selection of suitable industries-stock selection within the identified industry <div id="88bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88c" NAME="mfmock23q88" ID="mfmock23q88c" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Identification of suitable industry-analysis of economic factors- stock selection within the identified industry <div id="88ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88d" NAME="mfmock23q88" ID="mfmock23q88d" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Analysis of company specific factor-industry factor-macro economic factors <div id="88dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q89">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 89. Distributor can change a fee from the investor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q89">
					<INPUT TYPE="RADIO" VALUE="89a" NAME="mfmock23q89" ID="mfmock23q89a" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="89acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="89b" NAME="mfmock23q89" ID="mfmock23q89b" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="89bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q90">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 90. Tactical asset allocation is suitable only for seasoned investors operating with large investible surpluses?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q90">
					<INPUT TYPE="RADIO" VALUE="90a" NAME="mfmock23q90" ID="mfmock23q90a" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="90acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="90b" NAME="mfmock23q90" ID="mfmock23q90b" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="90bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q91">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 91. Which type of expenses are borne to run a scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q91">
					<INPUT TYPE="RADIO" VALUE="91a" NAME="mfmock23q91" ID="mfmock23q91a" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Operating expenses <div id="91acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="91b" NAME="mfmock23q91" ID="mfmock23q91b" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Accrued expenses <div id="91bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91c" NAME="mfmock23q91" ID="mfmock23q91c" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Initial issue expenses <div id="91ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91d" NAME="mfmock23q91" ID="mfmock23q91d" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="91dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q92">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 92. Made an investment 6 months back and indicating a return of 5% since inception. Please calculate annualized return?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q92">
					<INPUT TYPE="RADIO" VALUE="92a" NAME="mfmock23q92" ID="mfmock23q92a" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 100% <div id="92acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="92b" NAME="mfmock23q92" ID="mfmock23q92b" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 10% <div id="92bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92c" NAME="mfmock23q92" ID="mfmock23q92c" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 15% <div id="92ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92d" NAME="mfmock23q92" ID="mfmock23q92d" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 25% <div id="92dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q93">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 93. Unit certificate are _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q93">
					<INPUT TYPE="RADIO" VALUE="93a" NAME="mfmock23q93" ID="mfmock23q93a" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Transferable <div id="93acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="93b" NAME="mfmock23q93" ID="mfmock23q93b" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Non-Transferable <div id="93bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q94">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 94. Within _____ days of declaration, Dividend Warrants will have to be dispatched to investors?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q94">
					<INPUT TYPE="RADIO" VALUE="94a" NAME="mfmock23q94" ID="mfmock23q94a" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 30 <div id="94acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="94b" NAME="mfmock23q94" ID="mfmock23q94b" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 7 <div id="94bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94c" NAME="mfmock23q94" ID="mfmock23q94c" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 15 <div id="94ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94d" NAME="mfmock23q94" ID="mfmock23q94d" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 10 <div id="94dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q95">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 95. For investing in a SIP, which payment mode is mostly used?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q95">
					<INPUT TYPE="RADIO" VALUE="95a" NAME="mfmock23q95" ID="mfmock23q95a" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Auto debit to credit cards <div id="95acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="95b" NAME="mfmock23q95" ID="mfmock23q95b" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Automated Clearing House (ACH) <div id="95bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95c" NAME="mfmock23q95" ID="mfmock23q95c" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Postdated cheque (PDC) <div id="95ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="95d" NAME="mfmock23q95" ID="mfmock23q95d" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Electronic Clearing Service (ECS) <div id="95dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q96">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 96. When investors opt for the safer root of offering for re-purchase a constant value of units over a period of time, it is called as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q96">
					<INPUT TYPE="RADIO" VALUE="96a" NAME="mfmock23q96" ID="mfmock23q96a" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Systematic Withdrawal Plan (SWP) <div id="96acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="96b" NAME="mfmock23q96" ID="mfmock23q96b" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Systematic Investment Plan (SIP) <div id="96bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96c" NAME="mfmock23q96" ID="mfmock23q96c" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Straight Through Processing (STP) <div id="96ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96d" NAME="mfmock23q96" ID="mfmock23q96d" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="96dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q97">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 97. Consolidated Account Statement details all the holdings across the scheme of all mutual funds and equity shares & it is sent by the post/ email by the 10th day of succeeding month to the investor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q97">
					<INPUT TYPE="RADIO" VALUE="97a" NAME="mfmock23q97" ID="mfmock23q97a" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="97acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="97b" NAME="mfmock23q97" ID="mfmock23q97b" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="97bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q98">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 98. What kind of investment style is advisable for retirement stage?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q98">
					<INPUT TYPE="RADIO" VALUE="98a" NAME="mfmock23q98" ID="mfmock23q98a" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Hybrid funds with low equity exposure <div id="98acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="98b" NAME="mfmock23q98" ID="mfmock23q98b" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Hybrid Funds with high equity exposure <div id="98bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98c" NAME="mfmock23q98" ID="mfmock23q98c" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Only saving Bank Deposits <div id="98ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="98d" NAME="mfmock23q98" ID="mfmock23q98d" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Only Debt <div id="98dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q99">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 99. Sector funds invest in a diverse range of sectors?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q99">
					<INPUT TYPE="RADIO" VALUE="99a" NAME="mfmock23q99" ID="mfmock23q99a" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="99acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="99b" NAME="mfmock23q99" ID="mfmock23q99b" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="99bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf23-q100">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 100. In falling interest rate scenario long term debt funds earn capital gain?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock23q100">
					<INPUT TYPE="RADIO" VALUE="100a" NAME="mfmock23q100" ID="mfmock23q100a" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="100acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="100b" NAME="mfmock23q100" ID="mfmock23q100b" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="100bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		
        <section class="col-lg-12" style="display: none" id="mf22-status">
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