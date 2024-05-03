<?php
require_once 'db_config.php';

function insertMessage($title, $content) {
    global $db;
    
    // Insérer le nouveau message dans la table FORUMS
    $query = "INSERT INTO FORUMS (TITRE_FORUM, CONTENU_FORUM, DATE_CREATION) 
              VALUES (:title, :content, NOW())";
    $statement = $db->prepare($query);
    
    $statement->bindParam(':title', $title);
    $statement->bindParam(':content', $content);
    
    $statement->execute();

    // Récupérer l'ID du forum nouvellement créé
    $forumId = $db->lastInsertId();

    return $forumId;
}

function insertDiscussion($userId, $forumId) {
    global $db;

    // Insérer une nouvelle entrée dans la table DISCUTE
    $query = "INSERT INTO DISCUTE (ID_UTILISATEUR, ID_FORUM) 
              VALUES (:userId, :forumId)";
    $statement = $db->prepare($query);
    
    $statement->bindParam(':userId', $userId);
    $statement->bindParam(':forumId', $forumId);
    
    $statement->execute();
}

function getMessages() {
    global $db;
    
    $query = $query = "SELECT f.TITRE_FORUM, f.CONTENU_FORUM, f.DATE_CREATION, u.NOM_UTILISATEUR, u.PRENOM_UTILISATEUR 
          FROM DISCUTE d
          JOIN FORUMS f ON f.ID_FORUM = d.ID_FORUM
          JOIN UTILISATEURS u ON u.ID_UTILISATEUR = d.ID_UTILISATEUR";

              
    $statement = $db->query($query);    
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
// Vérifier l'inactivité de la session
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
