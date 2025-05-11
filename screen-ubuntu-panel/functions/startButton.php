<?php

session_start();

$_SESSION["Active"] = "1";
$_SESSION["Initialize"] = "1";
$_SESSION["command"] = $_POST["command"];
echo $_SESSION['command'];

?>