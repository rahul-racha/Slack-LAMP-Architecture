<?php
session_start();
$_SESSION['basePath'] = '../';
require_once $_SESSION['basePath'].'controllers/home.php';

$homeControlVar = new HomeController();
$user_profile = array();
$metrics = array();
  if(isset($_GET['userid'])){
    global $homeControlVar;
    global $user_profile;
    global $metrics;
		$user_profile = array();
    $user_id = $_GET['userid'];
		$user_profile = $homeControlVar->getProfile($user_id);
    $metrics = $homeControlVar->getUserMetrics($user_id);
    //var_dump($metrics);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/starRating.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  <body>
    <div class="container well">
	    <div class="row-fluid">
        <div class="col-xs-3" >
		      <img src="http://i.axs.com/2014/11/promoted-media-optimized_545bb90b3fc9a.jpg" style="height:100px;">
        </div>
        <div class="col-xs-7">
          <h3><?php echo $user_profile["profile"][0][first_name]."   ".$user_profile["profile"][0][last_name]; ?></h3>
          <h6>Email: <?php echo $user_profile["profile"][0][user_id]; ?></h6>
          <h6>Channels: </h6>
          <ul style="list-style: none;">
            <?php
              echo "<h6>Public:</h6>";
              foreach ($user_profile["membership"] as $value) {
                if($value["type"]== 'Public'){
                 echo "<li>". $value["channel_name"] ."</li>";
                }
              }
              echo "<h6>Private:</h6>";
              foreach ($user_profile["membership"] as $value) {
                if($value["type"]== 'Private'){
                 echo "<li>". $value["channel_name"] ."</li>";
                }
              }
            ?>
          </ul>

          <ul style="list-style: none;">
            <?php
              $postMetrics = array();
              $postMetrics = $metrics["post"];
              // echo "<li><strong>"."Channel -- #Messages"."</strong></li>";
              foreach ($postMetrics as $value) {
                // echo "<li>".$value["channel_name"]." -- ".$value["msg_count"]."</li>";
                $user_messages_count += $value["msg_count"];
                // $num_channels++;
              }
            ?>
          </ul>

          <ul style="list-style: none;">
            <?php
                $rxnMetrics = array();
                $rxnMetrics = $metrics["reaction"];
                // echo "<li><strong>"."Channel -- Emoticon -- #Rxn"."</strong></li>";
                foreach ($rxnMetrics as $value) {
                  // echo "<li>".$value["channel_name"]." -- ". $value["emo_name"]. " -- ". $value["emo_count"]. "</li>";
                  $emo_count_user += $value["emo_count"];
                }
            ?>
          </ul>
          <!-- <h6><a href="#">More... </a></h6> -->
          <ul style="list-style: none;">
            <?php
              $total_reaction_count = array();
              $total_reaction_count = $metrics["treaction"];
              // echo "reaction total";
              foreach ($total_reaction_count as $value) {
                // echo "<li>".$value["channel_name"]." -- ".$value["rxn_count"]."</li>";
                $t_rxn_count += $value["rxn_count"];
              }
            ?>
          </ul>
          <ul style="list-style: none;">
            <?php
              $total_post_count = array();
              $total_post_count = $metrics["tpost"];
              // echo "post total";
              foreach ($total_post_count as $value) {
                // echo "<li>".$value["channel_name"]." -- ".$value["msg_count"]."</li>";
                $t_post_count += $value["msg_count"];
              }
            ?>
          </ul>
          <!-- <ul style="list-style:none;"> -->
            <?php
              $rxn_percentage = ($emo_count_user / $t_rxn_count)*100;
              $post_percentage = ($user_messages_count / $t_post_count) * 100;
              echo "<h6>Post Metrics: </h6>";
              echo "<div class='star-ratings-sprite'><span style='width:".$post_percentage."%' class='star-ratings-sprite-rating'></span></div>";
              // if($rxn_percentage <= 20){
              //   echo "<button type='button' class='btn btn-danger'>Poor <span class='badge'></span></button>";
              // }
              // elseif ($rxn_percentage <=50 && $rxn_percentage >20) {
              //   echo "<button type='button' class='btn btn-primary'>Good <span class='badge'></span></button>";
              // }
              // else {
              //   echo "<button type='button' class='btn btn-success'>Excellent <span class='badge'></span></button>";
              // }
              echo "<h6>Reaction Metrics:</h6>";
              echo "<div class='star-ratings-sprite'><span style='width:".$rxn_percentage."%' class='star-ratings-sprite-rating'></span></div>";
              // echo $rxn_percentage."<br />";
              // echo "<h6>Reaction Metrics:</h6>";
              // if($post_percentage <= 20){
              //   echo "<button type='button' class='btn btn-danger'>Poor <span class='badge'></span></button>";
              // }
              // elseif ($post_percentage <=50 && $post_percentage >20) {
              //   echo "<button type='button' class='btn btn-primary'>Good <span class='badge'></span></button>";
              // }
              // else {
              //   echo "<button type='button' class='btn btn-success'>Excellent <span class='badge'></span></button>";
              // }
              // echo $post_percentage."<br />";
            ?>
          <!-- </ul> -->
        </div>
        <div class="col-xs-2">
          <div class="btn-group">
              <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                  Action
                  <span class="icon-cog icon-white"></span><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="update.php"><span class="icon-wrench"></span> Modify</a></li>
                  <li><a href="#"><span class="icon-trash"></span> Delete</a></li>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
