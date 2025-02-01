<?php
require_once "database.php";
class User {
    public $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function register($name, $surname, $phoneNumber, $email, $password, $confirmPassword, $role = 'user') {
        if ($password !== $confirmPassword) {
            die("Passwords do not match!");
        }
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            die("Email already exists!");
        }
        
        $stmt = $this->db->prepare("INSERT INTO users (name, surname, phoneNumber, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $surname, $phoneNumber, $email, $hashedPassword, $role);
        
        return $stmt->execute();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        if ($result && password_verify($password, $result['password'])) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['role'] = $result['role'];
            return true;
        }
        return false;
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function read() {
        $query = "SELECT * FROM users ORDER BY id DESC";
        return $this->db->query($query);
    }
    
    public function updateUser($id, $name, $surname, $phoneNumber, $email, $password = null) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET name = ?, surname = ?, phoneNumber = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $name, $surname, $phoneNumber, $email, $hashedPassword, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET name = ?, surname = ?, phoneNumber = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $surname, $phoneNumber, $email, $id);
        }
        return $stmt->execute();
    }
    
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    public function getSingleUser($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
