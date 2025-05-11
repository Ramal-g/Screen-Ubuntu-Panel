<?php


session_start();
ini_set('display_errors', 1);


include("functions/usersManager.php");




function clean_input($data)
{
    if (isset($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>