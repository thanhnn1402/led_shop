<?php 
    if (!defined("IN_SITE")) die("The request not found"); 

    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }

    $product_delete = (isset($_GET["u"]) ? $_GET["u"] : '');

    if(!empty($product_delete)) {
        include_once("database/product.php");

        $error = db_product_delete($product_delete); 


        if($error != 1) {
            echo "<script>alert('Xóa tài khoản thất bại!')</script>";
        } else {
            echo "<script>alert('Xóa tài khoản thành công!')</script>";
            redirect(base_url("admin/?m=product&a=list"));
        }
    }
?>