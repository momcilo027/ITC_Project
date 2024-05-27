<?php
    require_once('../php/main.php');

    session_start();
    authenticateUser();

    header('Content-Type: application/json');

    $data = isset($_GET['data']) ? $_GET['data'] : '';

    $connection = connection();
    $stmt = $connection->prepare("SELECT * FROM companies");
    if($data !== ''){
        $stmt = $connection->prepare("SELECT * FROM companies WHERE (name LIKE ?)");
        $param = $data."%";
        $stmt->bind_param("s", $param);
    }
    $stmt->execute();
    $results = $stmt->get_result();

    $companis = [];
    foreach($results AS $result){
        array_push($companis, $result);
    }

    $stmt->close();
    $connection->close();

    echo json_encode($companis);
?>