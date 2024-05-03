<?php
require 'db_config.php';

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM UTILISATEURS WHERE ID_UTILISATEUR = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
