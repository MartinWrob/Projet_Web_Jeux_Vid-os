<?php
require_once 'ForumModel.php';

if(isset($_POST['title']) && isset($_POST['content'])) {
    // Récupérer le titre et le contenu du message depuis le formulaire
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Vérifier si l'utilisateur est connecté et récupérer son ID utilisateur depuis la session
    session_start();
    if(isset($_SESSION['id_utilisateur'])) {
        $userId = $_SESSION['id_utilisateur'];
        
        // Insérer le message dans la table FORUMS
        insertMessage($title, $content);
        
        // Récupérer l'ID du forum qui vient d'être inséré
        $forumId = $db->lastInsertId();
        
        // Insérer une nouvelle entrée dans la table DISCUTE
        insertDiscussion($userId, $forumId);
        
        // Redirection vers une page de succès ou une autre action si nécessaire
        // header('Location: success.php');
        // exit();
    } else {
        echo "Erreur : Utilisateur non connecté.";
    }
} else {
    echo "Erreur : Données manquantes dans le formulaire.";
}


// Récupérer les messages depuis la base de données
$messages = getMessages();
?>
