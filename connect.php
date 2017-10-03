<?php
	$servername = 'localhost';
	$port = '3306';
	$username = 'root';
	$password = 'root';
	$database = 'slack';

	// $link = mysqli_init();
	// $conn = mysqli_real_connect(
	// 	$link,
	// 	$servername,
	// 	$user,
	// 	$password,
	// 	$database,
	// 	$port
	// );
	$conn = new mysqli($servername, $username, $password, $database);
?>
