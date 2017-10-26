<?php
  include_once './errors.php';
  require_once './models/connect.php';

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

    // public function checkUserExist($userId, $email)
    // {
    //   //$userIdTmp = NULL;
    //   //$emailTmp = NULL
    //   $profile = array();
    //   $dbConVar = new dbConnect();
    //   $conn = $dbConVar->createConnectionObject();

    //   $isUserExists = "SELECT user_id, email
    //                    FROM user_info
    //                    WHERE user_id = '$userId'";
    //   $result = mysqli_query($conn, $isUserExists);
    //   if (mysqli_num_rows($result) > 0)
    //   {
    //     while ($row = $result->fetch_assoc())
    //     {
    //       array_push($profile, $row['user_id']);
    //     }
    //   }
    //   mysqli_free_result($result);

    //   $isEmailExists = "SELECT user_id, email
    //                    FROM user_info
    //                    WHERE email = '$email'";
    //   $result = mysqli_query($conn, $isEmailExists);
    //   if (mysqli_num_rows($result) > 0)
    //   {
    //     while ($row = $result->fetch_assoc())
    //     {
    //       array_push($profile, $row['email']);
    //     }
    //   }
    //   mysqli_free_result($result);
    //   return $profile;
    // }

    // public function addUserToWorkspace($userId, $workspaceUrl, $createdBy)
    // {
    //   $dbConVar = new dbConnect();
    //   $conn = $dbConVar->createConnectionObject();

    //   $stmt = $conn->prepare("INSERT INTO workspace (url, user_id, created_by)
    //                           VALUES (?,?,?)");
    //   $stmt->bind_param("sss", $workspaceUrl, $userId, $createdBy);
    //   $stmt->execute();
    //   $affectedRows = $stmt->affected_rows;
    //   $stmt->close();
    //   $dbConVar->closeConnectionObject($conn);
    //   return $affectedRows;
    // }

    // public function addNewUser($userId, $email, $password, $firstName, $lastName, $workspaceUrl)
    // {
    //   $dbConVar = new dbConnect();
    //   $conn = $dbConVar->createConnectionObject();

    //   $stmt = $conn->prepare("INSERT INTO user_info (user_id, password, first_name, last_name, email)
    //                           VALUES (?,?,?,?,?)");
    //   $stmt->bind_param("sssss", $userId, $password, $firstName, $lastName, $email);
    //   $stmt->execute();
    //   $affectedRows = $stmt->affected_rows;
    //   $stmt->close();
    //   $createdBy = 0;
    //   $isAddedToWrk = addUserToWorkspace($userId, $workspaceUrl, $createdBy);
    //   $dbConVar->closeConnectionObject($conn);
    //   return $affectedRows;
    // }

  }
?>
