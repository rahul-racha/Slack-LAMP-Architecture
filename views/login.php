<?php
		session_start();
		$_SESSION['basePath'] = '../';
		session_write_close();
	  require_once $_SESSION['basePath'].'controllers/login.php';

		$loginControlVar = new LoginController();

		if (isset($_POST["registration"]) && $_POST["registration"] == "yes") {
		    $firstName = $_POST["firstName"];
		    $lastName = $_POST["lastName"];
		    $email = $_POST["email"];
		    $userId = $_POST["userId"];
		    $password = $_POST["password"];
		    $workspaceUrl = "musicf17.slack.com";
		    $message = $loginControlVar->registerNewUser($userId, $email, $password, $firstName, $lastName, $workspaceUrl);
				unset($_POST["registration"]);
		}
?>

<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>
			//$('#myModal').on('hidden.bs.modal', function (e) {
			var msg = "<?php echo $message; ?>";
			<?php unset($message); ?>
			if (!msg.empty) {
				window.alert(msg);
			}
		  //}
		</script>

	</head>
	<body>
		<!-- Large modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
		                                <form role="form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			                                <div class="form-group">
			                                    <label for="firstName" class="col-sm-3 control-label">
			                                       First Name</label>
			                                    <div class="col-sm-8">
			                                    	<input type="text" class="form-control" name = "firstName" placeholder="First Name" autocomplete="off" />
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label for="lastName" class="col-sm-3 control-label">
			                                        Last Name</label>
			                                    <div class="col-sm-8">
			                                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" autocomplete="off"/>
			                                    </div>
			                                </div>
		                                	<div class="form-group">
		                                  	<label for="email" class="col-sm-3 control-label">
		                                        Email</label>
		                                    <div class="col-sm-8">
		                                        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off"/>
		                                   	</div>
		                                  </div>
		                                  <div class="form-group">
		                                    <label for="userId" class="col-sm-3 control-label">
		                                        User id</label>
		                                    <div class="col-sm-8">
		                                        <input type="text" class="form-control" name="userId" placeholder="User ID" autocomplete="off" />
		                                    </div>
		                                 </div>
		                                 <div class="form-group">
		                                    <label for="password" class="col-sm-3 control-label">
		                                        Password</label>
		                                    <div class="col-sm-8">
		                                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off"/>
		                                    </div>
		                                 </div>
		                                 <div class="row">
		                                    <div class="col-sm-3">
		                                    </div>
		                                    <div class="col-sm-6">
		                                    	<!--<form method="post" action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">-->
			                                    	<input type="hidden" name="registration" value="<?php echo 'yes'; ?>" autocomplete="off"/>
			                                      <input type="submit" name = "Sign Up" value="Sign Up" class="btn btn-primary btn-sm" autocomplete="off" >
			                                    <!--</form>-->
		                                    </div>
		                                </div>
		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                </div>
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
						<h5> New to Slack? &nbsp <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sign up now >></button></h5>
					</div>
					<p id="formMsg">
					<?php
					    //session_start();
							$reason = array('password'=>'Invalid username or password',
													'blank'=>'You have left one or more fields');
							if (isset($_SESSION['invalidCredentials']) && $_SESSION['invalidCredentials'] == 'true') {
								unset($_POST);
								//$_SESSION['active'] = 'false';
								echo $reason[$_SESSION['reason']];
								session_destroy();
							}
					?>
				</p>
				</div>
			</div>
		<!--</div>-->
	</body>
	</html>
