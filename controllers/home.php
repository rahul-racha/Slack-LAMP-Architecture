<?php
  include_once '../errors.php';
  require_once '../models/home.php';

  session_start();
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
        $affectedRows = $this->homeModelVar->insertMessage($channelName, $message);
        if ($affectedRows == 0)
        {
            echo 'Message not inserted';
        } else if ($affectedRows < 0)
        {
          echo 'Query returned an error';
        }
    }
  }
?>
