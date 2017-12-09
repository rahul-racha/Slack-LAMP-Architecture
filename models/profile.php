<?php
  include_once $_SESSION['basePath'].'errors.php';
  require_once $_SESSION['basePath'].'models/connect.php';

  class ProfileModel {
    //private $avatarBasePath = "images/users/";

    public function setAvatarPath($filePath, $profileID) {
      $dbConVar = new dbConnect();
      $conn = $dbConVar->createConnectionObject();
      $affectedRows = NULL;
      //$finalPath = $avatarBasePath.$fileName;
      $query = "UPDATE user_info
               SET avatar=?
               WHERE user_id=?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ss", $filePath, $profileID);
      $stmt->execute();
      $affectedRows = $stmt->affected_rows;
      $stmt->close();
      $dbConVar->closeConnectionObject($conn);
      return $affectedRows;
    }
  }
?>
