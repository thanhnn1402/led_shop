<?php 
    $user_login = session_get('ss_user_token');

    include_once("database/service.php");

    $total_records = db_service_get_counter();

    $current_page = input_get('page');

    $limit = 3;

    $link = create_link(base_url('admin'), array(
      'm' => 'views',
      'a' => 'services',
      'page' => '{page}'
    ));

    $paging = paging($link, $total_records, $current_page, $limit);

    $sql = db_create_sql("SELECT * FROM tb_services {where} LIMIT {$paging['start']}, {$paging['limit']}");

    $services = db_get_list($sql);

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
        <header id="header" class="header">
            <nav class="navbar navbar-expand-lg bg-white">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo base_url('admin/?m=views&a=index'); ?>">
                        <img src="./modules/views/assets/img/logo.jpg" alt="Bootstrap" class="header__logo-img">
                    </a>
                    <!-- Close / Show navbar mobile -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Nabar mobile -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                      <div class="offcanvas-header">
                        <a class="navbar-brand" href="#">
                          <img src="./modules/views/assets/img/logo.jpg" alt="Bootstrap" class="header__logo-img">
                        </a>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>

                      <div class="offcanvas-body">
                        <ul class="navbar-nav w-100 me-auto mb-2 mb-lg-0">
                          <li class="nav-item me-4">
                              <a class="nav-link" aria-current="page" href="./index.html">TRANG CHỦ</a>
                          </li>
                          <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=about'); ?>">GIỚI THIỆU</a>
                          </li>
                          <li class="nav-item me-4">
                                <a class="nav-link active" href="<?php echo base_url('admin/?m=views&a=services'); ?>">DỊCH VỤ</a>
                          </li>
                          <li class="nav-item me-4">
                              <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=contact'); ?>">LIÊN HỆ</a>
                          </li>
                          <?php 
                              if($user_login) { 
                          ?>
                            <li class="nav-item me-4">
                              <span class="nav-link link-account"> <i class="ti ti-user me-1"></i> <?=$user_login["username"]?> </span>
                            </li>

                            <li class="nav-item me-4">
                              <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=logout'); ?>"> <i class="ti ti-shift-right me-1"></i> Đăng xuất </a>
                            </li>
                          <?php 
                            } else {
                          ?>
                            <li class="nav-item me-4">
                              <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=login'); ?>"> <i class="ti ti-user me-1"></i> TÀI KHOẢN </a>
                            </li>
                          <?php } ?>
                          <li class="nav-item me-4 mt-2">
                            <form class="form-search d-flex w-100 justify-content-between" role="search">
                                <input type="search" placeholder="Tìm kiếm..." aria-label="Search" class="flex-grow-1">
                                <button class="btn-search" type="submit"> <i class="ti ti-search"></i> </button>
                            </form>
                        </li>
                      </ul>
                      </div>
                    </div>

                    <!-- Navbar PC-Tablet  -->
                    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                        <ul class="navbar-nav w-100 me-auto mb-2 mb-lg-0">
                            <li class="nav-item me-4">
                                <a class="nav-link" aria-current="page" href="<?php echo base_url('admin/?m=views&a=index'); ?>">TRANG CHỦ</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=about'); ?>">GIỚI THIỆU</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link active" href="<?php echo base_url('admin/?m=views&a=services'); ?>">DỊCH VỤ</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=products'); ?>">DỰ ÁN</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=contact'); ?>">LIÊN HỆ</a>
                            </li>
                            <li class="nav-item me-4">
                                <form class="form-search d-flex" role="search">
                                    <input type="search" placeholder="Tìm kiếm..." aria-label="Search">
                                    <button class="btn-search" type="submit"> <i class="ti ti-search"></i> </button>
                                </form>
                            </li>
                            
                            <li class="nav-item me-4">
                            <?php 
                              if($user_login) { 
                            ?>
                                <span class="nav-link link-account"> <i class="ti ti-user me-1"></i> <?=$user_login["username"]?> </span>
                                <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=logout'); ?>"> <i class="ti ti-shift-right me-1"></i> Đăng xuất </a>
                            <?php 
                              } else {
                            ?>
                                <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=login'); ?>"> <i class="ti ti-user me-1"></i> TÀI KHOẢN </a>
                            <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
              </nav>
        </header>
        <!-- End header -->

        <div class="" style="margin-top: 96px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-primary text-center">DỊCH VỤ CỦA CHÚNG TÔI</h5>
                        <p class="seperate text-center">
                            <span></span>
                        </p>
                    </div>
                </div>

                <div class="row products" style="margin: 0 -8px">
                  <?php foreach ($services as $item) { ?>

                    <div class="col-md-3 col-12 px-2 mt-4">
                      <a href="" class="card product-item border-0 text-decoration-none">
                          <div class="set-bg set-bg--50" data-bg="<?='./storage/uploads/' . $item["thumbnail"]?>"></div>
                          <div class="card-body">
                            <h6 class="card-title product-item__title text-primary text-center"><?=$item["name"]?></h6>
                            <p class="card-text product-item__des">
                              <?=$item["description"]?>
                            </p>
                          </div>
                      </a>
                    </div>

                  <?php } ?>
                </div>

                <div class="row" style="margin-top: 56px">
                  <div class="col-md-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?=$paging["html"]?>
                      </ul>
                    </nav>
                  </div>
                </div>

            </div>
        </div>

        

        
        <footer id="footer" class="footer bg-secondary bg-opacity-25" style="margin-top: 96px">
          <div class="container">
            <div class="row">
              <div class="col-md-3 mt-4">
                <h6 class="footer-title">VỀ CHÚNG TÔI</h6>
                <p class="footer-introduce">
                  Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500
                  </br>
                  <span>"CHÚNG SẼ MANG LẠI DỊCH VỤ TỐT NHẤT CHO NGÔI NHÀ CỦA BẠN"</span>
                </p>
                <div>
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">
                    <i class="ti ti-facebook"></i>
                  </button>
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">
                    <i class="ti ti-twitter-alt"></i>
                  </button>
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">
                    <i class="ti ti-instagram"></i>
                  </button>
                </div>
              </div>

              <div class="col-md-3 mt-4">
                <h6 class="footer-title">THÔNG TIN LIÊN HỆ</h6>
                <ul class="footer-list">
                  <li class="footer-list__item"> 
                    <span><i class="ti ti-location-pin"></i></span>
                    <span><a href="">544/30 Lạc Long Quân, Phường 5, Quận 11, Thành phố Hồ Chí Minh</a ></span>
                  </li>
                  <li class="footer-list__item">
                      <span><i class="ti ti-mobile me-1"></i></span>
                      <span><a href="tel:+348884431">0348884431</a></span>
                  </li>
                  <li class="footer-list__item">
                     <span><i class="ti ti-email me-1"></i></span> 
                     <span><a href="mailto: example@gmail.com">example@gmail.com</a></span>  
                  </li>
                </ul>

                
              </div>

              <div class="col-md-3 mt-4">
                <h6 class="footer-title">DỊCH VỤ</h6>
                <ul class="footer-list">
                  <li class="footer-list__item"> 
                    <span><i class="ti ti-angle-right"></i></span>
                    <span><a href="">Thiết kế và lắp đặt</a ></span>
                  </li>
                  <li class="footer-list__item">
                      <span><i class="ti ti-angle-right"></i></span>
                      <span><a href="tel:+348884431">Thiết kế và lắp đặt</a></span>
                  </li>
                  <li class="footer-list__item">
                     <span><i class="ti ti-angle-right"></i></span> 
                     <span><a href="mailto: example@gmail.com">Thiết kế và lắp đặt</a></span>  
                  </li>
                </ul>
              </div>

              <div class="col-md-3 mt-4">
                <h6 class="footer-title">LIÊN KẾT</h6>
                <ul class="footer-list">
                  <li class="footer-list__item"> 
                    <span><i class="ti ti-angle-right"></i></span>
                    <span><a href="<?php echo base_url('admin/?m=views&a=index'); ?>">Trang chủ</a ></span>
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                      <span><a href="<?php echo base_url('admin/?m=views&a=about'); ?>">Giới thiệu</a></span>
                  </li>
                  <li class="footer-list__item active">
                    <span><i class="ti ti-angle-right"></i></span>
                     <span><a href="<?php echo base_url('admin/?m=views&a=services'); ?>">Dịch vụ</a></span>  
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                     <span><a href="<?php echo base_url('admin/?m=views&a=products'); ?>">Dự án</a></span>  
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                    <span><a href="<?php echo base_url('admin/?m=views&a=contact'); ?>">Liên hệ</a></span>  
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </footer>

        <a href="#" class="back-to-top">
            <i class="ti ti-angle-up"></i>
        </a>
    </div>
    
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Slick Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Js main -->
    <script src="./modules/views/assets/js/main.js"></script>

</body>
</html>