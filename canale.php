<?php
require "base.php";
?>

<?php
if(isset( $_SESSION['username'])){

    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //da modificare
    $sql = "SELECT * FROM utenti 
    INNER JOIN canale ON canale.username=utenti.username 
    INNER JOIN video ON video.username=utenti.username
    INNER JOIN iscrizioni_persona ON iscrizionipersona.username=utenti.username
    INNER JOIN impostazioni ON impostazioni.username=utenti.username 
    WHERE username = '$username'";

    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
       
        

    }


}

?>