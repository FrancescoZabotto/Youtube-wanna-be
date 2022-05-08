<?php
session_start();

$Dativideo = array();

$conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }


if(isset($_SESSION['username'])){
    //prendi i video dei canali a cui si è registrato
    $username = $_SESSION['username'];
    $sql1 = "SELECT video_id,username,titolo,videoview,datains FROM video
    WHERE username = '$username'
    ORDER BY video.datains DESC LIMIT 8";
    $result = $conn->query($sql1);
    if($result->num_rows != 0){
        $TOT=array();
    while($row = $result->fetch_assoc()){
            $TOT[] = $row;
    }   
        $Dativideo['user'] = $TOT;
    }
}

//$sql2 = "SELECT * FROM video WHERE video.idvideo NOT IN (SELECT video.idvideo FROM video INNER JOIN iscrizioni_persona ON iscrizionipersona.idvideo=video.idvideo WHERE iscrizionipersona.username='$username')";
$sql2= "SELECT video_id,username,titolo,videoview,datains FROM video  
INNER JOIN categorie_video USING (video_id)
WHERE categorie_video.categorie='videogiochi'
ORDER BY video.datains DESC LIMIT 8";
$result = $conn->query($sql2);
if($result->num_rows != 0){
    $TOT=array();
    while($row = $result->fetch_assoc()){
        $TOT[] = $row;
    }
    $Dativideo['videogiochi'] = $TOT;
}

$sql2= "SELECT video_id,username,titolo,videoview,datains FROM video  
INNER JOIN categorie_video USING (video_id)
WHERE categorie_video.categorie='cucina'
ORDER BY video.datains DESC LIMIT 8";
$result = $conn->query($sql2);
if($result->num_rows != 0){
    $TOT=array();
    $n=1;
    while($row = $result->fetch_assoc()){
        $TOT[$n] = $row;
        $n++;
    }
    $Dativideo['cucina'] = $TOT;
}

$sql2= "SELECT video_id,username,titolo,videoview,datains FROM video  
INNER JOIN categorie_video USING (video_id)
WHERE categorie_video.categorie='sport'
ORDER BY video.datains DESC LIMIT 8";
$result = $conn->query($sql2);
if($result->num_rows != 0){
    $TOT=array();
    $n=1;
    while($row = $result->fetch_assoc()){
        $TOT[$n] = $row;
        $n++;
    }
    $Dativideo['sport'] = $TOT;
}

$sql2= "SELECT video_id,username,titolo,videoview,datains FROM video  
INNER JOIN categorie_video USING (video_id)
WHERE categorie_video.categorie='musica'
ORDER BY video.datains DESC LIMIT 8";
$result = $conn->query($sql2);
if($result->num_rows != 0){
    $TOT=array();
    $n=1;
    while($row = $result->fetch_assoc()){
        $TOT[$n] = $row;
        $n++;
    }
    $Dativideo['musica'] = $TOT;
}

$sql2= "SELECT video_id,username,titolo,videoview,datains FROM video  
INNER JOIN categorie_video USING (video_id)
WHERE categorie_video.categorie='anime'
ORDER BY video.datains DESC LIMIT 8";
$result = $conn->query($sql2);
if($result->num_rows != 0){
    $TOT=array();
    $n=1;
    while($row = $result->fetch_assoc()){
        $TOT[$n] = $row;
        $n++;
    }
    $Dativideo['anime'] = $TOT;
}

$JSON = json_encode($Dativideo);

echo $JSON;

?>