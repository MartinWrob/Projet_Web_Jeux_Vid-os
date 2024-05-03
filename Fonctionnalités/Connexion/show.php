<?php
require 'ShowUserController.php';

session_start();

if (isset($_SESSION['id_utilisateur'])) {
    $userId = $_SESSION['id_utilisateur'];

    // Créer une instance de UserController
    $userController = new UserController($db);

    // Appel de la méthode pour afficher le profil de l'utilisateur
    $user = $userController->showUserProfile($userId);

    // Afficher les informations de l'utilisateur
    require 'ShowUserView.php';
}
?>
