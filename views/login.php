<?php
	//include 'errors.php';
	//session_start();
	//$_SESSION = array();
	//$_SESSION['active'] = 'true';
	//$_SESSION['invalidCredentials'] == 'false';
	//session_write_close();
?>
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>

	<body>
		<!--<div class="imgcontainer" align="center">
			<img src="images/avatar.png" alt="Avatar" class="avatar">-->
			<div class="login-page">
				<center><h3>Slack Login</h3></center>
				<div align="center">
					<form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
						<div class="form">
							<input type="text" name="userid" placeholder="userid"><br>					
							<input type="password" name="password" placeholder="password"><br>
							<input type="submit" name="submit" value="submit"></input>
						</div>
					</form>
					<p>
					<?php
					    session_start();
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
