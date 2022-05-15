<?php
require "base.php";
require "navabar.php";
$version = time(); 
if(isset( $_SESSION['username'])){
    $username = $_SESSION['username'];
    if(strlen($username)>10){
        for($i=0;$i<25;$i++){
            $shortu=$shortu.$username[$i];
        }
        }
        else{
            $shortu=$username;
        }

    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //da modificare
    $sql = "SELECT COUNT(iscrizioni_persona.canaleuser) AS iscritti FROM iscrizioni_persona
    WHERE iscrizioni_persona.iscrivente='$username'";
    $iscritti="0";

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $iscritti=$row['iscritti'];
    }
    else{ $iscritti="ERRORE"; }

    $sql1 = "SELECT SUM(videoview) AS totview,SUM(likes) AS likes,SUM(dislikes) AS dislikes FROM video 
    WHERE video.username='$username'";
    $totview="0";
    $likes="0";
    $dislikes="0";

    $result = $conn->query($sql1);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $totview=$row['totview'];
        $likes=$row['likes'];
        $dislikes=$row['dislikes'];
    }
    else{ 
        $iscritti="ERRORE"; 
        $likes="ERRORE";
        $dislikes="ERRORE";
    }


}
else
{
    header("Location: login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/canale.css?v=<?php echo $version?>">
</head> 
<body>


    <div class="canale-container" style="padding-left:3%;padding-right:3%">
        <h1 style="padding-top:10px;">Benvenuto <?php echo ucwords($shortu); ?></h1>
        <br>
        <h4><a href="canaleuser.php?username=<?php echo $_SESSION['username'];?>" style="color:#f26964;">VAI AL TUO CANALE</a></h4>
        <hr>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3"><h5>ISCRITTI</h5></div>
            <div class="col-12 col-md-6 col-lg-3"><?php echo "<h5>".$iscritti."</h5>"; ?></div>
            <div class="col-12 col-md-6 col-lg-3"><h5>VIEWS</h5></div>
            <div class="col-12 col-md-6 col-lg-3"><?php echo "<h5>".$totview."</h5>"; ?></div>
        </div>
        <br>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3"><h5>LIKE</h5></div>
            <div class="col-12 col-md-6 col-lg-3"><?php echo "<h5>".$likes."</h5>"; ?></div>
            <div class="col-12 col-md-6 col-lg-3"><h5>DISLIKE</h5></div>
            <div class="col-12 col-md-6 col-lg-3"><?php echo "<h5>".$dislikes."</h5>"; ?></div>
        </div>
        <hr>
        <div><h4 class="subt">LE TUE ISCRIZIONI</h4></div>
        <br>
        <!-- <ul>
            <li>AA</li>
            <li>AA</li>
            <li>AA</li>
            <li>AA</li>
            <li>AA</li>
            <li></li>
            <li></li>
        </ul>  -->
    </div>   

    <footer>
        <h4><a href="unset.php" style="color:#f26964;">unset</a></h4>
    </footer>
    <script>
        document.addEventListener("touchstart", function(){}, true);
    </script>
</body>
</html>

<?php

?>