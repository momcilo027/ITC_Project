<?php 
    require_once('../include/header.php'); 
    session_start();
    authenticateUser();
?>



<div class="main_page_container" method="POST">
    <div class="main_page_heading_div">
        <h1 class="main_page_heading">ITC PROJECT</h1>
        <div class="main_page_heading_user_info">
            <label>Welcome, </label>
            <label class="user_username">moma</label>
            <label class="user_role">(Super Admin) </label>
        </div>
    </div>
    <div class="main_page_content_div">
        <div class="main_page_add_div">
            <h1>ADD</h1>
            <div class="add_content">
                <button>COMPANY</button>
                <button>CLIENT</button>
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
                    <input type="text" placeholder="COMPANY">
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