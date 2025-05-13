<?php

    if(!isset($_POST['userName']) ||  !isset($_POST['password']))
    {
        exit();
    }

    include("../base/phpHeader.php");

    $result = TryToGetUser($_POST['userName'], $_POST['password']);

        if($result != NULL)
        {
            $_SESSION["user"] = serialize($result);
            echo unserialize($_SESSION["user"])->role;
            
            if(unserialize($_SESSION["user"])->role == "admin")
            {
                header("Location: ../admin.php");
            }
            else if(unserialize($_SESSION["user"])->role == "master")
            {
                header("Location: ../admin.php");
            }
            else
            {
                header("Location: ../user.php");
            }

            exit();
        }
        else
        {
            echo "error no correct";
            header("Location: ../login.php");
            exit();
        }


?>