<?php
session_start();
  $_SESSION['basePath'] = '../';
  session_write_close();

require_once $_SESSION['basePath'].'controllers/home.php';
$homeControlVar = new HomeController();


if (isset($_POST['reactionsData'])) {
    // echo "Hello I'm here";
    $reactionsData=$_POST['reactionsData'];

    $msgId=$reactionsData['msgId'];
    $emoName =$reactionsData['emoName'];
    $isInsert=$reactionsData['isInsert'];
    // echo $msgId;
    // echo $emoName;
    // echo $isInsert;

    $reactionsResponse = $homeControlVar->handleReactionForMsg($msgId, $emoName, $isInsert);
    echo $reactionsResponse;
  }

?>