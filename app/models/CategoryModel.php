<?php
class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCategories() {
        $this->db->query('SELECT * FROM categories ORDER BY id ASC');
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getCategoryBySlug($slug) {
        $this->db->query('SELECT * FROM categories WHERE slug = :slug');
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    // --- ADMIN METHODS ---
    public function addCategory($data) {
        $this->db->query('INSERT INTO categories (name, slug, description, icon) VALUES (:name, :slug, :description, :icon)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':icon', $data['icon']);
        return $this->db->execute();
    }

    public function updateCategory($id, $data) {
        $this->db->query('UPDATE categories SET name = :name, slug = :slug, description = :description, icon = :icon WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':icon', $data['icon']);
        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query('DELETE FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
