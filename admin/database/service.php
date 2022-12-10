<?php 
    if (!defined("IN_SITE")) die ("The request not found");

    function db_service_get_by_id($id){
        $sql = "SELECT * FROM tb_services WHERE id = '{$id}' ";
        return db_get_row($sql);
    }

    function db_service_get_all(){
        $sql = "SELECT * FROM tb_services";
        return db_get_list($sql);
    }

    function db_service_get_counter(){
        $table = "tb_services";

        $result = db_counters($table);

        if($result) {
            $row = mysqli_fetch_assoc($result);
        }

        return $row['counter'];
    }

    function db_service_add($data) {
        $error = array();

        if($error) {
            return $error;
        } else {
            $table = "tb_services";
            
            $result = db_insert($table, $data);

            if($result) {
                return 1;
            } else {
                return $error['message'] = "Tạo tài khoản thất bại, vui lòng thử lại!";
            }
        }
    }

    function db_service_update($data, $id_update) {
        $table = "tb_services";
        $filter = array(
            "id" => $id_update
        );
        $result = db_update($table, $data, $filter);

        if($result) {
            return 1;
        } else {
            return $error['message'] = "Tạo tài khoản thất bại, vui lòng thử lại!";
        }
    }

    function db_service_delete($id_delete) {
        $error = array();
        $table = "tb_services";
        $filter = array(
            "id" => $id_delete
        );

        $result = db_delete($table, $filter);

        if($result) {
            return 1;
        } else {
            return $error['message'] = "Xóa tài khoản thất bại, vui lòng thử lại!";
        }


    }
?>