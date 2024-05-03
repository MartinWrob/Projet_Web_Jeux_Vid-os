<?php
require 'UserModel.php';

class UserController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login($email, $password) {
        $user = $this->userModel->getUserByEmail($email);
        if ($user) {
            // Comparer le mot de passe entré avec le hash stocké dans la base de données
            if (password_verify($password, $user['MOT_DE_PASSE'])) {
                return true; // Authentification réussie
            } else {
                return "Mot de passe incorrect.";
            }
        } else {
            return "Utilisateur non trouvé.";
        }
    }
}
?>
