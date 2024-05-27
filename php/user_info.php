<?php 

    $token = generateBearerToken($_GET['id']);
    $user = get_user_by_id($_GET['id'], $token);

?>