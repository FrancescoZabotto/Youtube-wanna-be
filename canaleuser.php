<?php
require "base.php";
require "navabar.php";
$actual_link ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$exp = "/username=[\w]{1,32}$/";

if(preg_match($exp, $actual_link, $match)) 
{   
    $userchannel=$match[0];
    preg_match("/[\w]{1,32}$/", $userchannel, $match2);
    $userchannel=$match2[0];
    $_SESSION["personacanale"]=$userchannel;
    if(isset($_SESSION['username']))
    {
        
    }
} 
else 
{
  echo "Errore";
  header("Location: home");
}

?>

<!DOCTYPE html>
<html>
<body>

    <div class="user title" style="padding-top:10px;text-align:center">
        <?php echo "<h1 style='font-weight:700;'>".ucwords($userchannel)."'s Channel</h1>"?>
    </div>
    <div class="container"> 
        <div class="row">

        </div>
    </div>
    <script>
        var req = new XMLHttpRequest(); 
        fetch("videouser.php",{
        }).then((response) => {
            return response.json();
        }).then((data) => {   
            console.log(data.length);
            console.log(data[0]);
            inseriscitizio(data);
        }).catch((error) => {
            console.log(error);
        }); 
        
        function inseriscitizio(data){
        if(data != undefined){
            if(data.length > 0)
            {
                var i=0;
                var espressione = new RegExp('^(jpg|jpeg|png|gif)$');
                while(i<data.length){
                    document.getElementsByClassName("row")[0].innerHTML += "<div class='col-12 col-md-6 col-lg-3"+i+"'><a href=video.php?video="+data[i]["video_id"]+" <div class='card'><img class='video' src='./video/"+data[i]["username"]+"/"+data[i]["video_id"]+"/"+"miniatura"+data[i]["video_id"]+".jpg' alt='"+data[i]["titolo"]+"'><div class='video-info'><div class='card-text'><h5 class='card-title'>"+data[i]["titolo"]+"</h5><div>"+data[i]["username"]+"</div><div class='row'><div class='col-2'></div><div class='col-8'>"+data[i]["videoview"]+"</div></div></div></div></div></div>";
                    i++;
                }
            }   
            else{
                document.getElementsByClassName("container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
            }
        }  
        else{
            document.getElementsByClassName("container")[0].innerHTML = '<div style="padding-top:20px;text-align:center;color:#f26964;font-weight:700;font-size:30px">Non ci sono video</div>';
        }
    }
    </script>
</body>
</html>
