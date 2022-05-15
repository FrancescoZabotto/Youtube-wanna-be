<?php
require "base.php";
require "navabar.php";
$actual_link ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$exp = "/username=[\w]{1,32}$/";

if(preg_match($exp, $actual_link, $match)) 
{   
    $userchannel=$match[0];
    preg_match("/[\w]{1,32}$/", $userchannel, $match2);
    $userchannel=$match2[0];
} 
else 
{
  echo "Errore";
  header("Location: home");}

?>

<!DOCTYPE html>
<html>
<body>

    <div class="user title" style="padding-top:10px;text-align:center">
        <?php echo "<h1 style='font-weight:700;'>".ucwords($shortu)."'s Channel</h1>"?>
    </div>
    <div class="container"> 
        <div class="row">

        </div>
    </div>
    <script>

        const data = { username: '<?php echo $userchannel; ?>' };

        var data = new FormData();
        data.append( "json", JSON.stringify( data ) );
        var Dativideo;
        var req = new XMLHttpRequest(); 
        fetch("viedouser.php",{
            method: "POST",
            body: data
        }).then((response) => {
            return response.json();
        }).then((json) => {
            console.log(json)
        }).then((data) => {
            
            console.log(data);
            
            //inserisciuser(data);
        }).catch((error) => {
            console.log(error);
        });   
    </script>
</body>
</html>
