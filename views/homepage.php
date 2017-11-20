<?php
	session_start();
	$_SESSION['basePath'] = '../';
	//session_write_close();
	require_once $_SESSION['basePath'].'controllers/home.php';


  $homeControlVar = new HomeController();
  $channelName = NULL;
	$channelHeading = NULL;
  $workspaceUrl = "musicf17.slack.com";
	$msgId = NULL;


  if (isset($_POST["channel"])) {
    global $channelName;
    $channelName = $_POST["channel"];
  } else if (isset($_SESSION['channel'])) {
    global $channelName;
    $_POST["channel"] = $_SESSION['channel'];
    $channelName = $_POST["channel"];
    unset($_SESSION['channel']);
  }

	if (isset($_POST["channelHeading"])) {
		global $channelHeading;
		$channelHeading = $_POST["channelHeading"];
	} else if (isset($_SESSION['channelHeading'])) {
    global $channelHeading;
    $_POST["channelHeading"] = $_SESSION['channelHeading'];
    $channelHeading = $_POST["channelHeading"];
    unset($_SESSION['channelHeading']);
	}

  function displayChannels()
  {
    global $homeControlVar;
    global $workspaceUrl;
    global $channelName;
		global $channelHeading;
    $channelList = $homeControlVar->viewChannels($workspaceUrl);
    if (!isset($_SESSION['channel']) && !isset($_POST["channel"])) {
			$symbol = NULL;
      $channelName = $channelList[0]['channel'];
      $_POST["channel"] = $channelList[0]['channel'];
			if ($channelList[0]['type'] == "Public") {
				$symbol = "#";
			} else {
				$symbol = "∆";
			}
			$channelHeading = $symbol." ".$channelName;
    }

     foreach ($channelList as $index) {
			$chName = NULL;
			$type = NULL;
			$sym = NULL;
		 	foreach ($index as $key => $value) {
				if ($key == "channel") {
					$chName = $value;
				} else if ($key == "type") {
					$type = $value;
				}
				if ($type == "Public") {
					$sym = "#";
				} else {
					$sym = "∆";
				}
				if ($type != NULL && $chName != NULL) {
					$finalName = $sym." ".$chName;
      		echo '<div class="col-xs-12">
									<form method="post" action = "home.php">
										<input type="hidden" name="channel" value="'.$chName.'" >
										<input type="hidden" name="channelHeading" value="'.$finalName.'" >
										<input type="submit" class="client_channel_display" value="'.$finalName.'" >
									</form>
								</div>';
						}
     			}
			}
  }

  function displayMessages() {
    global $homeControlVar;
    global $channelName;
    global $workspaceUrl;
    $channelMessages = $homeControlVar->viewMessages($channelName, $workspaceUrl);
    $i = 1;
    foreach ($channelMessages as $key => $value) {
      $CurrentTime = new DateTime($value["created_time"]);
      $strip = $CurrentTime->format('H:i @Y-m-d');
      $name = NULL;
      $msgId = $value['msg_id'];
      $msgIdRef = $msgId."action";
      $likeEmo = "like";
      $dislikeEmo = "dislike";
      $likeCount = getReactionCount($msgId, $likeEmo);
      $dislikeCount = getReactionCount($msgId, $dislikeEmo);
      $actionUrl = htmlspecialchars($_SERVER['PHP_SELF'].'#'.$msgIdRef);
      if (count($channelMessages) != $i) {
        $name = "<div class = 'EntireMessage col-xs-12 row change_row_prop'>
									<div class='message_profile_pic'>
										<img src=".$value['avatar']." class='client_pic_display'>
									</div>
									<div class='message_content_wrapper'>
										<strong class = 'UserName'>".$value["first_name"]."&nbsp &nbsp".$value["last_name"].
	                  "</strong> &nbsp &nbsp &nbsp <span class = 'TimeStamp'>".$strip."</span>
	                  <ul class = 'MessageUL'>
	                    <li class = 'MessageLI'>".$value['message']."</li>
	                  </ul>

	                  <label class='like' name='like' id=".$msgId.">
	                  <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
	                   </label>&nbsp &nbsp
	                  <span id = 'likeResponse".$msgId."'>   $likeCount     </span>
	                  <label class='dislike' name='dislike' id=".$msgId.">
	                  <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
	                  </label> &nbsp &nbsp
	                  <span id = 'dislikeResponse".$msgId."'>  $dislikeCount   </span>".

										"<input type='hidden' name='threadId' value=".$msgId.">
										<input type='hidden' class='chNameForMsg' name='channel' value= ".$_POST['channel'].">
										<input type='submit' id=".$msgId." class='threadIdSubmit' name='threadIdSubmit' value='reply'>
										<input type='submit' id=".$msgId." class='delPost' name='delPost' value='delete'>
									</div>
                </div>";

      }  else {
      $name = "<div id = 'bottom' class = 'EntireMessage col-xs-12'>
								<img src=".$value['avatar']." class='client_pic_display'>
								<strong class = 'UserName'>".$value["first_name"]."&nbsp &nbsp".$value["last_name"].
								"</strong> &nbsp &nbsp &nbsp <span class = 'TimeStamp'>".$strip."</span>
								<ul class = 'MessageUL'>
									<li class = 'MessageLI'>".$value['message']."</li>
								</ul>

								<label class='like' name='like' id=".$msgId.">
								<i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
								 </label>&nbsp &nbsp
								<span id = 'likeResponse".$msgId."'>   $likeCount     </span>
								<label class='dislike' name='dislike' id=".$msgId.">
								<i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
								</label> &nbsp &nbsp
								<span id = 'dislikeResponse".$msgId."'>  $dislikeCount   </span>".

									"<input type='hidden' name='threadId' value=".$msgId.">
									<input type='hidden' class='chNameForMsg' name='channel' value= ".$_POST['channel'].">
									<input type='submit'id=".$msgId." class='threadIdSubmit' name='threadIdSubmit' value='reply'>
									<input type='submit' id=".$msgId." class='delPost' name='delPost' value='delete'>".
							"</div>";
    }
		// <p id='bottomMsg'></p>
      echo $name;
      $i++;
    }
  }

  function getReactionCount($msgId, $emoName) {
    global $homeControlVar;
    $info = array();
    $info = $homeControlVar->getReactionInfoForMsg($msgId, $emoName);
		//print_r($info["count"]);
    return isset($info["count"]) ? $info["count"] : NULL;
  }

	if (isset($_POST["thread_id"])){
		global $homeControlVar;
		$msgId=$_POST["thread_id"];
		$replyList = $homeControlVar->getRepliesForThread($msgId);
		echo json_encode($replyList);
	}

	if (isset($_GET["random"])) {
		// global $homeControlVar;
		echo "I am here";
		// $user_profile = array();
		// $user_profile = $homeControlVar->getProfile();
		echo "hello";
	}

?>
