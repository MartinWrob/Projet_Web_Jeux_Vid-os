<?php
require 'ShowUserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function showUserProfile($userId) {
        $user = $this->userModel->getUserById($userId);
        return $user; // Retourner les données de l'utilisateur
    }
}
?>
