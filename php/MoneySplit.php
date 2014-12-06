<?php
		session_start();
		 include "common/databaseConnected.php";
		 include "../resourses/config.php";
?>
<!DOCTYPE html>
<html>
<head>

  		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.js"></script>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.min.js"></script>
		
		<link type ="text/css" rel="stylesheet" href="../lib/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../css/MoneyWise.css" media="screen" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"/>
  		
  		
  		<link rel="stylesheet" href="../lib/alertify/alertify.core.css" />
		<link rel="stylesheet" href="../lib/alertify/alertify.default.css" />
		
        <script type="text/javascript">
                var count = 0;
                var money = 0;
			    function myFunction() {
    									$("#Model-Body-hidden").show();
    									$("#lineAfterHeader").show();
				}
				function myFunction2() {
										$("#Model-Body-hidden2").show();
				}
				function submit(){ // verification can be called in this funciton. 
					return false;
				}
				function emailVerfication(emailAddress){
					var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    				return pattern.test(emailAddress);
				}
				$(document).ready(function() {
									console.log('Inside the document.ready');
									$('#mytextInputType').keypress(function (event) {
									         							            var keycode = (event.keyCode ? event.keyCode : event.which);
                                                                                    money = $('#billAmountTextInputType').val();                                                        
                                                                                                        
                                                                                                        
																					if(keycode == '13'){
																					                  var txtVal = $("#mytextInputType").val();
																					                  //console.log('text value is :'+txtVal);
																									  if (txtVal.indexOf(',') != -1) {
																									  	              var match = txtVal.split(',');
																													  for (var a in match){
																															  	if(!emailVerfication(match[a])){
																															  		$('#mytextInputType').css("border","2px solid red");
																															  		$.bootstrapGrowl("enter a valid email id ");
																															  	}else{
																															  		$('#mytextInputType').css("border", "#DCDCDC solid 1px");
																															  	}
																													   }
																													   
																										               count = 2;
    																												   var commas_count = (txtVal.match(/,/g) || []).length;
    																												   count = count+commas_count;
    																												   money = money /count;
    																												   document.getElementById("amount_distributed").innerHTML = "($"+parseInt(money)+".00/person)";

																									  }else{
																									  	    //console.log('I am here ');
																											if(emailVerfication(txtVal)){
																												$('#mytextInputType').css("border", "#DCDCDC solid 1px");
																												if (money){
																														count = 1;
    																													money = money /2;
    																										     		document.getElementById("amount_distributed").innerHTML = "($"+parseInt(money)+".00/person)";
																												}
																											}else{
																													$.bootstrapGrowl("Enter a valid email address");
																													$('#mytextInputType').css("border","2px solid red");
																											}
																										}
																					}
				            		});
            								
             						$("#bill-paidBy-you").click(function(){
             														$.bootstrapGrowl("The paragraph was clicked.");
  									});
            	});
				function call_backend(page,div) {
				        		         	var xmlhttp;
											if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
											  xmlhttp=new XMLHttpRequest();
											  }
											else{// code for IE6, IE5
											  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
											  }
											xmlhttp.onreadystatechange=function(){
											  if (xmlhttp.readyState==4 && xmlhttp.status==200){
											    document.getElementById(div).innerHTML=xmlhttp.responseText;
											    }
											  }
											xmlhttp.open("GET",page,true);
											xmlhttp.send();
				}
				$(function() {
    						var state = true;
    						//$( "#button" ).click(function() {
    							$(document).ready(function() {
      													if ( state ) {
															        $( "#effect" ).animate({
															          backgroundColor: "#aa0000",
															          color: "#fff",
															          width: 500
															        }, 1000 );
      													} else {
															        $( "#effect" ).animate({
															          backgroundColor: "#fff",
															          color: "#000",
															          width: 240
															        }, 1000 );
															      }
							      state = !state;

							  });
				});	
				
					   
		</script>
			
