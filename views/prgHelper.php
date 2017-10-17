<?php
  // session_start();
  // $_SESSION["postFormVars"] = $_POST;
  // header("location:home.php", true, 303);
  // require_once '../controllers/home.php';
  // $homeControlVar = new HomeController();
  // $homeControlVar->displayHomeView();
  session_start();
  session_destroy();
  header("location:login.php", true, 303);
?>
