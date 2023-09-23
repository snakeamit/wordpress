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
  <title>FE-Mock14 | IBR Live</title>
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
				  tempItem2="femock14q"+i;
				  
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
			var nid="fe14-q"+qno;
            document.getElementById(nid).style.display = "block"; 
			document.getElementById("fe14-status").style.display = "block";
			document.getElementById("fe14-guide").style.display = "none";  
			document.getElementById("fe14-tut").style.display = "none"; 
			
            var i;
			for (i=1;i<=25;i++){
				qhid = "fe14-q"+i;
				
				if(i!=qno){
					document.getElementById(qhid).style.display = "none"; 
				}
			}
        }
		function startTest(tno) { 
            if(parseInt(localStorage.getItem("started"))==parseInt(213)){

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
		
            document.getElementById("fe14-q1").style.display = "block"; 
			document.getElementById("fe14-status").style.display = "block";
			document.getElementById("fe14-guide").style.display = "none"; 
			document.getElementById("fe14-tut").style.display = "none"; 
			clock();	
                        
			localStorage.setItem("started", parseInt(tno));		
        }
		
		function changeStatus(qno) {			
			var qtochange;
			var idtochange;
			
            if(parseInt(localStorage.getItem("started"))==parseInt(213)){
                var qval;
                var qval2;
                var form;

			    qtochange="q"+qno+"status";
			    idtochange="status"+qno;
			    localStorage.setItem(qtochange, "round-button-ans");
			    document.getElementById(idtochange).className = localStorage.getItem(qtochange);			
			  
			    qval = "femock14q"+qno;
			  
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
				
				qval = "femock14q"+i;
				tval = localStorage.getItem(String(qval))
				switch(tval){
					case i+"a":
						tchecka = "femock14q"+i+"a"; tcheckb = "femock14q"+i+"b"; tcheckc = "femock14q"+i+"c"; tcheckd = "femock14q"+i+"d";
						
						document.getElementById(tchecka).checked = true; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
						
					break;
					
					case i+"b":
						tchecka = "femock14q"+i+"a"; tcheckb = "femock14q"+i+"b"; tcheckc = "femock14q"+i+"c"; tcheckd = "femock14q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = true; 
						document.getElementById(tcheckc).checked = false; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"c":
						tchecka = "femock14q"+i+"a"; tcheckb = "femock14q"+i+"b"; tcheckc = "femock14q"+i+"c"; tcheckd = "femock14q"+i+"d";
						
						document.getElementById(tchecka).checked = false; document.getElementById(tcheckb).checked = false; 
						document.getElementById(tcheckc).checked = true; document.getElementById(tcheckd).checked = false;
						
					break;
					
					case i+"d":
						tchecka = "femock14q"+i+"a"; tcheckb = "femock14q"+i+"b"; tcheckc = "femock14q"+i+"c"; tcheckd = "femock14q"+i+"d";
						
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
				tLabel = "femock14q"+i;
				val = localStorage.getItem(tLabel); 						
				
				if(val!=null)
					val = val.replace(/[0-9]/g, '');
				
				if(val){
					userans.push(val); 
				}else{	
					userans.push('z'); //z for not answered
				}
			}
			userans.push('14'); //test-014
			
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
			  tempItem2="femock14q"+j;
				  
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
              <p style="font-size: 22px; text-align: center; color: black !important;"><b>IIBF's Certificate Course in Foreign Exchange - Mock Test 14</b></p>
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
          <div class="nav-tabs-custom" id="fe14-guide">
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
				<li class="fli"> Mock Test 14 has total 25 questions of 1 mark each. Please note that the actual examination have 100 questions that has to be completed in 2 hours.</li>
				<li class="fli"> There is no negative marking.</li>
				<li class="fli"> The passing score on the examination is 50%.</li>	
			  </ul>
			  <hr/>
			  <ul><li><font style="font-size: 18px;"><b><i>This test series has been prepared by the experts and gives you an experience of on-line exam testing system. This would not make you eligible for claiming a certificate for <b>IIBF's Certificate Course in Foreign Exchange</b> examination.</b></i></font></li></ul>
					
			  <ul class="pager">
                <li class="next"><button class="btn btn-primary btn-lg" onclick="startTest('213')">Take the Test</button></li>
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
          <div class="box box-solid " id="fe14-tut">
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
              <button class="btn btn-primary" onclick="location.href='fe-mock-0212'"><i class="fa fa-arrow-circle-left"></i> PREVIOUS EXAM </button>       
              <button class="btn btn-warning" onclick="window.location.reload()"><i class="fa fa-refresh"></i> RE-TAKE EXAM</button>
              <button class="btn btn-primary" onclick="location.href='fe-mock-0214'">NEXT EXAM <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
	
	<section class="col-lg-9" style="display:none" id="fe14-q1">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 1. Which transactions require prior approval of the Reserve Bank of India?</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q1">
					<INPUT TYPE="RADIO" VALUE="1a" NAME="femock14q1" ID="femock14q1a" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Specified in Schedule I<div id="1acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="1b" NAME="femock14q1" ID="femock14q1b" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Specified in Scbedule II<div id="1bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1c" NAME="femock14q1" ID="femock14q1c" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Specified in schedule III<div id="1ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="1d" NAME="femock14q1" ID="femock14q1d" onclick="changeStatus('1')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="1dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q2">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 2. Duplicate copy of EDF form duly certified by Customs alongwith relative shipping documents should be submitted to AD-I Bank within</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q2">
					<INPUT TYPE="RADIO" VALUE="2a" NAME="femock14q2" ID="femock14q2a" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 31 days<div id="2acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="2b" NAME="femock14q2" ID="femock14q2b" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 21 days<div id="2bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2c" NAME="femock14q2" ID="femock14q2c" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 30 days<div id="2ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="2d" NAME="femock14q2" ID="femock14q2d" onclick="changeStatus('2')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="2dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q3">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 3. The receipt of foreign exchange against payment for export from India to Nepal and Bhutan cannot be</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q3">
					<INPUT TYPE="RADIO" VALUE="3a" NAME="femock14q3" ID="femock14q3a" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> In Indian Rupees<div id="3acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="3b" NAME="femock14q3" ID="femock14q3b" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> In free foreign exchange if permitted by Nepal Rashtra Bank<div id="3bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3c" NAME="femock14q3" ID="femock14q3c" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> By debit to ACU Dollar / Euro Account in India of a Bank of member country<div id="3ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="3d" NAME="femock14q3" ID="femock14q3d" onclick="changeStatus('3')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="3dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q4">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 4. The rate of interest, if any, payable on the advance payment</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q4">
					<INPUT TYPE="RADIO" VALUE="4a" NAME="femock14q4" ID="femock14q4a" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Should not exceed LIBOR + 100 basis points<div id="4acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="4b" NAME="femock14q4" ID="femock14q4b" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Should not exceed LIBOR + 200 basis points<div id="4bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4c" NAME="femock14q4" ID="femock14q4c" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Should not exceed LIBOR for 12 months<div id="4ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="4d" NAME="femock14q4" ID="femock14q4d" onclick="changeStatus('4')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Base Rate + 2%<div id="4dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 5. Choose the incorrect statement In case of Third Party transaction</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q5">
					<INPUT TYPE="RADIO" VALUE="5a" NAME="femock14q5" ID="femock14q5a" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> It should be routed through the banking channel only<div id="5acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5b" NAME="femock14q5" ID="femock14q5b" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Exporter should declare the third party remittance in the Export Declaration Form<div id="5bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5c" NAME="femock14q5" ID="femock14q5c" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> It would be responsibility of the Exporter to realize and repatriate the export proceeds from such third party named in the EDF<div id="5ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="5d" NAME="femock14q5" ID="femock14q5d" onclick="changeStatus('5')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> It requires RBI permission<div id="5dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 6. Which of the following statements is not true in case of an Escrow account</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q6">
					<INPUT TYPE="RADIO" VALUE="6a" NAME="femock14q6" ID="femock14q6a" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> No interest is paid on this account<div id="6acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6b" NAME="femock14q6" ID="femock14q6b" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Permission is required form RBI and DGFT to open this account<div id="6bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6c" NAME="femock14q6" ID="femock14q6c" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> No fund based/non-fund based facility permitted against balances in Escrow Account<div id="6ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="6d" NAME="femock14q6" ID="femock14q6d" onclick="changeStatus('6')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> All the statements are true<div id="6dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 7. Export Bills written off are reported on _____ format to RBI</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q7">
					<INPUT TYPE="RADIO" VALUE="7a" NAME="femock14q7" ID="femock14q7a" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> XOS<div id="7acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="7b" NAME="femock14q7" ID="femock14q7b" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> BEF<div id="7bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7c" NAME="femock14q7" ID="femock14q7c" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> EBW<div id="7ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="7d" NAME="femock14q7" ID="femock14q7d" onclick="changeStatus('7')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> EXW<div id="7dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q8">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 8. In case of self write-off, exporter should submit which of the following to the concerned AD Bank</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q8">
					<INPUT TYPE="RADIO" VALUE="8a" NAME="femock14q8" ID="femock14q8a" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Chartered Accountant's certificate<div id="8acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8b" NAME="femock14q8" ID="femock14q8b" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A self certification to AD Category-I bank<div id="8bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8c" NAME="femock14q8" ID="femock14q8c" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> (A) and (B) both<div id="8ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="8d" NAME="femock14q8" ID="femock14q8d" onclick="changeStatus('8')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Not allowed by RBI under FEMA<div id="8dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q9">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 9. If extension of time is granted, export details are not reported in the XOS statement</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q9">
					<INPUT TYPE="RADIO" VALUE="9a" NAME="femock14q9" ID="femock14q9a" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TRUE<div id="9acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="9b" NAME="femock14q9" ID="femock14q9b" onclick="changeStatus('9')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> FALSE<div id="9bcheck" style="display: inline-block;"></div><BR/><BR/><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q10">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 10. In cases where the exporter has filed suits abroad against the buyer, extension may be granted irrespective of the amount involved /outstanding</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q10">
					<INPUT TYPE="RADIO" VALUE="10a" NAME="femock14q10" ID="femock14q10a" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> TRUE<div id="10acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="10b" NAME="femock14q10" ID="femock14q10b" onclick="changeStatus('10')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> FALSE<div id="10bcheck" style="display: inline-block;"></div><BR/><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q11">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 11. ADs may grant EDF/SDF waiver for export of goods free of cost by status holder exporters for amounts</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q11">
					<INPUT TYPE="RADIO" VALUE="11a" NAME="femock14q11" ID="femock14q11a" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Rs. 10 lakhs or 2 percent of average annual export realization during preceding three years, which ever is higher<div id="11acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="11b" NAME="femock14q11" ID="femock14q11b" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Rs. 10 lakhs or 2 percent of average annual export realization during preceding three years, which ever is lower<div id="11bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11c" NAME="femock14q11" ID="femock14q11c" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Rs. 5 lakhs or 2 percent of average annual export realization during preceding three years, which ever is higher<div id="11ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="11d" NAME="femock14q11" ID="femock14q11d" onclick="changeStatus('11')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Rs. 5 lakhs or 2 percent of average annual export realization during preceding three years, which ever is lower<div id="11dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 12. EDF stands for</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q12">
					<INPUT TYPE="RADIO" VALUE="12a" NAME="femock14q12" ID="femock14q12a" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Exchange Declaration Form<div id="12acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="12b" NAME="femock14q12" ID="femock14q12b" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Export Declaration Form<div id="12bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12c" NAME="femock14q12" ID="femock14q12c" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Exchange Deposit Format<div id="12ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="12d" NAME="femock14q12" ID="femock14q12d" onclick="changeStatus('12')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Export Demand Format<div id="12dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q13">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 13. Import trade is regulated by</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q13">
					<INPUT TYPE="RADIO" VALUE="13a" NAME="femock14q13" ID="femock14q13a" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Directorate General of Foreign Trade (DGFT)<div id="13acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="13b" NAME="femock14q13" ID="femock14q13b" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Ministry of external affairs<div id="13bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13c" NAME="femock14q13" ID="femock14q13c" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Reserve Bank of India<div id="13ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="13d" NAME="femock14q13" ID="femock14q13d" onclick="changeStatus('13')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="13dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q14">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 14. For exchange control purpose, rupee accounts maintained in India by citizens of India, Nepal & Bhutan as well as Nepalese and Bhutanese firms, companies etc. are regarded as</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q14">
					<INPUT TYPE="RADIO" VALUE="14a" NAME="femock14q14" ID="femock14q14a" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Non-resident accounts<div id="14acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="14b" NAME="femock14q14" ID="femock14q14b" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Resident accounts<div id="14bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14c" NAME="femock14q14" ID="femock14q14c" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Non-resident external accounts<div id="14ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="14d" NAME="femock14q14" ID="femock14q14d" onclick="changeStatus('14')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> None of the above<div id="14dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q15">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 15. Under Asian Clearing Union(ACU)  Mechanism payment for Import  may be made in rupees to</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q15">
					<INPUT TYPE="RADIO" VALUE="15a" NAME="femock14q15" ID="femock14q15a" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Bangladesh, Myanmar, Pakistan<div id="15acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15b" NAME="femock14q15" ID="femock14q15b" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Sri Lanka, Maldives<div id="15bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15c" NAME="femock14q15" ID="femock14q15c" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Nepal and Bhutan<div id="15ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="15d" NAME="femock14q15" ID="femock14q15d" onclick="changeStatus('15')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Islamic Republic of Iran<div id="15dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q16">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 16. In terms of the extant regulations, remittances against imports should be completed not later than _____ from the date of shipment</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q16">
					<INPUT TYPE="RADIO" VALUE="16a" NAME="femock14q16" ID="femock14q16a" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 6 months<div id="16acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16b" NAME="femock14q16" ID="femock14q16b" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 90 days<div id="16bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16c" NAME="femock14q16" ID="femock14q16c" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 360 days<div id="16ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="16d" NAME="femock14q16" ID="femock14q16d" onclick="changeStatus('16')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 9 months<div id="16dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q17">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 17. Among other directives, Import Trade is also regulated by</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q17">
					<INPUT TYPE="RADIO" VALUE="17a" NAME="femock14q17" ID="femock14q17a" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Foreign Exchange Management (Import) Rules 2000<div id="17acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="17b" NAME="femock14q17" ID="femock14q17b" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Foreign Exchange Management (Trade Transactions) Rules 2000<div id="17bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17c" NAME="femock14q17" ID="femock14q17c" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Foreign Exchange Management (Current Account Transactions) Rules 2000<div id="17ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="17d" NAME="femock14q17" ID="femock14q17d" onclick="changeStatus('17')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Foreign Exchange Management (Import and Export) Rules 2000<div id="17dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q18">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 18. Private airline companies require a specific waiver of bank guarantee from the Ministry of Finance, Government of India to remit amount exceeding US dollar one hundred thousand towards import of aircraft, aircraft engine and helicopter on lease basis</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q18">
					<INPUT TYPE="RADIO" VALUE="18a" NAME="femock14q18" ID="femock14q18a" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> True<div id="18acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="18b" NAME="femock14q18" ID="femock14q18b" onclick="changeStatus('18')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> False<div id="18bcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q19">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 19. Deferred Payment arrangement includes</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q19">
					<INPUT TYPE="RADIO" VALUE="19a" NAME="femock14q19" ID="femock14q19a" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> Suppliers' Credit<div id="19acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="19b" NAME="femock14q19" ID="femock14q19b" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> Buyers' Credit<div id="19bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19c" NAME="femock14q19" ID="femock14q19c" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Both (A) and (B)<div id="19ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="19d" NAME="femock14q19" ID="femock14q19d" onclick="changeStatus('19')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Letter of Credit<div id="19dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q20">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 20. As a sector specific measure, airline companies which have been permitted by the Directorate General of Civil Aviation to operate as a schedule air transport service, can make advance remittance without bank guarantee, up to</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q20">
					<INPUT TYPE="RADIO" VALUE="20a" NAME="femock14q20" ID="femock14q20a" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 5 million<div id="20acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="20b" NAME="femock14q20" ID="femock14q20b" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 50 million<div id="20bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20c" NAME="femock14q20" ID="femock14q20c" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 20 million<div id="20ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="20d" NAME="femock14q20" ID="femock14q20d" onclick="changeStatus('20')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 100 million<div id="20dcheck" style="display: inline-block;"></div>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q21">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 21. If the amount of advance remittance exceeds USD 200,000 or its equivalent</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q21">
					<INPUT TYPE="RADIO" VALUE="21a" NAME="femock14q21" ID="femock14q21a" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> An unconditional, irrevocable standby Letter of Credit is required<div id="21acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="21b" NAME="femock14q21" ID="femock14q21b" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> A bank guarantee is required from an international bank of repute situated outside India<div id="21bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21c" NAME="femock14q21" ID="femock14q21c" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> A guarantee of an AD Category-I bank in India, if such a guarantee is issued against the counter-guarantee of an international bank of repute situated outside India<div id="21ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="21d" NAME="femock14q21" ID="femock14q21d" onclick="changeStatus('21')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> Any one of (A), (B) or (C) required<div id="21dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q22">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 22. AD Category-I bank may allow advance remittance to Public Sector Company or a Department/ Undertaking of the Government of India/ State Governments for import of services without any bank guarantee up to</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q22">
					<INPUT TYPE="RADIO" VALUE="22a" NAME="femock14q22" ID="femock14q22a" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> USD 100,000<div id="22acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="22b" NAME="femock14q22" ID="femock14q22b" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> USD 500,000<div id="22bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22c" NAME="femock14q22" ID="femock14q22c" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> USD 1000,000<div id="22ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="22d" NAME="femock14q22" ID="femock14q22d" onclick="changeStatus('22')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> USD 2,00,000<div id="22dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q23">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 23. Nominated Banks/Nominated Agencies are notified by</b>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q23">
					<INPUT TYPE="RADIO" VALUE="23a" NAME="femock14q23" ID="femock14q23a" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> DGFT<div id="23acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="23b" NAME="femock14q23" ID="femock14q23b" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> RBI<div id="23bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23c" NAME="femock14q23" ID="femock14q23c" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> Authorised Dealers<div id="23ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="23d" NAME="femock14q23" ID="femock14q23d" onclick="changeStatus('23')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> RBI and Authorised Dealers<div id="23dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q24">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 24. Buyers' and Suppliers' Credit including the usance period of Letter of Credit for import of precious metals should not exceed</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q24">
					<INPUT TYPE="RADIO" VALUE="24a" NAME="femock14q24" ID="femock14q24a" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> 180 days from date of shipment<div id="24acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="24b" NAME="femock14q24" ID="femock14q24b" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> 90 days form date of shipment<div id="24bcheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24c" NAME="femock14q24" ID="femock14q24c" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> 90 days form date of acceptance<div id="24ccheck" style="display: inline-block;"></div><BR/>
					<INPUT TYPE="RADIO" VALUE="24d" NAME="femock14q24" ID="femock14q24d" onclick="changeStatus('24')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> 180 days from date of acceptance<div id="24dcheck" style="display: inline-block;"></div><BR/>
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
		
		<section class="col-lg-9" style="display:none" id="fe14-q25">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box-header">             
              <h3 class="box-title" style="margin-left: 25px; line-height:30px; font-size: 20px;">
                <b>Q 25. BEF statement submitted to RBI</b><BR/>
              </h3><hr/>
            </div>
            <div class="tab-content no-padding">
              <div class="box-header" style="text-align: center;">	
                  <div align=left style="margin-left: 25px; font-size: 20px;">
					<form id="femock14q25">
					<INPUT TYPE="RADIO" VALUE="25a" NAME="femock14q25" ID="femock14q25a" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(A)</b> gives details of non-submission of evidence of import of goods into India<div id="25acheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25b" NAME="femock14q25" ID="femock14q25b" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(B)</b> gives details of non-submission of evidence of export of goods from India<div id="25bcheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25c" NAME="femock14q25" ID="femock14q25c" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(C)</b> gives details of non-submission of evidence of import of software through internet<div id="25ccheck" style="display: inline-block;"></div><BR/> 
					<INPUT TYPE="RADIO" VALUE="25d" NAME="femock14q25" ID="femock14q25d" onclick="changeStatus('25')" style="margin-right: 10px; margin-bottom: 10px;"> <b>(D)</b> gives details of non-submission of evidence of import of design and drawings through data com channel<div id="25dcheck" style="display: inline-block;"></div><BR/><BR/>
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
		
		<section class="col-lg-3" style="display: none" id="fe14-status">
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