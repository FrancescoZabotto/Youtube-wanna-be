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
    print_r($userchannel);
} 
else 
{
  echo "Errore";
}

?>

<!DOCTYPE html>
<html>
<body>

    <div class="user title" style="padding-top:20px">
        <?php echo "<h2>"+$shortu+"</h2>"?>
    </div>
    <div class="container"> 
        <div class="row">

        </div>
    </div>
    <script>

        const data = { username: '<?php echo $userchannel?>' };

        var Dativideo;
        var req = new XMLHttpRequest(); 
        fetch("viedouser.php",{
        method: 'POST', // or 'PUT'
        body: JSON.stringify(data),
        }).then((response) => {
            return response.json();
        }).then((data) => {
            
            console.log(data);
            
            inserisciuser(data);

            console.log(data["user"]);
        });   
    </script>
</body>
</html>
