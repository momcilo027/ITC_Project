<?php 
    require_once('../include/header.php'); 
    session_start();
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
?>



<div class="add_company_page_container" method="POST">
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
    <div class="add_company_page_content_div">
        <div class="add_company_page_content">
            <div>
                <h1 class="add_company_heading">ADD CLIENT</h1>
            </div>
            <div class="add_company_inputs">
                <div class="login_input">
                    <label for="client_name">Client Name</label>
                    <input 
                        type="text" 
                        id="client_name" 
                        name="client_name"
                        placeholder=""
                    >
                </div>
                <div class="login_input">
                    <label for="client_email">Email address</label>
                    <input 
                        type="email" 
                        id="client_email" 
                        name="client_email"
                        placeholder=""
                    >
                </div>
                <div class="login_input">
                    <label for="client_phone">Phone</label>
                    <input 
                        type="text" 
                        id="client_phone" 
                        name="client_phone"
                    >
                </div>
                <div class="login_input">
                    <label for="company_address">Address</label>
                    <input 
                        type="text" 
                        id="company_address" 
                        name="company_address"
                        placeholder=""
                    >
                </div>
                <div class="login_input">
                    <label for="company_address">Company</label>
                    <div class="custom_redirect_search">
                    <input 
                        type="text" 
                        placeholder="USER"
                        onclick="list_suggestion(event.target, 'http://localhost/itc_project/API/all_users.php', 'user_info');"
                        onkeyup="custom_redirect_search(event.target, 'http://localhost/itc_project/API/find_user.php', 'user_info');"
                        onblur="handleBlur(event);"
                    >
                    <div id="custom_redirect_list" class="custom_redirect_list hidden">
                        <!-- <button>Momcilo Krstic</button>
                        <button>Ana Grujic</button>
                        <button>Lazar Stanojevic</button>
                        <button>Momcilo Krstic</button> -->
                    </div>
                </div>
                </div>
            </div>
            <div class="add_company_btn_div">
                <button class="add_company_btn" name="add_company_save_btn">SAVE</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous" ></script>
<script src="../assets/js/custom_redirect_search.js"></script>



<?php 
    require_once('../include/footer.php');
?>