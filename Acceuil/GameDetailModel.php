<?php
require 'db_config.php';

class GameDetailModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getGameDetails($gameId) {
        $query = "
            SELECT j.*, g.NOM_GENRE, d.NOM_DEVELOPPEUR,
            ROUND(AVG(a.NOTES), 1) AS NOTE_MOYENNE,
            GROUP_CONCAT(CONCAT(u.PRENOM_UTILISATEUR, ' ', u.NOM_UTILISATEUR, ' : ', a.COMMENTAIRE) SEPARATOR '|') AS COMMENTAIRES
            FROM JEUX j
            INNER JOIN GENRE g ON j.ID_GENRE = g.ID_GENRE
            INNER JOIN DEVELOPPEUR d ON j.ID_DEVELOPPEUR = d.ID_DEVELOPPEUR
            LEFT JOIN AVIS a ON j.ID_JEUX = a.ID_JEUX
            LEFT JOIN UTILISATEURS u ON a.ID_UTILISATEUR = u.ID_UTILISATEUR
            WHERE j.ID_JEUX = :gameId
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':gameId', $gameId);
        $stmt->execute();
        $gameDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Convertir la chaîne de commentaires en un tableau
        $gameDetails['COMMENTAIRES'] = explode('|', $gameDetails['COMMENTAIRES']);
    
    
        return $gameDetails;
    }
    
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

$gameDetailModel = new GameDetailModel($db);
?>
