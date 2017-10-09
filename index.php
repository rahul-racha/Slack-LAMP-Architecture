<?php
  require_once('./controllers/login.php');
  $loginControllerVar = new loginController();
  $loginControllerVar->handleCredentials();
?>
