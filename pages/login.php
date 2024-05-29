<?php 
    require_once('../include/header.php'); 
    require_once('../php/login_check.php'); 
?>



<form class="login_container" method="POST">
    <div class="login_heading_div">
        <h1 class="login_heading">ITC PROJECT</h1>
    </div>
    <div class="login_inputs">
        <div class="<?php if($error['username'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
            <label for="username">USERNAME</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                autocomplete="off"
                placeholder="<?php echo $error['username']; ?>"
                value="<?php echo $data['username']; ?>"
            >
        </div>
        <div class="<?php if($error['password'] == null){ echo "login_input";}else{ echo "login_input_error"; }?>">
            <label for="password">PASSWORD</label>
            <input 
                type="password" 
                id="password" 
                name="password"
                placeholder="<?php echo $error['password']; ?>"
            >
        </div>
    </div>
    <div class="login_btn_div">
        <button class="login_btn" name="login_btn">LOGIN</button>
    </div>
</form>

<div class="redirect_start">
    <a href="/itc_project/pages/register.php">Register</a>
</div>


<?php require_once('../include/footer.php'); ?>