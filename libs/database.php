<?php 
    if (!defined("IN_SITE")) die ("The request not found");

    global $conn;

    // Ham ket noi
    function db_connect() {
        global $conn;
        if(!$conn) {
            $conn = mysqli_connect("localhost", "root", "", "led_db") or die("Couldn't connect to database");

            mysqli_set_charset($conn, "utf8");
        }
    }

    // Ham ngat ket noi
    function db_close() {
        global $conn;
        if($conn) {
            mysqli_close($conn);
        }
    }

    // Ham lay danh sach, ket qua tra ve danh sach cac record trong 1 mang
    function db_get_list($sql) {
        db_connect();
        global $conn;
        
        $data  = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        return $data;
        
    }

    // Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
    function db_get_row($sql) {
        db_connect();
        global $conn;
        
        $query = mysqli_query($conn, $sql);
        $result = array();

        if(mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);
        }

        return $result;
    }

    // Ham thuc thi cau truy van insert, update, delete
    function db_execute($sql) {
        db_connect();
        global $conn;
        return mysqli_query($conn, $sql);
        
    }

    // Hàm tạo câu truy vấn có thêm điều kiện Where
    function db_create_sql($sql, $filter = array())
    {    
        // Chuỗi where
        $where = '';
        
        // Lặp qua biến $filter và bổ sung vào $where
        foreach ($filter as $field => $value){
            if ($value != ''){
                $value = addslashes($value);
                $where .= "AND $field = '$value', ";
            }
        }
        
        // Remove chữ AND ở đầu
        $where = trim($where, 'AND');
        // Remove ký tự , ở cuối
        $where = trim($where, ', ');
        
        // Nếu có điều kiện where thì nối chuỗi
        if ($where){
            $where = ' WHERE '.$where;
        }
        
        // Return về câu truy vấn
        return str_replace('{where}', $where, $sql);
    }

    // Hàm insert dữ liệu vào table
    function db_insert($table, $data = array())
    {
        // Hai biến danh sách fields và values
        $fields = '';
        $values = '';
        
        // Lặp mảng dữ liệu để nối chuỗi
        foreach ($data as $field => $value){
            $fields .= $field .',';
            $values .= "'".addslashes($value)."',";
        }
        
        // Xóa ký từ , ở cuối chuỗi
        $fields = trim($fields, ',');
        $values = trim($values, ',');
        
        // Tạo câu SQL
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        
        // Thực hiện INSERT
        return db_execute($sql);
    }

    // Hàm update dữ liệu vào table
    function db_update($table, $data = array(), $filter = array())
    {
        // Hai biến danh sách fields và values
        $fields = '';
        $values = '';
        
        // Lặp mảng dữ liệu để nối chuỗi
        foreach ($data as $field => $value){
            $fields .= $field . "='".addslashes($value)."'" . ',';
        }
        
        // Xóa ký từ , ở cuối chuỗi
        $fields = trim($fields, ',');
        
        // Tạo câu SQL
        $sql = "UPDATE $table SET $fields {where}";

        $sql = db_create_sql($sql, $filter);
        
        // Thực hiện UPDATE
        return db_execute($sql);
    }

    // Hàm delete dữ liệu table
    function db_delete($table, $filter)
    {   
        // Tạo câu SQL
        $sql = "DELETE FROM $table {where}";

        $sql = db_create_sql($sql, $filter);
        
        // Thực hiện DELETE
        return db_execute($sql);
    }

    // Hàm điếm tổng record table
    function db_counters($table)
    {   
        // Tạo câu SQL
        $sql = "SELECT count(id) AS counter FROM $table";
        
        // Thực hiện DELETE
        return db_execute($sql);
    }

    // Hàm validate dữ liệu bảng User
    function db_user_validate($data)
    {
        // Biến chứa lỗi
        $error = array();
        
        /* VALIDATE CĂN BẢN */
        // Username
        if (isset($data['username']) && $data['username'] == ''){
            $error['username'] = 'Bạn chưa nhập tên đăng nhập';
        }
        
        // Email
        if (isset($data['email']) && $data['email'] == ''){
            $error['email'] = 'Bạn chưa nhập email';
        }
        if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
            $error['email'] = 'Email không hợp lệ';
        }
        
        // Password
        if (isset($data['password']) && $data['password'] == ''){
            $error['password'] = 'Bạn chưa nhập mật khẩu';
        }
        
        // Re-password
        if (isset($data['password']) && isset($data['re-password']) && $data['password'] != $data['re-password']){
            $error['re-password'] = 'Mật khẩu nhập lại không đúng';
        }
        
        // Level
        // if (isset($data['level']) && !in_array($data['level'], array('1', '2'))){
        //     $error['level'] = 'Level bạn chọn không tồn tại';
        // }
        
        /* VALIDATE LIÊN QUAN CSDL */
        // Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
        // tiếp tục kiểm tra bằng truy vấn CSDL
        // Username
        if (!($error) && isset($data['username']) && $data['username']){
            $sql = "SELECT count(id) as counter FROM tb_user WHERE username='".addslashes($data['username'])."'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0){
                $error['username'] = 'Tên đăng nhập này đã tồn tại';
            }
        }
        
        // Email
        if (!($error) && isset($data['email']) && $data['email']){
            $sql = "SELECT count(id) as counter FROM tb_user WHERE email='".addslashes($data['email'])."'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0){
                $error['email'] = 'Email này đã tồn tại';
            }
        }
        
        return $error;
    }
?>
