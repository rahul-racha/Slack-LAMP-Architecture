<?php
session_start();
  $_SESSION['basePath'] = '../';
  session_write_close();

require_once $_SESSION['basePath'].'controllers/home.php';
$homeControlVar = new HomeController();


if (isset($_POST['reactionsData'])) {
    // echo "Hello I'm here";
    $reactionResponse = array();

    global $homeControlVar;
    $reactionsData=$_POST['reactionsData'];
    $msgId=$reactionsData['msgId'];
    $emoName =$reactionsData['emoName'];
    $reactionHandling = $homeControlVar->handleReactionForMsg($msgId, $emoName);
    $reactionResponse = $homeControlVar->getReactionInfoForMsg($msgId, $emoName);
    // var_dump($reactionResponse);
    echo $reactionResponse["count"];

  }
  if (isset($_POST['checkReactions'])) {
    $reactionResponse = array();
    global $homeControlVar;
    $reactionsData=$_POST['reactionsData'];
    $msgId=$reactionsData['msgId'];
    $emoName =$reactionsData['emoName'];
    $checkOtherArr = array();
    $checkOtherArr = $homeControlVar->getReactionInfoForMsg($msgId, $emoName);
    $checkOther = $checkOther['users'];
    $userInfo = $homeControlVar->isUserExistsForReaction($checkOther);
    // echo $userInfo;
    if($userInfo == 'true')
    {
      $reactionResponse = $$homeControlVar->handleReactionForMsg($msgId, $emoName);
      echo $reactionResponse["count"];
    }
    else{
      echo "error";
    }
  }

?>
