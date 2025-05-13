<?php

require_once("usersManager.php");
session_start();

function clean_input($data)
{
    if (isset($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$_POST["screens"] =  json_decode($_POST["screens"]);

//echo $_POST["screens"][0];

if($_POST["role"] == "screen")
{
    TryToRegisteScreen($_POST["userName"], $_POST["password"]);
}
else
{
    TryToRegisteUser($_POST["userName"], $_POST["password"], $_POST["role"], $_POST["screens"]);
}




?>