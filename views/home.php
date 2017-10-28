<!DOCTYPE html>
<html lang="en">

<?php
  require_once '../controllers/home.php';

  $homeControlVar = new HomeController();
  $channelName = NULL;
  $textArea = NULL;

  if (isset($_POST["channel"])) {
    global $channelName;
    $channelName = $_POST["channel"];
  } else {
    global $channelName;
    $channelName = 'general';
    $_POST["channel"] = 'general';
  }

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
              <div class = "ChannelDisplay">
                <input type="hidden" name="channel" value="'.$value.'" />
                <input type="submit" class="SideBarButton" value="'.$value.'" />
              </div>
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
      $msg = $homeControlVar->validateInputs($value["message"]);
      if (count($channelMessages) != $i) {
      $name = "<div class = 'EntireMessage'>"."<strong class = 'UserName'>".$value["first_name"]."&nbsp"."&nbsp".$value["last_name"]."</strong>"."&nbsp"."&nbsp"."&nbsp"."<span class = 'TimeStamp'>".$strip."</span>"."<ul class 		= 'MessageUL'>"."<li class = 'MessageLI'>".$msg."</li>"."</ul>"."<a href = '#'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></a>"."&nbsp"."&nbsp"."&nbsp"."<a href = '#'><i class='fa fa-thumbs-o-down' aria-hidden='true'></i></a>"."</div>";
    } else {
      $name = "<div id = 'bottom' class = 'EntireMessage'>"."<strong class = 'UserName'>".$value["first_name"]."&nbsp"."&nbsp".$value["last_name"]."</strong>"."&nbsp"."&nbsp"."&nbsp"."<span class = 'TimeStamp'>".$strip."</span>"."<ul class 		= 'MessageUL'>"."<li class = 'MessageLI'>".$msg."</li>"."</ul>"."<a href = '#'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></a>"."&nbsp"."&nbsp"."&nbsp"."<a href = '#'><i class='fa fa-thumbs-o-down' aria-hidden='true'></i></a>"."</div>";
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

?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/home.css">
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="container-fluid" style="padding-left: 0%;">
    <div class="row">
      <!-- left panel -->
  		<div class="col-md-2" >
        <div class="navbar navbar-inverse navbar-fixed-left">
          <button type="button" class="btn btn-info btn-lg SideBarButton " data-toggle="modal" data-target="#ProfileUpdate">musicf17.slack.com</button>
          <div class="ChannelDisplay">
            <h4>Channels
              <a href="#" class="NewChannel" data-toggle="modal" data-target="#NewChannel">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </a>
            </h4>
          </div>
            <?php displayChannels(); ?>
          <div class="modal fade" id="ProfileUpdate" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Your Profile</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8">
                        <form action="/action_page.php">
                          <div class="form-group">
                            <label for="FirstName">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" name="FirstName" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label for="LastName">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="LastName" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label for="Status">Status</label>
                            <input type="text" class="form-control" placeholder="What is your status" name="Status" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label for="PhoneNumber">Phone number</label>
                            <input type="text" class="form-control" placeholder="(123) 456-7891" name="PhoneNumber" autocomplete="off">
                          </div>
                          <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Remember me</label>
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                      <!-- avatar details goes here -->
                      <input type="image" src="https://www.fancyhands.com/images/default-avatar-250x250.png" width="30px"/>
                      <input type="file" id="my_file" style="display: none;" />
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="NewChannel" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Create New Channel</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8">
                        <form action="/action_page.php">
                          <div class="form-group">
                            <label for="ChannelName">Channel Name</label>
                            <input type="text" class="form-control" placeholder="Channel name" name="ChannelName" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label for="Purpose">Purpose</label>
                            <input type="text" class="form-control" placeholder="Purpose of Channel" name="Purpose" autocomplete="off">
                          </div>
                          <div class="checkbox">
                            <label><input type="checkbox" name="Public">Public</label>
                            <label><input type="checkbox" name="Private">Private</label>
                          </div>
                          <input type="hidden" name="NewChannelSubmit" value="<?php echo $_POST["NewChannelSubmit"]; ?>"/>
                          <input type="button" value="Sign Up" class="btn btn-primary btn-sm">
                        </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- <div>
            <a href="#channelModel"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            <div id="channelModel" class="channelDialog">
              <div>
                <a href="#close" title="Close" class="close">X</a>
                <form>
                  <h2>Create Channel</h2>
                  <label>Channel Name</label>
                  <input type="text" name="Channel name" placeholder="e.g. general"><br>
                  <label>Purpose (optional)</label>
                  <input type="text" name="purpose"><br>
                  <label>USERS</label>
                  <input type="text" name="UserName" placeholder="Search by name"><br>
    		        </form>
              </div>
            </div>
            <form method="post" action="<?php echo htmlspecialchars('channel.php'); ?>">
              <input type="submit" class="CreateChannel" value="(+) channel">
            </form>
          </div> -->
    			
          <!-- <div>
            <a href="<?php echo htmlspecialchars('prgHelper.php'/*$_SERVER['PHP_SELF'].'?logout=true'*/); ?>" class="LogoutButton">Logout</a>
          </div> -->
        </div>
  		</div>
      <!-- right column -->
      <div class="col-md-10" >
        <div class="row">
            <div class="Channelview">
                  <strong><?php echo "#" . $channelName;?></strong>
            </div>
            <div class="MessageDisplay" >
                <?php displayMessages(); ?>
            </div>
            <div class="MessageEntry">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'#bottom'); ?>">
                <input id="textArea" type="text" name="textarea" placeholder="<?php echo "Message "."@".$_POST["channel"] ?>" required>
                <input type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
                <input id="SubmitButton" type="hidden" name="submit"/>
              </form>
            </div>
        </div>
      </div>
    </div>
	</div>
    <script type="text/javascript"> $(".MessageDisplay").height($(window).height()-($(window).height()*20/100)+"px"); </script> 
    <script type="text/javascript">$("input[type='image']").click(function() {
      $("input[id='my_file']").click();
    });</script>

</body>

</html>
