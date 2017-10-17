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
    $_POST["channel"] = 'general';
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
    $i = 1;
    foreach ($channelMessages as $key => $value) {
      $CurrentTime = new DateTime($value["created_time"]);
      $strip = $CurrentTime->format('H:i @Y-m-d');
      $name = NULL;
      if (count($channelMessages) != $i) {
      $name = "<div class = 'EntireMessage'>"."<strong class = 'UserName'>".$value["first_name"]."</strong>"."<strong class = 'UserName'>"." ".$value["last_name"]."</strong>"		."&nbsp"."&nbsp"."&nbsp"."<span class = 'TimeStamp'>".$strip."</span>"."<ul class 		= 'MessageUL'>"."<li class = 'MessageLI'>".$value["message"]."</li>"."</ul>"."</div>";
    } else {
      $name = "<div id = 'bottom' class = 'EntireMessage'>"."<strong class = 'UserName'>".$value["first_name"]."</strong>"."<strong class = 'UserName'>"." ".$value["last_name"]."</strong>"		."&nbsp"."&nbsp"."&nbsp"."<span class = 'TimeStamp'>".$strip."</span>"."<ul class 		= 'MessageUL'>"."<li class = 'MessageLI'>".$value["message"]."</li>"."</ul>"."</div>";
    }
      echo $name;
      $i++;
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

  if (isset($_GET['logout'])) {
    global $homeControlVar;

    $homeControlVar->destroyView();
  }

  // for logout
  // if (isset($_GET["logout"])) {
  //   //global $homeControlVar;
  //   //$homeControlVar->destroyView();
  //   session_destroy();
  //   unset($_GET["logout"]);
  //   header("location:login.php", true, 303);
  // }

?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
	<div class="container MainDiv">
		<div class="MessageHome">
      <div class="Channelview">
          <strong><?php echo "#" . $channelName;?></strong>
      </div>
			<div class="MessageDisplay" >
			    <?php displayMessages(); ?>
			</div>
			<div class="MessageEntry">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'#bottom'); ?>">
		    		<input id="textArea" type="text" name="textarea" placeholder="<?php echo "Message "."@".$_POST["channel"] ?>"/>
		    		<input type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
		    		<input id="SubmitButton" type="hidden" name="submit"/>
				</form>
			</div>
		</div>

		<div class="sideBar">
			<h2 style="color: white; font-family: verdana;"><center>musicf17.slack.com</center></h2>
			<div class="SideBarNav">
				<?php displayChannels(); ?>
        
			</div>
      <div>
        <a href="<?php echo htmlspecialchars('prgHelper.php'/*$_SERVER['PHP_SELF'].'?logout=true'*/); ?>" class="LogoutButton">Logout</a>
      </div>
		</div>

	</div>
</body>

</html>
