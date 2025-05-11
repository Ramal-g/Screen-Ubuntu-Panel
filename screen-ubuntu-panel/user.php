<?php

include("base/phpHeader.php");
include("base/root.php");

if(unserialize($_SESSION["user"])->role != "user")
{
    echo unserialize($_SESSION["user"])->role;
    header("Location: admin.php");
    exit();
}



include("base/header.php");

?>

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


<body>

    <div class="container">

        <br>
        <div class="row">

        <h1 class='col-10'>Welcome Back <?php echo unserialize($_SESSION["user"])->userName ?></h1>
        <button class='col-2 btn btn-secondary' onclick='LogOut()'>Logout</button>

        </div>

    </div>

    <div class="container p-4 bg-secondary border rounde np-3 col-12">

    <div class="row">

        <h1 class='text-light'>Your Screens</h1>
        

    </div>

    <?php


        $userScreens = DecompileArray(unserialize($_SESSION["user"])->screens);

        foreach ($userScreens as $screen) 
        {
            $accountUser = TryToGetScreen($screen);
            include("objects/adminAccount.php");
        }

        
        

    ?>



</div>

</body>