<?php $title = "Shoes"; ?>
<?php include 'layout/header.php'; ?>
<?php $shoes = new Shoes_model(); ?>
<?php $variation = new Variation_model(); ?>

<?php if (isset($_GET['shoes_id'])) {
    $shoes_detail = $shoes->getShoesById($_GET['shoes_id'])[0];
    if (!count($shoes_detail) > 0) {
        redirect(base_url('shoes.php'));
    }
    $list_color = $variation->getVariationByType(1);
    $list_size = $variation->getVariationByType(2);
} else {
    redirect(base_url('shoes.php'));
} ?>
<main id="main" class="mt-5">
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="assets/img/shoes/<?= $shoes_detail['shoes_image'] ?>" class="img-fluid w-100" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="" method="post">
                        <div class="form-group mt-4">
                            <label for="shoes_name">Shoes Name : <?= $shoes_detail['shoes_name'] ?></label>
                        </div>
                        <div class="form-group mt-4">
                            <label for="shoes_price">Shoes Price :
                                <?php
                                $arr_price = array();
                                $arr_color = array();
                                $arr_size = array();
                                $stock = 0;
                                ?>
                                <?php foreach ($shoes_detail['shoes_detail'] as $detail) : ?>
                                    <?php $arr_price[] = $detail['shoes_detail_price']; ?>
                                    <?php $arr_color[] = $detail['shoes_detail_variation_color_id']; ?>
                                    <?php $arr_size[] = $detail['shoes_detail_variation_size_id']; ?>
                                    <?php $stock += $detail['shoes_detail_quantity']; ?>
                                <?php endforeach; ?>
                                <!-- min and max -->
                                <?php $min = min($arr_price); ?>
                                <?php $max = max($arr_price); ?>
                                RM <?= $min ?>
                                <?php if ($min != $max) : ?>
                                    - RM <?= $max ?>
                                <?php endif; ?>
                            </label>
                        </div>
                        <!-- variation -->
                        <!-- color: -->
                        <div class="form-group mt-4">
                            <label for="shoes_color">Shoes Color</label>
                            <ul class="list-group list-group-horizontal">
                                <?php foreach ($list_color as $color) : ?>
                                    <?php if (in_array($color['variation_id'], $arr_color)) : ?>
                                        <li class="list-group-item">
                                            <input type="radio" id="<?= $color['variation_id'] ?>" name="shoes_color" value="<?= $color['variation_id'] ?>">
                                            <label for="<?= $color['variation_id'] ?>"><?= $color['variation_name'] ?></label>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="form-group mt-4">
                            <label for="shoes_size">Shoes Size</label>
                            <ul class="list-group list-group-horizontal">
                                <?php foreach ($list_size as $size) : ?>
                                    <?php if (in_array($size['variation_id'], $arr_size)) : ?>
                                        <li class="list-group-item">
                                            <input type="radio" id="<?= $size['variation_id'] ?>" name="shoes_size" value="<?= $size['variation_id'] ?>">
                                            <label for="<?= $size['variation_id'] ?>"><?= $size['variation_name'] ?></label>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="shoes_stock">Shoes Stock</label>
                            <span id="shoes_stock">
                                <?= $stock ?>
                            </span>
                        </div>
                        <div class="form-group mt-4">
                            <label for="quantity">Quantity</label>
                            <div class="row">
                                <div class="col-lg-3 col-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-warning" type="button" id="button-addon1">-</button>
                                        </div>
                                        <input type="text" id="quantity" id="quantity" class="form-control text-center w-25" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" min="1" value="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button" id="button-addon2">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-7">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart()">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1>Description</h1>
                    <p>
                        <?= $shoes_detail['shoes_description'] ?>
                    </p>
                    <span id="error"></span>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Section -->
</main>
<?php include 'layout/footer.php'; ?>