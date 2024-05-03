<?php
require 'db_config.php';
require 'UserController.php';

session_start(); // Démarrez la session PHP

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = new UserModel($db);
    $user = $userModel->getUserByEmail($email);
    $storedPasswordHash = $user['MOT_DE_PASSE'];

    // Comparer les hash des mots de passe
    if (password_verify($password, $storedPasswordHash)) {
        // Mot de passe correct, enregistrer l'ID de l'utilisateur dans la session
        $_SESSION['id_utilisateur'] = $user['ID_UTILISATEUR'];
        // Enregistrer le timestamp de la dernière activité dans la session
        $_SESSION['last_activity'] = time();
        // Rediriger vers la page de succès de connexion
        header("Location: login_success.php");
        exit(); // Arrêtez l'exécution du script après la redirection
    } else {
        // Mot de passe incorrect, rediriger vers la page d'échec de connexion
        header("Location: login_failed.php");
        exit(); // Arrêtez l'exécution du script après la redirection
    }
}

// Vérifier l'inactivité de l'utilisateur
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 180) {
    // Détruire la session et rediriger vers la page de connexion
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    // Mettre à jour le timestamp de la dernière activité
    $_SESSION['last_activity'] = time();
}
?>
