<?php
  session_start();
  $_SESSION['basePath'] = '../';
  session_write_close();
  require_once $_SESSION['basePath'].'controllers/home.php';

  $homeControlVar = new HomeController();
  $channelName = NULL;
  $textArea = NULL;
  $temp = NULL;
  $newInviteUserResponse = array();
  $workspaceUrl = "musicf17.slack.com";
  $threadsArr = array();

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


  if (isset($_POST['NewChannelSubmit'])) {
    $channelName = $_POST["ChannelName"];
    $purpose = $_POST['Purpose'];
    $channeltype = $_POST['Channeltype'];
    createChannel($channelName, $purpose, $channeltype);
  }
  //
  //if(isset($_POST['threadIdSubmit'])) {
  if(isset($_POST['threadId'])) {
    global $threadsArr;
    global $homeControlVar;
    //echo $_POST['threadId'];
    $threadsArr = $homeControlVar->getRepliesForThread($_POST['threadId']);
  }
  //
  function createChannel($channelName, $purpose, $channeltype) {
    global $workspaceUrl;
    global $newInviteUserResponse;
    global $channelName;
    global $homeControlVar;
    $channelName = $_POST["ChannelName"];
    $purpose = $_POST['Purpose'];
    $channeltype = $_POST['Channeltype'];
    $newChannelResponse = $homeControlVar->createNewChannel($channelName, $purpose, $channeltype, $workspaceUrl);
    $newInviteUserResponse = $homeControlVar->inviteUsersToChannel($_POST["newUserSearch"], $channelName, $workspaceUrl);
    //var_dump($newInviteUserResponse);
  }

  if (isset($_POST['inviteUsersExistingChannel']) && $_POST['inviteUsersExistingChannel'] == 'inviteUser') {
    global $newInviteUserResponse;
    global $channelName;
    global $workspaceUrl;
    global $homeControlVar;
    //echo $channelName;
    $temp = array();
    $newChannelResponse = $homeControlVar->createNewChannel($channelName, $purpose, $channeltype, $workspaceUrl);
    if ($newChannelResponse == true && $_POST["newUserSearch"] != NULL && !empty($_POST["newUserSearch"])) {
    $newInviteUserResponse = $homeControlVar->inviteUsersToChannel($_POST["newUserSearch"], $channelName, $workspaceUrl);
    if ($newInviteUserResponse['success'] != NULL && !empty($newInviteUserResponse['success'])) {
    $temp = $newInviteUserResponse['success'];
    //echo "<script type='text/javascript'>alert('$temp[0]');</script>";
    } else {
    $temp = $newInviteUserResponse['failed'];
    //echo "<script type='text/javascript'>alert('$temp[0]');</script>";
    }
    }
  }
  //
  function displayChannels()
  {
    global $homeControlVar;
    global $workspaceUrl;
    $channelList = $homeControlVar->viewChannels($workspaceUrl);
    foreach ($channelList as $value) {
      echo '<form method="post" action = "home.php">
              <div class = "ChannelDisplay col-xs-12">
                <input type="hidden" name="channel" value="'.$value.'" />
                <input type="submit" class="SideBarButton" value="'.$value.'" />
              </div>
            </form>';
    }
  }

  // function Channelview(){
  //   global $homeControlVar;
  //   global $channelName;
  //   $userCount = array();
  //   $channelMessages = $homeControlVar->viewMessages($channelName);
  //   foreach ($channelMessages as $key => $value) {
  //     $userCount = $value['user_id'];
  //     echo $value;
  //   }
  //   echo count($userCount);
  // }
