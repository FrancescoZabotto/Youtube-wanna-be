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
<body style="width: 100%;">
<div class="video-container">
    <video id="myVideo" controls>
        <source src="<?php echo $actual_link; ?>" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
    <h2><?php echo $titolo; ?></h2>
    <p><?php echo $descrizione; ?></p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium animi debitis obcaecati nesciunt tempora deleniti sapiente corrupti assumenda ratione nisi in aperiam, veritatis illum voluptatem. Quae et quas mollitia explicabo.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, eos? Sunt, voluptate. Delectus voluptate nulla sapiente aspernatur voluptatum, error mollitia, rerum praesentium hic perferendis molestiae. Provident dolore reprehenderit soluta fuga?</p>
    <br>
    
    

    

    <script>
        var video = document.getElementById("myVideo");
        video.play();
    </script>
</body>
</html> 