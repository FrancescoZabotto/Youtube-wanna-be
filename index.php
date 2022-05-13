<?php
require "base.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    $shortu="";
    
    if(strlen($username)>10){
    for($i=0;$i<10;$i++){
        $shortu=$shortu.$username[$i];
    }
    }
    else{
        $shortu=$username;
    }

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
<!DOCTYPE html>
<html>
    <body>


    <header>
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
            <?php if(isset($_SESSION['username'])){echo "<a href='canale'>".$shortu."</a>";}else{ echo "<a href='login'><img src='static/user.png' class='user-icon'></a>";}?>      
        </div>   
    </nav>
    </header>

    <div class="container" style="padding-top:20px"> <!--stai attento al paddding con il cell-->
        <div class="user">
            <?php if(isset($username)){echo '<div class="write"><h3>USER</h3></div>'; } ?>
            <div class="video-user-container">
                <div class="row">
                </div>
                <div class="row">
                </div>
            </div>
        </div>
        <div class="videogame" style="padding-top:20px">
            <div class="write"><h3>VIDEOGAME</h3></div>
            <div class="video-user-container">
                <div class="row">
                </div>
                <div class="row">
                </div>
            </div>
        </div>

    </div>

    <script>

    var Dativideo;
    var req = new XMLHttpRequest(); 
    fetch("inviavideo.php").then((response) => {
        return response.json();
    }).then((data) => {
        
        console.log(data); //passa i dati dei video
        
        var espressione = new RegExp('^(jpg|jpeg|png|gif)$');

        inserisciuser(data);

        console.log(data["user"]);

    });   

    //funzione che mi permette di inserire i dati nei videotitle
    function inserisciuser(data){
        if(data["user"].length > 0)
        {
            var i=0;
            var z=0;
            var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
            while(i<data["user"].length && i<7){
                document.getElementsByClassName("row")[z].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["user"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["user"][i]["username"]+"/"+data["user"][i]["video_id"]+"/"+"miniatura"+data["user"][i]["video_id"]+".jpg' alt='"+data["user"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["user"][i]["video_title"]+"</h5><div>"+data["user"][i]["username"]+"</div><div class='row'><div class='col-4'>"+data["user"][i]["views"]+"</div><div class='col-4'>"+data["user"][i]["likes"]+"</div><div class='col-4'>"+data["user"][i]["dislikes"]+"</div></div></div></div></div></div>";
                i++;
                if(i>3){
                    z++;
                }
            }
        }
        else{
            document.getElementsByClassName("video-user-container").innerHTML = "<p>Non hai caricato alcun video</p>";
        }
    }

    function inseriscigame(data){
        if(data["user"].length > 0)
        {
            var i=0;
            var z=0;
            var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
            while(i<data["user"].length && i<7){
                document.getElementsByClassName("row")[z].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["user"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["user"][i]["username"]+"/"+data["user"][i]["video_id"]+"/"+"miniatura"+data["user"][i]["video_id"]+".jpg' alt='"+data["user"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["user"][i]["video_title"]+"</h5><div>"+data["user"][i]["username"]+"</div><div class='row'><div class='col-4'>"+data["user"][i]["views"]+"</div><div class='col-4'>"+data["user"][i]["likes"]+"</div><div class='col-4'>"+data["user"][i]["dislikes"]+"</div></div></div></div></div></div>";
                i++;
                if(i>3){
                    z++;
                }
            }
        }
        else{
            document.getElementsByClassName("video-user-container").innerHTML = "<p>Non hai caricato alcun video</p>";
        }
    }

    function titolo(titolo){
        
        for(var a=1;a<5; a++){
        document.getElementById("titolo"+a).innerHTML = "sess"; //+2
        document.getElementById("link1").getAttribute("href")= "18";
        }
    };
    </script>
    </body>
</html>

