<?php $title = 'Sign Up'; ?>
<?php include 'layout/header.php'; ?>
<?php
if (isset($_SESSION['user']['customer'])) {
    echo '<script>window.location.href = "index.php";</script>';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required';
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    }

    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone is required';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }

    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Confirm password is required';
    }

    if (count($errors) == 0) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password != $confirm_password) {
            $errors['confirm_password'] = 'Password does not match';
        }
        if (count($errors) == 0) {
            $user = new User_model();
            $user_email = $user->getUserByEmail($email);

            if ($user_email) {
                $errors['email'] = 'Email already exists';
            }

            if (count($errors) == 0) {

                $dataUser = array(
                    'user_name' => $name,
                    'user_email' => $email,
                    'user_phone' => $phone,
                    'user_password' => password_hash($password, PASSWORD_DEFAULT),
                    'user_role' => 'customer',
                    'user_status' => '1',
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_updated_at' => date('Y-m-d H:i:s'),
                );

                $user->createUser($dataUser);

                $_SESSION['success'] = alert('Sign up successfully', 'success');
                echo "<script>window.location.href = 'sign_in.php';</script>";
            }
        }
    }
}
?>
<main id="main" class="mt-5">
    <section id="about" class="about">
        <div class="container">
            <div class="row content">
                <div class="col-lg-6 offset-lg-3 border border-dark rounded p-5">
                    <h2>Sign Up</h2>
                    <form action="sign_up.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Please enter your name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                            <span class="text-danger font-weight-bold"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            <span class="text-danger font-weight-bold"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                        </div>
                        <!-- phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Please enter your phone" onkeypress="return isNumberKey(event)" maxlength="13">
                            <span class="text-danger font-weight-bold"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Please enter your password">
                            <span class="text-danger font-weight-bold"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Please confirm your password">
                            <span class="text-danger font-weight-bold"><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <p class="mt-3">Already have an account? <a href="sign_in.php">Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'layout/footer.php'; ?>