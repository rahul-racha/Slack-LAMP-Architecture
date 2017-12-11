<?php
	session_start();
	$_SESSION['basePath'] = '../';
	//session_write_close();
  require_once $_SESSION['basePath'].'controllers/login.php';
	//print_r($_SESSION['userDetails']);
?>

<!DOCTYPE html>
<html>
  <head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css" />
		<link rel="icon" href="./images/favicon.jpg" type="image/gif" sizes="16x16">
		<script src="js/login.js"></script>
		<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
		<!-- gmail login api -->
		<!-- <meta name="google-signin-scope" content="profile email">
		<meta name="google-signin-client_id" content="117682046238-p3sgmtmn79b5pjr890frj7ijgov021fv.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js" async defer></script> -->
	</head>
	<body>
		<div class="login-page container-fluid">
			<div class="row">
				<center><h3>Slack Login</h3></center>
				<div class="col-xs-3"></div>
				<div class="form col-xs-7 row">
					<div class="col-xs-6">
						<form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
							<input type="text" name="userid" placeholder="userid" autocomplete="off" /><br>
							<input type="password" name="password" placeholder="password" autocomplete="off" /><br>
							<!-- <form action="?" method="POST"> -->
								<!-- <div class="g-recaptcha" data-sitekey="6Le0vAgUAAAAAH_ZWM8tw3It6jkrqLHkFFTMOW-J" data-callback="reCaptchad"></div> -->
								<!-- <br/> -->
								<!-- <input id="myButton" type="submit" value="Submit" disabled='true'> -->
							<!-- </form> -->
							<input type="submit" name="submit" value="Sign in"></input>
						</form>
						<h5> New to Slack? </h5><button class="btn btn-primary" data-toggle="modal" data-target="#SignupModal">Sign up now</button>
					</div>
					<div class="col-xs-6 client_login_with_wrapper">
						<h4>Login with</h4>
						<!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div> -->
						<a class="btn btn-block btn-social btn-github" href="github_auth_client.php?action=git_auth">
    					<span class="fa fa-github"></span> Sign in with GitHub
  					</a>
					</div>

				</div>
				<div class="col-xs-2"></div>
			</div>
				<p id="formMsg">
					<?php
							$reason = array('password'=>'Invalid username or password',
													'blank'=>'You have left one or more fields',
													'github-log'=>'Failed to login with GitHub',
													'mail'=> 'Failed to send mail. Contact Admin <rrach001@odu.edu>',
													'token' => 'token verification failed');
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

	    <script>

	    </script>


	</body>
	</html>
