<?php 
    require_once('../include/header.php'); 
    require_once('../php/add_company_check.php');
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
        <form class="add_company_page_content" method="POST" enctype="multipart/form-data">
            <div>
                <h1 class="add_company_heading">ADD COMPANY</h1>
            </div>
            <div class="add_company_inputs">
                <div class="<?php if($error['company_name'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="company_name">Company Name</label>
                    <input 
                        type="text" 
                        id="company_name" 
                        name="company_name"
                        placeholder="<?php echo $error['company_name']; ?>"
                        autocomplete="off"
                        value="<?php echo $data['company_name']; ?>"
                    >
                </div>
                <div class="<?php if($error['company_email'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="company_email">Email address</label>
                    <input 
                        type="email" 
                        id="company_email" 
                        name="company_email"
                        placeholder="<?php echo $error['company_email']; ?>"
                        autocomplete="off"
                        value="<?php echo $data['company_email']; ?>"
                    >
                </div>
                <div class="<?php if($error['logo'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="logo">Logo (**max size : 10KB)</label>
                    <input 
                        type="file" 
                        id="logo" 
                        name="logo"
                        accept="image/*"
                        placeholder="<?php echo $error['logo']; ?>"
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
                        autocomplete="off"
                        value="<?php echo $data['company_address']; ?>"
                    >
                </div>
                <div class="<?php if($error['company_tax_id'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
                    <label for="company_tax_id">Tax ID</label>
                    <input 
                        type="number" 
                        id="company_tax_id" 
                        name="company_tax_id"
                        placeholder="<?php echo $error['company_tax_id']; ?>"
                        autocomplete="off"
                        value="<?php echo $data['company_tax_id']; ?>"
                    >
                </div>
            </div>
            <div class="add_company_btn_div">
                <button type="submit" class="add_company_btn" name="add_company_save_btn">SAVE</button>
            </div>
        </form>
    </div>
</div>

<?php 
    require_once('../include/footer.php');
?>