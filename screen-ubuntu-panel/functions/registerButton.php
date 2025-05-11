<?php

include("../base/phpHeader.php");

if(!isset($_POST["createType"]))
{
    exit();
}

$_SESSION["createType"] = $_POST["createType"];


?>