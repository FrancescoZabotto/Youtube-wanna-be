<?php
require "base.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");

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
    //posso fare if con php

    //per il fatto di chiaro o scuro, o fai con la session oppure fai 2 file css chiaro e scuro e ti adatti a mostrare in base all'impostazione
    

    /*$result = $conn->query($sql);
    if($result->num_rows != 0){
        print_r($result);
        $row=$result->fetch_assoc();
        print_r($row);
    }*/
    /*57:48 https://www.youtube.com/watch?v=4ykAepVkG5Y&t=837s&ab_channel=EasyTutorials*/ 
    //ho cambiato un po di titoli
}

?>

<html>
    <body>

    <script>
    var Dativideo;
    var req = new XMLHttpRequest(); 
    fetch("inviavideo.php").then((response) => {
        return response.json();
    }).then((data) => {
        Dativideo = data;
        console.log(Dativideo); //passa i dati dei video
        //ciao(); posso fare le funzioni qui dentro per tenere i dati
        //document.getElementById("video").innerHTML = data; cambio html direttamente da qui
    });   
    </script>
    

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
            <?php if(isset($_SESSION['username'])){echo "<a href='canale'>".$_SESSION['username']."</a>";}else{ echo "<a href='login'><img src='static/user.png' class='user-icon'></a>";}?>      
        </div>   
    </nav>
    
    <div class="container">
        <!-- <div class="banner">
            <img src="static/banner.png">
        </div> -->

        <div class="video">
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt=""  class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    </div>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list">
                <a href="">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div class="video-title">
                        <h3>Titolo video</h3>
                    <div class="video-data">
                        <p>Descrizione video</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 



    </body>
</html>

