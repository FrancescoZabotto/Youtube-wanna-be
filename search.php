<?php
require "base.php";
require "navabar.php";
$conn = new mysqli("localhost", "root", "", "ProjectFinale");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST["search"]))
{
    $search = $_POST["search"];
    $partic="";
    $ciao="";
    if(empty($search)==FALSE){
    
        if($search[0]=="#")
        {
            $partic="categorie";
            $search = substr($search,1);
            $sql = "SELECT * FROM categorie_video
                    INNER JOIN video using(video_id)
                    WHERE categorie_video.categorie='$search'
                    ORDER BY video.videoview ASC";
                    $result = $conn->query($sql);
                    if($result->num_rows != 0){
                        $TOT=array();
                    while($row = $result->fetch_assoc()){
                            $TOT[] = $row;
                    }
                }   
        }
        elseif($search[0]==".")
        {
            $partic="canali";
            $search = substr($search,1);
            $sql = "SELECT * FROM canale
                    WHERE username LIKE '%$search%'
                    ORDER BY canale.username ASC";
            $result = $conn->query($sql);        
            if($result->num_rows != 0){
            $TOT=array();
            while($row = $result->fetch_assoc()){
                            $TOT[] = $row;
                    }
            }
        }
        else{
            $sql = "SELECT * FROM video
                    WHERE titolo LIKE '%$search%'
                    ORDER BY video.videoview DESC";
                    $result = $conn->query($sql);
                    if($result->num_rows != 0){
                        $TOT=array();
                    while($row = $result->fetch_assoc()){
                            $TOT[] = $row;
                    }
                    }
        }
    }
    else{
        $ciao = "HAI SBAGLIATO A CERCARE";
    }
}
else
{
    header("Location: home");
}

?>
<!DOCTYPE html>
<html>
<body style="text-align:center;">

    <h3>Ricerca di: <?php if(empty($partic)){echo $search;}else{echo $search." in ".$partic;}?></h3>
    <hr>
    <?php if(empty($ciao)==FALSE){echo '<div style="padding-top:20px;color:#f26964;font-weight:700;font-size:30px">'.$ciao.'</div>';}?>
    <?php   if(empty($TOT)==TRUE){echo '<div style="padding-top:20px;color:#f26964;font-weight:700;font-size:30px">NESSUN RISULTATO PER LA TUA RICERCA</div>';}
            elseif(empty($TOT)==FALSE){
                if(empty($partic)){
                    for($i=0;$i<count($TOT);$i++){
                        echo "<div class='row' style='padding:30px'>";
                        echo "<div class='col-12'>";
                        echo '<div class="card">
                                <a href="video.php?video='.$TOT[$i]["video_id"].'"
                                    <div>
                                    <img style="width:500px;height:300px" class="video" src="./video/'.$TOT[$i]["username"].'/'.$TOT[$i]["video_id"].'/miniatura'.$TOT[$i]["video_id"].'.jpg" alt="'.$TOT[$i]["titolo"].'"
                                    </div>
                                    <div>
                                    <br>
                                    <h5>'. $TOT[$i]["titolo"] .'</h5>
                                    </div>';
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo '<hr>';
                    }
                }
                elseif($partic=="canali")
                {
                    for($i=0;$i<count($TOT);$i++){
                    echo "<div class='row' style='padding:30px'>";
                    echo "<div class='col-12'>";
                    echo '<div class="card">
                            <a href="canaleuser?username='.$TOT[$i]["username"].'"
                                <div>
                                    <h4>'. $TOT[$i]["username"] .'</h4>
                                </div>
                            ';
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo '<hr>';
                    }
                }
                elseif($partic=="categorie")
                {
                    for($i=0;$i<count($TOT);$i++){
                    echo "<div class='row' style='padding:30px'>";
                    echo "<div class='col-12'>";
                    echo '<div class="card">
                            <a href="canaleuser?username='.$TOT[$i]["username"].'"
                                <div>
                                    <h4>'. $TOT[$i]["username"] .'</h4>
                                </div>
                            ';
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo '<hr>';
                    }
                }
            }
            ?>
</body>
</html>
