<!DOCTYPE html>
<html>
  <head>
    <title> Recaptcha </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="./images/favicon.jpg" type="image/gif" sizes="16x16">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
 	    function reCaptchad(){
		      var btn=document.getElementById("captcha_success");
          btn.disabled = false;
	    }
    </script>
  </head>
  <body>
    <div class="row">
      <div class="col-xs-6 col-xs-offset-4">
    <form action="<?php echo htmlspecialchars('update.php'); ?>" method="POST">
      <div class="g-recaptcha" data-sitekey="6Le3TjwUAAAAADDlLXoLoJbaPmiQNWgBeehJ-hiA"
		       data-callback="reCaptchad">
      </div>
      <br/>
      <input id="captcha_success" type="submit" value="Submit" disabled='disabled'>
    </form>
  </div>
  </div>
  </body>
