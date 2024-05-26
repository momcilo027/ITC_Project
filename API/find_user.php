<?php
    require_once('../php/main.php');

    session_start();
    authenticateUser();

    header('Content-Type: application/json');

    $data = isset($_GET['data']) ? $_GET['data'] : '';

    if (empty($data)) {
        // echo json_encode(['error' => 'Parameter "name" is required']);
        echo json_encode([]);
        exit;
    }

    $connection = connection();
    $stmt = $connection->prepare("SELECT * FROM users WHERE (username LIKE ?) OR (name LIKE ?)");
    $param = $data."%";
    $stmt->bind_param("ss", $param, $param);
    $stmt->execute();
    $results = $stmt->get_result();

    $users = [];
    foreach($results AS $result){
        array_push($users, $result);
    }

    $stmt->close();
    $connection->close();

    echo json_encode($users);
?>