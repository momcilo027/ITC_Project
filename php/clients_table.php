<?php 

function create_client($client_name = null, $client_email = null, $client_phone = null){
    $connection = connection();

    $stmt = $connection->prepare("INSERT INTO clients (name, email, phone, created_at) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("(Prepare query) ERROR: " . $connection->error);
    }
    $today = date('Y-m-d H:i:s');
    $stmt->bind_param("ssss", $client_name, $client_email, $client_phone, $today);
    
    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();

        // return true;
        header("Location: http://localhost/itc_project/pages/main_page.php");
    } else {
        $stmt->close();
        $connection->close();

        return false;
    }
}

function get_client_by_name($name = null, $token = null){
    if ($name === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM clients WHERE name = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $client;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function get_client_by_email($email = null, $token = null){
    if ($email === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM clients WHERE email = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $client;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function get_client_by_id($id = null, $token = null){
    if ($id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM clients WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $client;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}


function add_client_to_company($company_id = null, $client = null, $token = null){
    if ($company_id === null || $client === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $client_data = get_client_by_name($client, $token);
    if($client_data){
        $client_c_ids = json_decode($client_data['company_id'], true);
        if ($client_c_ids === null) {
            $client_c_ids = [];
        }

        if (!in_array($company_id, $client_c_ids)) {
            $client_c_ids[] = $company_id;
        }

        $client_c_ids_json = json_encode($client_c_ids);

        $stmt = $connection->prepare("UPDATE clients SET company_id = ? WHERE id = ?");
        if ($stmt === false) {
            return "(Prepare query) ERROR: " . $connection->error;
        }

        $stmt->bind_param("si", $client_c_ids_json, $client_data['id']);

        if ($stmt->execute()) {
            $stmt->close();
            $connection->close();
            return true;
        } else {
            return "(Compile query) ERROR: " . $stmt->error;
        }
    }else{
        return "Client doesn't exist!";
    }
}

function get_clients($token = null){
    if ($token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();
    $stmt = $connection->prepare("SELECT * FROM clients");
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


function set_client_companies($companies = null, $client_id = null, $token = null){
    if ($companies === null || $client_id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $companies = json_encode($companies);

    $connection = connection();
    $stmt = $connection->prepare("UPDATE clients SET company_id = ? WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }
    $stmt->bind_param("si", $companies, $client_id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}


function get_companies_for_client($client_id = null, $token = null){
    if ($client_id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $client = get_client_by_id($client_id, $token);
    $companies_id = json_decode($client['company_id'], true);
    $companies = [];
    if($companies_id !== null){
        foreach($companies_id AS $id){
            $company = get_company_by_id($id, $token);
            array_push($companies, $company);
        }
    }

    return $companies;
}

function add_company_to_client($client_id = null, $company_name = null, $token = null){
    if ($client_id === null || $company_name === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $company = get_company_by_name($company_name, $token);
    $client = get_client_by_id($client_id, $token);

    $client_c_ids = json_decode($client['company_id'], true);

    if($client_c_ids !== null){
        if (!in_array($company['id'], $client_c_ids)) {
            $client_c_ids[] = $company['id'];
        }
    }else{
        $client_c_ids = [];
    }

    $stmt = $connection->prepare("UPDATE clients SET company_id = ? WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $client_c_ids_json = json_encode($client_c_ids);

    $stmt->bind_param("si", $client_c_ids_json, $client_id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function update_client($id = null, $name= null, $email = null, $phone = null, $token = null){
    if ($id === null || $name === null || $email === null || $phone === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("UPDATE clients SET name = ?, email = ?, phone = ? WHERE id = ?");

    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("sssi", $name, $email, $phone, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}


function delete_client($id = null, $token = null){
    if ($id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("DELETE FROM clients WHERE id = ?");
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

?>