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
        
        console.log(Dativideo["user"]["1"]["video_id"]);
        
        var espressione = new RegExp('^miniatura[0-9]+\.(jpg|jpeg|png|gif)$');
        var espressione1 = new RegExp('^miniatura.*');

        console.log('video\\'+Dativideo["user"]["1"]["username"]+"\\"+espressione);
        
        for(var i = 1; i < Dativideo["user"].length; i++){
        document.getElementById("video-list"+i).getElementsByTagName("a")[0].href = "video.php?video_id=" + Dativideo["user"][i]["video_id"];

        document.getElementById("video-list"+i).getElementsByTagName("a")[0].getElementsByTagName("img")[0].src = 'video\\'+ Dativideo["user"]["1"]["username"]+"\\"+'^miniatura.*';
        document.getElementById("video-list"+i).getElementsByTagName("a")[0].getElementsByTagName("img")[0].alt = Dativideo["user"][i]["video_id"];
        
        console.log(document.getElementById("video-list1").getElementsByTagName("a")[0].getElementsByTagName("img")[0].src);
        console.log(Dativideo["user"][i]["username"]);


        console.log(Dativideo['user']['1']['titolo']);
        titolo(Dativideo['user']['1']['titolo']);
    }
    });   

    //funzione che mi permette di inserire i dati nei videotitle
    function ciao(){
        var i;
        for(i=0; i<Dativideo.length; i++){
            document.getElementById("video"+i).innerHTML = Dativideo[i].titolo;
        }
        document.getElementById("immvideo"+i).getElementsByTagName("href").innerHTML = Dativideo["user"]["1"]["id"];
    }
    function titolo(titolo){
        
        for(var a=1;a<5; a++){
        document.getElementById("titolo"+a).innerHTML = "sess"; //+2
        document.getElementById("link1").getAttribute("href")= "18";
        }
    };
    </script>
    

    <nav class="flex-div">
        <div class="nav-left flex-div">
            <a href="home"><img src="static/youtubewhite.png" class="logo"></a>
        </div>
        <div class="nav-middle flex-div">
            <div class="search-box">
                <input type="search" placeholder="Cerca">
                <img src="static/search.png" class="mic-icon">
            </div>
            <img src="static/search.png" class="mic-icon">
        </div>  
        <div class="nav-right flex-div">   
            <a href="uploadvideo"><img src="static/add.png"></a>
            <?php if(isset($_SESSION['username'])){echo "<a href='canale'>".$_SESSION['username']."</a>";}else{ echo "<a href='login'><img src='static/user.png' class='user-icon'></a>";}?>      
        </div>   
    </nav>
    
    <div class="container">
        <!-- <div class="banner">
            <img src="static/banner.png">
        </div> -->

        <div class="video">
            <div class="video-list" id="video-list1">
                <a href="" id="link1">
                    <img src="static/video.png" alt="" class="thumbnail">
                </a>
                <div class="flex-div">
                    <div id="titolo1"class="video-title">

                        <h3>Titolo video</h3>
                    </div>
                    <div id="desc1"class="video-data">
                        <p>Descrizione video</p>
                    </div>
                </div>
            </div>
            <div class="video-list" id="video-list2">
                <a href="" >
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
            <div class="video-list" id="video-list3">
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
            <div class="video-list" id="video-list4">
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
            <div class="video-list" id="video-list5">
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
            <div class="video-list" id="video-list6">
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
            <div class="video-list" id="video-list7">
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
            <div class="video-list" id="video-list8">
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

