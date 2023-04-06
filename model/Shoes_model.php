<?php
// CREATE TABLE `shoes`(
//     `shoes_id` int(11) NOT NULL AUTO_INCREMENT,
//     `shoes_name` varchar(255) NOT NULL,
//     `shoes_category_id` int(11) NOT NULL,
//     `shoes_image` varchar(255) NOT NULL,
//     `shoes_description` text NOT NULL,
//     `shoes_status` int(1) NOT NULL,
//     `shoes_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `shoes_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     `shoes_deleted_at` datetime NULL,
//     `shoes_created_by` int(11) NULL,
//     `shoes_deleted_by` int(11) NULL,
//     PRIMARY KEY (`shoes_id`),
//     FOREIGN KEY (`shoes_created_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
//     FOREIGN KEY (`shoes_deleted_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
// ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

// CREATE TABLE `shoes_detail`(
//     `shoes_detail_id` int(11) NOT NULL AUTO_INCREMENT,
//     `shoes_detail_shoes_id` int(11) NOT NULL,
//     `shoes_detail_variation_color_id` int(11) NOT NULL,
//     `shoes_detail_variation_size_id` int(11) NOT NULL,
//     `shoes_detail_quantity` int(11) NOT NULL,
//     `shoes_detail_price` float(10,2) NOT NULL,
//     `shoes_detail_status` int(1) NOT NULL,
//     `shoes_detail_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `shoes_detail_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     `shoes_detail_deleted_at` datetime NULL,
//     `shoes_detail_created_by` int(11) NULL,
//     `shoes_detail_deleted_by` int(11) NULL,
//     PRIMARY KEY (`shoes_detail_id`),
//     FOREIGN KEY (`shoes_detail_shoes_id`) REFERENCES `shoes`(`shoes_id`) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY (`shoes_detail_variation_color_id`) REFERENCES `variation`(`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY (`shoes_detail_variation_size_id`) REFERENCES `variation`(`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY (`shoes_detail_created_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
//     FOREIGN KEY (`shoes_detail_deleted_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
// ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


