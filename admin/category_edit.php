<?php $title = "Category"; ?>
<?php include "layout/header.php"; ?>
<?php $category = new Category_model(); ?>
<?php

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $category_now = $category->getCategoryById($category_id);

    if ($category_now) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_name = $_POST['category_name'];
            $errors = [];
            if (empty($category_name)) {
                $errors['category_name'] = 'Please enter category name';
            }
            if (empty($errors)) {

                $dataCategory = array(
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                );
                $category->editCategory($dataCategory);

                $_SESSION['message'] = alert('Category updated successfully', 'success');
                redirect('category_list.php');
            }
        }
    } else {
        redirect('category_list.php');
    }
} else {
    redirect('category_list.php');
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
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group mt-3">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="<?= isset($category_now['category_name']) ? $category_now['category_name'] : '' ?>">
                                <span class="text-danger font-weight-bold"><?= isset($errors['category_name']) ? $errors['category_name'] : '' ?></span>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>