<?php 

function register_user($username, $email, $password){
    $connection = connection();
    
    $token = generateBearerToken();
    $users = get_users($token);

    $role = '';

    if($users->num_rows == 0){
        $stmt = $connection->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("(Prepare query) ERROR: " . $connection->error);
        }
        $role = 'Super Admin';
        $stmt->bind_param("sssss", $username, $email, $hashedPassword, $role, $today);
    }else{
        $stmt = $connection->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("(Prepare query) ERROR: " . $connection->error);
        }
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $today);
    }

    $today = date('Y-m-d H:i:s');
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();

        return true;
    } else {
        $stmt->close();
        $connection->close();

        return false;
    }
}

function get_user_by_username($username = null, $token = null){
    if ($username === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $user;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}


function get_users($token = null){
    if ($token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();
    $stmt = $connection->prepare("SELECT * FROM users");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        $stmt->close();
        $connection->close();
        return $result;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function get_user_by_id($id = null, $token = null){
    if ($id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $user;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

?>