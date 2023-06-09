<?php $title = 'Home'; ?>
<?php include 'layout/header.php'; ?>
<?php
// Database connection details
$host     = 'localhost';
$dbname   = 'db_shoes';
$user     = 'root';
$password = '';

// Connect to the database using MySQLi
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all categories
$query      = "SELECT * FROM category";
$result     = $conn->query($query);
$categories = array();
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}
$conn->close();
?>

?>
<!-- ======= Hero Section ======= -->
<style>
    .btn-customize {
        background-color: #f5a10e;
        border: none;
        color: #ffffff;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-customize:hover {
        background-color: #d6890b;
        color: #ffffff;
    }
</style>
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active"
                style="background-image: url(assets/img/bg1.jpg); background-size: cover;">
                <div class="carousel-container">
                    <div class="container">
                        <h2 class="animate__animated animate__fadeInDown">Welcome to <span>The Sole Footwear</span></h2>
                        <a href="http://localhost:3000/"
                            class="btn btn-customize animate__animated animate__fadeInUp">Customize</a>
                    </div>
                </div>
            </div>



            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row content">
                <div class="col-lg-6">
                    <h2>The Branded Shoes</h2>
                    <h3>Originally product brand with high quality and comfort shoes</h3>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>
                        Shoe is an item of footwear intended to protect and comfort the human foot.They are often worn
                        with a sock.
                        The design of shoes has varied enormously through time and from culture to culture.
                        Through the human foot can adapt to varied terrains and climate condition, it is still
                        vulnerable to enviroment
                        hazards such as sharp rock and temperature extremes.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Indoor shoes were make entirely of organic gum rubber.
                        </li>
                        <li><i class="ri-check-double-line"></i> Outdoor shoes were make of high abrasion synthetic
                            rubber.</li>
                        <li><i class="ri-check-double-line"></i> Skeachers offer a complete collection of footwear ,
                            appreal and
                            accesories for men , women and kids.</li>
                    </ul>
                    <p class="fst-italic">
                        Sport Shoes are often the designed to be worn for sport, excerising, or recreational activity,
                        as racquetball, jogging, or
                        aerobic dancing
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
        <div class="container">

            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="assets/img/brand/adidas.webp" class="img-fluid" alt="">
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="assets/img/brand/convers.jpeg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="assets/img/brand/nike.webp" class="img-fluid" alt="">
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="assets/img/brand/vans.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="assets/img/brand/tadio.webp" class="img-fluid" alt="">
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="assets/img/brand/timberland.png" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">
            <div class="row">
                <?php foreach ($categories as $category): ?>
                    <div class="col-md-6">
                        <div class="icon-box">
                            <!-- Add your icon here -->
                            <h4><a href="#">
                                    <?php echo $category['category_name']; ?>
                                </a></h4>
                            <p>
                                <?php echo $category['description']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">Sales</li>
                        <li data-filter=".filter-card">Promo Sales</li>
                        <li data-filter=".filter-web">Latest Shoes</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-11.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-11.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-13.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-13.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-14.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-14.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-15.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 2</h4>
                            <p>Card</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-15.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-12.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 2</h4>
                            <p>Web</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-12.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-10.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>App</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-10.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-18.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 1</h4>
                            <p>Card</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-18.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-16.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 3</h4>
                            <p>Card</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-16.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="assets/img/portfolio/portfolio-17.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-17.jpg" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" class="portfolio-details-lightbox"
                                    data-glightbox="type: external" title="Portfolio Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->

<?php include 'layout/footer.php'; ?>