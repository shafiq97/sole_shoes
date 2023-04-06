<?php $title = "Variation Add"; ?>
<?php include "layout/header.php"; ?>
<?php $variation = new Variation_model(); ?>
<?php

if (isset($_GET['variation_id'])) {
    $variation_id = $_GET['variation_id'];
    $d_variation = $variation->getVariationById($variation_id);
    if ($d_variation) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variation_name = $_POST['variation_name'];
            $errors = [];
            if (empty($variation_name)) {
                $errors['variation_name'] = 'Please enter variation name';
            }
            if (empty($errors)) {
                $dataVariation = array(
                    'id' => $variation_id,
                    'name' => $variation_name,
                    'updated_at' => date("Y-m-d H:i:s")
                );
                $variation->updateVariation($dataVariation);
                $_SESSION['message'] = alert('Variation updated successfully', 'success');
                redirect('variation_list.php');
            }
        }
    } else {
        echo "<script>window.location.href = 'variation_list.php';</script>";
    }
} else {
    echo "<script>window.location.href = 'variation_list.php';</script>";
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
                        <form action="" method="post">
                            <div class="form-group mb-3">
                                <label for="variation_name">Variation Name</label>
                                <input type="text" class="form-control" id="variation_name" name="variation_name" placeholder="Enter Variation Name" value="<?= isset($d_variation['variation_name']) ? $d_variation['variation_name'] : '' ?>">
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