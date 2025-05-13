<?php

$screenName = $_SESSION["screenName"];

if($screenName == "")
{
    echo "No Screen Name";
    return;
}

$log_dir = $_SESSION["mainPath"] . "tmp/"; // Directorio donde se almacenarán los logs


$log_file = $_SESSION["mainPath"] . "tmp/" . $_SESSION["screenName"] . ".log"; // Ruta del archivo de log

$_SESSION["log_file"] = $log_file;

$screen_id = GetScreenID($screenName);
if (empty($screen_id)) {
    die("No se encontró la sesión de screen con el nombre: $screenName");
}

// Asegurar que la carpeta de logs exista, si no, crearla
if (!file_exists($log_dir)) {
    echo "No Directory";
    mkdir($log_dir, 0700, true); // Crear directorios, si es necesario
}
//echo($log_file);


if (empty($screen_id)) {
    die("<p>No se encontró la sesión de screen con el nombre: $screenName</p>");
}



// Mostrar los logs en tiempo real en la web
?>

<body>


    <h1>Logs de la sesión: <?php echo htmlspecialchars($screenName); ?></h1>
    <div id="log-container"></div>

    <form action="">

    <input type="text" id="lineCommand">
    <button type="button" id="executeCommand">Send</button>

    </form>
    
    <script>
    
    if (document.getElementById('executeCommand') !== null) {
        $("#executeCommand").click(function () {
            SendCommand();
        });
    }

    function SendCommand() 
    {
        let text = "";
        console.log("comprobation");
        if (document.getElementById("lineCommand").value !== null) {

            console.log("executing");
            text = document.getElementById("lineCommand").value;

            $.ajax({
                url: 'functions/sendCommand.php',
                data: {
                    action: text
                },
                type: 'POST',
                success: function (data) 
                {
                    console.log(data);
                }
            });
        }
    }

document.addEventListener("DOMContentLoaded", function () {
        var logContainer = document.getElementById("log-container");
        var userScrolled = false;

        // Detectar si el usuario ha hecho scroll manualmente
        logContainer.addEventListener("scroll", function () {
            // Si el usuario sube, activamos la bandera
            if (logContainer.scrollTop + logContainer.clientHeight < logContainer.scrollHeight - 10) {
                userScrolled = true;
            } else {
                userScrolled = false;
            }
        });

        // Función para hacer scroll automático solo si el usuario no ha subido
        function scrollToBottom() {
            if (!userScrolled) {
                logContainer.scrollTop = logContainer.scrollHeight;
            }
        }

        // Observar cambios en el log
        var observer = new MutationObserver(scrollToBottom);
        observer.observe(logContainer, { childList: true, subtree: true });

        // Hacer scroll inicial al cargar
        setTimeout(scrollToBottom, 1000);
    });


        function fetchLogs() {
            fetch('functions/readLogs.php') // Archivo PHP que devuelve los logs
                .then(response => response.text())
                .then(data => {
                    
                    if(data == "reset")
                    {
                        document.location.href = "";
                    }

                    document.getElementById('log-container').textContent = data;
                });
        }
        setInterval(fetchLogs, 1000); // Actualiza cada segundo
    </script>
</body>
</html>
