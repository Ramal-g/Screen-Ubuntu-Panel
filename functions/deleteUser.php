<?php

session_start();
include("usersManager.php");

if(!isset($_POST["id"]))
{
    exit();
}

DeleteUser($_POST["id"]);


?>