class Shoes_model
{
    private $table = 'shoes';
    private $table_detail = 'shoes_detail';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllShoes()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE shoes_status != 3');
        return $this->db->resultSet();
    }

    public function getShoesById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE shoes_id=:id AND shoes_status != 3');
        $this->db->bind('id', $id);
        // return $this->db->single();
        $shoe_arr = array();

        $shoe_arr[] = $this->db->single();
        $shoes_detail = $this->getShoesDetailById($id);
        $shoe_arr[0]['shoes_detail'] = $shoes_detail;

        return $shoe_arr;
    }

    public function getShoesDetailById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table_detail . ' WHERE shoes_detail_shoes_id=:id AND shoes_detail_status != 3');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getShoesByCategory($category_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE shoes_category_id=:category_id AND shoes_status != 3');
        $this->db->bind('category_id', $category_id);
        // return $this->db->resultSet();

        $shoe_arr = array();

        foreach ($this->db->resultSet() as $key => $shoes) {
            $shoe_arr[] = $shoes;
            $shoes_detail = $this->getShoesDetailById($shoes['shoes_id']);
            $shoe_arr[$key]['shoes_detail'] = $shoes_detail;
        }

        return $shoe_arr;
    }

    public function getShoesByCategoryLimit($category_id, $limit)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE shoes_category_id=:category_id AND shoes_status != 3 LIMIT :limit');
        $this->db->bind('category_id', $category_id);
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }

    public function getShoesByCategoryLimitOffset($category_id, $limit, $offset)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE shoes_category_id=:category_id AND shoes_status != 3 LIMIT :limit OFFSET :offset');
        $this->db->bind('category_id', $category_id);
        $this->db->bind('limit', $limit);
        $this->db->bind('offset', $offset);
        return $this->db->resultSet();
    }

    public function getShoesByCategoryLimitOffsetSort($category_id, $limit, $offset, $sort)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE shoes_category_id=:category_id AND shoes_status != 3 ORDER BY shoes_name ' . $sort . ' LIMIT :limit OFFSET :offset');
        $this->db->bind('category_id', $category_id);
        $this->db->bind('limit', $limit);
        $this->db->bind('offset', $offset);
        return $this->db->resultSet();
    }

    public function addShoes($data)
    {
        $query = "INSERT INTO " . $this->table . " (shoes_name, shoes_category_id, shoes_description, shoes_image, shoes_status, shoes_created_by) VALUES (:shoes_name, :shoes_category_id, :shoes_description, :shoes_image, :shoes_status, :shoes_created_by)";
        $this->db->query($query);
        foreach ($data as $key => $value) {
            $this->db->bind($key, $value);
        }
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function addShoesDetail($data)
    {
        $query = "INSERT INTO " . $this->table_detail . " (shoes_detail_shoes_id, shoes_detail_variation_color_id, shoes_detail_variation_size_id, shoes_detail_quantity, shoes_detail_price, shoes_detail_status, shoes_detail_created_by) VALUES (:shoes_detail_shoes_id, :shoes_detail_variation_color_id, :shoes_detail_variation_size_id, :shoes_detail_quantity, :shoes_detail_price, :shoes_detail_status, :shoes_detail_created_by)";
        $this->db->query($query);
        foreach ($data as $key => $value) {
            $this->db->bind($key, $value);
        }
        $this->db->execute();

        return $this->db->lastInsertId();
    }

    public function updateShoes($data)
    {
        $query = "UPDATE " . $this->table . " SET shoes_name=:shoes_name, shoes_category_id=:shoes_category_id, shoes_description=:shoes_description, shoes_price=:shoes_price, shoes_status=:shoes_status, shoes_updated_by=:shoes_updated_by WHERE shoes_id=:shoes_id";
        $this->db->query($query);
        foreach ($data as $key => $value) {
            $this->db->bind($key, $value);
        }
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateShoesDetail($data)
    {
        $query = "UPDATE " . $this->table_detail . " SET shoes_detail_quantity=:shoes_detail_quantity, shoes_detail_price=:shoes_detail_price, shoes_detail_status=:shoes_detail_status WHERE shoes_detail_shoes_id=:shoes_detail_id AND shoes_detail_variation_color_id=:shoes_detail_variation_color_id AND shoes_detail_variation_size_id=:shoes_detail_variation_size_id";
        $this->db->query($query);
        $this->db->bind('shoes_detail_quantity', $data['shoes_detail_quantity']);
        $this->db->bind('shoes_detail_price', $data['shoes_detail_price']);
        $this->db->bind('shoes_detail_status', $data['shoes_detail_status']);
        $this->db->bind('shoes_detail_id', $data['shoes_detail_id']);
        $this->db->bind('shoes_detail_variation_color_id', $data['shoes_detail_variation_color_id']);
        $this->db->bind('shoes_detail_variation_size_id', $data['shoes_detail_variation_size_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteShoes($id, $delete_by)
    {
        $query = "UPDATE " . $this->table . " SET shoes_status=:shoes_status, shoes_deleted_at=:shoes_deleted_at, shoes_deleted_by=:shoes_deleted_by WHERE shoes_id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('shoes_status', 3);
        $this->db->bind('shoes_deleted_at', date('Y-m-d H:i:s'));
        $this->db->bind('shoes_deleted_by', $delete_by);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteShoesDetail($id, $delete_by = null)
    {
        $query = "UPDATE " . $this->table_detail . " SET shoes_detail_status=:shoes_detail_status, shoes_detail_deleted_at=:shoes_detail_deleted_at, shoes_detail_deleted_by=:shoes_detail_deleted_by WHERE shoes_detail_id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('shoes_detail_status', 3);
        $this->db->bind('shoes_detail_deleted_at', date('Y-m-d H:i:s'));
        $this->db->bind('shoes_detail_deleted_by', $delete_by);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteShoesdetail_shoes_id($id, $delete_by = null)
    {
        $query = "UPDATE " . $this->table_detail . " SET shoes_detail_status=:shoes_detail_status, shoes_detail_deleted_at=:shoes_detail_deleted_at, shoes_detail_deleted_by=:shoes_detail_deleted_by WHERE shoes_detail_shoes_id=:id AND shoes_detail_status != 3";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('shoes_detail_status', 3);
        $this->db->bind('shoes_detail_deleted_at', date('Y-m-d H:i:s'));
        $this->db->bind('shoes_detail_deleted_by', $delete_by);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchShoes()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE shoes_name LIKE :keyword AND shoes_status != 3";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function getShoesByColorIdAndSizeId($color_id, $size_id)
    {
        $query = "SELECT * FROM " . $this->table_detail . " WHERE shoes_detail_variation_color_id=:color_id AND shoes_detail_variation_size_id=:size_id AND shoes_detail_status != 3";
        $this->db->query($query);
        $this->db->bind('color_id', $color_id);
        $this->db->bind('size_id', $size_id);
        return $this->db->single();
    }

    public function getShoesByShoesIdAndColorIdAndSizeId($shoes_id, $color_id, $size_id)
    {
        $query = "SELECT * FROM " . $this->table_detail . " WHERE shoes_detail_shoes_id=:shoes_id AND shoes_detail_variation_color_id=:color_id AND shoes_detail_variation_size_id=:size_id AND shoes_detail_status != 3";
        $this->db->query($query);
        $this->db->bind('shoes_id', $shoes_id);
        $this->db->bind('color_id', $color_id);
        $this->db->bind('size_id', $size_id);
        return $this->db->single();
    }
}
