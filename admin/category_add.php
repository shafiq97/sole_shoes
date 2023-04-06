<?php $title = "Category"; ?>
<?php include "layout/header.php"; ?>
<?php $category = new Category_model(); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_parent = $_POST['category_parent'];
    $category_name = $_POST['category_name'];
    $errors = [];
    if ($category_parent == '') {
        $errors['category_parent'] = 'Please select category';
    }
    if (empty($category_name)) {
        $errors['category_name'] = 'Please enter category name';
    }
    if (empty($errors)) {

        if ($category_parent == 0) {
            $category_parent = NULL;
        }

        $dataCategory = array(
            'category_name' => $category_name,
            'category_parent' => $category_parent,
            'user_id' => $user_id
        );
        $category->addCategory($dataCategory);

        $_SESSION['message'] = alert('Category added successfully', 'success');
        redirect('admin/category_list.php');
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
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group mt-3">
                                <label for="category_parent">Category</label>
                                <select class="form-control" id="category_parent" name="category_parent">
                                    <option value="0">Parent</option>
                                    <?php foreach ($category->getMainCategory() as $category) : ?>
                                        <option value="<?= $category['category_id'] ?>" <?= isset($_POST['category_parent']) && $_POST['category_parent'] == $category['category_id'] ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger font-weight-bold"><?= isset($errors['category_parent']) ? $errors['category_parent'] : '' ?></span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="<?= isset($_POST['category_name']) ? $_POST['category_name'] : '' ?>">
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