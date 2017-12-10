<?php
include_once $_SESSION['basePath'].'errors.php';
require_once $_SESSION['basePath'].'models/github.php';
  class GithubAuth {
    private $clientID = 'ce65d405e8f8a5c1c267';
    private $clientSecret = '27522caa6d424736ec1e0d875a89082184dc5142';
    private $authorizeURL = 'https://github.com/login/oauth/authorize';
    private $tokenURL = 'https://github.com/login/oauth/access_token';
    private $apiURLBase = 'https://api.github.com/';
    private $githubModelVar;
    private $forParams;
    private $forToken;
    private $scope = 'user';
    //private $defaultApiReq = $apiURLBase."user";

    public function __construct() {
      // $this->clientID = ;
      // $this->clientSecret = ;
      // $this->authorizeURL = ;
      // $this->tokenURL = ;
      // $this->apiURLBase = ;
      //$this->githubModelVar = GithubAuthModel();
    }

    function apiRequest($url = 'https://api.github.com/user', $post=FALSE, $headers=array()) {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      if($post)
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
      $headers[] = 'Accept: application/json';
      if(isset($_SESSION['access_token']))
        $headers[] = 'Authorization: token ' . $_SESSION['access_token'];
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
      $_SESSION['jsonresponse'] = json_decode($response);
      return json_decode($response);
    }


    public function sendRequestParams($authState, $redirect_uri, $codeString) {
      if ($codeString == NULL) {
        $params = array(
          'client_id' => $this->clientID,
          'redirect_uri' => $redirect_uri,
          'scope' => $this->scope,
          'state' => $authState
        );
        header('Location: ' . $this->authorizeURL . '?' . http_build_query($params));
      } else {
        $tokenContainer = array(
          'client_id' => $this->clientID,
          'client_secret' => $this->clientSecret,
          'redirect_uri' => $redirect_uri,
          'state' => $authState,
          'code' => $codeString
        );
        $token = $this->apiRequest($this->tokenURL, $tokenContainer);
        $_SESSION['access_token'] = $token->access_token;
        //header('Location: ' . $_SERVER['PHP_SELF']);
      }
    }
  }
?>
