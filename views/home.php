<!DOCTYPE html>
<html lang="en">

<?php
  require_once '../controllers/home.php';
?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
	<div class="container MainDiv">
		<div class="MessageHome">
			<div class="MessageDisplay">
			<?php
				$homeControlVar1 = new HomeController();

				if(isset($_GET["channel"])){
					$channelname = $_GET["channel"];

					$channelmessages = $homeControlVar1->viewMessages($channelname);
					$Msg = "";

					foreach ($channelmessages as $key => $value) {
						// print_r($value);
						foreach ($value as $message) {
							$Msg = $Msg."<div>".$message."</div>";	
						}
						echo $Msg;
					}
				}
			?>
			</div>
			<div class="MessageEntry">
				<?php
					if(isset($_GET["channel"])){
						$channelname = $_GET["channel"];
						// echo "hi:". $channelname;
					}
					if(isset($_POST["channel"])){
						$channelname = $_POST["channel"]; 
					}
				?>
				<form method="POST" action="home.php" >
		    		<input id="textArea" type="text" name="textfield" placeholder="Enter yout text here"/>
		    		<input type="hidden" name="channel" value="<?php echo $channelname;?>"/>
		    		<input id="SubmitButton" type="submit" name="submit"/>
				</form>
			</div>
			<?php 
				
				// echo $channelname;
				$homeControlVar = new HomeController();
				if(isset($_POST["textfield"])){
					$channelname = $_POST["channel"];	
					// echo $channelname;
					$messageInserted = $_POST["textfield"];
					// echo $messageInserted;
					$InsertedMessage = $homeControlVar->insertMessage($channelname,$messageInserted);
				}
			 ?>
		</div>
		
		<div class="sideBar">
			<h2><center>Workspace</center></h2>
			<div class="SideBarNav">
				<?php
	                $homeControlVar = new HomeController();

	                $channelList = $homeControlVar->viewChannels();
	                foreach ($channelList as $value) {
	                	echo '<form method="GET" action = "home.php"> 
	                			<input type="hidden" name="channel" value="'. $value.'" />
	                			<input type="submit" class="SideBarButton" value= "'.$value.'" />
					    		</form>';
					}
	                // echo "<br/>##################<br/>";
	                // var_dump($homeControlVar->viewMessages('general'));
	                // var_dump($homeControlVar->viewMessages('jazz'));                
              	?>				
			</div>		
		</div>
		
	</div>
</body>


</html>



