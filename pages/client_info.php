<?php 
    require_once('../include/header.php');
    require_once('../php/client_info.php');
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
    $companies = get_companies_for_client($_GET['id'], $token);
?>



<div class="company_info_container">
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
    <div class="company_info_content_div">
        <div class="user_info_content_heading">
            <h1>CLIENT INFORMATION</h1>
            <a class="API_link" href="http://localhost/itc_project/API/all_clients.php" target="_blank">ALL CLIENTS API</a>
        </div>
        <form class="company_info_content" method="POST" enctype="multipart/form-data">
            <div class="company_left_info">
                <div class="client_left_inputs">
                    <div class="company_left_left">
                        <div class="<?php if($error['client_name'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="client_name">Name</label>
                            <input 
                                type="text" 
                                id="client_name" 
                                name="client_name"
                                placeholder="<?php echo $error['client_name']; ?>"
                                value="<?php if($error['client_name'] !== null ){ echo null; }else{echo $client['name'];} ?>"
                                autocomplete="off"
                            >
                        </div>
                        <div class="<?php if($error['client_email'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="client_email">Email</label>
                            <input 
                                type="email" 
                                id="client_email" 
                                name="client_email"
                                placeholder="<?php echo $error['client_email']; ?>"
                                value="<?php if($error['client_email'] !== null ){ echo null; }else{echo $client['email'];} ?>"
                                autocomplete="off"
                            >
                        </div>
                        <div class="<?php if($error['client_phone'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="client_phone">Phone</label>
                            <input 
                                type="text" 
                                id="client_phone" 
                                name="client_phone"
                                placeholder="<?php echo $error['client_phone']; ?>"
                                value="<?php if($error['client_phone'] !== null ){ echo null; }else{echo $client['phone'];} ?>"
                                autocomplete="off"
                            >
                        </div>
                    </div>
                    <div class="company_left_right">
                        <div class="login_input">
                            <label for="client_created_at">Created_at</label>
                            <input 
                                type="text" 
                                id="client_created_at" 
                                name="client_created_at"
                                value="<?php echo $client['created_at']; ?>"
                                disabled
                            >
                        </div>
                        <div class="delete_div">
                            <button type="submit" class="delete_btn" name="delete_client_btn">DELETE CLIENT</button>
                        </div> 
                    </div>
                </div>
                <div class="user_info_btn_div" style="right: 30px;">
                    <button class="user_info_btn" name="client_info_update_btn" type="submit">UPDATE</button>
                </div>
            </div>
            <div class="company_right_info">
                <div class="company_add_client">
                    <h1>COMPANIES</h1>
                    <div class="company_add_client_div">
                        <div class="custom_data_fill_search">
                            <input 
                                name="add_company_search_for_client"
                                type="text" 
                                placeholder="COMPANY"
                                autocomplete="off"
                                onclick="data_fill_list_suggestion(event.target, 'http://localhost/itc_project/API/all_companies.php', 'company_info');"
                                onkeyup="custom_data_fill_search(event.target, 'http://localhost/itc_project/API/find_company.php', 'company_info');"
                                onblur="data_fill_handleBlur(event);"
                            >
                            <div id="custom_redirect_list" class="custom_redirect_list vis_hidden">
                            </div>
                        </div>
                        <div class="company_add_client_btn">
                            <button type="submit" name="add_company_to_client" style="font-size : 10px;">ADD COMPANY</button>
                        </div>
                    </div>
                </div>
                <div class="company_connected_clients">
                    <?php if(count($companies) !== 0):?>
                        <?php foreach($companies AS $company_data):?>
                            <div class="client_list_div">
                                <label><?php echo $company_data['name']; ?></label>
                                <button type="submit" value="<?php echo $company_data['id']; ?>" name="remove_company_from_client"><i class="fa-solid fa-x"></i></button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="client_list_div">
                            <label>ZERO companies for this client</label>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous" ></script>
<script src="../assets/js/custom_data_fill_search.js"></script>

<?php 
    require_once('../include/footer.php'); 
?>