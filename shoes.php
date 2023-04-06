<?php $title = "Shoes"; ?>
<?php include 'layout/header.php'; ?>
<?php $shoes = new Shoes_model(); ?>
<?php if (isset($_GET['category_id'])) {
    $shoes = $shoes->getShoesByCategory($_GET['category_id']);
} else {
    $shoes = $shoes->getAllShoes();
} ?>
<main id="main" class="mt-5">
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <h1>
                    Choice of shoes
                </h1>
            </div>
            <div class="row portfolio-container">
                <!-- LOOP 10 -->
                <?php foreach ($shoes as $row) : ?>
                    <div class="col-lg-3 col-md-6 portfolio-item filter-card" onclick="window.location.href='shoes_detail.php?shoes_id=<?= $row['shoes_id'] ?>'">
                        <div class="portfolio-wrap">
                            <img src="<?= base_url('assets/img/shoes/' . $row['shoes_image']) ?>" class="img-fluid w-100" alt="">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5><?= $row['shoes_name'] ?></h5>
                            </div>
                            <div class="col-6">
                                <?php $arr_price = array(); ?>
                                <?php foreach ($row['shoes_detail'] as $detail) : ?>
                                    <?php $arr_price[] = $detail['shoes_detail_price']; ?>
                                <?php endforeach; ?>

                                <!-- min and max -->
                                <?php $min = min($arr_price); ?>
                                <?php $max = max($arr_price); ?>

                                RM <?= $min ?>
                                <?php if ($min != $max) : ?>
                                    - RM <?= $max ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section><!-- End Portfolio Section -->
</main>
<?php include 'layout/footer.php'; ?>