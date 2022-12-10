<?php 
    if (!defined("IN_SITE")) die ("The request not found");

    // Hàm thiết lập là đã đăng nhập
    function set_logged($username, $level, $avatar) {
        session_set("ss_user_token", array(
            "username" => $username,
            "level" => $level,
            "avatar" => $avatar
        ));
    }

    // Hàm thiết lập đăng xuất
    function set_logout() {
        session_delete("ss_user_token");
    }

    // Hàm kiểm tra trạng thái người dùng đã đăng hập chưa
    function is_logged() {
        $user = session_get("ss_user_token");
        return $user;

    }

    // Hàm kiểm tra có phải là admin hay không
    function is_admin() {
        $user = session_get("ss_user_token");

        if(!empty($user["level"]) && $user["level"] == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Lấy username người dùng hiện tại
    function get_current_username(){
        $user  = is_logged();
        return isset($user["username"]) ? $user["username"] : "";
    }
    
    // Lấy level người dùng hiện tại
    function get_current_level(){
        $user  = is_logged();
        return isset($user["level"]) ? $user["level"] : "";
    }
?>