<?php
session_start();

// Vérifiez si l'utilisateur est connecté
$utilisateurConnecte = isset($_SESSION['id_utilisateur']);

// Vérifier l'inactivité de l'utilisateur
if ($utilisateurConnecte && isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 180) {
    // Détruire la session et rediriger vers la page de connexion
    session_unset();
    session_destroy();
    header("Location: ../Fonctionnalités/Connexion/login.php");
    exit();
}

// Mettre à jour le timestamp de la dernière activité
$_SESSION['last_activity'] = time();

// Réponse JSON
header('Content-Type: application/json');
echo json_encode(['utilisateurConnecte' => $utilisateurConnecte]);
?>
