<?php
  //ob_start();
  //session_start();

  //retrieve public channels
  //retrieve private channels for a user in workspace
  //identify if a channel is public or private
  //get all replies of a thread. input <- msg id(div id)
  //insert replies to db


  include_once $_SESSION['basePath'].'errors.php';
  require_once $_SESSION['basePath'].'models/home.php';

   if (!isset($_SESSION['userid']) || !isset($_SESSION['password']))
   {
     header("location:login.php", true, 303);
   } //else if (isset($_POST["textarea"])) {
  //   header("location:..home.php", true, 303);
  // }

  class HomeController {
    private $homeModelVar;

    public function viewChannels()
    {
        $this->homeModelVar = new HomeModel();
        $channels = array();
        $channels = $this->homeModelVar->retrieveChannels();
        // echo $channels;
        return $channels;
    }

    public function viewMessages($channelName)
    {
        $this->homeModelVar = new HomeModel();
        $messages = array();
        $messages = $this->homeModelVar->retrieveMessages($channelName);
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
    public function insertMessage($channelName, $message, $threadId, $messageType)
    {
        $this->homeModelVar = new HomeModel();
        //$message = $this->homeModelVar->validateInputs($message);
        $responseString = NULL;
        $type = $this->getMessageType($messageType);

        $affectedRows = $this->homeModelVar->insertMessage($channelName, $message, $threadId, $type);

        if ($affectedRows == 0)
        {
            $responseString = 'Message not inserted';
            echo $responseString;
        } else if ($affectedRows < 0)
        {
          $responseString = 'Query returned an error';
          echo $responseString;
        }
        return $responseString;
    }

    //create new channel for a workspace
    public function createNewChannel($channelName, $purpose, $type, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $responseString = NULL;
      $affectedRows = $this->homeModelVar->createChannel($channelName, $purpose, $type, $workspaceUrl);
      if ($affectedRows == 0)
      {
        $responseString = "Channel ".$channelName." not created";
        echo $responseString;
      } else if ($affectedRows < 0)
      {
        $responseString = 'Query returned an error';
        echo $responseString;
      }
      return $responseString;
    }

    //add list of users to a channel
    public function inviteUsersToChannel($users, $channelName, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $invitationResults = array('success' => array(), 'failed' => array());
      foreach ($users as $userId) {
        $successFeeds = $this->homeModelVar->addUserToChannel($userId, $channelName, $workspaceUrl);
        if ($successFeeds < 1) {
          array_push($invitationResults['failed'], $userId." ".$channelName);
        } else {
          array_push($invitationResults['success'], $userId." ".$channelName);
        }
      }
      return $invitationResults;
    }

    public function getRepliesForThread($threadId) {
      $this->homeModelVar = new HomeModel();
      $responseString = NULL;
      $replyList = array();
      $replyList = $this->homeModelVar->retrieveReplies($threadId);
      if (empty($replyList)) {
        echo "No replies found for the thread";
      }
      return $replyList;
    }

  }
?>
