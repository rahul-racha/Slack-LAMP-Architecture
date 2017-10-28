<?php
  session_start();
  $_SESSION["basePath"] = "./";
  session_write_close();
  require_once('./controllers/login.php'); 
  $loginControllerVar = new LoginController();
  $loginControllerVar->handleCredentials();
?>
