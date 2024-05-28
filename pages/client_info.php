<?php 
    require_once('../include/header.php'); 
    session_start();
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
?>



<div class="client_info_container">
    <div class="main_page_heading_div">
        <h1 class="main_page_heading">ITC PROJECT</h1>
        <div class="main_page_heading_user_info">
            <label>Welcome, </label>
            <label class="user_username"><?php echo $active_user['username']; ?></label>
            <label class="user_role">(<?php echo $active_user['role']; ?>) </label>
            <form method="POST">
                <button class="logOut_btn" name="logOut_btn"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
        
    </div>
    <div class="return_field">
        <button onclick="location.href='main_page.php'">< Go back</button>
    </div>
    <div class="user_info_content_div">
        <h1>CLIENT INFORMATION</h1>
        <div class="client_info_content">
            <form class="client_data_form" method="POST">
                <div class="client_data_form_div">
                    <div class="client_data_form_inputs">
                        <div class="login_input">
                            <label for="client_name">Name</label>
                            <input 
                                type="text" 
                                id="client_name" 
                                name="client_name"
                                placeholder=""
                            >
                        </div>
                        <div class="login_input">
                            <label for="client_username">Username</label>
                            <input 
                                type="email" 
                                id="client_username" 
                                name="client_username"
                                placeholder=""
                            >
                        </div>
                        <div class="login_input">
                            <label for="client_email">Email</label>
                            <input 
                                type="email" 
                                id="client_email" 
                                name="client_email"
                            >
                        </div>
                        <div class="login_input">
                            <label for="client_password">Password</label>
                            <input 
                                type="password" 
                                id="client_password" 
                                name="client_password"
                                placeholder=""
                            >
                        </div>
                        <div class="login_input">
                            <label for="client_role">Role</label>
                            <input 
                                type="text"
                                id="client_role" 
                                name="client_role"
                                placeholder=""
                            >
                        </div>
                        <div class="login_input">
                            <label for="client_created_at">Created_at</label>
                            <input 
                                type="text" 
                                id="client_created_at" 
                                name="client_created_at"
                                placeholder=""
                                disabled
                            >
                        </div>
                    </div>
                    <div class="add_company_btn_div">
                        <button class="add_company_btn" name="add_company_save_btn">UPDATE</button>
                    </div>
                </div>
            </form>
            <div class="client_data_companies">
                <div class="client_data_companies_heading">
                    <h1>COMPANIES</h1>
                </div>
                <div>
                    add company
                </div>
                <div class="client_companies">

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous" ></script>
<script src="../assets/js/custom_redirect_search.js"></script>

<?php 
    require_once('../include/footer.php'); 
?>