<?php

include("base/phpHeader.php");
include("base/root.php");

if(!isset($_SESSION["editObject"]))
{
    exit();
}

echo unserialize($_SESSION["editObject"]);



?>