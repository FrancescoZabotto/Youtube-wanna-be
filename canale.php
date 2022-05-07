<?php
require "base.php";
if(isset( $_SESSION['username'])){

    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //da modificare
    $iscritti = "SELECT COUNT(iscrizioni_persona.canaleuser) FROM iscrizioni_persona
    WHERE iscrizioni_persona.iscrivente='$username'";

    $sql1 = "SELECT * FROM utenti 
    INNER JOIN canale ON canale.username=utenti.username";

    $sql2="SELECT iscrizioni_persona.canaleuser FROM iscrizioni_persona
    WHERE iscrizioni_persona.iscrivente='$username';";


    /*$result = $conn->query($sql1);
    var_dump($result);
    echo $result;*/
    /*if($result->num_rows > 0){
       
        

    }*/


}
?>
<!DOCTYPE html>
<html>
<body>
<a href="unset.php">unset</a>
</body>
</html>

<?php

?>