//<a data-toggle='modal' data-target='#threadReply'>
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
      //$likeCount = getReactionCount($msgId, $likeEmo);
      //$dislikeCount = getReactionCount($msgId, $dislikeEmo);
      $actionUrl = htmlspecialchars($_SERVER['PHP_SELF'].'#'.$msgIdRef);
      if (count($channelMessages) != $i) {
        $name = "<div id= ".$msgIdRef." class = 'EntireMessage'>
                  <strong class = 'UserName'>".$value["first_name"]."&nbsp &nbsp".$value["last_name"].
                  "</strong> &nbsp &nbsp &nbsp <span class = 'TimeStamp'>".$strip."</span>
                  <ul class = 'MessageUL'>
                    <li class = 'MessageLI'>".$value['message']."</li>
                  </ul>

                  <label class='like' name='like' id=".$msgId.">
                  <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
                   </label>&nbsp &nbsp
                  <span id = 'likeResponse".$msgId."'>        </span>
                  <label class='dislike' name='dislike' id=".$msgId.">
                  <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
                  </label> &nbsp &nbsp
                  <span id = 'dislikeResponse".$msgId."'>     </span>

                    <form method='post' class = 'replyForm' action=".$actionUrl." >
                      <input type='hidden' name='threadId' value=". $msgId." />
                      <input type='submit' class='treadIdSubmit' name='treadIdSubmit' value='reply' />
                    </form>

                </div>";

      }  else {
      $name = "<div id=".$msgIdRef." class = 'EntireMessage'>
              <p id='bottomMsg'></p>
              <strong class = 'UserName'>".$value["first_name"]."&nbsp &nbsp".$value["last_name"].
              "</strong> &nbsp &nbsp &nbsp <span class = 'TimeStamp'>".$strip."</span>
              <ul class = 'MessageUL'>
                <li class = 'MessageLI'>".$value['message']."</li>
              </ul>

              <label class='like' name='like' id=".$msgId.">
              <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
               </label>&nbsp &nbsp
              <span id = 'likeResponse".$msgId."'>        </span>
              <label class='dislike' name='dislike' id=".$msgId.">
              <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
              </label> &nbsp &nbsp
              <span id = 'dislikeResponse".$msgId."'>     </span>

                <form class = 'replyForm' method='post' action=".$actionUrl.">
                  <input type='hidden' name='threadId' value=".$msgId.">
                  <input type='hidden' name='channel' value= ".$_POST['channel'].">
                  <input type='submit' class='threadIdSubmit' name='threadIdSubmit' value='reply'>
                </form>

            </div>";
    }
      echo $name;
      $i++;
    }
  }

  function insertMessage($textArea) {
    global $homeControlVar;
    global $channelName;
    global $workspaceUrl;
    $threadId = NULL;
    $messageType = 'post';
    //global $textArea;
    $homeControlVar->insertMessage($channelName,$textArea,$threadId,$messageType, $workspaceUrl);
    // if (isset($_SESSION["postFormVars"]))
    // {
    //   unset($_SESSION["postFormVars"]);
    // } else {
    unset($_POST["textarea"]);
    //}
  }
  //
  function displayReplies() {
    global $threadsArr;
    if (!empty($threadsArr) && $threadsArr != NULL) {
      var_dump($threadsArr);
    }
  }

  function getReactionCount($msgId, $emoName) {
    global $homeControlVar;
    $info = array();
    $info = $homeControlVar->getReactionInfoForMsg($msgId, $emoName);
    return $info['count'];
  }
  //
  // function threadReply($treadsArr){
  //   $thread = NULL;
  //   $reply = NULL;
  //   foreach ($treadsArr as $key => $value) {
  //     $reply = $value["msg_id"];
  //     $thread = "<div class = 'threadDiv' col-xs-2>
  //                 <ul>
  //                   <li>".$reply."
  //                 </ul>
  //               </div>";
  //
  //   }
  //   echo $thread;
  // }


  // "<div class='modal fade' id='threadReply' role='dialog'>
  //             <div class='modal-dialog modal-lg'>
  //               <div class='modal-content'>
  //                 <div class='modal-header'>
  //                   <button type='button' class='close' data-dismiss='modal'>&times;</button>
  //                   <h4 class='modal-title'>Reply for the thread</h4>
  //                 </div>
  //                 <div class='modal-body'>
  //                   ".$reply."
  //                 </div>
  //                 <div class='modal-footer'>
  //                   <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
  //                 </div>
  //               </div>
  //             </div>
  //           </div>";
  // if (isset($_GET['logout'])) {
  //   global $homeControlVar;
  //
  //   $homeControlVar->destroyView();
  // }


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/home.css">
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/home.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="container-fluid nopadding" style="padding-left: 0%;">
      <!-- left panel -->
    <div class="row">

  		<div class="col-xs-2 nopadding sideBar" >
        <div class="navbar navbar-inverse navbar-fixed-left leftside">
            <div class="col-xs-12 workspaceUrlDisplay">
              <input type="submit" class="btn btn-info btn-lg workspaceUrlDisplay" data-toggle="modal" data-target="#ProfileUpdate" value="musicf17.slack.com">
            </div>
            <div class="ChannelDisplay col-xs-12">
              <h4>Channels
                <a href="#" class="NewChannel" data-toggle="modal" data-target="#NewChannel">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
              </h4>
            </div>
              <?php displayChannels();?>
            <div class="modal fade" id="ProfileUpdate" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Your Profile</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-xs-8">
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
                      <div class="col-xs-4">
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
            <!-- create new channel -->
            <div class="modal fade" id="NewChannel" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Channel</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-xs-8">
                          <form method="post" id= "NewChannel">
                            <div class="form-group">
                              <label for="ChannelName">Channel Name</label>
                              <input type="text" class="form-control" placeholder="Channel name" name="ChannelName" autocomplete="off">
                            </div>
                            <div class="form-group">
                              <label for="Purpose">Purpose</label>
                              <input type="text" class="form-control" placeholder="Purpose of Channel" name="Purpose" autocomplete="off">
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="Channeltype" value="Public">Public</label>
                              <label><input type="radio" name="Channeltype" value="Private">Private</label>
                            </div>
                            <div class="form-group">
                              <label for="invitingNewUsers">Invite members to this channel</label>
                              <input type="text" class="form-control" name="newUserSearch[]">
                            </div>
                            <input type="hidden" name="NewChannelSubmit" >
                            <input type="submit" value="Create Channel" class="btn btn-primary btn-sm">
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
              <form method="post" action="<?php //echo htmlspecialchars('channel.php'); ?>">
                <input type="submit" class="CreateChannel" value="(+) channel">
              </form>
            </div> -->

             <div>
              <a href="<?php echo htmlspecialchars('prgHelper.php'); ?>" class="LogoutButton">Logout</a>
            </div>
  		</div>
      </div>
      <!-- right column -->
      <div class="col-xs-9 MessageHome" >
        <div class="row">
          <div class="Channelview col-xs-12">
            <h4><strong><?php echo "#" . $channelName;?></strong></h4>
            <!-- inviting new users after creating channel -->
            <div class="inviteUsers">
              <a href="#" data-toggle="modal" data-target = "#inviteUsers">
                <i class="fa fa-user-o" aria-hidden="true"></i>
              </a>
            </div>
            <!-- to invite members to existing channels -->
            <div class="modal fade" id="inviteUsers" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Invitation</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                      <div class="form-group">
                        <label for="invitingNewUsers">Invite members</label>
                        <input type="text" class="form-control" name="addUserExistingChannel[]">
                      </div>
                        <input type="hidden" name = "channel" value = "<?php echo $_POST["channel"]; ?>" >
                        <input type="hidden" name="inviteUsersExistingChannel" value = "inviteUser">
                        <input type="submit" value="Invite" class="btn btn-primary btn-sm">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="MessageDisplay col-xs-12" >
                <?php displayMessages(); ?>
          </div>
          <div class="MessageEntry col-xs-12">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'#bottomMsg'); ?>">
              <input id="textArea" type="text" name="textarea" placeholder="<?php echo "Message "."@".$_POST["channel"] ?>" required>
              <input type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
              <input id="SubmitButton" type="hidden" name="submit"/>
            </form>
          </div>
        </div>
      </div>
      <div class = 'threadDiv col-xs-1'>
        <?php  displayReplies(); ?>
      </div>
    </div>
	</div>
  <!-- message display height -->
    <script type="text/javascript"> $(".MessageDisplay").height($(window).height()-($(window).height()*22/100)+"px"); </script>
    <script type="text/javascript">$("input[type='image']").click(function() {
      $("input[id='my_file']").click();
    });</script>
    <!-- nav bar height -->
    <script type="text/javascript">$(".leftside").css("height",$(window).height()+"px");</script>
    <script type="text/javascript">$(".sideBar").height($(window).height()-($(window).height()*0/100)+"px");</script>

</body>

</html>
