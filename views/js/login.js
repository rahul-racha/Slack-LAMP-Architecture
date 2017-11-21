function doClientValidation() {
	var x = document.registraionForm;
	var input = [x.firstName.value, x.lastName.value, x.userId.value, x.password.value, x.confirmpassword.value];
	var responseArray = ['first name', 'last name', 'userid', 'password'];
	var errMsgHolder = new Array(input.length);
	var isSuccess = "true";
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
			errMsgHolder[i].innerHTML = responseArray[i] + " cannot contain whitespace";
			break;
		}
	}

	if (isSuccess == "false") {
		return;
	}

	if (validateName(x.firstName.value) == "false") {
		errMsgHolder[0].innerHTML = responseArray[0] + " cannot contain any special characters or numbers";
		isSuccess = "false";
	}

	if (validateName(x.lastName.value) == "false") {
		errMsgHolder[1].innerHTML = responseArray[1] + " cannot contain any special characters or numbers";
		isSuccess = "false";
	}

	if (validateUserid(x.userId.value) == "false") {
		errMsgHolder[2].innerHTML = responseArray[2] + " can contain @ or numbers with alphabets";
		isSuccess = "false";
	}

	if (validateUserid(x.userId.value) == "false") {
		errMsgHolder[2].innerHTML = responseArray[2] + " can contain @ or numbers with alphabets";
		isSuccess = "false";
	}

	if (validatePassword(x.password.value) == "false") {
		errMsgHolder[3].innerHTML = responseArray[3] + " should contain atleast one lower case, upper case, digit and a special character";
		isSuccess = "false";
	}

	if (input[3] !== input[4]) {
		errMsgHolder[4].innerHTML = "Password mismatch";
		isSuccess = "false";
	}

	if (isSuccess == "true") {
		document.getElementById("registraionForm").submit(); // Submitting form
	}
}

function validateData(value) {
	var response;
	var whiteSpace = /\s/;
	if (whiteSpace.test(value)) { //if (!((/^\S{3,}$/).test(value))) {
    response = "false";
  } else {
    response = "true";
  }
	 return response;
}

function validateName(value) {
	var response;
	var reg = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

	if (value.match(reg)) {
		response = "true";
	} else {
		response = "false";
	}
	return response;
}

function validateUserid(value) {
	var reg = /^(?:[A-Z\d][A-Z\d_-]{3,10}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})$/i;
	//var reg = ^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;

	if (value.match(reg)) {
		response = "true";
	} else {
		response = "false";
	}
	return response;
}

function validatePassword(value) {
	var reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,15}$/ ;
	// /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})$/;
	if (value.match(reg)) {
		response = "true";
	} else {
		response = "false";
	}
	return response;
}

$(document).ready(function(){
	$(".instructions").on("click",function(e){
		$("#nameErrMsg3").show();
	});
});
