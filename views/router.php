<?php
  session_start();
  $_SESSION["basePath"] = "../";
  require_once $_SESSION["basePath"].'controllers/login.php';
  require_once $_SESSION['basePath'].'controllers/home.php';

  $channelName = NULL;
  $textArea = NULL;
  $threadsArr = array();
  $channelResponse = NULL;
  $channelHeading = NULL;
  $channelCreator = array();
  $newInviteUserResponse = array();
  $workspaceUrl = "musicf17.slack.com";
  $homeControlVar = new HomeController();
  $loginControllerVar = new LoginController();

  if (isset($_GET['register']) && $_GET['register'] == 'new') {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $userId = $_POST["userId"];
    $password = $_POST["password"];
    $workspaceUrl = "musicf17.slack.com";
    $loginControllerVar->registerNewUser($userId, $email, $password, $firstName, $lastName, $workspaceUrl);
  }

  if (isset($_POST['logout']) && $_POST['logout'] == "logout") {
    session_destroy();
    header("location:login.php", true, 303);
  }

  if (isset($_POST["channel"])) {
    global $channelName;
    $channelName = $_POST["channel"];
  }

  if (isset($_POST["channelHeading"])) {
		global $channelHeading;
		$channelHeading = $_POST["channelHeading"];
	}

  if (isset($_POST["textarea"])) {
    global $textArea;
    $textArea = $_POST["textarea"];
    insertMessage($textArea);
  }

  if (isset($_POST['newChannel']) && $_POST['newChannel'] == "newChannel") {
    $channelName = $_POST['channel'];
    $purpose = $_POST['purpose'];
    $channeltype = $_POST['channelType'];
    createChannel($channelName, $purpose, $channeltype, $_POST["newUserSearch"]);
  }

  if (isset($_POST['inviteUsersExistingChannel']) && $_POST['inviteUsersExistingChannel'] == 'inviteUser') {
    global $newInviteUserResponse;
    global $channelName;
    global $channelHeading;
    global $workspaceUrl;
    global $homeControlVar;
    $temp = array();

    if ($_POST["addUserExistingChannel"] != NULL && !empty($_POST["addUserExistingChannel"])) {
      $userList = array();
      $userList = $_POST["addUserExistingChannel"];
      $newInviteUserResponse = $homeControlVar->inviteUsersToChannel($userList, $channelName, $workspaceUrl);
      if ($newInviteUserResponse['success'] != NULL && !empty($newInviteUserResponse['success']) &&
        empty($newInviteUserResponse['failed'])) {
          $temp = $newInviteUserResponse['success'];
          //use a popup
          } else {
        $temp = $newInviteUserResponse['failed'];
          //use a popup
        }
    }
    $_SESSION['channel'] = $channelName;
    $_SESSION['channelHeading'] = $channelHeading;
    unset($_POST['inviteUsersExistingChannel']);
    unset($_POST["channel"]);
    unset($_POST['addUserExistingChannel']);
    $homeControlVar->redirectToHome();
  }

  function insertMessage($textArea) {
    global $homeControlVar;
    global $channelName;
    global $channelHeading;
    global $workspaceUrl;
    $threadId = NULL;
    $messageType = 'post';
    unset($_POST["textarea"]);
    $message = $homeControlVar->insertMessage($channelName,$textArea,$threadId,$messageType, $workspaceUrl);
    $_SESSION['channel'] = $channelName;
    $_SESSION['channelHeading'] = $channelHeading;
    $homeControlVar->redirectToHome();
  }

  function createChannel($channelName, $purpose, $channeltype, $invitedUsers) {
    global $workspaceUrl;
    //global $newInviteUserResponse;
    global $homeControlVar;
    global $channelResponse;
    global $channelCreator;
    global $channelHeading;

    $channelResponse = $homeControlVar->createNewChannel($channelName, $purpose, $channeltype, $workspaceUrl);
    if ($channelResponse == "true") {
    $users = array();
    $users = $invitedUsers;
    array_push($users, $_SESSION['userid']);
    $channelCreator = $homeControlVar->inviteUsersToChannel($users, $channelName, $workspaceUrl);
    $_SESSION['channel'] = $channelName;
    if ($channeltype == "Public") {
      $channelHeading = "#"." ".$channelName;
    } else {
      $channelHeading = "∆"." ".$channelName;
    }
    $_SESSION['channelHeading'] = $channelHeading;
    }
    unset($_POST['newChannel']);
    unset($_POST["channel"]);
    unset($_POST['purpose']);
    unset($_POST['channelType']);
    $homeControlVar->redirectToHome();
    //var_dump($newInviteUserResponse);
  }

  if(isset($_POST['threadId'])) {
    global $threadsArr;
    global $homeControlVar;
    //echo $_POST['threadId'];
    $threadsArr = $homeControlVar->getRepliesForThread($_POST['threadId']);
  }

  function displayReplies() {
    global $threadsArr;
    if (!empty($threadsArr) && $threadsArr != NULL) {
      var_dump($threadsArr);
    }
  }

?>
