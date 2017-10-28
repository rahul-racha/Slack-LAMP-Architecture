<?php
  //ob_start();
  //session_start();

  //retrieve public channels
  //retrieve private channels for a user in workspace
  //identify if a channel is public or private
  

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

    public function insertMessage($channelName, $message)
    {
        $this->homeModelVar = new HomeModel();
        //$message = $this->homeModelVar->validateInputs($message);
        $affectedRows = $this->homeModelVar->insertMessage($channelName, $message);

        if ($affectedRows == 0)
        {
            echo 'Message not inserted';
        } else if ($affectedRows < 0)
        {
          echo 'Query returned an error';
        }
    }

    //create new channel for a workspace
    public function createNewChannel($channelName, $purpose, $type, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $affectedRows = $this->homeModelVar->createChannel($channelName, $purpose, $type, $workspaceUrl);
      if ($affectedRows == 0)
      {
          echo "Channel ".$channelName." not created";
      } else if ($affectedRows < 0)
      {
        echo 'Query returned an error';
      }
    }

    //add list of users to a channel
    public function inviteUsersToChannel($users, $channelName, $workspaceUrl) {
      $this->homeModelVar = new HomeModel();
      $invitationResults = array('success' => array(), 'failed' => array());
      foreach ($users as $userId) {
        $successFeeds = $this->homeModelVar->addUserToChannel($userId, $channelName, $workspaceUrl);
        if ($successFeeds < 1) {
          array_push($invitationResults['failed'], $userId);
        } else {
          array_push($invitationResults['success'], $userId);
        }
      }
      return $invitationResults;
    }



  }
?>
