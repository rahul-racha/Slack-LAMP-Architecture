<!DOCTYPE html>
<html lang="en">

<?php
  require_once '../controllers/home.php';
?>

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
	<div class="Main">
	<!-- 	<div class="messageHolder">
			<form method="POST" class="messageHolder" style="padding-right: 50%;">
	    		<input id="textArea" type="text" name="textfield" placeholder="Enter yout text here"/>
	    		<input type="submit" name="submit"/>
			</form>
		</div> -->
		<div>
			<?php
				$homeControlVar1 = new HomeController();

				if(isset($_GET["channel"])){
					$channelname = $_GET["channel"];	
					$channelmessages = $homeControlVar1->viewMessages($channelname);
					foreach ($channelmessages as $key => $value) {
						// echo "inside for";
						// echo $key. '  ' . $value;
						foreach ($value as $message) {
							echo $message;
						}
					}
				}
				else{
					echo "Rohit";	
				}
				
				
				// echo $channelname;
				

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



