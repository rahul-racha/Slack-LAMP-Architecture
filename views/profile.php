<?php
session_start();
$_SESSION['basePath'] = '../';
require_once $_SESSION['basePath'].'controllers/home.php';

$homeControlVar = new HomeController();
$workspaceUrl = "musicf17.slack.com";
$user_messages_count = NULL;
$emo_count_user = NULL;
$t_rxn_count = NULL;
$t_post_count = NULL;
$user_profile = array();
$metrics = array();

if(isset($_GET['userid'])) {
    global $homeControlVar;
    global $workspaceUrl;
    global $user_profile;
    global $metrics;
    $user_id = $_GET['userid'];
		$user_profile = $homeControlVar->getProfile($user_id, $workspaceUrl);
    $metrics = $homeControlVar->getUserMetrics($user_id, $workspaceUrl);
    // print_r($metrics);
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
		      <img src="<?php echo $user_profile["profile"][0]["avatar"] ?>" style="height:100px;">
        </div>
        <div class="col-xs-7">
          <h3><?php echo $user_profile["profile"][0]["first_name"]."   ".$user_profile["profile"][0]["last_name"]; ?></h3>
          <h6>Email: <?php echo $user_profile["profile"][0]["user_id"]; ?></h6>
          <h6>Channels: </h6>
          <ul style="list-style: none;">
            <?php
              echo "<h6>Public:</h6>";
              //print_r($user_profile["membership"]);
              foreach ($user_profile["membership"] as $value) {
                if($value["type"]== 'Public'){
                 echo "<li>". $value["channel_name"] ."</li>";
                }
              }
              // echo "<h6>Private:</h6>";
              // foreach ($user_profile["membership"] as $value) {
              //   if($value["type"]== "Private") {
              //    echo "<li>". $value['channel_name'] ."</li>";
              //   }
              // }
            ?>
          </ul>

          <ul style="list-style: none;">
            <?php
              $postMetrics = array();
              $postMetrics = $metrics["post"];
              echo "<li><strong>"."Channel -- #Messages"."</strong></li>";
              foreach ($postMetrics as $value) {
                echo "<li>".$value["channel_name"]." -- ".$value["msg_count"]."</li>";
                $user_messages_count += $value["msg_count"];
                // $num_channels++;
              }
            ?>
          </ul>

          <ul style="list-style: none;">
            <?php
            $like_count = 0;
            $dislike_count = 0;
                $rxnMetrics = array();
                $rxnMetrics = $metrics["reaction"];
                print_r($rxnMetrics);
                echo "<li><strong>"."Channel -- #Reactions"."</strong></li>";
                foreach ($rxnMetrics as $value) {
                  if($value["emo_name"] == "like"){
                    $like_count = $value["emo_count"];
                  }
                  else {
                    $dislike_count = $value["emo_count"];
                  }
                  echo "<li>".$value["channel_name"]." -- ". $value["emo_name"]. " -- ". $value["emo_count"]. "</li>";
                  $emo_count_user += $value["emo_count"];
                }
                echo $like_count;
                echo $dislike_count;
                echo $emo_count_user;
            ?>
          </ul>
          <!-- <h6><a href="#">More... </a></h6> -->
          <ul style="list-style: none;">
            <?php
              $relative_post_count = array();
              $relative_post_count = $metrics["relPost"];
              foreach ($relative_post_count as $value) {
                // echo "<li>".$value["channel_name"]." -- ".$value["max_count"]."</li>";
                $r_post_count += $value["max_count"];
              }
            ?>
          </ul>
          <ul style="list-style: none;">
            <?php
              $relative_reaction_count = array();
              $relative_reaction_count = $metrics["relRxn"];
              print_r($relative_reaction_count);
              foreach ($relative_reaction_count as $value) {
                echo "<li>".$value["channel_name"]." -- ".$value["max_rx_count"]."</li>";
                $r_rxn_count += $value["max_rx_count"];
              }
              echo $r_rxn_count;
            ?>
          </ul>
            <?php
              $rxn_percentage = ($emo_count_user / $r_rxn_count)*100;
              $post_percentage = ($user_messages_count / $r_post_count) * 100;
              echo "<h6>Post Metrics: </h6>";
              echo "<div class='star-ratings-sprite'>
                      <span style='width:".$post_percentage."%' class='star-ratings-sprite-rating'></span>
                    </div>
                    <span style='margin-left:2%;'>".$post_percentage."%</span>";
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
              echo "<div class='star-ratings-sprite'>
                      <span style='width:".$rxn_percentage."%' class='star-ratings-sprite-rating'></span>
                    </div>
                    <span style='margin-left:2%;'>".$rxn_percentage."%</span>
                    <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
                    <span>".$like_count."</span>
                    <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
                    <span>".$dislike_count."</span>";

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


<!--
<div>
  <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
  <span>".$emo_count_user."</span>
  <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
</div> -->
