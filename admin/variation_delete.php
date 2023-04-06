<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
if (!isset($_SESSION['user']['admin'])) {
    $_SESSION['error'] = alert('You must login first', 'danger');
    echo '<script>window.location.href = "../sign_in.php";</script>';
} else {
    include '../helper/html_helper.php';
    require_once '../model/Database.php';
    require_once '../model/Variation_model.php';
    $categories = new Variation_model();
    $user_id = $_SESSION['user']['admin']['user_id'];
    $user_name = $_SESSION['user']['admin']['user_name'];
    if (isset($_GET['variation_id'])) {
        $variation_id = $_GET['variation_id'];
        $categories->deleteVariation($variation_id, $user_id);
        $_SESSION['success'] = alert('Variation deleted', 'success');
        redirect(base_url('admin/variation_list.php'));
    }
}
