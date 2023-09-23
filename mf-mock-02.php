<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MF-Mock02 | IBR Live</title>
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
				
				for(var j=1; j<=10; j++){
				  var tempItem1;
				  var tempItem2;
				  
				  tempItem1="q"+i+"status";
				  tempItem2="mfmock2q"+i;
				  
  				  localStorage.removeItem(tempItem1); 
				  localStorage.removeItem(tempItem2);
				  clearTimeout(myTimer);
				}
                var tid; 
                for(var j=1; j<=10; j++){
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
				localStorage.setItem("min", parseInt(9));
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
			var nid="mf02-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("mf02-status").style.display = "block";
			document.getElementById("mf02-guide").style.display = "none";  
			document.getElementById("mf02-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=10;i++){
				qhid = "mf02-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
                        if(parseInt(localStorage.getItem("started"))==parseInt(2)){

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
			
                        document.getElementById("mf02-q1").style.display = "block"; 
			document.getElementById("mf02-status").style.display = "block";
			document.getElementById("mf02-guide").style.display = "none"; 
			document.getElementById("mf02-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));
				
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(2)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "mfmock2q"+qno;
			  
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

			for(i=1; i<=10; i++){
				qtochange="q"+i+"status"; 
				idtochange="status"+i;
				
				if(!localStorage.getItem(qtochange)){
					localStorage.setItem(qtochange, "round-button");
					document.getElementById(idtochange).className = localStorage.getItem(qtochange);
				}else{
					//localStorage.setItem(qtochange, "round-button-ans");
					document.getElementById(idtochange).className = localStorage.getItem(qtochange);
				}
				
				qval = "mfmock2q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "mfmock2q"+i+"a"; tcheckb = "mfmock2q"+i+"b"; tcheckc = "mfmock2q"+i+"c"; tcheckd = "mfmock2q"+i+"d";
						
						if(i==6 || i==8){							  
						  document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false;
						} else {
						  document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						  document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						}
						
					break;
					
					case i+"b":
						tchecka = "mfmock2q"+i+"a"; tcheckb = "mfmock2q"+i+"b"; tcheckc = "mfmock2q"+i+"c"; tcheckd = "mfmock2q"+i+"d";
						
						if(i==6 || i==8){
						  document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true;						  
						} else { 
						  document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						  document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						}
					break;
					
					case i+"c":
						tchecka = "mfmock2q"+i+"a"; tcheckb = "mfmock2q"+i+"b"; tcheckc = "mfmock2q"+i+"c"; tcheckd = "mfmock2q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "mfmock2q"+i+"a"; tcheckb = "mfmock2q"+i+"b"; tcheckc = "mfmock2q"+i+"c"; tcheckd = "mfmock2q"+i+"d";
						
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
			$.post('test', {
				data: userans
			}, function(response) {
                var res = response.split("-");
				document.getElementById("endscore").innerHTML = "<font style='color:black; background:#ADFF2F; padding:10px;'><b>Your Score: </b>"+res[0]+"/10";

                var tval=0;
                var tstr;
                var tci;  
                for(var j=0; j<=9; j++){
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
            for(var j=1; j<=10; j++){
                tid="endexam"+j;
			    document.getElementById(tid).style.display = "none"; 
            }
			
			for(var i=1;i<=10;i++){
				tLabel = "mfmock2q"+i;
				val = localStorage.getItem(tLabel); 
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('2'); //test-02
			document.getElementById("starttime").style.display = "none";
			document.getElementById("showtime").style.display = "none";	
			document.getElementById("endscore").style.display = "block";
			document.getElementById("reexam").style.display = "block";

			localStorage.removeItem("starttime");
			localStorage.removeItem("min"); 
			localStorage.removeItem("sec"); 
			
			for(var j=1; j<=10; j++){
			  var tempItem1;
			  var tempItem2;
			  
			  tempItem1="q"+j+"status";
			  tempItem2="mfmock2q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>NISM-Series-V-A: Mutual Fund Distributors Certification - Mock Test 02</b></p>
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
          <div class="nav-tabs-custom" id="mf02-guide">
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
				<li class="fli"> This is 2nd Mock Test out of "5 Free Mock Tests" available on this website.</li>
				<li class="fli"> Mock Test 02 has total 10 questions of 1 mark each. Please note that the actual examination for NISM-Series-V-A: Mutual Fund Distributors has 100 questions of 1 mark each.</li>
				<li class="fli"> There is no negative marking.</li>
				<li class="fli"> The passing score on the examination is 50%</li>	
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for NISM-Series-V-A: Mutual Fund Distributor Certification Examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('2')">Take the Test</button></li>
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
          <div class="box box-solid " id="mf02-tut">
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
              <button class="btn btn-primary" onclick="location.href='mf-mock-01'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>           
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
              <button class="btn btn-primary" onclick="location.href='mf-mock-03'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>

	<section class="col-lg-9" style="display:none" id="mf02-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. Capital protected schemes are?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="mfmock2q1" ID="mfmock2q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Close ended schemes <div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="mfmock2q1" ID="mfmock2q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Open ended schemes <div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="mfmock2q1" ID="mfmock2q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B) <div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="mfmock2q1" ID="mfmock2q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. Objective of hybrid funds</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="mfmock2q2" ID="mfmock2q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Protection of investment along with capital appreciation <div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="mfmock2q2" ID="mfmock2q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Fixed interest income <div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="mfmock2q2" ID="mfmock2q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> High Growth <div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="mfmock2q2" ID="mfmock2q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Capital protection <div id="2dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. Who are the beneficiary of Mutual Fund Trust?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="mfmock2q3" ID="mfmock2q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Investor who invest in various schemes <div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="mfmock2q3" ID="mfmock2q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Trustees of Mutual fund trust <div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="mfmock2q3" ID="mfmock2q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Sponsor <div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="mfmock2q3" ID="mfmock2q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RTA <div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; line-height:30px; font-size: 20px;">
                <b>Q 4. Which type of expenses is born to running a expense?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="mfmock2q4" ID="mfmock2q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Operating expenses <div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="mfmock2q4" ID="mfmock2q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Accrued expenses <div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="mfmock2q4" ID="mfmock2q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Initial issue expenses <div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="mfmock2q4" ID="mfmock2q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Who is a custodian?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="mfmock2q5" ID="mfmock2q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Who keeps the custody or safekeeping of the assets of the scheme. <div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="mfmock2q5" ID="mfmock2q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Who handles the day to day operations of AMC. <div id="5bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5c" NAME="mfmock2q5" ID="mfmock2q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Who Keep records of the sale and purchase of securities. <div id="5ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="5d" NAME="mfmock2q5" ID="mfmock2q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Who keep record of day to day expenses of the scheme. <div id="5dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Day to day management of the scheme is handled by whom?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="mfmock2q6" ID="mfmock2q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> AMC (Asset Management Company) <div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="mfmock2q6" ID="mfmock2q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sponsor <div id="6bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6c" NAME="mfmock2q6" ID="mfmock2q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> RTA <div id="6ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="6d" NAME="mfmock2q6" ID="mfmock2q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All of the above <div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. What is the objective of equity fund?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="mfmock2q7" ID="mfmock2q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Capital appreciation <div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="mfmock2q7" ID="mfmock2q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Capital loss <div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="mfmock2q7" ID="mfmock2q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Fixed Interest income <div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="mfmock2q7" ID="mfmock2q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Investment protection <div id="7dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. When a scheme is first made available for investment what it is called?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="mfmock2q8" ID="mfmock2q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> NFO <div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="mfmock2q8" ID="mfmock2q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Open ended scheme <div id="8bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8c" NAME="mfmock2q8" ID="mfmock2q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Close ended scheme <div id="8ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="8d" NAME="mfmock2q8" ID="mfmock2q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Liquid scheme <div id="8dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. Custodian has to be registered with?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="mfmock2q9" ID="mfmock2q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> SEBI <div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="mfmock2q9" ID="mfmock2q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> RBI <div id="9bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9c" NAME="mfmock2q9" ID="mfmock2q9c" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> NSDL <div id="9ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="9d" NAME="mfmock2q9" ID="mfmock2q9d" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above <div id="9dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="mf02-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. Unit of _________ must be listed on the stock exchange?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="mfmock2q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="mfmock2q10" ID="mfmock2q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Sector Funds <div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="mfmock2q10" ID="mfmock2q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Arbitrage Funds <div id="10bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10c" NAME="mfmock2q10" ID="mfmock2q10c" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C</b>) Close Ended Funds <div id="10ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="10d" NAME="mfmock2q10" ID="mfmock2q10d" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Liquids Funds <div id="10dcheck" style="display: inline-block;"></div><BR/><BR/>
					</form>
					<hr/>
					<ul class="pager">
                      <li class="previous"><button class="btn btn-primary" onclick="showQ('9')" style="float:left">&#8656; BACK</button></li>
		      <li class="next" id="endexam10"><button class="btn btn-warning" onclick="checkAnswer()">END EXAM</button></li>
                    </ul>
 	              </div>	                  
              </div><!-- /.box-header -->    
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
		
		<section class="col-lg-3" style="display: none" id="mf02-status">
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
						</tr>
						<tr>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
							<td style="padding:5px;"></td>
							<td></td>
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