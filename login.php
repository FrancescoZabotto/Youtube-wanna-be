<?php
require "base.php";
$version = time(); 
if(isset( $_SESSION['username'])){
    header("Location: home");
}
?>
<html>
    <head> 
    <link rel="stylesheet" href="./css/login.css?v=<?php echo $version?>">
    </head>
    <body>
    <div class="login-container">
        <div class="mesaaggi-errore"></div>
        <div class="login-form">
        <form method="post">
            <h1 style="color:#f26964">LOGIN</h1>
            <input type="text"  id="username" name="username" placeholder="Nome Utente" required>
            <input placeholder="Password" type="password" name="password" id="password" required/>
            <button class="btn" type="submit">Log in</button>
        </form>
        <footer>
            <h5 >Non hai un account?<a href="register" style="color:#f26964">Registrati</a></h5>
            <br>
            <h5><a href="home" style="color:#f26964">Torna alla Home</a></h5>
        </footer>
        </div>
    </div>
    </body>
</html>
<?php
if(isset($_POST['username']) || isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo md5($password)."<br>";
    $conn = new mysqli("localhost", "root", "", "projectfinale");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM utenti WHERE username = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows != 0){
        $row = $result->fetch_assoc();
        if($row['password'] ==  md5($password)){
            $_SESSION['username'] = $username;
            header("Location: home");
        }
        else{
            echo "Password Sbagliata";
        }
    }
    else{
        echo "L'untente non esiste";
    }

}
?>