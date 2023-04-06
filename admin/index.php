<?php $title = "Dashboard"; ?>
<?php include "layout/header.php"; ?>
<?php $shoes = new Shoes_model(); ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Shoes</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-shoe-prints"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= count($shoes->getAllShoes()) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-shopping-bag"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= rand(0, 50) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total revenue -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Revenue</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                            <div class="ps-3">
                                <h6>RM <?= rand(0, 50) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>