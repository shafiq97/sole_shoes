<?php $title = "Order List"; ?>
<?php include "layout/header.php"; ?>
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
          <div class="card-body">
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer ID</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // create a MySQL connection
                $conn = mysqli_connect('localhost', 'root', '', 'db_shoes');

                // query the orders table to retrieve all orders
                $query  = "SELECT * FROM orders";
                $result = mysqli_query($conn, $query);

                // loop through each order and display its details in a table row
                while ($order = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td>
                      <?= $order['order_id'] ?>
                    </td>
                    <td>
                      <?= $order['customer_id'] ?>
                    </td>
                    <td>
                      <?= $order['total'] ?>
                    </td>
                    <td>
                      <?= $order['date'] ?>
                    </td>
                    <td class="text-center">
                      <a href="order_view.php?order_id=<?= $order['order_id'] ?>" class="btn btn-primary">
                        View
                      </a>
                    </td>
                  </tr>
                  <?php
                }

                // close the MySQL connection
                mysqli_close($conn);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php include "layout/footer.php"; ?>