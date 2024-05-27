<?php
    require_once('../php/main.php');

    session_start();
    authenticateUser();

    header('Content-Type: application/json');

    $data = isset($_GET['data']) ? $_GET['data'] : '';

    if (empty($data)) {
        echo json_encode([]);
        exit;
    }

    $connection = connection();
    $stmt = $connection->prepare("SELECT * FROM companies WHERE name LIKE ?");
    $param = $data."%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $results = $stmt->get_result();

    $companies = [];
    foreach($results AS $result){
        array_push($companies, $result);
    }

    $stmt->close();
    $connection->close();

    echo json_encode($companies);
?>