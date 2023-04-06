<?php $title = "Shoes"; ?>
<?php
require_once '../model/Database.php';
require_once '../model/Variation_model.php';
require_once '../model/Shoes_model.php';
?>
<?php $shoes_now = new Shoes_model(); ?>
<?php $variation = new Variation_model(); ?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
    <?php $list_color = $_POST['shoes_color']; ?>
    <?php $list_size = $_POST['shoes_size']; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_color as $color) : ?>
                <?php foreach ($list_size as $size) : ?>
                    <?php $shoes_detail =  $shoes_now->getShoesByShoesIdAndColorIdAndSizeId($_POST['shoes_id'], $color, $size); ?>
                    <?php $color_detail = $variation->getVariationById($color); ?>
                    <?php $size_detail = $variation->getVariationById($size); ?>
                    <tr>
                        <td><?= $color_detail['variation_name'] ?></td>
                        <td><?= $size_detail['variation_name'] ?></td>
                        <?php if (!empty($shoes_detail)) : ?>
                            <td><input type="number" name="stock[<?= $color ?>][<?= $size ?>]" value="<?= $shoes_detail['shoes_detail_price'] ?>" required></td>
                            <td><input type="number" name="price[<?= $color ?>][<?= $size ?>]" value="<?= $shoes_detail['shoes_detail_quantity'] ?>" required></td>
                        <?php else : ?>
                            <td><input type="number" name="stock[<?= $color ?>][<?= $size ?>]" value="" required></td>
                            <td><input type="number" name="price[<?= $color ?>][<?= $size ?>]" value="" required></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php endif; ?>