<?php


include("base/phpHeader.php");
include("base/root.php");


$createType = $_SESSION["createType"];

if(!isset($createType))
{
    exit();
}

if(unserialize($_SESSION["user"])->role != "admin" && unserialize($_SESSION["user"])->role != "master")
{
    exit();
}

if(unserialize($_SESSION["user"])->role != "master" && ($createType == "master" || $createType = "admin"))
{
    exit();
}




include("base/header.php");


?>


<body class="container">

<h1>Create a new account (Type: <?php echo $createType; ?>)</h1>


<form id="toggleForm">

<div class="row">
    <p class='col-3'>UserName</p>
    <input class='col-9' id="userName" type="text" spellcheck="false" autocapitalize="none" class="form-control" required autofocus>
</div>
<?php

if($createType != "screen")
{
    echo '<div class="row">';
    echo '<p class="col-3">Password</p>';
    echo '<input class="col-9" id="password" type="password" spellcheck="false" autocapitalize="none" class="form-control" required autofocus>';
    echo '</div>';
}
else
{
    echo '<div class="row">';
    echo '<p class="col-3">Init Command</p>';
    echo '<input class="col-9" id="password" type="text" spellcheck="false" autocapitalize="none" class="form-control" required autofocus>';
    echo '</div>';
}

?>

<br>

<div class="container">

<?php

if($createType == "user")
{
    $screenList = GetListScreen();

    foreach ($screenList as $screen) 
    {
        echo "<div class='row'>";
        echo "<p class='col-3'>". $screen->userName ."</p>";
        echo "<input class='col-1 toggle'type='checkbox'>";
        echo "</div>";
    }
}

?>

</div>

<br>

<div class="row">
<button type="submit">Create User</button>
</div>

</form>

</body>


<script>
        document.getElementById("toggleForm").addEventListener("submit", function(event) {
            event.preventDefault();


            const toggles = document.querySelectorAll(".toggle");
            const values = Array.from(toggles).map(toggle => toggle.checked);

            console.log(values);

            $.ajax({
                url: 'functions/registeringProgress.php',
                data: {
                    userName: document.getElementById("userName").value,
                    password: document.getElementById("password").value,
                    role: "<?php echo $createType ?>",
                    screens: JSON.stringify(values)
                },
                type: 'POST',
                success: function (data) 
                {
                    console.log(data);
                    if(data == "")
                    {
                        window.location.href = "admin.php"; // Cambia esto a la página que desees
                    }
                }
            });

        });

    
    </script>