</head>
<body id="homePageBackground">
                  <?php
                                         $firstName="";
                                         $lastName="";
                                         $user="";

									     $id = $_SESSION['emailId'];

									     
									     $dbConn=connectToDb();	
									     $sql ="select FirstName ,LastName from signUp_Table where Email='".$id."'";

					    				 $youOweQueryResult = mysqli_query($dbConn,$sql) or trigger_error("Query Failed! SQL: $conn - Error: ".mysqli_error(), E_USER_ERROR);
										 $checkrows=mysqli_num_rows($youOweQueryResult);
										 if($checkrows!=0){
														while ($row = mysqli_fetch_array($youOweQueryResult)){
																			$firstName = $row['FirstName'];
																			$lastName=$row['LastName'];
														}
										 }
				
				  ?>
				
                                  
			       <!-- the Concept of Splits Wise starts here -->
			       <div id ="top_bar">
			       			<img id="money_icon" src="../image/Money-Split-icon.jpg"/ >
			       			<p id ="money_split_title">Money Split</p>
			       			<?php 
			      
							?>
							<?php
							require '../lib/facebook/src/facebook.php';
							//echo $_SESSION['FACEBOOK_USER_ID'];

							echo "<img src='".FACEBOOK_GRAPH_PATH.$_SESSION['FACEBOOK_USER_ID']."/picture' id='profile_picture' class='img-circle'/>";
							?>
							<div class="dropdown" id="dropdown_main_div">
								  <a id="dLabel" class="dropdown_title" data-target="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" >
										    <?php echo $firstName; ?>
										    <span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu bg-user" role="menu" aria-labelledby="dLabel" >
	                            	  <li class="current-user bg-user ">
	                            		  <a class="bg-user" href="../php/logout.php" role="menuitem" tite="Logout" onclick="FB.logout();">
	                            		     <p id="signout_theme">Sign Out</p>
	                            		  </a>
	                            	  </li>
								  </ul>
							</div>
			       </div>
			      
					       <div class="well" id="buttonsForSplitsWise">
					                   <button class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Add a Bill for settlement">
						       				<a data-toggle="modal" href="#myAddBillModel">
						       					Add a Bill
						       				</a>
						       			</button>
						       			<button class="btn" id="settleUpBTN" data-toggle="tooltip" data-placement="right" title="Settle Up">
						       				<a data-toggle="modal" href="#mySettleUPModel">
						       					Settle up
						       				</a>
						       			</button>
					       </div>
			       </div>
	   
       <div id="ExpenseeAdded">
       		<p id="expenseAddedFonting">EXPENSE ADDED</p>
       		<div id="expenseAddedImage">
       				<img border="0" src="../image/white-tick.png" alt="expenseAdded_icon" width="100%" height="100%" id="expenseAddedImge">
       		</div>      		
       </div>
       <!-- Dash Board  Div added here -->
       
       <div id="dashboard_main_div">
              <div class="toggler">
  	   		  <div id="effect" class="ui-widget-content ui-corner-all" style="width: 570px;color: rgb(255, 255, 255);background-color: rgb(170, 0, 0);height: 179px;">
               <p id="dashboardTitle">Dashboard</p>
		       <div id="youOwe">
		       		<p id="youOwedTitle">YOU OWE</p>
		       		<!--Make an Ajax Call for the money you are owed-->
		       		<p id="youOwedResult">
				       	<script type="text/javascript">
									call_backend('dashboardCalculations.php?action=youOwed','youOwedResult');
						</script>
					</p>		       		
		       </div>
		      <div class="vertical-line" style="height: 45px;">
		      </div>
		       <div id="youAreOwed">
		       		<p id="youAreOwedTitle">YOU ARE OWED</p>
		       		<!--Make an ajax call for the money you are owed -->
		       		<p id="youAreOwedResult">
		       			<script type="text/javascript">
									call_backend('dashboardCalculations.php?action=youAreOwed','youAreOwedResult');
						</script>
		       		</p>
		       </div>
       </div>
       </div>
       </div>

       <!-- Add Bill Model -->
      <div class="modal fade" id="myAddBillModel" tabinex="-1" role="dialog" aria-hidden="true">
      	<div class="modal-dailog">
      		<div class="modal-content">
      			<div class="model-header">
      				<div class="addBillHeaderTitle">
      					<h3 class="headerMainHeader">Add a Bill
      					<button type="button" class="close" data-dismiss="modal" > &times;</button></h3>
      			    </div>
      			    <div class="addBillHeaderBody">      			    
								With you and : <input type="text" name="usrname" placeholder="Enter names or email addresses" id="mytextInputType" autocomplete="off" onkeyup="myFunction()"><br>								
								<div id="searchDivFRomDatabase"></div>
      			    </div>
      			    <hr id="lineAfterHeader">
      			</div>
      			<div class="modal-body" id="Model-Body-hidden">
      					<div class="bill-icon">
      						<img src="../image/bill-icon.png" width="100%" height="100%"/>
      						<div class="bill-description">
      						 			<input type="text" name="usrname" placeholder="Enter a description" id="billDescriptiontextInputType">
      						 			<hr id="broken_bill_description_line">
      						</div>
      						<div class="bill-amount">
      									<input type="text" name="usrname" placeholder="$ 0.00" id="billAmountTextInputType">
      									<hr id="broken_bill_amount_line">
      						</div>
      						<div class="bill_paid_By">
      									<p>Paid by <span style="color:blue;" id="bill-paidBy-you">you</span> and <span style="color:blue;" id="bill-paidBy-splitsEqually">split equally</span></p>
      						</div>
      						<div class="bill_splits_amounts">
      						             <p id="amount_distributed">($0.00/person)</p>
      						</div>
      					</div>
      		    </div>
      		    <div class="modal-footer">
      		    		<button type="button" class="btn" data-dismiss="modal">Close</button>
      		    		<button type="button" class="btn btn-primary" id="addtheFinalBillButton" data-dismiss="modal">Add</button>
      		    </div>
      		</div>
      	</div>
      </div>
      <!--End of Bill Model-->

      <!--Settle Up Model -->
      <div class="modal fade" id="mySettleUPModel" tabinex="-1" role="dialog" aria-hidden="true">
      	<div class="modal-dailog">
      		<div class="modal-content">
      			<div class="model-header">
      					<div class="addBillHeaderTitle">
      						<h4 class="headerMainHeader">Settle Up The Bill
      						<button type="button" class="close" data-dismiss="modal" > &times;</button></h4>      						
      					</div>
      					<div class="addBillHeaderBody">      			    
	      			    	<p id="paymentTitle">Choose a payment method</p>
      			    	</div>
      			    	<hr id="lineAfterHeader">  					
      			</div>
      			<div class="modal-body" id="Model-Body-hidden2">
      					<!--Buttons option should come here -->
      					<div id="cashButtonDiv">
      							<button type="button" id="cashButton">Record a cash payment</button>
      					</div>
      					<div id="payByPayPallButtonDiv">
      							<button type="button" id="PayPalButton">Send Money via PayPal</button>
      					</div>
      		    </div>
      		    <div class="modal-footer">
      		    		<button type="button" class="btn" data-dismiss="modal">Cancel</button>
      		    		<button type="button" class="btn btn-primary">Add</button>
      		    </div>
      		</div>
      	</div>
      </div>


		<!-- jQuery -->
  		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

		<!-- Bootstrap -->
		<script src ="../lib/js/bootstrap.js"></script>			
		<script language="Javascript" type="text/javascript" src="../lib/alertPlugins/jquery.bootstrap-growl.min.js"></script>

		<!--alertify.js-->
		<script src="../lib/alertify/alertify.js"></script>

		<!--basic files-->
		<script src="../resourses/rootConfig.js"></script>
		<script language="Javascript" type="text/javascript" src="../js/MoneyWisePage.js"></script>
		

</body>
</html>