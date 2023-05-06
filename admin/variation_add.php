<?php $title = "Variation Add"; ?>
<?php include "layout/header.php"; ?>
<?php $variation = new Variation_model(); ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $variation_type = $_POST['variation_type'];
    $variation_name = $_POST['variation_name'];
    $errors = [];
    if (empty($variation_type)) {
        $errors['variation_type'] = 'Please select variation type';
    }
    if (empty($variation_name)) {
        $errors['variation_name'] = 'Please enter variation name';
    }
    if (empty($errors)) {
        $dataVariation = array(
            'type' => $variation_type,
            'name' => $variation_name,
            'status' => '1',
            'created_by' => $user_id
        );
        $variation->addVariation($dataVariation);
        $_SESSION['message'] = alert('Variation added successfully', 'success');
        redirect('variation_list.php');
    }
}
?>
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
                <?php if (isset($_SESSION['message'])) : ?>
                    <?= $_SESSION['message'] ?>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a href="variation_list.php" class="btn btn-warning">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="variation_add.php" method="post">
                            <div class="form-group mb-3">
                                <label for="variation_type">Variation Type</label>
                                <select class="form-control" id="variation_type" name="variation_type">
                                    <option value="">Please Select</option>
                                    <option value="1" <?= isset($_POST['variation_type']) && $_POST['variation_type'] == 1 ? 'selected' : '' ?>>Color</option>
                                    <option value="2" <?= isset($_POST['variation_type']) && $_POST['variation_type'] == 2 ? 'selected' : '' ?>>Size</option>
                                </select>
                                <span class="text-danger font-weight-bold"><?= isset($errors['variation_type']) ? $errors['variation_type'] : '' ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="variation_name">Variation Name</label>
                                <input type="text" class="form-control" id="variation_name" name="variation_name" placeholder="Enter Variation Name" value="<?= isset($_POST['variation_name']) ? $_POST['variation_name'] : '' ?>">
                                <span class="text-danger font-weight-bold"><?= isset($errors['variation_name']) ? $errors['variation_name'] : '' ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>