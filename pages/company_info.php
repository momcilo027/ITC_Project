<?php 
    require_once('../include/header.php');
    require_once('../php/company_info.php');
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
    $clients = get_company_clients($_GET['id'], $_SESSION['token']);
?>



<div class="company_info_container">
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
    <div class="company_info_content_div">
        <div class="user_info_content_heading">
            <h1>COMPANY INFORMATION</h1>
            <a class="API_link" href="http://localhost/itc_project/API/all_companies.php" target="_blank">ALL COMPANIES API</a>
        </div>
        <form class="company_info_content" method="POST" enctype="multipart/form-data">
            <div class="company_left_info">
                <div class="company_left_inputs">
                    <div class="company_left_left">
                        <div class="<?php if($error['company_name'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="company_name">Name</label>
                            <input 
                                type="text" 
                                id="company_name" 
                                name="company_name"
                                placeholder="<?php echo $error['company_name']; ?>"
                                value="<?php if($error['company_name'] !== null ){ echo null; }else{echo $company['name'];} ?>"
                                autocomplete="off"
                            >
                        </div>
                        <div class="<?php if($error['company_email'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="company_email">Email</label>
                            <input 
                                type="email" 
                                id="company_email" 
                                name="company_email"
                                placeholder="<?php echo $error['company_email']; ?>"
                                value="<?php if($error['company_email'] !== null ){ echo null; }else{echo $company['email'];} ?>"
                                autocomplete="off"
                            >
                        </div>
                        <div class="<?php if($error['company_address'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="company_address">Address</label>
                            <input 
                                type="text" 
                                id="company_address" 
                                name="company_address"
                                placeholder="<?php echo $error['company_address']; ?>"
                                value="<?php if($error['company_address'] !== null ){ echo null; }else{echo $company['address'];} ?>"
                                autocomplete="off"
                            >
                        </div>
                        <div class="<?php if($error['company_tax_id'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="company_tax_id">Tax_id</label>
                            <input 
                                type="text" 
                                id="company_tax_id" 
                                name="company_tax_id"
                                placeholder="<?php echo $error['company_tax_id']; ?>"
                                value="<?php if($error['company_tax_id'] !== null ){ echo null; }else{echo $company['tax_id'];} ?>"
                                autocomplete="off"
                            >
                        </div> 
                    </div>
                    <div class="company_left_right">
                        <div class="login_input">
                            <label for="company_created_at">Created_at</label>
                            <input 
                                type="text" 
                                id="company_created_at" 
                                name="company_created_at"
                                value="<?php echo $company['created_at']; ?>"
                                disabled
                            >
                        </div>
                        <div class="<?php if($error['company_logo'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                            <label for="company_logo">Logo (**max size : 10KB)</label>
                            <input 
                                type="file" 
                                id="company_logo" 
                                name="company_logo"
                                accept="image/*"
                                placeholder="<?php echo $error['company_logo']; ?>"
                                autocomplete="off"
                            >
                        </div>
                        <div class="logo_preview">
                            <label for="">Logo Preview</label>
                            <div style="
                                width: 80px;
                                height: 80px;
                                background: rgba(0, 0, 0, .1);
                                display: flex;
                            ">
                                <?php if($company['logo'] !== null):?>
                                    <img 
                                        style="width: 80px; height: 80px;" 
                                        src="<?php echo 'data:image/png;base64,'.$company['logo']; ?>" 
                                        alt="Logo"
                                    >
                                    <button type="submit" class="delete_logo" name="delete_logo"><i class="fa-solid fa-x"></i></button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="delete_div">
                            <button type="submit" class="delete_btn" name="delete_company_btn">DELETE COMPANY</button>
                        </div> 
                    </div>
                </div>
                <div class="user_info_btn_div" style="right: 30px;">
                    <button class="user_info_btn" name="company_info_update_btn" type="submit">UPDATE</button>
                </div>
            </div>
            <div class="company_right_info">
                <div class="company_add_client">
                    <h1>CLIENTS</h1>
                    <div class="company_add_client_div">
                        <div class="custom_data_fill_search">
                            <input 
                                name="add_client_search_for_company"
                                type="text" 
                                placeholder="CLIENT"
                                autocomplete="off"
                                onclick="data_fill_list_suggestion(event.target, 'http://localhost/itc_project/API/all_clients.php', 'client_info');"
                                onkeyup="custom_data_fill_search(event.target, 'http://localhost/itc_project/API/find_client.php', 'client_info');"
                                onblur="data_fill_handleBlur(event);"
                            >
                            <div id="custom_redirect_list" class="custom_redirect_list vis_hidden">
                            </div>
                        </div>
                        <div class="company_add_client_btn">
                            <button type="submit" name="add_client_to_company">ADD CLIENT</button>
                        </div>
                    </div>
                </div>
                <div class="company_connected_clients">
                    <?php if(count($clients) !== 0):?>
                        <?php foreach($clients AS $client_data):?>
                            <div class="client_list_div">
                                <label><?php echo $client_data['name']; ?></label>
                                <button type="submit" value="<?php echo $client_data['id']; ?>" name="remove_client_from_company"><i class="fa-solid fa-x"></i></button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="client_list_div">
                            <label>ZERO clients for this company</label>
                        </div>
                    <?php endif; ?>
                    <!-- 
                        <div class="client_list_div">
                            <label>example_client_1</label>
                            <button><i class="fa-solid fa-x"></i></button>
                        </div> 
                    -->
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