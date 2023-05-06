<?php $title = "Shoes"; ?>
<?php include 'layout/header.php'; ?>
<?php $user = new User_model(); ?>
<?php
// retrieve the order total from the URL parameter
error_reporting(E_ALL);
ini_set('display_errors', 1);
$total = $_GET['total'];

// insert the order data into the database
$conn  = mysqli_connect('localhost', 'root', '', 'db_shoes');
$query = "INSERT INTO orders (customer_id, total) VALUES ('" . $_SESSION['user']['customer']['user_id'] . "', '" . $total . "')";
mysqli_query($conn, $query);

// retrieve the newly created order ID
$order_id = mysqli_insert_id($conn);

// retrieve the items in the user's cart
$cart_items = $user->getDetailItemInCart($_SESSION['user']['customer']['user_id']);

// insert each cart item into the order items table
foreach ($cart_items as $item) {
    $query = "INSERT INTO order_items (order_id, shoes_id, color, size, price, quantity) VALUES ('" . $order_id . "', '" . $item['shoes_detail']['shoes_id'] . "', '" . $item['shoes_detail']['shoes_detail_color'] . "', '" . $item['shoes_detail']['shoes_detail_size'] . "', '" . $item['shoes_detail']['shoes_detail_price'] . "', '" . $item['user_cart_quantity'] . "')";
    mysqli_query($conn, $query);
}

// clear the user's cart
// $user->clearCart($_SESSION['user']['customer']['user_id']);

// redirect the user to the order confirmation page
header('Location: order_confirmation.php?id=' . $order_id);
// exit;
?>
<main id="main" class="mt-5">
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Cart</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Shoes</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_all = 0; ?>
                                <?php foreach ($user->getDetailItemInCart($_SESSION['user']['customer']['user_id']) as $row): ?>
                                    <tr>
                                        <td>No.</td>
                                        <td>
                                            <?= $row['shoes_detail']['shoes_name'] ?>
                                        </td>
                                        <td>
                                            <?= $row['shoes_detail']['shoes_detail_color'] ?>
                                        </td>
                                        <td>
                                            <?= $row['shoes_detail']['shoes_detail_size'] ?>
                                        </td>
                                        <td>RM
                                            <?= $row['shoes_detail']['shoes_detail_price'] ?>
                                        </td>
                                        <td>
                                            <?= $row['user_cart_quantity'] ?>
                                        </td>
                                        <td>RM
                                            <?= $row['shoes_detail']['shoes_detail_price'] * $row['user_cart_quantity'] ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('cart.php?delete=' . $row['user_cart_id']) ?>"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $total_all += $row['shoes_detail']['shoes_detail_price'] * $row['user_cart_quantity'] ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-6 text-end">
                        <div class="row">
                            <div class="col-10 ">
                                <h4 style="font-family: sans-serif;">Total: RM
                                    <?= $total_all ?>
                                </h4>
                            </div>
                            <div class="col-2">
                                <a href="<?= base_url('checkout.php') . '?total=' . $total_all ?>"
                                    class="btn btn-primary btn-block float-right">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section><!-- End Portfolio Section -->
</main>
<?php include 'layout/footer.php'; ?>

<?php if (isset($_GET['delete'])): ?>
    <?php $user->deleteItemInCart($_GET['delete']); ?>
    <script>
        window.location.href = "<?= base_url('cart.php') ?>";
    </script>
<?php endif; ?>