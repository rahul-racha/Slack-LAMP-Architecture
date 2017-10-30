function checkName() {
	var x = document.registraionForm;
	var input = [x.firstName.value, x.lastName.value, x.userId.value, x.password.value, x.confirmpassword.value];
	var responseArray = ['first name', 'last name', 'userid', 'password' ];
	var errMsgHolder = new Array(input.length);
	var isSuccess = "false";
	for(var id = 0; id <= input.length; id++){
		errMsgHolder[id] = document.getElementById("nameErrMsg" + id);
	}
	for (var i=0; i<=input.length; i++) {
		isSuccess = validatespaces(input[i]);
	  	if (isSuccess == "true") 
		{
			continue;
		} else {
			errMsgHolder[i].innerHTML = responseArray[i] + "cannot contain whitespace";
			break;
		}	
	}
	if (input[3] !== input[4]) {
		errMsgHolder[4].innerHTML = "Password mismatch";
		isSuccess = "false";
	} else{
		isSuccess = "true";
	}

		document.getElementById("registraionForm").action = "login.php";
		document.getElementById("registraionForm").submit();		
	}
}

function validatespaces(value) {
	var response;
	if (!((/^\S{3,}$/).test(value))) {	    
	    response = "false";
	  } else {
	    response = "true";
	  }
	 return response;
}
// function ValidateMinChar(){
// 	var x = document.registraionForm;
// 	var firstName = x.firstName.value;
// 	var lastName = x.lastName.value;
// 	var userId = x.userId.value;
// 	var password = x.password.value;
// 	var errMsgHolder = document.getElementById('nameErrMsg');
// 	if (firstName.length < 3 || lastName.length < 3 || userId.length < 3 || password.length < 3) {
//     errMsgHolder.innerHTML =
//       'A minimum of 3 characters is required';
//     return false;
//   }
//     else{return true;}

// }
