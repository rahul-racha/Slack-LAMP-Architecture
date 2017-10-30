function doClientValidation() {
	var x = document.registraionForm;
	var input = [x.firstName.value, x.lastName.value, x.userId.value, x.password.value, x.confirmpassword.value];
	var responseArray = ['first name', 'last name', 'userid', 'password' ];
	var errMsgHolder = new Array(input.length);
	var isSuccess = "false";
	var isPwdMatch = "false";
	for(var id = 0; id <= input.length; id++){
		errMsgHolder[id] = document.getElementById("nameErrMsg" + id);
		errMsgHolder[id].innerHTML = "";
	}
	for (var i=0; i<=input.length; i++) {
		isSuccess = validateData(input[i]);
	  if (isSuccess == "true")
		{
			continue;
		} else {
			errMsgHolder[i].innerHTML = responseArray[i] + " cannot contain whitespace and length should be more than 3.";
			break;
		}
	}
	if (input[3] != input[4]) {
		errMsgHolder[4].innerHTML = "Password mismatch";
		isPwdMatch = "false";
	} else{
		isPwdMatch = "true";
	}
	//password reverivation
	if (isSuccess == "true" && isPwdMatch == "true") {
		//document.getElementById("registraionForm").action = "login.php"; // Setting form action to "success.php" page
		document.getElementById("registraionForm").submit(); // Submitting form
		// $('#SignupModal').modal('hide');

	}
}

function validateData(value) {
	var response;
	var reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,15}$/ ; // /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})$/;
	var whiteSpace = /^\S$/;
	if (value.match(reg) && !value.match(whiteSpace)) {//if (!((/^\S{3,}$/).test(value))) {
    response = "true";
  } else {
    response = "false";
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
