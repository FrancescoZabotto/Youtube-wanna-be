<?php
require "base.php";
?>
<html>
    <body>
    <form method="post" >
        <div class="form-group">
            <label for="nome">Name</label>
            <input type="text"  id="name" name="nome" placeholder="Nome" required>
        </div>
        <div class="form-group">
            <label for="cognome">Surname</label>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text"  id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        
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