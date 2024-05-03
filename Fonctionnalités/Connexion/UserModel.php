<?php
class UserModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM UTILISATEURS WHERE EMAIL = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
