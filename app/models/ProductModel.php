<?php
class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts($limit = null) {
        $sql = 'SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC';
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    
    public function getFeaturedProducts($limit = 10) {
        $this->db->query('SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_featured = 1 ORDER BY p.id DESC LIMIT :limit');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    
    public function getFlashSaleProducts($limit = 6) {
        $this->db->query('SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_flash_sale = 1 ORDER BY p.id DESC LIMIT :limit');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getProductsByCategory($categoryId, $limit = null) {
        $sql = 'SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.category_id = :category_id ORDER BY p.id DESC';
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }
        $this->db->query($sql);
        $this->db->bind(':category_id', $categoryId);
        return $this->db->resultSet();
    }

    public function getProductById($id) {
        $this->db->query('SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getProductBySlug($slug) {
        $this->db->query('SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.slug = :slug');
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }
    
    public function searchProducts($keyword) {
        $this->db->query('SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.name LIKE :keyword OR c.name LIKE :keyword ORDER BY p.id DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    // --- ADMIN METHODS ---
    public function addProduct($data) {
        $this->db->query('INSERT INTO products (category_id, name, slug, price, sale_price, image, description, specs, tags, is_featured, is_flash_sale) 
                          VALUES (:category_id, :name, :slug, :price, :sale_price, :image, :description, :specs, :tags, :is_featured, :is_flash_sale)');
                          
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':specs', $data['specs']);
        $this->db->bind(':tags', $data['tags']);
        $this->db->bind(':is_featured', $data['is_featured']);
        $this->db->bind(':is_flash_sale', $data['is_flash_sale']);
        
        return $this->db->execute();
    }

    public function updateProduct($id, $data) {
        $sql = 'UPDATE products SET 
                category_id = :category_id, name = :name, slug = :slug, 
                price = :price, sale_price = :sale_price, description = :description, 
                specs = :specs, tags = :tags, is_featured = :is_featured, is_flash_sale = :is_flash_sale';
                
        // Only update image if a new one is provided
        if(!empty($data['image'])) {
            $sql .= ', image = :image';
        }
        $sql .= ' WHERE id = :id';
        
        $this->db->query($sql);
        
        $this->db->bind(':id', $id);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':specs', $data['specs']);
        $this->db->bind(':tags', $data['tags']);
        $this->db->bind(':is_featured', $data['is_featured']);
        $this->db->bind(':is_flash_sale', $data['is_flash_sale']);
        
        if(!empty($data['image'])) {
            $this->db->bind(':image', $data['image']);
        }
        
        return $this->db->execute();
    }

    public function deleteProduct($id) {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
