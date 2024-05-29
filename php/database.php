<?php 

function connection(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "itc_project";

    $connection = new mysqli($server, $user, $password, $dbname);

    if ($connection->connect_error) {
        die("Veza nije uspela: " . $connection->connect_error);
    }else{
        return $connection;
    }
}

function data_check($data = null){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>