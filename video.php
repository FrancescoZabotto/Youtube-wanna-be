<?php
require "base.php";
require "navabar.php";

if(isset($_GET['video'])){
    $videoid = $_GET['video'];
}
else
{
    header("Location: home");
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

$sql13="UPDATE video
SET videoview = videoview+1
WHERE video_id = '$videoid';";
$conn->query($sql13);

$sql1 = "SELECT * FROM video
        INNER JOIN canale USING(username) 
        WHERE video_id='$videoid'";
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

    $sql2 = "SELECT COUNT(iscrizioni_persona.iscrivente) AS iscritti FROM iscrizioni_persona
    WHERE iscrizioni_persona.canaleuser='$username'";
    $iscritti="0";

    $result = $conn->query($sql2);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $iscritti=$row['iscritti'];
    }
    else{ $iscritti="ERRORE"; }
    
    $actual_link="./video/".$username."/".$videoid."/"."video".$videoid.".mp4";

    $t="";

    if(isset($_SESSION['username']))
    { $link="iscrizioni.php";
      $_SESSION['canaleprincipale']=$username; 
      
        $f=$_SESSION['username'];

      $sql3 = "SELECT * FROM `iscrizioni_persona`
            WHERE iscrivente='$f'
            AND canaleuser='$username'";
        $result = $conn->query($sql3);

        if($result->num_rows > 0){
            $t="<form method='post' action='".$link."'><button type='submit' class='btn btn-outline-danger'>SEI ISCRITTO</button></form>";
        }
        else{
            $t="<form method='post' action='".$link."'><button type='submit' class='btn btn-danger'>ISCRIVITI</button></form>";
        }   
    }
    else{
        $link="login";
        $t="<form method='post' action='".$link."'><button type='submit' class='btn btn-danger'>ISCRIVITI</button></form>";
    }



?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/video.css?v='<?php echo $version; ?>'">
<link rel="stylesheet" href="./css/test.css">
</head>
<body>

<div class="video-c" > <!--stai attento al paddding con il cell -->
    <div class="container">
    <div class="row">
        <div class="video-container col-12">
            <video id="myVideo" class="video" controls>
                <source src="<?php echo $actual_link; ?>" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
        <div class="video-info">
            <h2><?php echo $titolo; ?></h2>
            <div class="row">
                <div class="col-6"><?php echo "Views: ".$videoview; ?></div>
                <div class="col-3"><?php echo '<img src="./static/hand-thumbs-up.svg"  width="23px" height="23px" onclick="like(this)" fill="currentColor" id=like><div id="count">'.$likes.'</div>'; ?></div>
                <div class="col-3"><?php echo '<img src="./static/hand-thumbs-down.svg"  width="23px" height="23px" onclick="dislike(this)" fill="currentColor" id=dislike><div id="countt">'.$dislikes.'</div>'; ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6"><?php echo "<a href='canaleuser.php?username=".$username."'>".ucwords($username)."</a>";?></div>
                <div class="col-3"><?php echo $iscritti; ?></div>
                <div class="col-3"><?php echo $t; ?></div>
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

        const countlike = document.getElementById("count");
        const countdislike = document.getElementById("countt");
    console.log(document.getElementById("like"));

        //non funzionano
        function like(x){
            var y=x.src;
            if(y == "http://localhost/Normal/static/hand-thumbs-up.svg"){
            x.setAttribute("src","http://localhost/Normal/static/hand-thumbs-up-fill.svg");
            countlike.innerText = parseInt(countlike.innerText) + 1;

            console.log(countlike);

            var z = document.getElementById("dislike");
            if(z=="http://localhost/Normal/static/hand-thumbs-down-fill.svg"){
            z.setAttribute("src","http://localhost/Normal/static/hand-thumbs-down.svg");
            ountdislike.innerText = parseInt(countdislike.innerText) - 1;
            }

            }
            else{
            x.setAttribute("src","http://localhost/Normal/static/hand-thumbs-up.svg");
            countlike.innerText = parseInt(countlike.innerText) - 1;
            }
        }

        function dislike(z){

            var y=z.src;
            if(y == "http://localhost/Normal/static/hand-thumbs-down.svg"){
            z.setAttribute("src","http://localhost/Normal/static/hand-thumbs-down-fill.svg");
            countdislike.innerText = parseInt(countdislike.innerText) + 1;

            var m = document.getElementById("like");
            if(m=="http://localhost/Normal/static/hand-thumbs-up-fill.svg"){
            m.setAttribute("src","http://localhost/Normal/static/hand-thumbs-up.svg");
            countlike.innerText = parseInt(countlike.innerText) - 1;
            }

            }
            else{
            z.setAttribute("src","http://localhost/Normal/static/hand-thumbs-down.svg");
            ountdislike.innerText = parseInt(countdislike.innerText) - 1;
            }
        }

        
    </script>
</body>
</html> 
