<?php

include("base/phpHeader.php");
include("base/root.php");

$_SESSION['screen'] = serialize(ReloadScreen($_SESSION['screenName']));
//echo $rutacarpetamine;

if(!isset($_SESSION["screenName"]))
{
    header("Location: login.php");
}


if(unserialize($_SESSION["user"])->role == "user")
{
    if(!in_array($_SESSION['screenName'], DecompileArray(unserialize($_SESSION["user"])->screens)))
    {
        exit();
    }
}



include("base/header.php");

?>


<script>

function Stop() 
{
    console.log("Server Stopping");
    fetch('functions/screenKill.php') // Archivo PHP que devuelve los logs
        .then(response => response.text())
        .then(data => {
            console.log(data);
            document.location.href = "";
        });
    
}

function Start() 
{
    text = document.getElementById("initCommand").value
    console.log("Starting Stopping");
    $.ajax({
                url: 'functions/startButton.php',
                data: {
                    command: text
                },
                type: 'POST',
                success: function (data) 
                {
                    console.log(data);
                    document.location.href = "";
                }
            });


}

function LogOut() 
{
    document.location.href = "user.php";


}


</script>

<body>

<button onclick="LogOut()">
Log out
</button>


<button onclick="Stop()">
Stop Screen
</button>

<button onclick="Start()">
Start Screen
</button>


<br>
<br>


<?php

if(exec("screen -ls " . $_SESSION["screenName"]) != "")
{
    $_SESSION["Active"] = "1";
}
else
{
    $_SESSION["Active"] = "0";
}

if(isset($_SESSION["Initialize"]) || $_SESSION["Active"])
{
    include("functions/screenInit.php");
    $_SESSION["Initialize"] = NULL;
    $_SESSION["Active"] = "1";
}

if($_SESSION["Active"] == "1")
{
    //echo "init console";
    include_once("functions/console.php");
    //echo "end console";
}
else
{
    echo 
    "
    <div>

    Init Command

    <input type='text' value='". unserialize($_SESSION['screen'])->initCommand ."' id='initCommand'>

    </div>
    ";
}

?>


</body>



</html>