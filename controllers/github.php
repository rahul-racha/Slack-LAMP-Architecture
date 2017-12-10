<?php
include_once $_SESSION['basePath'].'errors.php';
require_once $_SESSION['basePath'].'models/login.php';
  class GithubAuth {
    private $clientID = 'ce65d405e8f8a5c1c267';
    private $clientSecret = '27522caa6d424736ec1e0d875a89082184dc5142';
    private $authorizeURL = 'https://github.com/login/oauth/authorize';
    private $tokenURL = 'https://github.com/login/oauth/access_token';
    private $apiURLBase = 'https://api.github.com/';
    private $scope = 'user';
    private $loginModelVar;
    // private $githubModelVar;
    // private $forParams;
    // private $forToken;

    public function __construct() {
      $this->loginModelVar = new LoginModel();
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
      if($post) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
      }
      $headers[] = 'Accept: application/json';
      if(isset($_SESSION['access_token'])) {
        $headers[] = 'Authorization: token ' . $_SESSION['access_token'];
        $headers[] = 'User-Agent: slack-lamp';
      }
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
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
      }
    }

    public function processUser($userDetails, $workspaceUrl) {
      $userID = $userDetails->login;
      $avatarURL = $userDetails->avatar_url;
      $firstName =  $userDetails->name;
      $lastName = NULL;
      $password = "gituser";
      $email = $userDetails->email;
      $profile = array();
      $result = array();
      $responseString = "true";
      $profile = $this->loginModelVar->checkUserExist($userID, $email);
      if ($profile['user_id'] == NULL && $profile['email'] == NULL)
      {
        $result = $this->loginModelVar->addNewUser($userID, $email, $password, $firstName, $lastName,
        $avatarURL, $workspaceUrl);
        if ($result['userInsRows'] < 1 || $result['workspaceInsRows'] < 1) {
          $responseString = "true";
        } else {
          $responseString = "false";
        }
      }
      return $responseString;
     }

     public function directToHome($userDetails) {
       $userID = $userDetails->login;
       $password = "gituser";
       // $profileInfo = array();
       // $profileInfo = $this->loginModelVar->verifyCredentials($userID, $password);
       // if ($profileInfo[0]["isExists"] == true)
       // {
         $_SESSION['userid'] = $userID;
         $_SESSION['password'] = $password;
         $_SESSION['userRole'] = "user";
         header("location:home.php");
       // } else {
       //
       //   $_SESSION['invalidCredentials'] = 'true';
       //   $_SESSION['reason'] = 'password';
       //   session_write_close();
       //   header("location:views/login.php", true, 303);
       //   //include './views/login.php';
       // }
     }

  }
?>
