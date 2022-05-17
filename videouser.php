<?php    
session_start();
if(isset($_SESSION["personacanale"])){

$tizio=$_SESSION["personacanale"];

$risultiamo=array();


$conn = new mysqli("localhost", "root", "", "ProjectFinale");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT video_id,username,titolo,videoview,datains FROM video
WHERE username = '$tizio'
ORDER BY video.datains DESC;";

$result = $conn->query($sql);
if($result->num_rows != 0){
while($row = $result->fetch_assoc()){
        $risultiamo[] = $row;
}   
}


$JSON = json_encode($risultiamo);

echo $JSON;

}
else{
    echo NULL;
}
?>