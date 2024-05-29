<?php 

    $token = generateBearerToken($_GET['id']);
    $client = get_client_by_id($_GET['id'], $token);

    if(!$client){
        header("Location: http://localhost/itc_project/pages/main_page.php");
    }

    session_start();

    $error = [
        'client_name' => null,
        'client_email' => null,
        'client_phone' => null
    ];
    $errors = 0;

    $data = [
        'client_name' => null,
        'client_email' => null,
        'client_phone' => null
    ]; 


    if(isset($_POST['add_company_to_client'])){
        if(!empty($_POST['add_company_search_for_client'])){
            add_company_to_client($client['id'], $_POST['add_company_search_for_client'], $token);
        }
    }

    if(isset($_POST['remove_company_from_client'])){
        remove_client_from_company($_POST['remove_company_from_client'], $client['id'], $token);
        header("Location: http://localhost/itc_project/pages/client_info.php?id=".$client['id']);
    }


    if(isset($_POST['client_info_update_btn'])){
        if(empty($_POST['client_name'])){
            $errors++;
            $error['client_name'] = 'NAME IS REQUIRED';
        }else{
            $data['client_name'] = $_POST['client_name'];
            $client_data = get_client_by_name($_POST['client_name'], $token);
            if($client_data){
                if($client_data['id'] !== $client['id']){
                    $errors++;
                    $error['client_name'] = 'NAME IS TAKEN';
                }
            }
        }
        if(empty($_POST['client_email'])){
            $errors++;
            $error['client_email'] = 'EMAIL IS REQUIRED';
        }else{
            $data['client_email'] = $_POST['client_email'];
            $client_data = get_client_by_email($_POST['client_email'], $token);
            if($client_data){
                if($client_data['id'] !== $client['id']){
                    $errors++;
                    $error['client_email'] = 'EMAIL IS TAKEN';
                }
            }
        }
        if(empty($_POST['client_phone'])){
            $errors++;
            $error['client_phone'] = 'ADDRESS IS REQUIRED';
        }else{
            $data['client_phone'] = $_POST['client_phone'];
        }
        
        if($errors == 0){
            update_client($client['id'], $data['client_name'], $data['client_email'], $data['client_phone'], $token);
            header("Location: http://localhost/itc_project/pages/client_info.php?id=".$client['id']);
        }
    }

    if(isset($_POST['delete_client_btn'])){
        delete_client($client['id'], $token);
        header("Location: http://localhost/itc_project/pages/main_page.php");
    }

?>