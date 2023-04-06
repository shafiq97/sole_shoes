
<?php
require_once '../model/Database.php';
require_once '../model/Variation_model.php';
?>
<?php $variation = new Variation_model(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $variation_id = $_POST['variation_id'];
    $result = $variation->getVariationById($variation_id);

    $data = array(
        'variation_id' => $result['variation_id'],
        'variation_name' => $result['variation_name']
    );

    echo json_encode($data);
}
