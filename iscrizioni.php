<?php  
session_start();

if(isset($_SESSION["username"]) && isset($_SESSION["canaleprincipale"]))
{

    $username = $_SESSION["username"];
    $canaleprincipale = $_SESSION["canaleprincipale"];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `iscrizioni_persona`
            WHERE iscrivente='$username'
            AND canaleuser='$canaleprincipale'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $sql1="DELETE FROM `iscrizioni_persona` WHERE iscrizioni_persona.iscrivente = '$username' AND iscrizioni_persona.canaleuser = '$canaleprincipale'";
        $conn->query($sql1);
    }
    else{
        $sql1="INSERT INTO `iscrizioni_persona` (`iscrivente`, `canaleuser`) VALUES ('$username', '$canaleprincipale')";
        $conn->query($sql1);
    }

    if(isset($_SERVER['HTTP_REFERER'])){      
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    else{
        header('Location: home');
    }
}
else{
    header("Location: home");
}

?>
