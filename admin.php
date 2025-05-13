<?php
include("base/phpHeader.php");
include("base/root.php");

//No user
if(!isset($_SESSION["user"]))
{
    echo "No user";
    header("Location: login.php");
    exit();
}

//No admin
if(unserialize($_SESSION["user"])->role != "admin" && unserialize($_SESSION["user"])->role != "master")
{
    echo "Bad user";
    header("Location: user.php");
    exit();
}


include("base/header.php");
?>


<body>
    
<div class="container">

    <br>
    <div class="row">

    <h1 class='col-11'>Welcome Back <?php echo unserialize($_SESSION["user"])->userName ?> to the admin page</h1>
    <button class='col-1 btn btn-secondary' onclick='LogOut()'>Logout</button>

    </div>

</div>

<br>

<div class="container p-4 bg-secondary border rounde np-3 col-12">

    <div class="row">

        <h1 class='text-light col-10'>Actual Screens</h1>
        <button onclick="Registe('screen')" class="col-2">Create a new Screen</button>

    </div>

    <?php

        $screens = GetListScreen();

        foreach ($screens as $screen) 
        {
            $accountUser = $screen;
            include("objects/adminAccount.php");
        }


        

    ?>



</div>

<br><br>

<?php

if(unserialize($_SESSION["user"])->role == "master")
{
    include("objects/adminView.php");
    echo "<br><br>";
    include("objects/userView.php");
}

if(unserialize($_SESSION["user"])->role == "admin")
{
    include("objects/userView.php");
}

?>

<br><br>

<div class="container">
    <div class="row">

    <button class="btn btn-primary"><?php echo "Configure " . unserialize($_SESSION["user"])->userName . " account"  ?></button>

    </div>
</div>




<script>

function LogOut() 
{
    fetch('functions/logout.php') // Archivo PHP que devuelve los logs
        .then(response => response.text())
        .then(data => {
            document.location.href = "";
        });


}
function Enter(usr)
    {
        $.ajax({
                url: 'functions/openScreen.php',
                data: {
                    screen: usr,
                },
                type: 'POST',
                success: function (data) 
                {
                    window.location.href = "index.php"; // Cambia esto a la página que desees
                    console.log(data);
                }
            });
    }

</script>

<script src="js/registerAjax.js"></script>

</body>

