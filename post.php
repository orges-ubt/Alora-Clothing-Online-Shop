<?php
require_once "database.php";
class Post {
    public $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createPost($user_id, $review, $imageFilename) {
        $stmt = $this->db->prepare("INSERT INTO posts (user_id, review, image, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("iss", $user_id, $review, $imageFilename);
        return $stmt->execute();
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPosts($user_id = null) {
        if ($user_id) {
            $stmt = $this->db->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            return $stmt->get_result();
        } else {
            $query = "SELECT posts.*, users.name, users.surname FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
            return $this->db->query($query);
        }
    }

    public function updatePost($id, $review, $newImageFilename = null) {
        if ($newImageFilename) {
            $stmt = $this->db->prepare("UPDATE posts SET review = ?, image = ?, updated_at = NOW() WHERE id = ?");
            $stmt->bind_param("ssi", $review, $newImageFilename, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE posts SET review = ?, updated_at = NOW() WHERE id = ?");
            $stmt->bind_param("si", $review, $id);
        }
        return $stmt->execute();
    }
    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }


}