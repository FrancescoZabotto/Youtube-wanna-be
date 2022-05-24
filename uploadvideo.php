<?php
require "base.php";
$version = time(); 
if(isset( $_SESSION['username'])){
}
else{
    header("Location: login");
}


?>
<html>
    <head>
        <link rel="stylesheet" href="./css/login.css?v=<?php echo $version?>">
    </head>


    <div class="login-container">
        <div class="login-form">
        <form action="" method="post" enctype="multipart/form-data" style="width:800px;">
            <h1 style="color:#f26964">Inserisci Video</h1>
            <input type="text" name="titolo" placeholder="Titolo" required>
            <textarea class="form-control" rows="10" cols="500" type="text" name="descrizione" placeholder="Descrizione" style="height: 200px;resize: none;" required></textarea>
            <label for="tag">Scegli le categorie</label>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="tag">
                <option value="Videogiochi">Videogiochi</option>
                <option value="Anime">Anime</option>
                <option value="Musica">Musica</option>
                <option value="Cucina">Cucina</option>
                <option value="Sport">Sport</option>
            </select>
            <label for="miniatura">Inserisci Miniatura</label>
            <input type="file" name="miniatura" required>
            <label for="video">Inserisci Video</label>
            <input type="file" name="video" required>
            <button class="btn" name="upload" type="submit">Upload</button>
        </form>
        <footer>
            <h5><a href="home" style="color:#f26964">Torna alla Home</a></h5>
        </footer>
        </div>
    </div>

    <script>
    //document.getElementById('multifile').value = "";// se va mostra che il video è andato a buon fine
    </script>

</body>
</html>

<?php
if(isset($_POST['upload']) && $_FILES['miniatura']['size'] > 0 && $_FILES['video']['size'] > 0){

    //svuoto il messaggio
    $msg="";

    //guardo se il file sia valido
    $check1 = getimagesize($_FILES["miniatura"]["tmp_name"]);

    //print_r($check1);//mi servirà per impstare la dimensione dell'immagine a 1280 x 720

    if($check1 !== false){

        // accetta solo jpg jepeg png e gif per miniatura e mp4 per video
        $extmin=pathinfo($_FILES["miniatura"]["name"],PATHINFO_EXTENSION);
        $extvideo=pathinfo($_FILES["video"]["name"],PATHINFO_EXTENSION);

        /*$infov=getimagesize($_FILES["miniatura"]["tmp_name"]);
        $width=$infov[0];
        $height=$infov[1];

        var_dump($width);   echo "<br>";
        var_dump($height);  echo "<br>";
        $_FILES["miniatura"]["tmp_name"]= */


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


        $titolo = $_POST['titolo'];
        $descrizione = $_POST['descrizione'];
        
        //METTI TUTTI I DATI E FAI LA QUERI, PRENDI IL VIDEO ID E POI SALVA IL FILE, potrei usare NOW() su mysql, ma non volgio rischaire
        $sql="INSERT INTO `video` (`username`, `likes`, `dislikes`, `videoview`, `datains`, `descrizione`, `titolo`) VALUES ('".$username."', 0, 0, 0, '".$time."', '".$descrizione."', '".$titolo."')";
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
                            $tag=$_POST['tag'];
                            $sql2="INSERT INTO `categorie_video` (`categorie`, `video_id`) VALUES ('$tag', '$id')";
                            $result2 = $conn->query($sql2);
                        } 
                        else{
                            echo "<script>alert('ERRORE:C'è stato un errore nell'upload del video');</script>";
                            $conn->close();
                            exit();
                        }
                        
                        //upload miniatura
                        if(move_uploaded_file($_FILES["miniatura"]["tmp_name"], $target_imm)) {
                            echo "<script>alert('I file sono stati caricati con successo');</script>";
                            $_FILES=NULL;
                            $_POST=NULL;
                            $conn->close();
                        } 
                        else{
                            echo "<script>alert('ERRRE:C'è stato un errore nell'upload della miniatura');</script>";
                            $conn->close();
                            exit();
                        }

                    }
                }
                else{
                    echo "<script>alert('ERRORE:Problemi con il caricamento del video');</script>";
                    $conn->close();
                }
            
            }
            else{
                echo "<script>alert('ERRORE: Problema con l'inserimento del video nel database');</script>";
                $conn->close();
        }
    }
    else{
        echo "<script>alert('ERRORE:Formato non consentito o dimensione dei file troppo grandi (max dimensione video = 50 gb e max dimensione miniatura = 1 gb)');</script>";
    }
}
elseif(isset($_POST['upload'])){
    echo "<script>alert('ERRORE: Ci sono problemi con i tuoi file');</script>";
}
?>
