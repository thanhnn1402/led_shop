<?php 
    // Định nghĩa một hằng số bảo vệ project
    define("IN_SITE", true);
    define ('SITE_ROOT', realpath(dirname('C:/xampp/htdocs/led_light/admin/storage/uploads')));
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $date_current = '';
    $date_current = date("Y-m-d H:i:sa");

    // Lấy module và action trên URL
    $module = (isset($_GET["m"])) ? $_GET["m"] : "";
    $action = (isset($_GET["a"])) ? $_GET["a"] : "";

    if(empty($module) || empty($action)) {
        $module = "common";
        $action = "login";
    }

    $path = "modules/" . $module . "/" . $action . ".php";

    if(file_exists($path)) {
        include_once("../libs/database.php");
        include_once("../libs/session.php");
        include_once("../libs/role.php");
        include_once("../libs/helper.php");
        include_once($path);
    } else {
        include_once("modules/common/404.php");
    }
?>