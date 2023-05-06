<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
include '../helper/html_helper.php';
require_once '../model/Database.php';
require_once '../model/User_model.php';
require_once '../model/Variation_model.php';
require_once '../model/Category_model.php';
require_once '../model/Shoes_model.php';

if (!isset($_SESSION['user']['admin'])) {
    $_SESSION['error'] = alert('You must login first', 'danger');
    echo '<script>window.location.href = "../sign_in.php";</script>';
} else {
    $user_id = $_SESSION['user']['admin']['user_id'];
    $user_name = $_SESSION['user']['admin']['user_name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- font awesome v6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Admin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->
                </li><!-- End Notification Nav -->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $user_name ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout.php') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <!-- user -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="user_list.php">
                            <i class="bi bi-circle"></i>
                            <span>User List</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_add.php">
                            <i class="bi bi-circle"></i>
                            <span>Add User</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- orders -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#orders-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="orders-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="orders_list.php">
                            <i class="bi bi-circle"></i>
                            <span>Orders List</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="orders-add.html">
                            <i class="bi bi-circle"></i>
                            <span>Add Orders</span>
                        </a>
                    </li> -->
                    <!-- give order -->
                    <!-- <li>
                        <a href="give-order.html">
                            <i class="bi bi-circle"></i>
                            <span>Give Order</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <!-- category -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="fas fa-list"></i>
                    <span>Category</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="category-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="category_list.php">
                            <i class="bi bi-circle"></i>
                            <span>Category List</span>
                        </a>
                    </li>
                    <li>
                        <a href="category_add.php">
                            <i class="bi bi-circle"></i>
                            <span>Add Category</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- shoes -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#shoes-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="fas fa-shoe-prints"></i>
                    <span>Shoes</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="shoes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="shoes_list.php">
                            <i class="bi bi-circle"></i>
                            <span>Shoes List</span>
                        </a>
                    </li>
                    <li>
                        <a href="shoes_add.php">
                            <i class="bi bi-circle"></i>
                            <span>Add Shoes</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Shoes Nav -->
            <!-- variation -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#variation-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="fas fa-shoe-prints"></i>
                    <span>Variation</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="variation-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="variation_list.php">
                            <i class="bi bi-circle"></i>
                            <span>Variation List</span>
                        </a>
                    </li>
                    <li>
                        <a href="variation_add.php">
                            <i class="bi bi-circle"></i>
                            <span>Add Variation</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- report -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="fas fa-chart-line"></i>
                    <span>Report</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="report-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="report-list.html">
                            <i class="bi bi-circle"></i>
                            <span>Report List</span>
                        </a>
                    </li>
                    <li>
                        <a href="report-add.html">
                            <i class="bi bi-circle"></i>
                            <span>Add Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- setting -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="setting.php">
                    <i class="fas fa-cog"></i>
                    <span>Setting</span>
                </a>
            </li>
        </ul>
    </aside><!-- End Sidebar-->