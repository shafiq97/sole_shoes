<?php

class User_model
{
    private $table = 'user';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_status != 3');
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id=:user_id AND user_status != 3');
        $this->db->bind('user_id', $id);
        return $this->db->single();
    }

    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_email=:user_email AND user_status != 3');
        $this->db->bind('user_email', $email);
        return $this->db->single();
    }

    public function getUserByPhone($phone)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_phone=:user_phone AND user_status != 3');
        $this->db->bind('user_phone', $phone);
        return $this->db->single();
    }

    public function getUserByName($name)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_name=:user_name AND user_status != 3');
        $this->db->bind('user_name', $name);
        return $this->db->single();
    }

    public function getUserByRole($role)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_role=:user_role AND user_status != 3');
        $this->db->bind('user_role', $role);
        return $this->db->resultSet();
    }

    public function createUser($data)
    {
        $query = "INSERT INTO " . $this->table . " VALUES (null, :user_name, :user_password, :user_email, :user_phone, :user_role, :user_status, :user_created_at, :user_updated_at)";
        $this->db->query($query);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('user_password', $data['user_password']);
        $this->db->bind('user_email', $data['user_email']);
        $this->db->bind('user_phone', $data['user_phone']);
        $this->db->bind('user_role', $data['user_role']);
        $this->db->bind('user_status', $data['user_status']);
        $this->db->bind('user_created_at', $data['user_created_at']);
        $this->db->bind('user_updated_at', $data['user_updated_at']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateUser($data)
    {
        $query = "UPDATE " . $this->table . " SET user_name=:user_name, user_password=:user_password, user_email=:user_email, user_phone=:user_phone, user_role=:user_role, user_status=:user_status, user_updated_at=:user_updated_at WHERE user_id=:user_id AND user_status != 3";
        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('user_password', $data['user_password']);
        $this->db->bind('user_email', $data['user_email']);
        $this->db->bind('user_phone', $data['user_phone']);
        $this->db->bind('user_role', $data['user_role']);
        $this->db->bind('user_status', $data['user_status']);
        $this->db->bind('user_updated_at', $data['user_updated_at']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteUser($id)
    {
        $query = "UPDATE " . $this->table . " SET user_status=:user_status, user_updated_at=:user_updated_at WHERE user_id=:user_id AND user_status != 3";
        $this->db->query($query);
        $this->db->bind('user_id', $id);
        $this->db->bind('user_status', 3);
        $this->db->bind('user_updated_at', date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function insert_user_log($data)
    {
        $query = "INSERT INTO user_log VALUES (null, :user_log_ip, :user_log_browser, :user_log_os, :user_log_device, :user_log_country, :user_log_city, :user_log_latitude, :user_log_longitude, :user_log_created_at)";
        $this->db->query($query);
        $this->db->bind('user_log_ip', $data['user_log_ip']);
        $this->db->bind('user_log_browser', $data['user_log_browser']);
        $this->db->bind('user_log_os', $data['user_log_os']);
        $this->db->bind('user_log_device', $data['user_log_device']);
        $this->db->bind('user_log_country', $data['user_log_country']);
        $this->db->bind('user_log_city', $data['user_log_city']);
        $this->db->bind('user_log_latitude', $data['user_log_latitude']);
        $this->db->bind('user_log_longitude', $data['user_log_longitude']);
        $this->db->bind('user_log_created_at', $data['user_log_created_at']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // CREATE TABLE `user_cart`(
    //     `user_cart_id` int(11) NOT NULL AUTO_INCREMENT,
    //     `user_cart_user_id` int(11) NOT NULL,
    //     `user_cart_shoes_detail_id` int(11) NOT NULL,
    //     `user_cart_quantity` int(11) NOT NULL,
    //     `user_cart_status` int(1) NOT NULL,
    //     `user_cart_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    //     `user_cart_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //     `user_cart_deleted_at` datetime NULL,
    //     `user_cart_created_by` int(11) NULL,
    //     `user_cart_deleted_by` int(11) NULL,
    //     PRIMARY KEY (`user_cart_id`),
    //     FOREIGN KEY (`user_cart_user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //     FOREIGN KEY (`user_cart_shoes_detail_id`) REFERENCES `shoes_detail`(`shoes_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //     FOREIGN KEY (`user_cart_created_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
    //     FOREIGN KEY (`user_cart_deleted_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
    // ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

    public function insert_user_cart($data)
    {
        $query = "INSERT INTO user_cart (user_cart_user_id, user_cart_shoes_detail_id, user_cart_quantity, user_cart_status) VALUES (:user_cart_user_id, :user_cart_shoes_detail_id, :user_cart_quantity, :user_cart_status)";
        $this->db->query($query);
        $this->db->bind('user_cart_user_id', $data['user_cart_user_id']);
        $this->db->bind('user_cart_shoes_detail_id', $data['user_cart_shoes_detail_id']);
        $this->db->bind('user_cart_quantity', $data['user_cart_quantity']);
        $this->db->bind('user_cart_status', $data['user_cart_status']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getTotalItemInCart($user_id)
    {
        $query = "SELECT * FROM user_cart WHERE user_cart_user_id = :user_cart_user_id AND user_cart_deleted_at IS NULL";
        $this->db->query($query);
        $this->db->bind('user_cart_user_id', $user_id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDetailItemInCart($user_id)
    {
        $query = "SELECT * FROM user_cart WHERE user_cart_user_id = :user_cart_user_id AND user_cart_deleted_at IS NULL";
        $this->db->query($query);
        $this->db->bind('user_cart_user_id', $user_id);
        $arr_cart = array();
        foreach ($this->db->resultSet() as $cart) {
            // join
            $query = "SELECT * FROM shoes_detail JOIN shoes ON shoes_detail.shoes_detail_shoes_id = shoes.shoes_id WHERE shoes_detail_id = :shoes_detail_id";
            $this->db->query($query);
            $this->db->bind('shoes_detail_id', $cart['user_cart_shoes_detail_id']);
            $shoes_detail = $this->db->single();

            // color 
            $color = $this->getVariationId($shoes_detail['shoes_detail_variation_color_id']);
            $size = $this->getVariationId($shoes_detail['shoes_detail_variation_size_id']);

            $shoes_detail['shoes_detail_color'] = $color['variation_name'];
            $shoes_detail['shoes_detail_size'] = $size['variation_name'];

            $cart['shoes_detail'] = $shoes_detail;

            array_push($arr_cart, $cart);
        }
        return $arr_cart;
    }

    function getVariationId($id)
    {
        // variation
        $this->db->query('SELECT * FROM variation WHERE variation_id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getCartShoesDetailId($user_id, $id)
    {
        $query = "SELECT * FROM user_cart WHERE user_cart_user_id = :user_cart_user_id AND user_cart_shoes_detail_id = :user_cart_shoes_detail_id AND user_cart_deleted_at IS NULL";
        $this->db->query($query);
        $this->db->bind('user_cart_shoes_detail_id', $id);
        $this->db->bind('user_cart_user_id', $user_id);
        return $this->db->single();
    }

    public function update_user_cart($dataCart)
    {
        $query = "UPDATE user_cart SET user_cart_quantity = :user_cart_quantity, user_cart_updated_at = :user_cart_updated_at WHERE user_cart_id = :user_cart_id";
        $this->db->query($query);
        $this->db->bind('user_cart_quantity', $dataCart['user_cart_quantity']);
        $this->db->bind('user_cart_updated_at', $dataCart['user_cart_updated_at']);
        $this->db->bind('user_cart_id', $dataCart['user_cart_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteItemInCart($item)
    {
        $query = "DELETE FROM user_cart WHERE user_cart_id = :user_cart_id";
        $this->db->query($query);
        $this->db->bind('user_cart_id', $item);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
