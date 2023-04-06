<?php $title = "Category List"; ?>
<?php include "layout/header.php"; ?>
<?php $categories = new Category_model(); ?>
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
                    <div class="card-body">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories->getAllCategory()['list_category_name'] as $category) : ?>
                                    <tr>
                                        <td><?= $category['category_id'] ?></td>
                                        <td><?= $category['category_name'] ?></td>
                                        <td class="text-center">
                                            <a href="category_edit.php?category_id=<?= $category['category_id'] ?>" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="category_delete.php?category_id=<?= $category['category_id'] ?>" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>