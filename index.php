<?php
require "base.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    echo $username;

    //session_unset();

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    /* la chiamo sia qui che su canale, prova a vedere se riesci a chiamarla una volta sola */
    $sql = "SELECT * FROM utenti 
    INNER JOIN canale ON canale.username=utenti.username 
    INNER JOIN video ON video.username=utenti.username
    INNER JOIN iscrizioni_persona ON iscrizionipersona.username=utenti.username
    INNER JOIN impostazioni ON impostazioni.username=utenti.username 
    WHERE username = '$username'";
    /*$result = $conn->query($sql);
    if($result->num_rows != 0){
        print_r($result);
        $row=$result->fetch_assoc();
        print_r($row);
    }*/
    /*51:21 https://www.youtube.com/watch?v=4ykAepVkG5Y&t=837s&ab_channel=EasyTutorials*/ 
    //ho cambiato un po di titoli
}

?>
<html>
    <body>

    <nav class="flex-div">
        <div class="nav-left flex-div">
            <img src="static/youtubewhite.png" class="logo">
        </div>
        <div class="nav-middle flex-div">
            <div class="search-box">
                <input type="search" placeholder="Cerca">
                <img src="static/search.png" class="mic-icon">
            </div>
            <img src="static/search.png" class="mic-icon">
        </div>  
        <div class="nav-right flex-div">   
            <img src="static/add.png">
            <img src="static/user.png" class="user-icon">
        </div>   
    </nav>

    <a href="unset.php">unset</a>

    <a href="<?php echo "login"?>">TESTIAMO TUTTO</a>

    <div class="container">
        <div class="banner">
            <img src="static/banner.png">
        </div>
        <div class="video">
            <img src="/static/add.png" alt="" width="32px">
            <div class="video-list" >
                <div class="flex-div">
                    <a href=""><img src="/static/video.png" alt="" width="32px"></a>
                    <div class="video-title">
                        <h3>Titolo video</h3>
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>

