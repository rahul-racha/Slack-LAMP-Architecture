<?php
	session_start();
	$_SESSION['basePath'] = '../';
  require_once $_SESSION['basePath'].'controllers/login.php';
  require_once $_SESSION['basePath'].'controllers/home.php';
  require_once $_SESSION['basePath'].'controllers/profile.php';
  require_once $_SESSION['basePath'].'controllers/github.php';

  $githubControlVar = new GithubAuth();
  $redirect_uri = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

  if (isset($_GET['action']) && $_GET['action'] == "git_auth") {
    $params = array();
    $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);

    unset($_SESSION['access_token']);
    $githubControlVar->sendRequestParams($_SESSION['state'], $redirect_uri, NULL);
    die();
  }

  if (isset($_GET['code']) && !empty($_GET['code'])) {
    if(!isset($_GET['state']) || $_SESSION['state'] != $_GET['state']) {
      header('location:login.php');
      die();
    }
    $githubControlVar->sendRequestParams($_SESSION['state'], $redirect_uri, $_GET['code']);
  }

  if (isset($_SESSION['access_token'])) {
    $userDetails = $githubControlVar->apiRequest();
    echo '<h3>Logged In</h3>';
    echo '<h4>' . $userDetails->name . '</h4>';
    echo '<pre>';
    print_r($user);
    echo '</pre>';
  }



?>
