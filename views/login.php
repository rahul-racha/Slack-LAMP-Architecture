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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- Large modal -->
		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
		    aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		                    ×</button>
		                <h4 class="modal-title" id="myModalLabel">
		                    Registration</h4>
		            </div>
		            <div class="modal-body">
		                <div class="row">
		                    <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
		                        <!-- Nav tabs -->
		                        <!-- <ul class="nav nav-tabs">
		                            <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
		                            <li><a href="#Registration" data-toggle="tab">Registration</a></li>
		                        </ul> -->
		                        <!-- Tab panes -->
		                        <div class="tab-content">
		                            <!-- <div class="tab-pane active" id="Login">
		                                <form role="form" class="form-horizontal">
		                                <div class="form-group">
		                                    <label for="email" class="col-sm-2 control-label">
		                                        Email</label>
		                                    <div class="col-sm-10">
		                                        <input type="email" class="form-control" id="email1" placeholder="Email" />
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="exampleInputPassword1" class="col-sm-2 control-label">
		                                        Password</label>
		                                    <div class="col-sm-10">
		                                        <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" />
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-sm-2">
		                                    </div>
		                                    <div class="col-sm-10">
		                                        <button type="submit" class="btn btn-primary btn-sm">
		                                            Submit</button>
		                                        <a href="javascript:;">Forgot your password?</a>
		                                    </div>
		                                </div>
		                                </form>
		                            </div> -->
		                            <div class="tab-pane active" id="Registration">
		                                <form role="form" class="form-horizontal">
		                                <div class="form-group">
		                                    <label for="FirstName" class="col-sm-3 control-label">
		                                       First Name</label>
		                                    <div class="col-sm-8">
		                                    	<input type="text" class="form-control" placeholder="First Name" />
		                                        <!-- <div class="row"> -->
		                                            <!-- <div class="col-md-3">
		                                                <select class="form-control">
		                                                    <option>Mr.</option>
		                                                    <option>Ms.</option>
		                                                    <option>Mrs.</option>
		                                                </select>
		                                            </div> -->
		                                            <!-- <div class="col-md-6">
		                                                
		                                            </div> -->
		                                        <!-- </div> -->
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="LastName" class="col-sm-3 control-label">
		                                        Last Name</label>
		                                    <div class="col-sm-8">
		                                        <input type="text" class="form-control" id="LastName" placeholder="Last Name" />
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="email" class="col-sm-3 control-label">
		                                        Email</label>
		                                    <div class="col-sm-8">
		                                        <input type="email" class="form-control" id="email" placeholder="Email" />
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="userid" class="col-sm-3 control-label">
		                                        User id</label>
		                                    <div class="col-sm-8">
		                                        <input type="text" class="form-control" id="UserID" placeholder="User ID" />
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="password" class="col-sm-3 control-label">
		                                        Password</label>
		                                    <div class="col-sm-8">
		                                        <input type="password" class="form-control" id="password" placeholder="Password" />
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-sm-2">
		                                    </div>
		                                    <div class="col-sm-10">
		                                        <button type="button" class="btn btn-primary btn-sm">
		                                            Save & Continue</button>
		                                        <form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
			                                        <button type="button" class="btn btn-default btn-sm">
			                                            Cancel</button>
		                                        </form>
		                                    </div>
		                                </div>
		                                </form>
		                            </div>
		                        </div>
		                        <!-- <div id="OR" class="hidden-xs">
		                            OR</div> -->
		                    </div>
		                    <!-- <div class="col-md-4">
		                        <div class="row text-center sign-with">
		                            <div class="col-md-12">
		                                <h3>
		                                    Sign in with</h3>
		                            </div>
		                            <div class="col-md-12">
		                                <div class="btn-group btn-group-justified">
		                                    <a href="#" class="btn btn-primary">Facebook</a> <a href="#" class="btn btn-danger">
		                                        Google</a>
		                                </div>
		                            </div>
		                        </div>
		                    </div> -->
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

	</body>
	<body>
		<!--<div class="imgcontainer" align="center">
			<img src="images/avatar.png" alt="Avatar" class="avatar">-->
			<div class="login-page">
				<center><h3>Slack Login</h3></center>
				<div align="center" class="form">
					<form action="<?php echo htmlspecialchars('../index.php'); ?>" method="post">
						<div>
							<input type="text" name="userid" placeholder="userid"><br>
							<input type="password" name="password" placeholder="password"><br>
							<input type="submit" name="submit" value="submit"></input>
						</div>
					</form>
					<div>
						<h5> New to Slack? &nbsp <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sign up now >></button></h5>
					</div>
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
