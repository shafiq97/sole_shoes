<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
include 'helper/html_helper.php';
require_once 'model/Database.php';
require_once 'model/User_model.php';
require_once 'model/Shoes_model.php';

if (isset($_SESSION['user']['customer'])) {
    $user_id = $_SESSION['user']['customer']['user_id'];
    $user_name = $_SESSION['user']['customer']['user_name'];
    $user = new User_model();
    $shoes = new Shoes_model();
    $total_item = $user->getTotalItemInCart($user_id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $color_id = $_POST['color'];
        $size_id = $_POST['size'];
        $quantity = $_POST['quantity'];
        $shoes_detail = $shoes->getShoesByColorIdAndSizeId($color_id, $size_id);
        if ($shoes_detail != false) {
            $dataCart = array(
                'user_cart_user_id' => $user_id,
                'user_cart_shoes_detail_id' => $shoes_detail['shoes_detail_id'],
                'user_cart_quantity' => $quantity,
                'user_cart_status' => '1',
                'user_cart_updated_at' => date('Y-m-d H:i:s'),
            );
            $cart_list = $user->getCartShoesDetailId($user_id, $shoes_detail['shoes_detail_id']);
            if ($cart_list != false) {
                $dataCart['user_cart_quantity'] = $cart_list['user_cart_quantity'] + $quantity;
                $dataCart['user_cart_id'] = $cart_list['user_cart_id'];
                $user->update_user_cart($dataCart);
            } else {
                $user->insert_user_cart($dataCart);
                $total_item += 1;
            }
            $status = 'success';
            $message = 'Shoes added to cart';
        } else {
            $status = 'error';
            $message = 'Shoes not found';
        }
    } else {
        $status = '';
        $message = '';
    }
    echo json_encode(array('status' => $status, 'message' => $message, 'total_item' => $total_item));
} else {
    $status = 'error';
    $message = 'You must login first';
    echo json_encode(array('status' => $status, 'message' => $message));
}
