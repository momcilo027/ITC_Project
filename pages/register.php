<?php 
    require_once('../include/header.php'); 
    require_once('../php/register_check.php'); 
?>

<form class="register_container" method="POST">
    <div class="register_heading_div">
        <h1 class="register_heading">ITC PROJECT</h1>
    </div>
    <div class="register_inputs">
        <div class="<?php if($error['username'] == null){ echo "register_input";}else{ echo "register_input_error"; }?>">
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
        <div class="<?php if($error['email'] == null){ echo "register_input";}else{ echo "register_input_error"; }?>">
            <label for="email">EMAIL</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                autocomplete="off" 
                placeholder="<?php echo $error['email']; ?>"
                value="<?php echo $data['email']; ?>"
            >
        </div>
        <div class="<?php if($error['password'] == null){ echo "register_input";}else{ echo "register_input_error"; }?>">
            <label for="password">PASSWORD</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="<?php echo $error['password']; ?>"
            >
        </div>
    </div>
    <div class="register_btn_div">
        <button class="register_btn" name="register_btn" type="submit">REGISTER</button>
    </div>
</form>

<div class="redirect_start">
    <a href="/itc_project/pages/login.php">Login</a>
</div>

<?php require_once('../include/footer.php'); ?>