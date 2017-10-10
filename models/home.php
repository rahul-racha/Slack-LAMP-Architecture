<?php
  include_once '../errors.php';
  require_once('../models/connect.php');

  class HomeModel {
    private $dbConVar;
    private $channels = array();
    private $messages = array();

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

      $dbConVar->closeConnectionObject($conn);
      return $this->channels;
    }

    public function retrieveMessages($channelName)
    {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();
      $this->messages = array();
      $retMessages = "SELECT channel_id, user_id, message, created_time
                      FROM channel_messages
                      WHERE channel_id
                      IN (
                      SELECT channel_id
                      FROM workspace_channels
                      WHERE channel_name = '$channelName'
                      )";
      $result = mysqli_query($conn, $retMessages);
      if (mysqli_num_rows($result) > 0)
      {
          while ($row = $result->fetch_assoc())
          {
            array_push($this->messages, $row);
          }
      }
      $dbConVar->closeConnectionObject($conn);
      return $this->messages;
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
      unset($result);

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
        unset($result);
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
  }

?>
