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
    <link rel="stylesheet" href="css/twoFA.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8 well client_twoFA_wrapper">
          <h4>Enter the Code</h4>
          <p>An email with verification code was just sent to your email. The code expires in 5 minutes. </p>
          <form method="post" action="<?php echo htmlspecialchars('./router.php'); ?>">
            <input id="token_string" class="client_twoFA_input_tag" type="text" name="token_string" placeholder="">
            <input id="userID" type="hidden" name="userID" value="<?php echo $userID; ?>">
            <input type="submit" class="client_twoFA_submit" value="submit">
          </form>
        </div>
        <div class="col-xs-2"></div>
      </div>
    </div>
  </body>
</html>
