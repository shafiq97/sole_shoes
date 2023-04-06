<?php

// CREATE TABLE `variation`(
//     `variation_id` int(11) NOT NULL AUTO_INCREMENT,
//     `variation_name` varchar(255) NOT NULL,
//     `variation_type` int(1) NOT NULL,
//     `variation_status` int(1) NOT NULL,
//     `variation_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `variation_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     `variation_deleted_at` datetime NULL,
//     `variation_created_by` int(11) NULL,
//     `variation_deleted_by` int(11) NULL,
//     PRIMARY KEY (`variation_id`),
//     FOREIGN KEY (`variation_created_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
//     FOREIGN KEY (`variation_deleted_by`) REFERENCES `user`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
// ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
class Variation_model
{
    private $table = 'variation';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllVariation()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE variation_deleted_at IS NULL');
        return $this->db->resultSet();
    }

    public function getVariationById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE variation_id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addVariation($data)
    {
        $query = "INSERT INTO " . $this->table . " (variation_name, variation_type, variation_status, variation_created_by) VALUES (:name, :type, :status, :created_by)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('created_by', $data['created_by']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateVariation($data)
    {
        $query = "UPDATE " . $this->table . " SET variation_name = :name,  variation_updated_at = :updated_at WHERE variation_id = :id";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('updated_at', $data['updated_at']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteVariation($id, $delete_by = null)
    {
        $query = "UPDATE " . $this->table . " SET variation_deleted_at = :deleted_at, variation_deleted_by = :deleted_by WHERE variation_id = :id";
        $this->db->query($query);
        $this->db->bind('deleted_at', date('Y-m-d H:i:s'));
        $this->db->bind('deleted_by', $delete_by);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function countVariation()
    {
        $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE variation_deleted_at IS NULL');
        return $this->db->single();
    }

    public function searchVariation()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE variation_deleted_at IS NULL AND variation_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function getVariationByType($type)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE variation_deleted_at IS NULL AND variation_type = :type');
        $this->db->bind('type', $type);
        return $this->db->resultSet();
    }

    public function getVariationByStatus($status)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE variation_deleted_at IS NULL AND variation_status = :status');
        $this->db->bind('status', $status);
        return $this->db->resultSet();
    }

    public function getVariationByTypeAndStatus($type, $status)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE variation_deleted_at IS NULL AND variation_type = :type AND variation_status = :status');
        $this->db->bind('type', $type);
        $this->db->bind('status', $status);
        return $this->db->resultSet();
    }
}
