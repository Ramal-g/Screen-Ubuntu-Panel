<?php

include("base/phpHeader.php");
include("base/root.php");


include("base/header.php");

if(isset($_POST['userName']) && isset($_POST['password']))
{
    include_once("functions/loggingProggress.php");
}

?>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="container p-4 bg-light border rounde np-3 col-6">

    <form action="login.php" method="post">

    <div class="row mb-3 justify-content-center">
        <img src="resources/logos/programLogo.png" alt="" class="img-fluid" style="max-width: 600px;">
    </div>

    <div class="row">
    <input type="text" id="inputUser" name="userName" spellcheck="false" autocapitalize="none" class="form-control" placeholder="UserName" required autofocus>
    </div>


    <div class="row">
    <input type="password" name="password" spellcheck="false" autocapitalize="none" class="form-control" placeholder="Password" required autofocus>
    </div>

    <br>
    <br>

    <div class="row">
    <input type="submit" value="Login">
    </div>

    </form>

</div>

    
</body>
</html>