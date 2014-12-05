

/*Function to Valid Email Id*/
function validateEmailId(email){
	var emailId = email;
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(emailId)) {
		return true;
	}
	else {
		return false;
	}

}

/*Function to Valid Phone Number 
 -Format is : 
		XXX-XXX-XXXX
		XXX.XXX.XXXX
		XXX XXX XXXX
*/

function validatePhoneNumber(phone_no)
{
        var x = phone_no;
        if(isNaN(x)|| x.indexOf(" ")!=-1){
              return false; }
        if (x.length > 10 || x.length > 8 ){
              return false;
           }
        else{
        	return true;
        }
}