<?php
    session_start();
      if (isset($_POST["submit"]) && $_SESSION['active'] == 'true') {
      require 'connect.php';
      if (!$conn) {
        die("Conenction failed - ".mysqli_connect_error());
      }

      function directFailedLogin() {
        $_SESSION['invalidCredentials'] = 'true';
        $_SESSION['reason'] = 'password';
        unset($_SESSION['active']);// = 'false';
        header("location:index.php");
      }

      function validateInputs($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $user_id = $password = "";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = validateInputs($_POST["user_id"]);
        $password = validateInputs($_POST["password"]);
      }

      $checkUser = "SELECT user_id, password
                FROM user_info where user_id = '$user_id' AND password = '$password'";
      $result = mysqli_query($conn, $checkUser);
      //var_dump($result);
      if (mysqli_num_rows($result) > 0) {
      //while ($row = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['password'] = $password;
        header("location:home.php");
        exit();
      //}
    } else {
        directFailedLogin();//?invalidCredentials=true&reason=password");
        exit();
    }

    $conn->close();
  } else {
    directFailedLogin();
    exit();
  }
    session_write_close();
?>
