<?php
    require_once('php-jwt-main/src/JWT.php');
    require_once('php-jwt-main/src/Key.php');

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $global_key = 'ITC_Project';

    function generateBearerToken($user_id = 1){
        global $global_key;
        $payload = [
            'iss' => "localhost",
            'aud' => "localhost",
            'iat' => time(),
            'exp' => time() + 3600, // Token expires in 1h
            'userId' => $user_id
        ];

        return JWT::encode($payload, $global_key, 'HS256');
    }

    function validateToken($token){
        global $global_key;

        try {
            $decoded = JWT::decode($token, new Key($global_key, 'HS256'));

            if (!isset($decoded->iss) || !isset($decoded->aud) || !isset($decoded->iat) || !isset($decoded->exp) || !isset($decoded->userId)) {
                return false;
            }

            if ($decoded->exp < time()) {
                return false;
            }
            return true;

        } catch (Exception $e) {
            return false;
        }
    }


    function authenticateUser(){
        if (!isset($_SESSION['token'])) {
            logout();
            http_response_code(401); // Unauthorized
            exit('Unauthorized');
        }
    
        $token = $_SESSION['token'];
    
        // Validacija tokena
        if (!validateToken($token)) {
            logout();
            http_response_code(401); // Unauthorized
            exit('Unauthorized');
        }
    }


    function logout(){
        session_start();
        $_SESSION['user_id'] = null;
        $_SESSION['token'] = null;
        session_destroy();


        header("Location: http://localhost/itc_project/pages/login.php"); 
        exit();
    }

    if(isset($_POST['logOut_btn'])){
        logout();
    }

?>