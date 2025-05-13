<?php

function clean_input($data)
{
    if (isset($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

function GetScreenID($screenName)
{
    return trim(shell_exec("screen -ls | gawk '/\." . $screenName . "\t/ {print strtonum($1)'}"));
}

session_start();

if (isset($_POST['action']) && !empty($_POST['action']))
{
    $data = $_POST['action'];
    $data = clean_input($data);

    exec("screen -S '" . GetScreenID($_SESSION["screenName"]) . "' -X stuff '" . trim($data) . "'^M");
    echo "Executed";





echo "End";

}

?>