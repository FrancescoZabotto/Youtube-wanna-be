<?php
if(isset($_SESSION['username'])){
echo '<header>
    <nav class="flex-div">
    <div class="nav-left flex-div">
        <a href="home"><img src="static/youtubewhite.png" class="logo"></a>
    </div>
    <div class="nav-middle flex-div">
        <div class="search-box">
        <form method="post" action="search">
            <input type="search" placeholder="Cerca" name="search">
            <button class="btnacc" type="submit"><img  src="./static/search-solid.svg" width="100%" height="100%" fill="currentColor" class="bi bi-search"></button>
        </form>
        </div>  
        <!-- <img src="static/search.png" class="mic-icon"> -->
    </div>  
    <div class="nav-right flex-div">   
        <a href="uploadvideo"><img src="static/add.png"></a>
        <a href="canale">'.$_SESSION["usernameshort"].'</a>    
    </div>   
    </nav>
    </header>';
}else{
    echo '<header>
    <nav class="flex-div">
        <div class="nav-left flex-div">
            <a href="home"><img src="static/youtubewhite.png" class="logo"></a>
        </div>
        <div class="nav-middle flex-div">
            <div class="search-box">
            <form method="post" action="search">
                <input type="search" placeholder="Cerca" name="search">
                <button class="btnacc" type="submit"><img  src="./static/search-solid.svg" width="100%" height="100%" fill="currentColor" class="bi bi-search"></button>
            </form>
            </div>  
            <!-- <img src="static/search.png" class="mic-icon"> -->
        </div>  
        <div class="nav-right flex-div">   
            <a href="uploadvideo"><img src="static/add.png"></a>
            <a href="login"><img src="static/user.png" class="user-icon"></a>      
        </div>   
    </nav>
    </header>';
}