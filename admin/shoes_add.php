<?php $title = "Shoes"; ?>
<?php include "layout/header.php"; ?>
<?php $variation = new Variation_model(); ?>
<?php $category = new Category_model(); ?>
<?php $shoes = new Shoes_model(); ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <?= $_SESSION['message'] ?? '' ?>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group mt-3">
                                        <label for="shoes_image">Shoes Image</label>
                                        <div class="img-preview text-center">
                                            <img src="<?= base_url('assets/img/shoes/default.jpg') ?>" alt="" class="img-fluid" width="200" onclick="document.getElementById('shoes_image').click()">
                                        </div>
                                        <input hidden type="file" name="shoes_image" id="shoes_image" class="form-control" accept="image/*">
                                        <button type="button" class="btn btn-danger mt-2 btn-remove-image">Remove Image</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="shoes_category_id">Shoes Category</label>
                                        <select name="shoes_category_id" id="shoes_category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            <?php foreach ($category->getAllCategory()['main_category'] as $cat) : ?>
                                                <?php $cc = $cat['sub_category']; ?>
                                                <?php if (count($cat['sub_category']) > 0) : ?>
                                                    <optgroup label="<?= $cat['category_name'] ?>">
                                                        <?php foreach ($cat['sub_category'] as $sub) : ?>
                                                            <option value="<?= $sub['category_id'] ?>"><?= $sub['category_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                <?php else : ?>
                                                    <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="shoes_name">Shoes Name</label>
                                        <input type="text" name="shoes_name" id="shoes_name" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="shoes_description">Shoes Description</label>
                                        <textarea name="shoes_description" id="shoes_description" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <!-- status -->
                                    <div class="form-group">
                                        <label for="shoes_status">Shoes Status</label>
                                        <select name="shoes_status" id="shoes_status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="shoes_color">Shoes Color</label>
                                        <?php if (count($variation->getVariationByType(1)) > 0) : ?>
                                            <?php foreach ($variation->getVariationByType(1) as $color) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= $color['variation_id'] ?>" name="shoes_color[]" id="shoes_color_<?= $color['variation_id'] ?>" onchange="shoes()">
                                                    <label class="form-check-label" for="shoes_color_<?= $color['variation_id'] ?>">
                                                        <?= $color['variation_name'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="alert alert-warning">No color found. Please add color first.</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="shoes_size">Shoes Size</label>
                                        <?php if (count($variation->getVariationByType(2)) > 0) : ?>
                                            <?php foreach ($variation->getVariationByType(2) as $size) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= $size['variation_id'] ?>" name="shoes_size[]" id="shoes_size_<?= $size['variation_id'] ?>" onchange="shoes()">
                                                    <label class=" form-check-label" for="shoes_size_<?= $size['variation_id'] ?>">
                                                        <?= $size['variation_name'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="alert alert-warning">No size found. Please add size first.</div>
                                        <?php endif; ?>
                                    </div>
                                    <div id="table_shoes">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>
<script>
    // shoes_color[]
    // shoes_size[]

    // make table
    function shoes() {

        // clear content table_Shoes
        $('#table_shoes').html('');

        var color = document.getElementsByName('shoes_color[]');
        var size = document.getElementsByName('shoes_size[]');
        var color_value = [];
        var color_label = [];
        var size_value = [];
        var size_label = [];
        var table = '';
        var thead = '';
        var tbody = '';

        for (var i = 0; i < color.length; i++) {
            if (color[i].checked) {
                // AJAX
                $.ajax({
                    url: '<?= base_url('admin/shoes_variation.php') ?>',
                    type: 'POST',
                    data: {
                        variation_id: color[i].value
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        color_value.push(data.variation_id);
                        color_label.push(data.variation_name);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }

        for (var i = 0; i < size.length; i++) {
            if (size[i].checked) {
                // AJAX
                $.ajax({
                    url: '<?= base_url('admin/shoes_variation.php') ?>',
                    type: 'POST',
                    data: {
                        variation_id: size[i].value
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        size_value.push(data.variation_id);
                        size_label.push(data.variation_name);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }





        function get_table() {
            // make table
            thead += '<thead>';
            thead += '<tr>';
            thead += '<th>Color</th>';
            thead += '<th>Size</th>';
            thead += '<th>Stock</th>';
            thead += '<th>Price</th>';
            thead += '</tr>';
            thead += '</thead>';

            tbody += '<tbody>';
            for (var i = 0; i < color_value.length; i++) { //color row used size size
                for (var j = 0; j < size_value.length; j++) { //size row used color color
                    tbody += '<tr>';
                    // tbody += '<td>' + color_label[i] + '</td>';
                    if (j == 0) {
                        tbody += '<td rowspan="' + size_value.length + '">' + color_label[i] + '</td>';
                    }
                    tbody += '<td>' + size_label[j] + '</td>';
                    tbody += '<td><input type="number" name="stock[' + color_value[i] + '][' + size_value[j] + ']" class="form-control" required></td>';
                    tbody += '<td><input type="number" name="price[' + color_value[i] + '][' + size_value[j] + ']" class="form-control" step="0.01" required></td>';
                    tbody += '</tr>';
                }
            }

            tbody += '</tbody>';

            table += '<table class="table table-bordered">';
            table += thead;
            table += tbody;
            table += '</table>';
            // btn submit
            table += '<button type="submit" class="btn btn-primary">Submit</button>';

            return table;
        }
        // ajax display 
        setTimeout(function() {
            $('#table_shoes').html(get_table());
        }, 1000);

    }
</script>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shoes_name = $_POST['shoes_name'];
    $shoes_category_id = $_POST['shoes_category_id'];
    $shoes_description = $_POST['shoes_description'];
    $shoes_status = $_POST['shoes_status'];
    $shoes_created_by = $user_id;

    // image
    $shoes_image = $_FILES['shoes_image']['name'];
    $shoes_image_tmp = $_FILES['shoes_image']['tmp_name'];
    $shoes_image_size = $_FILES['shoes_image']['size'];
    $shoes_image_error = $_FILES['shoes_image']['error'];
    $shoes_image_type = $_FILES['shoes_image']['type'];

    $shoes_image_ext = explode('.', $shoes_image);
    $shoes_image_ext = strtolower(end($shoes_image_ext));

    $shoes_image_new_name = uniqid('', true) . '.' . $shoes_image_ext;
    $shoes_image_destination = '../assets/img/shoes/' . $shoes_image_new_name;

    move_uploaded_file($shoes_image_tmp, $shoes_image_destination);

    $data = array(
        'shoes_name' => $shoes_name,
        'shoes_image' => $shoes_image_new_name,
        'shoes_category_id' => $shoes_category_id,
        'shoes_description' => $shoes_description,
        'shoes_status' => $shoes_status,
        'shoes_created_by' => $user_id
    );
    $shoes_id = $shoes->addShoes($data);
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    foreach ($stock as $key => $value) {
        foreach ($value as $key2 => $value2) {
            $data = array(
                'shoes_detail_shoes_id' => $shoes_id,
                'shoes_detail_variation_color_id' => $key,
                'shoes_detail_variation_size_id' => $key2,
                'shoes_detail_quantity' => $value2,
                'shoes_detail_price' => $price[$key][$key2],
                'shoes_detail_status' => 1,
                'shoes_detail_created_by' => $shoes_created_by
            );
            $shoes->addShoesDetail($data);
        }
    }
    $_SESSION['success'] = alert('Shoes added successfully', 'success');
    redirect(base_url('admin/shoes_list.php'));
} ?>