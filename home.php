<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="container">
		<ul>
			<li><a class="active" href="#">Home</a></li>
			<li><a href='home.php?id_no=0'>General</a></li>
		    <li><a href="#">Monarchs</a></li>
		    <li><a href="#">CS518</a></li>
		    <li><a href="#">Random</a></li>
		</ul>
	</div>
	
		
	
	<!-- <div style="margin-left:35% ; position: absolute; bottom: 0px";>
		<form action="" method="post">
	    	<p>
	        	<input type="text" name="message" id="textfield" placeholder="What's in your mind">
	    	</p>
	    	<input type="submit" value="Send" name="message_submit">
		</form>
	</div> -->

<?php include 'connect.php';
	session_start();
	
	if (isset($_GET['id_no'])) {
    	fetching_message($_GET['id_no']);
 	 }
	// if (isset($_POST['textfield'])) {
	//     echo fetching_message();
	//     return;
	// }

	function fetching_message($id_no){
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT user_id, message,channel_id FROM channel_messages WHERE channel_id = '".$id_no."'";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
	    // output data of each row
	    	while($row = $result->fetch_assoc()) {
	       	 echo "User " . $row["user_id"]. " - message: " . $row["message"]. "<br>";
	    	}
		} else {
			echo "0 results";
		}
	}

	// function insert_message(){
	// 	$message = mysqli_real_escape_string($link, $_REQUEST['message']);
	// 	$sql = "INSERT INTO channel_messages (message) VALUES ('$message') ";
	// 	if(mysqli_query($link, $sql)){
	// 	    echo "Welldone !!!.";
	// 	} else{
	// 	    echo "Howle " . mysqli_error($link);
	// 	}

	// }


	$conn->close();
?>
</body>
</html>