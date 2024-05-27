<?php 

function create_company($c_name = null, $c_email = null, $logo = null, $address = null, $tax_id = null){
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
?>