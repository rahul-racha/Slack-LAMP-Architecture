<?php
		 session_start();
?>

<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/login.js"></script>
		<!--<script>
			// $( document ).ready(function() {
    	// 	var msg = "<?php //echo $message; ?>";
    	// 	var isAlertDisplayed = "<?php //echo $_SESSION['isAlertDisplayed']; ?>";
			// 	<?php //unset($message);
			// 	 ?>
			//
			// 		if (!msg.empty) {
			// 			$('.ResponseDisplay').html('<h5>' + msg + '</h5>');
			// 		}
			// 		$('#SignupResponseModal').modal('show');
			//
			// 	});

		</script>-->

	</head>
	<body>
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
		            <div class="modal-body">
		                <div class="row">
		                    <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
		                        <div class="tab-content">
		                            <div class="tab-pane active" id="Registration">
		                                <form role="form" class="form-horizontal" name= "registraionForm"  id="registraionForm" onsubmit = "event.preventDefault(); doClientValidation();" method="post" action="<?php echo htmlspecialchars('./router.php?register=new'); ?>">
			                                <div class="form-group">
		                                    <label for="firstName" class="col-sm-3 control-label">
		                                       First Name</label>
		                                    <div class="col-sm-8">
		                                    	<input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" autocomplete="off" required />
		                                    	<span id="nameErrMsg0" class="error"></span>
		                                    </div>
			                                </div>
			                                <div class="form-group">
		                                    <label for="lastName" class="col-sm-3 control-label">
		                                        Last Name</label>
		                                    <div class="col-sm-8">
		                                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" autocomplete="off" required/>
		                                    <span id="nameErrMsg1" class="error"></span>
		                                    </div>
			                                </div>
		                                	<div class="form-group">
		                                  	<label for="email" class="col-sm-3 control-label">
		                                        Email</label>
		                                    <div class="col-sm-8">
		                                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" required />
		                                      <span id="nameErrMsg2" class="error"></span>
		                                   	</div>
		                                  </div>
		                                  <div class="form-group">
		                                    <label for="userId" class="col-sm-3 control-label">
		                                      Choose your username</label>
		                                    <div class="col-sm-8">
		                                      <input type="text" class="form-control" name="userId" id="userId" placeholder="eg: d3rp" autocomplete="off" required />
		                                    <span id="nameErrMsg3" class="error"></span>
		                                    </div>
		                                 	</div>
		                                 	<div class="form-group">
		                                    <label for="password" class="col-sm-3 control-label">
		                                      Create a Password</label>
		                                    <div class="col-sm-8">
		                                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required/>
		                                    <span id="nameErrMsg4" class="error"></span>
		                                    </div>
		                                 	</div>
		                                 	<div class="form-group">
		                                    <label for="confirmpassword" class="col-sm-3 control-label">
		                                     Confirm your Password</label>
		                                    <div class="col-sm-8">
		                                      <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Password" autocomplete="off" required/>
		                                    <span id="nameErrMsg5" class="error"></span>
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
		                </div>
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
		<!--<div class="imgcontainer" align="center">
			<img src="images/avatar.png" alt="Avatar" class="avatar">-->
			<div class="login-page">
				<center><h3>Slack Login</h3></center>
				<div align="center" class="form">
					<form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
						<div>
							<input type="text" name="userid" placeholder="userid"><br>
							<input type="password" name="password" placeholder="password"><br>
							<input type="submit" name="submit" value="Sign in"></input>
						</div>
					</form>
					<div>
						<h5> New to Slack? &nbsp <button class="btn btn-primary" data-toggle="modal" data-target="#SignupModal">Sign up now >></button></h5>
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
								session_destroy();
							}
					?>
				</p>
				</div>
			</div>
		<!--</div>-->
	</body>
	</html>
