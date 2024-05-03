<?php
require_once 'AvisModel.php';

// Démarrer la session
session_start();

// Vérification si la requête est de type AJAX et si les données sont présentes
if(isset($_POST['note']) && isset($_POST['commentaire']) && isset($_GET['gameId'])) {
    // Récupération des données du formulaire
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];
    
    // Récupération de l'ID du jeu depuis l'URL
    $gameId = $_GET['gameId'];
    
    // Vérification si l'ID utilisateur est présent dans la session
    if(isset($_SESSION['id_utilisateur'])) {
        $id_utilisateur = $_SESSION['id_utilisateur'];
        
        // Appel de la fonction du modèle pour insérer l'avis dans la base de données
        insertAvis($note, $commentaire, $gameId, $id_utilisateur); // Utilisation de $gameId
        
        // Redirection vers une page de succès
        header("Location: success.php");
        exit();  // Arrêter l'exécution du script après la redirection
    } else {
        // Redirection vers une page d'échec (pas connecté)
        header("Location: not_logged_in.php");
        exit();  // Arrêter l'exécution du script après la redirection
    }
} else {
    // Gérer le cas où l'ID du jeu n'est pas fourni
    echo "Erreur : ID du jeu non spécifié.";
}
?>
