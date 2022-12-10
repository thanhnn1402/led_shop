<?php
    $error = array();
 
    // BƯỚC 1: KIỂM TRA NẾU LÀ ADMIN THÌ REDIRECT
    
    
    // BƯỚC 2: NẾU NGƯỜI DÙNG SUBMIT FORM
    if (is_submit("login"))
    {    
        // lấy tên đăng nhập và mật khẩu
        $username = input_post("username");
        $password = input_post("password");
        
        // Kiểm tra tên đăng nhập
        if (empty($username)){
            $error["username"] = "Bạn chưa nhập tên đăng nhập";
        }
        
        // Kiểm tra mật khẩu
        if (empty($password)){
            $error["password"] = "Bạn chưa nhập mật khẩu";
        }
        
        // Nếu không có lỗi
        if (!$error)
        {
            $user = array();
            // include file xử lý database user
            include_once("database/user.php");
            
            // lấy thông tin user theo username
            $user = db_user_get_by_username($username);
            // echo $user["username"];
            // die();

            // global $conn;
            // $conn = mysqli_connect("localhost", "root", "", "led_db") or die("Couldn't connect to database");

            // $sql = "SELECT * FROM tb_user WHERE username = '{$username}' ";

            // $user = db_get_row($sql);
            
            // Nếu không có kết quả
            if (empty($user)){
                $error["username"] = "Tên đăng nhập không đúng";
            }
            // nếu có kết quả nhưng sai mật khẩu
            else if ($user["password"] != $password){
                $error["password"] = "Mật khẩu bạn nhập không đúng";
            }
            
            // nếu mọi thứ ok thì tức là đăng nhập thành công 
            // nên thực hiện redirect sang trang chủ
            if (!($error)){
                set_logged($user["username"], $user["level"], $user['avatar']);

                if (is_admin()){
                    redirect(base_url("admin/?m=common&a=dashboard"));
                } else {
                    redirect(base_url("admin/?m=views&a=index"));
                }
            }
        }
    }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--Style CSS-->
    <link rel="stylesheet" href="./modules/views/assets/css/style.css">

    <!-- Responsive -->
    <link rel="stylesheet" href="./modules/views/assets/css/responsive.css">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Themify icon -->
    <link rel="stylesheet" href="./modules/views/assets/css/themify-icons/themify-icons.css">

    <!-- Slick slide -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

    <title>Document</title>
</head>
<body>
    <div class="main">
        <!-- Start header -->
        
        <!-- End header -->

        <div class="" style="margin-top: 96px">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 m-auto">
                        <h5 class="text-primary text-center">ĐĂNG NHẬP TÀI KHOẢN</h5>
                        <p class="seperate text-center">
                            <span></span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 m-auto">
                        <form id="form-login" class="form-login" method="post" action="<?php echo base_url('admin/?m=common&a=login'); ?>">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Tên tài khoản</label>
                                <div class="form-group-flex">
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <span class="form-message"><?php echo (!empty($error['username']) ? $error['username'] : '') ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="form-group-flex">
                                    <input type="password" class="form-control border-0" id="password" name="password">
                                    <span class="show-password"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                                <span class="form-message"><?php echo (!empty($error['password']) ? $error['password'] : '') ?></span>
                            </div>
                            <input type="hidden" name="request_name" value="login"/>
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                            <a href="<?php echo base_url('admin/?m=common&a=register'); ?>" type="submit" class="btn btn-outline-primary w-100 mt-3">Đăng kí</a>
                          </form>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
    
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Slick Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Js main -->
    <script src="./modules/views/assets/js/main.js"></script>

    <script src="./modules/views/assets/js/validatior.js"></script>
    <script>
        validator({
            form: '#form-login',
            errorSelector: '.form-message',
            formGroupSelector: '.form-group',
            rules: [
                // validator.isRequired('#fullname', 'Vui lòng nhập trường này'),
                validator.isRequired('#username', 'Vui lòng nhập trường này'),
                // validator.isEmail('#email', 'Vui lòng nhập đúng định dạng email'),
                validator.isRequired('#password', 'Vui lòng nhập trường này'),
                validator.minLength('#password', 6, 'Vui lòng nhập tối thiêu 6 kí tự'),
                // validator.isRequired('#password_confirmation', 'Vui lòng nhập trường này'),
                // validator.isConfirm('#password_confirmation', function() {
                //     return document.querySelector('#form-1 #password').value;
                // }, 'Mật khẩu nhập lại không đúng'),
                // validator.isRequired('#avatar', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="gender"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="check"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('#province', 'Vui lòng nhập trường này'),

            ]
        })
    </script>

</body>
</html>