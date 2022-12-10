<?php 
    if (!defined("IN_SITE")) die("The request not found"); 

    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }

    $user_login = session_get('ss_user_token');

    $contact_update = (isset($_GET["u"]) ? $_GET["u"] : '');

    if(!empty($contact_update)) {

        $error = array();
        include_once("database/contact.php");

        $contact = db_contact_get_by_id($contact_update);

        $contact_update_state = (isset($_GET["s"]) ? $_GET["s"] : '');

        if(!empty($contact_update_state)) {
            $data = array(
              "state" => 1
            );

            $err = db_contact_update($data, $contact_update);

            if($err != 1) {
                echo "<script>alert('Cập nhật trạng thái thành công!')</script>";
            } else {
                echo "<script>alert('Cập nhật trạng thái thành công!')</script>";
                redirect(base_url("admin/?m=contact&a=list"));
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
    <link rel="stylesheet" href="./modules/views/assets/css/style.css">

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
              <button type="button" class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="ti ti-layout-grid3-alt me-2"></i>
                Quản lý dịch vụ
                <i class="ti ti-angle-right float-end mt-2"></i>
              </button>

              <ul class="navbar-nav me-auto mb-2 mb-lg-0 accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent=".nav-item">
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'contact', 'a' => 'list')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i>Danh sách dịch vụ</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo create_link(base_url('admin'), array('m' => 'contact', 'a' => 'add')); ?>" class="nav-link"><i class="fa-regular fa-circle me-2"></i> Thêm dịch vụ</a>
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
                  <h5 class="ms-3">Cập nhật dịch vụ</h5>
                </div>
            </div>

            <div class="row bg-white my-3 mx-1 py-3 px-2 rounded-2">
              <div class="col-md-12">
                <div class="row mt-3">
                  <div class="col-md-6"> 
                    <span class="fw-bold">Tên khách hàng: </span> 
                    <span class="ms-2"><?=$contact["fullname"]?></span>
                  </div>
                  <div class="col-md-6"> 
                    <span class="fw-bold">Email: </span> 
                    <span class="ms-2"><?=$contact["email"]?></span>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6"> 
                    <span class="fw-bold">Địa chỉ: </span> 
                    <span class="ms-2"><?=$contact["address"]?></span>
                  </div>
                  <div class="col-md-6"> 
                    <span class="fw-bold">Số điện thoại: </span> 
                    <span class="ms-2"><?=$contact["phone"]?></span>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6"> 
                    <span class="fw-bold">Ghi chú: </span> 
                    <span class="ms-2"><?=$contact["note"]?></span>
                  </div>
                  <div class="col-md-6"> 
                    <span class="fw-bold">Trạng thái: </span> 
                    <span class="ms-2"><?=$contact["state"] == 1 ? "Đã phản hồi" : "Chưa phản hồi"?></span>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6"> 
                    <span class="fw-bold">Ngày tạo: </span> 
                    <span class="ms-2"><?=$contact["create_at"]?></span>
                  </div>
                  <div class="col-md-6"> 
                    <span class="fw-bold">Ngày phản hồi: </span> 
                    <span class="ms-2"><?=$contact["update_at"]?></span>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <a href="mailto: <?=$contact["email"]?>" class="btn btn-outline-success"> <i class="ti ti-email"></i> Phản hồi email</a>
                    <a href="tel: <?=$contact["phone"]?>" class="btn btn-outline-success"> <i class="ti ti-mobile"></i> Phản hồi số điện thoại</a>
                    <a href="<?php echo base_url('admin/?m=contact&a=edit&s='.$contact['id'].'&u='.$contact['id']); ?>" class="btn btn-outline-success"> <i class="ti ti-reload"></i> Cập nhật trạng thái</a>
                  </div>
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
            form: '#form-edit-contact',
            errorSelector: '.form-message',
            formGroupSelector: '.form-group',
            rules: [
                validator.isRequired('#name', 'Vui lòng nhập trường này'),
                validator.isRequired('#description', 'Vui lòng nhập trường này'),
                validator.isRequired('#thumbnail', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="gender"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('input[name="check"]', 'Vui lòng nhập trường này'),
                // validator.isRequired('#province', 'Vui lòng nhập trường này'),

            ]
        });

        readFileImg('#form-edit-contact');
    </script>
    
</body>
</html>