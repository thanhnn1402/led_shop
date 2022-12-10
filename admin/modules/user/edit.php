<?php 
    if (!defined("IN_SITE")) die("The request not found"); 

    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }

    $user_login = session_get('ss_user_token');

    $username_update = (isset($_GET["u"]) ? $_GET["u"] : '');

    if(!empty($username_update)) {

        $error = array();
        include_once("database/user.php");

        $user = db_user_get_by_username($username_update);


        if(is_submit("edit-user")) {
            $username = addslashes(input_post("username"));
            $email = addslashes(input_post("email"));
            $password = addslashes(input_post("password"));
            $avatar = $_FILES["avatar"]["name"];
            $tempname = $_FILES["avatar"]["tmp_name"];
            $folder = "./storage/uploads/" . $avatar;

            if($username_update === "admin") {
              $username = "admin";
            }
            

            if(empty($username)) {
                $error["username"] = "Bạn chưa nhập tên đăng nhập";
            }

            if(empty($email)) {
                $error["email"] = "Bạn chưa nhập email";
            }

            if(empty($password)) {
                $error["password"] = "Bạn chưa nhập mật khẩu";
            }
            
            if($_FILES["avatar"]["error"] > 0) {
                $error["avatar"] = "Bạn chưa chọn ảnh đại diện";
            }else {
            
            move_uploaded_file($tempname ,$folder);
            }

            // Nếu không có lỗi
            if(!($error)) {

                $data = array(
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                    "avatar" => $avatar,
                    "update_at" => $date_current
                );

                $error = db_user_update($data, $user['username'], $user['email']); 


                if($error != 1) {
                    echo "<script>alert('Cập nhật tài khoản thất bại!')</script>";
                } else {
                    echo "<script>alert('Cập nhật tài khoản thành công!')</script>";

                    if($username_update === "admin") {
                        $data_logged = array(
                        "username" => $username,
                        "level" => $user['level'],
                        "avatar" => $avatar
                      );

                      session_set('ss_user_token', $data_logged);

                    }


                    redirect(base_url("admin/?m=user&a=list"));
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
    <link rel="stylesheet" href="./modules/views/assets/css/admin.css">

    <!-- Responsive -->
    <!-- <link rel="stylesheet" href="./modules/views/assets/css/style.css"> -->

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Themify icon -->
    <link rel="stylesheet" href="./modules/views/assets/css/themify-icons/themify-icons.css">

    <!-- Slick slide -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

    <!-- Database CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <title>Document</title>
</head>
<body>
    <div class="warrper">
      <div class="main-sidebar show">
        <div class="sidebar-header">
          <div class="logo">
            <a href="" class="text-decoration-none">
              <span>ADMIN WEBSITE</span>
            </a>
          </div>
          <div class="profile">
            <img src="<?= isset($user_login["avatar"]) ? './storage/uploads/' . $user_login["avatar"] : './modules/views/assets/img/banner1.jpg'?>" alt="" class="admin-avatar">
            <span class="admin-name"><?=isset($user_login["username"]) ? $user_login["username"] : 'Alexander Pierce'?></span>
          </div>
        </div>
        <div class="sidebar-content">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <form class="d-flex" role="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="" type="submit"> <i class="ti ti-search"></i> </button>
              </form>      
            </li>
            <li class="nav-item accordion-item">
              <button type="button" class="nav-link accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <i class="ti ti-layout-grid3-alt me-2"></i>
                Quản lý dịch vụ
                <i class="ti ti-angle-right float-end mt-2"></i>
              </button>

              <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'service', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách dịch vụ</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'service', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm dịch vụ</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#user" aria-expanded="true" aria-controls="user">
                <i class="ti ti-user me-2"></i>
                Quản lý người dùng
                <i class="ti ti-angle-right float-end mt-2"></i>
              </button>

              <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse show" id="user" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách người dùng</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm người dùng</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#contact" aria-expanded="false" aria-controls="contact">
                <i class="ti ti-headphone-alt me-2"></i>
                Quản lý tin tư vấn
                <i class="ti ti-angle-right float-end mt-2"></i>
              </button>

              <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse" id="contact" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'contact', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách tin</a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <button type="button" class="nav-link accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="false" aria-controls="product">
                <i class="ti ti-server me-2"></i>
                Quản lý dự án
                <i class="ti ti-angle-right float-end mt-2"></i>
              </button>

              <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse" id="product" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'product', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách dự án</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'product', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm dự án</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>


      <div class="main-content w-100">
        <nav class="main-header w-100">
          <nav class="navbar navbar-expand-lg bg-white border-bottom w-100">
            <div class="container-fluid">
              <button class="btn btn-show-sidebar" type="button">
                <span class="navbar-toggler-icon"></span>
              </button>
              <button class="btn btn-show-sidebar-mobile" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link text-secondary" href="<?php echo create_link(base_url('admin'), array('m' => 'common', 'a' => 'dashboard')); ?>">Home</a>
                  </li>
                </ul>
  
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link text-secondary" href="<?php echo base_url('admin/?m=common&a=logout'); ?>"> Đăng xuất </a>
                  </li>
                </ul>
              </div>

              <!-- Nabar mobile -->
              <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #343a40;">
                <div class="offcanvas-header">
                  <div class="sidebar-header position-relative w-100">
                    <div class="logo">
                      <a href="<?php echo base_url('admin/?m=common&a=dashboard'); ?>" class="text-decoration-none">
                        <span>ADMIN WEBSITE</span>
                      </a>
                    </div>
                    <div class="profile">
                      <img src="<?= isset($user_login["avatar"]) ? './storage/uploads/' . $user_login["avatar"] : './modules/views/assets/img/banner1.jpg'?>" alt="" class="admin-avatar">
                      <span class="admin-name"><?=isset($user_login["username"]) ? $user_login["username"] : 'Alexander Pierce'?></span>
                      <a class="nav-link text-light ms-auto" href="<?php echo base_url('admin/?m=common&a=logout'); ?>"> Đăng xuất </a>
                    </div>
                  </div>
                  <button type="button" class="btn-close text-reset position-absolute" data-bs-dismiss="offcanvas" aria-label="Close" style="top: 12px; right: 12px;"></button>
                </div>

                <div class="offcanvas-body">
                  <div class="main-sidebar-mobile show">
                    
                    <div class="sidebar-content p-0">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                          <form class="d-flex" role="search">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <button class="" type="submit"> <i class="ti ti-search"></i> </button>
                          </form>      
                        </li>
                        <li class="nav-item accordion-item">
                          <button type="button" class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="ti ti-layout-grid3-alt me-2"></i>
                            Quản lý dịch vụ
                            <i class="ti ti-angle-right float-end mt-2"></i>
                          </button>

                          <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'service', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách dịch vụ</a>
                            </li>
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'service', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm dịch vụ</a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#user" aria-expanded="true" aria-controls="user">
                            <i class="ti ti-user me-2"></i>
                            Quản lý người dùng
                            <i class="ti ti-angle-right float-end mt-2"></i>
                          </button>

                          <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse show" id="user" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách người dùng</a>
                            </li>
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm người dùng</a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#contact" aria-expanded="true" aria-controls="contact">
                            <i class="ti ti-headphone-alt me-2"></i>
                            Quản lý tin tư vấn
                            <i class="ti ti-angle-right float-end mt-2"></i>
                          </button>

                          <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse show" id="contact" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'contact', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách tin</a>
                            </li>
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'contact', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm tin</a>
                            </li>
                          </ul>
                        </li>

                        <li class="nav-item">
                          <button type="button" class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="true" aria-controls="product">
                            <i class="ti ti-server me-2"></i>
                            Quản lý dự án
                            <i class="ti ti-angle-right float-end mt-2"></i>
                          </button>

                          <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse show" id="product" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'product', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách dự án</a>
                            </li>
                            <li class="nav-item">
                              <a href="<?php echo create_link(base_url('admin'), array('m' => 'product', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm dự án</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </nav>
  
        <div class="content-wrapper">
          <div class="container-fluid overflow-scroll bg-secondary bg-opacity-10" style="min-height: calc(100vh - 55px)">
            <div class="row py-3 border-bottom">  
                <div class="col-md-6">
                  <h5 class="ms-3">Cập nhật người dùng</h5>
                </div>
            </div>

            <div class="row bg-white my-3 mx-1 py-3 px-2 rounded-2">
              <div class="col-md-12">
                <form id="form-edit-user" class="form-login" method="post" action="<?php echo base_url('admin/?m=user&a=edit&u='.$user['username']); ?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <div class="form-group-flex">
                            <input type="text" class="form-control" id="username" name="username" class="" value="<?=isset($user["username"]) ? $user["username"] : '';?>"  <?php if($user["username"] === "admin"){echo "disabled";} ?> >
                        </div>
                        <span class="form-message"><?php echo (!empty($error['username']) ? $error['username'] : '') ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="form-group-flex">
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?=isset($user["email"]) ? $user["email"] : '' ?>" >
                        </div>
                        <span class="form-message"><?php echo (!empty($error['email']) ? $error['email'] : '') ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="form-group-flex">
                            <input type="password" class="form-control border-0" id="password" name="password" value="<?=isset($user["password"]) ? $user["password"] : '' ?>" >
                            <span class="show-password"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                        <span class="form-message"><?php echo (!empty($error['password']) ? $error['password'] : '') ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <div class="form-group-flex">
                            <input type="file" class="form-control border-0" id="avatar" name="avatar" value="<?=isset($user["avatar"]) ? $user["avatar"] : ''?>" > 
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-2 img-grid">
                                <img src="<?= isset($user["avatar"]) ? './storage/uploads/' . $user["avatar"] : ''?> " alt="" class="w-100">
                            </div>
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <input type="hidden" name="request_name" value="edit-user"/>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
              </div>
            </div>
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

    <!-- Database JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <!-- Js main -->
    <script src="./modules/views/assets/js/main.js"></script>
    <script src="./modules/views/assets/js/validatior.js"></script>

    <script>
       $('#table').DataTable({});
    </script>
    <script>
        validator({
            form: '#form-edit-user',
            errorSelector: '.form-message',
            formGroupSelector: '.form-group',
            rules: [
                validator.isRequired('#username', 'Vui lòng nhập trường này'),
                validator.isRequired('#email', 'Vui lòng nhập trường này'),
                validator.isEmail('#email', 'Vui lòng nhập đúng định dạng email'),
                validator.isRequired('#password', 'Vui lòng nhập trường này'),
                validator.minLength('#password', 6, 'Vui lòng nhập tối thiêu 6 kí tự'),
                // validator.isRequired('#password_confirmation', 'Vui lòng nhập trường này'),
                // validator.isConfirm('#password_confirmation', function() {
                //     return document.querySelector('#form-edit-user #password').value;
                // }, 'Mật khẩu nhập lại không đúng'),
                validator.isRequired('#avatar', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="gender"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="check"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('#province', 'Vui lòng nhập trường này'),

            ]
        });

        readFileImg('#form-edit-user');
    </script>
    
</body>
</html>