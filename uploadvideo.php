<?php
require "base.php";
if(isset( $_SESSION['username'])){
}
else{
    header("Location: login");
}
?>
<html>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    
    <label for="titolo">Titolo</label><br>
    <input type="text" name="titolo" placeholder="Titolo"><br><br>

    <label for="titolo">Descrizione</label><br>
    <input type="text" name="descrizione" placeholder="Descrizione"><br><br>
    
    <label for="miniatura">Miniatura</label><br>
    <input type="file" name="miniatura"><br><br>

    <label for="video">Video</label><br>
    <input type="file" name="video"><br><br>
    <input type="submit" name="upload" value="Carica Video"><br>
</form> 
</body>
</html>

<?php
if(isset($_POST['upload']) && $_FILES['miniatura']['size'] > 0 && $_FILES['video']['size'] > 0){

    //guardo se il file sia valido
    $check1 = getimagesize($_FILES["miniatura"]["tmp_name"]);

    //print_r($check1);//mi servirà per impstare la dimensione dell'immagine a 1280 x 720

    if($check1 !== false){

        // accetta solo jpg jepeg png e gif per miniatura e mp4 per video
        $extmin=pathinfo($_FILES["miniatura"]["name"],PATHINFO_EXTENSION);
        $extvideo=pathinfo($_FILES["video"]["name"],PATHINFO_EXTENSION);

        //imposto una dimensione massima dei file
        $sizem= $_FILES["miniatura"]["size"]; //restituisce la dimensione del file in byte
        $sizev= $_FILES["video"]["size"];

        //53687091200 bytes circa 50 gb 
        //1073741824 bytes circa 1 gb

        if(($extmin=="jpg" || $extmin=="jpeg" || $extmin=="png"||$extmin=="gif" ) && $extvideo=="mp4" && $sizev < 53687091200 && $sizev < 1073741824){
        
        $username = $_SESSION['username'];
        
        $conn = new mysqli("localhost", "root", "", "ProjectFinale");
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        //gestione con delle regexp per controllare i file e l'estensione
        /*$miniatura = $_FILES['miniatura']['name'];//riceve il nome completo del file
        $video = $_FILES['video']['name'];*/

        $time=date("Y-m-d H:i:s");



        //METTI TUTTI I DATI E FAI LA QUERI, PRENDI IL VIDEO ID E POI SALVA IL FILE, potrei usare NOW() su mysql, ma non volgio rischaire
        $sql="INSERT INTO `video` (`video_id`, `username`, `likes`, `dislikes`, `videoview`, `datains`, `descrizione`, `titolo`) VALUES (NULL, '".$username."', 0, 0, 0, '".$time."', '".$_POST['descrizione']."', '".$_POST['titolo']."')";
        $result = $conn->query($sql);

            if($result == 1){

                $sql="SELECT video_id FROM video WHERE username='".$username."' AND datains='".$time."'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $row=$result->fetch_assoc();
                    
                    $id = $row['video_id'];

                    $_FILES["miniatura"]["name"]="miniatura".$id.".".$extmin; //aggiorna il nome del file
                    $_FILES["video"]["name"]="video".$id.".".$extvideo;

                    if(is_dir("video/".$username)==true) // impedire errore se non esiste la cartella
                    {
                        mkdir("video/".$username."/".$id);
                    }
                    else{
                        mkdir("video/".$username);
                        mkdir("video/".$username."/".$id);
                    }

                    $target_dir = "video/".$username."/".$id."/";
                    $target_video = $target_dir . basename($_FILES["video"]["name"]);
                    $target_imm = $target_dir . basename($_FILES["miniatura"]["name"]);

                        //upload video
                        if(move_uploaded_file($_FILES["video"]["tmp_name"], $target_video)) {
                            echo "The file ". htmlspecialchars(basename( $_FILES["video"]["name"])). " has been uploaded." . "<br>";
                        } 
                        else{
                            echo "Sorry, there was an error uploading your file.";
                            $conn->close();
                            exit();
                        }
                        
                        //upload miniatura
                        if(move_uploaded_file($_FILES["miniatura"]["tmp_name"], $target_imm)) {
                            echo "The file ".htmlspecialchars( basename( $_FILES["miniatura"]["name"])). " has been uploaded.";
                        } 
                        else{
                            echo "Sorry, there was an error uploading your file.";
                            $conn->close();
                            exit();
                        }

                    }
                }
                else{
                    echo "Problemi con il caricamento del video";
                    $conn->close();
                }
            
            }
            else{
                echo "Problema con l'inserimento del video nel database";
                $conn->close();
            }
        }
        else{
            echo "Formato non consentito o dimensione dei file troppo grandi (max dimensione video = 50 gb e max dimensione miniatura = 1 gb)";
        }
    }
    else{
        echo "File non valido";
}
?>