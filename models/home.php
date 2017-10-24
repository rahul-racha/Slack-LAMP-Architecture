<?php
  include_once '../errors.php';
  require_once('../models/connect.php');

  class HomeModel {
    private $dbConVar;
    private $channels = array();
    private $messages = array();

    public function validMySQL($var) {
      $var=stripslashes($var);
      $var=htmlentities($var);
      $var=strip_tags($var);
      $var=mysql_real_escape_string($var);
      return $var;
    }
    public function retrieveChannels()
    {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();
      $this->channels = array();
      $retChannels = "SELECT channel_name
                      FROM workspace_channels
                      WHERE channel_id IN (
                      SELECT DISTINCT channel_id
                      FROM inside_channel
                      WHERE user_id = '".$_SESSION['userid']."')";
      $result = mysqli_query($conn, $retChannels);
      if (mysqli_num_rows($result) > 0)
      {
        while ($row = $result->fetch_assoc())
        {
            array_push($this->channels, $row['channel_name']);
        }
      }
      mysqli_free_result($result);
      $dbConVar->closeConnectionObject($conn);
      return $this->channels;
    }

    public function retrieveMessages($channelName)
    {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();
      $this->messages = array();
      $retMessages = "SELECT channel_id, channel_messages.user_id, first_name, last_name, message, created_time
                      FROM channel_messages INNER JOIN user_info on channel_messages.user_id = user_info.user_id
                      WHERE channel_id
                      IN (
                      SELECT channel_id
                      FROM workspace_channels
                      WHERE channel_name = '$channelName')
                      ORDER BY created_time ASC";
      $result = mysqli_query($conn, $retMessages);
      if (mysqli_num_rows($result) > 0)
      {
          while ($row = $result->fetch_assoc())
          {
            array_push($this->messages, $row);
          }
      }
      if ($result) {
      mysqli_free_result($result);
      }
      $dbConVar->closeConnectionObject($conn);
      return $this->messages;
    }

    public function validateInputs($data) {
      $data = trim($data);
      //$data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    public function insertMessage($channelName, $message)
    {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();
      $affectedRows = NULL;
      $chId = NULL;
      $getChannelId = "SELECT channel_id
                       FROM workspace_channels
                       WHERE channel_name = '$channelName'";
      $result = mysqli_query($conn, $getChannelId);
      if (mysqli_num_rows($result) > 0)
      {
        while ($row = $result->fetch_assoc())
        {
          $chId = $row['channel_id'];
        }
      }
      mysqli_free_result($result);

      if ($chId != NULL)
      {
        $msgId = 0;
        $getMsgId = "SELECT msg_id
                     FROM channel_messages
                     ORDER BY msg_id
                     DESC LIMIT 1";
        $result = mysqli_query($conn, $getMsgId);
        if (mysqli_num_rows($result) > 0)
        {
          while ($row = $result->fetch_assoc())
          {
            $msgId = $row['msg_id'];
          }
        }
        mysqli_free_result($result);
        $msgId++;
        $stmt = $conn->prepare("INSERT INTO channel_messages (channel_id, user_id, msg_id, message)
                                VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $chId, $_SESSION['userid'], $msgId, $message);
        $stmt->execute();
        //if ($stmt->affected_rows > 0) {}
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
      }
      $dbConVar->closeConnectionObject($conn);
      return $affectedRows;
    }

    public function addUserToChannel($userId, $channelName, $workspaceUrl)
    {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();
      $channelId = NULL;
      $affectedRows = NULL;
      $getChannelId = "SELECT channel_id
                       FROM workspace_channels
                       WHERE channel_name = '$channelName' AND url = '$workspaceUrl'";
      $result = mysqli_query($conn, $getChannelId);
      if (mysqli_num_rows($result) > 0)
      {
        while ($row = $result->fetch_assoc())
        {
          $channelId = $row['channel_id'];
        }
      }
      mysqli_free_result($result);
      if ($channelId != NULL) {
        $stmt = $conn->prepare("INSERT INTO inside_channel (channel_id, user_id)
                                VALUES (?,?)");
        $stmt->bind_param("ss", $channelId, $userId);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
      }
      $dbConVar->closeConnectionObject($conn);
      return $affectedRows;
    }

    public function createChannel($channelName, $purpose, $type, $workspaceUrl) {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();

      $stmt = $conn->prepare("INSERT INTO workspace_channels (channel_id, channel_name, purpose, url, user_id, type)
                              VALUES (?,?,?,?,?,?)");
      $stmt->bind_param("ssssss", NULL, $channelName, $purpose, $workspaceUrl, $_SESSION['userid'], $type);
      $stmt->execute();
      $affectedRows = $stmt->affected_rows;
      $stmt->close();

      $isUserAdded = addUserToChannel($_SESSION['userid'], $channelName, $workspaceUrl);
      $dbConVar->closeConnectionObject($conn);
      return $isUserAdded;
    }
  }

?>
