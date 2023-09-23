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
  <title>MF-Mock025 | IBR Live</title>
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
				  tempItem2="mfmock25q"+i;
				  
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
			var nid="mf25-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("mf25-status").style.display = "block";
			document.getElementById("mf25-guide").style.display = "none";  
			document.getElementById("mf25-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=100;i++){
				qhid = "mf25-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
                        if(parseInt(localStorage.getItem("started"))==parseInt(25)){

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
                        document.getElementById("mf25-q1").style.display = "block"; 
			document.getElementById("mf25-status").style.display = "block";
			document.getElementById("mf25-guide").style.display = "none"; 
			document.getElementById("mf25-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));
				
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(25)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "mfmock25q"+qno;
			  
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
				
				qval = "mfmock25q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "mfmock25q"+i+"a"; tcheckb = "mfmock25q"+i+"b"; tcheckc = "mfmock25q"+i+"c"; tcheckd = "mfmock25q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "mfmock25q"+i+"a"; tcheckb = "mfmock25q"+i+"b"; tcheckc = "mfmock25q"+i+"c"; tcheckd = "mfmock25q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "mfmock25q"+i+"a"; tcheckb = "mfmock25q"+i+"b"; tcheckc = "mfmock25q"+i+"c"; tcheckd = "mfmock25q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "mfmock25q"+i+"a"; tcheckb = "mfmock25q"+i+"b"; tcheckc = "mfmock25q"+i+"c"; tcheckd = "mfmock25q"+i+"d";
						
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
				tLabel = "mfmock25q"+i;
				val = localStorage.getItem(tLabel); 
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('25');

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
			  tempItem2="mfmock25q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>NISM-Series-V-A: Mutual Fund Distributors Certification - Mock Test 25</b></p>
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
          <div class="nav-tabs-custom" id="mf25-guide">
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
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('25')">Take the Test</button></li>
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
          <div class="box box-solid " id="mf25-tut">
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
              <button class="btn btn-primary" onclick="location.href='mf-mock-024'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>           
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
            </div>
          </div>
        </section>
	
	<section class="col-lg-12" style="display:none" id="mf25-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. When the investment is said to have been handled profitably?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="mfmock25q1" ID="mfmock25q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Positive interest income, positive Dividend income. <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="mfmock25q1" ID="mfmock25q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Positive realized capital gain, negative realized capital loss. <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="mfmock25q1" ID="mfmock25q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Positive valuation gain, negative valuation loss, negative scheme expenses.<div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="mfmock25q1" ID="mfmock25q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above.<div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. Investment in lower rated debt investments earn lower coupon income?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="mfmock25q2" ID="mfmock25q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="mfmock25q2" ID="mfmock25q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="2bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. What are some newer Mutual fund distribution channel?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="mfmock25q3" ID="mfmock25q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Internet and stock exchange <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="mfmock25q3" ID="mfmock25q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> New cadre of distributors like postal agent, retired govt. official, retired teachers & retired bank officers with a service. <div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="mfmock25q3" ID="mfmock25q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B). <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="mfmock25q3" ID="mfmock25q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above. <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. In case of delay in dispatching dividend warrant at what rate interest is paid to investor by AMC?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="mfmock25q4" ID="mfmock25q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 15% per annum <div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="mfmock25q4" ID="mfmock25q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5% per annum <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="mfmock25q4" ID="mfmock25q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 10% per annum <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="mfmock25q4" ID="mfmock25q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Investment management activity of mutual fund is managed by _____?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="mfmock25q5" ID="mfmock25q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="mfmock25q5" ID="mfmock25q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sponsor <div id="5bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5c" NAME="mfmock25q5" ID="mfmock25q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RTA <div id="5ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5d" NAME="mfmock25q5" ID="mfmock25q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Custodian <div id="5dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Asset allocation that comes out of calls on the likely behavior of the market is an example of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="mfmock25q6" ID="mfmock25q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Strategic Asset Allocation <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="mfmock25q6" ID="mfmock25q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Tactical Asset Allocation <div id="6bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6c" NAME="mfmock25q6" ID="mfmock25q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="6ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6d" NAME="mfmock25q6" ID="mfmock25q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. Who regulates the NPS (National Pension System)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="mfmock25q7" ID="mfmock25q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> RBI <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="mfmock25q7" ID="mfmock25q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="mfmock25q7" ID="mfmock25q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Govt. of India <div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="mfmock25q7" ID="mfmock25q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Pension Fund Regulatory and Development Authority (PFRDA) <div id="7dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. How many parts are there of Mutual Fund offer documents?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="mfmock25q8" ID="mfmock25q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="mfmock25q8" ID="mfmock25q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 4 <div id="8bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8c" NAME="mfmock25q8" ID="mfmock25q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 5 <div id="8ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8d" NAME="mfmock25q8" ID="mfmock25q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 2 <div id="8dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. Names of RTA (Registrar & Transfer Agent)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="mfmock25q9" ID="mfmock25q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Karvy <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="mfmock25q9" ID="mfmock25q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> CAMS <div id="9bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9c" NAME="mfmock25q9" ID="mfmock25q9c" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B) <div id="9ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9d" NAME="mfmock25q9" ID="mfmock25q9d" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="9dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. If the dividend is not dispatched within 30 days, then interest is paid by AMC to its holder by what percent? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="mfmock25q10" ID="mfmock25q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 10% <div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="mfmock25q10" ID="mfmock25q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5% <div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="mfmock25q10" ID="mfmock25q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 15% <div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="mfmock25q10" ID="mfmock25q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 20% <div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. Which of the following schemes are exempt from paying DDT?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="mfmock25q11" ID="mfmock25q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity Fund <div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="mfmock25q11" ID="mfmock25q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Liquid Fund <div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="mfmock25q11" ID="mfmock25q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gilt Fund <div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="mfmock25q11" ID="mfmock25q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Fixed Maturity Plan <div id="11dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. Which of the following debt schemes are riskier?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="mfmock25q12" ID="mfmock25q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Junk bond schemes <div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="mfmock25q12" ID="mfmock25q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Liquid schemes <div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="mfmock25q12" ID="mfmock25q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Fixed maturity plans <div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="mfmock25q12" ID="mfmock25q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gilt schemes <div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. The reduced NAV after a dividend payout is called ex-dividend NAV?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="mfmock25q13" ID="mfmock25q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="mfmock25q13" ID="mfmock25q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="13bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. What is the most significant benefit of open ended schemes?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="mfmock25q14" ID="mfmock25q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Risk-free return <div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="mfmock25q14" ID="mfmock25q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Regular income <div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="mfmock25q14" ID="mfmock25q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Liquidity <div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="mfmock25q14" ID="mfmock25q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="14dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. When a scheme is first made available for investment what it is called?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="mfmock25q15" ID="mfmock25q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> NFO <div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="mfmock25q15" ID="mfmock25q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Open ended scheme <div id="15bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15c" NAME="mfmock25q15" ID="mfmock25q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Close ended scheme <div id="15ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="15d" NAME="mfmock25q15" ID="mfmock25q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Liquid scheme <div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. What are the different types of Expenses made by mutual fund scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="mfmock25q16" ID="mfmock25q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Initial Issue Expense <div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="mfmock25q16" ID="mfmock25q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Operating Expense <div id="16bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16c" NAME="mfmock25q16" ID="mfmock25q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Recurring Expense <div id="16ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="16d" NAME="mfmock25q16" ID="mfmock25q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the Above. <div id="16dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. Full form of ACE’S is _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="mfmock25q17" ID="mfmock25q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Assets Classification Enrollment <div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="mfmock25q17" ID="mfmock25q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> AMFI Customer Engagement <div id="17bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17c" NAME="mfmock25q17" ID="mfmock25q17c" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI code of ethics <div id="17ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17d" NAME="mfmock25q17" ID="mfmock25q17d" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> AMFI Certificate of Excellence <div id="17dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. Schemes other than ELSS and RGESS need to allot or refund money within how many business days from the closure of NFO?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="mfmock25q18" ID="mfmock25q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 5 Business days<div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="mfmock25q18" ID="mfmock25q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 10 Business days <div id="18bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18c" NAME="mfmock25q18" ID="mfmock25q18c" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 7 Business days <div id="18ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="18d" NAME="mfmock25q18" ID="mfmock25q18d" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 15 Business days <div id="18dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. Minimum Net worth Requirement for a setting up a new AMC is _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="mfmock25q19" ID="mfmock25q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 50 Crore <div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="mfmock25q19" ID="mfmock25q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 5 Crore <div id="19bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19c" NAME="mfmock25q19" ID="mfmock25q19c" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 10 Crore <div id="19ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19d" NAME="mfmock25q19" ID="mfmock25q19d" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 4 Crore <div id="19dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. For investing in a SIP, which payment mode is mostly used?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="mfmock25q20" ID="mfmock25q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Auto debit to credit cards <div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="mfmock25q20" ID="mfmock25q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Automated Clearing House (ACH) <div id="20bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20c" NAME="mfmock25q20" ID="mfmock25q20c" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Postdated cheque (PDC) <div id="20ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20d" NAME="mfmock25q20" ID="mfmock25q20d" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Electronic Clearing Service (ECS) <div id="20dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. Schemes whose beta is more than one (1) are riskier than the market?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="mfmock25q21" ID="mfmock25q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="mfmock25q21" ID="mfmock25q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="21bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. In NPS Tier 1 accounts have limited withdrawal limited?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="mfmock25q22" ID="mfmock25q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="mfmock25q22" ID="mfmock25q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="22bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. Mutual Fund Utilities (MFU) is a transaction aggregating platform that connects Investor, RTA, Distributor, Bank, AMC.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="mfmock25q23" ID="mfmock25q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="mfmock25q23" ID="mfmock25q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="23bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. Who regulates the money market and foreign exchange market?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="mfmock25q24" ID="mfmock25q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> RBI <div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="mfmock25q24" ID="mfmock25q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="mfmock25q24" ID="mfmock25q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI <div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="mfmock25q24" ID="mfmock25q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Government of India <div id="24dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. Is permission of SEBI required for the appointment of individuals, bank, non-bank finance company as a distributor by AMC?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="mfmock25q25" ID="mfmock25q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Yes <div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="mfmock25q25" ID="mfmock25q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> No <div id="25bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q26">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 26. What are the factors affecting Real Estate value?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q26">
					<INPUT TYPE="RADIO" VALUE="26a" NAME="mfmock25q26" ID="mfmock25q26a" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Economic Scenario <div id="26acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="26b" NAME="mfmock25q26" ID="mfmock25q26b" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Infrastructure Development <div id="26bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26c" NAME="mfmock25q26" ID="mfmock25q26c" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Interest Rates <div id="26ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="26d" NAME="mfmock25q26" ID="mfmock25q26d" onclick="changeStatus('26')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="26dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q27">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 27. Who are the beneficiaries of a Mutual Fund Trust?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q27">
					<INPUT TYPE="RADIO" VALUE="27a" NAME="mfmock25q27" ID="mfmock25q27a" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Investors who invest in various schemes. <div id="27acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="27b" NAME="mfmock25q27" ID="mfmock25q27b" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trustees of Mutual fund trust <div id="27bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27c" NAME="mfmock25q27" ID="mfmock25q27c" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="27ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="27d" NAME="mfmock25q27" ID="mfmock25q27d" onclick="changeStatus('27')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RTA <div id="27dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q28">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 28. In which of the following wealth cycle phases investor should prefer to keep its investment in liquid schemes & bank deposits?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q28">
					<INPUT TYPE="RADIO" VALUE="28a" NAME="mfmock25q28" ID="mfmock25q28a" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Accumulation Phase <div id="28acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="28b" NAME="mfmock25q28" ID="mfmock25q28b" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Transition phase <div id="28bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28c" NAME="mfmock25q28" ID="mfmock25q28c" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Inter-generational transfer phase <div id="28ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="28d" NAME="mfmock25q28" ID="mfmock25q28d" onclick="changeStatus('28')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Reaping / Distribution phase <div id="28dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q29">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 29. If the sale & purchase transaction amounted to RS 20,000 crore & average size of Net asset is Rs 10,000 crore then calculate the portfolio turnover ratio?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q29">
					<INPUT TYPE="RADIO" VALUE="29a" NAME="mfmock25q29" ID="mfmock25q29a" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 100% <div id="29acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="29b" NAME="mfmock25q29" ID="mfmock25q29b" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 20% <div id="29bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29c" NAME="mfmock25q29" ID="mfmock25q29c" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 2%  <div id="29ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="29d" NAME="mfmock25q29" ID="mfmock25q29d" onclick="changeStatus('29')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 200%  <div id="29dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q30">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 30. What is mark to market?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q30">
					<INPUT TYPE="RADIO" VALUE="30a" NAME="mfmock25q30" ID="mfmock25q30a" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> The process of valuing each security of the scheme at past market value is called Mark to Market. <div id="30acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="30b" NAME="mfmock25q30" ID="mfmock25q30b" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> The process of valuing each security of the scheme at current market value is called Mark to Market. <div id="30bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30c" NAME="mfmock25q30" ID="mfmock25q30c" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The process of valuing each security of the scheme at future market value is called Mark to Market. <div id="30ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="30d" NAME="mfmock25q30" ID="mfmock25q30d" onclick="changeStatus('30')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> The process of valuing each security of the scheme at its face value is called Mark to Market. <div id="30dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q31">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 31. The relative size of mutual fund company is assessed by?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q31">
					<INPUT TYPE="RADIO" VALUE="31a" NAME="mfmock25q31" ID="mfmock25q31a" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Asset under management (AUM) <div id="31acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="31b" NAME="mfmock25q31" ID="mfmock25q31b" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Face value of All its schemes <div id="31bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31c" NAME="mfmock25q31" ID="mfmock25q31c" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both of the above <div id="31ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="31d" NAME="mfmock25q31" ID="mfmock25q31d" onclick="changeStatus('31')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="31dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q32">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 32. Beta as a measure of risk is relevant only for _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q32">
					<INPUT TYPE="RADIO" VALUE="32a" NAME="mfmock25q32" ID="mfmock25q32a" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Debt schemes <div id="32acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="32b" NAME="mfmock25q32" ID="mfmock25q32b" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity schemes <div id="32bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32c" NAME="mfmock25q32" ID="mfmock25q32c" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Hybrid schemes <div id="32ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="32d" NAME="mfmock25q32" ID="mfmock25q32d" onclick="changeStatus('32')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="32dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q33">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 33. Fundamental Analysis is Evaluation of the strength of the company’s price volume cart?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q33">
					<INPUT TYPE="RADIO" VALUE="33a" NAME="mfmock25q33" ID="mfmock25q33a" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="33acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="33b" NAME="mfmock25q33" ID="mfmock25q33b" onclick="changeStatus('33')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="33bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q34">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 34. At what of the following stages investor needs the funds that have been accumulated?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q34">
					<INPUT TYPE="RADIO" VALUE="34a" NAME="mfmock25q34" ID="mfmock25q34a" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Accumulation stage <div id="34acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="34b" NAME="mfmock25q34" ID="mfmock25q34b" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Reaping Distribution stage <div id="34bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34c" NAME="mfmock25q34" ID="mfmock25q34c" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Transition stage <div id="34ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="34d" NAME="mfmock25q34" ID="mfmock25q34d" onclick="changeStatus('34')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Inter-generational transfer <div id="34dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q35">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 35. Where Mutual Fund can deploy unclaimed dividend and redemption amount?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q35">
					<INPUT TYPE="RADIO" VALUE="35a" NAME="mfmock25q35" ID="mfmock25q35a" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In Money Market <div id="35acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="35b" NAME="mfmock25q35" ID="mfmock25q35b" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign Exchange Market <div id="35bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35c" NAME="mfmock25q35" ID="mfmock25q35c" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Share Market <div id="35ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="35d" NAME="mfmock25q35" ID="mfmock25q35d" onclick="changeStatus('35')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Debentures <div id="35dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q36">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 36. Capital protected schemes are mostly?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q36">
					<INPUT TYPE="RADIO" VALUE="36a" NAME="mfmock25q36" ID="mfmock25q36a" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Close ended scheme <div id="36acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="36b" NAME="mfmock25q36" ID="mfmock25q36b" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Open ended schemes <div id="36bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36c" NAME="mfmock25q36" ID="mfmock25q36c" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B)<div id="36ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="36d" NAME="mfmock25q36" ID="mfmock25q36d" onclick="changeStatus('36')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="36dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q37">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 37. Risk Appetite of an investor is higher with longer life expectancy?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q37">
					<INPUT TYPE="RADIO" VALUE="37a" NAME="mfmock25q37" ID="mfmock25q37a" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="37acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="37b" NAME="mfmock25q37" ID="mfmock25q37b" onclick="changeStatus('37')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="37bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q38">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 38. What does a scheme earn on investment it holds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q38">
					<INPUT TYPE="RADIO" VALUE="38a" NAME="mfmock25q38" ID="mfmock25q38a" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Interest income <div id="38acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="38b" NAME="mfmock25q38" ID="mfmock25q38b" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Dividend income <div id="38bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38c" NAME="mfmock25q38" ID="mfmock25q38c" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Capital gain/appreciation or capital loss <div id="38ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="38d" NAME="mfmock25q38" ID="mfmock25q38d" onclick="changeStatus('38')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="38dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q39">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 39. Investors KYC details are stored in the server of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q39">
					<INPUT TYPE="RADIO" VALUE="39a" NAME="mfmock25q39" ID="mfmock25q39a" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC <div id="39acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="39b" NAME="mfmock25q39" ID="mfmock25q39b" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="39bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39c" NAME="mfmock25q39" ID="mfmock25q39c" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMFI <div id="39ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="39d" NAME="mfmock25q39" ID="mfmock25q39d" onclick="changeStatus('39')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> KRA <div id="39dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q40">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 40. High yield bond schemes invest in junk bonds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q40">
					<INPUT TYPE="RADIO" VALUE="40a" NAME="mfmock25q40" ID="mfmock25q40a" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="40acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="40b" NAME="mfmock25q40" ID="mfmock25q40b" onclick="changeStatus('40')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="40bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q41">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 41. What are the benefits of Systematic Withdrawal Plan (SWP)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q41">
					<INPUT TYPE="RADIO" VALUE="41a" NAME="mfmock25q41" ID="mfmock25q41a" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Minimize the risk of redeeming all the units, when market is down <div id="41acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="41b" NAME="mfmock25q41" ID="mfmock25q41b" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Meet liquidity Needs for regular expenses <div id="41bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41c" NAME="mfmock25q41" ID="mfmock25q41c" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Encashing the profits during high market <div id="41ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="41d" NAME="mfmock25q41" ID="mfmock25q41d" onclick="changeStatus('41')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="41dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q42">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 42. How exit load is calculated?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q42">
					<INPUT TYPE="RADIO" VALUE="42a" NAME="mfmock25q42" ID="mfmock25q42a" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sale Price – NAV <div id="42acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="42b" NAME="mfmock25q42" ID="mfmock25q42b" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> NAV – Repurchase <div id="42bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42c" NAME="mfmock25q42" ID="mfmock25q42c" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sale- Purchase <div id="42ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="42d" NAME="mfmock25q42" ID="mfmock25q42d" onclick="changeStatus('42')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="42dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q43">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 43. Recognizing the risk involved in high leveraging, SEBI regulations stipulates which of the following?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q43">
					<INPUT TYPE="RADIO" VALUE="43a" NAME="mfmock25q43" ID="mfmock25q43a" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A Mutual fund scheme cannot borrow more than 20% of its net asset <div id="43acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="43b" NAME="mfmock25q43" ID="mfmock25q43b" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Mutual find scheme cannot borrow more than 6 months. <div id="43bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43c" NAME="mfmock25q43" ID="mfmock25q43c" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> The borrowing is permitted only to meet cash flow needs of investor servicing like dividend payment or repurchase payment . <div id="43ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="43d" NAME="mfmock25q43" ID="mfmock25q43d" onclick="changeStatus('43')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above. <div id="43dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q44">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 44. Full form of FATCA?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q44">
					<INPUT TYPE="RADIO" VALUE="44a" NAME="mfmock25q44" ID="mfmock25q44a" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Foreign Account Tax Compliance Act <div id="44acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="44b" NAME="mfmock25q44" ID="mfmock25q44b" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Fixed Account Tax Compliance Act <div id="44bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44c" NAME="mfmock25q44" ID="mfmock25q44c" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Future and Option Account Tax Compliance Act <div id="44ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="44d" NAME="mfmock25q44" ID="mfmock25q44d" onclick="changeStatus('44')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the Above <div id="44dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q45">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 45. If invested of Rs 1000 become Rs 4000 in a 2 year then calculate the compounded return?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q45">
					<INPUT TYPE="RADIO" VALUE="45a" NAME="mfmock25q45" ID="mfmock25q45a" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 20% <div id="45acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="45b" NAME="mfmock25q45" ID="mfmock25q45b" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 150% <div id="45bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45c" NAME="mfmock25q45" ID="mfmock25q45c" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 100% <div id="45ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="45d" NAME="mfmock25q45" ID="mfmock25q45d" onclick="changeStatus('45')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 10% <div id="45dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q46">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 46. Who appoints the RTA (Registrar & Transfer Agent)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q46">
					<INPUT TYPE="RADIO" VALUE="46a" NAME="mfmock25q46" ID="mfmock25q46a" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC <div id="46acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="46b" NAME="mfmock25q46" ID="mfmock25q46b" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="46bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46c" NAME="mfmock25q46" ID="mfmock25q46c" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor  <div id="46ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="46d" NAME="mfmock25q46" ID="mfmock25q46d" onclick="changeStatus('46')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="46dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q47">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 47. NAV is to be calculated up to _____ places in case of index fund, liquid fund and debt fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q47">
					<INPUT TYPE="RADIO" VALUE="47a" NAME="mfmock25q47" ID="mfmock25q47a" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 3 decimal places <div id="47acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="47b" NAME="mfmock25q47" ID="mfmock25q47b" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 2 decimal places <div id="47bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47c" NAME="mfmock25q47" ID="mfmock25q47c" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 4 decimal places <div id="47ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="47d" NAME="mfmock25q47" ID="mfmock25q47d" onclick="changeStatus('47')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the Above <div id="47dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q48">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 48. When a dividend is paid, NAV of the unit falls to that extent?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q48">
					<INPUT TYPE="RADIO" VALUE="48a" NAME="mfmock25q48" ID="mfmock25q48a" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="48acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="48b" NAME="mfmock25q48" ID="mfmock25q48b" onclick="changeStatus('48')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="48bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q49">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 49. Who made the application to SEBI for registration of Mutual Fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q49">
					<INPUT TYPE="RADIO" VALUE="49a" NAME="mfmock25q49" ID="mfmock25q49a" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC <div id="49acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="49b" NAME="mfmock25q49" ID="mfmock25q49b" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trustees <div id="49bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49c" NAME="mfmock25q49" ID="mfmock25q49c" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="49ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="49d" NAME="mfmock25q49" ID="mfmock25q49d" onclick="changeStatus('49')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RTA <div id="49dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q50">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 50. According to the certified financier planner – Boards of Students USA, the first stage in financial planning is _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q50">
					<INPUT TYPE="RADIO" VALUE="50a" NAME="mfmock25q50" ID="mfmock25q50a" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Analyze and Evaluate Clients Financial Status <div id="50acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="50b" NAME="mfmock25q50" ID="mfmock25q50b" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Establish and Define the Client Planner Relationship <div id="50bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50c" NAME="mfmock25q50" ID="mfmock25q50c" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gather Client Data, Define Clients Goals <div id="50ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="50d" NAME="mfmock25q50" ID="mfmock25q50d" onclick="changeStatus('50')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Develop and Present Financial Planning Recommendations or options <div id="50dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q51">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 51. Providing Funds for a Daughter’s Marriage is an example of _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q51">
					<INPUT TYPE="RADIO" VALUE="51a" NAME="mfmock25q51" ID="mfmock25q51a" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Goal Oriented Financial Plan <div id="51acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="51b" NAME="mfmock25q51" ID="mfmock25q51b" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Comprehensive Financial Plan <div id="51bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51c" NAME="mfmock25q51" ID="mfmock25q51c" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Financial Goal <div id="51ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="51d" NAME="mfmock25q51" ID="mfmock25q51d" onclick="changeStatus('51')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of The Above <div id="51dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q52">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 52. Loads and Taxes may Account for the difference between scheme returns and the investor returns?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q52">
					<INPUT TYPE="RADIO" VALUE="52a" NAME="mfmock25q52" ID="mfmock25q52a" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="52acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="52b" NAME="mfmock25q52" ID="mfmock25q52b" onclick="changeStatus('52')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="52bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q53">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 53. Debt market are more liquid than equity?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q53">
					<INPUT TYPE="RADIO" VALUE="53a" NAME="mfmock25q53" ID="mfmock25q53a" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="53acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="53b" NAME="mfmock25q53" ID="mfmock25q53b" onclick="changeStatus('53')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="53bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q54">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 54. A bank deposit is better choice than liquid funds for a short-term investment?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q54">
					<INPUT TYPE="RADIO" VALUE="54a" NAME="mfmock25q54" ID="mfmock25q54a" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="54acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="54b" NAME="mfmock25q54" ID="mfmock25q54b" onclick="changeStatus('54')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="54bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q55">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 55. Gold Futures are superior to ETF Gold as a vehicle for life long Investment in gold?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q55">
					<INPUT TYPE="RADIO" VALUE="55a" NAME="mfmock25q55" ID="mfmock25q55a" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="55acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="55b" NAME="mfmock25q55" ID="mfmock25q55b" onclick="changeStatus('55')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="55bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q56">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 56. Which of the following documents are required to transmit the units to the nominee on the death of unit holder?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q56">
					<INPUT TYPE="RADIO" VALUE="56a" NAME="mfmock25q56" ID="mfmock25q56a" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Death certificates <div id="56acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="56b" NAME="mfmock25q56" ID="mfmock25q56b" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Details of the Bank Account of nominee attested by bank manager <div id="56bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56c" NAME="mfmock25q56" ID="mfmock25q56c" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> KYC of nominee <div id="56ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="56d" NAME="mfmock25q56" ID="mfmock25q56d" onclick="changeStatus('56')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="56dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q57">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 57. Draft SID is a public document & available for viewing in SEBI’S website for how many days?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q57">
					<INPUT TYPE="RADIO" VALUE="57a" NAME="mfmock25q57" ID="mfmock25q57a" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 15 days <div id="57acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="57b" NAME="mfmock25q57" ID="mfmock25q57b" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 30 days <div id="57bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57c" NAME="mfmock25q57" ID="mfmock25q57c" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 21 days <div id="57ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="57d" NAME="mfmock25q57" ID="mfmock25q57d" onclick="changeStatus('57')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 5 days <div id="57dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q58">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 58. Which plan allows investors to invest the dividend earned in a mutual fund scheme into another scheme of the same mutual fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q58">
					<INPUT TYPE="RADIO" VALUE="58a" NAME="mfmock25q58" ID="mfmock25q58a" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> None of the below <div id="58acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="58b" NAME="mfmock25q58" ID="mfmock25q58b" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Dividend Distribution Plan (DDP) <div id="58bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58c" NAME="mfmock25q58" ID="mfmock25q58c" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Dividend Withdrawal Plan (DWP) <div id="58ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="58d" NAME="mfmock25q58" ID="mfmock25q58d" onclick="changeStatus('58')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Dividend Transfer Plan (DTP) <div id="58dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q59">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 59. After a dividend is announced & until it is paid out, it is referred to as cum-dividend NAV?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q59">
					<INPUT TYPE="RADIO" VALUE="59a" NAME="mfmock25q59" ID="mfmock25q59a" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="59acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="59b" NAME="mfmock25q59" ID="mfmock25q59b" onclick="changeStatus('59')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="59bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q60">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 60. NAV is calculated as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q60">
					<INPUT TYPE="RADIO" VALUE="60a" NAME="mfmock25q60" ID="mfmock25q60a" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Net asset/ No of unit <div id="60acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="60b" NAME="mfmock25q60" ID="mfmock25q60b" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Net asset/ Face value <div id="60bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60c" NAME="mfmock25q60" ID="mfmock25q60c" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Net asset * Face value <div id="60ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="60d" NAME="mfmock25q60" ID="mfmock25q60d" onclick="changeStatus('60')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="60dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q61">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 61. In NPS Which of the following asset class is not available for investment?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q61">
					<INPUT TYPE="RADIO" VALUE="61a" NAME="mfmock25q61" ID="mfmock25q61a" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Corporate Debt <div id="61acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="61b" NAME="mfmock25q61" ID="mfmock25q61b" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Government Securities <div id="61bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61c" NAME="mfmock25q61" ID="mfmock25q61c" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Gold <div id="61ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="61d" NAME="mfmock25q61" ID="mfmock25q61d" onclick="changeStatus('61')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Equity <div id="61dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q62">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 62. More than 50% of Wealth of Indian is held in Physical Assets?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q62">
					<INPUT TYPE="RADIO" VALUE="62a" NAME="mfmock25q62" ID="mfmock25q62a" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="62acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="62b" NAME="mfmock25q62" ID="mfmock25q62b" onclick="changeStatus('62')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="62bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q63">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 63. Day to Day operations of Mutual Funds are handled by? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q63">
					<INPUT TYPE="RADIO" VALUE="63a" NAME="mfmock25q63" ID="mfmock25q63a" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC <div id="63acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="63b" NAME="mfmock25q63" ID="mfmock25q63b" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sponsor <div id="63bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63c" NAME="mfmock25q63" ID="mfmock25q63c" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RTA <div id="63ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="63d" NAME="mfmock25q63" ID="mfmock25q63d" onclick="changeStatus('63')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="63dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q64">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 64. What are certificates of deposits?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q64">
					<INPUT TYPE="RADIO" VALUE="64a" NAME="mfmock25q64" ID="mfmock25q64a" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Issued by bank for 7 days to 1 year <div id="64acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="64b" NAME="mfmock25q64" ID="mfmock25q64b" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Issued by financial institution for 1 to 3 year <div id="64bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64c" NAME="mfmock25q64" ID="mfmock25q64c" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Called as debt instrument <div id="64ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="64d" NAME="mfmock25q64" ID="mfmock25q64d" onclick="changeStatus('64')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="64dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q65">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 65. What is new cadre distributor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q65">
					<INPUT TYPE="RADIO" VALUE="65a" NAME="mfmock25q65" ID="mfmock25q65a" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In sep 2012 SEBI provided new cadre of distributor who should have experience of at least 10 years in govt. post office or bank service. <div id="65acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="65b" NAME="mfmock25q65" ID="mfmock25q65b" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> In sep 2012 SEBI provided new cadre of distributor who should have experience of at least 20 years in govt. post office or bank service. <div id="65bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65c" NAME="mfmock25q65" ID="mfmock25q65c" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> None of the above <div id="65ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="65d" NAME="mfmock25q65" ID="mfmock25q65d" onclick="changeStatus('65')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both of the above.<div id="65dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q66">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 66. Long term Debt funds earns capital gains in rising interest rate scenario?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q66">
					<INPUT TYPE="RADIO" VALUE="66a" NAME="mfmock25q66" ID="mfmock25q66a" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="66acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="66b" NAME="mfmock25q66" ID="mfmock25q66b" onclick="changeStatus('66')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="66bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q67">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 67. Is SAI part of SID?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q67">
					<INPUT TYPE="RADIO" VALUE="67a" NAME="mfmock25q67" ID="mfmock25q67a" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="67acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="67b" NAME="mfmock25q67" ID="mfmock25q67b" onclick="changeStatus('67')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="67bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q68">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 68. Who Regulates the Mutual Fund Market?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q68">
					<INPUT TYPE="RADIO" VALUE="68a" NAME="mfmock25q68" ID="mfmock25q68a" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> SEBI <div id="68acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="68b" NAME="mfmock25q68" ID="mfmock25q68b" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> AMFI <div id="68bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68c" NAME="mfmock25q68" ID="mfmock25q68c" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RBI <div id="68ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="68d" NAME="mfmock25q68" ID="mfmock25q68d" onclick="changeStatus('68')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Government of India <div id="68dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q69">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 69. Which of the following is the non-government securities-based index?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q69">
					<INPUT TYPE="RADIO" VALUE="69a" NAME="mfmock25q69" ID="mfmock25q69a" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> NSE’S MIBOR <div id="69acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="69b" NAME="mfmock25q69" ID="mfmock25q69b" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> CRISIL liquiFEX <div id="69bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69c" NAME="mfmock25q69" ID="mfmock25q69c" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> CRISIL’S AAA Corporate bond index <div id="69ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="69d" NAME="mfmock25q69" ID="mfmock25q69d" onclick="changeStatus('69')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Nifty 50 <div id="69dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q70">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 70. When does a scheme is called equity oriented?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q70">
					<INPUT TYPE="RADIO" VALUE="70a" NAME="mfmock25q70" ID="mfmock25q70a" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> More than 85% of the scheme funds are invested in equity shares. <div id="70acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="70b" NAME="mfmock25q70" ID="mfmock25q70b" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 100% of the scheme funds are invested in equity shares. <div id="70bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70c" NAME="mfmock25q70" ID="mfmock25q70c" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> More than 65% of the scheme funds are invested in equity shares. <div id="70ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="70d" NAME="mfmock25q70" ID="mfmock25q70d" onclick="changeStatus('70')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> More than 90% of the scheme funds are invested in equity shares. <div id="70dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q71">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 71. What is the process of recovery of unclaimed amount by investor?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q71">
					<INPUT TYPE="RADIO" VALUE="71a" NAME="mfmock25q71" ID="mfmock25q71a" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> If the investor claim money within 3 years then he gets the payment on current NAV <div id="71acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="71b" NAME="mfmock25q71" ID="mfmock25q71b" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> If the investors claim money after 3 years then he gets payment on previous NAV at the end of 3 year <div id="71bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71c" NAME="mfmock25q71" ID="mfmock25q71c" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) & (B) <div id="71ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="71d" NAME="mfmock25q71" ID="mfmock25q71d" onclick="changeStatus('71')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Only A <div id="71dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q72">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 72. What are valuation losses?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q72">
					<INPUT TYPE="RADIO" VALUE="72a" NAME="mfmock25q72" ID="mfmock25q72a" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> When securities are quoted in the market at lower than the cost paid <div id="72acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="72b" NAME="mfmock25q72" ID="mfmock25q72b" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> When securities are quoted in the market at higher than the cost paid <div id="72bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72c" NAME="mfmock25q72" ID="mfmock25q72c" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> When securities are quoted in the market at cost price <div id="72ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="72d" NAME="mfmock25q72" ID="mfmock25q72d" onclick="changeStatus('72')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="72dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q73">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 73. Fixed Maturity Plans are _____?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q73">
					<INPUT TYPE="RADIO" VALUE="73a" NAME="mfmock25q73" ID="mfmock25q73a" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Close ended scheme <div id="73acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="73b" NAME="mfmock25q73" ID="mfmock25q73b" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Open ended schemes <div id="73bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73c" NAME="mfmock25q73" ID="mfmock25q73c" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both of the above <div id="73ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="73d" NAME="mfmock25q73" ID="mfmock25q73d" onclick="changeStatus('73')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="73dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q74">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 74. Which of the followings are types of funds based on?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q74">
					<INPUT TYPE="RADIO" VALUE="74a" NAME="mfmock25q74" ID="mfmock25q74a" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Open ended fund <div id="74acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="74b" NAME="mfmock25q74" ID="mfmock25q74b" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> close ended fund <div id="74bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74c" NAME="mfmock25q74" ID="mfmock25q74c" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> interval fund <div id="74ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="74d" NAME="mfmock25q74" ID="mfmock25q74d" onclick="changeStatus('74')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="74dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q75">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 75. Which of the following options have the benefit of letting the money grow in the fund on gross basis?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q75">
					<INPUT TYPE="RADIO" VALUE="75a" NAME="mfmock25q75" ID="mfmock25q75a" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Dividend payout option <div id="75acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="75b" NAME="mfmock25q75" ID="mfmock25q75b" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Growth option <div id="75bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75c" NAME="mfmock25q75" ID="mfmock25q75c" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Dividend reinvestment option <div id="75ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="75d" NAME="mfmock25q75" ID="mfmock25q75d" onclick="changeStatus('75')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="75dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q76">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 76. Equity markets are a good barometer of the real economy in the long run?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q76">
					<INPUT TYPE="RADIO" VALUE="76a" NAME="mfmock25q76" ID="mfmock25q76a" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="76acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="76b" NAME="mfmock25q76" ID="mfmock25q76b" onclick="changeStatus('76')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="76bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q77">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 77. Full Form of CDSC? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q77">
					<INPUT TYPE="RADIO" VALUE="77a" NAME="mfmock25q77" ID="mfmock25q77a" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Compounded annual differed sales charge <div id="77acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="77b" NAME="mfmock25q77" ID="mfmock25q77b" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Common deposit sales charge <div id="77bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77c" NAME="mfmock25q77" ID="mfmock25q77c" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Contingent deferred sales charge <div id="77ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="77d" NAME="mfmock25q77" ID="mfmock25q77d" onclick="changeStatus('77')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="77dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q78">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 78. Forwards, futures options and swaps are called as _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q78">
					<INPUT TYPE="RADIO" VALUE="78a" NAME="mfmock25q78" ID="mfmock25q78a" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Mutual Fund Scheme <div id="78acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="78b" NAME="mfmock25q78" ID="mfmock25q78b" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Derivative Instruments <div id="78bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78c" NAME="mfmock25q78" ID="mfmock25q78c" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Money Market Instruments <div id="78ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="78d" NAME="mfmock25q78" ID="mfmock25q78d" onclick="changeStatus('78')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Debt Instruments <div id="78dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q79">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 79. Bank account detail is mandatory for investing in a mutual fund scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q79">
					<INPUT TYPE="RADIO" VALUE="79a" NAME="mfmock25q79" ID="mfmock25q79a" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="79acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="79b" NAME="mfmock25q79" ID="mfmock25q79b" onclick="changeStatus('79')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="79bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q80">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 80. What is considered as an international asset?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q80">
					<INPUT TYPE="RADIO" VALUE="80a" NAME="mfmock25q80" ID="mfmock25q80a" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Shares issued by Indian companies <div id="80acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="80b" NAME="mfmock25q80" ID="mfmock25q80b" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Debentures issued by Indian companies <div id="80bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80c" NAME="mfmock25q80" ID="mfmock25q80c" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Real Estate <div id="80ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="80d" NAME="mfmock25q80" ID="mfmock25q80d" onclick="changeStatus('80')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Gold <div id="80dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q81">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 81. If an investor is predicting that interest rates will decline, what kind of fund he will invest his money?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q81">
					<INPUT TYPE="RADIO" VALUE="81a" NAME="mfmock25q81" ID="mfmock25q81a" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Income fund <div id="81acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="81b" NAME="mfmock25q81" ID="mfmock25q81b" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Equity growth fund <div id="81bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81c" NAME="mfmock25q81" ID="mfmock25q81c" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Long term gilt fund <div id="81ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="81d" NAME="mfmock25q81" ID="mfmock25q81d" onclick="changeStatus('81')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) & (C) <div id="81dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q82">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 82. What is fund of funds?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q82">
					<INPUT TYPE="RADIO" VALUE="82a" NAME="mfmock25q82" ID="mfmock25q82a" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> A mutual fund scheme that invest in other mutual fund schemes. <div id="82acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="82b" NAME="mfmock25q82" ID="mfmock25q82b" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A mutual fund scheme that invest in NPS <div id="82bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82c" NAME="mfmock25q82" ID="mfmock25q82c" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> A mutual fund scheme that invest in equity shares <div id="82ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="82d" NAME="mfmock25q82" ID="mfmock25q82d" onclick="changeStatus('82')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> A mutual fund scheme that invest in debentures <div id="82dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q83">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 83. AMC’s are member of which organization?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q83">
					<INPUT TYPE="RADIO" VALUE="83a" NAME="mfmock25q83" ID="mfmock25q83a" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMFI <div id="83acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="83b" NAME="mfmock25q83" ID="mfmock25q83b" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="83bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83c" NAME="mfmock25q83" ID="mfmock25q83c" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RBI <div id="83ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="83d" NAME="mfmock25q83" ID="mfmock25q83d" onclick="changeStatus('83')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> NSE <div id="83dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q84">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 84. Unit certificate are _____.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q84">
					<INPUT TYPE="RADIO" VALUE="84a" NAME="mfmock25q84" ID="mfmock25q84a" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Transferable <div id="84acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="84b" NAME="mfmock25q84" ID="mfmock25q84b" onclick="changeStatus('84')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Non-Transferable <div id="84bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q85">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 85. Which of the following is the right stage to get health & life insurance?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q85">
					<INPUT TYPE="RADIO" VALUE="85a" NAME="mfmock25q85" ID="mfmock25q85a" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Children <div id="85acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="85b" NAME="mfmock25q85" ID="mfmock25q85b" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Young Unmarried <div id="85bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85c" NAME="mfmock25q85" ID="mfmock25q85c" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Retired <div id="85ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="85d" NAME="mfmock25q85" ID="mfmock25q85d" onclick="changeStatus('85')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Young Married <div id="85dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q86">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 86. Daring & adventurous people with better mental state have higher risk appetite?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q86">
					<INPUT TYPE="RADIO" VALUE="86a" NAME="mfmock25q86" ID="mfmock25q86a" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="86acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="86b" NAME="mfmock25q86" ID="mfmock25q86b" onclick="changeStatus('86')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="86bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q87">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 87. Define valuation gain?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q87">
					<INPUT TYPE="RADIO" VALUE="87a" NAME="mfmock25q87" ID="mfmock25q87a" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Investment owned by the scheme may be quoted in the market at higher than the cost paid. Such gain in values on securities are called as valuation gain. <div id="87acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="87b" NAME="mfmock25q87" ID="mfmock25q87b" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Investment owned by the scheme may be quoted in the market at lower than the cost paid. Such difference in values on securities are called as valuation gain. <div id="87bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87c" NAME="mfmock25q87" ID="mfmock25q87c" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Investment owned by the scheme may be quoted in the market at higher than the cost paid. Such loss in values on securities are held called as valuation gain. <div id="87ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="87d" NAME="mfmock25q87" ID="mfmock25q87d" onclick="changeStatus('87')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (B) & (C) <div id="87dcheck" style="display: inline-block;"></div>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q88">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 88. How much equity would you suggest for a young well settled unmarried individual.</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q88">
					<INPUT TYPE="RADIO" VALUE="88a" NAME="mfmock25q88" ID="mfmock25q88a" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 100% <div id="88acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="88b" NAME="mfmock25q88" ID="mfmock25q88b" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 80% <div id="88bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88c" NAME="mfmock25q88" ID="mfmock25q88c" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 60% <div id="88ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="88d" NAME="mfmock25q88" ID="mfmock25q88d" onclick="changeStatus('88')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 40% <div id="88dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q89">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 89. How many unit holders are required to wind up a scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q89">
					<INPUT TYPE="RADIO" VALUE="89a" NAME="mfmock25q89" ID="mfmock25q89a" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Minimum 75% of unit holders. <div id="89acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="89b" NAME="mfmock25q89" ID="mfmock25q89b" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Maximum 75% of unit holders <div id="89bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="89c" NAME="mfmock25q89" ID="mfmock25q89c" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Maximum 51% of the unit holders <div id="89ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="89d" NAME="mfmock25q89" ID="mfmock25q89d" onclick="changeStatus('89')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Minimum 51% of the unit holders <div id="89dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q90">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 90. Gilt schemes are risk free?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q90">
					<INPUT TYPE="RADIO" VALUE="90a" NAME="mfmock25q90" ID="mfmock25q90a" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="90acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="90b" NAME="mfmock25q90" ID="mfmock25q90b" onclick="changeStatus('90')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="90bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q91">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 91. Which of the following investment scheme is preferred for retirement planning?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q91">
					<INPUT TYPE="RADIO" VALUE="91a" NAME="mfmock25q91" ID="mfmock25q91a" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Equity oriented hybrid schemes <div id="91acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="91b" NAME="mfmock25q91" ID="mfmock25q91b" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Debt oriented hybrid schemes <div id="91bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91c" NAME="mfmock25q91" ID="mfmock25q91c" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Long term Debt schemes <div id="91ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="91d" NAME="mfmock25q91" ID="mfmock25q91d" onclick="changeStatus('91')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Liquid schemes <div id="91dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q92">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 92. Define Mutual Fund Scheme?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q92">
					<INPUT TYPE="RADIO" VALUE="92a" NAME="mfmock25q92" ID="mfmock25q92a" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> It is a pool of money <div id="92acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="92b" NAME="mfmock25q92" ID="mfmock25q92b" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> It has a preannounced investment objective <div id="92bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92c" NAME="mfmock25q92" ID="mfmock25q92c" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> It is always open to accept money from investors <div id="92ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="92d" NAME="mfmock25q92" ID="mfmock25q92d" onclick="changeStatus('92')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Both (A) and (B) <div id="92dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q93">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 93. What is in Person Verification (IPV)?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q93">
					<INPUT TYPE="RADIO" VALUE="93a" NAME="mfmock25q93" ID="mfmock25q93a" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Face to Face verification by an authorized person for KYC of investor. <div id="93acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="93b" NAME="mfmock25q93" ID="mfmock25q93b" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Verification by the way of video conferencing  <div id="93bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93c" NAME="mfmock25q93" ID="mfmock25q93c" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Verification on account of a fraud conducted by someone  <div id="93ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="93d" NAME="mfmock25q93" ID="mfmock25q93d" onclick="changeStatus('93')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Face to Face verification by anyone for KYC of investor <div id="93dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q94">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 94. Full form of SID?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q94">
					<INPUT TYPE="RADIO" VALUE="94a" NAME="mfmock25q94" ID="mfmock25q94a" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> System information document <div id="94acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="94b" NAME="mfmock25q94" ID="mfmock25q94b" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Scheme information document <div id="94bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94c" NAME="mfmock25q94" ID="mfmock25q94c" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Systematic information document <div id="94ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="94d" NAME="mfmock25q94" ID="mfmock25q94d" onclick="changeStatus('94')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Semantic Information Document <div id="94dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q95">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 95. Stock exchange brokers are permitted to distribute Mutual Funds without the requirement of passing the certifying test?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q95">
					<INPUT TYPE="RADIO" VALUE="95a" NAME="mfmock25q95" ID="mfmock25q95a" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="95acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="95b" NAME="mfmock25q95" ID="mfmock25q95b" onclick="changeStatus('95')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="95bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q96">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 96. Whose approval is required first to launch a new scheme by a mutual fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q96">
					<INPUT TYPE="RADIO" VALUE="96a" NAME="mfmock25q96" ID="mfmock25q96a" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sponsor <div id="96acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="96b" NAME="mfmock25q96" ID="mfmock25q96b" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> SEBI <div id="96bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96c" NAME="mfmock25q96" ID="mfmock25q96c" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> AMC <div id="96ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="96d" NAME="mfmock25q96" ID="mfmock25q96d" onclick="changeStatus('96')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RBI <div id="96dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q97">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 97. Offer document of Mutual Fund schemes are approved by SEBI? </b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q97">
					<INPUT TYPE="RADIO" VALUE="97a" NAME="mfmock25q97" ID="mfmock25q97a" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="97acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="97b" NAME="mfmock25q97" ID="mfmock25q97b" onclick="changeStatus('97')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="97bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q98">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 98. A high standard deviation indicated greater volatility in the returns & greater risk?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q98">
					<INPUT TYPE="RADIO" VALUE="98a" NAME="mfmock25q98" ID="mfmock25q98a" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True <div id="98acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="98b" NAME="mfmock25q98" ID="mfmock25q98b" onclick="changeStatus('98')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False <div id="98bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q99">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 99. Trust Deed is Executed between whom?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q99">
					<INPUT TYPE="RADIO" VALUE="99a" NAME="mfmock25q99" ID="mfmock25q99a" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sponsor and Trustee <div id="99acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="99b" NAME="mfmock25q99" ID="mfmock25q99b" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sponsor and RTA <div id="99bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99c" NAME="mfmock25q99" ID="mfmock25q99c" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor and Investors <div id="99ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="99d" NAME="mfmock25q99" ID="mfmock25q99d" onclick="changeStatus('99')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Sponsor and AMC <div id="99dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-12" style="display:none" id="mf25-q100">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 100. Debt schemes need to pay an income distribution tax on the dividend distributed. This tax payment reduces the NAV?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock25q100">
					<INPUT TYPE="RADIO" VALUE="100a" NAME="mfmock25q100" ID="mfmock25q100a" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> False <div id="100acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="100b" NAME="mfmock25q100" ID="mfmock25q100b" onclick="changeStatus('100')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> True <div id="100bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		
        <section class="col-lg-12" style="display: none" id="mf25-status">
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