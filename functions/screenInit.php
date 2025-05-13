<?php


$screenName = $_SESSION["screenName"];


function GetScreenID($screenName)
{
    return trim(shell_exec("screen -ls | gawk '/\." . $screenName . "\t/ {print strtonum($1)'}"));
}

if($screenName == "")
{
    echo "no Name";
    return;
}


exec("screen -ls " . $screenName);

if(exec("screen -ls " . $_SESSION["screenName"]) == "")
{
    //Create a new Screen

    $configPath = $_SESSION["mainPath"] . "config/screen.conf";
    //echo $configPath;

    echo "<br>";

    
    exec("screen -c '$configPath' -dmS '$screenName' -L -Logfile 'tmp/". $_SESSION["screenName"] . ".log'");


    if(isset($_SESSION["command"]))
    {
        exec("screen -S '" . GetScreenID($_SESSION["screenName"]) . "' -X stuff '" . trim($_SESSION["command"]) . "'^M");
        

        $userSave = unserialize($_SESSION["screen"]);
        $userSave->initCommand = $_SESSION["command"];

        //echo "To save user:" . serialize($userSave) . "<br>";

        TryToSaveScreen($userSave);
        $_SESSION["command"] = NULL;
    }
}

$screen_id = GetScreenID($screenName);
echo "<br>";
echo "id:" . $screen_id;
echo "<br>";

?>