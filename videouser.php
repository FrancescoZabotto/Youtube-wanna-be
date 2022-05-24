<?php    
session_start();
function estensione($videoid,$username){
    $img = "video/".$username."/".$videoid."/miniatura".$videoid;
    if(file_exists($img.".jpeg")){
        return ".jpeg";
    }
    else if(file_exists($img.".png")){
        return ".png";
    }
    else if(file_exists($img.".gif")){
        return ".gif";
    }
    else{
        return ".jpg";
    }
}



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
        $row["estensione"]=estensione($row["video_id"],$row["username"]);
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