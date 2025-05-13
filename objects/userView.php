<div class="container p-4 bg-secondary border rounde np-3 col-12">

<div class="row">

    <h1 class='text-light col-10'>Actual Users</h1>
    <button onclick="Registe('user')" class="col-2">Create a new user</button>


</div>

    <?php

        $users = GetListUsers();

        foreach ($users as $user) 
        {
            if($user->role != "user")
            {
                continue;
            }
            
            $accountUser = $user;
            include("objects/adminAccount.php");
        }


        

    ?>



</div>