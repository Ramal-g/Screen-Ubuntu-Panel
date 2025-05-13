<?php

session_start();


if(isset($_POST["screen"]))
{
    $_SESSION["screenName"] = $_POST["screen"];
    echo "Saved screenName";
}

?>