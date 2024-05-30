<?php 

    $token = generateBearerToken($_GET['id']);
    $user = get_user_by_id($_GET['id'], $token);

    if(!$user){
        header("Location: http://localhost/itc_project/pages/main_page.php");
    }

    session_start();

    $error = [
        'user_name' => null,
        'user_username' => null,
        'user_email' => null,
        'user_password' => null
    ];
    $errors = 0;

    $data = [
        'user_name' => null,
        'user_username' => null,
        'user_email' => null,
        'user_password' => null
    ]; 

    if(isset($_POST['user_info_update_btn'])){
        if(empty($_POST['user_name'])){
            $errors++;
            $error['user_name'] = 'NAME IS REQUIRED';
        }else{
            $data['user_name'] = $_POST['user_name'];
        }
        if(empty($_POST['user_username'])){
            $errors++;
            $error['user_username'] = 'USERNAME IS REQUIRED';
        }else{
            $data['user_username'] = $_POST['user_username'];
            $un_user = get_user_by_username($data['user_username'], $token);
            if($un_user){
                if($un_user['id'] !== $user['id']){
                    $errors++;
                    $error['user_username'] = 'USERNAME IS TAKEN';
                }
            }
        }
        if(empty($_POST['user_email'])){
            $errors++;
            $error['user_email'] = 'EMAIL IS REQUIRED';
        }else{
            $data['user_email'] = $_POST['user_email'];
            $em_user = get_user_by_email($data['user_email'], $token);
            if($em_user){
                if($em_user['id'] !== $user['id']){
                    $errors++;
                    $error['user_email'] = 'EMAIL IS TAKEN';
                }
            }
        }
        if(!empty($_POST['user_password'])){
            $data['user_password'] = $_POST['user_password'];
        }

        if($errors == 0){
            if($data['user_password'] !== null){
                update_user_with_pw($user['id'], $data['user_name'], $data['user_username'], $data['user_email'], $data['user_password'], $token);
                header("Location: http://localhost/itc_project/pages/user_info.php?id=".$user['id']);
            }else{
                update_user_without_pw($user['id'], $data['user_name'], $data['user_username'], $data['user_email'], $token);
                header("Location: http://localhost/itc_project/pages/user_info.php?id=".$user['id']);
            }
        }
    }

    if(isset($_POST['promote_btn'])){
        $role = "Admin";
        if(update_user_role($user['id'], $role, $token)){
            header("Location: http://localhost/itc_project/pages/user_info.php?id=".$user['id']);
        }
    }

    if(isset($_POST['demote_btn'])){
        $role = "User";
        if(update_user_role($user['id'], $role, $token)){
            header("Location: http://localhost/itc_project/pages/user_info.php?id=".$user['id']);
        }
    }

    if(isset($_POST['delete_user_btn'])){
        if(delete_user($user['id'], $token)){
            if($user['id'] == $_SESSION['user_id']){
                logout();
            }else{
                header("Location: http://localhost/itc_project/pages/main_page.php");
            }
        }
    }
?>