<?php
    include './errors.php';
    require_once './models/login.php';

    class loginController {
        private $loginModelVar;

        public function __construct() {
          $this->loginModelVar = new loginModel();
        }

      public function handleCredentials() {

        if (isset($_REQUEST['userid']) && isset($_REQUEST['password']))
        {
          $userid = $this->loginModelVar->validateInputs($_REQUEST['userid']);
          $password = $this->loginModelVar->validateInputs($_REQUEST['password']);

          if ($this->loginModelVar->verifyCredentials($userid, $password) == true)
          {
            header("location:views/home.php");
            //include './views/home.php';
          } else {
            header("location:views/login.php");
            //include './views/login.php';
          }
          exit();
        } else {
          header("location:views/login.php");
          //include './views/login.php';
        }
        exit();
       }
    }

?>
