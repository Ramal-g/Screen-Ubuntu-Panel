<?php

if(!isset($accountUser))
{
    exit();
}


?>


<br>
<div class="row bg-light d-flex justify-content-center align-items-center">

    <div class="row col-md-6">
        <h1><?php

        echo $accountUser->userName;
        
        
        ?></h1>
    </div>

    <div class="row col-md-2">
        <?php

            $write = TRUE;
            if(isset($accountUser->role))
            {
                $write = FALSE;
            }

            if($write)
            {
                echo "<button onclick=Enter('". $accountUser->userName ."') class='btn btn-secondary'>Enter</button>";
            }
            else $write = TRUE;
        ?>
        
    </div>
    
    <div class="row col-md-2">
        <?php

            $write = TRUE;

            if(unserialize($_SESSION["user"])->role == "user")
            {
                $write = FALSE;
            }
            
            if($write)
            {
                echo "<a class='btn btn-primary' href='edit.php'>";
                echo "Edit";
                echo "</a>";
                
            }
            else $write = TRUE;
        ?>
        
    </div>
    <div class="row col-md-2">
        <?php

        $write = TRUE;

        if(unserialize($_SESSION["user"])->role == "user")
        {
            $write = FALSE;
        }
        
        if($write)
        {
            echo "<button onclick=DeleteAccount('". $accountUser->id ."') class='btn btn-danger'>Delete</button>";
        }
        else $write = TRUE;
        ?>
    </div>

</div>


<?php

//Reset Variables

$accountUser = NULL;

?>