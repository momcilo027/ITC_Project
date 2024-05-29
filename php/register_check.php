<?php 
    $error = [
        'username' => null,
        'email' => null,
        'password' => null
    ];
    $errors = 0;

    $data = [
        'username' => null,
        'email' => null,
        'password' => null
    ]; 

    $token = generateBearerToken(1);

    if(isset($_POST['register_btn'])){
        if(empty($_POST['username'])){
            $errors++;
            $error['username'] = 'USERNAME IS REQUIRED';
        }else{
            $data['username'] = $_POST['username'];
            $user = get_user_by_username($_POST['username'], $token);
            if($user){
                $errors++;
                $error['username'] = 'USERNAME IS TAKEN';
            }
        }
        if(empty($_POST['email'])){
            $errors++;
            $error['email'] = 'EMAIL IS REQUIRED';
        }else{
            $data['email'] = $_POST['email'];
            $user = get_user_by_email($_POST['email'], $token);
            if($user){
                $errors++;
                $error['email'] = 'EMAIL IS TAKEN';
            }
        }
        if(empty($_POST['password'])){
            $errors++;
            $error['password'] = 'PASSWORD IS REQUIRED';
        }else{
            $data['password'] = $_POST['password'];
        }

        if($errors == 0){
            $registration_success = register_user($data['username'], $data['email'], $data['password']);

            if($registration_success == true){
                header("Location: /itc_project/pages/login.php");
                exit();
            }
        }
    }
?>