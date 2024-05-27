<?php 
    require_once('../include/header.php');
    require_once('../php/user_info.php'); 
    session_start();
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
?>



<div class="user_info_container">
    <div class="main_page_heading_div">
        <h1 class="main_page_heading">ITC PROJECT</h1>
        <div class="main_page_heading_user_info">
            <label>Welcome, </label>
            <label class="user_username"><?php echo $active_user['username']; ?></label>
            <label class="user_role">(<?php echo $active_user['role']; ?>) </label>
        </div>
        
    </div>
    <div class="return_field">
        <button onclick="location.href='main_page.php'">< Go back</button>
    </div>
    <div class="user_info_content_div">
        <div class="user_info_content_heading">
            <h1>USER INFORMATION</h1>
            <a class="API_link" href="http://localhost/itc_project/API/all_users.php" target="_blank">ALL USERS API</a>
        </div>
        <div class="user_info_content">
            <div class="user_info_inputs">
                <div class="login_input">
                    <label for="user_name">Name</label>
                    <input 
                        type="text" 
                        id="user_name" 
                        name="user_name"
                        placeholder=""
                        value="<?php echo $user['name']; ?>"
                    >
                </div>
                <div class="login_input">
                    <label for="user_username">Username</label>
                    <input 
                        type="text" 
                        id="user_username" 
                        name="user_username"
                        placeholder=""
                        value="<?php echo $user['username']; ?>"
                    >
                </div> 
                <div class="login_input">
                    <label for="user_email">Email</label>
                    <input 
                        type="email" 
                        id="user_email" 
                        name="user_email"
                        placeholder=""
                        value="<?php echo $user['email']; ?>"
                    >
                </div> 
                <div class="login_input">
                    <label for="user_password">Password</label>
                    <input 
                        type="password" 
                        id="user_password" 
                        name="user_password"
                        placeholder=""
                    >
                </div> 
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

                    <?php if($active_user['role'] !== 'User'): ?>
                        <?php if($user['role'] !== 'Super Admin'): ?>
                            <?php if($user['role'] !== 'Super Admin'): ?>
                                <?php if($user['role'] == 'Admin'): ?>
                                    <button class="promote_to_admin">Demote to USER</button>
                                <?php else:?>
                                    <button class="promote_to_admin">Promote to ADMIN</button>
                                <?php endif; ?>
                            <?php endif; ?>
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
            </div>
            <div class="user_info_btn_div">
                <?php if($active_user['role'] == 'Super Admin'): ?>
                    <button class="user_info_btn" name="user_info_save_btn">UPDATE</button>
                <?php elseif($active_user['role'] !== 'Super Admin' AND $user['role'] == 'Super Admin'): ?>
                    <button class="user_info_btn" name="user_info_save_btn" disabled>UPDATE</button>
                <?php elseif($active_user['role'] == 'User' AND $user['role'] !== 'User'): ?>
                    <button class="user_info_btn" name="user_info_save_btn" disabled>UPDATE</button>
                <?php else: ?>
                    <button class="user_info_btn" name="user_info_save_btn">UPDATE</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once('../include/footer.php'); 
?>