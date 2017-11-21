<?php
  //ob_start();
  //session_start();

  //retrieve public channels
  //retrieve private channels for a user in workspace
  //identify if a channel is public or private
  //get all replies of a thread. input <- msg id(div id)
  //insert replies to db
  //add reaction to db for each msg_id
  //delete/reject for duplicate reaction for every userid per msg_id
  //duplicate channel names
  //page refresh
  //validate mysql insertions and retrieval
  //client side validation
  //check if user is in channel before inviting
  //check if user exists in db when inviting


  //include_once $_SESSION['basePath'].'errors.php';
  require_once $_SESSION['basePath'].'models/home.php';

   if (!isset($_SESSION['userid']) || !isset($_SESSION['password']) || !isset($_SESSION['userRole']))
   {
     header("location:login.php", true, 303);
   } //else if (isset($_POST["textarea"])) {
  //   header("location:..home.php", true, 303);
  // }

  class HomeController {
    private $homeModelVar;

    public function redirectToHome()
    {
      $url = $_SESSION['basePath']."views/home.php#bottom";
      header("location:".$url);
    }

    public function viewChannels($workspaceUrl)
    {
        $this->homeModelVar = new HomeModel();
        $channels = array();
        $channels = $this->homeModelVar->retrieveChannels($workspaceUrl);
        // echo $channels;
        return $channels;
    }

    public function getProfile($user_id, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $profile = array();
      $membership = array();
      $profile = $this->homeModelVar->getUserProfile($user_id, $workspaceUrl);
      $membership = $this->homeModelVar->getUserMembership($user_id, $workspaceUrl);
      $userData = array('profile'=>$profile, 'membership'=>$membership);
      return $userData;
    }

    public function getUsersForPattern($keyword, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $userList = array();
      $userList = $this->homeModelVar->retrievePatternMatchedUsers($keyword, $workspaceUrl);
      return $userList;
    }

    public function viewMessages($channelName, $workspaceUrl)
    {
        $this->homeModelVar = new HomeModel();
        $messages = array();
        $messages = $this->homeModelVar->retrieveMessages($channelName, $workspaceUrl);
        return $messages;
    }

    public function getMessageType($messageType) {
      $type = NULL;
      switch ($messageType) {
        case 'post':
          $type = 1;
          break;
        case 'thread':
          $type = 2;
          break;
        case 'reply':
          $type = 3;
          break;
        default:
          $type = NULL;
          break;
      }
      return $type;
    }

    //function should be called to set the message type to 'thread'
    //before the first reply is inserted
    public function setMessageType($threadId, $messageType) {
      $type = $this->getMessageType($messageType);
      $responseString = NULL;
      $this->homeModelVar = new HomeModel();
      $affectedRows = $this->homeModelVar->updateMessageType($threadId, $type);
      if ($affectedRows < 1) {
        $responseString = 'Message type is not updated';
        echo $responseString;
      } else {
        $responseString = 'Message type is updated';
        echo $responseString;
      }
      return $responseString;
    }

    //function is used for inserting messages and replies
    public function insertMessage($channelName, $message, $imagePath, $snippet, $threadId, $messageType, $workspaceUrl)
    {
        $responseString = NULL;
        $this->homeModelVar = new HomeModel();
        $chStatus = $this->homeModelVar->getChannelStatus($channelName, $workspaceUrl);
        if ($chStatus != "archived") {
          $type = $this->getMessageType($messageType);
          $affectedRows = $this->homeModelVar->insertMessage($channelName, $message, $imagePath, $snippet, $threadId, $type, $workspaceUrl);
          if ($affectedRows == 1) {
            $responseString = 'Message is inserted';
          } else if ($affectedRows == 0)
          {
              $responseString = 'Message not inserted';
          } else if ($affectedRows < 0)
          {
            $responseString = 'Query returned an error';
          }
        } else {
          $responseString = "Channel is archived";
        }
        return $responseString;
    }

    // public function createNewChannelByPrg($channelName, $purpose, $type, $workspaceUrl)
    // {

      //$status = array();

      // switch ($status['channelStatus']) {
      //   case 0:
      //     $responseString['channel'] = "Channel ".$channelName." not created";
      //     break;
      //   case 1:
      //     $responseString['channel'] = "Channel ".$channelName." is created";
      //     break;
      //   default:
      //     $responseString['channel'] = 'Channel not created. SQL error';
      //     break;
      // }
      //
      // switch ($status['userStatus']) {
      //   case 0:
      //     $responseString['user'] = $_SESSION['userid']." is not added to channel";
      //     break;
      //   case 1:
      //     $responseString['user'] = $_SESSION['userid']." is added to channel";
      //     break;
      //   default:
      //     $responseString['user'] = $_SESSION['userid']." not added to ".$channelName.". SQL error";
      //     break;
      // }

    //   return $responseString;
    // }

    //create new channel for a workspace
    public function createNewChannel($channelName, $purpose, $type, $workspaceUrl) {
      $responseString = NULL;
      $this->homeModelVar = new HomeModel();
      $affectedRows = $this->homeModelVar->createChannel($channelName, $purpose, $type, $workspaceUrl);
      switch ($affectedRows) {
        case 0:
          $responseString = "false";//"Channel ".$channelName." not created";
          break;
        case 1:
          $responseString = "true";//"Channel ".$channelName." is created";
          break;
        default:
          $responseString = "false";//"Channel not created. SQL error";
          break;
      }
      return $responseString;
    }

    //add list of users to a channel
    public function inviteUsersToChannel($users, $channelName, $workspaceUrl, $isCreate) {
      $invitationResults = array('success' => array(), 'failed' => array());
      $this->homeModelVar = new HomeModel();
      $chStatus = NULL;
      if ($isCreate == "false") {
        $chStatus = $this->homeModelVar->getChannelStatus($channelName, $workspaceUrl);
      }
      if ($chStatus != "archived") {
          foreach ($users as $userID) {
            $successFeeds = $this->homeModelVar->addUserToChannel($userID, $channelName, $workspaceUrl);
            if ($successFeeds < 1) {
              array_push($invitationResults['failed'], $userID);
            } else {
              array_push($invitationResults['success'], $userID);
            }
          }
      }
      return $invitationResults;
    }

    public function getAdmins() {
      $this->homeModelVar = new HomeModel();
      $admins = array();
      $admins = $this->homeModelVar->getAdmins();
      return $admins;
    }

    public function getRepliesForThread($threadId) {
      $this->homeModelVar = new HomeModel();
      $responseString = NULL;
      $replyList = array();
      $replyList = $this->homeModelVar->retrieveReplies($threadId);
      // if (empty($replyList)) {
      //   echo "No replies found for the thread";
      // }
      return $replyList;
    }

    public function getEmoInfo($msgId, $emoName) {
      $this->homeModelVar = new HomeModel();
      $info = array();
      $emoId = $this->homeModelVar->getEmoId($emoName);
      if ($emoId != NULL) {
        $info = $this->homeModelVar->getInfoForMsgReaction($msgId, $emoId);
      }
      return $info;
    }

    //check if user exists in a reaction. If exists then delete from dislike when like is clicked
    //using handleReactionForMsg
    public function isUserExistsForReaction($users) {
      $isExists = NULL;
      $pos = strpos($users, ";".$_SESSION['userid'].";");
      if ($pos === false) {
        $isExists = "false";
      } else {
        $isExists = "true";
      }
      return $isExists;
    }

    //Use this function to get the count, users available for a reaction in a msg
    public function getReactionInfoForMsg($msgId, $emoName) {
      $this->homeModelVar = new HomeModel();
      $responseString = NULL;
      $affectedRows = NULL;
      $info = array();
      $emoId = $this->homeModelVar->getEmoId($emoName);
      if ($emoId > 0) {
        $info = $this->homeModelVar->getInfoForMsgReaction($msgId, $emoId);
      }
      return $info;
    }

    public function handleReactionForMsg($msgId, $emoName, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $responseString = array('result'=>NULL,'message'=>NULL);
      $affectedRows = NULL;
      $info = array();
      $channelName =  $this->homeModelVar->getChannelFromMsg($msgId);
      $chStatus = $this->homeModelVar->getChannelStatus($channelName, $workspaceUrl);

      if ($chStatus != "archived") {
        $emoId = $this->homeModelVar->getEmoId($emoName);
        if ($emoId > 0) {
          $info = $this->homeModelVar->getInfoForMsgReaction($msgId, $emoId);
          //$responseString['message'] = $this->isUserExistsForReaction($info['users']);//$info['users'];
          //return $responseString;
          if ($info != NULL && $info['users'] != NULL && !empty($info['users'])) {
            if ($this->isUserExistsForReaction($info['users']) == "false") {
              //if ($isInsert == "true") {
                $isInsert = "true";
                $isUpdate = "true";
                $affectedRows = $this->homeModelVar->handleUserReaction($msgId, $emoId, $info, $isInsert, $isUpdate);
              //}
            } else {
              //if ($isInsert == "false") {
                $isInsert = "false";
                $isUpdate = "true";
                $affectedRows = $this->homeModelVar->handleUserReaction($msgId, $emoId, $info, $isInsert, $isUpdate);
              //}
            }
          } else {
            //if ($isInsert == "true") {
            $isUpdate = NULL;
            if ($info == NULL) {
              $isUpdate = "false";
            } else {
              $isUpdate = "true";
            }
              $isInsert = "true";
              $info['count'] = 0;
              $info['users'] = NULL;
              $affectedRows = $this->homeModelVar->handleUserReaction($msgId, $emoId, $info, $isInsert, $isUpdate);
            //}
          }
          if ($affectedRows == 1) {
            $responseString['result'] = "true";
            $responseString['message'] = "success";
          } /*else if ($affectedRows == NULL) {
            $responseString = NULL;
          }*/
          else if ($affectedRows == NULL) {
            $responseString['result'] = "false";
            $responseString['message'] = "failedEPIC";
          }
          else {
            $responseString['result'] = "false";
            $responseString['message'] = "failed";
          }
        } else {
          $responseString['result'] = "false";
          $responseString['message'] = $emoName." is not found in database";
        }
      } else {
      $responseString['result'] = "false";
      $responseString['message'] = "Channel is archived";
    }
      return $responseString;
    }

    public function getUserMetrics($userID, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $rxnMetrics = array();
      $msgMetrics  = array();
      $trxnMetrics = array();
      $tmsgMetrics = array();
      $rxnMetrics = $this->homeModelVar->retrieveRxnMetrics($userID, $workspaceUrl);
      $msgMetrics = $this->homeModelVar->retrievePostMetrics($userID, $workspaceUrl);
      $tmsgMetrics = $this->homeModelVar->retrieveNoChMsgs($userID, $workspaceUrl);
      $trxnMetrics = $this->homeModelVar->retrieveNoChRxns($userID, $workspaceUrl);
      $relRxnMetrics =  $this->homeModelVar->retrieveRelRxnMetrics($userID, $workspaceUrl);
      $relPostMetrics = $this->homeModelVar->retrieveRelPostMetrics($userID, $workspaceUrl);
      $metrics = array("reaction"=>$rxnMetrics, "post"=>$msgMetrics, "relRxn"=>$relRxnMetrics, "relPost"=>$relPostMetrics,
                      "treaction"=>$trxnMetrics, "tpost"=>$tmsgMetrics);
      return $metrics;
    }

    public function getChMetricsForUser($userID, $channelName, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $rxnCount = $this->homeModelVar->retUserChannelRelRxnMetrics($userID, $channelName, $workspaceUrl);
      return $rxnCount;
    }

    //Admin functions
    public function removeUsersFromChannel($userList, $channelName, $workspaceUrl) {
      $removedUsers = array('success' => array(), 'failed' => array());
      $this->homeModelVar = new HomeModel();
      $chStatus = $this->homeModelVar->getChannelStatus($channelName, $workspaceUrl);
      if ($chStatus != "archived") {
        foreach ($userList as $userID) {
          $affectedRows = $this->homeModelVar->removeUserFromChannel($userID, $channelName, $workspaceUrl);
          if ($affectedRows > 0) {
            array_push($removedUsers['success'], $userID);
          } else {
            array_push($removedUsers['failed'], $userID);
          }
        }
      }
      return $removedUsers;
    }

    public function retUsersFromChannel($channelName, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $userList = array();
      $userList = $this->homeModelVar->retUsersFromChannel($channelName, $workspaceUrl);
      return $userList;
    }

    public function deletePostsFromChannel($msgID, $channelName, $workspaceUrl) {
      $isSuccess = NULL;
      $this->homeModelVar = new HomeModel();
      $chStatus = $this->homeModelVar->getChannelStatus($channelName, $workspaceUrl);
      if ($chStatus != "archived") {
        $affectedRows = $this->homeModelVar->deletePostsFromChannel($msgID, $channelName, $workspaceUrl);
        if ($affectedRows > 0) {
          $isSuccess = "true";
        } else {
          $isSuccess = "false";
        }
      }
      return $isSuccess;
    }

    public function updateChannelStatus($channelName, $workspaceUrl, $status) {
      $isSuccess = NULL;
      $this->homeModelVar = new HomeModel();
      $affectedRows = $this->homeModelVar->updateChannelStatus($channelName, $workspaceUrl, $status);
      if ($affectedRows > 0) {
        $isSuccess = "true";
      } else {
        $isSuccess = "false";
      }
      return $isSuccess;
    }

    public function getChannelStatus($channelName, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $statusString = $this->homeModelVar->getChannelStatus($channelName, $workspaceUrl);
      return $statusString;
    }

  }
?>
