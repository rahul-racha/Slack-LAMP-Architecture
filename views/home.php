<!DOCTYPE html>
<html lang="en">

<?php
  require_once '../controllers/home.php';

  $homeControlVar = new HomeController();
  $channelName = NULL;
  $textArea = NULL;

  /*if (isset($_SESSION["postFormVars"]["channel"])) {
    global $channelName;
    $channelName = $_SESSION["postFormVars"]["channel"];
    echo "channel".$channelName;
  } else */
  if (isset($_POST["channel"])) {
    global $channelName;
    $channelName = $_POST["channel"];
  } else {
    global $channelName;
    $channelName = 'general';
  }

  /*if (isset($_SESSION["postFormVars"]["textarea"]))
  {
    global $textArea;
    $textArea = $_SESSION["postFormVars"]["textarea"];
    echo "OYEE".$textArea;
    insertMessage($textArea);
  } else*/
  if (isset($_POST["textarea"])) {
    global $textArea;
    $textArea = $_POST["textarea"];
    insertMessage($textArea);
  }

  function displayChannels()
  {
    global $homeControlVar;
    $channelList = $homeControlVar->viewChannels();
    foreach ($channelList as $value) {
      echo '<form method="post" action = "home.php">
              <input type="hidden" name="channel" value="'.$value.'" />
              <input type="submit" class="SideBarButton" value="'.$value.'" />
            </form>';
    }
  }

  function displayMessages() {
    global $homeControlVar;
    global $channelName;
    $channelMessages = $homeControlVar->viewMessages($channelName);
    foreach ($channelMessages as $key => $value) {
      $CurrentTime = new DateTime($value["created_time"]);
      $strip = $CurrentTime->format('H : i');
      $name = "<div class = 'EntireMessage'>"."<strong class = 'UserName'>".$value["first_name"]."</strong>"."<strong class = 'UserName'>"." ".$value["last_name"]."</strong>"		."&nbsp"."&nbsp"."&nbsp"."<span class = 'TimeStamp'>".$strip."</span>"."<ul class 		= 'MessageUL'>"."<li class = 'MessageLI'>".$value["message"]."</li>"."</ul>"."</div>";
      echo $name;
    }
  }

  function insertMessage($textArea) {
    global $homeControlVar;
    global $channelName;
    //global $textArea;
    $homeControlVar->insertMessage($channelName,$textArea);
    // if (isset($_SESSION["postFormVars"]))
    // {
    //   unset($_SESSION["postFormVars"]);
    // } else {
    unset($_POST["textarea"]);
    //}
  }
?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
	<div class="container MainDiv">
		<div class="MessageHome">
			<div class="MessageDisplay" >
			<?php displayMessages(); ?>
			</div>
			<div class="MessageEntry">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		    		<input id="textArea" type="text" name="textarea" placeholder="Enter your text here"/>
		    		<input type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
		    		<input id="SubmitButton" type="submit" name="submit"/>
				</form>
			</div>
		</div>

		<div class="sideBar">
			<h2><center>Workspace</center></h2>
			<div class="SideBarNav">
				<?php displayChannels(); ?>
			</div>
		</div>

	</div>
</body>

</html>
