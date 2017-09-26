<!DOCTYPE html>
<html>
<style>
.container{
	/*border: 3px solid black;*/
	margin-top: 5%;
}

</style>
<body>
	<?php
	    session_start();
		$_SESSION['index']=1;
	    if (isset($_POST["submit"])) {
		require 'connect.php'; 		
		if (!$conn) {
			die("Conenction failed - ".mysqli_connect_error());
		} else {
			echo "connect!<br/>";
		}

		function validateInputs($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);			
			return $data;
		}

		$user_id = $password = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user_id = validateInputs($_POST["user_id"]);
			$password = validateInputs($_POST["password"]);	
		}
		
		$checkUser = "SELECT user_id, password
			      	  FROM user_info where user_id = '$user_id' AND password = '$password'";
	    $result = mysqli_query($conn, $checkUser);	
		var_dump($result);
	     
	    if (mysqli_num_rows($result) > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<br>".$row['user_id']." exists";				
			}		
		} else {
			echo "<br/>$user_id does not exist";
		}
		
		$conn->close();
		}

	?>
	<div class="container">
		<center><h3>Login details</h3></center>
		<div class="overall row well" align="center">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">	
				<div class="row well">
					<label><strong>UserID </strong></label><br>
					<input type="text" name="user_id" placeholder="Enter userID"><br>
					<label><strong>Password </strong></label><br>
					<input type="password" name="password" placeholder="Enter Password"><br>
					<input type="submit" name="submit" vslue="submit"></input>
				</div>
			</form>
		</div>
	</div>

</body>
</html>
