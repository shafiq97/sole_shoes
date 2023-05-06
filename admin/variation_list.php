<?php $title = "Variation"; ?>
<?php include "layout/header.php"; ?>
<?php $variation = new Variation_model(); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>
            <?= $title ?>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">
                    <?= $title ?>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <?php if (isset($_SESSION['message'])): ?>
                    <?= $_SESSION['message'] ?>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title row">
                            <div class="col-lg-3 col-12">
                                <a href="variation_add.php" class="btn btn-primary w-100">Add New Variation</a>
                            </div>
                            <div class=" col-lg-3 col-6">
                                <select class="form-control" id="variation_type">
                                    <option value="0">All</option>
                                    <option value="1">Color</option>
                                    <option value="2">Size</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-6">
                                <button type="button" class="btn btn-primary" id="btn-filter">Filter</button>
                            </div>

                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Variation Type</th>
                                    <th>Variation Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($variation->getAllVariation() as $variation): ?>
                                    <tr>
                                        <td>
                                            <?= $variation['variation_id'] ?>
                                        </td>
                                        <td>
                                            <?php if ($variation['variation_type'] == '1'): ?>
                                                <span>Color</span>
                                            <?php elseif ($variation['variation_type'] == '2'): ?>
                                                <span>Size</span>
                                            <?php else: ?>
                                                <span>None</span>
                                            <?php endif; ?>
                                        <td>
                                            <?= $variation['variation_name'] ?>
                                        </td>
                                        <td>
                                            <a href="variation_edit.php?variation_id=<?= $variation['variation_id'] ?>"
                                                class="btn btn-primary">Edit</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal<?= $variation['variation_id'] ?>">
                                                Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal<?= $variation['variation_id'] ?>"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="deleteModalLabel<?= $variation['variation_id'] ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="variation_delete.php">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel<?= $variation['variation_id'] ?>">
                                                                    Delete Variation</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this variation?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="variation_id"
                                                                    value="<?= $variation['variation_id'] ?>">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
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