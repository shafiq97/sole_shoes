<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
if (!isset($_SESSION['user']['admin'])) {
    $_SESSION['error'] = alert('You must login first', 'danger');
    echo '<script>window.location.href = "../sign_in.php";</script>';
} else {
    include '../helper/html_helper.php';
    require_once '../model/Database.php';
    require_once '../model/Category_model.php';
    $categories = new Category_model();
    $user_id = $_SESSION['user']['admin']['user_id'];
    $user_name = $_SESSION['user']['admin']['user_name'];
    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $categories->deleteCategory($category_id, $user_id);
        $_SESSION['success'] = alert('Category deleted', 'success');
        redirect(base_url('admin/category_list.php'));
    }
}
