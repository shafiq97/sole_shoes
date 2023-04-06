<?php
class Category_model
{
    private $table = 'category';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllCategory()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE category_parent IS NULL AND category_deleted_at IS NULL";
        $this->db->query($query);
        // return $this->db->resultSet();

        $main_category_arr = array();
        $list_category_name = array();
        foreach ($this->db->resultSet() as $category) {
            $sub_category_arr = array();
            $main_category_arr[$category['category_id']] = $category;

            $list_category_name[$category['category_id']]['category_id'] = $category['category_id'];
            $list_category_name[$category['category_id']]['category_name'] = $category['category_name'];

            $sub_category = $this->getSubCategory($category['category_id']);
            foreach ($sub_category as $sub) {
                $sub_category_arr[$sub['category_id']] = $sub;
                $list_category_name[$sub['category_id']]['category_id'] = $sub['category_id'];
                $list_category_name[$sub['category_id']]['category_name'] = $category['category_name'] . ' / ' . $sub['category_name'];
            }
            $main_category_arr[$category['category_id']]['sub_category'] = $sub_category_arr;
        }

        return array(
            'main_category' => $main_category_arr,
            'list_category_name' => $list_category_name
        );
    }
    public function getCategoryById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE category_id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function addCategory($data)
    {
        $query = "INSERT INTO " . $this->table . " VALUES (NULL, :category_name, :category_parent, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, :category_created_by, NULL)";
        $this->db->query($query);
        $this->db->bind('category_name', $data['category_name']);
        $this->db->bind('category_parent', $data['category_parent']);
        $this->db->bind('category_created_by', $data['category_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function editCategory($data)
    {
        $query = "UPDATE " . $this->table . " SET category_name = :category_name, category_updated_at = CURRENT_TIMESTAMP WHERE category_id = :category_id";
        $this->db->query($query);
        $this->db->bind('category_name', $data['category_name']);
        // $this->db->bind('category_parent', $data['category_parent']);
        $this->db->bind('category_id', $data['category_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function deleteCategory($id, $delete_by = null)
    {
        $query = "UPDATE " . $this->table . " SET category_deleted_at = CURRENT_TIMESTAMP, category_deleted_by = :category_deleted_by WHERE category_id = :category_id";
        $this->db->query($query);
        $this->db->bind('category_deleted_by', $delete_by);
        $this->db->bind('category_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getSubCategory($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE category_parent = :category_parent AND category_deleted_at IS NULL";
        $this->db->query($query);
        $this->db->bind('category_parent', $id);
        return $this->db->resultSet();
    }

    public function getMainCategory()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE category_parent IS NULL AND category_deleted_at IS NULL";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
