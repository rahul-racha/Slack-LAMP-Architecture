<?php
  session_start();
  $_SESSION["basePath"] = "../";
  //require_once $_SESSION['basePath'].'controllers/home.php';
  $userID = NULL;
  if (!empty($_GET['userID'])) {
    $userID = $_GET['userID'];
  } else {
    $_SESSION['invalidCredentials'] = 'true';
    $_SESSION['reason'] = 'mail';
    header("location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Two Factor Authentication</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <form method="post" action="<?php echo htmlspecialchars('./router.php'); ?>">
            <input id="token_string" type="text" name="token_string" placeholder="token">
            <input id="userID" type="hidden" name="userID" value="<?php echo $userID; ?>">
            <input type="submit" value="submit">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
