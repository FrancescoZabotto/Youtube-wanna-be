<?php
require "base.php";
$actual_link ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$videoid = NULL;
for($i=24; $i<strlen($_SERVER['REQUEST_URI']); $i++){
    if(is_numeric($_SERVER['REQUEST_URI'][$i])){
    $videoid = $videoid.$_SERVER['REQUEST_URI'][$i];
    }
    else{
        break;
    }
}

$conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

$titolo = null;
$username = null;
$datains = null;
$videoview = null;
$likes = null;
$dislikes = null;
$descrizione = null;

$sql1 = "SELECT * FROM video WHERE video_id='$videoid'";
$result = $conn->query($sql1);
    if($result->num_rows != 0){
        $row = $result->fetch_assoc();
        $titolo = $row['titolo'];
        $videoview = $row['videoview'];
        $datains = $row['datains'];
        $username= $row['username'];
        $dislikes = $row['dislikes'];
        $likes = $row['likes'];
        $descrizione = $row['descrizione'];
    }
    else{
        echo "errore";
        header("Location: home");
    }

    $actual_link="./video/".$username."/".$videoid."/"."video".$videoid.".mp4";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/video.css">
</head>
<body>
<div class="video-c"> <!--stai attento al paddding con il cell-->
    <div class="row">
        <div class="video-container">
            <video id="myVideo" class="video" controls>
                <source src="<?php echo $actual_link; ?>" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
        <div class="video-info">
            <h2><?php echo $titolo; ?></h2>
            <div class="row">
                <div class="col-sm-6">views</div>
                <div class="col-sm-3">like</div>
                <div class="col-sm-3">dislike</div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">Canale</div>
                <div class="col-sm-3">iscritti</div>
                <div class="col-sm-3">subscribe</div>
            </div>
            <hr>
            <p><?php echo $descrizione; ?></p>
            <hr>
        </div>
        </div>
    </div>
</div>
    

    <script>
        var video = document.getElementById("myVideo");
        video.play();
    </script>
</body>
</html> 