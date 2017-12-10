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
    global $redirect_uri;
    $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
    unset($_SESSION['access_token']);
    $_SESSION['code'] = "OOPS";
    $githubControlVar->sendRequestParams($_SESSION['state'], $redirect_uri, NULL);
    die();
  }

  if (isset($_GET['code']) && !empty($_GET['code'])) {
    global $redirect_uri;
    $_SESSION['code'] = "ENTERED CODE";
    if(!isset($_GET['state']) || $_SESSION['state'] != $_GET['state']) {
      $_SESSION['code'] = "ERROR STATE";
      header('location:login.php');
      die();
    }
    $_SESSION['code'] = "YES:".$_GET['code'];
    $githubControlVar->sendRequestParams($_SESSION['state'], $redirect_uri, $_GET['code']);
  }

  if (isset($_SESSION['access_token'])) {
    $_SESSION['code'] = "IN THE USER";
    // $params = array('access_token' => $_SESSION['access_token']);
    // $queryString = http_build_query($params);
    // $httpBody = array(
    //   'method' => 'GET',
    //   //'header' => "Accept: application/json\r\n".
    //   //            "Authorization: token ".$_SESSION['access_token']."\r\n",
    //   'content' => $queryString
    // );
    // $httpReq = array('https' => $httpBody);
    // $context = stream_context_create($httpReq);
    //
    // $response = file_get_contents('https://api.github.com/user',false,$context);
    // $_SESSION['code'] = "HABIBI";
    //$userDetails = array();
    //$userDetails = header('Location:https://api.github.com/user' . '?' . http_build_query($params));//;

    //$_SESSION['userDetails'] = $githubControlVar->apiRequest();
    $url = 'https://api.github.com/user';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $headers[] = 'Accept: application/json';
    $headers[] = 'Authorization: token ' . $_SESSION['access_token'];
    $headers[] = 'User-Agent: slack-lamp';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $c, CURLOPT_SSL_VERIFYHOST, false );
    $response = curl_exec($ch);
    $_SESSION['userDetails'] = $response;


    echo '<h3>Logged In</h3>';
    echo '<h4>' . $userDetails->name . '</h4>';
    echo '<pre>';
    print_r($_SESSION['userDetails']);
    print_r("HMM");
    echo '</pre>';
    $_SESSION['code'] = " ***THE END**";
  }

// define('OAUTH2_CLIENT_ID', 'ce65d405e8f8a5c1c267');
// define('OAUTH2_CLIENT_SECRET', '27522caa6d424736ec1e0d875a89082184dc5142');
//
// $authorizeURL = 'https://github.com/login/oauth/authorize';
// $tokenURL = 'https://github.com/login/oauth/access_token';
// $apiURLBase = 'https://api.github.com/';
//
// session_start();
//
// // Start the login process by sending the user to Github's authorization page
// if(get('action') == 'login') {
//   // Generate a random hash and store in the session for security
//   $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
//   unset($_SESSION['access_token']);
//
//   $params = array(
//     'client_id' => OAUTH2_CLIENT_ID,
//     'redirect_uri' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
//     'scope' => 'user',
//     'state' => $_SESSION['state']
//   );
//
//   // Redirect the user to Github's authorization page
//   header('Location: ' . $authorizeURL . '?' . http_build_query($params));
//   die();
// }
//
// // When Github redirects the user back here, there will be a "code" and "state" parameter in the query string
// if(get('code')) {
//   // Verify the state matches our stored state
//   if(!get('state') || $_SESSION['state'] != get('state')) {
//     header('Location: ' . $_SERVER['PHP_SELF']);
//     die();
//   }
//
//   // Exchange the auth code for a token
//   $token = apiRequest($tokenURL, array(
//     'client_id' => OAUTH2_CLIENT_ID,
//     'client_secret' => OAUTH2_CLIENT_SECRET,
//     'redirect_uri' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
//     'state' => $_SESSION['state'],
//     'code' => get('code')
//   ));
//   $_SESSION['access_token'] = $token->access_token;
//
//   header('Location: ' . $_SERVER['PHP_SELF']);
// }
//
// if(session('access_token')) {
//   $user = apiRequest($apiURLBase . 'user');
//
//   echo '<h3>Logged In</h3>';
//   echo '<h4>' . $user->name . '</h4>';
//   echo '<pre>';
//   print_r($user);
//   echo '</pre>';
//
// } else {
//   echo '<h3>Not logged in</h3>';
//   echo '<p><a href="?action=login">Log In</a></p>';
// }
//
//
// function apiRequest($url, $post=FALSE, $headers=array()) {
//   $ch = curl_init($url);
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//
//   if($post)
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
//
//   $headers[] = 'Accept: application/json';
//
//   if(session('access_token'))
//     $headers[] = 'Authorization: token ' . session('access_token');
//
//   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//   $response = curl_exec($ch);
//   return json_decode($response);
// }
//
// function get($key, $default=NULL) {
//   return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
// }
//
// function session($key, $default=NULL) {
//   return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
// }

?>
