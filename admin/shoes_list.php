<?php $title = "Shoes"; ?>
<?php include "layout/header.php"; ?>
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
                <?php if (isset($_SESSION['message'])) : ?>
                    <?= $_SESSION['message'] ?>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title row">
                            <div class="col-lg-3 col-12">
                                <a href="shoes_add.php" class="btn btn-primary w-100">Add New Shoes</a>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Shoes Image</th>
                                    <th>Shoes Name</th>
                                    <th>Shoes Description</th>
                                    <!-- <th>Color</th>
                                    <th>Size</th>
                                    <th>Shoes Price</th>
                                    <th>Quantity</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($shoes->getAllShoes() as $row) : ?>
                                    <tr>
                                        <td data-no="<?= $row['shoes_id'] ?>"><?= $no++ ?></td>
                                        <td>
                                            <!-- modal -->
                                            <img src="<?= base_url('assets/img/shoes/' . $row['shoes_image']) ?>" alt="" width="100px" data-toggle="modal" data-target="#shoesImage<?= $row['shoes_id'] ?>">
                                            <div class="modal fade" id="shoesImage<?= $row['shoes_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="shoesImage<?= $row['shoes_id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <img src="<?= base_url('assets/img/shoes/' . $row['shoes_image']) ?>" alt="" width="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $row['shoes_name'] ?></td>
                                        <td><?= $row['shoes_description'] ?></td>
                                        <!-- <td><?= $row['color_name'] ?></td>
                                        <td><?= $row['size_name'] ?></td>
                                        <td><?= $row['shoes_price'] ?></td>
                                        <td><?= $row['quantity'] ?></td> -->
                                        <td>
                                            <a href="shoes_edit.php?id=<?= $row['shoes_id'] ?>" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <!-- <a href="shoes_delete.php?id=<?= $row['shoes_id'] ?>" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </a> -->

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#shoesDelete<?= $row['shoes_id'] ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="shoesDelete<?= $row['shoes_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="shoesDelete<?= $row['shoes_id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="shoesDelete<?= $row['shoes_id'] ?>">Delete Shoes</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete this shoes?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <a href="shoes_delete.php?shoes_id=<?= $row['shoes_id'] ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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