<?php
  require_once '../controllers/home.php';
?>

<!DOCTYPE html>
  <html>
    <head>
    </head>
    <body>
            <div>
              <?php
                $homeControlVar = new HomeController();
                var_dump($homeControlVar->viewChannels());
                echo "<br/>##################<br/>";
                var_dump($homeControlVar->viewMessages('general'));
                var_dump($homeControlVar->viewMessages('jazz'));
                /*
                echo "<br/>##################<br/>";
                var_dump($homeControlVar->insertMessage('general', 'general - hai Rohit'));
                var_dump($homeControlVar->insertMessage('general', 'general - hai Varsha'));
                var_dump($homeControlVar->viewMessages('general'));
                echo "<br/>##################<br/>";
                var_dump($homeControlVar->insertMessage('jazz', 'jazz - hai Rohit'));
                var_dump($homeControlVar->insertMessage('jazz', 'jazz - hai Varsha'));
                var_dump($homeControlVar->viewMessages('jazz'));
                */
                echo "<br/>##################<br/>";                
              ?>
            </div>
    </body>
  </html>
