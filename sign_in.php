<?php $title = 'Sign In'; ?>
<?php include 'layout/header.php'; ?>
<?php
if (isset($_SESSION['user']['customer'])) {
    echo '<script>window.location.href = "index.php";</script>';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }

    if (count($errors) == 0) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User_model();
        $user = $user->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['user_password'])) {
                if ($user['user_role'] == 'customer') {
                    $_SESSION['user']['customer'] = $user;
                } else if ($user['user_role'] == 'admin') {
                    $_SESSION['user']['admin'] = $user;
                    echo '<script>window.location.href = "admin/index.php";</script>';
                }
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                $errors['password'] = 'Password is incorrect';
            }
        } else {
            $errors['email'] = 'Email is not found';
        }
    }
}
?>
<main id="main" class="mt-5">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="row content">
                <div class="col-lg-6 offset-lg-3 border border-dark rounded p-5">
                    <h2>Sign In</h2>
                    <?php if (isset($_SESSION['success'])) : ?>
                        <?= $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <?= $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="sign_in.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            <span class="text-danger font-weight-bold"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <span class="text-danger font-weight-bold"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- sign up -->
                        <p class="mt-3">Don't have an account? <a href="sign_up.php">Sign Up</a></p>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main>

<?php include 'layout/footer.php'; ?>