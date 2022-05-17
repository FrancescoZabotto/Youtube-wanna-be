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

    /* la chiamo sia qui che su canale, prova a vedere se riesci a chiamarla una volta sola */

    //per il fatto di chiaro o scuro, o fai con la session oppure fai 2 file css chiaro e scuro e ti adatti a mostrare in base all'impostazione
    
    /*57:48 https://www.youtube.com/watch?v=4ykAepVkG5Y&t=837s&ab_channel=EasyTutorials*/
    //https://codepen.io/lazehang/pen/YzYXwjE 
    //ho cambiato un po di titoli
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

        console.log(data["user"]);
        console.log(data);

        console.log(data["anime"].length);

        console.log(document.getElementsByClassName("row").length);

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
                    document.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["user"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["user"][i]["username"]+"/"+data["user"][i]["video_id"]+"/"+"miniatura"+data["user"][i]["video_id"]+".jpg' alt='"+data["user"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["user"][i]["titolo"]+"</h5><div>"+data["user"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["user"][i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }
            else{
                document.getElementsByClassName("video-user-container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non hai inserito alcun video</div>';
            }
        }
}

    function inseriscigame(data){
        if(data["videogiochi"] != undefined){
            if(data["videogiochi"].length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                while(i<data["videogiochi"].length && i<7){
                    document.getElementsByClassName("row")[1].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["videogiochi"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["videogiochi"][i]["username"]+"/"+data["videogiochi"][i]["video_id"]+"/"+"miniatura"+data["videogiochi"][i]["video_id"]+".jpg' alt='"+data["videogiochi"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["videogiochi"][i]["titolo"]+"</h5><div>"+data["videogiochi"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["videogiochi"][i]["videoview"]+"</div></div></div></div></div></div>";
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
                while(i<data["cucina"].length && i<7){
                    document.getElementsByClassName("row")[2].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["cucina"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["cucina"][i]["username"]+"/"+data["cucina"][i]["video_id"]+"/"+"miniatura"+data["cucina"][i]["video_id"]+".jpg' alt='"+data["cucina"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["cucina"][i]["titolo"]+"</h5><div>"+data["cucina"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["cucina"][i]["videoview"]+"</div></div></div></div></div></div>";
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
                while(i<data["sport"].length && i<7){
                    document.getElementsByClassName("row")[3].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["sport"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["sport"][i]["username"]+"/"+data["sport"][i]["video_id"]+"/"+"miniatura"+data["sport"][i]["video_id"]+".jpg' alt='"+data["sport"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["sport"][i]["titolo"]+"</h5><div>"+data["sport"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["sport"][i]["videoview"]+"</div></div></div></div></div></div>";
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
                while(i<data["musica"].length && i<7){
                    document.getElementsByClassName("row")[4].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["musica"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["musica"][i]["username"]+"/"+data["musica"][i]["video_id"]+"/"+"miniatura"+data["musica"][i]["video_id"]+".jpg' alt='"+data["musica"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["musica"][i]["titolo"]+"</h5><div>"+data["musica"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["musica"][i]["videoview"]+"</div></div></div></div></div></div>";
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
                while(i<data["anime"].length && i<7){
                    document.getElementsByClassName("row")[5].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data["anime"][i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data["anime"][i]["username"]+"/"+data["anime"][i]["video_id"]+"/"+"miniatura"+data["anime"][i]["video_id"]+".jpg' alt='"+data["anime"][i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data["anime"][i]["titolo"]+"</h5><div>"+data["anime"][i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data["anime"][i]["videoview"]+"</div></div></div></div></div></div>";
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

