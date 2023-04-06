<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
if (!isset($_SESSION['user']['admin'])) {
    $_SESSION['error'] = alert('You must login first', 'danger');
    echo '<script>window.location.href = "../sign_in.php";</script>';
} else {
    include '../helper/html_helper.php';
    require_once '../model/Database.php';
    require_once '../model/User_model.php';
    $user_id = $_SESSION['user']['admin']['user_id'];

    $user = new User_model();
    if (isset($_GET['id'])) {
        $User_id = $_GET['id'];
        $user->deleteUser($User_id);
        $_SESSION['success'] = alert('User deleted', 'success');
        redirect(base_url('admin/User_list.php'));
    }
}
