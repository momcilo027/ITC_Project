<?php 
    $error = [
        'username' => null,
        'password' => null
    ];
    $errors = 0;

    $data = [
        'username' => null,
        'password' => null
    ]; 

    if(isset($_POST['login_btn'])){
        if(empty($_POST['username'])){
            $errors++;
            $error['username'] = 'USERNAME IS REQUIRED';
        }else{
            $data['username'] = $_POST['username'];
            $token = generateBearerToken();
            $get_user = get_user_by_username($data['username'], $token);
            if($get_user){
                if(empty($_POST['password'])){
                    $errors++;
                    $error['password'] = 'PASSWORD IS REQUIRED';
                }else{
                    $data['password'] = $_POST['password'];
                    if(password_verify($data['password'], $get_user['password'])){
                        session_start();
                        $token = generateBearerToken($get_user['id']);
                        $_SESSION['token'] = $token;
                        $_SESSION['user_id'] = $get_user['id'];
                        header("Location: /itc_project/pages/main_page.php");
                        exit();
                    }else{
                        $errors++;
                        $error['password'] = 'PASSWORD IS INCORRECT';
                    }
                }
            }else{
                $errors++;
                $error['username'] = "USERNAME DOESN'T EXIST";
                $data['username'] = "";
            }
        }
    }
?>