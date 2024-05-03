
<?php
require_once 'db_config.php';

function insertAvis($note, $commentaire, $id_jeu, $id_utilisateur) {
    global $db; // Connexion à la base de données
    
    // Préparation de la requête SQL pour insérer l'avis
    $query = "INSERT INTO avis (commentaire, date_commentaire, notes, id_jeux, id_utilisateur) 
              VALUES (:commentaire, NOW(), :note, :id_jeux, :id_utilisateur)";
    $statement = $db->prepare($query);
    
    // Liaison des paramètres
    $statement->bindParam(':commentaire', $commentaire);
    $statement->bindParam(':note', $note);
    $statement->bindParam(':id_jeux', $id_jeu);
    $statement->bindParam(':id_utilisateur', $id_utilisateur);
    
    // Exécution de la requête
    $statement->execute();
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
}
?>
