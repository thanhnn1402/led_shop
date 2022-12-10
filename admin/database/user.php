<?php 
    if (!defined("IN_SITE")) die ("The request not found");

    function db_user_get_by_username($username){
        $newUsername = addslashes($username);
        $sql = "SELECT * FROM tb_user WHERE username = '{$newUsername}' ";
        return db_get_row($sql);
    }

    function db_user_get_all(){
        $sql = "SELECT * FROM tb_user";
        return db_get_list($sql);
    }

    function db_user_get_counter(){
        $table = "tb_user";

        $result = db_counters($table);

        if($result) {
            $row = mysqli_fetch_assoc($result);
        }

        return $row['counter'];
    }

    function db_user_add($data) {
        $error = array();

        $error = db_user_validate($data);

        if($error) {
            return $error;
        } else {
            $table = "tb_user";
            if(array_key_exists("re-password", $data)) {
                array_pop($data);
            }
            $result = db_insert($table, $data);

            if($result) {
                return 1;
            } else {
                return $error['message'] = "Tạo tài khoản thất bại, vui lòng thử lại!";
            }
        }
    }

    function db_user_update($data, $username_update, $email_update) {
        $error = array();

        if($data['username'] === $username_update ) {

            unset($data['username']);

        } else if($data['email'] === $email_update) {

            unset($data['email']);
        }

        $error = db_user_validate($data);
        
        if($error) {
            return $error;
        } else {
            $table = "tb_user";
            $filter = array(
                "username" => $username_update
            );
            
            $result = db_update($table, $data, $filter);

            if($result) {
                return 1;
            } else {
                return $error['message'] = "Tạo tài khoản thất bại, vui lòng thử lại!";
            }
        }
    }

    function db_user_delete($username_delete) {
        $error = array();
        $table = "tb_user";

        $filter = array(
            'username' => $username_delete
        );

        $result = db_delete($table, $filter);

        if($result) {
            return 1;
        } else {
            return $error['message'] = "Xóa tài khoản thất bại, vui lòng thử lại!";
        }


    }
?>