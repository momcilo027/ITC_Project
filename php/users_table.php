<?php 

function register_user($username, $email, $password){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $username = data_check($username);
    $email = data_check($email);
    $password = data_check($password);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

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

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $username = data_check($username);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

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

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $id = data_check($id);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

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

function get_user_by_email($email = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $email = data_check($email);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($email === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $email);

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

function update_user_role($id = null, $role = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $id = data_check($id);
    $role = data_check($role);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($id === null || $role === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("UPDATE users SET role = ? WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("si", $role, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function delete_user($id = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $id = data_check($id);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}


function update_user_with_pw($id = null, $name= null , $username = null, $email = null, $password = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $id = data_check($id);
    $name = data_check($name);
    $username = data_check($username);
    $email = data_check($email);
    $password = data_check($password);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($id === null || $name === null || $username === null || $email === null || $password === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("UPDATE users SET name = ?, username = ?, email = ?, password = ? WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt->bind_param("ssssi", $name, $username, $email, $hashedPassword, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function update_user_without_pw($id = null, $name= null , $username = null, $email = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $id = data_check($id);
    $name = data_check($name);
    $username = data_check($username);
    $email = data_check($email);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($id === null || $name === null || $username === null || $email === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("UPDATE users SET name = ?, username = ?, email = ? WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("sssi", $name, $username, $email, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

?>