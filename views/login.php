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
		<link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<style>
	.container{
		/*border: 3px solid black;*/
		margin-top: 5%;
	}
	</style>
	<body>
		<div class="imgcontainer" align="center">
			<img src="images/avatar.png" alt="Avatar" class="avatar">
			<div class="container">
				<center><h3>Login details</h3></center>
				<div align="center">
					<form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
						<div>
							<label><strong>Userid </strong></label><br>
							<input type="text" name="userid" placeholder="Enter Userid"><br>
							<label><strong>Password </strong></label><br>
							<input type="password" name="password" placeholder="Enter Password"><br>
							<input type="submit" name="submit" value="submit"></input>
						</div>
					</form>
					<p>
					<?php
					    //session_start();
							//$reason = array('password'=>'Invalid username or password',
							//						'blank'=>'You have left one or more fields');
							if ($_SESSION['invalidCredentials'] == 'true') {
								echo 'Wrong';
								//unset($_POST);
								//$_SESSION['active'] = 'false';
								//echo $reason[$_SESSION['reason']];
								//session_destroy();
							//} else {
								//echo "Unknown Error";
							}
					?>
				</p>
				</div>
			</div>
		</div>
	</body>
	</html>
