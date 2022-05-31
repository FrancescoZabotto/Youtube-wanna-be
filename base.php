<?php  

$version = time(); /* cambia la versione del css me lo aggiorna tolgiendomi il problema del css su cache */ 


session_start();
echo '
<head lang="it">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/base.css?v='.$version.'">
    <title>Youtube</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>';
 
function cercatore($username,$canale){
    $risultiamo="";

    $conn = new mysqli("localhost", "root", "", "ProjectFinale");
    if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
    }

    $sql1 = "SELECT * FROM iscrizioni_persona WHERE iscrivente='$username' AND canaleuser='$canale'" ; 

    $result = $conn->query($sql1);
    if($result->num_rows == 0){
        $sql = "INSERT INTO iscrizioni_persona (iscrivente,canaleuser) VALUES ('$username','$canale')";
        if($conn->query($sql) === TRUE){
            $risultiamo= "OK";
        }
        else{
            $risultiamo= "NOT OK";
        }
    }

    echo $risultiamo;
}

function estensione($videoid,$username){
    $img = "video/".$username."/".$videoid."/miniatura".$videoid;
    if(file_exists($img.".jpeg")){
        return ".jpeg";
    }
    else if(file_exists($img.".png")){
        return ".png";
    }
    else if(file_exists($img.".gif")){
        return ".gif";
    }
    else{
        return ".jpg";
    }
}



?>
