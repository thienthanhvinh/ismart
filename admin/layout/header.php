<!DOCTYPE html>
<html>

<head>
    <title>Quản lý ISMART</title>
    <base href="<?php echo base_url();  ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <!-- <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/> -->
    <link rel="stylesheet" href="public/css/font-awesome/css/all.min.css">
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="public/css/import/dash_board.scss">

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/color-change.js" type="text/javascript" defer></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="" title="" id="logo" class="fl-left">ADMIN</a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?mod=page&action=listPage" title="">Trang</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=page&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=page&action=listPage" title="">Danh sách trang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="post/list" title="">Bài viết</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="post/add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="post/list" title="">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="post/cat" title="">Danh mục bài viết</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=product&action=list" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=product&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=product&action=list" title="">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=product&action=cat" title="">Danh mục sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=product&action=listColor" title="">Danh sách màu</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=order&action=list" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=order&action=list" title="">Danh sách đơn hàng</a>
                                </li>
                                <!-- <li>
                                    <a href="?mod=order&action=customer" title="">Danh sách khách hàng</a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="?page=menu" title="">Menu</a>
                        </li> -->
                    </ul>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="public/images/img-admin.png">
                                </div>
                                <h3 id="account" class="fl-right"><?php echo $_SESSION['user_login'] ?></h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?mod=users&action=update" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a class="dropdown-item" href="?mod=users&action=logout" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                </div>
            </div>