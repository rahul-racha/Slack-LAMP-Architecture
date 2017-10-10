<?php
  require_once('./controllers/login.php');
  $loginControllerVar = new LoginController();
  $loginControllerVar->handleCredentials();
?>
