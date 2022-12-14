<?php 
    $user_login = session_get('ss_user_token');

    include_once("database/service.php");

    include_once("database/product.php");

    $products = db_product_get_all();

    $services = db_service_get_all();

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
                              <a class="nav-link active" aria-current="page" href="./index.html">TRANG CH???</a>
                          </li>
                          <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=about'); ?>">GI???I THI???U</a>
                          </li>
                          <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=services'); ?>">D???CH V???</a>
                          </li>
                          <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=products'); ?>">D??? ??N</a>
                          </li>
                          <li class="nav-item me-4">
                              <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=contact'); ?>">LI??N H???</a>
                          </li>
                          <?php 
                              if($user_login) { 
                          ?>
                            <li class="nav-item me-4">
                              <span class="nav-link link-account"> <i class="ti ti-user me-1"></i> <?=$user_login["username"]?> </span>
                            </li>

                            <li class="nav-item me-4">
                              <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=logout'); ?>"> <i class="ti ti-shift-right me-1"></i> ????ng xu???t </a>
                            </li>
                          <?php 
                            } else {
                          ?>
                            <li class="nav-item me-4">
                              <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=login'); ?>"> <i class="ti ti-user me-1"></i> T??I KHO???N </a>
                            </li>
                          <?php } ?>
                          <li class="nav-item me-4 mt-2">
                            <form class="form-search d-flex w-100 justify-content-between" role="search">
                                <input type="search" placeholder="T??m ki???m..." aria-label="Search" class="flex-grow-1">
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
                                <a class="nav-link active" aria-current="page" href="<?php echo base_url('admin/?m=views&a=index'); ?>">TRANG CH???</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=about'); ?>">GI???I THI???U</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=services'); ?>">D???CH V???</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=products'); ?>">D??? ??N</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="<?php echo base_url('admin/?m=views&a=contact'); ?>">LI??N H???</a>
                            </li>
                            <li class="nav-item me-4">
                                <form class="form-search d-flex" role="search">
                                    <input type="search" placeholder="T??m ki???m..." aria-label="Search">
                                    <button class="btn-search" type="submit"> <i class="ti ti-search"></i> </button>
                                </form>
                            </li>
                            
                            <li class="nav-item me-4">
                            <?php 
                              if($user_login) { 
                            ?>
                                <span class="nav-link link-account"> <i class="ti ti-user me-1"></i> <?=$user_login["username"]?> </span>
                                <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=logout'); ?>"> <i class="ti ti-shift-right me-1"></i> ????ng xu???t </a>
                            <?php 
                              } else {
                            ?>
                                <a class="nav-link link-account" href="<?php echo base_url('admin/?m=common&a=login'); ?>"> <i class="ti ti-user me-1"></i> T??I KHO???N </a>
                            <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
              </nav>
        </header>
        <!-- End header -->


        <!-- Start banner -->
        <div class="main-banner">
            <div class="banner-item set-bg" data-bg="./modules/views/assets/img/banner.jpg"></div>
            <div class="banner-item set-bg" data-bg="./modules/views/assets/img/banner.jpg"></div>
            <div class="banner-item set-bg" data-bg="./modules/views/assets/img/banner.jpg"></div>
        </div>
        <!-- End banner -->


        <div class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h6>D???CH V???</h6>
                        <h5 class="text-primary my-3">THI???T K??? V?? L???P ?????T ????N LED</h5>
                        <p class="text-sm fw-light fst-italic" style="text-align: justify">
                            Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, 
                            ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                            Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500, 
                            khi m???t h???a s?? v?? danh gh??p nhi???u ??o???n v??n b???n v???i nhau ????? t???o th??nh m???t b???n m???u v??n b???n.
                        </p>
                        <p class="text-sm text-primary" style="font-size: 12px">"CH??NG S??? MANG L???I D???CH V??? T???T NH???T CHO NG??I NH?? C???A B???N"</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="<?php echo base_url('admin/?m=views&a=services'); ?>" class="card text-decoration-none border-0">
                                    <div class="set-bg set-bg--75" data-bg="./modules/views/assets/img/banner2.jpg"></div>
                                    <div class="card-body">
                                      <p class="card-title text-center text-dark">Thi???t k??? ????n led cho nh?? ph???</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="<?php echo base_url('admin/?m=views&a=services'); ?>" class="card text-decoration-none border-0">
                                    <div class="set-bg set-bg--75" data-bg="./modules/views/assets/img/banner2.jpg"></div>
                                    <div class="card-body">
                                      <p class="card-title text-center text-dark">Thi???t k??? ????n led cho nh?? ph???</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="<?php echo base_url('admin/?m=views&a=services'); ?>" class="card text-decoration-none border-0">
                                    <div class="set-bg set-bg--75" data-bg="./modules/views/assets/img/banner2.jpg"></div>
                                    <div class="card-body">
                                      <p class="card-title text-center text-dark">Thi???t k??? ????n led cho nh?? ph???</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container" style="margin-top: 96px">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-primary text-center">QUY TR??NH THI???T K???</h5>
                        <p class="seperate text-center">
                            <span></span>
                        </p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="set-bg set-bg--75" data-bg="./modules/views/assets/img/service1.jpg"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="item1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  B?????C 1: T?? V???N
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="item1" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="item2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  B?????C 2: KH???O S??T V?? B??O GI??
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="item2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="item3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  B?????C 3: K?? H???P ?????NG V?? T???M ???NG
                                </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="item3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="item4">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    B?????C 4: TRI???N KHAI THI???T K???
                                  </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="item4" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="item5">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    B?????C 5: B??N GIAO B???N V??? V?? THANH L?? H???P ?????NG
                                  </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="item5" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                  </div>
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="" style="margin-top: 96px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-primary text-center">QUY TR??NH L???P ?????T</h5>
                        <p class="seperate text-center">
                            <span></span>
                        </p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="item6">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                  B?????C 1: T?? V???N
                                </button>
                              </h2>
                              <div id="collapse6" class="accordion-collapse collapse show" aria-labelledby="item6" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="item7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                  B?????C 2: D??? ??O??N V?? TI???N ????? D??? ??N
                                </button>
                              </h2>
                              <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="item7" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="item8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                  B?????C 3: TRI???N KHAI THI C??NG
                                </button>
                              </h2>
                              <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="item8" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="item9">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    B?????C 4: NGHI???M THU C??NG TR??NH
                                  </button>
                                </h2>
                                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="item9" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="item10">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    B?????C 5: B??N GIAO B???N V??? V?? THANH L?? H???P ?????NG
                                  </button>
                                </h2>
                                <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="item10" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <p class="ms-4">Chuy??n vi??n c???a Valuma s??? ti???p nh???n th??ng tin ban ?????u c???a kh??ch h??ng c?? nhu c???u thi???t k??? n???i th???t, trao ?????i v?? ????a ra nh???ng t?? v???n s?? b???.</p>
                                  </div>
                                </div>
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="set-bg set-bg--75" data-bg="./modules/views/assets/img/service1.jpg"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="" style="margin-top: 96px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-primary text-center">D??? ??N ???? HO??N TH??NH</h5>
                        <p class="seperate text-center">
                            <span></span>
                        </p>
                    </div>
                </div>

                <div class="row products" style="margin: 0 -8px">
                    <?php foreach ($products as $item) { ?>

                      <div class="col-md-3 col-12 px-2">
                          <a href="<?php echo base_url('admin/?m=views&a=products'); ?>" class="card product-item border-0 text-decoration-none">
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
            </div>
        </div>

        <!-- <div class="news-content" style="margin-top: 96px">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <h5 class="text-primary text-center">TIN T???C</h5>
                      <p class="seperate text-center">
                          <span></span>
                      </p>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <a href="" class="card news-item mt-4 border-0 text-decoration-none">
                      <img src="./modules/views/assets/img/banner3.jpg" alt="" class="w-100">
                      <div class="card-body ps-0">
                        <h6 class="card-title news-item__title text-primary">Thi???t k??? v?? l???p ?????t ????n led cho nh?? ph???</h6>
                        <p class="card-text text-start news-item__des">
                          Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                          Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500
                        </p>
                      </div>
                    </a>
                </div>

                <div class="col-md-6">
                  <a href="" class="card news-item mt-4 d-flex flex-row align-items-start border-0 text-decoration-none">
                    <img src="./modules/views/assets/img/banner3.jpg" alt="" class="w-25">
                    <div class="card-body">
                      <h6 class="card-title news-item__title text-primary">Thi???t k??? v?? l???p ?????t ????n led cho nh?? ph???</h6>
                      <p class="card-text news-item__des text-start">
                        Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                        Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500
                      </p>
                    </div>
                  </a>

                  <a href="" class="card news-item mt-4 d-flex flex-row align-items-start border-0 text-decoration-none">
                    <img src="./modules/views/assets/img/banner3.jpg" alt="" class="w-25">
                    <div class="card-body">
                      <h6 class="card-title news-item__title text-primary">Thi???t k??? v?? l???p ?????t ????n led cho nh?? ph???</h6>
                      <p class="card-text news-item__des text-start">
                        Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                        Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500
                      </p>
                    </div>
                  </a>

                  <a href="" class="card news-item mt-4 d-flex flex-row align-items-start border-0 text-decoration-none">
                    <img src="./modules/views/assets/img/banner3.jpg" alt="" class="w-25">
                    <div class="card-body">
                      <h6 class="card-title news-item__title text-primary">Thi???t k??? v?? l???p ?????t ????n led cho nh?? ph???</h6>
                      <p class="card-text news-item__des text-start">
                        Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                        Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500
                      </p>
                    </div>
                  </a>

                  <a href="" class="card news-item mt-4 d-flex flex-row align-items-start border-0 text-decoration-none">
                    <img src="./modules/views/assets/img/banner3.jpg" alt="" class="w-25">
                    <div class="card-body">
                      <h6 class="card-title news-item__title text-primary">Thi???t k??? v?? l???p ?????t ????n led cho nh?? ph???</h6>
                      <p class="card-text news-item__des text-start">
                        Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                        Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500
                      </p>
                    </div>
                  </a>
                </div>
              </div>
          </div>
        </div> -->

        <div class="Reviews-content" style="margin-top: 96px">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <h5 class="text-primary text-center">NH???N X??T C???A KH??CH H??NG</h5>
                      <p class="seperate text-center">
                          <span></span>
                      </p>
                  </div>
              </div>

              <div class="row reviews mt-5" style="margin: 0 -8px">
                  <div class="col-md-4 col-12 px-2">
                      <a href="" class="card review-item border-0 text-decoration-none">
                          <div class="set-bg set-bg--50" data-bg="./modules/views/assets/img/istockphoto-1364917563-170667a-removebg-preview.png"></div>
                          <div class="card-body">
                            <p class="card-text review-item__des">
                              "Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                              Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500"
                            </p>
                            <h6 class="card-title review-item__title text-primary text-center">Lorem Ipsum</h6>
                          </div>
                      </a>
                  </div>

                  <div class="col-md-4 col-12 px-2">
                    <a href="" class="card review-item border-0 text-decoration-none">
                        <div class="set-bg set-bg--50" data-bg="./modules/views/assets/img/istockphoto-1364917563-170667a-removebg-preview.png"></div>
                        <div class="card-body">
                          <p class="card-text review-item__des">
                            "Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                            Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500"
                          </p>
                          <h6 class="card-title review-item__title text-primary text-center">Lorem Ipsum</h6>
                        </div>
                    </a>
                  </div>

                  <div class="col-md-4 col-12 px-2">
                    <a href="" class="card review-item border-0 text-decoration-none">
                        <div class="set-bg set-bg--50" data-bg="./modules/views/assets/img/istockphoto-1364917563-170667a-removebg-preview.png"></div>
                        <div class="card-body">
                          <p class="card-text review-item__des">
                            "Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                            Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500"
                          </p>
                          <h6 class="card-title review-item__title text-primary text-center">Lorem Ipsum</h6>
                        </div>
                    </a>
                  </div>

                  <div class="col-md-4 col-12 px-2">
                    <a href="" class="card review-item border-0 text-decoration-none">
                        <div class="set-bg set-bg--50" data-bg="./modules/views/assets/img/istockphoto-1364917563-170667a-removebg-preview.png"></div>
                        <div class="card-body">
                          <p class="card-text review-item__des">
                            "Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                            Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500"
                          </p>
                          <h6 class="card-title review-item__title text-primary text-center">Lorem Ipsum</h6>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-12 px-2">
                  <a href="" class="card review-item border-0 text-decoration-none">
                      <div class="set-bg set-bg--50" data-bg="./modules/views/assets/img/istockphoto-1364917563-170667a-removebg-preview.png"></div>
                      <div class="card-body">
                        <p class="card-text review-item__des">
                          "Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                          Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500"
                        </p>
                        <h6 class="card-title review-item__title text-primary text-center">Lorem Ipsum</h6>
                      </div>
                  </a>
                </div>

                <div class="col-md-4 col-12 px-2">
                  <a href="" class="card review-item border-0 text-decoration-none">
                      <div class="set-bg set-bg--50" data-bg="./modules/views/assets/img/istockphoto-1364917563-170667a-removebg-preview.png"></div>
                      <div class="card-body">
                        <p class="card-text review-item__des">
                          "Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. 
                          Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500"
                        </p>
                        <h6 class="card-title review-item__title text-primary text-center">Lorem Ipsum</h6>
                      </div>
                  </a>
                </div>
              </div>
          </div>
      </div>
        

        
        <footer id="footer" class="footer bg-secondary bg-opacity-25" style="margin-top: 96px">
          <div class="container">
            <div class="row">
              <div class="col-md-3">
                <h6 class="footer-title">V??? CH??NG T??I</h6>
                <p class="footer-introduce">
                  Lorem Ipsum ch??? ????n gi???n l?? m???t ??o???n v??n b???n gi???, ???????c d??ng v??o vi???c tr??nh b??y v?? d??n trang ph???c v??? cho in ???n. Lorem Ipsum ???? ???????c s??? d???ng nh?? m???t v??n b???n chu???n cho ng??nh c??ng nghi???p in ???n t??? nh???ng n??m 1500
                  </br>
                  <span>"CH??NG S??? MANG L???I D???CH V??? T???T NH???T CHO NG??I NH?? C???A B???N"</span>
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

              <div class="col-md-3">
                <h6 class="footer-title">TH??NG TIN LI??N H???</h6>
                <ul class="footer-list">
                  <li class="footer-list__item"> 
                    <span><i class="ti ti-location-pin"></i></span>
                    <span><a href="">544/30 L???c Long Qu??n, Ph?????ng 5, Qu???n 11, Th??nh ph??? H??? Ch?? Minh</a ></span>
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

              <div class="col-md-3">
                <h6 class="footer-title">D???CH V???</h6>
                <ul class="footer-list">
                  <li class="footer-list__item"> 
                    <span><i class="ti ti-angle-right"></i></span>
                    <span><a href="">Thi???t k??? v?? l???p ?????t</a ></span>
                  </li>
                  <li class="footer-list__item">
                      <span><i class="ti ti-angle-right"></i></span>
                      <span><a href="tel:+348884431">Thi???t k??? v?? l???p ?????t</a></span>
                  </li>
                  <li class="footer-list__item">
                     <span><i class="ti ti-angle-right"></i></span> 
                     <span><a href="mailto: example@gmail.com">Thi???t k??? v?? l???p ?????t</a></span>  
                  </li>
                </ul>
              </div>

              <div class="col-md-3">
                <h6 class="footer-title">LI??N K???T</h6>
                <ul class="footer-list">
                  <li class="footer-list__item active"> 
                    <span><i class="ti ti-angle-right"></i></span>
                    <span><a href="<?php echo base_url('admin/?m=views&a=index'); ?>">Trang ch???</a ></span>
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                      <span><a href="<?php echo base_url('admin/?m=views&a=about'); ?>">Gi???i thi???u</a></span>
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                     <span><a href="<?php echo base_url('admin/?m=views&a=services'); ?>">D???ch v???</a></span>  
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                     <span><a href="<?php echo base_url('admin/?m=views&a=products'); ?>">D??? ??n</a></span>  
                  </li>
                  <li class="footer-list__item">
                    <span><i class="ti ti-angle-right"></i></span>
                    <span><a href="<?php echo base_url('admin/?m=views&a=contact'); ?>">Li??n h???</a></span>  
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
    
    <script>
        $('.main-banner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            prevArrow: '<button type="button" class="slick-prev"><i class="ti ti-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="ti ti-angle-right"></i></button>',
            dots: true,
            dotClass: 'slick-dots',
        })

        $('.products').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: false,
            Swipe: true,
            responsive: [
              {
                breakpoint: 768,
                settings: {
                  slidesToShow: 3,
                  
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,                  
                }
              }
            ]
        })

        $('.reviews').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: false,
            Swipe: true,
            responsive: [
              {
                breakpoint: 768,
                settings: {
                  slidesToShow: 3,
                  
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,                  
                }
              }
            ]
        })
    </script>
</body>
</html>