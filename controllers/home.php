<?php
  //ob_start();
  session_start();
  include_once '../errors.php';
  require_once '../models/home.php';

   if (!isset($_SESSION['userid']) || !isset($_SESSION['password']))
   {
     header("location:login.php", true, 303);
   } //else if (isset($_POST["textarea"])) {
  //   header("location:..home.php", true, 303);
  // }

  class HomeController {
    private $homeModelVar;

    public function validateInputs($data) {
      $data = trim($data);
      //$data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

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

    //public function destroyView(){
      //if (!isset($_SESSION))
      //{
        //session_start();
        // session_destroy();
        // header("location:login.php", true, 303);
      //}
    //}
  }
?>
