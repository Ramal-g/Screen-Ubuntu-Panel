<?php

include("../base/phpHeader.php");

$elcomando = "screen -wipe";
exec($elcomando);

//echo $_SESSION["screenName"];

//echo exec("screen -ls");

$tipserver = trim(exec('whoami'));
//echo " br";
$elpid2 = "ps au | grep '" . $tipserver . "' | grep '" . $_SESSION['screenName'] . "' | gawk '{print $2}'";
$elpid2 = shell_exec($elpid2);

function GetScreenID($screenName)
{
    return trim(shell_exec("screen -ls | gawk '/\." . $screenName . "\t/ {print strtonum($1)'}"));
}

$id = GetScreenID($_SESSION['screenName']);

if ($id != "") {

    echo  $id;
    echo exec("screen -XS ". $id ." kill") . '   ';

    //echo("log:" . $_SESSION['log_file']);
    clearstatcache();
    if (file_exists($_SESSION["log_file"])) {
        unlink($_SESSION['log_file']);
    }


    $_SESSION["Active"] = NULL;
    echo "ok ";
} 
else {
    echo "error";
}

?>