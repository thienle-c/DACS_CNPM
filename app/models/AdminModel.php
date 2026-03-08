<?php
class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Login Admin
    public function login($username, $password) {
        $this->db->query('SELECT * FROM admins WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row->password;
            if (password_verify($password, $hashedPassword)) {
                return $row;
            }
        }
        return false;
    }

    // Get Admin by ID
    public function getAdminById($id) {
        $this->db->query('SELECT * FROM admins WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
