<?php 

    $token = generateBearerToken($_GET['id']);
    $company = get_company_by_id($_GET['id'], $token);

    session_start();

    $error = [
        'company_name' => null,
        'company_email' => null,
        'company_address' => null,
        'company_tax_id' => null,
        'company_logo' => null,
    ];
    $errors = 0;

    $data = [
        'company_name' => null,
        'company_email' => null,
        'company_address' => null,
        'company_tax_id' => null,
        'company_logo' => null,
    ]; 
?>