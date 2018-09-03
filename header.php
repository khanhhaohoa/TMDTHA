<?php
include 'class/func.php'
?>
<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/minton/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2005], Fri, 24 Aug 2018 17:23:03 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo style; ?>/assets/images/favicon.ico">

        <title>Minton - Responsive Admin Dashboard Template</title>

        <link href="<?php echo style; ?>/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="<?php echo style; ?>/assets/plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />
                <!-- Plugin Css-->
        <link rel="stylesheet" href="<?php echo style; ?>/assets/plugins/magnific-popup/dist/magnific-popup.css" />
        <link rel="stylesheet" href="<?php echo style; ?>/assets/plugins/jquery-datatables-editable/dataTables.bootstrap4.min.css" />
        <link href="<?php echo style; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo style; ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo style; ?>/assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo style; ?>/assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo style; ?>/assets/plugins/morris/morris.css">
        <link href="<?php echo style; ?>/assets/plugins/dropzone/dropzone.css" rel="stylesheet" />

        <script src="<?php echo style; ?>/assets/js/modernizr.min.js"></script>
                <!-- DataTables -->
        <link href="<?php echo style; ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo style; ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo style; ?>/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Multi Item Selection examples -->
        <link href="<?php echo style; ?>/assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        
    </head>


    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index-2.html" class="logo"><i class="mdi mdi-radar"></i> <span>HAI ANH GROUP</span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg" aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="font-16"><span class="badge badge-danger float-right">5</span>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account"></i></div>
                                    <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-account"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-airplane"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo style; ?>/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! John</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="mdi mdi-settings"></i> <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="mdi mdi-lock-open"></i> <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Tìm kiếm..." class="form-control">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="" class="waves-effect waves-primary">
                                    <i class="ti-home"></i><span> Tổng Quan </span>
                                    <span class="badge badge-pink pull-right">ALL</span> 
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-shopping-cart-full"></i><span> Sản Phẩm </span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Tạo Sản Phẩm</a></li>
                                    <li><a href="#">Cập Nhật</a></li>
                                    <li><a href="#">Category</a></li>
                                    <li><a href="#">Danh Sách</a></li>
                                    <li><a href="#">Kho Ảnh</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-pencil-alt"></i><span> Đơn Hàng </span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Chốt Đơn</a></li>
                                    <li><a href="#">Xử Lí Đơn</a></li>
                                    <li><a href="#">Đơn Hoàn Thành</a></li>
                                    <li><a href="#">Đơn Hủy</a></li>
                                    <li><a href="#">Đơn Hoàn</a></li>
                                    <li><a href="#">Hỗ Trợ Khách</a></li>
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-user"></i><span> Khách Hàng</span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Đang xử lí</a></li>
                                    <li><a href="#">Đã nhận hàng </a></li>
                                </ul>
                            </li>
                            
                            

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-truck"></i><span> Kho hàng </span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Nhập Kho</a></li>
                                    <li><a href="#">Cập nhật</a></li>
                                    <li><a href="#">Hình Ảnh</a></li>
                                    <li><a href="#">Supplier</a></li>
                                    <li><a href="#">Thống Kê</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-panel"></i><span> Sàn Liên Kết </span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Lazada</a></li>
                                    <li><a href="#">Shopee</a></li>
                                    <li><a href="#">Tiki</a></li>
                                    <li><a href="#">Sendo</a></li>
                                    <li><a href="#">Facebook</a></li>
                                    <li><a href="#">Reseller</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-bar-chart-alt"></i><span> Thống Kê </span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Đơn Hàng</a></li>
                                    <li><a href="#">Kho hàng</a></li>
                                    <li><a href="#">Khách Hàng</a></li>
                                    <li><a href="#">Doanh Thu</a></li>
                                </ul>
                            </li>
                        </ul>


                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->




            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Welcome !</h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>


                        <div class="row">