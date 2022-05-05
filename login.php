<?php
require "base.php";
if(isset( $_SESSION['username'])){
    header("Location: home");
}
?>
<html>
    <head> 
    <link rel="stylesheet" href="./css/login.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
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