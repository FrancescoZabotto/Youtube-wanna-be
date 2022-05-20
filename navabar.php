<?php
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    $shortu="";
    if(strlen($username)>10){
        for($i=0;$i<10;$i++){
            $shortu=$shortu.$username[$i];
        }
        }
        else{
            $shortu=$username;
        }

echo '<header>
    <nav class="flex-div">
    <div class="nav-left flex-div">
        <a href="home"><img src="./static/Logo_of_Youtube.svg" class="logo"></a>
    </div>
    <div class="nav-middle flex-div">
        <div class="search-box">
        <form method="post" action="search">
            <input type="search" placeholder="Cerca" name="search">
            <button class="btnacc" type="submit"><img  src="./static/search-solid.svg" width="100%" height="100%" fill="currentColor" class="bi bi-search"></button>
        </form>
        </div>  
    </div>  
    <div class="nav-right flex-div">   
        <a href="uploadvideo"><img src="./static/plus-circle.svg" width="100%" height="100%" fill="currentColor"></a>
        <a href="canale" style="font-weight:600;">'.$shortu.'...</a>    
    </div>   
    </nav>
    </header>';
}else{
    echo '<header>
    <nav class="flex-div">
        <div class="nav-left flex-div">
            <a href="home"><img src="./static/Logo_of_Youtube.svg" class="logo"></a>
        </div>
        <div class="nav-middle flex-div">
            <div class="search-box">
            <form method="post" action="search">
                <input type="search" placeholder="Cerca" name="search">
                <button class="btnacc" type="submit"><img  src="./static/search-solid.svg" width="100%" height="100%" fill="currentColor" class="bi bi-search"></button>
            </form>
            </div>  
        </div>  
        <div class="nav-right flex-div">   
            <a href="uploadvideo"><img src="./static/plus-circle.svg" width="100%" height="100%" fill="currentColor"></a>
            <a href="login"><img src="./static/person-fill.svg" width="100%" height="100%" fill="currentColor"></a>      
        </div>   
    </nav>
    </header>';
}