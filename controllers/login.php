<?php
    include $_SESSION['basePath'].'errors.php';
    require_once $_SESSION['basePath'].'models/login.php';
    //require_once $_SESSION['basePath'].'controllers/profile.php';

    class LoginController {
        private $loginModelVar;

        public function __construct() {
          $this->loginModelVar = new LoginModel();
        }

        public function handleCredentials() {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userid'])
            && isset($_POST['password']))
        {
          $userid = $this->loginModelVar->validateInputs($_POST['userid']);
          $password = $this->loginModelVar->validateInputs($_POST['password']);
          $profileInfo = array();
          $profileInfo = $this->loginModelVar->verifyCredentials($userid, $password);
          if ($profileInfo[0]["isExists"] == true)
          {
            if ($profileInfo[0]["two_factor"] == 0) {
              $_SESSION['userid'] = $userid;
              $_SESSION['password'] = $password;
              $_SESSION['userRole'] = $profileInfo[0]["role"];
              header("location:views/home.php#bottom");
              session_write_close();
            } else {
              $_SESSION['userid_pending'] = $userid;
              $_SESSION['password_pending'] = $password;
              $_SESSION['userRole_pending'] = $profileInfo[0]["role"];

              $workspaceUrl = "musicf17.slack.com";
              $sender = "rrach001@odu.edu";
              $recipient = $profileInfo[0]["email"];
              $subject = "Authenticate your account";
              $senderName = "CS-518 Slack Team";
              $recName = $profileInfo[0]["first_name"].' '.$profileInfo[0]["last_name"];
              $tokenInfo = array();
              $tokenInfo = $this->prepareToken($userid, $workspaceUrl);
              if (!empty($tokenInfo) && isset($tokenInfo['result'])
                  && $tokenInfo['result'] == "true" && isset($tokenInfo['token_value'])
                  && isset($tokenInfo['time_span'])) {
                //$token_val = isset($tokenInfo['token_value']) ? $tokenInfo['token_value'] : NULL;
                $result = $this->handleMail($sender, $recipient, $subject, $tokenInfo['token_value'],
                                           $tokenInfo['time_span'], $senderName, $recName);
                if ($result == true) {
                  header('location:views/twoFA.php?userID='.$userid);
                } else {
                  $_SESSION['invalidCredentials'] = 'true';
                  $_SESSION['reason'] = 'mail';
                  header("location:views/login.php");
                }
              } else {
                $_SESSION['invalidCredentials'] = 'true';
                $_SESSION['reason'] = 'mail';
                header("location:views/login.php");
              }
            }
          } else {

            $_SESSION['invalidCredentials'] = 'true';
            $_SESSION['reason'] = 'password';
            session_write_close();
            header("location:views/login.php", true, 303);
            //include './views/login.php';
          }
          exit();
        } else {
          header("location:views/login.php");
          //include './views/login.php';
        }
        exit();
       }

       public function checkValidation($userId, $email, $password, $firstName, $lastName) {
         $isGoodValidation = NULL;
         if (trim($userId) == '' || trim($email) == '' || trim($password) == '' ||
            trim($firstName) == '' || trim($lastName) == '') {
              $isGoodValidation = "false";
         } else if (!(preg_match('/^(?:[A-Z\d][A-Z\d_-]{3,10}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})$/i',
                    $userId, $matches))) {
              $isGoodValidation = "false";
         } else if (!(preg_match('/^(?:[A-Z\d][A-Z\d_-]{3,10}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})$/i',
                    $email, $matches))) {
                $isGoodValidation = "false";
         } else if  (!(preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,15}$/',
                    $password, $matches))) {
                $isGoodValidation = "false";
         } else if  (!(preg_match('/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/',
                    $firstName, $matches))) {
                $isGoodValidation = "false";
         } else if  (!(preg_match('/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/',
                    $lastName, $matches))) {
                $isGoodValidation = "false";
         } else {
           $isGoodValidation = "true";
         }
         return $isGoodValidation;
       }

       public function registerNewUser($userId, $email, $password, $firstName, $lastName, $workspaceUrl)
       {
         $profile = array();
         $result = array();
         $default_property = "404";
         $size = "500";
         $responseString = NULL;

         if ($this->checkValidation($userId, $email, $password, $firstName, $lastName) == "true") {
           $profile = $this->loginModelVar->checkUserExist($userId, $email);
         if ($profile['user_id'] == NULL && $profile['email'] == NULL)
         {
           //$profileControllerVar = new ProfileController();
           $profilePicPath = "images/users/default-profile-pic.jpg";
           $profilePicPath = $this->getGravatar($email, $default_property, $size, $profilePicPath);
           $result = $this->loginModelVar->addNewUser($userId, $email, $password, $firstName, $lastName,
           $profilePicPath, $workspaceUrl);
           if ($result['userInsRows'] < 1 || $result['workspaceInsRows'] < 1) {
             $responseString = $userId." could not be inserted. Please try again.";
           } else {
             $responseString = $userId." is registered successfully. Please login with the new credentials";
           }
         } else {
           $user = $profile['user_id'];
           $mail = $profile['email'];
           if ($profile['user_id'] != NULL) {
             $responseString = $user." exists in the database";
           } else if ($profile['email'] != NULL) {
             $responseString = $mail." exists in the database";
           } else {
             $responseString = $user." and ".$mail." exist in the database";
           }
         }
       } else {
         $responseString = "Validation has failed";
       }
         $_SESSION['registerResponse'] = $responseString;
         header("location:login.php", true, 303);
         return $responseString;
       }


       public function getResponseCode($url) {
         $http_code = NULL;
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
         curl_setopt($ch, CURLOPT_ENCODING ,'identity');
         curl_exec($ch);
         // Check HTTP status code
         if (!curl_errno($ch)) {
           $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
         }
         curl_close($ch);
         return $http_code;
       }

       public function getGravatar($email, $default, $size, $localDefaultPic) {
         $profilePath = NULL;
         $url = 'https://www.gravatar.com/avatar/';
         $url .= md5( strtolower( trim( $email ) ) );
         $url .= "?d=$default&s=$size";
         $http_code = $this->getResponseCode($url);
         if ($http_code == 200) {
           $profilePath = $url;
         } else {
           $profilePath = $localDefaultPic;
         }
         return $profilePath;
       }

       //2-FA member functions
       public function prepareToken($userID, $workspaceUrl) {
         //$tokenString = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
         $tokenString = hash('sha256', mt_rand().$_SERVER['REMOTE_ADDR']);
         $result = "false";
         $span = 5;
         $expire = time() + ($span * 60);
         $expire_format = date("Y-m-d H:i:s", $expire);
         $affectedRows = $this->loginModelVar->updateTokenForUser($userID, $tokenString, $expire_format, $workspaceUrl);
         if ($affectedRows > 0) {
           $result = "true";
         }
         $response = array('result' => $result, 'token_value' => $tokenString, 'time_span' => $span);
         return $response;
       }



       public function handleMail($sender, $recipient, $subject, $token_value,
                                  $time_span, $senderName, $recName) {
         $message = "
          <!DOCTYPE html>
          <html lang='en'>
            <head>
              <title>Slack</title>
            </head>
            <body>
              <h2>Slack Verification</h2>
              <div>
                <p>Enter the token <strong>".$token_value."</strong> to sign in.<br/> The token expires in " .
                $time_span." minutes.
                </p>
              </div>
            </body>
          </html>
         ";
         $headers[] = 'MIME-Version: 1.0';
         $headers[] = 'Content-type: text/html; charset=iso-8859-1';

         // Additional headers
         $headers[] = 'To: '.$recName.' <'.$recipient.'>';
         $headers[] = 'To: '.$senderName.' <'.$sender.'>';
         // Mail it
         $result = mail($recipient, $subject, $message, implode("\r\n", $headers));
         return $result;
       }

       public function verifyUserToken($token_val, $userID, $workspaceUrl) {
         $tokenData = array();
         $isSuccess = array();
         $tokenData = $this->loginModelVar->getTokenForUser($userID, $workspaceUrl);
         if ($token_val == $tokenData[0]['token']) {
           $current_time = date("Y-m-d H:i:s", time());
           if ($current_time < $tokenData[0]['expire_time']) {
             $isSuccess["result"] = "true";
             $isSuccess["message"] = "success";
           } else {
             $isSuccess["result"] = "false";
             $isSuccess["message"] = "token expired";
           }
         } else {
           $isSuccess["result"] = "false";
           $isSuccess["message"] = "invalid token";
         }
         return $isSuccess;
       }
    }

?>
