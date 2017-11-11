<?php
session_start();
  $_SESSION['basePath'] = '../';
  //session_write_close();

require_once $_SESSION['basePath'].'controllers/home.php';
$homeControlVar = new HomeController();


if (isset($_POST['msgId']) && isset($_POST['emoName'])) {
    // echo "Hello I'm here";
    $reactionResponse = array();

    global $homeControlVar;
    //$reactionsData = array();
    //$reactionsData=json_decode(stripslashes($_POST['reactionsData']));
    $msgId=$_POST['msgId'];
    $emoName =$_POST['emoName'];
    $reactionHandling = $homeControlVar->handleReactionForMsg($msgId, $emoName);
    $reactionResponse = $homeControlVar->getReactionInfoForMsg($msgId, $emoName);
    // var_dump($reactionResponse);
    echo $reactionResponse['count'];

  }
  if (isset($_POST['msgId']) && $_POST['emoName']) {
    $reactionResponse = array();
    global $homeControlVar;
    //$reactionsData = array();
    //$reactionsData=json_decode(stripslashes($_POST['reactionsData']));
    $msgId=$_POST['msgId'];
    $emoName =$_POST['emoName'];
    $checkOtherArr = array();
    $checkOtherArr = $homeControlVar->getReactionInfoForMsg($msgId, $emoName);
    $checkOther = array();
    $checkOther = $checkOtherArr['users'];
    $userInfo = $homeControlVar->isUserExistsForReaction($checkOther);
    // echo $userInfo;
    if($userInfo == true)
    {
      $reactionResponse = $homeControlVar->handleReactionForMsg($msgId, $emoName);
      echo $reactionResponse['count'];
    }
    else{
      echo "error";
    }
  }

?>
