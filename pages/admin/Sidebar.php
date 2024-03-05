<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=BASE_URL('');?>" class="nav-link">HOME</a>
                </li>
                
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?=BASE_URL('Admin/Home');?>" class="brand-link">
                <img src="<?=BASE_URL('template/');?>dist/img/AdminLTELogo.png" alt="<?=$TUANORI->site('title');?>"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">TUANORI.COM</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?=BASE_URL('template/');?>dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="TUANORI">
                    </div>
                    <div class="info">
                        <a href="<?=BASE_URL('Admin/Home');?>" class="d-block"><?=$getUser['username'];?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=BASE_URL('Admin/Home');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin', '/Admin/Home']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Users');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Users']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Thành viên
                                </p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Category');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Category']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Chuyên mục game
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Giftcode');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Giftcode']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-gift"></i>
                                <p>
                                    GiftCode
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">LỊCH SỬ</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Key-Sold');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Key-Sold']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Key đã bán
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Bien-dong-so-du');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Bien-dong-so-du']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                <p> Biến động số dư</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/LSCards');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/LSCards']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                <p> Lịch sử nạp Card</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/LSBank');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/LSBank']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                <p> Lịch sử nạp ATM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/LSTransfer');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/LSTransfer']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                <p> Lịch sử chuyển tiền</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/LSGift');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/LSGift']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                                <p> Lịch sử nạp giftcode</p>
                            </a>
                        </li>

                        <li class="nav-header">CẤU HÌNH</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Cards');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Cards']) ? 'active' : ''); ?>">
                                <i class="nav-icon fa-solid fa-credit-card"></i>
                                <p>
                                    Nạp thẻ cào
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Bank');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Bank']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Ngân hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CÀI ĐẶT</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Noti');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Noti']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Thông báo
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Setting');?>" class="nav-link <?=(in_array($_SERVER['REQUEST_URI'], ['/Admin/Setting']) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Cấu hình
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>