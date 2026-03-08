<?php
class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // --- PUBLIC METHODS ---
    public function createOrder($data, $cartItems) {
        // Start Transaction
        $this->db->query('START TRANSACTION');
        $this->db->execute();

        try {
            // 1. Insert Order
            $this->db->query('INSERT INTO orders (customer_name, phone, address, note, total_price) VALUES (:customer_name, :phone, :address, :note, :total_price)');
            $this->db->bind(':customer_name', $data['customer_name']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':note', $data['note']);
            $this->db->bind(':total_price', $data['total_price']);
            
            $this->db->execute();
            $orderId = $this->db->lastInsertId();

            // 2. Insert Order Items
            foreach ($cartItems as $item) {
                $this->db->query('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_id', $item['id']);
                $this->db->bind(':quantity', $item['quantity']);
                
                // Use sale_price if available, else price
                $price = !empty($item['sale_price']) ? $item['sale_price'] : $item['price'];
                $this->db->bind(':price', $price);
                
                $this->db->execute();
                
                // Also update sold_count
                $this->db->query('UPDATE products SET sold_count = sold_count + :qty WHERE id = :id');
                $this->db->bind(':qty', $item['quantity']);
                $this->db->bind(':id', $item['id']);
                $this->db->execute();
            }

            // Commit Transaction
            $this->db->query('COMMIT');
            $this->db->execute();
            
            return $orderId;
        } catch (Exception $e) {
            // Rollback on Error
            $this->db->query('ROLLBACK');
            $this->db->execute();
            return false;
        }
    }

    // --- ADMIN METHODS ---
    public function getAllOrders() {
        $this->db->query('SELECT * FROM orders ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getOrderById($id) {
        $this->db->query('SELECT * FROM orders WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getOrderItems($orderId) {
        $this->db->query('SELECT oi.*, p.name, p.image FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = :order_id');
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }
    
    public function updateOrderStatus($id, $status) {
        $this->db->query('UPDATE orders SET status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
}
