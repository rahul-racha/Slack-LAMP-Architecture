<?php
    include './errors.php';
    require_once './models/login.php';

    class LoginController {
        private $loginModelVar;

        public function __construct() {
          $this->loginModelVar = new loginModel();
        }

        public function handleCredentials() {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userid'])
            && isset($_POST['password']))
        {
          $userid = $this->loginModelVar->validateInputs($_POST['userid']);
          $password = $this->loginModelVar->validateInputs($_POST['password']);
          session_start();
          if ($this->loginModelVar->verifyCredentials($userid, $password) == true)
          {
            $_SESSION['userid'] = $userid;
            $_SESSION['password'] = $password;
            header("location:views/home.php#bottom");
            session_write_close();
            //include './views/home.php';
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

       // public function registerNewUser($userId, $email, $password, $first_name, $last_name, $workspaceUrl)
       // {
       //   $profile = array();
       //   $profile = $this->loginModelVar->checkUserExist($userId, $email);
       //   if (empty($profile))
       //   {
       //     $this->loginModelVar->addNewUser($userId, $email, $password, $first_name, $last_name, $workspaceUrl);
       //   }
       // }
    }

?>
