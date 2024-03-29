<?php
require "base.php";
require "navabar.php";
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $conn = new mysqli("localhost", "root", "", "ProjectFinale");

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
}

    //impedisci sql injection
    //ho cambiato un po di titoli
    //sistema categorie
?>
<!DOCTYPE html>
<html>
    <body>

    <div class="container" style="padding-top:20px"> <!--stai attento al paddding con il cell-->
        <div class="user">
            <?php if(isset($username)){echo '<div class="write"><h3>USER</h3></div>'; } ?>
        </div>
        <div class="video-user-container">
            <div class="row">
            </div>
        </div>
        <div class="videogame" style="padding-top:20px">
            <div class="write">
                <h3>VIDEOGAME</h3>
            </div>
            <div class="videogame-container">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="cucina" style="padding-top:20px">
            <div class="write">
                <h3>CUCINA</h3>
            </div>
            <div class="cucina-container">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="sport" style="padding-top:20px">
            <div class="write">
                <h3>SPORT</h3>
            </div>
            <div class="sport-container">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="musica" style="padding-top:20px">
                <div class="write">
                    <h3>MUSICA</h3>
                </div>
                <div class="musica-container">
                    <div class="row">
                    </div>
                </div>
            </div>
        <div class="anime" style="padding-top:20px">
                <div class="write">
                    <h3>ANIME</h3>
                </div>
                <div class="anime-container">
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

        inseriscigame(data);
        inseriscicucina(data);
        inseriscisport(data);
        inseriscimusica(data);
        inseriscianime(data);
        inserisciuser(data);

    });   

    //funzione che mi permette di inserire i dati nei videotitle
    function inserisciuser(data){
        if(data["user"] !== undefined){
            
            if(data["user"].length > 0){
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                while(i<data["user"].length && i<7){
                    document.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3 "+i+"' style='padding:3px;'><a href=video.php?video="+data["user"][i]["video_id"]+" <div class='card'><img style='height:200px;width:100%;' class='video' src='./video/"+data["user"][i]["username"]+"/"+data["user"][i]["video_id"]+"/"+"miniatura"+data["user"][i]["video_id"]+data["user"][i]["estensione"]+"' alt='"+data["user"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["user"][i]["titolo"]+"</h5><div>"+data["user"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["user"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }
            else{
                document.getElementsByClassName("video-user-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non hai inserito alcun video</div>';
            }
        }
}
    //style='height:200px;width:100%;' da sistemare
    function inseriscigame(data){
        if(data["videogiochi"] != undefined){
            if(data["videogiochi"].length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                var t1 = document.getElementsByClassName("videogame-container")[0];
                while(i<data["videogiochi"].length && i<7){
                    t1.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3 "+i+"' style='padding:3px;'><a href=video.php?video="+data["videogiochi"][i]["video_id"]+" <div class='card'><img style='height:200px;width:100%;' class='video' src='./video/"+data["videogiochi"][i]["username"]+"/"+data["videogiochi"][i]["video_id"]+"/"+"miniatura"+data["videogiochi"][i]["video_id"]+data["videogiochi"][i]["estensione"]+"' alt='"+data["videogiochi"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["videogiochi"][i]["titolo"]+"</h5><div>"+data["videogiochi"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["videogiochi"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }   
            else{
                document.getElementsByClassName("videogame-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
            }
        }  
        else{
            document.getElementsByClassName("videogame-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
        }
    }

    function inseriscicucina(data){
        if(data["cucina"] !== undefined){
            if(data["cucina"].length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                t2 = document.getElementsByClassName("cucina-container")[0];
                while(i<data["cucina"].length && i<7){
                    t2.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3 "+i+"' style='padding:3px;'><a href=video.php?video="+data["cucina"][i]["video_id"]+" <div class='card'><img style='height:200px;width:100%;' class='video' src='./video/"+data["cucina"][i]["username"]+"/"+data["cucina"][i]["video_id"]+"/"+"miniatura"+data["cucina"][i]["video_id"]+data["cucina"][i]["estensione"]+"' alt='"+data["cucina"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["cucina"][i]["titolo"]+"</h5><div>"+data["cucina"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["cucina"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }   
            else{
                document.getElementsByClassName("cucina-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
            }
        }  
        else{
            document.getElementsByClassName("cucina-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
        }

    }

    function inseriscisport(data){
        if(data["sport"] !== undefined){
            if(data["sport"].length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                t3 = document.getElementsByClassName("sport-container")[0];
                while(i<data["sport"].length && i<7){
                    t3.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3 "+i+"' style='padding:3px;'><a href=video.php?video="+data["sport"][i]["video_id"]+" <div class='card'><img style='height:200px;width:100%;' class='video' src='./video/"+data["sport"][i]["username"]+"/"+data["sport"][i]["video_id"]+"/"+"miniatura"+data["sport"][i]["video_id"]+data["sport"][i]["estensione"]+"' alt='"+data["sport"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["sport"][i]["titolo"]+"</h5><div>"+data["sport"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["sport"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }   
            else{
                document.getElementsByClassName("sport-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
            }
        }  
        else{
            document.getElementsByClassName("sport-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
        }

    }

    function inseriscimusica(data){
        if(data["musica"] !== undefined){
            if(data["musica"].length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                t4 = document.getElementsByClassName("musica-container")[0];
                while(i<data["musica"].length && i<7){
                    t4.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3 "+i+"' style='padding:3px;'><a href=video.php?video="+data["musica"][i]["video_id"]+" <div class='card'><img style='height:200px;width:100%;' class='video' src='./video/"+data["musica"][i]["username"]+"/"+data["musica"][i]["video_id"]+"/"+"miniatura"+data["musica"][i]["video_id"]+data["musica"][i]["estensione"]+"' alt='"+data["musica"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["musica"][i]["titolo"]+"</h5><div>"+data["musica"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["musica"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }   
            else{
                document.getElementsByClassName("musica-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
            }
        }  
        else{
            document.getElementsByClassName("musica-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
        }

    }

    function inseriscianime(data){
        if(data["anime"] !== undefined){
            if(data["anime"].length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                var t5 = document.getElementsByClassName("anime-container")[0];
                while(i<data["anime"].length && i<7){
                    t5.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3 "+i+"' style='padding:3px;'><a href=video.php?video="+data["anime"][i]["video_id"]+" <div class='card'><img style='height:200px;width:100%;' class='video' src='./video/"+data["anime"][i]["username"]+"/"+data["anime"][i]["video_id"]+"/"+"miniatura"+data["anime"][i]["video_id"]+data["anime"][i]["estensione"]+"' alt='"+data["anime"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["anime"][i]["titolo"]+"</h5><div>"+data["anime"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["anime"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }   
            else{
                document.getElementsByClassName("anime-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
            }
        }  
        else{
            document.getElementsByClassName("anime-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
        }

    }
    </script>
    </body>
</html>

