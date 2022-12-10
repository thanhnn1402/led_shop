<?php 
    $error = array();

    if(is_submit("register")) {
        $username = addslashes(input_post("username"));
        $email = addslashes(input_post("email"));
        $password = addslashes(input_post("password"));
        $re_password = addslashes(input_post("password_confirmation"));
        

        if(empty($username)) {
            $error["username"] = "Bạn chưa nhập tên đăng nhập";
        }

        if(empty($email)) {
            $error["email"] = "Bạn chưa nhập email";
        }

        if(empty($password)) {
            $error["password"] = "Bạn chưa nhập mật khẩu";
        }
        
        if(empty($re_password)) {
            $error["re-password"] = "Bạn chưa nhập lại mật khẩu";
        }

        // Nếu không có lỗi
        if(!($error)) {
            include_once("database/user.php");

            $data = array(
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "re-password" => $re_password
            );

            $error = db_user_add($data); 

            if($error != 1) {
                echo "<script>alert('Tạo tài khoản thất bại!')</script>";
            } else {
                echo "<script>alert('Tạo tài khoản thành công!')</script>";
                redirect(base_url("admin/?m=common&a=login"));
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
                        <h5 class="text-primary text-center">ĐĂNG KÝ TÀI KHOẢN</h5>
                        <p class="seperate text-center">
                            <span></span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 m-auto">
                        <form id="form-register" class="form-login" method="post" action="<?php echo base_url('admin/?m=common&a=register'); ?>">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <div class="form-group-flex">
                                    <input type="text" class="form-control" id="username" name="username" class="">
                                </div>
                                <span class="form-message"><?php echo (!empty($error['username']) ? $error['username'] : '') ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="form-group-flex">
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                </div>
                                <span class="form-message"><?php echo (!empty($error['email']) ? $error['email'] : '') ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="form-group-flex">
                                    <input type="password" class="form-control border-0" id="password" name="password">
                                    <span class="show-password"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                                <span class="form-message"><?php echo (!empty($error['password']) ? $error['password'] : '') ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                <div class="form-group-flex">
                                    <input type="password" class="form-control border-0" id="password_confirmation" name="password_confirmation">
                                    <span class="show-password"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                                <span class="form-message"><?php echo (!empty($error['re-password']) ? $error['re-password'] : '') ?></span>
                              </div>
                            <input type="hidden" name="request_name" value="register"/>
                            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
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
            form: '#form-register',
            errorSelector: '.form-message',
            formGroupSelector: '.form-group',
            rules: [
                validator.isRequired('#username', 'Vui lòng nhập trường này'),
                validator.isRequired('#email', 'Vui lòng nhập trường này'),
                validator.isEmail('#email', 'Vui lòng nhập đúng định dạng email'),
                validator.isRequired('#password', 'Vui lòng nhập trường này'),
                validator.minLength('#password', 6, 'Vui lòng nhập tối thiêu 6 kí tự'),
                validator.isRequired('#password_confirmation', 'Vui lòng nhập trường này'),
                validator.isConfirm('#password_confirmation', function() {
                    return document.querySelector('#form-register #password').value;
                }, 'Mật khẩu nhập lại không đúng'),
                // validator.isRequired('#avatar', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="gender"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="check"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('#province', 'Vui lòng nhập trường này'),

            ]
        })
    </script>

</body>
</html>