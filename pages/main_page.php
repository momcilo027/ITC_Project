<?php 
    require_once('../include/header.php'); 
    session_start();
    authenticateUser();
    $active_user = get_user_by_id($_SESSION['user_id'], $_SESSION['token']);
?>



<div class="main_page_container" method="POST">
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
    <div class="main_page_content_div">
        <div class="main_page_add_div">
            <h1>ADD</h1>
            <div class="add_content">
                <button onclick="location.href='add_company.php'">COMPANY</button>
                <button onclick="location.href='add_client.php'">CLIENT</button>
            </div>
        </div>
        <div class="main_page_find_div">
            <h1>FIND</h1>
            <div class="find_content">
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
                <div class="custom_redirect_search">
                    <input 
                        type="text" 
                        placeholder="COMPANY"
                        onclick="list_suggestion(event.target, 'http://localhost/itc_project/API/all_companies.php', 'company_info');"
                        onkeyup="custom_redirect_search(event.target, 'http://localhost/itc_project/API/find_company.php', 'company_info');"
                        onblur="handleBlur(event);"
                    >
                    <div id="custom_redirect_list" class="custom_redirect_list hidden">
                    </div>
                </div>
                <div class="custom_redirect_search">
                    <input type="text" placeholder="CLIENT">
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