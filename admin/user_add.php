<?php $title = "User"; ?>
<?php include "layout/header.php"; ?>
<?php $user = new User_model(); ?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    if (empty($_POST['user_name'])) {
        $errors['name'] = 'Name is required';
    }

    if (empty($_POST['user_email'])) {
        $errors['email'] = 'Email is required';
    }

    if (empty($_POST['user_phone'])) {
        $errors['phone'] = 'Phone is required';
    }

    if (empty($_POST['user_password'])) {
        $errors['password'] = 'Password is required';
    }

    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Confirm password is required';
    }

    if (empty($_POST['user_role'])) {
        $errors['role'] = 'Role is required';
    }

    if (count($errors) == 0) {
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $phone = $_POST['user_phone'];
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $role =  $_POST['user_role'];

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
                echo "<script>window.location.href = 'user_add.php';</script>";
            }
        }
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
                    <div class="card-header">
                        <i class="fas fa-user"></i> Form add user
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="user_name">Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Name" required>
                                <span class="text-danger font-weight-bold"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter Email" required>
                                <span class="text-danger font-weight-bold"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_phone">Phone</label>
                                <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Enter Phone" onkeypress="return isNumberKey(event)" required>
                                <span class="text-danger font-weight-bold"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_role">Role</label>
                                <select name="user_role" id="user_role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="customer">Customer</option>
                                </select>
                                <span class="text-danger font-weight-bold"><?= isset($errors['role']) ? $errors['role'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter Password" required>
                                <span class="text-danger font-weight-bold"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Confirm Password" required>
                                <span class="text-danger font-weight-bold"><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></span>
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