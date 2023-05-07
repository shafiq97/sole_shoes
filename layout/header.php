<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
include 'helper/html_helper.php';
require_once 'model/Database.php';
require_once 'model/User_model.php';
require_once 'model/Category_model.php';
require_once 'model/Shoes_model.php';
require_once 'model/Variation_model.php';
$category   = new Category_model();
$categories = $category->getAllCategory();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>The Sole Footwear -
        <?= $title ?>
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- =======================================================
  * Template Name: Sailor - v4.9.1
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .navbar {
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="#">The Sole Footwear</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <nav id="navbar" class="navbar">
                <ul>
                    <li class="no_search"><a href="index.php" class="active">Home</a></li>
                    <li class="no_search"><a _target='blank' href="http://localhost:3000/">Customize</a></li>

                    <li class="no_search dropdown"><a href="#"><span>Branded</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <?php
                            foreach ($categories['main_category'] as $category): ?>
                                <?php if (count($category['sub_category']) > 0): ?>
                                    <li class="dropdown"><a href="#">
                                            <?= $category['category_name'] ?> <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul>
                                            <?php foreach ($category['sub_category'] as $sub_category): ?>
                                                <li><a href="shoes.php?category_id=<?= $sub_category['category_id'] ?>"><?= $sub_category['category_name'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li><a href="shoes.php?category_id=<?= $category['category_id'] ?>"><?= $category['category_name'] ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="no_search"><a href="">Sales</a></li>
                    <li class="no_search"><a href="about.php">About Us</a></li>
                    <li class="no_search"><a href="#footer">Contact</a></li>
                    <!-- <li class="no_search">
                        <a href="#" class="search"><i class="fas fa-search"></i></a>
                    </li> -->

                    <li class="top-search" style="margin-left: 10px; max-width: 200px;">
                        <form action="layout/search.php" method="get">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search for..."
                                    style="max-width: 100%;">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </li>


                    <li class="no_search">
                        <a href="cart.php" class="cart"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp; <span
                                id="cart_item" class="badge bg-danger rounded-pill"
                                style="position: absolute; top: -2px; right: -8px;">0</span></a>
                    </li>
                    <?php if (!isset($_SESSION['user']['customer'])): ?>
                        <li><a href="sign_in.php" class="getstarted">Sign Up | Sign in </a></li>
                    <?php else: ?>
                        <li class="no_search dropdown"><a href="#"><span>
                                    <?= $_SESSION['user']['customer']['user_name'] ?>
                                </span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->