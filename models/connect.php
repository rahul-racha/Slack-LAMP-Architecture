<?php
  class DbConnect {
	   private $servername = 'localhost';
  	 private $port = '3306';
  	 private $username = 'admin';//root';
  	 private $password = 'M0n@rch$';//'root';
  	 private $database = 'slack';

    	// $link = mysqli_init();
    	// $conn = mysqli_real_connect(
    	// 	$link,
    	// 	$servername,
    	// 	$user,
    	// 	$password,
    	// 	$database,
    	// 	$port
    	// );

    public function &createConnectionObject()
    {
        $connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (!$connection) {
          die("Conenction failed - ".mysqli_connect_error());
        }
		    return $connection;
    }

	  public function closeConnectionObject(&$conn)
	  {
		    $conn->close();
	  }
  }
?>
