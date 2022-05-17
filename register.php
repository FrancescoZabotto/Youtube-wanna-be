<?php
require "base.php";
$version = time(); 

?>
<html>
    <body>
        <head>
        <link rel="stylesheet" href="./css/login.css?v=<?php echo $version?>">
        </head>
    <div class="login-container">
        <div class="login-form">
        <div class="mesaaggi-errore"></div>
        <form method="post" class="row" style="width:650px;">
            <h1 class="col-12" style="color:#f26964">Registrazione</h1>
            <input class="col-12 col-md-6" type="text"  id="name" name="nome" placeholder="Nome" required>
            <input class="col-12 col-md-6" type="text" id="cognome" name="cognome" placeholder="Cognome" required>
            <input class="col-12" type="email" id="email" name="email" placeholder="Email" required>
            <input class="col-12" type="text"  id="username" name="username" placeholder="Username" required>
            <input class="col-12 col-md-6" type="password" id="password" name="password" placeholder="Password" required>
            <input class="col-12 col-md-6" type="password" id="confirm_password" name="confirm_password" placeholder="Conferma Password" required>
            <button type="submit" class="btn">Registrati</button>
        </form>
        <footer>
            <h5 >Hai già un account?<a href="login" style="color:#f26964">Accedi</a></h5>
            <br>
            <h5><a href="home" style="color:#f26964">Torna alla Home</a></h5>
        </footer>
        </div>
  </body>
</html>

<?php

/* Usare le espressioni regolari per personalizzare le password */
/* sanificare le scritte e "uccidere" la connessione */ 

if(isset( $_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email']) && isset($_POST['nome']) && isset($_POST['cognome'])){
    if($_POST['password'] == $_POST['confirm_password']){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $password = md5($password);

        $conn = new mysqli("localhost", "root", "", "projectfinale");
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
         

        $sql = "SELECT * FROM utenti WHERE username = '$username'";
        $sql2 = "SELECT * FROM utenti WHERE email = '$email'";

        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if($result->num_rows == 0 && $result2->num_rows == 0){
        
            $sql = "INSERT INTO `utenti` (`email`, `nome`, `cognome`, `username`, `password`) VALUES ('$email', '$nome', '$cognome','$username', '$password')";
            if($conn->query($sql) === TRUE){
                echo "Registrazione avvenuta con successo";
                $_SESSION['username'] = $username;
                mkdir("video/".$username);
                $sql="INSERT INTO `canale` (`username`, `subscribes`) VALUES ('$username', '1');";
                $conn->query($sql);
                $sql="INSERT INTO `iscrizioni_persona` (`iscrivente`, `canaleuser`) VALUES ('$username', '$username')";//si autoiscrive a se stesso
                $conn->query($sql);
                header("Location: home");
            }
            else{
                echo "Errore nella registrazione";
            }
        }
        else if($result2->num_rows > 0){
            echo "Account già esistente";
        }
        else if($result->num_rows > 0){
            echo "Nome utente già utilizzato";
    }
    }
    else{
        echo "Le password non corrispondono";
    }
}
?>