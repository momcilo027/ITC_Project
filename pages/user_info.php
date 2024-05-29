<?php 
    require_once('../include/header.php');
    require_once('../php/user_info.php'); 
    // session_start();
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
?>



<div class="user_info_container">
    <div class="main_page_heading_div">
        <h1 class="main_page_heading">ITC PROJECT</h1>
        <div class="main_page_heading_user_info">
            <label>Welcome, </label>
            <label onclick="location.href = 'http://localhost/itc_project/pages/user_info.php?id=<?php echo $_SESSION['user_id']; ?>'" class="user_username"><?php echo $active_user['username']; ?></label>
            <label class="user_role">(<?php echo $active_user['role']; ?>) </label>
            <form method="POST">
                <button class="logOut_btn" name="logOut_btn"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
        
    </div>
    <div class="return_field">
        <button onclick="location.href='main_page.php'">< Go back</button>
    </div>
    <form class="user_info_content_div" method="POST">
        <div class="user_info_content_heading">
            <h1>USER INFORMATION</h1>
            <a class="API_link" href="http://localhost/itc_project/API/all_users.php" target="_blank">ALL USERS API</a>
        </div>
        <div class="user_info_content">
            <div class="user_info_inputs">
                <div class="user_info_inputs_left">
                    <div class="<?php if($error['user_name'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                        <label for="user_name">Name</label>
                        <input 
                            type="text" 
                            id="user_name" 
                            name="user_name"
                            placeholder="<?php echo $error['user_name']; ?>"
                            value="<?php if($error['user_name'] !== null ){ echo null; }else{echo $user['name'];} ?>"
                            autocomplete="off"
                        >
                    </div>
                    <div class="<?php if($error['user_username'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                        <label for="user_username">Username</label>
                        <input 
                            type="text" 
                            id="user_username" 
                            name="user_username"
                            placeholder="<?php echo $error['user_username']; ?>"
                            value="<?php if($error['user_username'] !== null ){ echo null; }else{echo $user['username'];} ?>"
                            autocomplete="off"
                        >
                    </div> 
                    <div class="<?php if($error['user_email'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                        <label for="user_email">Email</label>
                        <input 
                            type="email" 
                            id="user_email" 
                            name="user_email"
                            placeholder="<?php echo $error['user_email']; ?>"
                            value="<?php if($error['user_email'] !== null ){ echo null; }else{echo $user['email'];} ?>"
                            autocomplete="off"
                        >
                    </div> 
                    <div class="login_input">
                        <label for="user_password">Password</label>
                        <input 
                            type="password" 
                            id="user_password" 
                            name="user_password"
                            placeholder="<?php echo $error['user_password']; ?>"
                        >
                    </div> 
                </div>   
                <div class="user_info_inputs_right">
                    <div style="position: relative;" class="login_input">
                        <label for="user_role">Role</label>
                        <input 
                            type="text" 
                            id="user_role" 
                            name="user_role"
                            placeholder=""
                            style="width: 60%;"
                            value="<?php echo $user['role']; ?>"
                            disabled
                        >

                        <?php if($active_user['role'] == 'Super Admin' AND $user['role'] !== 'Super Admin'): ?>
                            <?php if($user['role'] == 'Admin'): ?>
                                <button type="submit" name="demote_btn" class="promote_to_admin">Demote to USER</button>
                            <?php else:?>
                                <button type="submit" name="promote_btn" class="promote_to_admin">Promote to ADMIN</button>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div> 
                    <div class="login_input">
                        <label for="user_created_at">Created_at</label>
                        <input 
                            type="text" 
                            id="user_created_at" 
                            name="user_created_at"
                            placeholder=""
                            value="<?php echo $user['created_at']; ?>"
                            disabled
                        >
                    </div> 
                    <div class="delete_div">
                        <?php if($active_user['role'] == 'Super Admin' AND $user['role'] !== 'Super Admin'): ?>
                            <button type="submit" class="delete_btn" name="delete_user_btn">DELETE USER</button>
                        <?php elseif($active_user['role'] !== 'Admin' AND $user['role'] == 'User'): ?>
                            <button type="submit" class="delete_btn" name="delete_user_btn">DELETE USER</button>
                        <?php elseif($active_user['role'] == 'User' AND $user['role'] == 'User'): ?>
                            <button type="submit" class="delete_btn" name="delete_user_btn">DELETE USER</button>
                        <?php elseif($active_user['role'] !== 'Super Admin' AND $user['id'] == $active_user['id']): ?>
                            <button type="submit" class="delete_btn" name="delete_user_btn">DELETE USER</button>
                        <?php elseif($active_user['role'] == 'Admin' AND $user['role'] == 'User'): ?>
                            <button type="submit" class="delete_btn" name="delete_user_btn">DELETE USER</button>
                        <?php endif; ?>
                    </div> 
                </div>
            </div>
            <div class="user_info_btn_div">
                <?php if($active_user['role'] == 'Super Admin'): ?>
                    <button class="user_info_btn" name="user_info_update_btn" type="submit">UPDATE</button>
                <?php elseif($active_user['role'] !== 'Super Admin' AND $user['role'] == 'Super Admin'): ?>
                    <button class="user_info_btn" disabled>UPDATE</button>
                <?php elseif($active_user['role'] == 'User' AND $user['role'] !== 'User'): ?>
                    <button class="user_info_btn" disabled>UPDATE</button>
                <?php else: ?>
                    <button class="user_info_btn" name="user_info_update_btn" type="submit">UPDATE</button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<?php 
    require_once('../include/footer.php'); 
?>