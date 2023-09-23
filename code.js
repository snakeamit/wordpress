
      var prevVal = 0, prevValEUR=0, prevValGBP=0, prevValAUD=0, prevValCAD=0, prevValNZD=0, prevValTHB=0;
      var newVal = 0, newValEUR=0, newValGBP=0, newValAUD=0, newValCAD=0, newValNZD=0, newValTHB=0;
      var rcvData = function() {
        
        var count = 10, timer = setInterval(function() {
        document.getElementById("counter").innerHTML = count--+" seconds";
        if(count == 0) clearInterval(timer);
        }, 1000);
	
	$.post('get-live-rates', {
	  data: "1"
	}, function(response) {
          var res = response.split("-");     
          usdToINRrate = 0;
          
          if(res[1]=="0")
            document.getElementById("inrToUSD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[2]).toFixed(5);
              var ask=parseFloat(res[3]).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
              usdToINRrate=liverate;
            
            document.getElementById("inrToUSDbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToUSDask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToUSD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevVal == 0){
                newVal = parseFloat(liverate).toFixed(5);
                prevVal = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevVal){
                  newVal=parseFloat(liverate).toFixed(5);
                  prevVal=parseFloat(liverate).toFixed(5);
                }
                else{
                  newVal=parseFloat(liverate).toFixed(5);
                  prevVal=newVal;
                  document.getElementById("inrToUSD").style.backgroundColor = "#F2D7D5";  
                }
            }   
            
            document.getElementById("inrToUSDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[4]).toFixed(5) + "</font>";
            document.getElementById("inrToUSDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[5]).toFixed(5) + "</font>";
            //document.getElementById("inrToUSDdate").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+res[8]+'-'+res[9]+'-'+res[10]+"</font>";
          }
          
          
          
          if(res[11]=="0")
            document.getElementById("inrToEUR").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[12]).toFixed(5);
              var ask=parseFloat(res[13]).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
            
            document.getElementById("inrToEURbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToEURask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToEUR").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevValEUR == 0){
                newValEUR = parseFloat(liverate).toFixed(5);
                prevValEUR = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevValEUR){
                  newValEUR=parseFloat(liverate).toFixed(5);
                  prevValEUR=parseFloat(liverate).toFixed(5);
                }
                else{
                  newValEUR=parseFloat(liverate).toFixed(5);
                  prevValEUR=newValEUR;
                  document.getElementById("inrToEUR").style.backgroundColor = "#EBDEF0";  
                }
            }   
            
            document.getElementById("inrToEURhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[14]).toFixed(5) + "</font>";
            document.getElementById("inrToEURlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[15]).toFixed(5) + "</font>";
            
          }
          
          if(res[21]=="0")
            document.getElementById("inrToGBP").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[22]).toFixed(5);
              var ask=parseFloat(res[23]).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
            
            document.getElementById("inrToGBPbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToGBPask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToGBP").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevValGBP == 0){
                newValGBP = parseFloat(liverate).toFixed(5);
                prevValGBP = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevValGBP){
                  newValGBP=parseFloat(liverate).toFixed(5);
                  prevValGBP=parseFloat(liverate).toFixed(5);
                }
                else{
                  newValGBP=parseFloat(liverate).toFixed(5);
                  prevValGBP=newValGBP;
                  document.getElementById("inrToGBP").style.backgroundColor = "#D4E6F1";  
                }
            } 
            
            document.getElementById("inrToGBPhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ parseFloat(res[24]).toFixed(5) + "</font>";
            document.getElementById("inrToGBPlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+ parseFloat(res[25]).toFixed(5) + "</font>";
          }
          
          if(res[31]=="0")
            document.getElementById("inrToAUD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[32]).toFixed(5);
              var ask=parseFloat(res[33]).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
            
            document.getElementById("inrToAUDbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToAUDask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToAUD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevValAUD == 0){
                newValAUD = parseFloat(liverate).toFixed(5);
                prevValAUD = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevValAUD){
                  newValAUD=parseFloat(liverate).toFixed(5);
                  prevValAUD=parseFloat(liverate).toFixed(5);
                }
                else{
                  newValAUD=parseFloat(liverate).toFixed(5);
                  prevValAUD=newValAUD;
                  document.getElementById("inrToAUD").style.backgroundColor = "#D1F2EB";  
                }
            } 

            document.getElementById("inrToAUDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[34]).toFixed(5) + "</font>";
            document.getElementById("inrToAUDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[35]).toFixed(5) + "</font>";
          }
          
          if(res[41]=="0")
            document.getElementById("inrToCAD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(parseFloat(res[42]).toFixed(5)).toFixed(5);
              var ask=parseFloat(parseFloat(res[43]).toFixed(5)).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
            
            document.getElementById("inrToCADbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToCADask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToCAD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevValCAD == 0){
                newValCAD = parseFloat(liverate).toFixed(5);
                prevValCAD = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevValCAD){
                  newValCAD=parseFloat(liverate).toFixed(5);
                  prevValCAD=parseFloat(liverate).toFixed(5);
                }
                else{
                  newValCAD=parseFloat(liverate).toFixed(5);
                  prevValCAD=newValCAD;
                  document.getElementById("inrToCAD").style.backgroundColor = "#D4EFDF";  
                }
            } 
              
            document.getElementById("inrToCADhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat((res[44])).toFixed(5) + "</font>";
            document.getElementById("inrToCADlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat((res[45])).toFixed(5) + "</font>";
          }
          
          if(res[51]=="0")
            document.getElementById("inrToNZD").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(res[52]).toFixed(5);
              var ask=parseFloat(res[53]).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
            
            document.getElementById("inrToNZDbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToNZDask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToNZD").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevValNZD == 0){
                newValNZD = parseFloat(liverate).toFixed(5);
                prevValNZD = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevValNZD){
                  newValNZD=parseFloat(liverate).toFixed(5);
                  prevValNZD=parseFloat(liverate).toFixed(5);
                }
                else{
                  newValNZD=parseFloat(liverate).toFixed(5);
                  prevValNZD=newValNZD;
                  document.getElementById("inrToNZD").style.backgroundColor = "#FCF3CF";  
                }
            } 

            document.getElementById("inrToNZDhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[54]).toFixed(5) + "</font>";
            document.getElementById("inrToNZDlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[55]).toFixed(5) + "</font>";
          }
          
          if(res[61]=="0")
            document.getElementById("inrToTHB").innerHTML = "<font style=\"font-size: 16px; color: #2E86C1;\">Available Soon</font>";
          else{
              var bid=parseFloat(parseFloat(res[62]).toFixed(5)).toFixed(5);
              var ask=parseFloat(parseFloat(res[63]).toFixed(5)).toFixed(5);
              var liverate=0;

              liverate=(parseFloat(bid)+parseFloat(ask))/parseFloat(2.0);
            
            document.getElementById("inrToTHBbid").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(bid).toFixed(5)+"</font>";
            
            document.getElementById("inrToTHBask").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(ask).toFixed(5)+"</font>";
            
            document.getElementById("inrToTHB").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(liverate).toFixed(5)+"</font>";
            
            if(prevValTHB == 0){
                newValTHB = parseFloat(liverate).toFixed(5);
                prevValTHB = parseFloat(liverate).toFixed(5);
            }else{
                if(parseFloat(liverate).toFixed(5) == prevValTHB){
                  newValTHB=parseFloat(liverate).toFixed(5);
                  prevValTHB=parseFloat(liverate).toFixed(5);
                }
                else{
                  newValTHB=parseFloat(liverate).toFixed(5);
                  prevValTHB=newValTHB;
                  document.getElementById("inrToTHB").style.backgroundColor = "#FAE5D3";  
                }
            } 
            
            //document.getElementById("inrToTHBopen").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[66]).toFixed(5) + "</font>";
            
            document.getElementById("inrToTHBhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[64]).toFixed(5) + "</font>";
            document.getElementById("inrToTHBlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+parseFloat(res[65]).toFixed(5) + "</font>";
            
            //document.getElementById("inrToTHBhigh").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+"-"+ "</font>";
            //document.getElementById("inrToTHBlow").innerHTML = "<font style=\"font-size: 20px; color: #2E86C1;\">"+"-" + "</font>";
          }
           
          //var tid = setInterval(function(){
            //document.getElementById("inrToUSD").style.backgroundColor = "#F2D7D5";
            //document.getElementById("inrToEUR").style.backgroundColor = "#EBDEF0";
            //document.getElementById("inrToGBP").style.backgroundColor = "#D4E6F1";
            //document.getElementById("inrToAUD").style.backgroundColor = "#D1F2EB";
            //document.getElementById("inrToCAD").style.backgroundColor = "#D4EFDF";
            //document.getElementById("inrToNZD").style.backgroundColor = "#FCF3CF";
            //document.getElementById("inrToTHB").style.backgroundColor = "#FAE5D3";
          //},1000);

          setTimeout(function(){
            document.getElementById("inrToUSD").style.backgroundColor = "#f9f9f9";
            document.getElementById("inrToEUR").style.backgroundColor = "white";
            document.getElementById("inrToGBP").style.backgroundColor = "#f9f9f9";
            document.getElementById("inrToAUD").style.backgroundColor = "white";
            document.getElementById("inrToCAD").style.backgroundColor = "#f9f9f9";
            document.getElementById("inrToNZD").style.backgroundColor = "white";
            document.getElementById("inrToTHB").style.backgroundColor = "#f9f9f9";

            clearInterval(tid); 
          },10000);
	});
	   $("#coverScreen").hide();
      }   

      setInterval(function(){	
        rcvData();
      }, 1000);


        var f1=0;
        function CalculateGST(sourceForma, sourceFormb, targetForm) {
            // A simple wrapper function to validate input before making the conversion
            var amtVal = sourceForma.unit_input.value;
            var rateVal = sourceFormb.unit_input.value;
            var gstPayable = 0;
            var amtCal = 0;
        
            if(isNaN(amtVal)){
                amtVal = amtVal.replace(/[^0-9\.]/g,'');
                if(amtVal.split('.').length>2) 
                    amtVal =amtVal.replace(/\.+$/,"");
            }else{
                //amtVal = parseFloat(amtVal);    
            }
        
            if(isNaN(rateVal)){
                rateVal = rateVal.replace(/[^0-9\.]/g,'');
                if(rateVal.split('.').length>2) 
                    rateVal =rateVal.replace(/\.+$/,"");
            }else{
                //rateVal = parseFloat(rateVal);    
            }
            
            amtCal = parseFloat(amtVal) * parseFloat(rateVal);
            if(amtVal<=0 || rateVal <=0){
                gstPayable=0;
            }else{
                if(amtCal <= 100000){
                    if(amtCal <= 250)
                        gstPayable = 45
                    else{
                        gstPayable = (1/100*amtCal)*0.18;
                        if (gstPayable <=45)
                            gstPayable = 45;
                    }
                }else{
                    if(amtCal > 100000 && amtCal <= 1000000){
                        gstPayable = (1000 + (5/1000)*(amtCal-100000))*0.18;
                    }else{
                        if(amtCal < 55500000){
                            gstPayable = (5500 + (1/1000)*(amtCal-1000000))*0.18;
                        }else{
                            gstPayable = 10800;
                        }
                    }
                }
            }
            
            sourceForma.unit_input.value = amtVal;
            sourceFormb.unit_input.value = rateVal;
            targetForm.unit_input.value = gstPayable.toFixed(2);
      }
      
      function CalculateUnit(sourceForm, targetForm) {
        // A simple wrapper function to validate input before making the conversion
        var sourceValue = sourceForm.unit_input.value;
        
        // First check if the user has given numbers or anything that can be made to one...
        if(isNaN(sourceValue)){
         sourceValue = sourceValue.replace(/[^0-9\.]/g,'');
         if(sourceValue.split('.').length>2) 
             sourceValue =sourceValue.replace(/\.+$/,"");
        }else{
            //sourceValue = parseFloat(sourceValue);    
        }
        
        var currVal=0;
 
        switch(targetForm.unit_menu.value){
          case 'INR':
            currVal = sourceValue;
          break;

          case 'USD':
            currVal = (1/parseFloat(document.getElementById("inrToUSD").getElementsByTagName('font')[0].innerHTML)); 
          break;

          case 'EUR':
            currVal = (1/parseFloat(document.getElementById("inrToEUR").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'GBP':
            currVal = (1/parseFloat(document.getElementById("inrToGBP").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'AUD':
            currVal = (1/parseFloat(document.getElementById("inrToAUD").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'CAD':
            currVal = (1/parseFloat(document.getElementById("inrToCAD").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'NZD':
            currVal = (1/parseFloat(document.getElementById("inrToNZD").getElementsByTagName('font')[0].innerHTML));
          break;

          case 'THB':
            currVal = (1/parseFloat(document.getElementById("inrToTHB").getElementsByTagName('font')[0].innerHTML));
          break;     
                  
        }

        if (!isNaN(sourceValue) || sourceValue == 0) {
          // If we can make a valid floating-point number, put it in the text box and convert!
          sourceForm.unit_input.value = sourceValue;

          if(targetForm.unit_menu.value=='INR')
            targetForm.unit_input.value = sourceValue; 
          else
            targetForm.unit_input.value = (sourceValue*currVal).toFixed(5);
        }else{          
          targetForm.unit_input.value = '';
        }
     }

     function CalculateUnit2(sourceForm, targetForm) {
        // A simple wrapper function to validate input before making the conversion
        var sourceValue = sourceForm.unit2_input.value;
        
        // First check if the user has given numbers or anything that can be made to one...
        //sourceValue = parseFloat(sourceValue);
        if(isNaN(sourceValue)){
         sourceValue = sourceValue.replace(/[^0-9\.]/g,'');
         if(sourceValue.split('.').length>2) 
             sourceValue =sourceValue.replace(/\.+$/,"");
        }else{
            //sourceValue = parseFloat(sourceValue);    
        }
        
        var currVal=0;
 
        switch(sourceForm.unit2_menu.value){
          case 'INR':
            currVal = sourceValue;
          break;

          case 'USD':
            currVal = parseFloat(document.getElementById("inrToUSD").getElementsByTagName('font')[0].innerHTML); 
          break;

          case 'EUR':
            currVal = parseFloat(document.getElementById("inrToEUR").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'GBP':
            currVal = parseFloat(document.getElementById("inrToGBP").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'AUD':
            currVal = parseFloat(document.getElementById("inrToAUD").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'CAD':
            currVal = parseFloat(document.getElementById("inrToCAD").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'NZD':
            currVal = parseFloat(document.getElementById("inrToNZD").getElementsByTagName('font')[0].innerHTML);
          break;

          case 'THB':
            currVal = parseFloat(document.getElementById("inrToTHB").getElementsByTagName('font')[0].innerHTML);
          break;     
                  
        }

        if (!isNaN(sourceValue) || sourceValue == 0) {
          // If we can make a valid floating-point number, put it in the text box and convert!
          sourceForm.unit2_input.value = sourceValue;

          if(sourceForm.unit2_menu.value=='INR')
            targetForm.unit2_input.value = sourceValue; 
          else
            targetForm.unit2_input.value = (sourceValue*currVal).toFixed(5); //.toFixed(6)
        }else{          
          targetForm.unit2_input.value = '';
        }
     }