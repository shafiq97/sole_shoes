<?php $title = "Request List"; ?>
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
                  <th>Request ID</th>
                  <th>Filename</th>
                  <th>Image</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // create a MySQL connection
                $conn = mysqli_connect('localhost', 'root', '', 'db_shoes');

                // query the requests table to retrieve all requests
                $query  = "SELECT * FROM requests";
                $result = mysqli_query($conn, $query);

                // loop through each request and display its details in a table row
                while ($request = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td>
                      <?= $request['id'] ?>
                    </td>
                    <td>
                      <?= $request['filename'] ?>
                    </td>
                    <td>
                      <img src="<?= $request['filename'] ?>" alt="<?= $request['filename'] ?>" width="100">
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
