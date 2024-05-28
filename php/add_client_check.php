<?php 
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

    if(isset($_POST['add_client_save_btn'])){
        if(empty($_POST['client_name'])){
            $errors++;
            $error['client_name'] = 'CLIENT NAME IS REQUIRED';
        }else{
            $data['client_name'] = $_POST['client_name'];
        }
        if(empty($_POST['client_email'])){
            $errors++;
            $error['client_email'] = 'CLIENT EMAIL IS REQUIRED';
        }else{
            $data['client_email'] = $_POST['client_email'];
        }
        if(empty($_POST['client_phone'])){
            $errors++;
            $error['client_phone'] = 'CLIENT PHONE IS REQUIRED';
        }else{
            $data['client_phone'] = $_POST['client_phone'];
        }



        if($errors == 0){
            create_client($data['client_name'], $data['client_email'], $data['client_phone']);
        }
    }
?>