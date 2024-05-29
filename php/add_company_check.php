<?php 

    session_start();
    
    $error = [
        'company_name' => null,
        'company_email' => null,
        'logo' => null,
        'company_address' => null,
        'company_tax_id' => null,
    ];
    $errors = 0;

    $data = [
        'company_name' => null,
        'company_email' => null,
        'logo' => null,
        'company_address' => null,
        'company_tax_id' => null,
    ];

    if(isset($_POST['add_company_save_btn'])){
        if(empty($_POST['company_name'])){
            $errors++;
            $error['company_name'] = 'COMPANY NAME IS REQUIRED';
        }else{
            $data['company_name'] = $_POST['company_name'];
            $company_get = get_company_by_name($_POST['company_name'], $_SESSION['token']);
            if($company_get){
                $errors++;
                $error['company_name'] = 'COMPANY ALREADY EXISTS';
            }
        }
        if(empty($_POST['company_email'])){
            $errors++;
            $error['company_email'] = 'COMPANY EMAIL IS REQUIRED';
        }else{
            $data['company_email'] = $_POST['company_email'];
            $company_get = get_company_by_email($_POST['company_email'], $_SESSION['token']);
            if($company_get){
                $errors++;
                $error['company_email'] = 'COMPANY EMAIL IS TAKEN';
            }
        }
        if(empty($_POST['company_address'])){
            $errors++;
            $error['company_address'] = 'COMPANY ADDRESS IS REQUIRED';
        }else{
            $data['company_address'] = $_POST['company_address'];
        }
        if(empty($_POST['company_tax_id'])){
            $errors++;
            $error['company_tax_id'] = 'COMPANY TAX ID IS REQUIRED';
        }else{
            $data['company_tax_id'] = $_POST['company_tax_id'];
        }



        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
            $image = $_FILES['logo']['tmp_name'];
    
            $check = getimagesize($image);
            $fileSizeBytes = filesize($image);
            $KBs = $fileSizeBytes / 1024;

            if ($check !== false) {
                if($KBs <= 10){
                    $imageData = file_get_contents($image);
                    $base64Image = base64_encode($imageData);
                    $data['logo'] = $base64Image;
                }else{
                    $errors++;
                    $error['logo'] = 'Image is too large.';
                }
            } else {
                $errors++;
                $error['logo'] = 'File is not an image.';
            }
        } else {
            $errors++;
            $error['logo'] = 'File is not an image.';
        }

        if($errors == 0){
            create_company($data['company_name'], $data['company_email'], $data['logo'], $data['company_address'], $data['company_tax_id']);
        }
    }
?>