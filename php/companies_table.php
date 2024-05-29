<?php 

function create_company($c_name = null, $c_email = null, $logo = null, $address = null, $tax_id = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $c_name = data_check($c_name);
    $c_email = data_check($c_email);
    $logo = data_check($logo);
    $address = data_check($address);
    $tax_id = data_check($tax_id);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    $connection = connection();

    $stmt = $connection->prepare("INSERT INTO companies (name, email, logo, address, tax_id, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("(Prepare query) ERROR: " . $connection->error);
    }
    $today = date('Y-m-d H:i:s');
    $stmt->bind_param("ssssss", $c_name, $c_email, $logo, $address, $tax_id, $today);
    
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


function get_companies($token = null){
    if ($token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();
    $stmt = $connection->prepare("SELECT * FROM companies");
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

function get_company_by_id($id = null, $token = null){

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

    $stmt = $connection->prepare("SELECT * FROM companies WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $company = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $company;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function get_company_by_name($name = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $name = data_check($name);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($name === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("SELECT * FROM companies WHERE name = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $company = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $company;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function get_company_by_email($email = null, $token = null){

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

    $stmt = $connection->prepare("SELECT * FROM companies WHERE email = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $company = $result->fetch_assoc();

        $stmt->close();
        $connection->close();
        return $company;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function delete_company_logo($id = null, $token = null){

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

    $stmt = $connection->prepare("UPDATE companies SET logo = ? WHERE id = ?");
    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }
    $logo = null;
    $stmt->bind_param("si", $logo, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}

function delete_company($id = null, $token = null){

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

    $stmt = $connection->prepare("DELETE FROM companies WHERE id = ?");
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


function update_company($id = null, $name= null ,$email = null, $address = null, $tax_id = null, $logo = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $id = data_check($id);
    $name = data_check($name);
    $email = data_check($email);
    $address = data_check($address);
    $tax_id = data_check($tax_id);
    $logo = data_check($logo);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($id === null || $name === null || $email === null || $address === null || $tax_id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $connection = connection();

    $stmt = $connection->prepare("UPDATE companies SET name = ?, email = ?, address = ?, tax_id = ? , logo = ? WHERE id = ?");
    if($logo == null OR $logo == NULL OR $logo == "NULL"){
        $stmt = $connection->prepare("UPDATE companies SET name = ?, email = ?, address = ?, tax_id = ? WHERE id = ?");
    }

    if ($stmt === false) {
        return "(Prepare query) ERROR: " . $connection->error;
    }

    if($logo == null OR $logo == NULL OR $logo == "NULL"){
        $stmt->bind_param("ssssi", $name, $email, $address, $tax_id, $id);
    }else{
        $stmt->bind_param("sssssi", $name, $email, $address, $tax_id, $logo, $id);
    }

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        return true;
    } else {
        return "(Compile query) ERROR: " . $stmt->error;
    }
}


function get_company_clients($company_id = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $company_id = data_check($company_id);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($company_id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $clients = get_clients($token);
    $in_company_clients = [];

    foreach($clients AS $client){
        $is_in_company = false;
        $company_ids = json_decode($client['company_id'], true);
        if($company_ids !== null){
            foreach($company_ids AS $id){
                if($id == $company_id){
                    $is_in_company = true;
                }
            }
        }
        if($is_in_company == true){
            array_push($in_company_clients, $client);
        }
    }

    return $in_company_clients;
}

function remove_client_from_company($company_id = null, $client_id = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $company_id = data_check($company_id);
    $client_id = data_check($client_id);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($company_id === null || $client_id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $client = get_client_by_id($client_id, $token);
    
    $ids = json_decode($client['company_id'], true);
    
    if (!is_array($ids)) {
        return "Invalid company_id format.";
    }

    $filtered_ids = [];
    
    foreach ($ids as $id) {
        if ((int)$id !== (int)$company_id) {
            $filtered_ids[] = $id;
        }
    }
    set_client_companies($filtered_ids, $client_id, $token);
}

function remove_company_from_clients($company_id = null, $token = null){

    // ************* (start) data check (start) *************
    // ************* (start) data check (start) *************
    $company_id = data_check($company_id);
    // ************* (end) data check (end) *************
    // ************* (end) data check (end) *************

    if ($company_id === null || $token === null) {
        return false;
    }

    if (!validateToken($token)) {
        return "Invalid JWT token.";
    }

    $clients = get_clients($token);
    

    if($clients->num_rows !== 0){
        foreach($clients AS $client){
            remove_client_from_company($company_id, $client['id'], $token);
        }
    }
}
?>