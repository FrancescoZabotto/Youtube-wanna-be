<?php
if(isset($_POST)){
$Dativideo = array();

$conn = new mysqli("localhost", "root", "", "ProjectFinale");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}



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

$JSON = json_encode($Dativideo);

echo $JSON;
}

?>