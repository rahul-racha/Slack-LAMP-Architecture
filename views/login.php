<?php
	session_start();
	$_SESSION['basePath'] = '../';
	//session_write_close();
  	require_once $_SESSION['basePath'].'controllers/login.php';
?>

<!DOCTYPE html>
<html>
  <head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="./images/favicon.jpg" type="image/gif" sizes="16x16">
		<script src="js/login.js"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
		<div class="login-page container-fluid">
			<div class="row">
				<center><h3>Slack Login</h3></center>
				<div align="center" class="form">
					<form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
						<div>
							<input type="text" name="userid" placeholder="userid" autocomplete="off" /><br>
							<input type="password" name="password" placeholder="password" autocomplete="off" /><br>
							<input type="submit" name="submit" value="Sign in"></input>
						</div>
					</form>
					<div>
						<h5> New to Slack? <button class="btn btn-primary" data-toggle="modal" data-target="#SignupModal">Sign up now >></button></h5>
					</div>
					<p id="formMsg">
					<?php
							$reason = array('password'=>'Invalid username or password',
													'blank'=>'You have left one or more fields');
							if (isset($_SESSION['invalidCredentials']) && $_SESSION['invalidCredentials'] == 'true') {
								unset($_POST);
								echo $reason[$_SESSION['reason']];
								session_destroy();
							} else if (isset($_SESSION['registerResponse'])) {
								echo $_SESSION['registerResponse'];
								unset($_POST);
								if (isset($_SESSION)) {
								session_destroy();
							}
							}
					?>
				</p>
					<div>
						<form action="?" method="POST">
							<div class="g-recaptcha" data-sitekey="6Le0vAgUAAAAAH_ZWM8tw3It6jkrqLHkFFTMOW-J" data-callback="reCaptchad"></div>
							<br/>
							<input id="myButton" type="submit" value="Submit" disabled='true'>
						</form>
					</div>
				</div>
			</div>
		</div>
			<!-- Large modal -->
			<div class="modal fade" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
			    aria-hidden="true">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			                x</button>
			                <h4 class="modal-title" id="myModalLabel">
			                    Registration</h4>
			            </div>
			            <div class="modal-body row">
			                <!-- <div class="row"> -->
			                    <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
			                        <div class="tab-content">
			                            <div class="tab-pane active" id="Registration">
			                                <form role="form" class="form-horizontal" name= "registraionForm"  id="registraionForm" method="post" onsubmit = "event.preventDefault(); doClientValidation();" action="<?php echo htmlspecialchars('./router.php?register=new'); ?>">
				                                <div class="form-group row">
			                                    <label for="firstName" class="col-sm-3 control-label">
			                                       First Name</label>
			                                    <div class="col-sm-8">
			                                    	<input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" autocomplete="off" required />
			                                    	<span id="nameErrMsg0" class="error"></span>
			                                    </div>
				                                </div>
				                                <div class="form-group row">
			                                    <label for="lastName" class="col-sm-3 control-label">
			                                        Last Name</label>
			                                    <div class="col-sm-8">
			                                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" autocomplete="off" required/>
			                                    <span id="nameErrMsg1" class="error"></span>
			                                    </div>
				                                </div>
			                                	<div class="form-group row">
			                                  	<label for="email" class="col-sm-3 control-label">
			                                        Email</label>
			                                    <div class="col-sm-8">
			                                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" required />
			                                      <span id="nameErrMsg5" class="error"></span>
			                                   	</div>
			                                  </div>
			                                  <div class="form-group row">
			                                    <label for="userId" class="col-sm-3 control-label">
			                                      Choose your username</label>
			                                    <div class="col-sm-8">
			                                      <input type="text" class="form-control" name="userId" id="userId" placeholder="eg: d3rp" autocomplete="off" required />
			                                    <span id="nameErrMsg2" class="error"></span>
			                                    </div>
			                                 	</div>
			                                 	<div class="form-group row">
			                                    <label for="password" class="col-sm-3 control-label">
			                                      Create a Password</label>
			                                    <div class="col-sm-7">
			                                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required/>
			                                    <span id="nameErrMsg3" class="error">Atleast 1 uppercase, lowercase, digit and a special character</span>
			                                    </div>
																					<div class="col-xs-1">
																						<a class="instructions"><i class="fa fa-info" aria-hidden="true"></i></a>
																					</div>
			                                 	</div>
			                                 	<div class="form-group">
			                                    <label for="confirmpassword" class="col-sm-3 control-label">
			                                     Confirm your Password</label>
			                                    <div class="col-sm-8">
			                                      <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Password" autocomplete="off" required/>
			                                    <span id="nameErrMsg4" class="error"></span>
			                                    </div>
			                                 </div>
			                                 <div class="row">
			                                    <div class="col-sm-3">
			                                    </div>
			                                    <div class="col-sm-4">
			                                    	<input type="hidden" name="registration" value="<?php echo 'yes'; ?>"/>
			                                      <input type="submit" name = "Sign Up" value="Sign Up" class="btn btn-primary btn-sm">
			                                    </div>
			                                </div>
			                                </form>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="col-md-4">
			                    	<!-- profile pic upload -->
			                    </div>
			                <!-- </div> -->
			            </div>
			        </div>
			    </div>
			</div>
			<div class="modal fade" id="SignupResponseModal" role="dialog">
		    <div class="modal-dialog modal-sm">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <!-- <h4 class="modal-title">Modal Header</h4> -->
		        </div>
		        <div class="modal-body ResponseDisplay">
		          <!-- <h4 class= "ResponseDisplay"></h4> -->
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		    </div>
		  </div>
	</body>
	</html>
