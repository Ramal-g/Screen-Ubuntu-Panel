<?php
session_start();



$log_file = $_SESSION["mainPath"] . "tmp/" . $_SESSION["screenName"] . ".log";

header("Content-Type: text/plain");

if (file_exists($log_file)) 
{
    $fp = fopen($log_file, "r");
    $lastLine = "";

    // Leer todas las líneas hasta la última
    while (($line = fgets($fp)) !== false) {
        $lastLine = $line; // Al final, contendrá la última línea
    }

    fclose($fp);

    // Si la última línea contiene el string específico, borrar contenido
    if (trim($lastLine) === "[H[J$") {
        $fp = fopen($log_file, "w"); // Modo "w" borra el contenido pero no elimina el archivo
        fclose($fp);
    }
    readfile($log_file);
} 
else 
{
    
}

?>
