<?php 

    $token = generateBearerToken($_GET['id']);
    $company = get_company_by_id($_GET['id'], $token);

    if(!$company){
        header("Location: http://localhost/itc_project/pages/main_page.php");
    }

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


    if(isset($_POST['delete_logo'])){
        delete_company_logo($company['id'], $token);
    }

    if(isset($_POST['delete_company_btn'])){
        delete_company($company['id'], $token);
        remove_company_from_clients($company['id'], $token);
        header("Location: http://localhost/itc_project/pages/main_page.php");
    }


    if(isset($_POST['company_info_update_btn'])){
        if(empty($_POST['company_name'])){
            $errors++;
            $error['company_name'] = 'NAME IS REQUIRED';
        }else{
            $data['company_name'] = $_POST['company_name'];
        }
        if(empty($_POST['company_email'])){
            $errors++;
            $error['company_email'] = 'EMAIL IS REQUIRED';
        }else{
            $data['company_email'] = $_POST['company_email'];
        }
        if(empty($_POST['company_address'])){
            $errors++;
            $error['company_address'] = 'ADDRESS IS REQUIRED';
        }else{
            $data['company_address'] = $_POST['company_address'];
        }
        if(empty($_POST['company_tax_id'])){
            $errors++;
            $error['company_tax_id'] = 'TAX_ID IS REQUIRED';
        }else{
            $data['company_tax_id'] = $_POST['company_tax_id'];
        }
        if (isset($_FILES['company_logo']) && $_FILES['company_logo']['error'] == 0) {
            $image = $_FILES['company_logo']['tmp_name'];
    
            $check = getimagesize($image);
            $fileSizeBytes = filesize($image);
            $KBs = $fileSizeBytes / 1024;

            if ($check !== false) {
                if($KBs <= 10){
                    $imageData = file_get_contents($image);
                    $base64Image = base64_encode($imageData);
                    $data['company_logo'] = $base64Image;
                }else{
                    $errors++;
                    $error['company_logo'] = 'Image is too large.';
                }
            } else {
                $errors++;
                $error['company_logo'] = 'File is not an image.';
            }
        }

        if($errors == 0){
            update_company($company['id'], $data['company_name'], $data['company_email'], $data['company_address'], $data['company_tax_id'], $data['company_logo'], $token);
            header("Location: http://localhost/itc_project/pages/company_info.php?id=".$company['id']);
        }
    }

    if(isset($_POST['add_client_to_company'])){
        if(!empty($_POST['add_client_search_for_company'])){
            add_client_to_company($company['id'], $_POST['add_client_search_for_company'], $token);
            header("Location: http://localhost/itc_project/pages/company_info.php?id=".$company['id']);
        }
    }


    if(isset($_POST['remove_client_from_company'])){
        remove_client_from_company($company['id'], $_POST['remove_client_from_company'], $token);
        header("Location: http://localhost/itc_project/pages/company_info.php?id=".$company['id']);
    }
?>