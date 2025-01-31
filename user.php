<?php
require_once "database.php";

class User {
    private $db;

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
}
?>
