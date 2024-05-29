<?php 
    require_once('../include/header.php'); 
    require_once('../php/add_client_check.php');
    // session_start();
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
?>



<div class="add_client_page_container" method="POST">
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
    <div class="add_client_page_content_div">
        <form class="add_client_page_content" method="POST">
            <div>
                <h1 class="add_company_heading">ADD CLIENT</h1>
            </div>
            <div class="add_company_inputs">
                <div class="<?php if($error['client_name'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="client_name">Client Name</label>
                    <input 
                        type="text" 
                        id="client_name" 
                        name="client_name"
                        placeholder="<?php echo $error['client_name']; ?>"
                        autocomplete="off"
                        value="<?php if($error['client_name'] !== null){ echo ''; }else{ echo $data['client_name']; } ?>"
                    >
                </div>
                <div class="<?php if($error['client_email'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="client_email">Email address</label>
                    <input 
                        type="email" 
                        id="client_email" 
                        name="client_email"
                        placeholder="<?php echo $error['client_email']; ?>"
                        autocomplete="off"
                        value="<?php if($error['client_email'] !== null){ echo ''; }else{ echo $data['client_email']; } ?>"
                    >
                </div>
                <div class="<?php if($error['client_phone'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="client_phone">Phone</label>
                    <input 
                        type="text" 
                        id="client_phone" 
                        name="client_phone"
                        placeholder="<?php echo $error['client_phone']; ?>"
                        autocomplete="off"
                        value="<?php echo $data['client_phone']; ?>"
                    >
                </div>
                <!-- <div class="login_input">
                    <label for="company_address">Address</label>
                    <input 
                        type="text" 
                        id="company_address" 
                        name="company_address"
                        placeholder=""
                    >
                </div> -->
                <!-- <div class="login_input">
                    <label for="company_address">Company</label>
                    <div class="company_add_client_div_full">
                        <div class="custom_data_fill_search">
                            <input 
                                type="text" 
                                placeholder="COMPANY"
                                onclick="data_fill_list_suggestion(event.target, 'http://localhost/itc_project/API/all_companies.php', 'company_info');"
                                onkeyup="custom_data_fill_search(event.target, 'http://localhost/itc_project/API/find_company.php', 'company_info');"
                                onblur="data_fill_handleBlur(event);"
                            >
                            <div id="custom_redirect_list" class="custom_redirect_list vis_hidden">
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="add_company_btn_div">
                <button type="submit" class="add_company_btn" name="add_client_save_btn">SAVE</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous" ></script>
<script src="../assets/js/custom_data_fill_search.js"></script>



<?php 
    require_once('../include/footer.php');
?>