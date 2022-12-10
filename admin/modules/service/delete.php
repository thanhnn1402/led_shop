<?php 
    if (!defined("IN_SITE")) die("The request not found"); 

    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }

    $service_delete = (isset($_GET["u"]) ? $_GET["u"] : '');

    if(!empty($service_delete)) {
        include_once("database/service.php");

        $error = db_service_delete($service_delete); 


        if($error != 1) {
            echo "<script>alert('Xóa tài khoản thất bại!')</script>";
        } else {
            echo "<script>alert('Xóa tài khoản thành công!')</script>";
            redirect(base_url("admin/?m=service&a=list"));
        }
    }
?>