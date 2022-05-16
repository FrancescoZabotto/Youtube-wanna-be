<?php
if(isset($_SESSION["possbileiscrizione"]) && isset($_SESSION["username"])){

    $risultiamo="";

$conn = new mysqli("localhost", "root", "", "ProjectFinale");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$canale=$_SESSION['possbileiscrizione'];
$sql1 = "SELECT * FROM iscrizioni_persona WHERE iscrivente='$username' AND canaleuser='$canale'" ; //inserisco le sue iscrizioni sulla session?no

$result = $conn->query($sql1); //base.php prendi cercatore
if($result->num_rows == 0){
    $row = $result->fetch_assoc();
    $sql = "INSERT INTO iscrizioni_persona (iscrivente,canaleuser) VALUES ('$username','$canale')";
    if($conn->query($sql) === TRUE){
        $risultiamo= "OK";
    }
    else{
        $risultiamo= "NOT OK";
    }
}

$JSON = json_encode($risultiamo);

echo $risultiamo;
}

?>