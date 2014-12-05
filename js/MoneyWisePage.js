
$(document).ready(function(){
  
   var count = 0;
   var money = 0;

  $("#mytextInputType").keypress(function(){

                  $("#searchDivFRomDatabase").show();
                  $("#searchDivFRomDatabase").val("");
                  var val = $('#mytextInputType').val();
                  var dataValue = 'keyword=' + val;
                  if(val){
                                
                                $.ajax({
                                            type: "GET",
                                            url: constants.base_path+"php/SplitsWiseSearchAjaxCall.php?dataString="+dataValue,
                                            data: dataValue,
                                            async: false,
                                            success: function(result){
                                              var photos = jQuery.parseJSON(result);
                                              $("#searchDivFRomDatabase").empty();
                                              $.each(photos, function(k,v){ 
                                                                          $('#searchDivFRomDatabase').append('<p>' + v + '</p>');                                                                                                     
                                              });
                                            }
                                });
                  }
                  
   });
	$("#addtheFinalBillButton").click(function(){
                //console.log('Inside the addtheFinalBillButton click');
                
  							var emailid= $('#mytextInputType').val();
                //console.log('email id is :'+emailid);
                

  							if(!emailid){
                      //$.bootstrapGrowl("Enter the email id ");
                      alertify.error('Enter Email of Payee');
  							}else{
                      //console.log('Inside the else condition');
                      if (emailid.indexOf(',') != -1) {// contains more than one email id 
                                                      var match = emailid.split(',');
                                                      money = $('#billAmountTextInputType').val();  
                                                      for (var a in match){
                                                                  if(!emailVerfication(match[a])){// check each email id valid or not 
                                                                                                  $('#mytextInputType').css("border","2px solid red");
                                                                                                  //$.bootstrapGrowl("enter a valid email id ");
                                                                                                  alertify.error('Enter a valid email id');
                                                                  }else{
                                                                                                  $('#mytextInputType').css("border", "#DCDCDC solid 1px");
                                                                                                  //console.log('email id is good');
                                                                  }
                                                       }
                                                       count = 2;
                                                       var commas_count = (emailid.match(/,/g) || []).length;
                                                       count = count+commas_count;
                                                       money = money /count;
                                                       document.getElementById("amount_distributed").innerHTML = "($"+parseInt(money)+".00/person)";
                      }else{ // contains one email id 
                            console.log('1: one email id ') ;        
                            if(!emailVerfication(emailid)){
                                                          //console.log('email id is :'+emailid);
                                                          alertify.error('Enter a valid email id');
                                                         // $('#mytextInputType').css("border","2px solid red");
                            }else{//valid one email id
                                          console.log('Inside the valid one email id ');
                                          $('#mytextInputType').css("border", "#DCDCDC solid 1px");
                                          money = $('#billAmountTextInputType').val();  
                                          console.log('money is :'+money);
                                          if (money){
                                                     count = 1;
                                                     money = money /2;
                                                     document.getElementById("amount_distributed").innerHTML = "($"+parseInt(money)+".00/person)";
                                          }
                            }
                      }

      								
  							}

  							var description = $('#billDescriptiontextInputType').val();
  							var amount = $('#billAmountTextInputType').val();
                if(!amount){
                  alertify.error('Enter Amount of Bill');
                }
                if(!description){
                  alertify.error('Enter Description  of Bill');
                }
                else{
                         
                          var dataString = 'email=' + emailid + '&description=' + description + '&amount=' + parseInt(money);
                          

                          $.ajax({
                                type: "GET",
                                url: constants.base_path+"php/SplitsWiseFlowToDatabase.php?dataString&"+dataString,
                                data: dataString,
                                dataType:"json",
                                async: false,
                                success: function(result){
                                                console.log('iNside sucess of ajax call  :'+result);  
                                                $("#ExpenseeAdded").show( "fast", function(){
                                                        //
                                                }); 
                                                $('#expenseAddedImge').fadeOut('fast').delay(1000).fadeIn('slow');                                                                                             
                                                $.each(result, function(k,v){
                                                  if(v){
                                                        console.log("key is :"+k);
                                                        console.log("value is :"+v);
                                                        alertify.error(v);
                                                        //$.bootstrapGrowl(v);
                                                        $('#mytextInputType').css("border","2px solid red");
                                                        $("#ExpenseeAdded").hide();
                                                  }else{
                                                        $('#mytextInputType').css("border", "#DCDCDC solid 1px");
                                                  }                                                          
                                                });
                                                
                                                
                                }
                          });
                          var sec = 2;
                          var timer = setInterval(function() { 
                             //$('#ExpenseeAdded').text(--sec);
                             --sec;
                             if (sec == 0) {
                                $('#ExpenseeAdded').fadeOut('fast');
                                clearInterval(timer);
                             } 
                          }, 1000);
                          //$("#ExpenseeAdded").hide("slow").delay(113000); 
                         
                }
  							
	});

	function emailVerfication(emailAddress){
					var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    			return pattern.test(emailAddress);
	}

	


});
