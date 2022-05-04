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

    $sql = "SELECT * FROM user 
    INNER JOIN canale ON canale.username=user.username 
    INNER JOIN iscrizionipersona ON iscrizionipersona.username=user.username 
    INNER JOIN impostazioni ON impostazioni.username=user.username 
    WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
       
        

    }


}

?>