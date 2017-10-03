<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<!-- 	<link rel="stylesheet" type="text/css" href="css/fetching.css"> -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<style>
	.messsagecenter{
		margin-left: 35%;
	}
	input[type=text] {
    width: 70%;
    padding: 8px 8px;
    margin-left: -30%;
    display: inline-block;
    border: 1px solid #ccc;

	}
	input[type=submit] {


		background-color: #B7BBBB;
	    color: Blue;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    cursor: pointer;
	    width: 5%;

	}
</style>
<body>
	<?php include 'connect.php';
		session_start();
		$id_no = $_GET["channel"];
		// function fetching_message($id_no){
			if ($conn->connect_error) {
	    		die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT user_id, message,channel_id FROM channel_messages WHERE channel_id = '".$id_no."'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
		    // output data of each row
		    	while($row = $result->fetch_assoc()) {
		       	 echo "<div class= 'messsagecenter'>"."User " . $row["user_id"]. " - message: " . $row["message"]. "<br>" ."</div>";
		    	}
			} else {
				echo "0 results";
			}
		// }
		$conn->close();
	?>
	<div id="message_content">
		<div class="SidebarHome" >
			<ul>
				<li><a class="active" href="#">Home</a></li>
				<li><a href= "fetching.php?channel=0">General</a></li>
			    <li><a href="fetching.php?channel=1">Monarchs</a></li>
			    <li><a href="fetching.php?channel=2">CS518</a></li>
			    <li><a href="index.php?logout=true">Logout</a></li>
			</ul>
		</div>

		<div class="messageHolder">
			<form>
	    		<input id="textArea" type="text" name="textfield" placeholder="Enter yout text here">
	    		<input type="submit" name="submit" ></input>
			</form>
		</div>
	</div>



</body>
</html>