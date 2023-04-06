<?php $title = "User"; ?>
<?php include "layout/header.php"; ?>
<?php $user = new User_model(); ?>
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
                <?php if (isset($_SESSION['success'])) : ?>
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']) ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a href="user_add.php" class="btn btn-primary">Add New User</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered datatable ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Registered At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($user->getAllUser() as $user) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $user['user_name'] ?></td>
                                            <td><?= $user['user_email'] ?></td>
                                            <td><?= $user['user_phone'] ?></td>
                                            <td><?= $user['user_role'] ?></td>
                                            <td data-order="<?= strtotime($user['user_created_at']) ?>"><?= date('d F Y h:i a', strtotime($user['user_created_at'])) ?></td>
                                            <td class="text-center">
                                                <a href="user_edit.php?id=<?= $user['user_id'] ?>" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="user_delete.php?id=<?= $user['user_id'] ?>" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
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
        </div>
    </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>