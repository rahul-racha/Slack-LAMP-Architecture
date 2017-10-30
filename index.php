<?php
  session_start();
  $_SESSION["basePath"] = "./";
  require_once('./controllers/login.php');

  $loginControllerVar = new LoginController();
  $loginControllerVar->handleCredentials();
?>
