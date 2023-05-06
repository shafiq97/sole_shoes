<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/Applications/XAMPP/xamppfiles/htdocs/shoes/model/Database.php';
require_once '/Applications/XAMPP/xamppfiles/htdocs/shoes/model/Shoes_model.php';

$keyword = $_GET['keyword'];

$shoesModel = new Shoes_model();
$shoes = $shoesModel->searchShoes($keyword);

// Display the search results
// ...


?>

<?php foreach ($shoes as $shoe): ?>
  <div>
      <h3><?php echo $shoe['shoes_name']; ?></h3>
      <img src="<?php echo $shoe['shoes_image']; ?>" alt="<?php echo $shoe['shoes_name']; ?>">
      <!-- <p>Price: <?php echo $shoe['price']; ?></p> -->
  </div>
<?php endforeach; ?>
