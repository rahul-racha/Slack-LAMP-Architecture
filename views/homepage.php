<?php
	session_start();
	$_SESSION['basePath'] = '../';
	//session_write_close();
	require_once $_SESSION['basePath'].'controllers/home.php';
	require_once $_SESSION['basePath'].'controllers/profile.php';


  $homeControlVar = new HomeController();
	$profileControllerVar = new ProfileController();
	$profile = array();
	$channelName = NULL;
	$channelHeading = NULL;
	$chStatus = NULL;
  $workspaceUrl = "musicf17.slack.com";
	$msgId = NULL;
  $profile = $homeControlVar->getProfile($_SESSION['userid'], $workspaceUrl);
	$avatar_path = (!empty($profile['profile']) && !empty($profile['profile'][0]['avatar']) != NULL) ? $profile['profile'][0]['avatar'] : NULL;



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

	if (isset($_POST["chStatus"])) {
		global $chStatus;
		if ($_POST["chStatus"] == "archived") {
			$chStatus = "Unarchive";
			$_POST["chStatus"] = $chStatus;
		} else if ($_POST["chStatus"] == "unarchived") {
			$chStatus = "Archive";
			$_POST["chStatus"] = $chStatus;
		} else {
			$chStatus = $_POST["chStatus"];
		}
	} else if (isset($_SESSION['chStatus'])) {
		global $chStatus;
		if ($_SESSION["chStatus"] == "archived") {
			$chStatus = "Unarchive";
			$_POST["chStatus"] = $chStatus;
		} else if ($_SESSION["chStatus"] == "unarchived") {
			$chStatus = "Archive";
			$_POST["chStatus"] = $chStatus;
		} else {
			$_POST["chStatus"] = $_SESSION['chStatus'];
			$chStatus = $_POST["chStatus"];
		}
		//$_SESSION['chStatus'];
		//$chStatus = $_POST["chStatus"];
		unset($_SESSION['chStatus']);
	}

  function displayChannels()
  {
    global $homeControlVar;
    global $workspaceUrl;
    global $channelName;
		global $channelHeading;
		global $chStatus;
    $channelList = $homeControlVar->viewChannels($workspaceUrl);
    if (!isset($_SESSION['channel']) && !isset($_POST["channel"])) {
			$symbol = NULL;
			if (!empty($channelList)) {
      	$channelName = $channelList[0]['channel'];
      	$_POST["channel"] = $channelList[0]['channel'];
				if ($channelList[0]['type'] == "Public") {
					$symbol = "#";
				} else {
					$symbol = "∆";
				}
				$channelHeading = $symbol." ".$channelName;
				$_POST['$channelHeading'] = $channelHeading;
			}
    }
		if (!isset($_SESSION["chStatus"]) && !isset($_POST["chStatus"])) {
			if (!empty($channelList)) {
				$temp = $channelList[0]['status'];
				if ($temp == "archived") {
					$chStatus = "Unarchive";
				} else if ($temp == "unarchived") {
					$chStatus = "Archive";
				}
				$_POST["chStatus"] = $chStatus;
			}
		}

     foreach ($channelList as $index) {
			$chName = NULL;
			$type = NULL;
			$sym = NULL;
			$ch_status = NULL;
		 	foreach ($index as $key => $value) {
				if ($key == "channel") {
					$chName = $value;
				} else if ($key == "type") {
					$type = $value;
				} else if ($key == "status") {
					$temp = $value;
					if ($temp == "archived") {
						$ch_status = "Unarchive";
					} else if ($temp == "unarchived") {
						$ch_status = "Archive";
					}
				}
				if ($type == "Public") {
					$sym = "#";
				} else {
					$sym = "∆";
				}
				if ($type != NULL && $chName != NULL && $ch_status != NULL) {
					$finalName = $sym." ".$chName;
      		echo '<div class="col-xs-12">
									<form method="post" action = "home.php">
										<input type="hidden" name="channel" value="'.$chName.'" >
										<input type="hidden" name="channelHeading" value="'.$finalName.'" >
										<input type="hidden" name="chStatus" value="'.$ch_status.'" >
										<input type="submit" class="client_channel_display" value="'.$finalName.'" >
									</form>
								</div>';
						}
     			}
			}
  }

  function displayMessages($retChannel,$Channel_name) {
    global $homeControlVar;
    global $workspaceUrl;
		global $channelName;
		global $channelHeading;
		global $chStatus;

		$_SESSION['channel'] = $channelName;
		$_SESSION['channelHeading'] = $channelHeading;
		$_SESSION['chStatus'] = $chStatus;
		// echo $workspaceUrl;
		// echo $retChannel;
		// echo $Channel_name;
    $channelMessages = $homeControlVar->viewMessages($Channel_name, $workspaceUrl, $retChannel);
		// echo "msgid:".$retChannel;
		// echo sizeof($channelMessages);
    $i = 1;
		$name = "";
		$msgId = NULL;
		$firstMsgId = NULL;
		$loadMore = "";
		$head = isset($channelHeading)? $channelHeading: NULL;
		$st = isset($chStatus)? $chStatus: NULL;
    foreach ($channelMessages as $key => $value) {
      $CurrentTime = new DateTime($value["created_time"]);
      $strip = $CurrentTime->format('H:i @Y-m-d');
      $msgId = $value['msg_id'];
			if ($firstMsgId == NULL) {
				$firstMsgId = $value['msg_id'];
			}
      $msgIdRef = $msgId."action";
      $likeEmo = "like";
      $dislikeEmo = "dislike";
      $likeCount = getReactionCount($msgId, $likeEmo);
      $dislikeCount = getReactionCount($msgId, $dislikeEmo);
      $actionUrl = htmlspecialchars($_SERVER['PHP_SELF'].'#'.$msgIdRef);

      //if($value["message"] || $value["image_path"] || $value["snippet"] != "")
			//{
				if(count($channelMessages != $i))
				{
        $name = $name. "<div class='message_profile_pic col-xs-1'>
									 <img src=".$value['avatar']." class='client_pic_display'>
								 </div>
								 <div class='message_content_wrapper col-xs-10'>
								 		<strong class = 'UserName'>".$value["first_name"]."&nbsp &nbsp".$value["last_name"].
	                  "</strong> &nbsp &nbsp &nbsp <span class = 'TimeStamp'>".$strip."</span>
	                  <ul class = 'MessageUL'>";

										if ($value["message"] != NULL && !empty($value["message"])){
											$name=$name. "<li class = 'MessageLI'>".$value['message']."</li>";
										} else if ($value["image_path"] != NULL && !empty($value["image_path"])) {
											//$uploadedFileName = $value["image_path"];
											//$imageFileType = pathinfo($uploadedFileName,PATHINFO_EXTENSION);
											//$imageFileType = exif_imagetype($value["image_path"]);
											// echo $imageFileType;
											// if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif"){
											$name=$name. "<li class = 'MessageLI'><img src='".$value["image_path"]."' style='width:400px;'></li>";
											// }
										}
										else if($value["snippet"] != NULL && !empty($value["snippet"])){
											$name=$name. "<li class = 'MessageLI'><pre class='client_snippet_pre_tag'><code>".$value["snippet"]."</code></pre></li>";
										} else if($value["file_path"] != NULL && !empty($value["file_path"])) {
											$name=$name. "<li class = 'MessageLI'><a href=".$value["file_path"]." download>".$value["file_path"]."</a></li>";
										}
										$name=$name. "</ul>

	                  <label class='like' name='like' id=".$msgId." style='cursor:pointer;'>
	                  <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
	                  </label>&nbsp &nbsp
	                  <span id = 'likeResponse".$msgId."'> ".$likeCount."</span>
	                  <label class='dislike' name='dislike' id=".$msgId." style='cursor:pointer;'>
	                  <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
	                  </label> &nbsp &nbsp
	                  <span id = 'dislikeResponse".$msgId."'>".$dislikeCount."</span>".

										"<input type='hidden' name='threadId' value=".$msgId.">
										<input type='hidden' class='chNameForMsg' name='channel' value= ".$_POST['channel'].">

			              <input type='hidden' class='delHeading' name='channelHeading' value=".$head.">
			              <input type='hidden' class='delStatus' name='chStatus' value=".$st.">

										<input type='submit' id=".$msgId." class='threadIdSubmit' name='threadIdSubmit' value='reply'>
										<input type='submit' id=".$msgId." class='delPost' name='delPost' value='delete'>
                </div>";

				}
			else{
				$name = $name. "<div class='message_profile_pic col-xs-1'>
									 <img src=".$value['avatar']." class='client_pic_display'>
								 </div>
								 <div class='message_content_wrapper col-xs-10'>
								 		<strong class = 'UserName'>".$value["first_name"]."&nbsp &nbsp".$value["last_name"].
	                  "</strong> &nbsp &nbsp &nbsp <span class = 'TimeStamp'>".$strip."</span>
	                  <ul class = 'MessageUL'>";
										$value["image_path"];
										if($value["message"] != NULL && !empty($value["message"])){
											$name=$name. "<li class = 'MessageLI'>".$value['message']."</li>";
										}

										else if($value["image_path"] != NULL && !empty($value["image_path"])){
											// $uploadedFileName = $value["image_path"];
											// $imageFileType = pathinfo($uploadedFileName,PATHINFO_EXTENSION);
											//if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif"){
											$name=$name. "<li class = 'MessageLI'><img src='".$value["image_path"]."' style='width:400px;'></li>";
											//}
										}
										else if($value["snippet"] != NULL && !empty($value["snippet"])) {
											$name=$name. "<li class = 'MessageLI'><pre><code>".$value["snippet"]."</code></pre></li>";
										} else if($value["file_path"] != NULL && !empty($value["file_path"])) {
											$name=$name. "<li class = 'MessageLI'><a href=".$value["file_path"]." download>".$value["file_path"]."</a></li>";
										}
										$name=$name. "</ul>

	                  <label class='like' name='like' id=".$msgId." style='cursor:pointer;'>
	                  <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
	                   </label>&nbsp &nbsp
	                  <span id = 'likeResponse".$msgId."'> ".$likeCount."</span>
	                  <label class='dislike' name='dislike' id=".$msgId." style='cursor:pointer;'>
	                  <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
	                  </label> &nbsp &nbsp
	                  <span id = 'dislikeResponse".$msgId."'>".$dislikeCount."</span>".

										"<input type='hidden' name='threadId' value=".$msgId.">
										<input type='hidden' class='chNameForMsg' name='channel' value= ".$_POST['channel'].">

										<input type='hidden' class='delHeading' name='channelHeading' value=".$head.">
			              <input type='hidden' class='delStatus' name='chStatus' value=".$st.">

										<input type='submit' id=".$msgId." class='threadIdSubmit' name='threadIdSubmit' value='reply'>
										<input type='submit' id=".$msgId." class='delPost' name='delPost' value='delete'>
                </div>";
			}
		//}
		$i++;
    }
		$loadMore = "<div class='col-xs-12 loadMoreButton'>
							<input type='hidden' class='post_load_ret_channel_name' value='".$Channel_name."'></input>
							<input type='hidden' class='post_load_retChannel' value='".$_SESSION["loadCount"]."'></input>
							<center><input type='submit' class='client_posts_load_more' value='load more'></input></center>
					</div>";
		$name = $loadMore.$name;
		echo $name;
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
	// pagination
	if(isset($_POST["pagination"])){
		$retChannel = intval($_POST["pagination"]["retChannel"]);
		$Channel_name = $_POST["pagination"]["Channel_name"];
		$_SESSION["loadCount"] = $_SESSION["loadCount"] + 5;
		displayMessages($retChannel,$Channel_name);
		// echo $str;
	}

?>
