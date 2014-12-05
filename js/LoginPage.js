$(document).ready(function(){
	//$.noConflict();
	console.log('Inside LOginPage.js');
	//console.log($.cookie("MoneyWise_UserName"));
	//$.removeCookie("MoneyWise_UserName"); 

    //Populate Value from Cookie if not UNDEFINED.
	/*if($.cookie("MoneyWise_UserName")!=undefined){
		$('#email_address').val($.cookie("MoneyWise_UserName"));
	}

	//Set the Cookie if REMEMBER ME is clicked
	$("#check-box").on("click", function(){

			if($('#check-box').is(":checked")){
				if($('#email_address').val()!='Email Address' &&  $('#email_address').val()){
							if($.cookie('MoneyWise_UserName') === null || $.cookie('MoneyWise_UserName') === "" 
								|| $.cookie('MoneyWise_UserName') === "null" || $.cookie('MoneyWise_UserName') === undefined){
							      //no cookie
							      console.log('cookie is not set');
							      var date = setDate();
							      var username = $('#email_address').val();
							      $.cookie("MoneyWise_UserName", username,{ expires: date });

							}else{
							     //have cookie
							      console.log('yes the cookie is set ');
							      console.log($.cookie("MoneyWise_UserName"));
							      
							}	
				}				
			}
	});

	//Function to set Date for the Cookie Expires
	function setDate(){
							var date = new Date();
 							var minutes = 30;
 							date.setTime(date.getTime() + (minutes * 60 * 1000));
 							return date;
	}*/

});