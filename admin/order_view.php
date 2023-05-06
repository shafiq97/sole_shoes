<?php
// get the order ID from the URL parameter
$order_id = $_GET['order_id'];

// create a MySQL connection
$conn = mysqli_connect('localhost', 'root', '', 'db_shoes');

// query the orders table to retrieve the order details
$order_query  = "SELECT * FROM orders WHERE order_id = '$order_id'";
$order_result = mysqli_query($conn, $order_query);
$order        = mysqli_fetch_assoc($order_result);

// query the order_items table to retrieve the order items
$order_items_query  = "SELECT * FROM order_items WHERE order_id = '$order_id'";
$order_items_result = mysqli_query($conn, $order_items_query);

// close the MySQL connection
mysqli_close($conn);

// set the page title
$title = "Order #" . $order['order_id'];

// include the header
include "layout/header.php";
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>
      <?= $title ?>
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="order_list.php">Order List</a></li>
        <li class="breadcrumb-item active">
          <?= $title ?>
        </li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2>Order Details</h2>
            <table class="table">
              <tbody>
                <tr>
                  <th>Order ID:</th>
                  <td>
                    <?= $order['order_id'] ?>
                  </td>
                </tr>
                <tr>
                  <th>Customer ID:</th>
                  <td>
                    <?= $order['customer_id'] ?>
                  </td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>RM
                    <?= $order['total'] ?>
                  </td>
                </tr>
                <tr>
                  <th>Date:</th>
                  <td>
                    <?= $order['date'] ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <h2>Order Items</h2>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($item = mysqli_fetch_assoc($order_items_result)): ?>
                  <tr>
                    <td>
                      <?= $item['product_name'] ?>
                    </td>
                    <td>RM
                      <?= $item['price'] ?>
                    </td>
                    <td>
                      <?= $item['quantity'] ?>
                    </td>
                    <td>RM
                      <?= $item['price'] * $item['quantity'] ?>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php include "layout/footer.php"; ?>