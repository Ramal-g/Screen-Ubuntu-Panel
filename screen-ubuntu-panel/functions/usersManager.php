<?php



function CompileArray($array)
{
    return count($array) > 0 ? "[" . implode(', ', $array) . "]" : "[]";
}

function DecompileArray($string)
{
    $userScreens = trim($string, "[]"); // Quitamos los corchetes

    return explode(", ", $userScreens);
}


function TryToGetScreen($userName)
{
    // Validar entrada
    if (empty($userName)) {
        return NULL;
    }

    // Seguridad: eliminar etiquetas HTML
    $userName = clean_input($userName);

    $users = GetListScreen();

    foreach ($users as $usr)
    {
        if ($userName !== $usr->userName) {
            continue;
        }

        return $usr;
    }

    return NULL;
}


function TryToGetUser($userName, $password)
{
    // Validar entrada
    if (empty($userName) || empty($password)) {
        return NULL;
    }

    // Seguridad: eliminar etiquetas HTML
    $userName = clean_input($userName);
    $password = clean_input($password);

    $users = GetListUsers();

    foreach ($users as $usr)
    {
        if ($userName !== $usr->userName) {
            continue;
        }

        if (hash("sha3-512", $password) !== $usr->password) {
            continue;
        }

        return $usr;
    }

    return NULL;
}


function ReloadScreen($user)
{
    return TryToGetScreen($user);
}


function TryToSaveScreen($user)
{
    $userList = GetListScreen();
    

    for ($i=0; $i < count($userList); $i++) 
    { 
        if ($userList[$i]->userName == $user->userName) {
            unset($userList[$i]);
            break;
        }
    }

    $userList[] = $user;
    SaveScreenCSV($userList, "config/screens.csv");

}

function TryToSaveUser($user)
{
    $userList = GetListScreen();
    

    for ($i=0; $i < count($userList); $i++) 
    { 
        if ($userList[$i]->userName == $user->userName) {
            unset($userList[$i]);
            break;
        }
    }

    $user->password = hash("sha3-512", $user->password);

    $userList[] = $user;
    SaveUserCSV($userList, "config/users.csv");

}

function TryToRegisteUser($username, $password, $role, $screens)
{

    $userList = GetListUsers();


    foreach ($userList as $user) 
    {
        if($user->userName == $username)
        {
            echo "equals userName";
            exit();
        }
    }

    $user = new User();
    $user->id = intval(shell_exec('date +%s%N'));
    $user->userName = $username;
    $user->password = hash("sha3-512", $password);
    $user->role = $role;

    $screenList = GetListScreen();
    $finalNames = [];
    for ($i=0; $i < count($screens); $i++) 
    { 
        if ($screens[$i] == "1") {
            // Si el valor es "1", añadimos el nombre correspondiente
            $finalNames[] = $screenList[$i]->userName;
        }
    }  

    // Convertimos el array a formato de cadena entre corchetes
    $user->screens = CompileArray($finalNames);

    $userList[] = $user;
    SaveUserCSV($userList, "config/users.csv");

}

function TryToRegisteScreen($username, $initCommand)
{

    $userList = GetListScreen();


    foreach ($userList as $user) 
    {
        if($user->userName == $username)
        {
            echo "equals userName";
            exit();
        }
    }

    $user = new Screen();
    $user->id = intval(shell_exec('date +%s%N'));
    $user->userName = $username;
    $user->initCommand = $initCommand;

    $userList[] = $user;
    SaveScreenCSV($userList, "config/screens.csv");

}


function DeleteUser($userID)
{
    $userList = GetListUsers();
    $screenList = GetListScreen();


    for ($i=0; $i < count($userList); $i++) 
    { 
        echo $userList[$i]->id;
        echo "<br>";
        if($userList[$i]->id == $userID)
        {
            unset($userList[$i]);
            SaveUserCSV($userList, "config/users.csv");
            return "finded usrs";
        }
    }

    for ($i=0; $i < count($screenList); $i++) 
    { 
        echo $userList[$i]->id;
        echo "<br>";
        if($screenList[$i]->id == $userID)
        {
            unset($screenList[$i]);
            SaveScreenCSV($screenList, "config/screens.csv");
            return "finded screens";
        }
    }
}


function SaveScreenCSV($userList, $path)
{
    $usersPath = $_SESSION["mainPath"] . $path;
    if (file_exists($usersPath)) 
    {
        $file = fopen($usersPath, "w");

        foreach ($userList as $usr) 
        {
            //echo serialize($usr);
            fputcsv($file, [$usr->id, $usr->userName, $usr->initCommand], ';');
        }
    }
}

function SaveUserCSV($userList, $path)
{
    $usersPath = $_SESSION["mainPath"] . $path;
    if (file_exists($usersPath)) 
    {
        $file = fopen($usersPath, "w");

        foreach ($userList as $usr) 
        {
            //echo serialize($usr);
            fputcsv($file, [$usr->id, $usr->userName, $usr->password, $usr->role, $usr->screens], ';');
        }
    }
}

function GetListScreen()
{
    $usersPath = $_SESSION["mainPath"] . "config/screens.csv";
    
    // Leer el archivo correctamente
    if (!file_exists($usersPath)) {
        echo "error, no file";
        return [];
    }

    $users = fopen($usersPath, "r");
    $return = array();
    if (($users = fopen($usersPath, "r")) !== false) {
        while (($userData = fgetcsv($users, 1000, ';')) !== false) { 
            // Verificar que la línea tenga suficientes columnas
            if (count($userData) < 3) {
                continue; // Saltar líneas incompletas
            }
    
            $usr = new Screen();
            $usr->id = trim($userData[0]);
            $usr->userName = trim($userData[1]);
            $usr->initCommand = trim($userData[2]);
    
            $return[] = $usr; // Agregar usuario al array
        }

    }

    fclose($users);

    return $return;
}

function GetListUsers()
{
    $usersPath = $_SESSION["mainPath"] . "config/users.csv";
    
    // Leer el archivo correctamente
    if (!file_exists($usersPath)) {
        echo "error, no file";
        return [];
    }

    $users = fopen($usersPath, "r");
    $return = array();
    if (($users = fopen($usersPath, "r")) !== false) {
        while (($userData = fgetcsv($users, 1000, ';')) !== false) { 
            // Verificar que la línea tenga suficientes columnas
            if (count($userData) < 3) {
                continue; // Saltar líneas incompletas
            }
    
            $usr = new User();
            $usr->id = trim($userData[0]);
            $usr->userName = trim($userData[1]);
            $usr->password = trim($userData[2]);
            $usr->role = trim($userData[3]);
            $usr->screens = trim($userData[4]);
    
            $return[] = $usr; // Agregar usuario al array
        }

    }

    fclose($users);

    return $return;
}


class Screen
{
    public $id;
    public $userName;
    public $initCommand;

}

class User
{
    public $id;
    public $userName;
    public $password;
    public $role;
    public $screens;

}


?>