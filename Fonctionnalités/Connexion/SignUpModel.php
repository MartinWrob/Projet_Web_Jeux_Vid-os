<?php
class UserModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function addUser($lastname, $firstname, $email, $password) {
        $sql = "INSERT INTO UTILISATEURS (NOM_UTILISATEUR, PRENOM_UTILISATEUR, EMAIL, MOT_DE_PASSE, DATE_INSCRIPTION) VALUES (:lastname, :firstname, :email, :password, NOW())";
        
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        // Utilisation de la fonction password_hash() pour sécuriser le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password);

        $stmt->execute();

        header("Location: SignUp_success.php");
        exit();
    }
}
?>
