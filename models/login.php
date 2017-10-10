<?php
  require_once('./models/connect.php');

  class LoginModel {
    private $dbConVar;

    public function validateInputs($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    public function verifyCredentials($userid, $password)
    {
        $isExists = NULL;
        $dbConVar = new dbConnect();
        $conn = $dbConVar->createConnectionObject();
        $userid = mysqli_real_escape_string($conn, $userid);
        $password = mysqli_real_escape_string($conn, $password);
        $isUserExists = "SELECT user_id, password
                         FROM user_info
                         where user_id = '$userid' AND password = '$password'";
        $result = mysqli_query($conn, $isUserExists);
        //var_dump($result);
        if (mysqli_num_rows($result) > 0) {
          $isExists = true;
        } else {
         $isExists = false;
        }
        $dbConVar->closeConnectionObject($conn);
        return $isExists;
    }
  }
?>
