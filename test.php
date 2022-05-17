<?php
require "base.php";
?>
<html>
    <head>
        <link rel="stylesheet" href="./css/login.css?v=<?php echo $version?>">
    </head>
    <body>
    <div class="login-container">
        <div class="login-form">
            <div class="mesaaggi-errore"></div>
        <form action="" method="post" enctype="multipart/form-data" style="width:800px;">
            <label for="tag">Scegli le categorie</label>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="tag">
                <option value="Videogiochi">Videogiochi</option>
                <option value="Anime">Anime</option>
                <option value="Musica">Musica</option>
                <option value="Cucina">Cucina</option>
                <option value="Sport">Sport</option>
            </select>
            <button class="btn" name="upload" type="submit">Upload</button>
        </form>
        </div>
    </div>
    </body>
</html>
<?php

echo $_POST['tag'];
?>